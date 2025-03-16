<?php

namespace App\Http\Controllers\lokasi;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminLokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::orderBy('created_at')->get();
        
        return view('admin.lokasi.index',compact('lokasi'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_lokasi' => 'required',
            'alamat_lokasi' => 'required',
        ];
        $messages = [
            'nama_lokasi.required' => 'Nama Lokasi wajib diisi.',
            'alamat_lokasi.required' => 'Alamat Lokasi wajib diisi.',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lokasi = new Lokasi();
        $lokasi->id_lokasi = 'LOK' . now()->format('YmdHis') . mt_rand(100, 999);
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->alamat_lokasi = $request->alamat_lokasi;
        $lokasi->save();
        
        return redirect()->back()->with('success','Lokasi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama_lokasi' => 'required',
            'alamat_lokasi' => 'required',
        ];
        $messages = [
            'nama_lokasi.required' => 'Nama Lokasi wajib diisi.',
            'alamat_lokasi.required' => 'Alamat Lokasi wajib diisi.',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lokasi = Lokasi::find($id);
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->alamat_lokasi = $request->alamat_lokasi;
        $lokasi->save();
        
        return redirect()->back()->with('success','Lokasi berhasil diperbarui');
    }

    public function delete($id)
    {
        if (!$id) {
            return redirect()->back()->with('error','Lokasi tidak ditemukan.');
        } 
        
        $lokasi = Lokasi::find($id);
        $lokasi->delete();

        return redirect()->back()->with('success','Lokasi berhasil dihapus');
    }
}