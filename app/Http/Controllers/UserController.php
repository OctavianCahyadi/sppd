<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user= Users::orderBy('created_at','DESC')->paginate(5);
        return view('user',compact('user'));
    }
    public function delete(Request $request)
    {
        $user = Users::findOrFail($request->datadelete);
        $user ->delete();
        return redirect('/user')->with('success','Data user berhasil dihapus.');

    }
}
