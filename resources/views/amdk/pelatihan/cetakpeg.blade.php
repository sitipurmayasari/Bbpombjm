<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
    <title>Rekapitulasi pengambangan kompetensi pegawai</title>
    <style>
        @page {
            size:A4;
            font-family: 'Times New Roman';
            line-height: 1;
            margin: 50px 30px 30px 50px;
        }

        #header{
            text-align: center;
            font-weight: bold;
        }

        hr.s5 {
            height:5px;
            border-top:2px solid black;
            border-bottom:1px solid black;
        }

        table{
            width: 100%;
        }


    </style>
</head>
<body>
    <div id="header">
        LAPORAN PENGEMBANGAN KOMPETENSI <br>
        PERIODE {{tgl_indo($request->awal)}} S/D {{tgl_indo($request->akhir)}} <br>
        {{$atas->user->name}} <br>
        BALAI BESAR POM DI BANJARMASIN
    </div>
    <hr class="s5">
    <br>
    <div>
        @php
            $no = 1;
        @endphp
         <table>
            @foreach ($data as $item)
            <tr>
                <td rowspan="7" style="width: 5%">No. {{$no}} 
                </td>
                <td style="width: 25%"><b>Jenis Kegiatan</b></td>
                <td>
                    {{$item->jenis->name}}
                </td>
            </tr>
            <tr>
                <td><b>Nama Kegiatan</b></td>
                <td>
                    {{$item->nama}}
                </td>
            </tr>
            <tr>
                <td><b>Penyelenggara</b></td>
                <td>
                    {{$item->penyelenggara}}
                </td>
            </tr>
            <tr>
                <td><b>Waktu Pelaksanaan</b></td>
                <td>
                    {{tgl_indo($item->dari)}} s/d {{tgl_indo($item->sampai)}}
                </td>
            </tr>
            <tr>
                <td><b>Lama Kegaiatan (JP)</b></td>
                <td>
                    {{$item->lama}} JP
                </td>
            </tr>
            <tr>
                <td><b>Deskripsi Singkat Kegaiatan</b></td>
                <td>
                   @if ($item->deskripsi != null)
                    {{$item->deskripsi}}
                   @else
                       -
                   @endif
                </td>
            </tr>
            <tr>
                <td><b>Data Dukung</b></td>
                <td>
                    <a href="{{$item->getFIleSert()}}" target="_blank" >{{$item->file}}</a></label> <br>
                    {{-- <img src="{{$item->getFIleSert()}}"  style="width:500px">  --}}
                </td>
            </tr>
            @php
                    $no++;
                @endphp
            @endforeach
        </table>   
    </div>
</body>
</html>