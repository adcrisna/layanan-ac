@extends('layouts.owner')
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/morris/morris.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_owner') }}"><i class="fa fa-home"></i> Dashboard</a></li>
    </ol>
  </section>
  <section class="content">
    <br/>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-exchange"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Transaksi</span>
              <span class="info-box-number">{{ count($transaksi) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pengguna</span>
              <span class="info-box-number">{{ count($konsumen) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-list-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Kategori</span>
              <span class="info-box-number">{{ count($kategori) }}</span>
            </div>
          </div>
        </div>
      </div>
    <br/>
  </section>
@endsection

@section('javascript')
<script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
@endsection