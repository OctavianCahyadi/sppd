<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $setting= Setting::orderBy('created_at','DESC')->paginate(5);
        $pegawai= Pegawai::orderBy('created_at','DESC')->get();
        return view('setting',compact('setting','pegawai'));
    }
    public function edit()
    {
        $pegawai= Pegawai::orderBy('created_at','DESC')->paginate(5);
        return view('edit_setting',compact('pegawai'));
    }
    public function editanggaran($id)
    {
        $setting = Setting::findOrFail($id);
        return view('edit_setting_anggaran',compact('setting'));
    }
    public function updateAnggaran(Request $request, $id)
    {
        $setting= Setting::findOrFail($id);
        $setting->mata_anggaran=$request->mata;
        $setting->tahun_anggaran=$request->tahun;
        $setting->save();
        return redirect('/setting')->with('success','Data Setting Anggaran berhasil diubah.');
    }
    public function updateKadis(Request $request,$id)
    {
        $setting= Setting::findOrFail($id);
        $setting->id_kadis=$request->id;
        $setting->save();
        return redirect('/setting')->with('success','Data Setting Kepala Dinas berhasil diubah.');
    }
    public function updateBendahara(Request $request,$id)
    {
        $setting= Setting::findOrFail($id);
        $setting->id_bendahara=$request->id;
        $setting->save();
        return redirect('/setting')->with('success','Data Setting Bendahara berhasil diubah.');
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;         
        $pegawai = DB::table('table_karyawan')
        ->where('nama','like',"%".$cari."%")
        ->paginate();
        return view('edit_setting',compact('pegawai'));
    }

}
