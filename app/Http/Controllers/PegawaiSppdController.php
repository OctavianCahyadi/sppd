<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\PPTK;
use App\Models\Setting;
use App\Models\Pegawai;
use App\Models\SPPD;
use App\Models\Tugas;
use Illuminate\Http\Request;

class PegawaiSppdController extends Controller
{
    public function create($id)
    {
        $pegawai= Pegawai::orderBy('created_at','ASC')->paginate();
        $sppd=SPPD::findOrFail($id);
        $tugas= Tugas::orderBy('created_at','ASC')->where('id_sppd',$id)->paginate();
        return view('petugas_sppd',compact('pegawai','sppd','tugas','id'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;         
        $pegawai = DB::table('table_karyawan')
        ->where('nama','like',"%".$cari."%")
        ->paginate();
        return view('petugas_sppd',compact('pegawai'));
    }
    public function store(Request $request)
    {
        $tugas = new Tugas;
        $tugas->id_pegawai=$request->id_pegawai;
        $tugas->id_sppd=$request->id_sppd;
        $tugas->save();
        $id=$request->id_sppd;
        return redirect("/create-pegawai-sppd/$id")->with('success','Data Petugas berhasil ditambahkan.');
    }
    public function delete(Request $request)
    {
        $id=$request->id_sppd;
        $Tugas= Tugas::findOrFail($request->datadelete);
        $Tugas ->delete();
        return redirect("/create-pegawai-sppd/$id")->with('success','Data Petugas berhasil dihapus.');
    }
}
