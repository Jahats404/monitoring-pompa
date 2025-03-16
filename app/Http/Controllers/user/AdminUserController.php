<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        
        return view('admin.users.index',compact('users','roles'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).{6,}$/', // Minimal 1 huruf & 1 angka
                // 'confirmed' // Password harus sama dengan konfirmasi password
            ],
            'role_id' => 'required|exists:roles,id_role',
        ];
        
        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf dan satu angka.',
            // 'password.confirmed' => 'Konfirmasi password tidak cocok.',

            'role_id.required' => 'Role wajib diisi.',
            'role_id.exists' => 'Role tidak ditemukan.',
        ];
        
        $request->validate($rules, $messages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->back()->with('success','Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users','email')->ignore($id),
            ],
            'password' => 'nullable',
            'role_id' => 'required|exists:roles,id_role',
        ];

        // CEK JIKA ADA PERUBAHAN PADA PASSWORD
        if ($request->password) {
            $rules = [
                'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).{6,}$/', // Minimal 1 huruf & 1 angka
                ],
            ];
        }
        
        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf dan satu angka.',
            // 'password.confirmed' => 'Konfirmasi password tidak cocok.',

            'role_id.required' => 'Role wajib diisi.',
            'role_id.exists' => 'Role tidak ditemukan.',
        ];
        
        $request->validate($rules, $messages);

        $user = User::find($id);

        // CEK APAKAH USER ADA ATAU TIDAK
        if (!$user) {
            return redirect()->back()->with('error','Pengguna tidak ditemukan.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->back()->with('success','Pengguna berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = User::find($id);
        // CEK APAKAH USER ADA ATAU TIDAK
        if (!$user) {
            return redirect()->back()->with('error','Pengguna tidak ditemukan.');
        }
        $user->delete();

        return redirect()->back()->with('success','Pengguna berhasil dihapus.');
    }
}