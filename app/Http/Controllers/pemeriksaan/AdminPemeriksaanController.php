<?php

namespace App\Http\Controllers\pemeriksaan;

use App\Helpers\PemeriksaanHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePemeriksaanChargingPumpRequest;
use App\Http\Requests\StorePemeriksaanMainPumpRequest;
use App\Models\Lokasi;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanChargingPump;
use App\Models\PemeriksaanMainPump;
use App\Models\StandarMainPump;
use App\Models\UnitPompa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminPemeriksaanController extends Controller
{
    public function lokasi()
    {
        $lokasi = Lokasi::all();

        return view('admin.pp.index',compact('lokasi'));
    }

    public function index()
    {
        $pemeriksaan = PemeriksaanMainPump::all();
        return view('',compact('pemeriksaan'));
    }

    public function listPompaPerLokasi($id)
    {
        $lokasi = Lokasi::find($id);
        if (!$lokasi) {
            return redirect()->back()->with('error', 'Lokasi tidak valid.');
        }
        $unitPompa = UnitPompa::where('lokasi_id', $id)->get();
        if (!$unitPompa) {
            return redirect()->back()->with('error', 'Unit Pompa tidak ditemukan.');
        }

        return view('admin.pp.listpompa',compact('unitPompa','lokasi'));
    }

    public function pemeriksaan($id, $tanggal)
    {
        $unitPompa = UnitPompa::find($id);
        $idLokasi = UnitPompa::find($id)->lokasi_id;
        $idUnitPompa = $id;

        //JIKA JENIS POMPA MAIN
        if ($unitPompa->jenis_pompa == 'Main Pump') {
            $pemeriksaan = PemeriksaanMainPump::where('unit_pompa_id', $id)
            ->whereDate('tanggal_pemeriksaan', Carbon::parse($tanggal))
            ->first();

            $cekData = PemeriksaanMainPump::where('unit_pompa_id', $id)
            ->whereDate('tanggal_pemeriksaan', Carbon::parse($tanggal))
            ->exists();

            return view('admin.pp.pemeriksaan.mainpump.index',compact('pemeriksaan','cekData','idLokasi','tanggal','idUnitPompa','unitPompa'));

        } 
        //JIKA JENIS POMPA CHARGING
        elseif ($unitPompa->jenis_pompa == 'Charging Pump') {
            $pemeriksaan = PemeriksaanChargingPump::where('unit_pompa_id', $id)
            ->whereDate('tanggal_pemeriksaan', Carbon::parse($tanggal))
            ->first();

            $cekData = PemeriksaanChargingPump::where('unit_pompa_id', $id)
            ->whereDate('tanggal_pemeriksaan', Carbon::parse($tanggal))
            ->exists();

            return view('admin.pp.pemeriksaan.chargingpump.index',compact('pemeriksaan','cekData','idLokasi','tanggal','idUnitPompa','unitPompa'));
        }
    }

    public function storePemeriksaanMainPump(StorePemeriksaanMainPumpRequest $request)
    {
        // dd($request->tanggal_pemeriksaan);
        $validated = $request->validated();

        $userId = auth()->id();
        $unitPompaId = $request->unit_pompa_id;
        $unitPompa = UnitPompa::find($unitPompaId);
    
        $existing = PemeriksaanMainPump::where('user_id', $userId)
            ->where('unit_pompa_id', $unitPompaId)
            ->where('tanggal_pemeriksaan', $request->tanggal_pemeriksaan)
            ->first();
    
        if ($existing) {
            
            $existing->update($validated);

            //KIRIM DATA KE PEMERIKSAANHELPER UNTUK DIPROSES APAKAH ADA YANG PERLU DILAPORKAN KE WA ATAU TIDAK
            PemeriksaanHelper::pemeriksaanMainPump($existing);

            return back()->with('success', 'Data berhasil diperbarui.');
            
        } else {
            $id = 'PMP' . Str::upper(Str::random(3)) . $request->tanggal_pemeriksaan;
            
            $data = PemeriksaanMainPump::create(array_merge(
                $validated,
                [
                    'id_pemeriksaan_main_pump' => $id,
                    'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                    'lokasi_id' => $unitPompa->lokasi_id,
                    'user_id' => $userId,
                ]
            ));
            
            //KIRIM DATA KE PEMERIKSAANHELPER UNTUK DIPROSES APAKAH ADA YANG PERLU DILAPORKAN KE WA ATAU TIDAK
            PemeriksaanHelper::pemeriksaanMainPump($data);
    
            return back()->with('success', 'Data berhasil disimpan.');
        }
    }

    public function storePemeriksaanChargingPump(StorePemeriksaanChargingPumpRequest $request)
    {
        // dd($request->tanggal_pemeriksaan);
        $validated = $request->validated();

        $userId = auth()->id();
        $unitPompaId = $request->unit_pompa_id;
        $unitPompa = UnitPompa::find($unitPompaId);
    
        $existing = PemeriksaanChargingPump::where('user_id', $userId)
            ->where('unit_pompa_id', $unitPompaId)
            ->where('tanggal_pemeriksaan', $request->tanggal_pemeriksaan)
            ->first();
    
        if ($existing) {    
            $existing->update($validated);
            
            PemeriksaanHelper::pemeriksaanChargingPump($existing);

            return back()->with('success', 'Data berhasil diperbarui.');

        } else {
            $id = 'PCP' . Str::upper(Str::random(3)) . $request->tanggal_pemeriksaan;
        
            $data = PemeriksaanChargingPump::create(array_merge(
                $validated,
                [
                    'id_pemeriksaan_charging_pump' => $id,
                    'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                    'lokasi_id' => $unitPompa->lokasi_id,
                    'user_id' => $userId,
                ]
            ));

            PemeriksaanHelper::pemeriksaanChargingPump($data);
    
            return back()->with('success', 'Data berhasil disimpan.');
        }
    }

    public function exportBulananPDF1(Request $request)
    {
        $bulan = $request->bulan; // format: 2025-04
        $lokasiId = $request->lokasi_id;

        $carbon = Carbon::parse($bulan);
        $jumlahHari = $carbon->daysInMonth;

        $mainPump = PemeriksaanMainPump::where('lokasi_id', $lokasiId)
            ->whereYear('tanggal_pemeriksaan', $carbon->year)
            ->whereMonth('tanggal_pemeriksaan', $carbon->month)
            ->orderBy('tanggal_pemeriksaan')
            ->get()
            ->groupBy('unit_pompa_id');

        $chargingPump = PemeriksaanChargingPump::where('lokasi_id', $lokasiId)
            ->whereYear('tanggal_pemeriksaan', $carbon->year)
            ->whereMonth('tanggal_pemeriksaan', $carbon->month)
            ->orderBy('tanggal_pemeriksaan')
            ->get()
            ->groupBy('unit_pompa_id');

        return view('admin.pp.export.export-pemeriksaan',[
            'bulan' => $bulan,
            'jumlahHari' => $jumlahHari,
            'mainPump' => $mainPump,
            'chargingPump' => $chargingPump,
        ]);

        // return PDF::loadView('admin.pp.export.export-pemeriksaan', [
        //     'bulan' => $bulan,
        //     'jumlahHari' => $jumlahHari,
        //     'mainPump' => $mainPump,
        //     'chargingPump' => $chargingPump,
        // ])->setPaper('a4', 'landscape')->stream("laporan-pemeriksaan-pompa-$bulan.pdf");
    }



    public function exportBulananPDF(Request $request)
    {
        $bulan = $request->bulan; // format: 2025-04
        $lokasiId = $request->lokasi_id;

        $carbon = Carbon::parse($bulan);
        $jumlahHari = $carbon->daysInMonth;

        $mainPump = PemeriksaanMainPump::where('lokasi_id', $lokasiId)
            ->whereYear('tanggal_pemeriksaan', $carbon->year)
            ->whereMonth('tanggal_pemeriksaan', $carbon->month)
            ->orderBy('tanggal_pemeriksaan')
            ->get()
            ->groupBy('unit_pompa_id');

        // dd($mainPump);

        $chargingPump = PemeriksaanChargingPump::where('lokasi_id', $lokasiId)
            ->whereYear('tanggal_pemeriksaan', $carbon->year)
            ->whereMonth('tanggal_pemeriksaan', $carbon->month)
            ->orderBy('tanggal_pemeriksaan')
            ->get()
            ->groupBy('unit_pompa_id');

        $lokasi = Lokasi::find($lokasiId);

        if ($lokasi && ($lokasi->nama_lokasi == 'FT LOMANIS' || $lokasi->nama_lokasi == 'KOTAWINANGUN')) {
            $tanggalRange = collect();
            $start = Carbon::parse($bulan)->startOfMonth();
            $end = Carbon::parse($bulan)->endOfMonth();

            while ($start->lte($end)) {
                $tanggalRange->push($start->copy()->toDateString());
                $start->addDay();
            }

            $chunkMain = [
                'rpm' => 'RPM',
                'flow_rate' => 'Flow Rate',
                'suction' => 'Suction',
                'discharge' => 'Discharge',
                'produk_pemompaan' => 'Produk Pemompaan',
                'de_motor_v' => 'DE Motor V', 'de_motor_h' => 'DE Motor H', 'de_motor_a' => 'DE Motor A', 'de_motor_temperatur_casing' => 'DE Motor Temperatur Casing',
                'nde_motor_v' => 'NDE Motor V', 'nde_motor_h' => 'NDE Motor H', 'nde_motor_a' => 'NDE Motor A', 'nde_motor_temperatur_casing' => 'NDE Motor Temperatur Casing',
                'in_gearbox_de_v' => 'In Gearbox DE V', 'in_gearbox_de_h' => 'In Gearbox DE H', 'in_gearbox_de_a' => 'In Gearbox DE A', 'in_gearbox_de_temperatur_casing' => 'In Gearbox DE Temperatur Casing',
                'in_gearbox_nde_v' => 'In Gearbox NDE V', 'in_gearbox_nde_h' => 'In Gearbox NDE H', 'in_gearbox_nde_a' => 'In Gearbox NDE A', 'in_gearbox_nde_temperatur_casing' => 'In Gearbox NDE Temperatur Casing',
                'out_gearbox_de_v' => 'Out Gearbox DE V', 'out_gearbox_de_h' => 'Out Gearbox DE H', 'out_gearbox_de_a' => 'Out Gearbox DE A', 'out_gearbox_de_temperatur_casing' => 'Out Gearbox DE Temperatur Casing',
                'out_gearbox_nde_v' => 'Out Gearbox NDE V', 'out_gearbox_nde_h' => 'Out Gearbox NDE H', 'out_gearbox_nde_a' => 'Out Gearbox NDE A', 'out_gearbox_nde_temperatur_casing' => 'Out Gearbox NDE Temperatur Casing',
                'de_pump_v' => 'DE Pump V', 'de_pump_h' => 'DE Pump H', 'de_pump_a' => 'DE Pump A', 'de_pump_temperatur_casing' => 'DE Pump Temperatur Casing',
                'nde_pump_v' => 'NDE Pump V', 'nde_pump_h' => 'NDE Pump H', 'nde_pump_a' => 'NDE Pump A', 'nde_pump_temperatur_casing' => 'NDE Pump Temperatur Casing',
                'thurstbearing_v' => 'Thurstbearing V', 'thurstbearing_h' => 'Thurstbearing H', 'thurstbearing_a' => 'Thurstbearing A', 'thurstbearing_temperatur_casing' => 'Thurstbearing Temperatur Casing',
                'temperatur_cassing' => 'Temperatur Cassing',
            ];

            $chunkCharging = [
                'flow_rate' => 'Flow Rate', 'suction' => 'Suction', 'discharge' => 'Discharge',
                'de_motor_v' => 'DE Motor V', 'de_motor_h' => 'DE Motor H', 'de_motor_a' => 'DE Motor A',
                'nde_motor_v' => 'NDE Motor V', 'nde_motor_h' => 'NDE Motor H', 'nde_motor_a' => 'NDE Motor A',
                'de_pump_v' => 'DE Pump V', 'de_pump_h' => 'DE Pump H', 'de_pump_a' => 'DE Pump A',
                'nde_pump_v' => 'NDE Pump V', 'nde_pump_h' => 'NDE Pump H', 'nde_pump_a' => 'NDE Pump A',
                'temp_casing_pump' => 'Temperatur Casing Pump', 'temp_mech_seal' => 'Temperatur Mechanical Seal',
                'temp_bearing_pump_de' => 'Temperatur Bearing Pump DE', 'temp_bearing_pump_nde' => 'Temperatur Bearing Pump NDE',
                'temp_bearing_motor_de' => 'Temperatur Bearing Motor DE', 'temp_bearing_motor_nde' => 'Temperatur Bearing Motor NDE',
                'produk_pemompaan' => 'Produk Pemompaan',
            ];

            $fillMissingData = function ($items, $tanggalRange, $chunk) {
                $dataByTanggal = $items->keyBy('tanggal_pemeriksaan');
                $lastValue = null;
                $filledData = collect();

                foreach ($tanggalRange as $tanggal) {
                    $day = Carbon::parse($tanggal)->dayOfWeek; // 0 = Sunday

                    if ($dataByTanggal->has($tanggal)) {
                        $lastValue = $dataByTanggal[$tanggal];
                        $filledData->push($lastValue);
                    } elseif ($day === 0) {
                        $dummy = new \stdClass();
                        $dummy->tanggal_pemeriksaan = $tanggal;
                        $dummy->isFilled = true;
                        foreach ($chunk as $field => $label) {
                            $dummy->$field = null;
                        }
                        $filledData->push($dummy);
                    } elseif ($lastValue) {
                        $copy = clone $lastValue;
                        $copy->tanggal_pemeriksaan = $tanggal;
                        $copy->isFilled = true;
                        $filledData->push($copy);
                    }
                }

                return $filledData;
            };

            $mainPump = $mainPump->map(fn($items) => $fillMissingData($items, $tanggalRange, $chunkMain));
            $chargingPump = $chargingPump->map(fn($items) => $fillMissingData($items, $tanggalRange, $chunkCharging));
        }

        return view('admin.pp.export.export-pemeriksaan', [
            'bulan' => $bulan,
            'jumlahHari' => $jumlahHari,
            'mainPump' => $mainPump,
            'chargingPump' => $chargingPump,
        ]);

        // return PDF::loadView('admin.pp.export.export-pemeriksaan', [
        //     'bulan' => $bulan,
        //     'jumlahHari' => $jumlahHari,
        //     'mainPump' => $mainPump,
        //     'chargingPump' => $chargingPump,
        // ])->setPaper('a4', 'landscape')->stream("laporan-pemeriksaan-pompa-$bulan.pdf");
    }

}