<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PenggunaController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Pengguna";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $data['pengguna'] = User::get();
        return view('Admin/data_pengguna',$data);
    }
    public function simpanPengguna(Request $request)
    {
        $cek_username = User::where('username','=',$request->username)->first();
       if (empty($cek_username)) {
            $user = User::create([
                'nama_user'=> $request->nama,
                'username' => $request->username,
                'password'=> bcrypt($request->password),
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'level'=> $request->level,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            \Session::flash('msg_simpan','Berhasil Menambahkan Data Pengguna!!');
            return \Redirect::route('data_pengguna');
       }else{
            \Session::flash('msg_hapus','Username Sudah Ada!!');
            return \Redirect::route('data_pengguna');
       }
    }
    public function editPengguna(Request $request)
    {
        if (empty($request->password)) {
            $data=array(
                'nama_user'=>$request->nama,
                'alamat'=>$request->alamat,
                'no_hp'=>$request->no_hp,
                'level'=>$request->level,
            );
            User::where('id','=',$request->id)->update($data);
            \Session::flash('msg_update','Data Pengguna Berhasil di Update!');
            return Redirect::route('data_pengguna');
        }else{
            $data=array(
                'nama_user'=>$request->nama,
                'password'=>bcrypt($request->password),
                'alamat'=>$request->alamat,
                'no_hp'=>$request->no_hp,
                'level'=>$request->level,
            );
            User::where('id','=',$request->id)->update($data);
            \Session::flash('msg_update','Data Pengguna Berhasil di Update!');
            return Redirect::route('data_pengguna');
        }
    }
    public function hapusPengguna(Request $request)
    {
        $user = User::where('id','=',$request->id);
		$query_user = $user->first();
        $user->delete();

        \Session::flash('msg_hapus','Data Pengguna Berhasil Dihapus!');
			return \Redirect::route('data_pengguna');
    }
}
