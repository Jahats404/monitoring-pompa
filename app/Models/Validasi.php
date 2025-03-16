<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasFactory;

    public static $rules = [
        // Validasi untuk tabel 'pompa'
        'deskripsi_pompa' => 'required|string|max:255',
        'jenis_cairan' => 'required|string|max:255',

        // Validasi untuk tabel 'detail_pompa'
        'brand' => 'required|string|max:255',
        'kode_bearing_pompa' => 'nullable|string|max:255',
        'jenis' => 'required|string|max:255',

        // Validasi untuk tabel 'spesifikasi_penggerak'
        'type' => 'nullable|string|max:255',
        'no_series' => 'required|string|max:255',
        'kapasitas' => 'nullable|string|max:255',
        'ampere' => 'nullable|string|max:255',
        'tahun_pengadaan' => 'nullable|digits:4|integer|min:1900',
        'kode_bearing_elmot' => 'nullable',

        // Validasi untuk tabel 'mechanical_seal'
        'merk' => 'required|string|max:255',
        'no_seri' => 'required|string|max:255',
    ];

    public static $messages = [
        // Pesan validasi untuk tabel 'pompa'
        'id_pompa.required' => 'ID Pompa wajib diisi.',
        'id_pompa.unique' => 'ID Pompa sudah digunakan.',
        'deskripsi_pompa.required' => 'Deskripsi Pompa wajib diisi.',
        'jenis_cairan.required' => 'Jenis Cairan wajib diisi.',

        // Pesan validasi untuk tabel 'detail_pompa'
        'id_detail_pompa.required' => 'ID Detail Pompa wajib diisi.',
        'id_detail_pompa.unique' => 'ID Detail Pompa sudah digunakan.',
        'brand.required' => 'Brand wajib diisi.',
        'jenis.required' => 'Jenis wajib diisi.',
        'pompa_id.required' => 'Pompa ID wajib diisi.',
        'pompa_id.exists' => 'Pompa ID tidak valid.',

        // Pesan validasi untuk tabel 'spesifikasi_penggerak'
        'id_spesifikasi_penggerak.required' => 'ID Spesifikasi Penggerak wajib diisi.',
        'id_spesifikasi_penggerak.unique' => 'ID Spesifikasi Penggerak sudah digunakan.',
        'no_series.required' => 'Nomor Seri wajib diisi.',
        'tahun_pengadaan.digits' => 'Tahun Pengadaan harus 4 digit.',
        'tahun_pengadaan.integer' => 'Tahun Pengadaan harus berupa angka.',
        'tahun_pengadaan.min' => 'Tahun Pengadaan tidak boleh kurang dari 1900.',
        'tahun_pengadaan.max' => 'Tahun Pengadaan tidak boleh lebih dari tahun saat ini.',
        'kode_bearing_elmot.date' => 'Kode Bearing Elmot harus berupa tanggal.',

        // Pesan validasi untuk tabel 'mechanical_seal'
        'id_mechanical.required' => 'ID Mechanical wajib diisi.',
        'id_mechanical.unique' => 'ID Mechanical sudah digunakan.',
        'merk.required' => 'Merk wajib diisi.',
        'no_seri.required' => 'Nomor Seri wajib diisi.',
    ];
}