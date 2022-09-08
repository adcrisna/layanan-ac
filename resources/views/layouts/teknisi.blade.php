<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="{{ asset('logo-dprkp.png') }}" type="image/x-icon" />
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $title }}</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/ionslider/ion.rangeSlider.min.js') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
  @yield('css')
</head>
	<body class="hold-transition skin-green sidebar-mini">
		<div class="wrapper">

  <header class="main-header">
    <a href="{{ route('home_teknisi') }}" class="logo">
      <span class="logo-mini"><b>Teknisi</b></span>
      <span class="logo-lg"><b>Azzam Teknik Jaya</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="{{ route('home_teknisi') }}" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Navigation</span>
      </a>
    </nav>
  </header>
  <aside class="main-sidebar control-sidebar-red">
    <div class="user-panel">
        <!-- <div class="pull-left image">
          <img src="#" class="img-circle" alt="User Image">
        </div> -->
        <!-- <div class="pull-left info">
          <p>{{ $nama }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        <br/>
        <br/>
        <br/> -->
    </div>
    <section class="sidebar">      
      <ul class="sidebar-menu">
        <li>
          <a href="{{ route('home_teknisi') }}">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('data_pekerjaan') }}">
            <i class="fa fa-list-alt"></i> <span>Data Pekerjaan</span>
          </a>
        </li>
        <li>
          <a href="{{ route('logout_teknisi') }}">
            <i class="fa fa-sign-out"></i> <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    @yield('content')
  </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Template By AdminLTE 2</b>
      </div>
      <strong> &copy; 2022</strong>
    </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/app.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
@yield('javascript')
</body>
</html>