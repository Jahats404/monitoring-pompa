<?php

namespace App\Helpers;

use App\Models\PemeriksaanMainPump;
use App\Models\StandarChargingPump;
use App\Models\StandarMainPump;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class PemeriksaanHelper
{
    public static function pemeriksaanMainPump($data)
    {
        $hasilCek = [];

        $fields = [
            'rpm', 'flow_rate', 'suction', 'discharge', 'de_motor_v', 'de_motor_h', 'de_motor_a',
            'de_motor_temperatur_casing', 'nde_motor_v', 'nde_motor_h', 'nde_motor_a', 'nde_motor_temperatur_casing',
            'in_gearbox_de_v', 'in_gearbox_de_h', 'in_gearbox_de_a', 'in_gearbox_de_temperatur_casing',
            'in_gearbox_nde_v', 'in_gearbox_nde_h', 'in_gearbox_nde_a', 'in_gearbox_nde_temperatur_casing',
            'out_gearbox_de_v', 'out_gearbox_de_h', 'out_gearbox_de_a', 'out_gearbox_de_temperatur_casing',
            'out_gearbox_nde_v', 'out_gearbox_nde_h', 'out_gearbox_nde_a', 'out_gearbox_nde_temperatur_casing',
            'de_pump_v', 'de_pump_h', 'de_pump_a', 'de_pump_temperatur_casing',
            'nde_pump_v', 'nde_pump_h', 'nde_pump_a', 'nde_pump_temperatur_casing',
            'thurstbearing_v', 'thurstbearing_h', 'thurstbearing_a', 'thurstbearing_temperatur_casing',
            'temperatur_cassing'
        ];

        $standar = StandarMainPump::find('1');

        $alerts = [];

        foreach ($fields as $field) {
            $nilaiPemeriksaan = floatval($data->$field);
            $nilaiStandar = floatval($standar->$field);

            if ($nilaiStandar && $nilaiPemeriksaan > $nilaiStandar) {
                $alerts[] = "Nilai {$field} lebih tinggi dari standar (Standar: $nilaiStandar, Pemeriksaan: $nilaiPemeriksaan)";
            }
        }

        $hasilCek[] = [
            'tanggal' => $data->tanggal_pemeriksaan,
            'pompa' => $data->unit_pompa->pompa->deskripsi_pompa,
            'status' => count($alerts) > 0 ? 'warning' : 'ok',
            'alerts' => $alerts
        ];
        

        $pesanGabungan = "*📋 Laporan Pemeriksaan Main Pump*\n\n";

        foreach ($hasilCek as $cek) {
            if ($cek['status'] === 'warning') {
                $pesanGabungan .= "⚠️ *Warning!*\n";
                $pesanGabungan .= "📍 Pompa: *{$cek['pompa']}*\n";
                $pesanGabungan .= "📅 Tanggal: *{$cek['tanggal']}*\n";
                $pesanGabungan .= "📌 Rincian:\n";
                foreach ($cek['alerts'] as $alert) {
                    $pesanGabungan .= "- $alert\n";
                }
                $pesanGabungan .= "\n"; // spasi antar blok
            } elseif ($cek['status'] === 'error') {
                $pesanGabungan .= "❌ *Error!*\n";
                $pesanGabungan .= "🆔 ID Pemeriksaan: *{$cek['pemeriksaan_id']}*\n";
                $pesanGabungan .= "📣 Pesan: {$cek['message']}\n\n";
            }
        }

        $users = User::where('role_id', 2)->get(); // ambil semua user dengan role admin

        if (str_contains($pesanGabungan, '⚠️') || str_contains($pesanGabungan, '❌')) {
            foreach ($users as $user) {
                if ($user->no_wa) {
                    WhatsappHelper::kirimPesan($user->no_wa, $pesanGabungan);
                }
            }
        }
    }



    public static function pemeriksaanChargingPump($data)
    {
        $hasilCek = [];

        $fields = [
            'flow_rate', 'suction', 'discharge',
            'de_motor_v', 'de_motor_h', 'de_motor_a',
            'nde_motor_v', 'nde_motor_h', 'nde_motor_a',
            'de_pump_v', 'de_pump_h', 'de_pump_a',
            'nde_pump_v', 'nde_pump_h', 'nde_pump_a',
            'temp_casing_pump', 'temp_mech_seal',
            'temp_bearing_pump_de', 'temp_bearing_pump_nde',
            'temp_bearing_motor_de', 'temp_bearing_motor_nde'
        ];

        $standar = StandarChargingPump::find('1');

        $alerts = [];

        foreach ($fields as $field) {
            $nilaiPemeriksaan = floatval($data->$field);
            $nilaiStandar = floatval($standar->$field);

            if ($nilaiStandar && $nilaiPemeriksaan > $nilaiStandar) {
                $alerts[] = "Nilai {$field} lebih tinggi dari standar (Standar: $nilaiStandar, Pemeriksaan: $nilaiPemeriksaan)";
            }
        }

        $hasilCek[] = [
            'tanggal' => $data->tanggal_pemeriksaan,
            'pompa' => $data->unit_pompa->pompa->deskripsi_pompa ?? 'Pompa Tidak Diketahui',
            'status' => count($alerts) > 0 ? 'warning' : 'ok',
            'alerts' => $alerts
        ];

        $pesanGabungan = "*📋 Laporan Pemeriksaan Charging Pump*\n\n";

        foreach ($hasilCek as $cek) {
            if ($cek['status'] === 'warning') {
                $pesanGabungan .= "⚠️ *Warning!*\n";
                $pesanGabungan .= "📍 Pompa: *{$cek['pompa']}*\n";
                $pesanGabungan .= "📅 Tanggal: *{$cek['tanggal']}*\n";
                $pesanGabungan .= "📌 Rincian:\n";
                foreach ($cek['alerts'] as $alert) {
                    $pesanGabungan .= "- $alert\n";
                }
                $pesanGabungan .= "\n";
            } elseif ($cek['status'] === 'error') {
                $pesanGabungan .= "❌ *Error!*\n";
                $pesanGabungan .= "📍 Pompa: *{$cek['pompa']}*\n";
                $pesanGabungan .= "📅 Tanggal: *{$cek['tanggal']}*\n";
                $pesanGabungan .= "📣 Pesan: {$cek['message']}\n\n";
            }
        }

        $users = User::where('role_id', 2)->get(); // ambil semua user dengan role admin

        if (str_contains($pesanGabungan, '⚠️') || str_contains($pesanGabungan, '❌')) {
            foreach ($users as $user) {
                if ($user->no_wa) {
                    WhatsappHelper::kirimPesan($user->no_wa, $pesanGabungan);
                }
            }
        }
    }

}