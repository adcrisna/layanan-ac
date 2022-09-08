@extends('layouts.konsumen')
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_konsumen') }}"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="active">Profile</li>
    </ol>
  </section>
  <br/>
  <br/>
  <section class="content">
            @if(\Session::has('msg_update'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_update')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_gagal'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_gagal')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
         <div class="box">
          <div class="box-header">
                <h3 class="box-title"><b>Profile </b>{{ $profile->nama_user }}</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('home_konsumen') }}"><button class="btn btn-xs btn-warning"><i class="fa fa-sign-out"> Kembali</i></button></a>
                </div>
          </div>
          <div class="box-body table-responsive">
            <form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
            <input type="hidden" name="id"  readonly class="form-control" value="{{ $profile->id }}">
            </div>
            <div class="form-group has-feedback">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ $profile->nama_user }}" required>
            </div>
            <div class="form-group has-feedback">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ $profile->username }}" readonly>
            </div>
            <div class="form-group has-feedback">
                <label>Password Baru</label>
                <input type="text" name="password" class="form-control" placeholder="Password Baru..">
            </div>
            <div class="form-group has-feedback">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" cols="5" rows="3" placeholder="Alamat">{{ $profile->alamat }}</textarea>
            </div>
            <div class="form-group has-feedback">
                <label>No WhatsApp</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $profile->no_hp }}" required>
            </div>
            <div class="row">
                <div class="col-xs-3 col-xs-offset-5">
                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </form>
          </div>
         </div>    
      </div>
    </div>
    <br/>
  </section>
@endsection

@section('javascript')

@endsection