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
        table, td, th {
            border: 1px solid black;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .lara{ 
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
        }

        .ttd{
            border:none;
            border-collapse: collapse;
            text-align: center;
        }

        </style>

</head>
<body>
    <div id="kepala">
        <table>
            <tr>
                <td rowspan="5" style="width: 20%;"> <img src="{{asset('images/BBRI.jpg')}}" style="height:80px"></td>
                <td rowspan="2" style="width: 30%; font-size: 16px;">BALAI BESAR POM DI BANJARMASIN</td>
                <td class="kiri1">No. Bagian</td>
                <td class="kiri2">: A 19</td>
            </tr>
            <tr>
                <td class="kiri1">Terbitan/Tgl</td>
                <td class="kiri2">: 2/30 Des 2009</td>
            </tr>
            <tr>
                <td rowspan="2" style="width: 85%; font-size: 16px;"><b>FORMAT - FORMAT</b></td>
                <td class="kiri1">Revisi/Tgl</td>
                <td class="kiri2">: 1/12 Apr 2013</td>
            </tr>
            <tr>
                <td class="kiri1">Halaman</td>
                <td class="kiri2">: 1 dari 1</td>
            </tr>
            <tr>
                <td colspan="3" style="width: 30%; font-size: 18px;"><b>SURAT PERBAIKAN INVENTARIS</b></td>           
            </tr>
        </table>
    </div>  
    <br>  
    <div class="lara">
        <h6>BALAI BESAR PENGAWASAN OBAT DAN MAKANAN DI BANJARMASIN</h6>
        <u><h5>LAPORAN HASIL PEMELIHARAAN INVENTARIS</h5></u>
        <h6>NO. {{$data->no_aduan}}</h6>
        <br>
        <div >
            <table class="rapi">
                <tr>
                    <td class="rapi" style="width: 20%; ">Bag / Bid / Lab</td>
                    <td  class="rapi"style="width: 2%;">:</td>
                    <td class="rapi">
                        @if ($data->lapor->subdivisi_id !=null)
                            {{$data->lapor->subdivisi->nama_subdiv}} ( {{$data->lapor->divisi->nama}} )
                        @else
                            {{$data->lapor->divisi->nama}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td  class="rapi"style="width: 20%;">Tanggal Permintaan</td>
                    <td  class="rapi"style="width: 2%; ">:</td>
                    <td class="rapi">{{tgl_indo($data->tanggal)}}</td>
                </tr>
            </table>
        </div>
        <br>
        <table >
            <thead>
                <tr>
                    <th>NAMA BARANG</th>
                    <th>TEMPAT</th>
                    <th>ADUAN KERUSAKAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="vertical-align: top; align:left; width: 30%;">
                        {{$data->barang->nama_barang}} - {{$data->barang->merk}}
                        <br><br><br>
                    </td>
                    <td style="vertical-align: top; width: 20%;">{{$data->barang->location->nama}}</td>
                    <td style="vertical-align: top; align:left;">{{$data->problem}}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <div style="text-align: left; font-size: 12px; " >

            <b>Tindak Lanjut dari Aduan :</b> <br>
            <i>{{$data->follow_up}} </i>
        </div><br>
        <div style="text-align: left; font-size: 12px; " >
            @php
                $time = strtotime($data->updated_at);
                $newformat = date('Y-m-d',$time); 
            @endphp
            <b>Telah selesai diperbaiki tanggal :</b> <i>{{tgl_indo($newformat)}}</i> <br>
            <b>Dengan Hasil Akhir : </b><br>
            <i>{{$data->result}}</i>
        </div><br><br><br>
        <div class="col-sm-12">
            <table class="ttd">
                <tr>
                    <td class="ttd">Petugas perlengkapan,</td>
                    <td class="ttd">Yang Menerima,</td>
                </tr>
                <tr >
                    <td style="height: 10%" class="ttd"></td>
                    <td style="height: 10%" class="ttd"></td>
                </tr>
                <tr>
                    <td class="ttd"><u>{{$petugas->user->name}}</u></td>
                    <td class="ttd"> <u>{{$data->lapor->name}}</u></td>
                </tr>
                <tr>
                    <td class="ttd">NIP. {{$petugas->user->no_pegawai}}</td>
                    <td class="ttd">NIP. {{$data->lapor->no_pegawai}}</td>
                </tr>
            </table>

        </div><br>

    
    </div>
</body>
</html>