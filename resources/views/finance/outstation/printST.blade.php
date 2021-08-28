<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/no_header.css')}}" rel="stylesheet">
    <title>Surat Tugas</title>
    <style>
        html, table{
            font-family: "Bookman Old Style";
            font-size: 12;
        }

        #kop{
            font-family: "Bookman Old Style";
            margin-left: 10%;
            margin-right: 10%;
            line-height: 1.5;
        }

        #isi{
            font-family: "Bookman Old Style";
            font-size: 12;
            margin-left: 10%;
            margin-right: 10%;
            line-height: 1;
            text-align: justify;
        }
        
        table, td, tr {
            text-align: justify;
            vertical-align: top;
            line-height: 2;
            font-size: 12;
        }

        .ttdini{
            float: right;
            margin-right: 15%;
            font-size: 12;
        }

        .detail{
            border: 1px solid black;
            font-size: 11;
            text-align: left;
        }
        th{
            border: 1px solid black;
            font-weight: bold;
            font-size: 10; 
            vertical-align: middle;
            text-align: center;
            line-height: 1;
        }

    </style>
</head>
{{-- @foreach ($isi as $item) --}}
<body>
    <div class="col-sm-12" style="text-align: center">
       <div style="align=center;" id="kop">
           <u><b style="font-size: 14">SURAT TUGAS</b></u><br>
           <p style="font-size: 12">NOMOR :</p>
       </div>
       <br>
    </div>
    <div id="isi">
        <p>Yang bertanda-tangan di bawah ini Kepala Balai Besar Pengawas Obat dan Makanan di Banjarmasin,
            memerintahkan kepada nama - nama yang tersebut di bawah ini:</p>
        <br>
        <table style="width:100%" class="detail">
            <thead>
                <tr >
                    <th style="width: 5%">NO</th>
                    <th style="width: 30%">NAMA</th>
                    <th style="width: 20%">NIP</th>
                    <th style="width: 25%">PANGKAT / GOLONGAN</th>
                    <th style="width: 30%">JABATAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="detail" style="text-align: center;">
                            1
                    </td>
                    <td class="detail">
                            we
                    </td>
                    <td class="detail">
                            dfdf
                    </td>
                    <td class="detail">
                        fffsg
                    </td>
                    <td class="detail">
                        fgdfg
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table >
            <tr >
                <td>Tugas yang di berikan &ensp;</td>
                <td>:&ensp;

                </td>
            </tr>
            <tr>
                <td>Tujuan&ensp;</td>
                <td>: 

                </td>
            </tr>
            <tr>
                <td>Kendaraan</td>
                <td>:&ensp;

                </td>
            </tr>
            <tr>
                <td>Waktu&ensp;</td>
                <td>:&ensp;

                </td>
            </tr>
            <tr>
                <td>Biaya&ensp;</td>
                <td>:&ensp;

                </td>
            </tr>
        </table>
        <br><br>
        &ensp;Agar melaksanakan tugas sebaik - baiknya dan setelah bertugas <b>segera membuat laporan.</b>
        <br><br>
        <table class="ttdini">
            <tr>
                <td>Banjarmasin, (tanggal) </td>
            </tr>
            <tr>
                <td><b>KEPALA,</b></td>
            </tr>
            <tr>
                <td style="height: 10%"></td>
            </tr>
            <tr>
                <td><b>Nama</b></td>
            </tr>
        </table>
    </div>
</body>
{{-- @endforeach --}}
</html>