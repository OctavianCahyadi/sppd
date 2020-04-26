<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai= Pegawai::orderBy('created_at','DESC')->paginate(5);
        return view('pegawai',compact('pegawai'));
    }
    public function edit($id)
    {
        $url="/update-pegawai/$id";
        $tombol="Simpan";
        $pegawai= Pegawai::findOrFail($id);
        return view('create_pegawai', compact('pegawai','url','tombol'));
    }
    public function create()
    {
        $url="/store-pegawai";
        $tombol="Tambah Pegawai";
        return view('create_pegawai',compact('url','tombol'));
    }
    public function store(Request $request)
    {
        $pegawai =new Pegawai;
        $pegawai->nama=$request->nama;
        $pegawai->nip=$request->nip;
        $pegawai->jabatan=$request->jabatan;
        $pegawai->pangkat=$request->pangkat;
        $pegawai->golongan=$request->golongan;
        $pegawai->save();

        return redirect('/pegawai')->with('success','Data Pegawai berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $pegawai= Pegawai::findOrFail($id);
        $pegawai->nama=$request->nama;
        $pegawai->nip=$request->nip;
        $pegawai->jabatan=$request->jabatan;
        $pegawai->pangkat=$request->pangkat;
        $pegawai->golongan=$request->golongan;
        $pegawai->save();

        return redirect('/pegawai')->with('success','Data Pegawai berhasil diubah.');
    }
    public function delete(Request $request)
    {
        $pegawai = Pegawai::findOrFail($request->datadelete);
        $pegawai ->delete();
        return redirect('/pegawai')->with('success','Data Pegawai berhasil dihapus.');

    }
    public function cari(Request $request)
    {
        $cari = $request->cari;         
        $pegawai = DB::table('table_karyawan')
        ->where('nama','like',"%".$cari."%")
        ->paginate();
        return view('pegawai',compact('pegawai'));
    }
}
