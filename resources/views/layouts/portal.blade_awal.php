<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BBPOM Banjarmasin</title>
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/plogin-style.css')}}">
<link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

{{-- <link href="{{asset('assets/css/dashboard_me.css')}}" rel="stylesheet"> --}}
<link href="{{asset('assets/css/material-dashboard.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />

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
  margin: 60px auto;
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
  width: 200px;
  height: 200px;
  padding: 9px 0px;
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
  height: 22px;
  padding: 11px 11px 0 11px;
  font-size: 13px;
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
.footer {
            position: absolute;
            bottom: 1%;
            width: 100%;
            margin: 0%;
        }
</style>

</head>
<body background="{{asset('images/background.jpg')}}">
<div>
  header
</div>
<div>
    <div class=" col-sm-4">
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

   <div class="col-sm-8">
    <h3>SELAMAT DATANG DI</h3>
    <h1>SISTEM INFORMASI BBPOM</h1>
    <div class="social" style="font-size: 120px;">
        
        <a class="social-icon" data-tooltip="AMDK" href="/amdk/dashboard">
          <i class="fa fa-users fa-10x" aria-hidden="true"></i>
        </a>
      
        <a class="social-icon" data-tooltip="Inventaris" href="/invent/dashboard">
          <i class="fa fa-archive fa-10x" aria-hidden="true"></i>
        </a>
      </div>
   </div>
</div>

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

</body>
</html>                            