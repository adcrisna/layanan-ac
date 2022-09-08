<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Jasa;
use App\Models\Kategori;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Barang";
        $data['nama'] = Auth::user()->nama_user;
        $data['id'] = Auth::user()->id;
        $data['barang'] = Barang::get();
        return view('Admin/data_barang',$data);
    }
    public function simpanBarang(Request $request)
		{
            $cek_barang = Barang::where('barang_id','=',$request->barang_id)->first();
            if (empty($cek_barang)) {
                $namafoto = $request->barang_id." ".date("Y-m-d H-i-s");
                $extention = $request->file('foto_barang')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/uploads';
                $request->file('foto_barang')->move($destination,$photo);

                $data=array(
                    'barang_id'=>$request->barang_id,
                    'nama_barang'=>$request->nama,
                    'harga_barang'=>$request->harga,
                    'stok_barang'=>$request->stok,
                    'kondisi_barang'=>$request->kondisi,
                    'foto_barang'=>$photo,
                );
                Barang::insert($data);
                \Session::flash('msg_simpan','Data Barang Berhasil Ditambah!');
                return \Redirect::back();
            }else{
                \Session::flash('msg_hapus','ID Barang Sudah Ada!');
                return \Redirect::back();
            }
		}
	public function hapusBarang(Request $request)
		{
			$data = Barang::where('barang_id','=',$request->barang_id);
			$query = $data->first();
            if(\File::exists(public_path('uploads/'.$query->foto_barang))){
                \File::delete(public_path('uploads/'.$query->foto_barang));
            }else{
                \Session::flash('msg_hapus','Foto Barang Gagal Dihapus!');
			return \Redirect::back();
            }

			$data->delete();
	        \Session::flash('msg_hapus','Data Barang Berhasil Dihapus!');
			return \Redirect::back();
		}
	public function editBarang(Request $request)
		{
            if (empty($request->foto_baru)) {
                $data=array(
                    'nama_barang'=>$request->nama,
                    'harga_barang'=>$request->harga,
                    'stok_barang'=>$request->stok,
                    'kondisi_barang'=>$request->kondisi,
                    
                );
                Barang::where('barang_id','=',$request->barang_id)->update($data);
                \Session::flash('msg_update','Data Barang Berhasil Diupdate!');
                return Redirect::back();
            }else{
                $data=array(
                    'nama_barang'=>$request->nama,
                    'harga_barang'=>$request->harga,
                    'stok_barang'=>$request->stok,
                    'kondisi_barang'=>$request->kondisi,
                );
                if ($request->file('foto_baru')){

                    $cek_foto = Barang::where('barang_id','=',$request->barang_id)->first();

                    if(\File::exists(public_path('uploads/'.$cek_foto->foto_barang))){
                        \File::delete(public_path('uploads/'.$cek_foto->foto_barang));
                    }else{
                        \Session::flash('msg_hapus','Gagal Update Foto!');
                        return Redirect::back();
                    }
                    
                        $namafoto = $request->barang_id." ".date("Y-m-d H-i-s");
                        $extention = $request->file('foto_baru')->extension();
                        $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                        $destination = base_path() .'/public/uploads';
                        $request->file('foto_baru')->move($destination,$photo);
                        $data['foto_barang'] = $photo;
                    }
                Barang::where('barang_id','=',$request->barang_id)->update($data);
                \Session::flash('msg_update','Data Barang Berhasil Diupdate!');
                return Redirect::back();
            }
		}
}
