<?php

namespace App\Http\Controllers\standar;

use App\Http\Controllers\Controller;
use App\Http\Requests\StandarPemeriksaanChargingPumpRequest;
use App\Http\Requests\StandarPemeriksaanMainPumpRequest;
use App\Models\PemeriksaanChargingPump;
use App\Models\PemeriksaanMainPump;
use App\Models\StandarChargingPump;
use App\Models\StandarMainPump;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminStandarController extends Controller
{
    public function index()
    {
        return view('admin.pp.standar.index');
    }

    public function standarMainPump()
    {
        $semuaPemeriksaan = PemeriksaanMainPump::all();

        // $hasilCek = [];

        // $fields = [
        //     'rpm', 'flow_rate', 'suction', 'discharge', 'de_motor_v', 'de_motor_h', 'de_motor_a',
        //     'de_motor_temperatur_casing', 'nde_motor_v', 'nde_motor_h', 'nde_motor_a', 'nde_motor_temperatur_casing',
        //     'in_gearbox_de_v', 'in_gearbox_de_h', 'in_gearbox_de_a', 'in_gearbox_de_temperatur_casing',
        //     'in_gearbox_nde_v', 'in_gearbox_nde_h', 'in_gearbox_nde_a', 'in_gearbox_nde_temperatur_casing',
        //     'out_gearbox_de_v', 'out_gearbox_de_h', 'out_gearbox_de_a', 'out_gearbox_de_temperatur_casing',
        //     'out_gearbox_nde_v', 'out_gearbox_nde_h', 'out_gearbox_nde_a', 'out_gearbox_nde_temperatur_casing',
        //     'de_pump_v', 'de_pump_h', 'de_pump_a', 'de_pump_temperatur_casing',
        //     'nde_pump_v', 'nde_pump_h', 'nde_pump_a', 'nde_pump_temperatur_casing',
        //     'thurstbearing_v', 'thurstbearing_h', 'thurstbearing_a', 'thurstbearing_temperatur_casing',
        //     'temperatur_cassing'
        // ];

        // foreach ($semuaPemeriksaan as $pemeriksaan) {
        //     $standar = StandarMainPump::find('1');

        //     if (!$standar) {
        //         $hasilCek[] = [
        //             'tanggal' => $pemeriksaan->tanggal_pemeriksaan,
        //             'pompa' => $pemeriksaan->unit_pompa->pompa->deskripsi_pompa,
        //             'status' => 'error',
        //             'message' => 'Standar tidak ditemukan untuk user ini'
        //         ];
        //         continue;
        //     }

        //     $alerts = [];

        //     foreach ($fields as $field) {
        //         $nilaiPemeriksaan = floatval($pemeriksaan->$field);
        //         $nilaiStandar = floatval($standar->$field);

        //         if ($nilaiStandar && $nilaiPemeriksaan < $nilaiStandar) {
        //             $alerts[] = "Nilai {$field} lebih rendah dari standar (Standar: $nilaiStandar, Pemeriksaan: $nilaiPemeriksaan)";
        //         }
        //     }

        //     $hasilCek[] = [
        //         'tanggal' => $pemeriksaan->tanggal_pemeriksaan,
        //         'pompa' => $pemeriksaan->unit_pompa->pompa->deskripsi_pompa,
        //         'status' => count($alerts) > 0 ? 'warning' : 'ok',
        //         'alerts' => $alerts
        //     ];

        // }
        
        // $nomorTujuan = '6285878653934'; // Ganti dengan nomor WhatsApp penerima

        // $pesanGabungan = "*📋 Laporan Pemeriksaan Main Pump*\n\n";

        // foreach ($hasilCek as $cek) {
        //     if ($cek['status'] === 'warning') {
        //         $pesanGabungan .= "⚠️ *Warning!*\n";
        //         $pesanGabungan .= "📍 Pompa: *{$cek['pompa']}*\n";
        //         $pesanGabungan .= "📅 Tanggal: *{$cek['tanggal']}*\n";
        //         $pesanGabungan .= "📌 Rincian:\n";
        //         foreach ($cek['alerts'] as $alert) {
        //             $pesanGabungan .= "- $alert\n";
        //         }
        //         $pesanGabungan .= "\n"; // spasi antar blok
        //     } elseif ($cek['status'] === 'error') {
        //         $pesanGabungan .= "❌ *Error!*\n";
        //         $pesanGabungan .= "🆔 ID Pemeriksaan: *{$cek['pemeriksaan_id']}*\n";
        //         $pesanGabungan .= "📣 Pesan: {$cek['message']}\n\n";
        //     }
        // }
        //     // Kirim ke WhatsApp
        //     $this->kirimPesanWhatsAppMainPump($nomorTujuan, $pesanGabungan);

        $standar = StandarMainPump::find('1');
        return view('admin.pp.standar.mainpump',compact('standar'));
    }

    public function storeStandarMainPump(StandarPemeriksaanMainPumpRequest $request)
    {
        $validated = $request->validated();

        $userId = auth()->id();
    
        $existing = StandarMainPump::find('1');
    
        if ($existing) {
            $existing->update($validated);
            
            return back()->with('success', 'Data berhasil diperbarui.');
        } else {
            $id = '1';
            // dd($request->tanggal_pemeriksaan);
            StandarMainPump::create(array_merge(
                $validated,
                [
                    'id_standar_main_pump' => $id,
                    'user_id' => $userId,
                ]
            ));
    
            return back()->with('success', 'Data berhasil disimpan.');
        }
    }

    // ================================================================================================================================================

    public function standarChargingPump()
    {
        $semuaPemeriksaan = PemeriksaanChargingPump::all();
        // $hasilCek = [];

        // $fields = [
        //     'flow_rate', 'suction', 'discharge',
        //     'de_motor_v', 'de_motor_h', 'de_motor_a',
        //     'nde_motor_v', 'nde_motor_h', 'nde_motor_a',
        //     'de_pump_v', 'de_pump_h', 'de_pump_a',
        //     'nde_pump_v', 'nde_pump_h', 'nde_pump_a',
        //     'temp_casing_pump', 'temp_mech_seal',
        //     'temp_bearing_pump_de', 'temp_bearing_pump_nde',
        //     'temp_bearing_motor_de', 'temp_bearing_motor_nde'
        // ];

        // foreach ($semuaPemeriksaan as $pemeriksaan) {
        //     $standar = StandarChargingPump::find('1');

        //     if (!$standar) {
        //         $hasilCek[] = [
        //             'tanggal' => $pemeriksaan->tanggal_pemeriksaan,
        //             'pompa' => $pemeriksaan->unit_pompa->pompa->deskripsi_pompa ?? 'Pompa Tidak Diketahui',
        //             'status' => 'error',
        //             'message' => 'Standar tidak ditemukan untuk user ini',
        //         ];
        //         continue;
        //     }

        //     $alerts = [];

        //     foreach ($fields as $field) {
        //         $nilaiPemeriksaan = floatval($pemeriksaan->$field);
        //         $nilaiStandar = floatval($standar->$field);

        //         if ($nilaiStandar && $nilaiPemeriksaan < $nilaiStandar) {
        //             $alerts[] = "Nilai {$field} lebih rendah dari standar (Standar: $nilaiStandar, Pemeriksaan: $nilaiPemeriksaan)";
        //         }
        //     }

        //     $hasilCek[] = [
        //         'tanggal' => $pemeriksaan->tanggal_pemeriksaan,
        //         'pompa' => $pemeriksaan->unit_pompa->pompa->deskripsi_pompa ?? 'Pompa Tidak Diketahui',
        //         'status' => count($alerts) > 0 ? 'warning' : 'ok',
        //         'alerts' => $alerts
        //     ];
        // }

        // // ✅ Kirim WhatsApp jika ada warning atau error
        // $nomorTujuan = '62895381280779';
        // $pesanGabungan = "*📋 Laporan Pemeriksaan Charging Pump*\n\n";

        // foreach ($hasilCek as $cek) {
        //     if ($cek['status'] === 'warning') {
        //         $pesanGabungan .= "⚠️ *Warning!*\n";
        //         $pesanGabungan .= "📍 Pompa: *{$cek['pompa']}*\n";
        //         $pesanGabungan .= "📅 Tanggal: *{$cek['tanggal']}*\n";
        //         $pesanGabungan .= "📌 Rincian:\n";
        //         foreach ($cek['alerts'] as $alert) {
        //             $pesanGabungan .= "- $alert\n";
        //         }
        //         $pesanGabungan .= "\n";
        //     } elseif ($cek['status'] === 'error') {
        //         $pesanGabungan .= "❌ *Error!*\n";
        //         $pesanGabungan .= "📍 Pompa: *{$cek['pompa']}*\n";
        //         $pesanGabungan .= "📅 Tanggal: *{$cek['tanggal']}*\n";
        //         $pesanGabungan .= "📣 Pesan: {$cek['message']}\n\n";
        //     }
        // }

        // Kirim jika ada warning/error
        // if (str_contains($pesanGabungan, '⚠️') || str_contains($pesanGabungan, '❌')) {
        //     $this->kirimPesanWhatsAppChargingPump($nomorTujuan, $pesanGabungan);
        // }

        $standar = StandarChargingPump::find('1');

        return view('admin.pp.standar.chargingpump',compact('standar'));
    }

    public function storeStandarChargingPump(StandarPemeriksaanChargingPumpRequest $request)
    {
        $validated = $request->validated();

        $userId = auth()->id();
    
        $existing = StandarChargingPump::find('1');
    
        if ($existing) {
            $existing->update($validated);
            return back()->with('success', 'Data berhasil diperbarui.');
        } else {
            $id = '1';
            // dd($request->tanggal_pemeriksaan);
            StandarChargingPump::create(array_merge(
                $validated,
                [
                    'id_standar_charging_pump' => $id,
                    'user_id' => $userId,
                ]
            ));
            
            return back()->with('success', 'Data berhasil disimpan.');
        }
    }
}