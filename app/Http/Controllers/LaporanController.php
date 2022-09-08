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
use Fpdf;

class LaporanController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Laporan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['laporan'] = Transaksi::where('status_transaksi','=',"Selesai")->get();
        return view('Admin/data_laporan',$data);
    }
}
