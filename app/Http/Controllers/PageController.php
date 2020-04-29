<?php

namespace App\Http\Controllers;

use App\Models\SPPD;
use App\Models\PPTK;
use App\Models\Setting;
use App\Models\Pegawai;
use App\Models\Tugas;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function dashboard()
    {
        $pegawai= Pegawai::select()->get();
        $pegawaicount=$pegawai->count();
        $sppd= Sppd::select()->get();
        $sppdcount=$sppd->count();
        $users= users::select()->get();
        $userscount=$users->count();
        return view('dashboard',compact('pegawaicount','sppdcount','userscount'));
    }
}
