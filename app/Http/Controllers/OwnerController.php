<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Jasa;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Keranjang;
use Fpdf;

class OwnerController extends Controller
{
    public function index(){
        $data['title'] = "Dashboard";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['konsumen'] = User::where('level',"Konsumen")->get();
        $data['kategori'] = Kategori::get();
        $data['transaksi'] = Transaksi::where('status_transaksi','=','Selesai')->get();
        return view('Owner/owner_home',$data);
    }
    public function laporan()
    {
        $data['title'] = "Data Laporan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['laporan'] = Transaksi::where('status_transaksi','=',"Selesai")->get();
        return view('Owner/laporan',$data);
    }
    public function printDataLaporan(Request $request)
    {
		$pdf = new fPdf('P','mm');
		$pdf::SetAutoPageBreak(true);
		$pdf::SetTitle("Data Laporan");
		$pdf::addPage('L','A4');
		$pdf::image( asset('cic.png'), $pdf::getX()+8, 8, 45 , 25,'PNG');
		$pdf::setX(80);
		$pdf::SetFont('Helvetica','B','13');
		$pdf::cell(135,6,"Data Laporan",0,2,'C');
		$pdf::SetFont('Helvetica','B','13');
		$pdf::cell(135,6,"Azzam Teknik Jaya",0,2,'C');
		$pdf::SetFont('Helvetica','','10');
		$pdf::cell(135,6,"Jl. Kesambi No. 202, Drajat, Kec. Kesambi, Kota Cirebon, Jawa Barat, 45133",0,2,'C');
		$pdf::SetFont('Helvetica','B','12');
		$pdf::cell(135,6,"",0,2,'C');
		$pdf::line(10,($pdf::getY()+3),290,($pdf::getY()+3));
		$pdf::ln();
			$tgl_dari = $request->tgl_dari;
			$tgl_sampai = $request->tgl_sampai;
			$dari = date('Y-m-d',strtotime($tgl_dari));
			$sampai = date('Y-m-d',strtotime($tgl_sampai));

		$pdf::SetFont('Helvetica','','11');
		$pdf::ln();
		$pdf::cell(60,6,'',0,0,'');
		$pdf::cell(35,6,'',0,0,'');
		$pdf::cell(40,6,"Tanggal : ".$dari." Sampai dengan ".$sampai,0,0,'');
		$pdf::cell(40,6,'',0,0,'');
		$pdf::ln();
		$pdf::ln();
		$pdf::SetFont('Helvetica','B','11');
		$pdf::cell(40,6,'No. Pesanan',1,0,'C');
        $pdf::cell(55,6,'Nama Konsumen',1,0,'C');
        $pdf::cell(45,6,'Tanggal',1,0,'C');
		$pdf::cell(65,6,'Ket. Transaksi',1,0,'C');
        $pdf::cell(30,6,'Jumlah',1,0,'C');
        $pdf::cell(45,6,'Total Harga',1,0,'C');
		$pdf::SetFont('Helvetica','','11');
		$pdf::ln();

			$nama = Auth::User()->nama_user;
            $barang = Transaksi::where('status_transaksi','=','Selesai')
            ->whereBetween('tanggal_transaksi',[$dari,$sampai])
            ->join('users','users.id','=','transaksi.id')
            ->join('detail_transaksi','detail_transaksi.no_pesanan','=','transaksi.no_pesanan')
            ->join('barang','barang.barang_id','=','detail_transaksi.barang_id')->get();
            $layanan = Transaksi::where('status_transaksi','=','Selesai')
            ->whereBetween('tanggal_transaksi',[$dari,$sampai])
            ->join('users','users.id','=','transaksi.id')
            ->join('detail_transaksi','detail_transaksi.no_pesanan','=','transaksi.no_pesanan')
            ->join('jasa','jasa.jasa_id','=','detail_transaksi.jasa_id')->get();

            foreach ($barang as $key => $value) {
                $pdf::cell(40,6,$value->no_pesanan,1,0,'C');
                $pdf::cell(55,6,$value->nama_user,1,0,'C');
                $pdf::cell(45,6,$value->tanggal_transaksi,1,0,'C');
                $pdf::cell(65,6,$value->nama_barang,1,0,'C');
                $pdf::cell(30,6,$value->jumlah,1,0,'C');
                $pdf::cell(45,6,'Rp. '.number_format($value->sub_total,0,',','.'),1,0,'C');
                $pdf::ln();
            }
            foreach ($layanan as $key => $value) {
                $pdf::cell(40,6,$value->no_pesanan,1,0,'C');
                $pdf::cell(55,6,$value->nama_user,1,0,'C');
                $pdf::cell(45,6,$value->tanggal_transaksi,1,0,'C');
                $pdf::cell(65,6,$value->nama_jasa,1,0,'C');
                $pdf::cell(30,6,$value->jumlah,1,0,'C');
                $pdf::cell(45,6,'Rp. '.number_format($value->sub_total,0,',','.'),1,0,'C');
                $pdf::ln();
            }
            
            $pendapatanbarang[] = 0;
			$pendapatanjasa[] = 0;

            foreach ($barang as $key => $value) {
                $pendapatanbarang[] = $value->sub_total;
            }
            foreach ($layanan as $key => $value) {
                $pendapatanjasa[] = $value->sub_total;
            }
            $pdf::ln();
			$pdf::ln();
			$pdf::cell(40,6,'',0,0,'C');
            $pdf::cell(55,6,'',0,0,'C');
            $pdf::cell(45,6,'Total Pendapatan :',0,0,'C');
            $pdf::cell(60,6,'Rp. '.number_format(array_sum($pendapatanbarang)+array_sum($pendapatanjasa),0,',','.'),0,0,'C');
            $pdf::cell(40,6,'',0,0,'C');
			$pdf::ln();
			$pdf::ln();
			$pdf::cell(40,6,'',0,0,'C');
            $pdf::cell(55,6,'',0,0,'C');
            $pdf::cell(45,6,'',0,0,'C');
            $pdf::cell(60,6,'',0,0,'C');
            $pdf::cell(40,6,'',0,0,'C');
			$pdf::cell(40,6,"Cirebon, ".date('d-M-Y'),0,0,'');
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
            $pdf::ln();
			$pdf::cell(40,6,'',0,0,'C');
            $pdf::cell(55,6,'',0,0,'C');
            $pdf::cell(45,6,'',0,0,'C');
            $pdf::cell(60,6,'',0,0,'C');
            $pdf::cell(55,6,'',0,0,'C');
			$pdf::cell(40,6,$nama,0,0,'');
		$pdf::Output(0);
		exit;
    }
    function logout(){
        Auth::logout();
        return \Redirect::to('/');
    }
}
