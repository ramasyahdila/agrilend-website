<?php

namespace App\Http\Controllers\Poktan;

use App\Http\Controllers\Controller;
use App\Models\DataMetodeBayar;
use App\Models\DataPembayaran;
use App\Models\DataTagihan;
use App\Models\DataTidakBisaBayar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PoktanTagihanController extends Controller
{
    public function showTagihan()
    {
        $tagihan = DataTagihan::select('data_tagihan.*','data_status_tagihan.status_tagihan','data_pengajuan_modal.*')
        ->join('data_status_tagihan','data_status_tagihan.id_status_tagihan','data_tagihan.id_status_tagihan')
        ->join('data_pengajuan_modal','data_pengajuan_modal.id_pengajuan','data_tagihan.id_pengajuan')
        ->join('data_akun_petani','data_akun_petani.id_petani','data_pengajuan_modal.id_petani')
        ->where('id_poktan',auth()->id())->get();

        return view('poktan.tagihan', ['tagihan' => $tagihan]);
    }
    public function showDetailTagihan($id)
    {
        if(DataPembayaran::where('id_tagihan',$id)->exists()) {
            $tagihan = DataTagihan::select('data_tagihan.*','data_status_tagihan.status_tagihan','data_pengajuan_modal.*','data_pembayaran.*','data_metode_bayar.metode_bayar','data_akun_petani.*','data_akun_poktan.nama_poktan')
            ->join('data_status_tagihan','data_status_tagihan.id_status_tagihan','data_tagihan.id_status_tagihan')
            ->join('data_pengajuan_modal','data_pengajuan_modal.id_pengajuan','data_tagihan.id_pengajuan')
            ->join('data_akun_petani','data_pengajuan_modal.id_petani','data_akun_petani.id_petani')
            ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_akun_petani.id_poktan')
            ->join('data_pembayaran','data_tagihan.id_tagihan','data_pembayaran.id_tagihan')
            ->join('data_metode_bayar','data_metode_bayar.id_metode_bayar','data_pembayaran.id_metode_bayar')
            ->where('data_tagihan.id_tagihan',$id)->first();
        } else if(DataTidakBisaBayar::where('id_tagihan',$id)->exists()) {
            $tagihan = DataTagihan::select('data_tagihan.*','data_status_tagihan.status_tagihan','data_pengajuan_modal.*','data_akun_petani.*','data_akun_poktan.nama_poktan','data_tidak_bisa_bayar.*','data_metode_bayar.metode_bayar')
            ->join('data_status_tagihan','data_status_tagihan.id_status_tagihan','data_tagihan.id_status_tagihan')
            ->join('data_pengajuan_modal','data_pengajuan_modal.id_pengajuan','data_tagihan.id_pengajuan')
            ->join('data_akun_petani','data_pengajuan_modal.id_petani','data_akun_petani.id_petani')
            ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_akun_petani.id_poktan')
            ->join('data_tidak_bisa_bayar','data_tagihan.id_tagihan','data_tidak_bisa_bayar.id_tagihan')
            ->join('data_metode_bayar','data_metode_bayar.id_metode_bayar','data_tidak_bisa_bayar.id_metode_bayar')
            ->where('data_tagihan.id_tagihan',$id)->first();
        } else {
            $tagihan = DataTagihan::select('data_tagihan.*','data_status_tagihan.status_tagihan','data_pengajuan_modal.*','data_akun_petani.*','data_akun_poktan.nama_poktan')
            ->join('data_status_tagihan','data_status_tagihan.id_status_tagihan','data_tagihan.id_status_tagihan')
            ->join('data_pengajuan_modal','data_pengajuan_modal.id_pengajuan','data_tagihan.id_pengajuan')
            ->join('data_akun_petani','data_pengajuan_modal.id_petani','data_akun_petani.id_petani')
            ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_akun_petani.id_poktan')
            ->where('data_tagihan.id_tagihan',$id)->first();
        }

        $metode_bayar = DataMetodeBayar::all();
        return view('Poktan.lihattagihan', ['tagihan' => $tagihan, 'metode_bayar' => $metode_bayar]);
    }
    public function konfirmTagihan(Request $request)
    {
        $validated = $request->validate([
            'id_tagihan' => 'required'
        ]);
        if(DataTagihan::where('id_tagihan',$validated['id_tagihan'])->update(['id_status_tagihan' => 6])) {
            return back()->with('success', 'Tagihan selesai.');
        }
        return back()->withErrors(['error' => 'Tagihan gagal selesai.']);
    }
    public function konfirmBungaTagihan(Request $request)
    {
        $validated = $request->validate([
            'id_tagihan' => 'required'
        ]);
        if(DataTagihan::where('id_tagihan',$validated['id_tagihan'])->update(['id_status_tagihan' => 1])) {
            return back()->with('success', 'Tagihan bunga berhasil dikonfirmasi.');
        }
        return back()->withErrors(['error' => 'Tagihan bunga gagal dikonfirmasi.']);
    }
    public function konfirmTidakTagihan(Request $request)
    {
        $validated = $request->validate([
            'id_tagihan' => 'required',
            'id_metode_bayar' => 'required'
        ]);
        if(DataTagihan::where('id_tagihan',$validated['id_tagihan'])->update(['id_status_tagihan' => 3])) {
            return back()->with('success', 'Tagihan berhasil diperbarui.');
        }
        return back()->withErrors(['error' => 'Tagihan gagal diperbarui.']);
    }
    public function download(Request $request)
    {
        $validated = $request->validate(['id_tagihan' => 'required']);
        $tagihan = DataTagihan::select('data_tagihan.*','data_status_tagihan.status_tagihan','data_pengajuan_modal.*','data_pembayaran.*','data_metode_bayar.metode_bayar','data_akun_petani.*','data_akun_poktan.nama_poktan')
        ->join('data_status_tagihan','data_status_tagihan.id_status_tagihan','data_tagihan.id_status_tagihan')
        ->join('data_pengajuan_modal','data_pengajuan_modal.id_pengajuan','data_tagihan.id_pengajuan')
        ->join('data_akun_petani','data_pengajuan_modal.id_petani','data_akun_petani.id_petani')
        ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_akun_petani.id_poktan')
        ->join('data_pembayaran','data_tagihan.id_tagihan','data_pembayaran.id_tagihan')
        ->join('data_metode_bayar','data_metode_bayar.id_metode_bayar','data_pembayaran.id_metode_bayar')
        ->where('data_tagihan.id_tagihan',$request->id_tagihan)->first();
        $pdf = PDF::loadView('PDF.template',['tagihan' => $tagihan]);
        return $pdf->download(now()->toDateTimeString() . '.pdf');
    }
}
