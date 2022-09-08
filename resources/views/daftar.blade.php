<!DOCTYPE html>
<html>
<head><link rel="shortcut icon" href="trustme.png" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/morris/morris.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
</head>
<body class="hold-transition register-page">
  <div class="container">
    <div class="register-logo">
    <b>Azzam</b> <BR/>Teknik Jaya
  </div>
<div class="row">
  <div class="col-md-1">
    
  </div>
  <div class="col-md-10">
  <div class="register-box-body">
        @if(\Session::has('msg_gagal_daftar'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_gagal_daftar')}}
            </div></h5>
            @endif
    <h3 class="login-box-msg"><b>Daftar</b></h3>

    <form action="{{ route('prosesDaftar') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-6">
            <label>Nama Lengkap</label>
            <div class="form-group has-feedback">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
          <label>No Handphone/WhatsApp</label>
            <input type="text" name="no_hp" class="form-control" placeholder="No Handphone/WhatsApp" required>
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" cols="5" rows="3" placeholder="Alamat" required></textarea>
            <span class="glyphicon glyphicon-globe form-control-feedback"></span>
          </div>
        </div>
    </div>
      <br/>
      <div class="row">
        <div class="col-md-5">
          <div class="checkbox icheck">
            
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br/>
        <div class="social-auth-links text-center">
          <p> </p>
        <a href="{{ route('login') }}" class="text-center">Login</a>
      </div>
      <br/>
      <div class="social-auth-links text-center">
          <p> </p>
        <a href="{{ route('index') }}" class="text-center">Halaman Utama</a>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });

</script>
</body>
</html>