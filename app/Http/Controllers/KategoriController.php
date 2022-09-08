<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Kategori";
        $data['nama'] = Auth::user()->nama_user;
        $data['id'] = Auth::user()->id;
        $data['kategori'] = Kategori::get();
        return view('Admin/data_kategori',$data);
    }
    public function simpanKategori(Request $request)
		{
			$data=array(
				'nama_kategori'=>$request->nama,
			);
			Kategori::insert($data);
			\Session::flash('msg_simpan','Data Kategori Berhasil Ditambah!');
			return \Redirect::back();
		}
	public function hapusKategori(Request $request)
		{
			$data = Kategori::where('kategori_id','=',$request->kategori_id);
			$query = $data->first();
			$data->delete();
	        \Session::flash('msg_hapus','Data Kategori Berhasil Dihapus!');
			return \Redirect::back();
		}
	public function editKategori(Request $request)
		{
			$data=array(
				'nama_kategori'=>$request->nama,
			);
			Kategori::where('kategori_id','=',$request->kategori_id)->update($data);
			\Session::flash('msg_update','Data Kategori Berhasil Diupdate!');
			return Redirect::back();
		}
}
