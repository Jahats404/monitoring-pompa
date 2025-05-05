<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lokasi::create([
            'id_lokasi' => '1',
            'nama_lokasi' => 'FT Lomanis',
            'alamat_lokasi' => 'Lomanis, Cilacap'
        ]);
        Lokasi::create([
            'id_lokasi' => '2',
            'nama_lokasi' => 'KOTAWINANGUN',
            'alamat_lokasi' => 'KOTAWINANGUN'
        ]);
    }
}