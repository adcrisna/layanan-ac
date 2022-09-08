@extends('layouts.index')
@section('css')

@endsection

@section('content')
      <section class="content-header">
        <br/>
        <ol class="breadcrumb">
          <li><a href="{{ route('index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        @if(\Session::has('msg_success'))
           <h5> <div class="alert alert-success">
              {{ \Session::get('msg_success')}}
            </div></h5>
            @endif
          @if(\Session::has('msg_gagal'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_gagal')}}
            </div></h5>
            @endif
          <div class="col-md-12">
            <div class="box box-widget">
              <div class="box-header with-border">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{ asset('cic.png') }}" alt="User Image">
                  <span class="username"><a href="{{ route('index') }}">Selamat Datang</a></span>
                  <span class="description">Admin, Azzam Teknik Jaya</span>
                </div>
                <!-- /.user-block -->
                <div class="box-tools"> 
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <!-- post text -->
                <div class="row">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-4">
                    <div class="box box-success">
                      <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" src="{{ asset('cic.png') }}" style="width: 260px ; height: 160px ;" alt="picture of gas">
                        <br/>
                        <h3 class="profile-username text-center"><b>Jasa Layanan</b></h3>
                        <br/>
                        <ul class="list-group list-group-unbordered">
                          <li class="list-group-item">
                            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam consequatur optio aliquam. 
                              Inventore sed, itaque recusandae rem quod modi aliquam quae eligendi autem aspernatur. 
                              Incidunt nulla exercitationem totam officiis aperiam!</p>
                          </li>
                        </ul>

                        <a href="{{ route('login') }}" class="btn btn-success btn-block" ><i class="fa fa-shopping-cart"> <b>Pesan</b></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="box box-success">
                      <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" src="{{ asset('cic.png') }}" style="width: 260px ; height: 160px ;" alt="picture of gas">
                        <br/>
                        <h3 class="profile-username text-center"><b>Produk</b></h3>
                        <br/>
                        <ul class="list-group list-group-unbordered">
                          <li class="list-group-item">
                          <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam consequatur optio aliquam. 
                              Inventore sed, itaque recusandae rem quod modi aliquam quae eligendi autem aspernatur. 
                              Incidunt nulla exercitationem totam officiis aperiam!</p>
                          </li>
                        </ul>

                        <a href="{{ route('login') }}" class="btn btn-success btn-block"><i class="fa fa-shopping-cart"> <b>Pesan</b></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                  </div>
                </div>
              </div>
              <!-- /.box-footer -->
            </div>
          </div>
      </section>
      <!-- /.content -->
 @endsection

@section('javascript')

@endsection
