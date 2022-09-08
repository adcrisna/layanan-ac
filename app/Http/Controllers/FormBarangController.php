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

class FormBarangController extends Controller
{
    public function formBarang()
    {
        $data['title'] = "Form Pemesanan Barang";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['layanan'] = Jasa::get();
        $data['barang'] = Barang::get();
        $data['keranjang'] = Keranjang::where('id','=',Auth::User()->id)
        ->join('barang','keranjang.barang_id','=','barang.barang_id')->get();
        return view('Konsumen/form_barang',$data);
    }
    public function tambahPesanan(Request $request)
    {
        if ($request->jumlah>$request->stok) {
            \Session::flash('msg_stok_kurang','Stok Produk Tidak Mencukupi, Kurangi Jumlah Produk');
            return \Redirect::back();
        }else{

        $total = $request->harga_barang * $request->jumlah;
        $cekBarang = Barang::where('barang_id','=',$request->barang_id)->first();
        $stokLama = $cekBarang->stok_barang;
        $stokBaru = $stokLama-$request->jumlah;

        $barang=array(
            'stok_barang'=>$stokBaru
        );
        Barang::where('barang_id','=',$request->barang_id)->update($barang);

        $data=array(
                'barang_id' => $request->barang_id,
                'jumlah_beli'=> $request->jumlah,
                'harga'=> $total,
                'id'=>$request->id_user,
            );
        Keranjang::insert($data);
        \Session::flash('msg_simpan_pesanan','Data Pesanan Berhasil Ditambah!');
        return \Redirect::back();
        }
    }
    public function hapusPesanan(Request $request)
    {
        $data = Keranjang::where('keranjang_id','=',$request->keranjang_id);
        $query = $data->first();
        $barang = Barang::where('barang_id','=',$query->barang_id)->first();
        $jmlh = $query->jumlah_beli;
        $stokLama = $barang->stok_barang;
        $stokBaru = $stokLama + $jmlh;
        $stok=array(
            'stok_barang'=>$stokBaru
        );
        Barang::where('barang_id','=',$query->barang_id)->update($stok);
        $data->delete();
        \Session::flash('msg_hapus_pemesanan','Data Pesanan Berhasil Dihapus!');
        return \Redirect::back();
    }
    
    public function buatPesanan(Request $request)
    {
        $no_pesanan = date('d-m-Y').'-'.rand(1,99999).'';
        if (empty($request->bukti_bayar)) {
            \Session::flash('msg_gagal_pesan','Silahkan Masukan Bukti Pembayaran!');
            return Redirect::back();
       }else{
            $cekTanggal = Transaksi::whereDate('tanggal_transaksi','=',$request->tanggal)
            ->where('jam_transaksi','=',$request->jam)->first();

            if (!empty($cekTanggal)) {
                \Session::flash('msg_gagal_pesan','Silahkan Pilih Jam Pengerjaan Lainnya!');
                return Redirect::back();
            }else{
                $namafoto = "Bukti Bayar"." ".$no_pesanan;
                $extention = $request->file('bukti_bayar')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/uploads';
                $request->file('bukti_bayar')->move($destination,$photo);

                $data=array(
                    'no_pesanan'=> $no_pesanan,
                    'tanggal_transaksi' => $request->tanggal,
                    'jam_transaksi'=> $request->jam,
                    'total_bayar'=> $request->total_bayar,
                    'bukti_bayar'=> $photo,
                    'status_transaksi'=> "Menunggu Konfirmasi",
                    'catatan' => $request->catatan,
                    'id'=> $request->id_user,
                );
                Transaksi::insert($data);

                $psn = $request->keranjang_id;
                    for ($i=0; $i <count($psn) ; $i++) {    
                        $data_pesan = Keranjang::where('keranjang_id',$request->keranjang_id[$i])->get();
                        foreach ($data_pesan as $key => $value) {

                            $data=array(
                            'no_pesanan'=>$no_pesanan,
                            'barang_id'=>$value->barang_id,
                            'jumlah'=>$value->jumlah_beli,
                            'sub_total'=>$value->harga
                        );

                        DetailTransaksi::insert($data);
                    }
                }
                $data = Keranjang::where('id','=',$request->id_user);
                $query = $data->get();
                $data->delete();
                \Session::flash('msg_success','Terima Kasih, Pesanan Berhasil Dibuat!');
                return Redirect::route('home_konsumen');
                
            }
       }
    }
}
