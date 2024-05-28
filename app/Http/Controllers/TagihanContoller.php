<?php

namespace App\Http\Controllers;

use App\Models\DataMetodeBayar;
use App\Models\DataPembayaran;
use App\Models\DataPengajuanModal;
use App\Models\DataTagihan;
use App\Models\DataTidakBisaBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TagihanContoller extends Controller
{
    public function showTagihan()
    {
        $tagihan = DataTagihan::select('data_tagihan.*','data_status_tagihan.status_tagihan','data_pengajuan_modal.*')
        ->join('data_status_tagihan','data_status_tagihan.id_status_tagihan','data_tagihan.id_status_tagihan')
        ->join('data_pengajuan_modal','data_pengajuan_modal.id_pengajuan','data_tagihan.id_pengajuan')
        ->where('id_petani',auth()->id())->get();
        
        return view('layout.Tagihan', ['tagihan' => $tagihan]);
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
            ->join('data_tidak_bisa_bayar','data_tagihan.id_tagihan','data_tidak_bisa_bayar.id_tagihan')
            ->join('data_metode_bayar','data_metode_bayar.id_metode_bayar','data_tidak_bisa_bayar.id_metode_bayar')
            ->join('data_akun_poktan','data_akun_poktan.id_poktan','data_akun_petani.id_poktan')
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
        return view('layout.LihatTagihan', ['tagihan' => $tagihan, 'metode_bayar' => $metode_bayar]);
    }
    public function bayarTagihan(Request $request)
    {
        $validated = $request->validate([
            'id_tagihan' => 'required',
            'metode_bayar' => 'required|numeric',
        ],[
            'id_tagihan.required' => 'Harap pilih metode pembayaran lalu klik bayar',
            'metode_bayar.required' => 'Harap pilih metode pembayaran lalu klik bayar',
            'metode_bayar.numeric' => 'Harap pilih metode pembayaran lalu klik bayar',
        ]);
        $tagihan = DataTagihan::where('id_tagihan',$validated['id_tagihan'])->update(['id_status_tagihan' => 5]);
        if($tagihan) {
            $pembayaran = new DataPembayaran();
            $pembayaran->tgl_pembayaran = now()->toDateTimeString();
            $pembayaran->id_tagihan = $validated['id_tagihan'];
            $pembayaran->id_metode_bayar = $validated['metode_bayar'];
            $pembayaran->save();

            return back()->with('success', 'Tagihan berhasil dibayar.');
        }
        return back()->withErrors(['error' => 'Tagihan gagal dibayar.']);
    }
    public function showTidakBayarTagihan(Request $request)
    {
        $validated = $request->validate([
            'id_tagihan' => 'required',
            'metode_bayar' => 'required|numeric',
        ],[
            'metode_bayar.required' => 'Harap pilih metode pembayaran lalu klik bayar',
            'metode_bayar.numeric' => 'Harap pilih metode pembayaran lalu klik bayar',
        ]);
        $data_pengajuan_modal = DataPengajuanModal::select('data_pengajuan_modal.bunga')
        ->join('data_tagihan','data_pengajuan_modal.id_pengajuan','data_tagihan.id_pengajuan')
        ->where('id_tagihan',$validated['id_tagihan'])->first();
        return view('Layout.TidakBisaBayar',[
            'id_tagihan' => $validated['id_tagihan'],
            'id_metode_bayar' => $validated['metode_bayar'],
            'bunga'=> $data_pengajuan_modal->bunga
        ]);
    }
    public function tidakBayarTagihan(Request $request)
    {
        $validated = $request->validate([
            'id_tagihan' => 'required',
            'id_metode_bayar' => 'required|numeric',
            'bunga' => 'required|numeric',
        ],[
            'metode_bayar.required' => 'Harap pilih metode pembayaran lalu klik bayar',
            'metode_bayar.numeric' => 'Harap pilih metode pembayaran lalu klik bayar',
        ]);
        $tidak_bisa_bayar = new DataTidakBisaBayar();
        $tidak_bisa_bayar->bunga = $validated['bunga'];
        $tidak_bisa_bayar->id_tagihan = $validated['id_tagihan'];
        $tidak_bisa_bayar->id_metode_bayar = $validated['id_metode_bayar'];
        $tidak_bisa_bayar->save();

        DataTagihan::where('id_tagihan',$validated['id_tagihan'])->update(['id_status_tagihan' => 2]);

        return redirect()->route('layout.Tagihan')->with('success', 'Data tagihan diperbarui.');
    }
    public function bayarTidakBayarTagihan(Request $request)
    {
        $validated = $request->validate([
            'id_tagihan' => 'required',
            'id_metode_bayar' => 'required|numeric',
            'bunga' => 'required|numeric',
        ]);
        $tidak_bisa_bayar = DataTidakBisaBayar::where('id_tagihan',$validated['id_tagihan'])->first();
        $tidak_bisa_bayar->bunga = $validated['bunga'];
        $tidak_bisa_bayar->tgl_kembali_bunga = now()->toDateTimeString();
        $tidak_bisa_bayar->save();

        DataTagihan::where('id_tagihan',$validated['id_tagihan'])->update(['id_status_tagihan' => 4]);

        return back()->with('success', 'Bunga berhasil dibayar.');
    }

}
