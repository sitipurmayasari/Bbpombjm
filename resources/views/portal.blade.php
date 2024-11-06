<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<link rel="icon" href="{{asset('images/sibob.png')}}">
<title>BBPOM Banjarmasin</title>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

<link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
<link href="{{asset('assets/css/material-dashboard.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />

<style>
  body, html {
    height: 100%;
    margin: 0;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  @-webkit-keyframes fadeInRight {
  0% {
    opacity: 0;
    -webkit-transform: translateX(1.334em) translateZ(0);
  }
  100% {
    opacity: 1;
  }
}
@-moz-keyframes fadeInRight {
  0% {
    opacity: 0;
    -moz-transform: translateX(1.334em) translateZ(0);
  }
  100% {
    opacity: 1;
  }
}
@keyframes fadeInRight {
  0% {
    opacity: 0;
    -webkit-transform: translateX(1.334em) translateZ(0);
    -moz-transform: translateX(1.334em) translateZ(0);
    -ms-transform: translateX(1.334em) translateZ(0);
    -o-transform: translateX(1.334em) translateZ(0);
    transform: translateX(1.334em) translateZ(0);
  }
  100% {
    opacity: 1;
  }
}
/* General styles */
body {
  background-color: white;
  font-family: "Lato", Arial, sans-serif;
  text-align: center;
  /* padding-top: 30px; */
}


h2, a {
  font-size: 1em;
  color: #77cc6d;
}

.social {
  margin: 20px auto;
}

/* ============================ */
/* SOCIAL ICONS                 */
/* ============================ */
.social-icon {
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding-box;
  background-clip: padding-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-transition-property: background-color;
  -moz-transition-property: background-color;
  transition-property: background-color;
  -webkit-transition-duration: 0.5s;
  -moz-transition-duration: 0.5s;
  transition-duration: 0.5s;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  transition-timing-function: ease;
  background-color: #c4c4c4;
  text-align: center;
  display: inline-block;
  width: 105px;
  height: 105px;
  padding: 5px 0px;
  color: white;
  margin: 2px;
  /* Color each button differently */
}
.social-icon:nth-child(1) {
  /* Animation */
  -webkit-animation: fadeInRight 0.6s 0.25s forwards;
  animation: fadeInRight 0.6s 0.25s forwards;
  opacity: 0;
  /* Color */
}
.social-icon:nth-child(1):hover, .social-icon:nth-child(1):active, .social-icon:nth-child(1):focus {
  opacity: 1;
  background-color: #00b29a;
}
.social-icon:nth-child(2) {
  /* Animation */
  -webkit-animation: fadeInRight 0.6s 0.5s forwards;
  animation: fadeInRight 0.6s 0.5s forwards;
  opacity: 0;
  /* Color */
}
.social-icon:nth-child(2):hover, .social-icon:nth-child(2):active, .social-icon:nth-child(2):focus {
  opacity: 1;
  background-color: #00b2af;
}
.social-icon:nth-child(3) {
  /* Animation */
  -webkit-animation: fadeInRight 0.6s 0.75s forwards;
  animation: fadeInRight 0.6s 0.75s forwards;
  opacity: 0;
  /* Color */
}
.social-icon:nth-child(3):hover, .social-icon:nth-child(3):active, .social-icon:nth-child(3):focus {
  opacity: 1;
  background-color: #00a1b2;
}
.social-icon:nth-child(4) {
  /* Animation */
  -webkit-animation: fadeInRight 0.6s 1s forwards;
  animation: fadeInRight 0.6s 1s forwards;
  opacity: 0;
  /* Color */
}
.social-icon:nth-child(4):hover, .social-icon:nth-child(4):active, .social-icon:nth-child(4):focus {
  opacity: 1;
  background-color: #008cb2;
}
.social-icon:nth-child(5) {
  /* Animation */
  -webkit-animation: fadeInRight 0.6s 1.25s forwards;
  animation: fadeInRight 0.6s 1.25s forwards;
  opacity: 0;
  /* Color */
}
.social-icon:nth-child(5):hover, .social-icon:nth-child(5):active, .social-icon:nth-child(5):focus {
  opacity: 1;
  background-color: #0077b2;
}
.social-icon:nth-child(6) {
  /* Animation */
  -webkit-animation: fadeInRight 0.6s 1.5s forwards;
  animation: fadeInRight 0.6s 1.5s forwards;
  opacity: 0;
  /* Color */
}
.social-icon:nth-child(6):hover, .social-icon:nth-child(6):active, .social-icon:nth-child(6):focus {
  opacity: 1;
  background-color: #0062b2;
}
.social-icon:nth-child(7) {
  /* Animation */
  -webkit-animation: fadeInRight 0.6s 1.75s forwards;
  animation: fadeInRight 0.6s 1.75s forwards;
  opacity: 0;
  /* Color */
}
.social-icon:nth-child(7):hover, .social-icon:nth-child(7):active, .social-icon:nth-child(7):focus {
  opacity: 1;
  background-color: #004eb2;
}
.social-icon img {
  width: 20px;
}

/* ============================ */
/* TOOLTIP                      */
/* ============================ */
[data-tooltip] {
  position: relative;
  /* tooltip arrow */   
  /* tooltip box */
}
[data-tooltip]:before, [data-tooltip]:after {
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  position: absolute;
  top: 100%;
  left: 50%;
  -webkit-transition-property: opacity;
  -moz-transition-property: opacity;
  transition-property: opacity;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: linear;
  -moz-transition-timing-function: linear;
  transition-timing-function: linear;
  position: absolute;
  left: 50%;
  top: 100%;
  bottom: 100%;
  visibility: hidden;
  opacity: 0;
  z-index: 9999;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
[data-tooltip]:before {
  content: "";
  border-color: #323232;
  border-style: none;
  border: 5px solid transparent;
  border-bottom: 6px solid #323232;
  margin-top: -4px;
}
[data-tooltip]:after {
  content: attr(data-tooltip);
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  width: auto;
  height: 15px;
  padding: 5px 5px 0 5px;
  font-size: 11px;
  line-height: 11px;
  white-space: nowrap;
  background-color: #323232;
  color: #ecf0f1;
  margin-top: 7px;
}
[data-tooltip]:hover, [data-tooltip]:focus {
  background-color: transparent;
}
[data-tooltip]:hover:before, [data-tooltip]:hover:after, [data-tooltip]:focus:before, [data-tooltip]:focus:after {
  -webkit-transform: translate(-50%, 0);
  -moz-transform: translate(-50%, 0);
  -ms-transform: translate(-50%, 0);
  -o-transform: translate(-50%, 0);
  transform: translate(-50%, 0);
  opacity: 1;
  visibility: visible;
}

.sidebar{
  overflow: auto;
}

.atas-notif{
  width: 100%;
  color: white;
  background: blue;

}

.tgl{
  width: 15%;
  height : auto;
  float: right;
  background: #00a1b2;
  color: white;
  margin-right: 3%;
  margin-top: -5%;
  border-radius: 20px;
  box-shadow: 3px 6px #888888;
}

.hari{
  background:#ecf0f1;
  color: #00a1b2;
  font-size:1vw;
  line-height: 0.3;
  padding-top: 5px;
  padding-bottom: 5px;
  
}

.bawah{
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding-box;
  background-clip: padding-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-transition-property: background-color;
  -moz-transition-property: background-color;
  transition-property: background-color;
  -webkit-transition-duration: 0.5s;
  -moz-transition-duration: 0.5s;
  transition-duration: 0.5s;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  transition-timing-function: ease;
  background-color: #c4c4c4;
  text-align: center;
  display: inline-block;
  width: 50px;
  height: 50px;
  padding: 5px 0px;
  color: white;
  margin: 2px;
}

.lain {
  margin: 2px auto;
}

.tgl_det{
  font-size:1.3vw;

}

.strike {
    display: block;
    text-align: center;
    overflow: hidden;
    white-space: nowrap; 
}

.strike > span {
    position: relative;
    display: inline-block;
}

.strike > span:before,
.strike > span:after {
    content: "";
    position: absolute;
    top: 50%;
    width: 9999px;
    height: 1px;
    background: red;
}

.strike > span:before {
    right: 100%;
    margin-right: 15px;
}

.strike > span:after {
    left: 100%;
    margin-left: 15px;
}

#kaki{
  text-align: center;
  width: 95%;
  position:absolute;
  bottom:0;
}

@media screen and (max-width: 600px) {
  .title_message {
    visibility: hidden;
    clear: both;
    float: left;
    margin: 10px auto 5px 20px;
    width: 28%;
    display: none;
  }
}

</style>


</head>

<body background="{{asset('images/background.jpg')}}">
  {{-- modal --}}
  @php
      if ($pop != null) {
        $n = 1;
      } else {
        $n = 0;
      }
      
  @endphp
  <input type="hidden" id="mpop" value="{{$n}}">

  {{-- <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Password</h4>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          Anda sudah lama tidak mengubah password. <br>
          Harap segera ubah password anda sebelum Kadaluarsa. 
          <br>Terima Kasih 
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div> --}}
  {{-- modal --}}



  <div class="wrapper">
    <div class="sidebar" data-background-color="white">
      <div class="card">
        <div class="card-header card-header-warning">
          <h4 class="card-title">Pengumuman</h4>
        </div>
        @if ($data != null)
          <div class="card-body">
            <h3>{{$data->judul}}</h3><br>
            {!! $data->isi !!}
          </div>
        @else
          <div class="card-body">
            <h4>Tidak ada Pengumuman</h4>
          </div>
        @endif
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              {{-- <li class="nav-item ">
                <li class="nav-item ">
                  <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">notifications</i>
                      @if ($aksespinjam != null && $pinjam != null)
                        <span class="notification"> 
                            !
                        </span>
                      @endif
                      @if ($aju != null)
                      <span class="notification"> 
                          !
                      </span>
                    @endif
                    
                    <p class="d-lg-none d-md-block">
                      Some Actions
                    </p>
                  </a>
                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                      @if ($aksespinjam != null && $pinjam != null)
                      <div class="alert alert-info ">
                            <span>
                              <a href="/invent/carok/" class="btn btn-warning">
                                <b> Peminjaman Kendaraan - </b> Pengajuan Baru 
                              </a>
                            </span>
                      </div>
                      @endif 
                      @if ($aju != null)
                      <div class="alert alert-info ">
                            <span>
                              <a href="/invent/carrent/" class="btn btn-warning">
                                <b> Peminjaman Kendaraan - </b> Telah Diproses 
                              </a>
                            </span>
                      </div>
                      @endif    
                    </div> 
                </li>
              </li> --}}
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <b>{{auth()->user()->name}}</b>
                  &nbsp; 
                  <i class="material-icons">person</i>
                  <p>
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="/profile">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/calendars">Kalender</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/logout">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div style="line-height: 1;">&nbsp;</div>
      <div class="content">
        {{-- nama --}}
        <div style="text-align: center; line-height: 1; margin-top:-50px">
            <h1><b>SI-BOB</b></h1>
            <h5 class="title_message"><b>( SISTEM INFORMASI BBPOM BANJARMASIN )</b></h5>
        </div>

        {{-- portal --}}
        <div class="social col-md-6 col-sm-12 col-xs-12" >
          <a class="social-icon" href="/amdk/dashboard">
            <img src="{{asset('images/amdk2.png')}}" style="height:100%; width:100%">
          </a>   
          <a class="social-icon" href="/invent/dashboard">
            <img src="{{asset('images/bmn2.png')}}" style="height:100%; width:100%">
          </a>
          <a class="social-icon" href="/finance/portalAG">
            <img src="{{asset('images/anang2.png')}}" style="height:100%; width:100%">
          </a>
          <a class="social-icon" href="/calibration/dashboard">
            <img src="{{asset('images/lab2.png')}}" style="height:100%; width:100%">
          </a>
          <a class="social-icon" href="/arsip/dashboard">
            <img src="{{asset('images/arsip2.png')}}" style="height:100%; width:100%">
          </a>
          <a class="social-icon" href="https://sites.google.com/view/kinerjabbpombjm2023" target="_blank">
            <img src="{{asset('images/terkait/anpeg.png')}}" style="height:100%; width:100%">
          </a>
          <a class="social-icon"  href="https://bit.ly/SOPBPOMBJM">
            <img src="{{asset('images/qms3.png')}}" style="height:100%; width:100%">
          </a>
          {{-- cooming soon --}}
          <a class="social-icon"  href="/coomingsoon/dashboard">
            <img src="{{asset('images/pem_logo.png')}}" style="height:100%; width:100%">
          </a>
          {{-- <a class="social-icon"  href="/ppnpn/dashboard">
            <img src="{{asset('images/ppnpn.png')}}" style="height:100%; width:100%">
          </a> --}}
        </div>
        <div id="kaki" class="title_message">
          <div class="strike">
            <span>Link Terkait</span>
          </div>
          <div class="lain"> 
            @foreach ($terkait as $item)
              <a class="bawah" data-tooltip="{{$item->name}}" href="{{$item->link}}" target="_blank">
                <img src="{{$item->getFoto()}}" style="height:100%; width:100%">
              </a>
            @endforeach 
          </div>
        </div>
      </div>
    </div>
  </div>


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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       var a = $('#mpop').val();
        $(window).on('load', function() {
            if (a == 0) {
              $('#myModal').modal('show');
            }
        });   
    </script>
  </body>
</html>