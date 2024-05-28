<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataAkunPetani;
use App\Models\DataAkunPoktan;
use App\Models\DataAkunPemerintah;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Menunjuk ke form login yang telah kita buat
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string|in:petani,poktan,pemerintah',
        ]);

        $credentials = $request->only('username', 'password');
        $role = $request->input('role');

        switch ($role) {
            case 'petani':
                if (Auth::guard('petani')->attempt(['username_petani' => $credentials['username'], 'password' => $credentials['password']])) {
                    $request->session()->regenerate();
                    return redirect()->intended(route('dashboard.petani'));
                }
                break;
            case 'poktan':
                if (Auth::guard('poktan')->attempt(['username_poktan' => $credentials['username'], 'password' => $credentials['password']])) {
                    $request->session()->regenerate();
                    return redirect()->intended(route('poktan.sidebarpoktan'));
                }
                break;
            case 'pemerintah':
                if (Auth::guard('pemerintah')->attempt(['username_pemerintah' => $credentials['username'], 'password' => $credentials['password']])) {
                    $request->session()->regenerate();
                    return redirect()->intended(route('dashboard.pemerintah'));
                }
                break;
        }

        return back()->withErrors([
            'username' => 'Login details are not valid',
        ])->withInput($request->only('username', 'role'));
    }

    public function logout(Request $request)
    {
        Auth::guard('petani')->logout();
        Auth::guard('poktan')->logout();
        Auth::guard('pemerintah')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/landingpage');
    }
}