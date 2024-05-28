<?php

namespace App\Http\Controllers;

use App\Models\DataLaporan;
use Illuminate\Http\Request;

class PemerintahLaporanController extends Controller
{
    public function showLaporan()
    {
        $laporan = DataLaporan::select('data_laporan.*','data_status_laporan.*','data_akun_poktan.*')
        ->join('data_status_laporan','data_status_laporan.id_status_laporan','data_laporan.id_status_laporan')
        ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_laporan.id_poktan')
        ->join('data_akun_pemerintah','data_akun_poktan.id_pemerintah','data_akun_pemerintah.id_pemerintah')
        ->where('data_akun_pemerintah.id_pemerintah',auth()->id())->get();

        return view('Pemerintah.laporan', ['laporan' => $laporan]);
    }

    public function showDetailLaporan(Request $request)
    {
        $laporan = DataLaporan::select('data_laporan.*','data_status_laporan.*','data_akun_poktan.*')
        ->join('data_status_laporan','data_status_laporan.id_status_laporan','data_laporan.id_status_laporan')
        ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_laporan.id_poktan')
        ->where('data_laporan.id_laporan',$request->id)->first();
        return view('Pemerintah.lihatlaporan', [
            'laporan' => $laporan
        ]);
    }

    public function konfirmLaporan(Request $request)
    {
        $validated = $request->validate([
            'id_laporan' => 'required'
        ]);
        if(DataLaporan::where('id_laporan',$validated['id_laporan'])->update(['id_status_laporan' => 2])) {
            return back()->with('success', 'Laporan berhasil dikonfirmasi.');
        }
        return back()->withErrors(['error' => 'Laporan gagal dikonfirmasi.']);
    }

}
