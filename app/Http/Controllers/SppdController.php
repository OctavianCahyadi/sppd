<?php

namespace App\Http\Controllers;

use App\Models\SPPD;
use App\Models\PPTK;
use App\Models\Setting;
use App\Models\Pegawai;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SppdController extends Controller
{
    public function index()
    {
        $sppd= SPPD::orderBy('created_at','DESC')->paginate(5);
        return view('sppd',compact('sppd'));
    }
    public function create()
    {
        $url="/store-sppd";
        $tombol="Masukkan Data Petugas";
        $pptk= PPTK::orderBy('created_at','DESC')->get();
        $pegawai= Pegawai::orderBy('created_at','DESC')->get();
        return view('create_sppd',compact('url','tombol','pptk','pegawai'));
    }
    public function store(Request $request)
    {
        $sppd =new SPPD;
        $sppd->no_surat=$request->no_surat;
        $sppd->tgl_surat=$request->tgl_surat;
        $sppd->tgl_pergi=$request->tgl_pergi;
        $sppd->tgl_kembali=$request->tgl_kembali;
        $sppd->acara=$request->acara;
        $sppd->tujuan=$request->tujuan;
        $sppd->angkutan=$request->angkutan;
        $sppd->tempat_berangkat=$request->tempat_berangkat;
        $sppd->lama=$request->lama;
        $sppd->pptk=$request->pptk;
        $sppd->dasar=$request->dasar;
        $sppd->daerah=$request->daerah;
        $sppd->anggaran=$request->anggaran;
        $sppd->nama_petugas=$request->nama_petugas;
        $sppd->nip_petugas=$request->nip_petugas;
        $sppd->jabatan_petugas=$request->jabatan_petugas;
        $sppd->save();

        $id=$sppd->id;
        $pegawai= Pegawai::orderBy('created_at','DESC')->paginate(1);
        return redirect("/create-pegawai-sppd/$id");
        
    }
    public function edit($id)
    {
        $url="/update-sppd/$id";
        $tombol="Edit Data Petugas";
        $sppd= SPPD::findOrFail($id);
        $pptk= PPTK::orderBy('created_at','DESC')->get();
        $pegawai= Pegawai::orderBy('created_at','DESC')->get();
        return view('create_sppd', compact('sppd','url','tombol','pptk','pegawai'));
    }
    public function update(Request $request,$id)
    {
        $sppd= SPPD::findOrFail($id);
        $sppd->no_surat=$request->no_surat;
        $sppd->tgl_surat=$request->tgl_surat;
        $sppd->tgl_pergi=$request->tgl_pergi;
        $sppd->tgl_kembali=$request->tgl_kembali;
        $sppd->acara=$request->acara;
        $sppd->tujuan=$request->tujuan;
        $sppd->angkutan=$request->angkutan;
        $sppd->tempat_berangkat=$request->tempat_berangkat;
        $sppd->lama=$request->lama;
        $sppd->pptk=$request->pptk;
        $sppd->dasar=$request->dasar;
        $sppd->daerah=$request->daerah;
        $sppd->anggaran=$request->anggaran;
        $sppd->nama_petugas=$request->nama_petugas;
        $sppd->nip_petugas=$request->nip_petugas;
        $sppd->jabatan_petugas=$request->jabatan_petugas;
        $sppd->save();
        
        $pegawai= Pegawai::orderBy('created_at','DESC')->paginate(1);
        return redirect("/create-pegawai-sppd/$id");
    }
    public function delete(Request $request)
    {
        $sppd= SPPD::findOrFail($request->datadelete);
        $sppd ->delete();
        return redirect('/sppd')->with('success','Data SPPD berhasil dihapus.');
    }
    public function cetak($id)
    {
        $sppd= SPPD::findOrFail($id);
        $setting= Setting::select()->get();
        $pegawai= Pegawai::select()->get();
        $tugas= Tugas::orderBy('created_at','ASC')->where('id_sppd',$id)->get();
        
        return view('cetak_sppd',compact(
            'sppd','setting','pegawai',
            'tugas'
        ));
    }
}
