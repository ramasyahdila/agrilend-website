<?php

namespace App\Http\Controllers\Poktan;

use App\Http\Controllers\Controller;
use App\Models\DataLaporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function showLaporan()
    {
        $laporan = DataLaporan::select('data_laporan.*','data_status_laporan.*','data_akun_poktan.*')
        ->join('data_status_laporan','data_status_laporan.id_status_laporan','data_laporan.id_status_laporan')
        ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_laporan.id_poktan')
        ->where('data_akun_poktan.id_poktan',auth()->id())->get();

        return view('Poktan.laporan', ['laporan' => $laporan]);
    }
    public function showBuatLaporan()
    {
        return view('Poktan.buatlaporan');
    }
    public function showUbahLaporan($id_laporan)
    {
        $laporan = DataLaporan::find($id_laporan);
        return view('Poktan.ubahlaporan',[
            'id_laporan' => $id_laporan,
            'nama_file' => $laporan->laporan
        ]);
    }
    public function showDetailLaporan($id)
    {
        $laporan = DataLaporan::select('data_laporan.*','data_status_laporan.*','data_akun_poktan.*')
        ->join('data_status_laporan','data_status_laporan.id_status_laporan','data_laporan.id_status_laporan')
        ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_laporan.id_poktan')
        ->where('data_laporan.id_laporan',$id)->first();
        return view('Poktan.lihatlaporan', [
            'laporan' => $laporan
        ]);
    }
    public function buatLaporan(Request $request)
    {
        $request->validate([
            'laporan' => 'required|mimes:pdf|max:10000'
        ]);
        $dokumen = $request->file('laporan');
        $dokumen->storePubliclyAs('laporans', $dokumen->getClientOriginalName(), 'public');
        $nama_file = $dokumen->getClientOriginalName();
        if(DataLaporan::insert([
            'id_poktan' => auth()->id(),
            'laporan' => $nama_file,
            'id_status_laporan' => 1
        ])) {
            return redirect()->route('poktan.laporan')->with('success','Laporan berhasil dikirim');
        };
        return back()->withErrors(['error' => 'Laporan gagal dikirim']);
    }
    public function ubahLaporan(Request $request)
    {
        $request->validate([
            'id_laporan' => 'required',
            'laporan' => 'required|mimes:pdf|max:10000'
        ]);
        $dokumen = $request->file('laporan');
        $dokumen->storePubliclyAs('laporans', $dokumen->getClientOriginalName(), 'public');
        $nama_file = $dokumen->getClientOriginalName();
        if(DataLaporan::where('id_laporan', $request->id_laporan)->update([
            'laporan' => $nama_file,
        ])) {
            return redirect()->route('poktan.laporan')->with('success','Laporan berhasil diperbarui');
        };
        return back()->withErrors(['error' => 'Laporan gagal diperbarui']);
    }
}
