<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Selamat Datang</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/morris/morris.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
</head>
<body class="hold-transition login-page">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <br/>
          <div class="login-logo">
          <b> Azzam Teknik Jaya </b> <br/> Jasa Service AC
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
      <div class="login-box">
        <div class="login-box-body">
            @if(\Session::has('msg_daftar'))
              <h4><div class="alert alert-success">
                {{ \Session::get('msg_daftar')}}
              </div></h4>
            @endif
          <p class="login-box-msg"><b>Login</b></p>
          <form action="{{ route('proses_login')}}" method="POST">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
              <input type="text" name="username" class="form-control" placeholder="Username" required>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password" class="form-control" placeholder="Password" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            @if(\Session::has('msg_login'))
            <div class="alert alert-danger">
              {{ \Session::get('msg_login')}}
            </div>
            @endif
            <br/>
            <div class="row">
              <div class="col-xs-8">
                <a href="{{ route('daftar') }}" class="text-center">Daftar Akun</a>
              </div>
              <div class="col-xs-8">
                <p></p>
              </div>
              <div class="col-xs-8">
                <a href="{{ route('index') }}" class="text-center">Halaman Utama</a>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
              </div>
            </div>
          </form>
        </div>
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