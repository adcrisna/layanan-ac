<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Jasa;
use App\Models\Kategori;

class LayananController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Layanan";
        $data['nama'] = Auth::user()->nama_user;
        $data['id'] = Auth::user()->id;
        $data['layanan'] = Jasa::join('kategori','jasa.kategori_id','=','kategori.kategori_id')->get();
        $data['kategori'] = Kategori::get();
        return view('Admin/data_layanan',$data);
    }
    public function simpanLayanan(Request $request)
		{
			$data=array(
				'nama_jasa'=>$request->nama,
                'harga_jasa'=>$request->harga,
                'kategori_id'=>$request->kategori,
                'detail_jasa'=>$request->detail,
			);
			Jasa::insert($data);
			\Session::flash('msg_simpan','Data Layanan Berhasil Ditambah!');
			return Redirect::back();
		}
	public function hapusLayanan(Request $request)
		{
			$data = Jasa::where('jasa_id','=',$request->jasa_id);
			$query = $data->first();
			$data->delete();
	        \Session::flash('msg_hapus','Data Layanan Berhasil Dihapus!');
			return \Redirect::back();
		}
	public function editLayanan(Request $request)
		{
			$data=array(
				'nama_jasa'=>$request->nama,
                'harga_jasa'=>$request->harga,
                'kategori_id'=>$request->kategori,
                'detail_jasa'=>$request->detail,
			);
			Jasa::where('jasa_id','=',$request->jasa_id)->update($data);
			\Session::flash('msg_update','Data Layanan Berhasil Diupdate!');
			return Redirect::back();
		}
}
