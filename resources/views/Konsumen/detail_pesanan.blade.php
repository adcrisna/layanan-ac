@extends('layouts.konsumen')
@section('css')

@endsection

@section('content')
      <section class="content-header">
          <br/>
          <br/>
        <ol class="breadcrumb">
          <li><a href="{{ route('home_konsumen') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="{{ route('data_pesanan',$id) }}"> Data Pesanan </a></li>
          <li class="active">Detail Data Pesanan</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Azzam Teknik Jaya
            <div class="pull-right">
              <a  class="btn btn-xs btn-warning" href="{{ route('data_pesanan',$id) }}"><i class="fa fa-close"></i> Kembali </a>
            </div>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Admin, Azzam Teknik Jaya</strong><br>
            Jalan Tuperev No.40/54<br>
            Kedawung, Cirebon, Jawa Barat 45153<br>
            Phone: (231) 123-5432<br>
            Email: azzamteknikjaya@gmail.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{ $pesanan->nama_user }}</strong><br>
            {{ $pesanan->alamat }}<br>
            Phone: {{ $pesanan->no_hp }}<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice :</b> {{ $pesanan->no_pesanan }}
          <br>
          <br>
          <b>Order ID:</b> {{ $pesanan->transaksi_id }}
          <br>
          <b>Tanggal Pemesanan :</b> {{ $pesanan->tanggal_transaksi }} {{ $pesanan->jam_transaksi }}
          <br>
           <b>Status :</b> {{ $pesanan->status_transaksi }}
            <br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <div class="pull-left">
            <p class="lead">Detail Pesanan :</p>
          </div>
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Keterangan</th>
              <th>No Pesanan</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              @foreach($barang as $key => $value)
            <tr>
              <td>{{ $value->jumlah }}</td>
              <td>{{ $value->nama_barang }}</td>
              <td>{{ $value->no_pesanan }}</td>
              <td>Rp.{{ number_format($value->sub_total,0,',','.') }}</td>
            </tr>
            @endforeach
            @foreach($layanan as $key => $value)
            <tr>
              <td>{{ $value->jumlah }}</td>
              <td>{{ $value->nama_jasa }}</td>
              <td>{{ $value->no_pesanan }}</td>
              <td>Rp.{{ number_format($value->sub_total,0,',','.') }}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Bukti Pembayaran :</p>
          <br/>
            <img width="150px" height="120px" src="{{ asset('uploads/'.$pesanan->bukti_bayar) }}">
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Total Pembayaran</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="display: none;">{{ $total = 0 }}</th>
                 @foreach($barang as $key => $value)
                 <th style="display: none;">{{ $total += $value->sub_total }}</th>
                 @endforeach
                 @foreach($layanan as $key => $value)
                 <th style="display: none;">{{ $total += $value->sub_total }}</th>
                 @endforeach
                <td>Rp.{{ number_format($total,0,',','.') }}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>Rp.{{ number_format($pesanan->total_bayar,0,',','.') }}</td>
              </tr>
            </table>
          </div>
          @if ($pesanan->status_transaksi == "Konfirmasi Selesai")
            <a href="{{ route('konfirmasi_selesai',$pesanan->transaksi_id) }}" class="button btn btn-md btn-success" onclick="return confirm('apakah anda yakin ?')"><i class="fa fa-check"></i>Selesai</a>
          @endif
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <br/>
      <br/>
      <!-- this row will not appear when printing -->
    </section>
      <!-- /.content -->
 @endsection

@section('javascript')

@endsection
