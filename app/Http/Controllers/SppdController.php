<?php

namespace App\Http\Controllers;

use App\Models\SPPD;
use App\Models\PPTK;
use App\Models\Setting;
use App\Models\Pegawai;
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
        $tombol="Generate SPPD";
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
        $sppd->daerah=$request->daerah;
        $sppd->anggaran=$request->anggaran;
        $sppd->nama_petugas=$request->nama_petugas;
        $sppd->nip_petugas=$request->nip_petugas;
        $sppd->jabatan_petugas=$request->jabatan_petugas;
        $sppd->save();
        return view('petugas_sppd',compact('sppd'));
    }
    public function edit($id)
    {
        $url="/update-sppd/$id";
        $tombol="Simpan";
        $sppd= SPPD::findOrFail($id);
        $pptk= PPTK::orderBy('created_at','DESC')->get();
        $pegawai= Pegawai::orderBy('created_at','DESC')->get();
        return view('create_sppd', compact('sppd','url','tombol','pptk','pegawai'));
    }
    public function update(Request $request)
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
        $sppd->daerah=$request->daerah;
        $sppd->anggaran=$request->anggaran;
        $sppd->nama_petugas=$request->nama_petugas;
        $sppd->nip_petugas=$request->nip_petugas;
        $sppd->jabatan_petugas=$request->jabatan_petugas;
        $sppd->save();
        
        $pegawai= Pegawai::orderBy('created_at','DESC')->paginate(3);
        return view('petugas_sppd',compact('id','pegawai'));
    }
}
