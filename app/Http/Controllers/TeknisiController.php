<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Jasa;
use App\Models\Barang;
use App\Models\DetailTransaksi;

class TeknisiController extends Controller
{
    public function index(){
        $data['title'] = "Dashboard";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['transaksi'] = Transaksi::where('status_transaksi','=',"Diproses")->where('teknisi','=',Auth::User()->nama_user)->get();
        return view('Teknisi/teknisi_home',$data);
    }
    function logout(){
        Auth::logout();
        return \Redirect::to('/');
    }
    public function dataPekerjaan()
    {
        $data['title'] = "Data Pekerjaan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['transaksi'] = Transaksi::where('status_transaksi','=',"Diproses")->where('teknisi','=',Auth::User()->nama_user)->get();
        return view('Teknisi/data_pekerjaan',$data);
    }
    public function detailPemesanan(Request $request)
    {
        $data['title'] = "Detail Pemesanan Layanan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['layanan'] = Jasa::join('kategori','jasa.kategori_id','=','kategori.kategori_id')->get();
        $data['barang'] = Barang::get();
        $data['transaksi'] = Transaksi::where('transaksi_id','=',$request->transaksi_id)
        ->join('users','transaksi.id','=','users.id')->first();
        $data['detail'] = Transaksi::where('transaksi_id','=',$request->transaksi_id)
        ->join('detail_transaksi','transaksi.no_pesanan','=','detail_transaksi.no_pesanan')
        ->join('jasa','jasa.jasa_id','=','detail_transaksi.jasa_id')
        ->join('users','transaksi.id','=','users.id')->get();
        $data['detail_barang'] = Transaksi::where('transaksi_id','=',$request->transaksi_id)
        ->join('detail_transaksi','transaksi.no_pesanan','=','detail_transaksi.no_pesanan')
        ->join('barang','barang.barang_id','=','detail_transaksi.barang_id')
        ->join('users','transaksi.id','=','users.id')->get();
        return view('Teknisi/detail_pemesanan',$data);
    }
    public function simpanPemesanan(Request $request)
    {
        if (empty($request->bukti_bayar)) {
                $data=array(
                    'total_bayar'=> $request->total_bayar,
                    'status_transaksi'=> "Konfirmasi Selesai",
                );
                Transaksi::where('transaksi_id','=',$request->transaksi_id)->update($data);
                \Session::flash('msg_success','Terima Kasih, Detail Pemesanan Berhasil Ditambah!');
                return Redirect::route('data_pekerjaan');
       }else{
                $namafoto = "Bukti Bayar"." ".$request->no_pesanan;
                $extention = $request->file('bukti_bayar')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/uploads';
                $request->file('bukti_bayar')->move($destination,$photo);

                $data=array(
                    'total_bayar'=> $request->total_bayar,
                    'bukti_bayar'=> $photo,
                    'status_transaksi'=> "Konfirmasi Selesai",
                );
                Transaksi::where('transaksi_id','=',$request->transaksi_id)->update($data);
                \Session::flash('msg_success','Terima Kasih, Detail Pemesanan Berhasil Ditambah!');
                return Redirect::route('data_pekerjaan');
                
       }
    }
    public function tambahLayanan(Request $request)
    {
        $total = $request->harga_jasa * $request->jumlah;
        $data=array(
                'jasa_id' => $request->jasa_id,
                'jumlah'=> $request->jumlah,
                'sub_total'=> $total,
                'no_pesanan'=>$request->no_pesanan,
            );
        DetailTransaksi::insert($data);
        \Session::flash('msg_success','Data Pesanan Berhasil Ditambah!');
        return \Redirect::back();
        
    }
    public function hapusLayanan(Request $request)
    {
        $data = DetailTransaksi::where('detail_transaksi_id','=',$request->detail_transaksi_id);
        $query = $data->first();
        $data->delete();
        \Session::flash('msg_hapus_pemesanan','Data Pesanan Berhasil Dihapus!');
        return \Redirect::back();
    }
}
