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
    html{
        font-family: "Bookman Old Style";
        font-size: 11;
        margin-left: 3%;
        margin-right: 30%;
    }

    #kepala{
        font-weight: bold;
        text-align: center;
    }

    #isi{
        font-family: "Bookman Old Style";
        font-size: 10;
        margin-left: 10%;
        line-height: 1;
        text-align: justify;
    }

    .demo-wrap {
    overflow: hidden;
    position: relative;
    }

    .demo-bg {
    opacity: 0.3;
    position: absolute;
    left: 30%;
    top: 10%;
    width: 30%;
    height: auto;
    }

    .demo-content {
    position: relative;
    
    }
        

</style>
<body class="demo-wrap">
    <img class="demo-bg" src="{{asset('images/disetujui.png')}}" alt="" >
    <div id="kepala">
        <h4>Tiket</h4>
        <h3>PERSETUJUAN PEMINJAMAN KENDARAAN DINAS</h3>
        <br>
    </div>
    <div class="isi">
        <div  class="demo-content">
            <table>
                <tr>
                    <td style="vertical-align: top;">Nama</td>
                    <td>:</td>
                    <td> {{$data->pegawai->name}} ({{$data->pegawai->divisi->nama}})</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Tanggal Peminjaman</td>
                    <td>:</td>
                    <td> {{tgl_indo($data->date_from)}} s/d {{tgl_indo($data->date_to)}}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Tujuan</td>
                    <td>:</td>
                    <td> {{$data->destination}}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Kendaraan</td>
                    <td>:</td>
                    <td> {{$data->car->merk}} ({{$data->car->police_number}})</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Supir</td>
                    <td>:</td>
                    <td>
                        @if ( $data->driver_id != null)
                            {{$data->supir->name}}
                        @else
                            {{ ' - ' }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>