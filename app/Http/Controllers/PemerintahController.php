<?php

namespace App\Http\Controllers;

use App\Models\DataAkunPoktan;
use Illuminate\Http\Request;
use App\Models\DataKota;
use App\Models\DataAkunPemerintah;



class PemerintahController extends Controller
{
    public function register()
    {
        $data_kota = DataKota::all(); // Mengambil semua data kota dari model

        return view('registerpemerintah', ['data_kota' => $data_kota]);
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'username_pemerintah' => 'required|string|max:255|unique:data_akun_pemerintah,username_pemerintah',
        'password' => 'required|string|min:8|confirmed',
        'nama_pemerintah' => 'required|string|max:255',
        'id_kota' => 'required|exists:data_kota,id_kota',
        'no_tlp' => 'required|string|max:15',
    ]);

    // Proses penyimpanan file gambar

    // Simpan data ke database
    $pemerintah = new DataAkunPemerintah();
    $pemerintah->username_pemerintah = $request->username_pemerintah;
    $pemerintah->password = bcrypt($request->password);
    $pemerintah->nama_pemerintah = $request->nama_pemerintah;
    $pemerintah->id_kota = $request->id_kota;
    $pemerintah->no_tlp = $request->no_tlp;
    $pemerintah->save();

    // Redirect dengan pesan sukses
    return redirect()->route('login')->with('success', 'Registrasi Pemerintah berhasil!');
}
public function showPoktan()
{
    $poktans = DataAkunPoktan::select('data_akun_poktan.*','data_akun_pemerintah.*','data_desa.desa','data_kota.kota')
    ->join('data_akun_pemerintah','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
    ->join('data_desa','data_akun_poktan.id_desa','data_desa.id_desa')
    ->join('data_kota','data_kota.id_kota','data_desa.id_kota')
    ->where('data_akun_pemerintah.id_pemerintah',auth()->id())
    ->get();
    return view('Pemerintah.poktan',['poktans' => $poktans]);
}
public function showDetailPoktan(Request $request)
{
    $poktan = DataAkunPoktan::select('data_akun_poktan.*','data_akun_pemerintah.*','data_desa.desa','data_kota.kota')
    ->join('data_akun_pemerintah','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
    ->join('data_desa','data_akun_poktan.id_desa','data_desa.id_desa')
    ->join('data_kota','data_kota.id_kota','data_desa.id_kota')
    ->where('data_akun_poktan.id_poktan',$request->id)
    ->first();
    return view('Pemerintah.lihatpoktan',['poktan' => $poktan]);
}
public function showProfile()
{
    $pemerintah = DataAkunPemerintah::select('data_akun_pemerintah.*','data_kota.kota')
    ->join('data_akun_poktan','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
    ->join('data_kota','data_kota.id_kota','data_akun_pemerintah.id_kota')
    ->where('data_akun_pemerintah.id_pemerintah',auth()->id())
    ->first();
    return view('Pemerintah.lihatdiriku',['pemerintah' => $pemerintah]);
}
public function showEditProfile()
{
    $pemerintah = DataAkunPemerintah::select('data_akun_pemerintah.*','data_kota.kota')
    ->join('data_akun_poktan','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
    ->join('data_kota','data_kota.id_kota','data_akun_pemerintah.id_kota')
    ->where('data_akun_pemerintah.id_pemerintah',auth()->id())
    ->first();
    $kota = DataKota::all();
    return view('Pemerintah.ubahdirikubg',['pemerintah' => $pemerintah, 'kota' => $kota]);
}
public function editProfile(Request $request)
{
    // dd($request->all());
    $validated = $request->validate([
        'nama_pemerintah' => 'required',
        'no_telp' => 'required|numeric',
        'kota' => 'required',
    ]);
    $id_kota = DataKota::where('kota',$validated['kota'])->first();
    if(DataAkunPemerintah::where('id_pemerintah',auth()->id())->update([
        'nama_pemerintah' => $validated['nama_pemerintah'],
        'no_tlp' => $validated['no_telp'],
        'id_kota' => $id_kota->id_kota,
    ])) {
        return redirect()->route('pemerintah.profile')->with('success', 'Ubah profil berhasil!');
    }
    return back()->withErrors(['failed' => 'Gagal ubah profil!']);
    
}


}
