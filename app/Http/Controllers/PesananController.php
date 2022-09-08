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

class PesananController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Pesanan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['pesanan'] = Transaksi::where('id','=',Auth::User()->id)->get();
        return view('Konsumen/data_pesanan',$data);
    }
    public function detailPesanan(Request $request)
    {
        $data['title'] = "Detail Pesanan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['pesanan'] = Transaksi::where('transaksi_id','=',$request->transaksi_id)
        ->join('users','transaksi.id','=','users.id')->first();
        $data['barang'] = Transaksi::where('transaksi.transaksi_id',$request->transaksi_id)
        ->join('detail_transaksi','detail_transaksi.no_pesanan','=','transaksi.no_pesanan')
        ->join('barang','barang.barang_id','=','detail_transaksi.barang_id')->get();
        $data['layanan'] = Transaksi::where('transaksi.transaksi_id',$request->transaksi_id)
        ->join('detail_transaksi','detail_transaksi.no_pesanan','=','transaksi.no_pesanan')
        ->join('jasa','jasa.jasa_id','=','detail_transaksi.jasa_id')->get();
        return view('Konsumen/detail_pesanan',$data);
    }
    public function konfirmasiSelesai(Request $request)
    {
        $id = Auth::User()->id;
        $data=array(
            'status_transaksi'=>"Selesai"
        );
        Transaksi::where('transaksi_id','=',$request->transaksi_id)->update($data);
        \Session::flash('msg_selesai','Berhasil Melakukan Konfirmasi!');
        return Redirect::route('data_pesanan',$id);
    }
}
