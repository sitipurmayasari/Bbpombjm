<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td><img src="{{asset('images/BBRI.jpg')}}" style="height:50px"></td>
            <td><h1>Hallo {{$nama }}</h1></td>
        </tr>
    </table>
    Untuk mengganti password aplikasi <b>SIBOB</b>, anda silahkan klik
    <button> <a href="{{$linkForm}}">di sini</a> </button> <br>
    
    Atau anda juga bisa dapat melakukannya dengan cara klik link ini : <br>
     <a href="{{$linkForm}}">{{$linkForm}}</a></p>
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
    If you want to change the password your <b>SIBOB</b> please click
    <button> <a href="{{$linkForm}}">here</a> </button> <br>
    
    Or you can also do it by click this link : <br>
     <a href="{{$linkForm}}">{{$linkForm}}</a></p>
     <br>

    -Terimakasih-

</body>
</html>