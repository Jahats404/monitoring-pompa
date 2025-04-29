<?php

namespace App\Http\Controllers\pemeliharaan;

use App\Exports\PemeliharaanExport;
use App\Http\Controllers\Controller;
use App\Models\Pemeliharaan;
use App\Models\UnitPompa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AdminPemeliharaanController extends Controller
{
    public function index($id, $tanggal)
    {
        $unitPompa = UnitPompa::find($id);
        $idLokasi = UnitPompa::find($id)->first()->lokasi_id;
        $idUnitPompa = $id;

        $pemeliharaan = Pemeliharaan::where('unit_pompa_id', $id)
            ->whereDate('tanggal_pemeliharaan', Carbon::parse($tanggal))
            ->first();
        $pemeliharaanAll = Pemeliharaan::where('unit_pompa_id', $id)->get();
        // dd($pemeliharaanAll);

        return view('admin.pp.pemeliharaan.index',compact('pemeliharaan','unitPompa','idLokasi','idUnitPompa','tanggal','pemeliharaanAll'));
    }

    public function storePemeliharaan(Request $request)
    {
        $validated = $request->validate(
            [
                'uraian_pemeliharaan' => 'nullable|string',
                'keterangan' => 'nullable|string',
            ]
        );

        $userId = auth()->id();
        $unitPompaId = $request->unit_pompa_id;
        // dd($request->all());
    
        $existing = Pemeliharaan::where('user_id', $userId)
            ->where('unit_pompa_id', $unitPompaId)
            ->where('tanggal_pemeliharaan', $request->tanggal_pemeliharaan)
            ->first();
    
        if ($existing) {
            $existing->update($validated);
            return back()->with('success', 'Data berhasil diperbarui.');
        } else {
            $id = 'PLH' . Str::upper(Str::random(3)) . $request->tanggal_pemeliharaan;
    
            Pemeliharaan::create(array_merge(
                $validated,
                [
                    'id_pemeliharaan' => $id,
                    'tanggal_pemeliharaan' => $request->tanggal_pemeliharaan,
                    'user_id' => $userId,
                    'unit_pompa_id' => $unitPompaId,
                ]
            ));
    
            return back()->with('success', 'Data berhasil disimpan.');
        }
    }

    public function exportExcel($id)
    {
        $pemeliharaan = Pemeliharaan::where('unit_pompa_id', $id)->get();
        $lokasi = $pemeliharaan->first()?->unit_pompa->lokasi;
        $pompa = $pemeliharaan->first()?->unit_pompa->pompa;
        
        return Excel::download(new PemeliharaanExport($pemeliharaan,$lokasi, $pompa), 'pemeliharaan_' . $pompa->deskripsi_pompa .  '.xlsx');
    }
}