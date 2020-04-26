<?php

namespace App\Http\Controllers;

use App\Models\PPTK;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PptkController extends Controller
{
    public function index()
    {
        $pptk= PPTK::orderBy('created_at','DESC')->get();
        $pegawai= Pegawai::orderBy('created_at','DESC')->get();
        return view('/pptk',compact('pptk','pegawai'));
    }
    public function create()
    {
        $pegawai= Pegawai::orderBy('created_at','DESC')->paginate(5);
        return view('create_pptk',compact('pegawai'));
    }
    public function store($id)
    {
        $pptk =new PPTK;
        $pptk->id_karyawan=$id;
        $pptk->save();

        return redirect('/pptk')->with('success','Data PPTK berhasil ditambahkan.');
    }
    public function delete(Request $request)
    {
        $pptk = PPTK::findOrFail($request->datadelete);
        $pptk ->delete();
        return redirect('/pptk')->with('success','Data PPTK berhasil dihapus.');
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;         
        $pegawai = DB::table('table_karyawan')
        ->where('nama','like',"%".$cari."%")
        ->paginate();
        return view('create_pptk',compact('pegawai'));
    }
}
