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

class FormLayananController extends Controller
{
    public function formLayanan()
    {
        $data['title'] = "Form Pemesanan Layanan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['layanan'] = Jasa::join('kategori','jasa.kategori_id','=','kategori.kategori_id')->get();
        $data['barang'] = Barang::get();
        return view('Konsumen/form_layanan',$data);
    }
    public function cekJam(Request $request){
        $jam = Transaksi::where('tanggal_transaksi','=',$request->tanggal)->pluck('jam_transaksi','jam_transaksi');
        return response()->json($jam);
    }
    public function buatLayanan(Request $request)
    {
            $no_pesanan = date('d-m-Y').'-'.rand(1,99999).'';
            $cekTanggal = Transaksi::whereDate('tanggal_transaksi','=',$request->tanggal)
            ->where('jam_transaksi','=',$request->jam)->first();

            if (!empty($cekTanggal)) {
                \Session::flash('msg_gagal_pesan','Silahkan Pilih Jam Pengerjaan Lainnya!');
                return Redirect::back();
            }else{
                $data=array(
                    'no_pesanan'=> $no_pesanan,
                    'tanggal_transaksi' => $request->tanggal,
                    'jam_transaksi'=> $request->jam,
                    'status_transaksi'=> "Menunggu Konfirmasi",
                    'catatan' => $request->catatan,
                    'id'=> Auth::User()->id
                );
                Transaksi::insert($data);
                \Session::flash('msg_success','Terima Kasih, Pesanan Berhasil Dibuat!');
                return Redirect::route('home_konsumen');
                
            }
    }
}
