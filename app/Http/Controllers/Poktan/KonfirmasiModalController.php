<?php

namespace App\Http\Controllers\Poktan;

use App\Http\Controllers\Controller;
use App\Models\DataPengajuanModal;
use App\Models\DataTagihan;
use Illuminate\Http\Request;


class KonfirmasiModalController extends Controller
{
    public function index()
    {
        $pengajuanmodals = DataPengajuanModal::all();

        return view('poktan.pages.konfirmasi_pengajuan.index', compact('pengajuanmodals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        $pengajuanmodals = DataPengajuanModal::where('id', $id)->first();

        return view('poktan.pages.konfirmasi_pengajuan.detail', compact('pengajuanmodals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function confirm(Request $request, $id){
        $pengajuanModal = DataPengajuanModal::find($id);
    
        if($pengajuanModal){
            $pengajuanModal->status = "Sudah Dikonfirmasi";
            
            $pengajuanModal->save();
            return redirect()->route('poktan.konfirmasi')->with('success', 'Data pengajuan modal berhasil dikonfirmasi.');
        } else {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
