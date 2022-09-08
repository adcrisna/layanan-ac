@extends('layouts.admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Jabatan</li>
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
                <h3 class="box-title">Data Layanan</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-form-tambah-layanan"><i class="fa fa-plus"> Tambah Pengguna</i></button>
                </div>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="data-layanan">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nama Jasa</th>
                          <th>Harga Jasa</th>
                          <th style="display: none;">ID Kategori</th>
                          <th>Kategori</th>
                          <th>Detail Jasa</th>
                          <th>Aksi</th>       
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($layanan as $key => $value)
                        <tr>
                          <td>{{ $value->jasa_id }}</td>
                          <td>{{ $value->nama_jasa }}</td>
                          <td>{{ $value->harga_jasa }}</td>
                          <td style="display: none;">{{ $value->kategori_id }}</td>
                          <td>{{ $value->nama_kategori }}</td>
                          <td>{{ $value->detail_jasa }}</td>
                          <td width="120px">
                            <button class="btn btn-xs btn-success btn-edit-layanan"><i class="fa fa-edit"> Ubah</i></button> &nbsp;
                            <a href="{{ route('hapus_data_layanan',$value->jasa_id) }}"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah anda ingin menghapus data ini ?')" ><i class="fa fa-trash"> Hapus</i></button></a> 
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
  <div class="modal fade" id="modal-form-tambah-layanan" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Layanan</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('simpan_layanan') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama Layanan" required>
          </div>
          <div class="form-group has-feedback">
            <input type="number" name="harga" class="form-control" placeholder="Harga Layanan" required>
          </div>
          <div class="form-group has-feedback">
            <select name="kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategori as $key => $value)
                <option value="{{ $value->kategori_id }}">{{ $value->nama_kategori }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group has-feedback">
            <textarea name="detail" class="form-control" cols="5" rows="3" placeholder="Detail Jasa"></textarea>
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
    <div class="modal fade" id="modal-form-edit-layanan" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Edit Layanan</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('edit_layanan') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <label>ID Jasa</label>
                <input type="text" name="jasa_id" class="form-control" placeholder="Nama Layanan" readonly>
            </div>
            <div class="form-group has-feedback">
                <label>Nama Jasa</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Layanan" required>
            </div>
            <div class="form-group has-feedback">
                <label>Harga Jasa</label>
                <input type="number" name="harga" class="form-control" placeholder="Harga Layanan" required>
            </div>
            <div class="form-group has-feedback">
                <label>Kategori Jasa</label>
                <select name="kategori" class="form-control" required>
                    <option value="">Pilih Level</option>
                    @foreach($kategori as $key => $value)
                    <option value="{{ $value->kategori_id }}">{{ $value->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group has-feedback">
                <label>Detail Jasa</label>
                <textarea name="detail" class="form-control" cols="5" rows="3" placeholder="Detail Jasa"></textarea>
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
  var table = $('#data-layanan').DataTable();

  $('#data-layanan').on('click','.btn-edit-layanan',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=jasa_id]').val(row[0]);
    $('input[name=nama]').val(row[1]);
    $('input[name=harga]').val(row[2]);
    $('select[name=kategori]').val(row[3]);
    $('textarea[name=detail]').val(row[5]);
    $('#modal-form-edit-layanan').modal('show');
  });

  $('#modal-form-tambah-layanan').on('show.bs.modal',function(){
    $('input[name=jasa_id]').val('');
    $('input[name=nama]').val('');
    $('input[name=harga]').val('');
    $('textarea[name=detail]').val('');
    $('select[name=kategori]').val('');
  });
</script>
@endsection