<?php

namespace App\Http\Controllers;

use App\Models\DataAkunPemerintah;
use App\Models\DataAkunPetani;
use App\Models\DataDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\DataAkunPoktan; // Model Poktan
use App\Models\PeminjamanModal;

class PoktanController extends Controller
{
    public function register()
    {
        $data_desa = DataDesa::all();
        $data_pemerintah = DataAkunPemerintah::all();
        // Mengambil semua data desa dari model

        return view('registerpoktan', ['data_desa' => $data_desa, 'data_pemerintah' => $data_pemerintah]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username_poktan' => 'required|string|max:255',
            'nama_poktan' => 'required|string|max:255',
            'alamat_poktan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'id_desa' => 'required|exists:data_desa,id_desa',
            'id_pemerintah' => 'required|exists:data_akun_pemerintah,id_pemerintah',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_poktan','public');
        }

        $poktan = new DataAkunPoktan();
        $poktan->username_poktan = $request->username_poktan;
        $poktan->nama_poktan = $request->nama_poktan;
        $poktan->alamat_poktan = $request->alamat_poktan;
        $poktan->no_tlp = $request->no_telp;
        $poktan->id_desa = $request->id_desa;
        $poktan->id_pemerintah = $request->id_pemerintah;
        $poktan->password = Hash::make($request->password);
        $poktan->save();

        return redirect()->route('login')->with('success', 'Registrasi Poktan berhasil!');
    }
    public function peminjaman()
    {
        // Ambil semua data peminjaman modal dari database
        $peminjaman = PeminjamanModal::select('data_pengajuan_modal.*')
        ->join('data_akun_petani','data_pengajuan_modal.id_petani','data_akun_petani.id_petani')
        ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_akun_petani.id_poktan')
        ->get();
        
        // Mengirim data ke view layout.Peminjaman
        return view('poktan.peminjaman', ['peminjaman' => $peminjaman]);
    }

    public function profilPoktan()
    {
        $dataPoktan = DataAkunPoktan::findOrFail(auth()->id());
        $dataPemerintah = DataAkunPemerintah::findOrFail($dataPoktan->id_pemerintah);

        return view('poktan.profilpoktan', [
            'dataPoktan'=>$dataPoktan,
            'dataPemerintah'=>$dataPemerintah,
        ]);
    }

    public function editProfilPoktan()
    {
        $dataPoktan = DataAkunPoktan::findOrFail(auth()->id());
        $dataPemerintah = DataAkunPemerintah::findOrFail($dataPoktan->id_pemerintah);


        return view('poktan.editprofilpoktan', [
            'dataPoktan'=>$dataPoktan,
            'dataPemerintah'=>$dataPemerintah,
        ]);
    }

    public function updatePoktan(Request $request)
    {
    // Validasi input
    $request->validate([
        'nama_poktan' => 'required|string|max:255',
        'alamat_poktan' => 'required|string|max:255',
        'no_telp' => 'required|string|max:15',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Mendapatkan data akun petani yang sedang login
    $poktan = DataAkunPoktan::findOrFail(auth()->id());

    // Memperbarui data petani dengan input yang diterima
    $poktan->nama_poktan = $request->input('nama_poktan');
    $poktan->alamat_poktan = $request->input('alamat_poktan');
    $poktan->no_tlp = $request->input('no_telp');

    // Jika foto baru diunggah, maka simpan foto yang baru
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        Storage::disk('public')->delete($poktan->foto_profil);

        // Simpan foto baru
        $fotoPath = $request->file('foto')->store('foto_poktan', 'public');
        $poktan->foto_profil = $fotoPath;
    }

    // Simpan perubahan ke database
    $poktan->save();

    // Redirect ke halaman profil petani dengan pesan sukses
    return redirect()->route('poktan.profilpoktan')->with('success', 'Profil berhasil diperbarui.');
    }

    public function showPemerintah()
    {
        $pemerintahs = DataAkunPemerintah::select('data_akun_pemerintah.*','data_kota.kota')
        ->join('data_akun_poktan','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
        ->join('data_kota','data_kota.id_kota','data_akun_pemerintah.id_kota')
        ->where('id_poktan',auth()->id())
        ->first();
        return view('Poktan.pemerintah',['pemerintah' => $pemerintahs]);
    }
    public function showDetailPemerintah(Request $request)
    {
        $pemerintahs = DataAkunPemerintah::select('data_akun_pemerintah.*','data_kota.kota')
        ->join('data_akun_poktan','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
        ->join('data_kota','data_kota.id_kota','data_akun_pemerintah.id_kota')
        ->where('data_akun_pemerintah.id_pemerintah',$request->id)
        ->first();
        return view('Poktan.lihatpemerintah',['pemerintah' => $pemerintahs]);
    }
    public function showPetani()
    {
        $petanis = DataAkunPetani::select('data_akun_petani.*','data_akun_poktan.*','data_akun_pemerintah.*','data_desa.desa','data_kota.kota')
        ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_akun_petani.id_poktan')
        ->join('data_akun_pemerintah','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
        ->join('data_desa','data_akun_petani.id_desa','data_desa.id_desa')
        ->join('data_kota','data_kota.id_kota','data_desa.id_kota')
        ->where('data_akun_poktan.id_poktan',auth()->id())
        ->get();
        return view('Poktan.petani',['petanis' => $petanis]);
    }
    public function showDetailPetani(Request $request)
    {
        $petani = DataAkunPetani::select('data_akun_petani.*','data_akun_poktan.*','data_akun_pemerintah.*','data_desa.desa','data_kota.kota')
        ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_akun_petani.id_poktan')
        ->join('data_akun_pemerintah','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
        ->join('data_desa','data_akun_petani.id_desa','data_desa.id_desa')
        ->join('data_kota','data_kota.id_kota','data_desa.id_kota')
        ->where('data_akun_petani.id_petani',$request->id)
        ->first();
        // dd($request->id_petani);
        return view('Poktan.lihatpetani',['petani' => $petani]);
    }
}