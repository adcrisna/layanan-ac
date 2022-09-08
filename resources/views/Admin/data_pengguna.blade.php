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
                <h3 class="box-title">Data Pengguna</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-form-tambah-pengguna"><i class="fa fa-plus"> Tambah Pengguna</i></button>
                </div>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="data-pengguna">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nama Pengguna</th>
                          <th>Username</th>
                          <th>Alamat</th>
                          <th>No WhatsApp</th>
                          <th>Level</th>
                          <th>Aksi</th>       
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($pengguna as $key => $value)
                        <tr>
                          <td>{{ $value->id }}</td>
                          <td>{{ $value->nama_user }}</td>
                          <td>{{ $value->username }}</td>
                          <td>{{ $value->alamat }}</td>
                          <td>{{ $value->no_hp }}</td>
                          <td>{{ $value->level }}</td>
                          <td width="120px">
                            <button class="btn btn-xs btn-success btn-edit-pengguna"><i class="fa fa-edit"> Ubah</i></button> &nbsp;
                            <a href="{{ route('hapus_pengguna',$value->id) }}"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah anda ingin menghapus data ini ?')" ><i class="fa fa-trash"> Hapus</i></button></a> 
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
  <div class="modal fade" id="modal-form-tambah-pengguna" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Pengguna</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('simpan_pengguna') }}" method="post">
            {{ csrf_field() }}

          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama Pengguna" required>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="form-group has-feedback">
            <textarea name="alamat" class="form-control" cols="5" rows="3" placeholder="Alamat"></textarea>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="no_hp" class="form-control" placeholder="No Handphone/WhatsApp" required>
          </div>
          <div class="form-group has-feedback">
            <select name="level" class="form-control" required>
                <option value="">Pilih Level</option>
                <option value="Admin">Admin</option>
                <option value="Owner">Owner</option>
                <option value="Konsumen">Konsumen</option>
                <option value="Teknisi">Teknisi</option>
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
    <div class="modal fade" id="modal-form-edit-pengguna" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Edit Pengguna</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('edit_pengguna') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="hidden" name="id"  readonly class="form-control" placeholder=" ID Pengguna">
          </div>
          <div class="form-group has-feedback">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Pengguna" required>
          </div>
          <div class="form-group has-feedback">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" readonly>
          </div>
          <div class="form-group has-feedback">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" placeholder="Password Baru..">
          </div>
          <div class="form-group has-feedback">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" cols="5" rows="3" placeholder="Alamat"></textarea>
          </div>
          <div class="form-group has-feedback">
            <label>No WhatsApp</label>
            <input type="text" name="no_hp" class="form-control" placeholder="No Handphone/WhatsApp" required>
          </div>
          <div class="form-group has-feedback">
            <label>Level</label>
            <select name="level" class="form-control" required>
                <option value="Admin">Admin</option>
                <option value="Owner">Owner</option>
                <option value="Konsumen">Konsumen</option>
                <option value="Teknisi">Teknisi</option>
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
<script type="text/javascript">
  var table = $('#data-pengguna').DataTable();

  $('#data-pengguna').on('click','.btn-edit-pengguna',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=id]').val(row[0]);
    $('input[name=nama]').val(row[1]);
    $('input[name=username]').val(row[2]);
    $('textarea[name=alamat]').val(row[3]);
    $('input[name=no_hp]').val(row[4]);
    $('select[name=level]').val(row[5]);
    $('#modal-form-edit-pengguna').modal('show');
  });

  $('#modal-form-tambah-pengguna').on('show.bs.modal',function(){
    $('input[name=id]').val('');
    $('input[name=nama]').val('');
    $('input[name=username]').val('');
    $('textarea[name=alamat]').val('');
    $('input[name=no_hp]').val('');
    $('select[name=level]').val('');
  });
</script>
@endsection