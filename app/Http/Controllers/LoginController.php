<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function prosesLogin(Request $request){

    	if (Auth::attempt(['username'=>$request->username,'password'=>$request->password]))
        {
            if ((Auth::user()->level == "Admin")) 
            {
                return \Redirect()->to('/admin/home');
            }
            else if ((Auth::user()->level == "Owner"))
            {
                 return \Redirect()->to('/owner/home');
            }
            else if ((Auth::user()->level == "Konsumen"))
            {
                return \Redirect()->to('/konsumen/home');
            }
            else if ((Auth::user()->level == "Teknisi"))
            {
                return \Redirect()->to('/teknisi/home');
            }else{
                \Session::flash('msg_login','NIK Atau Password Salah!!!');
            return \Redirect::back();
            }
        }else{
            \Session::flash('msg_login','NIK Atau Password Salah!!');
            return \Redirect::back();
        }
    }

    public function daftar(){
        return view('daftar');
    }
    public function prosesDaftar(Request $request)
    {
        $cek_username = User::where('username','=',$request->username)->first();
        if (empty($cek_username)) {
             $user = User::create([
                 'nama_user'=> $request->nama,
                 'username' => $request->username,
                 'password'=> bcrypt($request->password),
                 'no_hp' => $request->no_hp,
                 'alamat' => $request->alamat,
                 'level'=> "Konsumen",
                 'created_at' => date('Y-m-d H:i:s'),
                 'updated_at' => date('Y-m-d H:i:s')
             ]);
 
             \Session::flash('msg_daftar','Berhasil Membuat Akun!!');
             return \Redirect::route('index');
        }else{
             \Session::flash('msg_gagal_daftar','Username Sudah Ada!!');
             return \Redirect::route('daftar');
        }
    }
}
