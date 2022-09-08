<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Jasa;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Keranjang;

class TransaksiController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Transaksi";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['transaksi'] = Transaksi::get();
        $data['teknisi'] = User::where('level','=',"Teknisi")->get();
        return view('Admin/data_transaksi',$data);
    }
    public function detailTransaksi(Request $request)
    {
        $data['title'] = "Detail Transaksi";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['transaksi'] = Transaksi::where('transaksi_id','=',$request->transaksi_id)
        ->join('users','transaksi.id','=','users.id')->first();
        $data['barang'] = Transaksi::where('transaksi.transaksi_id',$request->transaksi_id)
        ->join('detail_transaksi','detail_transaksi.no_pesanan','=','transaksi.no_pesanan')
        ->join('barang','barang.barang_id','=','detail_transaksi.barang_id')->get();
        $data['layanan'] = Transaksi::where('transaksi.transaksi_id',$request->transaksi_id)
        ->join('detail_transaksi','detail_transaksi.no_pesanan','=','transaksi.no_pesanan')
        ->join('jasa','jasa.jasa_id','=','detail_transaksi.jasa_id')->get();
        return view('Admin/detail_transaksi',$data);
    }
    public function konfirmasiTransaksi(Request $request)
    {
        $data=array(
            'status_transaksi'=>"Diproses",
            'teknisi'=>$request->teknisi
        );
        Transaksi::where('transaksi_id','=',$request->transaksi_id)->update($data);
        \Session::flash('msg_success','Berhasil Melakukan Konfirmasi!');
        return Redirect::route('data_transaksi');
    }
    public function tolakTransaksi(Request $request)
    {  
        $data = Transaksi::where('transaksi_id','=',$request->transaksi_id);
		$query = $data->first();
		$data->delete();
        
        \Session::flash('msg_hapus','Data Transaksi Berhasil Ditolak!');
        return Redirect::route('data_transaksi');
    }
    public function konfirmasiProses(Request $request)
    {
        $data=array(
            'status_transaksi'=>"Selesai"
        );
        Transaksi::where('transaksi_id','=',$request->transaksi_id)->update($data);
        \Session::flash('msg_success','Berhasil Melakukan Konfirmasi!');
        return Redirect::route('data_transaksi');
    }
    
}
