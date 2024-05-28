<?php

namespace App\Http\Controllers;

use App\Models\DataTagihan;
use Illuminate\Http\Request;
use App\Models\PeminjamanModal; // Import model PeminjamanModal
use App\Models\DataAkunPetani;
use App\Models\StatusPengajuanModal; // Import model DataAkunPetani
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function showPeminjaman()
    {
        // Ambil semua data peminjaman modal dari database
        $peminjaman = PeminjamanModal::with('status')->where('id_petani',auth()->id())->get();
        
        // Mengirim data ke view layout.Peminjaman
        return view('layout.Peminjaman', ['peminjaman' => $peminjaman]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'jml_pinjam' => 'required',
            'jml_diterima' => 'required',
            'bunga' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
        ]);
        
        // Mendapatkan data akun petani yang sedang login
        $petani = DataAkunPetani::findOrFail(auth()->id());

        // Simpan data peminjaman modal ke database
        $peminjaman = new PeminjamanModal();
        $peminjaman->id_petani = $petani->id_petani;
        $peminjaman->jml_pinjam = $request->input('jml_pinjam');
        $peminjaman->bunga = str_replace('.','',$request->input('bunga'));
        $peminjaman->jml_diterima = $request->input('jml_diterima'); // Menghitung jumlah diterima
        $peminjaman->tgl_kembali = $request->input('tgl_kembali');
        $peminjaman->id_status_pengajuan = 1; // Set status pengajuan, misalnya 1 untuk sedang diajukan
        
        $ok = $peminjaman->save();

        // Redirect ke halaman peminjaman dengan pesan sukses
        return redirect()->route('layout.Peminjaman')->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function destroy($id)
    {
    // Mencari peminjaman berdasarkan id
    $peminjaman = PeminjamanModal::findOrFail($id);

    // Menghapus data peminjaman
    $peminjaman->delete();

    // Redirect ke halaman peminjaman dengan pesan sukses
    return redirect()->route('layout.Peminjaman')->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function showDetailPetani($id)
    {
    $detailpeminjaman = PeminjamanModal::with('status')->findOrFail($id);
    return view('layout.LihatPeminjaman', compact('detailpeminjaman'));
    }

    public function showUbah($id)
    {
    $ubahpeminjaman = PeminjamanModal::with('status')->findOrFail($id);
    return view('layout.UbahPeminjaman', compact('ubahpeminjaman'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'jml_pinjam' => 'required|integer|min:500000',
            'jml_diterima' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    // Validasi bahwa jumlah diterima sama dengan jumlah pinjaman
                    $jml_pinjam = $request->input('jml_pinjam');
                    if ($value !== $jml_pinjam) {
                        $fail('Jumlah yang diterima harus sama dengan jumlah pinjaman.');
                    }
                },
            ],
            'bunga' => 'required|numeric|min:0',
            'tgl_pinjam' => 'required|date',
            'tenggat_kembali' => 'required|date|after:tgl_pinjam',
        ]);

        // Temukan peminjaman berdasarkan ID
        $ubahpeminjaman = PeminjamanModal::findOrFail($id);

        // Perbarui data peminjaman dengan data yang dikirimkan dari formulir
        $ubahpeminjaman->jml_pinjam = $request->input('jml_pinjam');
        $ubahpeminjaman->bunga = $request->input('bunga');
        $ubahpeminjaman->jml_diterima = $request->input('jml_diterima');
        $ubahpeminjaman->tenggat_kembali = $request->input('tenggat_kembali');

        // Simpan perubahan
        $ubahpeminjaman->save();

        // Redirect ke halaman peminjaman dengan pesan sukses
        return redirect()->route('layout.Peminjaman')->with('success', 'Peminjaman berhasil diperbarui.');
    }
    // Fungsi lainnya jika diperlukan

    public function konfirmDiterima(Request $request)
    {
        // dd($request->all());
        $request->validate(['id_pengajuan' => 'required']);
        $peminjaman = PeminjamanModal::findOrFail($request->id_pengajuan);
        $peminjaman->id_status_pengajuan = 3; // Diterima
        $peminjaman->save();

        DataTagihan::insert([
            'id_pengajuan' => $peminjaman->id_pengajuan,
            'id_status_tagihan' => 1,
        ]);

        return back()->with('success', 'Pengajuan berhasil dikonfirmasi.');
    }
}
