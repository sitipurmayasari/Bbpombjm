<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<link rel="icon" href="{{asset('images/sibob.png')}}">
		<title>BBPOM | Control Panel</title>
		{{-- <link rel="shortcut icon" href="{{asset('favicon.ico')}}"> --}}
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/font-awesome/4.7.0/css/font-awesome.min.css')}}" />


		<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.custom.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/chosen.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker3.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-timepicker.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/daterangepicker.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-colorpicker.min.css')}}" />

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
		{{-- <link href="{{asset('assets/css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet"> --}}
		
		
		<link rel="stylesheet" href="{{asset('assets/css/fonts.googleapis.com.css')}}" />

		<link rel="stylesheet" href="{{asset('assets/css/ace.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{asset('assets/css/gportal.css')}}" class="ace-main-stylesheet" id="main-ace-style" />


		<link rel="stylesheet" href="{{asset('assets/css/ace-skins.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/ace-rtl.min.css')}}" />

		<link href="{{asset('assets/sweetalert/sweetalert.css')}}" rel="stylesheet">
  		<link href="{{asset('assets/sweetalert/sweetalert.hack.css')}}" rel="stylesheet">
  		<link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


		@yield('header')


	</head>

	<body class="no-skin">

		<div id="navbar" class="navbar navbar-custom ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="/portal" class="navbar-brand">
						<small>
						<img src="{{asset('images/bbpom.jpg')}}" alt="" srcset="" style="height:35px">
						PPNPN (Pegawai Pemerintah Non Pegawai Negeri)
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">

					<ul class="nav ace-nav">



						<li class="green dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<br>
									{{auth()->user()->name}}
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="/profile">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>


					</ul>

				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
						<li class="">
							<b class="arrow"></b>
						</li>

						<li class="{{ (request()->segment(2) == 'dashboard' ) ? 'active' : '' }}">
							<a href="/ppnpn/dashboard">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard </span>
							</a>
							<b class="arrow"></b>
						</li>
						

						@foreach (myMenu('ppnpn') as $item)
						@if ($item->link!='')
							<li class="{{ (request()->segment(2) == strtolower($item->nama) ) ? 'active' : '' }}">
								<a href="{{$item->link}}">
									<i class="menu-icon {{$item->icon}}"></i>
									<span class="menu-text"> {{$item->nama}} </span>
								</a>
								<b class="arrow"></b>
							</li>
						@else
							<li class="{{ strtolower(request()->segment(2)) == strtolower($item->nama)  ? 'open' : '' }} ">
								<a href="" class="dropdown-toggle">
								<i class="menu-icon fa {{$item->icon}}"></i>
								<span class="menu-text"> {{$item->nama}} </span>
								<b class="arrow fa fa-angle-down"></b>
							</a>
							<b class="arrow"></b>
							<ul class="submenu">
							@foreach (mySubMenu($item->id) as $sub)
								<li class="{{strtolower(request()->segment(2)) == strtolower($sub->nama)  ? 'active' : '' }}">
									<a href="{{$sub->link}}">
										<i class="menu-icon {{$sub->icon}}"></i>
										{{$sub->nama}}
									</a>
									<b class="arrow"></b>
								</li>
							@endforeach
							</ul>
						</li>
						@endif
					
				   		@endforeach

					

				</ul>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<!-- Breadcrumbs-->
						<ol class="breadcrumb">
							@yield('breadcrumb')
						</ol>


					</div>

					<div class="page-content">

						@yield('content')

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<hr style="height:2px;color:gray;background-color:gray">
						<span class="bigger-120">
							<span class="green bolder">BBPOM KalSel</span>
							&copy; 2021
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- JS -->
		<script src="{{asset('assets/js/ace-extra.min.js')}}"></script>
		<script src="{{asset('assets/js/jQuery-2.1.4.min.js')}}"></script>

		<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery-ui.custom.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
		<script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
		<script src="{{asset('assets/js/spinbox.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-timepicker.min.js')}}"></script>
		<script src="{{asset('assets/js/moment.min.js')}}"></script>
		<script src="{{asset('assets/js/daterangepicker.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-colorpicker.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.knob.min.js')}}"></script>
		<script src="{{asset('assets/js/autosize.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.inputlimiter.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.maskedinput.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-tag.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.number.min.js')}}"></script>
		<script src="{{asset('assets/js/autoNumeric-min.js')}}"></script>
		<script src="{{asset('assets/js/chartist.min.js')}}"></script>
		<script src="{{asset('assets/js/Chart.js')}}"></script>

		<!-- ace scripts -->
		<script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
		<script src="{{asset('assets/js/ace.min.js')}}"></script>

		<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
 		<script src="{{asset('assets/toastr/toastr.min.js')}}"></script>
 		<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{asset('assets/js/dataTables.select.min.js')}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

		<script>
			$(document).ready(function() {
				$('.select2').select2();
			});
				@if(Session::has('sukses'))
					toastr.success("{{Session::get('sukses')}}", "Sukses",{timeOut: 5000})
				@endif
				@if(Session::has('gagal'))
					toastr.error("{{Session::get('gagal')}}", "Gagal",{timeOut: 5000})
				@endif
			</script>
		@yield('footer')

	</body>
</html>
