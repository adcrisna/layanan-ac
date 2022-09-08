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
                <h3 class="box-title">Data Kategori</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-form-tambah-kategori"><i class="fa fa-plus"> Tambah Kategori</i></button>
                </div>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="data-kategori">
                      <thead>
                        <tr>
                          <th>ID Kategori</th>
                          <th>Nama Kategori</th>
                          <th>Aksi</th>       
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($kategori as $key => $value)
                        <tr>
                          <td>{{ $value->kategori_id }}</td>
                          <td>{{ $value->nama_kategori }}</td>
                          <td width="330px">
                            <button class="btn btn-xs btn-success btn-edit-kategori"><i class="fa fa-edit"> Ubah</i></button> &nbsp;
                            <a href="{{ route('hapus_kategori',$value->kategori_id) }}"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah anda ingin menghapus data ini ?')" ><i class="fa fa-trash"> Hapus</i></button></a> 
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
  <div class="modal fade" id="modal-form-tambah-kategori" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Jabatan</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('simpan_kategori') }}" method="post">
            {{ csrf_field() }}

          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama Kategori">
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
    <div class="modal fade" id="modal-form-edit-kategori" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Edit Kecamatan</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('edit_kategori') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="kategori_id"  readonly class="form-control" placeholder=" ID Kategori">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama Kategori">
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
<script type="text/javascript">
  var table = $('#data-kategori').DataTable();

  $('#data-kategori').on('click','.btn-edit-kategori',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=kategori_id]').val(row[0]);
    $('input[name=nama]').val(row[1]);
    $('#modal-form-edit-kategori').modal('show');
  });

  $('#modal-form-tambah-kategori').on('show.bs.modal',function(){
    $('input[name=nama]').val('');
  });
</script>
@endsection