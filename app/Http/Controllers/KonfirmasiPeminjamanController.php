<?php

namespace App\Http\Controllers;

use App\Models\DataTagihan;
use Illuminate\Http\Request;
use App\Models\PeminjamanModal;
use App\Models\DataAkunPetani;
use App\Models\StatusPengajuanModal;
use Illuminate\Support\Facades\Validator;

class KonfirmasiPeminjamanController extends Controller
{
    public function showDetailPoktan($id)
    {
    $detailpeminjaman = PeminjamanModal::with('status','petani')->findOrFail($id);
    return view('poktan.detailpeminjaman', compact('detailpeminjaman'));
    }

    public function konfirmasi($id)
    {
        $peminjaman = PeminjamanModal::findOrFail($id);
        $peminjaman->id_status_pengajuan = 2; // Status untuk Konfirmasi
        $peminjaman->save();

        return redirect()->route('poktan.peminjaman')->with('success', 'Pengajuan berhasil dikonfirmasi.');
    }

    public function tolak($id)
    {
        $peminjaman = PeminjamanModal::findOrFail($id);
        $peminjaman->id_status_pengajuan = 4; // Status untuk Tolak
        $peminjaman->save();

        return redirect()->route('poktan.peminjaman')->with('success', 'Pengajuan berhasil ditolak.');
    }
}
