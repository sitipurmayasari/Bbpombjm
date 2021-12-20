<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/no_header.css')}}" rel="stylesheet">
    <title>Surat Persetujuan Peminjaman kendaraan dinas</title>
</head>
<style>
    html, table{
        font-family: "Bookman Old Style";
        font-size: 12;
    }

    #kepala{
        font-weight: bold;
        text-align: center;
    }
        

</style>
<body>
    <div id="kepala">
        <h3>Tiket</h3>
        <h1>PERSETUJUAN PEMINJAMAN KENDARAAN DINAS</h1>
    </div>
    <div>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{$data->pegawai->name}}</td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </div>
</body>
</html>