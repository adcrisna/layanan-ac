<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Jasa;
use App\Models\Barang;

class KonsumenController extends Controller
{
    public function index(){
        $data['title'] = "Dashboard";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['layanan'] = Jasa::get();
        $data['barang'] = Barang::get();
        return view('Konsumen/konsumen_home',$data);
    }
    function logout(){
        Auth::logout();
        return \Redirect::to('/');
    }
    public function profile()
    {
        $data['title'] = "Profile";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['profile'] = User::where('id','=',Auth::User()->id)->first();
        return view('Konsumen/konsumen_profile',$data);
    }
    public function updateProfile(Request $request)
    {
        if (empty($request->password)) {
            $data=array(
                'nama_user'=>$request->nama,
                'alamat'=>$request->alamat,
                'no_hp'=>$request->no_hp,
            );
            User::where('id','=',$request->id)->update($data);
            \Session::flash('msg_update','Data Profile Berhasil di Update!');
            return Redirect::route('profile_konsumen');
        }else{
            $data=array(
                'nama_user'=>$request->nama,
                'password'=>bcrypt($request->password),
                'alamat'=>$request->alamat,
                'no_hp'=>$request->no_hp,
            );
            User::where('id','=',$request->id)->update($data);
            \Session::flash('msg_update','Data Profile Berhasil di Update!');
            return Redirect::route('profile_konsumen');
        }
    
    }
}
