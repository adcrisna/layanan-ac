<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Kategori;

class AdminController extends Controller
{
    public function index(){
        $data['title'] = "Dashboard";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['konsumen'] = User::where('level',"Konsumen")->get();
        $data['kategori'] = Kategori::get();
        $data['transaksi'] = Transaksi::where('status_transaksi','=','Selesai')->get();
        return view('Admin/admin_home',$data);
    }
    function logout(){
        Auth::logout();
        return \Redirect::to('/');
    }
}
