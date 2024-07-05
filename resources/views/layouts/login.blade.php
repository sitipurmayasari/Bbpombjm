<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{asset('images/sibob.png')}}">
<title>Login</title>
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

        .login-form{
            margin-top: 15px;
        }
</style>

</head>
<body background="{{asset('images/background.jpg')}}">
<div class="login-form">
    
    <form action="{{Route('auth')}}" method="post">
        {{ csrf_field() }}
    	<img src="{{asset('images/bbpom.jpg')}}" style="height:100px">
        <br><br>        
        <table style="width: 100%">
            <tr>

                <td>
                    <div class="form-group has-error">
                        <input type="text" class="form-control" 
                            name="email" placeholder="Email" 
                            required="required" value="{{old("email")}}">
                    </div>
                    @error('email')
                    <span class="text-danger role="alert">
                        {{ $message }}
                    </span>
                @enderror
               
                    <div class="form-group">
                        <input type="password" class="form-control" 
                            name="password" placeholder="Password" id="myInpute"
                            required="required" value="{{old("password")}}">
                    </div>        
                </td>
                <td>
                    <br><br>
                    <i class="fa fa-eye" onclick="eye()" id="eye" style="margin-left: -30px; cursor: pointer;"></i>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="refereshrecapcha"> {!! captcha_img('math') !!} </div> <br>
                    <div class="form-group">
                        <input type="text" class="form-control" 
                            name="captcha" placeholder="Captcha"
                            required="required" value="{{old("captcha")}}">

                            @error('captcha')
                                <span class="text-danger role="alert>
                                    {{ $message}}
                                </span>
                            @enderror
                    </div>   
                   
                </td>
                <td>
                    <br><br>
                    <i class="fa fa-refresh" onclick="refreshCaptcha()" id="refresh" style="margin-left: -30px; cursor: pointer;"></i>
                </td>
            </tr>
        </table>
        {{-- <p style="text-align: right;font-size: 11px"><a href="/forgot">Lupa Password Anda?</a></p> --}}
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block btn_sign">Login</button>
        </div>
        <p style="text-align: center;font-size: 11px"><a href="https://wa.me/6281545833889">Jika Lupa Password, Silahkan Hubungi TIM IT</a></p>
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

        function eye() {
            var x = document.getElementById("myInpute");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("eye").classList.add('fa fa-eye');
                document.getElementById("eye").classList.remove('fa fa-eye-slash');
            } else {
                x.type = "password";
                document.getElementById("eye").classList.add('fa fa-eye-slash');
                document.getElementById("eye").classList.remove('fa fa-eye');
            }
        }

        function refreshCaptcha(){
            $.ajax({
                url: "/refereshcapcha",
                type: 'get',
                dataType: 'html',        
                success: function(json) {
                    $('.refereshrecapcha').html(json);
                },
                error: function(data) {
                    alert('Try Again.');
                }
            });
                
        }

    </script>
</body>
</html>                            