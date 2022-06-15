<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>

    <style>
        @page {
            font-family: "Arial";
            font-size: 12px;
        }

        table, td, th {
            border: 1px solid black;
            text-align: center;
        }

        #kop{
            text-align: center;
            font-size: 16px;
        }

        /* table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        } */

        /* .lara{ 
            border: 1px solid black;
            padding: 20px;
            text-align: center;
            height: 75%;

            }
        .kiri1{
            border:none; font-size: 10px; padding-left: 5px; text-align:left;width: 15%;
        }
        .kiri2{
            border: none; font-size: 10px; text-align:left;width: 20%;
        }

        .rapi{
            border:none;
            border-collapse: collapse;
            text-align: left;
        } */

        .ttd{
            border:none;
            border-collapse: collapse;
            text-align: center;
        }

        </style>

</head>
<body>
    <div id="kop">
        <b>Form Berita Acara Penyerahan BMN Rusak Berat</b>
    </div>
    <div>
        @php
        $a = strtotime($data->tanggal);
        $b = date('d', $a);
        $c = date('D', $a);
        $d = date('M', $a);
        $e = date('Y', $a);

        if ($c=='sun') {
            $days='Minggu';
        }else if ($c=='Mon') {
            $days='Senin';
        }else if ($c=='Tue') {
            $days='Selasa';
        }else if ($c=='Wed') {
            $days='Rabu';
        }else if ($c=='Thu') {
            $days='Kamis';
        }else if ($c=='Fri') {
            $days='Jumat';
        }else{
            $days='Sabtu';
        };
    @endphp

        Pada hari {{$days}} tanggal {{$b}} bulan {{$d}} tahun {{$e}},
        telah dilakukan serah terima BMN rusak berat antara
        <table style="width: 100%">
            <tr>
<td style="text-align: center; width:5%"> 1. </td>
<td> Nama</td>
<td>:</td>
<td></td>
            </tr>
            <tr>
<td> NIP</td>
<td></td>
<td>:</td>
<td></td>
            </tr>
            <tr>
<td> Jabatan</td>
<td></td>
<td>:</td>
<td></td>
            </tr>
            <tr>
<td colspan="3"> Yang selanjutnya disebut sebagai PIHAK PERTAMA</td>
            </tr>
            <tr>
<td style="text-align: center"> 2. </td>
<td> Nama</td>
<td>:</td>
<td></td>
            </tr>
            <tr>
<td> NIP</td>
<td></td>
<td>:</td>
<td></td>
            </tr>
            <tr>
<td> Jabatan</td>
<td></td>
<td>:</td>
<td></td>
            </tr>
            <tr>
<td colspan="3"> Yang selanjutnya disebut sebagai PIHAK KEDUA</td>
            </tr>
        </table>

    </div>
    
</body>
</html>