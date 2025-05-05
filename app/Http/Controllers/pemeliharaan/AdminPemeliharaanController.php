<?php

namespace App\Http\Controllers\pemeliharaan;

use App\Exports\PemeliharaanExport;
use App\Http\Controllers\Controller;
use App\Models\Pemeliharaan;
use App\Models\UnitPompa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                'file_pemeliharaan' => 'nullable|image'
            ]
        );

        $userId = auth()->id();
        $unitPompaId = $request->unit_pompa_id;
        $path = 'uploads/pemeliharaan';
    
        $existing = Pemeliharaan::where('user_id', $userId)
            ->where('unit_pompa_id', $unitPompaId)
            ->where('tanggal_pemeliharaan', $request->tanggal_pemeliharaan)
            ->first();

        if ($existing) {
            if ($request->hasFile('file_pemeliharaan')) {
                $file = $request->file('file_pemeliharaan');

                // Hapus file lama jika ada
                if ($existing->file_pemeliharaan && Storage::disk('public')->exists($existing->file_pemeliharaan)) {
                    Storage::disk('public')->delete($existing->file_pemeliharaan);
                }

                $storedPath = $file->store($path, 'public');
                
                $validated['file_pemeliharaan'] = $storedPath;
            }

            // Update data lainnya
            $existing->update($validated);

            return back()->with('success', 'Data berhasil diperbarui.');
        } else {
            $id = 'PLH' . Str::upper(Str::random(3)) . $request->tanggal_pemeliharaan;

            if ($request->hasFile('file_pemeliharaan')) {
                $file = $request->file('file_pemeliharaan');
                $storedPath = $file->store($path, 'public');
            } else {
                $file = null;
            }
    
            Pemeliharaan::create(array_merge(
                $validated,
                [
                    'id_pemeliharaan' => $id,
                    'tanggal_pemeliharaan' => $request->tanggal_pemeliharaan,
                    'file_pemeliharaan' => $storedPath,
                    'user_id' => $userId,
                    'unit_pompa_id' => $unitPompaId,
                ]
            ));
    
            return back()->with('success', 'Data berhasil disimpan.');
        }
    }

    public function dokumentasiPemeliharaan(Request $request, $id)
    {
        $request->validate(
            [
                'file_pemeliharaan' => 'required|image',
            ],
            [
                'file_pemeliharaan.required' => 'Dokumentasi wajib diisi.',
                'file_pemeliharaan.image' => 'Dokumentasi harus berupa gambar.'
            ]
        );

        $pemeliharaan = Pemeliharaan::find($id);

        if ($pemeliharaan->file_pemeliharaan) {
            Storage::disk('public')->delete($pemeliharaan->file_pemeliharaan);
        }
        $file = $request->file('file_pemeliharaan');

        $pemeliharaan->file_pemeliharaan = $file->store('uploads/pemeliharaan', 'public') ;
        $pemeliharaan->save();

        return redirect()->back()->with('success','Dokumentasi berhasil ditambahkan');
    }

    public function exportExcel($id)
    {
        $pemeliharaan = Pemeliharaan::where('unit_pompa_id', $id)->get();
        if ($pemeliharaan->isEmpty()) {
            return redirect()->back()->with('error','Tidak ada data!');
        }
        $lokasi = $pemeliharaan->first()?->unit_pompa->lokasi;
        $pompa = $pemeliharaan->first()?->unit_pompa->pompa;
        
        return Excel::download(new PemeliharaanExport($pemeliharaan,$lokasi, $pompa), 'pemeliharaan_' . $pompa->deskripsi_pompa .  '.xlsx');
    }
}