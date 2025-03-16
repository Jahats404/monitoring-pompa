<?php

namespace App\Http\Controllers\pompa;

use App\Http\Controllers\Controller;
use App\Models\DetailPompa;
use App\Models\MechanicalSeal;
use App\Models\Pompa;
use App\Models\SpesifikasiPenggerak;
use App\Models\Validasi;
use Illuminate\Http\Request;

class AdminPompaController extends Controller
{
    public function index()
    {
        // MENGECEK POMPA APAKAH ADA RELASI DENGAN DETAIL POMPA, SPESIFIKASI PENGGERAK, MECH SEAL JIKA TIDAK ADA RELASI MAKA HAPUS DATA POMPA
        $cekRelasi = Pompa::doesntHave('detail_pompa')
                    ->doesntHave('spesifikasi_penggerak')
                    ->doesntHave('mechanical_seal')
                    ->get();
        // HAPUS SEMUA DATA POMPA YANG TIDAK MEMILIKI RELASI
        foreach ($cekRelasi as $pompas) {
            $pompas = Pompa::delete();
        }

        $pompa = Pompa::all();

        return view('admin.pompa.index',compact('pompa'));
    }
    
    public function payload()
    {
        $pompa = Pompa::all();

        return view('admin.pompa.payload-view',compact('pompa'));
    }

    public function detail_pompa($id)
    {
        $pompa = Pompa::find($id);

        return view('admin.pompa.detail-pompa',compact('pompa'));
    }

    public function store(Request $request)
    {
        $request->validate(Validasi::$rules,Validasi::$messages);

        // INSERT POMPA
        $pompa = new Pompa();
        $pompa->id_pompa = 'POM' . now()->format('YmdHis') . mt_rand(100, 999);
        $pompa->deskripsi_pompa = $request->deskripsi_pompa;
        $pompa->jenis_cairan = $request->jenis_cairan;

        // INSERT DETAIL POMPA
        $detailPompa = new DetailPompa();
        $detailPompa->id_detail_pompa = 'DPOM' . now()->format('YmdHis') . mt_rand(100, 999);
        $detailPompa->brand = $request->brand;
        $detailPompa->kode_bearing_pompa = $request->kode_bearing_pompa;
        $detailPompa->jenis = $request->jenis;
        $detailPompa->kapasitas_pompa = $request->kapasitas_pompa;
        $detailPompa->pompa_id = $pompa->id_pompa;

        // INSERT SPESIFIKASI PENGGERAK
        $spesifikasiPenggerak = new SpesifikasiPenggerak();
        $spesifikasiPenggerak->id_spesifikasi_penggerak = 'SP' . now()->format('YmdHis') . mt_rand(100, 999);
        $spesifikasiPenggerak->type = $request->type;
        $spesifikasiPenggerak->no_series = $request->no_series;
        $spesifikasiPenggerak->kapasitas_penggerak = $request->kapasitas_penggerak;
        $spesifikasiPenggerak->ampere = $request->ampere;
        $spesifikasiPenggerak->tahun_pengadaan = $request->tahun_pengadaan;
        $spesifikasiPenggerak->kode_bearing_elmot = $request->kode_bearing_elmot;
        $spesifikasiPenggerak->pompa_id = $pompa->id_pompa;

        // INSERT MECHANICAL SEAL
        $mechSeal = new MechanicalSeal();
        $mechSeal->id_mechanical_seal = 'MS' . now()->format('YmdHis') . mt_rand(100, 999);
        $mechSeal->merk = $request->merk;
        $mechSeal->no_seri = $request->no_seri;
        $mechSeal->pompa_id = $pompa->id_pompa;

        // SAVE
        $pompa->save();
        $detailPompa->save();
        $spesifikasiPenggerak->save();
        $mechSeal->save();

        return redirect()->back()->with('success','Spesifikasi Pompa berhasil ditambahkan.');
    }

    public function update(Request $request,$id)
    {
        $request->validate(Validasi::$rules,Validasi::$messages);

        $pompa = Pompa::find($id);
        $pompa->deskripsi_pompa = $request->deskripsi_pompa;
        $pompa->jenis_cairan = $request->jenis_cairan;

        // INSERT DETAIL POMPA
        $detailPompa = DetailPompa::where('pompa_id',$pompa->id_pompa)->first();
        $detailPompa->brand = $request->brand;
        $detailPompa->kode_bearing_pompa = $request->kode_bearing_pompa;
        $detailPompa->jenis = $request->jenis;
        $detailPompa->kapasitas_pompa = $request->kapasitas_pompa;

        // INSERT SPESIFIKASI PENGGERAK
        $spesifikasiPenggerak = SpesifikasiPenggerak::where('pompa_id',$pompa->id_pompa)->first();
        $spesifikasiPenggerak->type = $request->type;
        $spesifikasiPenggerak->no_series = $request->no_series;
        $spesifikasiPenggerak->kapasitas_penggerak = $request->kapasitas_penggerak;
        $spesifikasiPenggerak->ampere = $request->ampere;
        $spesifikasiPenggerak->tahun_pengadaan = $request->tahun_pengadaan;
        $spesifikasiPenggerak->kode_bearing_elmot = $request->kode_bearing_elmot;

        // INSERT MECHANICAL SEAL
        $mechSeal = MechanicalSeal::where('pompa_id',$pompa->id_pompa)->first();
        $mechSeal->merk = $request->merk;
        $mechSeal->no_seri = $request->no_seri;

        // SAVE
        $pompa->save();
        $detailPompa->save();
        $spesifikasiPenggerak->save();
        $mechSeal->save();

        return redirect()->back()->with('success','Data Spesifikasi Pompa berhasil diperbarui.');
    }

    public function delete($id)
    {
        $pompa = Pompa::find($id);
        $pompa->delete();

        return redirect()->route('admin.payload.pompa')->with('success','Data Spesifikasi Pompa berhasil dihapus.');
    }
}