<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // dd($request);
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Menyimpan input email ke dalam sesi
        Session::flash('email', $request->input('email'));
        
        $credentials = $request->only('email', 'password');

        // Mencoba otentikasi pengguna
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role_id == '1') {
                return redirect()->route('teknisi.dashboard');
            }
            elseif ($user->role_id == '2') {
                return redirect()->route('admin.dashboard');
            }
            elseif ($user->role_id == '3') {
                return redirect()->route('pertamina.dashboard');
            }
        }

        return redirect()->back()->with('error', 'Email atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('Anda berhasil logout');
    }
}