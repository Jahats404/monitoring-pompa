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
        $idLokasi = UnitPompa::find($id)->first()->lokasi_id;
        $idUnitPompa = $id;

        //JIKA JENIS POMPA MAIN
        if ($unitPompa->jenis_pompa == 'Main Pump') {
            $pemeriksaan = PemeriksaanMainPump::where('unit_pompa_id', $id)
            ->whereDate('tanggal_pemeriksaan', Carbon::parse($tanggal))
            ->first();

            return view('admin.pp.pemeriksaan.mainpump.index',compact('pemeriksaan','idLokasi','tanggal','idUnitPompa','unitPompa'));

        } 
        //JIKA JENIS POMPA CHARGING
        elseif ($unitPompa->jenis_pompa == 'Charging Pump') {
            $pemeriksaan = PemeriksaanChargingPump::where('unit_pompa_id', $id)
            ->whereDate('tanggal_pemeriksaan', Carbon::parse($tanggal))
            ->first();

            return view('admin.pp.pemeriksaan.chargingpump.index',compact('pemeriksaan','idLokasi','tanggal','idUnitPompa','unitPompa'));
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

        $chargingPump = PemeriksaanChargingPump::where('lokasi_id', $lokasiId)
            ->whereYear('tanggal_pemeriksaan', $carbon->year)
            ->whereMonth('tanggal_pemeriksaan', $carbon->month)
            ->orderBy('tanggal_pemeriksaan')
            ->get()
            ->groupBy('unit_pompa_id');

            // dd($mainPump);

        return PDF::loadView('admin.pp.export.export-pemeriksaan', [
            'bulan' => $bulan,
            'jumlahHari' => $jumlahHari,
            'mainPump' => $mainPump,
            'chargingPump' => $chargingPump,
        ])->setPaper('a4', 'landscape')->stream("laporan-pemeriksaan-pompa-$bulan.pdf");
    }

}