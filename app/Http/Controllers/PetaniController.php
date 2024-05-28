<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataDesa; // Import model DataDesa
use App\Models\DataAkunPoktan; // Import model DataAkunPoktan
use App\Models\DataAkunPetani; // Import model DataAkunPetani
use Illuminate\Support\Facades\Storage; // Import Storage
use Illuminate\Support\Facades\Hash; // Import Hash

class PetaniController extends Controller
{
    public function register()
    {
        $data_desa = DataDesa::all();
        $data_poktan = DataAkunPoktan::all();

        return view('register', ['data_desa' => $data_desa, 'data_poktan' => $data_poktan]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username_petani' => 'required|string|max:255|unique:data_akun_petani,username_petani',
            'nama_petani' => 'required|string|max:255',
            'ttl_petani' => 'required|date',
            'nik' => 'required|string|max:16|unique:data_akun_petani,nik',
            'pekerjaan' => 'required|string|max:255',
            'alamat_petani' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'id_desa' => 'required|exists:data_desa,id_desa',
            'id_poktan' => 'required|exists:data_akun_poktan,id_poktan',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Proses penyimpanan file gambar

        // Simpan data petani ke database
        $petani = new DataAkunPetani();
        $petani->username_petani = $request->input('username_petani');
        $petani->nama_petani = $request->input('nama_petani');
        $petani->ttl_petani = $request->input('ttl_petani');
        $petani->nik = $request->input('nik');
        $petani->pekerjaan = $request->input('pekerjaan');
        $petani->alamat_petani = $request->input('alamat_petani');
        $petani->no_tlp = $request->input('no_telp');
        $petani->id_desa = $request->input('id_desa');
        $petani->id_poktan = $request->input('id_poktan');
        $petani->password = Hash::make($request->input('password'));

        $petani->save();

        return redirect()->route('login')->with('success', 'Registrasi Petani berhasil!');
    }
    public function showPeminjaman()
    {
        return view('layout.Peminjaman');
    }

    public function showFormTambah()
    {
        return view('layout.FormTambah');
    }

    public function showProfilPetani()
{
    // Mendapatkan data akun petani, data desa, dan data poktan
    $akunPetani = DataAkunPetani::findOrFail(auth()->id());
    $dataDesa = DataDesa::findOrFail($akunPetani->id_desa);
    $dataPoktan = DataAkunPoktan::findOrFail($akunPetani->id_poktan);

    // Mengirim data ke view
    return view('layout.profilpetani', [
        'akunPetani' => $akunPetani,
        'dataDesa' => $dataDesa,
        'dataPoktan' => $dataPoktan,
    ]);
}


    public function showEditProfilPetani()
    {
        // Mendapatkan data akun petani, data desa, dan data poktan
    $akunPetani = DataAkunPetani::findOrFail(auth()->id());
    $dataDesa = DataDesa::findOrFail($akunPetani->id_desa);
    $dataPoktan = DataAkunPoktan::findOrFail($akunPetani->id_poktan);

    // Mengirim data ke view
    return view('layout.editprofilpetani', [
        'akunPetani' => $akunPetani,
        'dataDesa' => $dataDesa,
        'dataPoktan' => $dataPoktan,
        ]);
    }

    public function updatePetani(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_petani' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mendapatkan data akun petani yang sedang login
        $petani = DataAkunPetani::findOrFail(auth()->id());

        // Memperbarui data petani dengan input yang diterima
        $petani->nama_petani = $request->input('nama_petani');
        $petani->pekerjaan = $request->input('pekerjaan');
        $petani->no_tlp = $request->input('no_telp');

        // Jika foto baru diunggah, maka simpan foto yang baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            Storage::disk('public')->delete($petani->foto_profil);

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $petani->foto_profil = $fotoPath;
        }

        // Simpan perubahan ke database
        $petani->save();

        // Redirect ke halaman profil petani dengan pesan sukses
        return redirect()->route('layout.profilpetani')->with('success', 'Profil berhasil diperbarui.');
    }

   

}