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
                <h3 class="box-title">Data Barang</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-form-tambah-barang"><i class="fa fa-plus"> Tambah Barang</i></button>
                </div>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="data-barang">
                      <thead>
                        <tr>
                          <th width="100px">Foto</th>
                          <th>ID Barang</th>
                          <th>Nama Barang</th>
                          <th>Harga Barang</th>
                          <th>Stok Barang</th>
                          <th>Kondisi Barang</th>
                          <th>Aksi</th>       
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($barang as $key => $value)
                        <tr>
                        <td><img width="100px" height="90px" src="{{ asset('uploads/'.$value->foto_barang) }}"></td>
                          <td>{{ $value->barang_id }}</td>
                          <td>{{ $value->nama_barang }}</td>
                          <td>{{ $value->harga_barang }}</td>
                          <td>{{ $value->stok_barang }}</td>
                          <td>{{ $value->kondisi_barang }}</td>
                          <td width="120px">
                            <button class="btn btn-xs btn-success btn-edit-barang"><i class="fa fa-edit"> Ubah</i></button> &nbsp;
                            <a href="{{ route('hapus_barang',$value->barang_id) }}"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah anda ingin menghapus data ini ?')" ><i class="fa fa-trash"> Hapus</i></button></a> 
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
  <div class="modal fade" id="modal-form-tambah-barang" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Barang</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('simpan_barang') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="barang_id" class="form-control" placeholder="ID Barang" required>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required>
          </div>
          <div class="form-group has-feedback">
            <input type="number" name="harga" class="form-control" placeholder="Harga Barang" required>
          </div>
          <div class="form-group has-feedback">
            <input type="number" name="stok" class="form-control" placeholder="Stok Barang" required>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="kondisi" class="form-control" placeholder="Kondisi Barang" required>
          </div>
          <div class="form-group has-feedback">
            <label>Foto Barang</label>
            <input type="file" name="foto_barang" class="form-control" placeholder="Foto Barang" required>
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
    <div class="modal fade" id="modal-form-edit-barang" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Edit Barang</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('edit_barang') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="text" name="barang_id" class="form-control" placeholder="ID Barang" readonly>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required>
                </div>
                <div class="form-group has-feedback">
                    <input type="number" name="harga" class="form-control" placeholder="Harga Barang" required>
                </div>
                <div class="form-group has-feedback">
                    <input type="number" name="stok" class="form-control" placeholder="Stok Barang" required>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="kondisi" class="form-control" placeholder="Kondisi Barang" required>
                </div>
                <div class="form-group has-feedback">
                    <label>Foto Barang Baru :</label>
                    <input type="file" name="foto_baru" class="form-control" placeholder="Foto Barang">
                </div>
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
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
<script type="text/javascript">
  var table = $('#data-barang').DataTable();

  $('#data-barang').on('click','.btn-edit-barang',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=barang_id]').val(row[1]);
    $('input[name=nama]').val(row[2]);
    $('input[name=harga]').val(row[3]);
    $('input[name=stok]').val(row[4]);
    $('input[name=kondisi]').val(row[5]);
    $('#modal-form-edit-barang').modal('show');
  });

  $('#modal-form-tambah-barang').on('show.bs.modal',function(){
    $('input[name=jasa_id]').val('');
    $('input[name=nama]').val('');
    $('input[name=harga]').val('');
    $('input[name=stok]').val('');
    $('input[name=kondisi]').val('');
  });
</script>
@endsection