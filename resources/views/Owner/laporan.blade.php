@extends('layouts.owner')
@section('css')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Laporan</li>
    </ol>
    <br/>
  </section>
  <section class="content">
           @if(\Session::has('msg_simpan'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_simpan')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_hapus'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_hapus')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_update'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_update')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
          <div class="box box-danger">
              <div class="box-header">
              <h3 class="box-title">Data Laporan</h3>
                <div class="pull-right">
                <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-print"><i class="fa fa-print"></i> Print</button>
                </div>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="data-barang">
                      <thead>
                      <tr>
                            <th>ID Transaksi</th>
                            <th>No Pesanan</th>
                            <th>Tanggal Pengerjaan</th>
                            <th>Jam Pengerjaan</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                        </tr>
                        @foreach($laporan as $key => $value)
                        <tr>
                            <td>{{ $value->transaksi_id }}</td>
                            <td>{{ $value->no_pesanan }}</td>
                            <td>{{ $value->tanggal_transaksi }}</td>
                            <td>{{ $value->jam_transaksi }}</td>
                            <td>Rp.{{ number_format($value->total_bayar,0,',','.') }}</td>
                            <td>
                                <span class="label label-success">{{ $value->status_transaksi }}</span>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
              </div>
            </div>          
      </div>
    </div>
  </section>
  <div class="modal fade" id="modal-print" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Pilih Periode Laporan</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('print_laporan') }}" method="POST" target="_blank">
          {{ csrf_field() }}
            <div class="form-group has-feedback">
              <label>Dari Tanggal :</label>
              <input type="date" name="tgl_dari" class="form-control" required>
            </div>
            <div class="form-group has-feedback">
              <label>Sampai Tanggal :</label>
              <input type="date" name="tgl_sampai" class="form-control" required>
            </div>
            <div class="row">
              <div class="col-xs-4 col-xs-offset-8">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-print"> </i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  var table = $('#data-barang').DataTable();
</script>
@endsection