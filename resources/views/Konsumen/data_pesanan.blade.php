@extends('layouts.konsumen')
@section('css')

@endsection

@section('content')
      <section class="content-header">
        <br/>
        <br/>
        <ol class="breadcrumb">
          <li><a href="{{ route('home_konsumen') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Data Pesanan</li>
        </ol>
      </section>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
           @if(\Session::has('msg_selesai'))
            <h5> <div class="alert alert-info">
            {{ \Session::get('msg_selesai')}}
            </div></h5>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pesanan</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID Pesanan</th>
                  <th>No Pesanan</th>
                  <th>Tanggal Pengerjaan</th>
                  <th>Jam Pengerjaan</th>
                  <th>Total Pembayaran</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                @foreach($pesanan as $key => $value)
                <tr>
                  <td>{{ $value->transaksi_id }}</td>
                  <td>{{ $value->no_pesanan }}</td>
                  <td>{{ $value->tanggal_transaksi }}</td>
                  <td>{{ $value->jam_transaksi }}</td>
                  <td>Rp.{{ number_format($value->total_bayar,0,',','.') }}</td>
                  <td>@if ($value->status_transaksi == "Menunggu Konfirmasi")
                    <span class="label label-warning">{{ $value->status_transaksi }}</span>
                  @elseif ($value->status_transaksi == "Diproses")
                     <span class="label label-primary">{{ $value->status_transaksi }}</span>
                  @elseif ($value->status_transaksi == "Konfirmasi Selesai")
                     <span class="label label-info">{{ $value->status_transaksi }}</span>
                  @elseif ($value->status_transaksi == "Selesai")
                       <span class="label label-success">{{ $value->status_transaksi }}</span>
                  @endif
                 </td>
                 <td>
                    <a href="{{ route('detail_pesanan',$value->transaksi_id) }}" class="button btn btn-xs btn-default"><i class="fa fa-eye"></i> Detail</a>&nbsp;
                </td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
        
      </section>
      <!-- /.content -->
 @endsection

@section('javascript')

@endsection
