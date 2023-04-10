<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('images/sibob.png')}}">
    <title>Document</title>
    <style>
        body{
            text-align: justify;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td><img src="{{asset('images/BBRI.jpg')}}" style="height:50px"></td>
            <td><h1>Hallo {{$nama }}</h1></td>
        </tr>
    </table>
    Jika anda ingin mengganti password <b>SIBOB</b> anda, silahkan klik
    <button> <a href="{{$linkForm}}">di sini</a> </button> <br>
    
    Atau anda juga bisa dapat melakukannya dengan cara klik link dibawah ini : <br><br>
     <a href="{{$linkForm}}">{{$linkForm}}</a></p>
     <br>
     <br>
     <br>
     <br>
     <br>

    -Terimakasih-
    <br><br>
    <hr>
    <table>
        <tr>
            <td><img src="{{asset('images/BBRI.jpg')}}" style="height:50px"></td>
            <td><h1>Hallo {{$nama }}</h1></td>
        </tr>
    </table>
    If you want to change <b>SIBOB</b> password, please click
    <button> <a href="{{$linkForm}}">here</a> </button> <br>
    
    Or you can also do it by click on the link below : <br><br>
     <a href="{{$linkForm}}">{{$linkForm}}</a></p>
     <br>
     <br>
     <br>
     <br>
     <br>

    -Thankyou-

</body>
</html>