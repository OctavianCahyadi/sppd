<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai');
    }
    public function create()
    {
        return view('create_pegawai');
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

        return redirect('/pegawai');

    }
}
