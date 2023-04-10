<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{asset('images/sibob.png')}}">
<title>Forgot</title>
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/plogin-style.css')}}">
<link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">
<style>
    body, html {
        height: 100%;
        margin: 0;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        }
</style>

</head>
<body background="{{asset('images/background.jpg')}}">
<div class="login-form">
    <form action="{{Route('forgot.update',$mail)}}" method="post">
        @csrf
    	<img src="{{asset('images/bbpom.jpg')}}" style="height:100px">
        <br><br> 
        <div class="clearfix"></div>
        <h5>MASUKKAN PASSWORD BARU ANDA</h5>
        @if($errors->any())
        <div class="col-xs-12">
                <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div>
                        @foreach($errors->all() as $error)
                            <li>{{trans($error)}}</li>
                        @endforeach
                        </div>
                    </div>
        </div>
        @endif       
        <div class="form-group">
            <input type="password" class="form-control" 
                name="password" placeholder="Password" 
                required="required" value="{{old("password")}}">
        </div> 
        <div class="form-group">
            <input type="password" class="form-control" 
                name="repassword" placeholder="Konfirmasi Password" 
                required="required" value="{{old("repassword")}}">
            
        </div> 
		
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block btn_sign">SUBMIT</button>
        </div>
    </form>
</div>
    <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/toastr/toastr.min.js')}}"></script>

    <script>
        @if(Session::has('sukses'))
            toastr.success("{{Session::get('sukses')}}", "Sukses",{timeOut: 5000})
        @endif
        @if(Session::has('gagal'))
            toastr.error("{{Session::get('gagal')}}", "Gagal",{timeOut: 5000})
        @endif
    </script>
</body>
</html>                            