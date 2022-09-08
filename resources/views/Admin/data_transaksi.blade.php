@extends('layouts.admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Barang</li>
    </ol>
    <br/>
  </section>
  <section class="content">
           @if(\Session::has('msg_success'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_success')}}
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
                <h3 class="box-title">Data Transaksi</h3>
                
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
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($transaksi as $key => $value)
                        <tr>
                            <td>{{ $value->transaksi_id }}</td>
                            <td>{{ $value->no_pesanan }}</td>
                            <td>{{ $value->tanggal_transaksi }}</td>
                            <td>{{ $value->jam_transaksi }}</td>
                            <td>Rp.{{ number_format($value->total_bayar,0,',','.') }}</td>
                            <td>@if ($value->status_transaksi == "Menunggu Konfirmasi")
                                <span class="label label-warning">{{ $value->status_transaksi }}</span>
                            @elseif ($value->status_transaksi == "Selesai")
                                <span class="label label-primary">{{ $value->status_transaksi }}</span>
                            @elseif ($value->status_transaksi == "Konfirmasi Selesai")
                                <span class="label label-info">{{ $value->status_transaksi }}</span>
                                @elseif ($value->status_transaksi == "Diproses")
                                <span class="label label-success">{{ $value->status_transaksi }}</span>
                            @endif
                            </td>
                            <td>
                            @if ($value->status_transaksi == "Menunggu Konfirmasi")
                                <button class="button btn btn-xs btn-primary btn-edit-barang"><i class="fa fa-check"></i> Konfirmasi</button>&nbsp;
                                <a href="{{ route('tolak_transaksi',$value->transaksi_id) }}" class="button btn btn-xs btn-danger" onclick="return confirm('Apakah anda yakin ingin menolak Transaksi ?')"><i class="fa fa-close"></i> Tolak</a>&nbsp;
                                @elseif ($value->status_transaksi == "Diproses")
                                <a href="{{ route('detail_transaksi',$value->transaksi_id) }}" class="button btn btn-xs btn-success"><i class="fa fa-eye"></i> Detail</a>&nbsp;
                                @elseif ($value->status_transaksi == "Selesai")
                                <a href="{{ route('detail_transaksi',$value->transaksi_id) }}" class="button btn btn-xs btn-primary"><i class="fa fa-eye"></i> Detail</a>&nbsp;
                            @elseif ($value->status_transaksi == "Konfirmasi Selesai" || $value->status_transaksi == "Selesai")
                            <a href="{{ route('konfirmasi_proses',$value->transaksi_id) }}" class="button btn btn-xs btn-success" onclick="return confirm('Apakah anda yakin ingin menolak Transaksi ?')"><i class="fa fa-check"></i> Selesai</a>&nbsp;
                            <a href="{{ route('detail_transaksi',$value->transaksi_id) }}" class="button btn btn-xs btn-info"><i class="fa fa-eye"></i> Detail</a>&nbsp;
                            @endif
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
  <div class="modal fade" id="modal-form-edit-barang" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Edit Barang</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('konfirmasi_transaksi') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="hidden" name="transaksi_id" class="form-control" placeholder="ID Transaksi" readonly>
                </div>
                <div class="form-group has-feedback">
                    <label>Pilih Teknisi :</label>
                    <select name="teknisi" class="form-control" required>
                      @foreach($teknisi as $key => $value)
                      <option value="{{ $value->nama_user }}">{{ $value->nama_user }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
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

  $('#data-barang').on('click','.btn-edit-barang',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=transaksi_id]').val(row[0]);
    $('#modal-form-edit-barang').modal('show');
  });
</script>
@endsection