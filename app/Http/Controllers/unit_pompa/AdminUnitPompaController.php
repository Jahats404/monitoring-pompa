<?php

namespace App\Http\Controllers\unit_pompa;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\Pompa;
use App\Models\UnitPompa;
use Illuminate\Http\Request;

class AdminUnitPompaController extends Controller
{
    public function index()
    {
        $unitPompa = UnitPompa::all();
        $pompas = Pompa::all();
        $lokasis = Lokasi::all();

        return view('admin.unit_pompa.index',compact('unitPompa','lokasis','pompas'));
    }

    public function store(Request $request)
    {
        $rules = [
            'lokasi_id' => 'required|exists:lokasi,id_lokasi',
            'pompa_id' => 'required|exists:pompa,id_pompa',
            'jenis_pompa' => 'required',
            'jalur' => 'required'
        ];
        $messages = [
            'lokasi_id.required' => 'Lokasi wajib diisi.',
            'lokasi_id.exists' => 'Lokasi tidak valid.',
            'pompa_id.required' => 'Pompa wajib diisi.',
            'pompa_id.exists' => 'Pompa tidak valid.',
            'jenis_pompa.required' => 'Jenis Pompa wajib diisi.',
            'jalur.required' => 'Jalur wajib diisi.'
        ];
        if ($request->jenis_pompa != 'Charging Pump') {
            // $rules = ['jalur' => 'nullable'];
            $rules['jalur'] = 'nullable';
        }
        $request->validate($rules,$messages);

        $unitPompa = new UnitPompa();
        $unitPompa->id_unit_pompa = 'UPOM' . now()->format('YmdHis') . mt_rand(100, 999);
        $unitPompa->lokasi_id = $request->lokasi_id;
        $unitPompa->pompa_id = $request->pompa_id;
        $unitPompa->jenis_pompa = $request->jenis_pompa;

        if ($request->jenis_pompa == 'Charging Pump') {
            $unitPompa->jalur = $request->jalur;
        }

        $unitPompa->save();

        return redirect()->back()->with('success','Unit Pompa berhasil ditambahkan.');
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'lokasi_id' => 'required|exists:lokasi,id_lokasi',
            'pompa_id' => 'required|exists:pompa,id_pompa',
            'jenis_pompa' => 'required',
            'jalur' => 'required'
        ];
        $messages = [
            'lokasi_id.required' => 'Lokasi wajib diisi.',
            'lokasi_id.exists' => 'Lokasi tidak valid.',
            'pompa_id.required' => 'Pompa wajib diisi.',
            'pompa_id.exists' => 'Pompa tidak valid.',
            'jenis_pompa.required' => 'Jenis Pompa wajib diisi.',
            'jalur.required' => 'Jalur wajib diisi.'
        ];
        if ($request->jenis_pompa != 'Charging Pump') {
            $rules['jalur'] = 'nullable';
        }
        $request->validate($rules,$messages);

        $unitPompa = UnitPompa::find($id);
        $unitPompa->lokasi_id = $request->lokasi_id;
        $unitPompa->pompa_id = $request->pompa_id;
        $unitPompa->jenis_pompa = $request->jenis_pompa;

        if ($request->jenis_pompa == 'Charging Pump') {
            $unitPompa->jalur = $request->jalur;
        }

        $unitPompa->save();

        return redirect()->back()->with('success','Unit Pompa berhasil diperbarui.');
    }

    public function delete($id)
    {
        $unitPompa = UnitPompa::find($id);
        $unitPompa->delete();

        return redirect()->back()->with('success','Unit Pompa berhasil dihapus.');
    }
}