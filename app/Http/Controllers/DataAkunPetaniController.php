<?php

namespace App\Http\Controllers;
use App\Models\DataAkunPetani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataAkunPetaniController extends Controller
{
    public function store(Request $request)
    {
    // Validasi data
    $validator = Validator::make($request->all(), [
        'password' => 'required|string',
        'nama_petani' => 'required|string',
        'ttl_petani' => 'required|date',
        'pekerjaan' => 'required|string',
        'alamat_petani' => 'required|string',
        'id_desa' => 'required|exists:desas,id', // Pastikan id_desa ada di tabel desas
        'no_telp' => 'required|string',
        'id_poktan' => 'required|exists:poktans,id', // Pastikan id_poktan ada di tabel poktans
        'nik' => 'required|string|unique:dataakunpetani', // Pastikan nik unik di tabel dataakunpetani
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Simpan data ke database
    $dataAkunPetani = new DataAkunPetani();
    $dataAkunPetani->password = $request->input('password');
    $dataAkunPetani->nama_petani = $request->input('nama_petani');
    $dataAkunPetani->ttl_petani = $request->input('ttl_petani');
    $dataAkunPetani->pekerjaan = $request->input('pekerjaan');
    $dataAkunPetani->alamat_petani = $request->input('alamat_petani');
    $dataAkunPetani->id_desa = $request->input('id_desa');
    $dataAkunPetani->no_telp = $request->input('no_telp');
    $dataAkunPetani->id_poktan = $request->input('id_poktan');
    $dataAkunPetani->nik = $request->input('nik');
    $dataAkunPetani->save();

    // Redirect dengan pesan sukses
    return redirect()->back()->with('success', 'Data petani berhasil disimpan.');
    }
}