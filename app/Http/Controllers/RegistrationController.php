<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAkunPetani; // Jika Anda menggunakan model di dalam controller

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi data masukan jika diperlukan

        // Simpan data ke dalam database
        DataAkunPetani::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            // Tambahkan kolom lainnya sesuai kebutuhan
        ]);

        // Redirect ke halaman setelah registrasi
        return redirect()->route('landingpage')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }
}