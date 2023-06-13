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
           margin-top: 15px;

        }

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

        .borderless{
            border: none;
            border: none;
            letter-spacing: -1.2px;
            line-height: -1;
        }

        .lara{ 
            border: 1px solid black;
            padding: 20px;
            text-align: center;
            height: 75%;

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
            font-size: 11px;
        }

        hr {
            border-top: 1px dashed gray;
        }

        </style>

</head>
<body>
    <div>
        <table class="borderless" style="width: 100%"> 
            <tr  class="borderless" >
                <td  class="borderless"  style="width: 15%;"> <img src="{{asset('images/BBRI.jpg')}}" style="height:60px"></td>
                <td  class="borderless" >
                    <h6>BALAI BESAR PENGAWASAN OBAT DAN MAKANAN DI BANJARMASIN</h6>
                    <u><h5>SURAT PERMINTAAN BARANG (SPB)</h5></u>
                    <h6>NO. {{$data->nomor}}</h6>
                </td>
                <td  class="borderless"  style="width: 15%;">: A 14</td>
            </tr>
        </table>
    </div>  
    <br>  
    <div >
        <table class="rapi">
            <tr>
                <td class="rapi" style="width: 20%; ">Nama Pengaju</td>
                <td  class="rapi"style="width: 2%;">:</td>
                <td class="rapi">
                    {{$data->pegawai->name}}
                </td>
            </tr>
            <tr>
                <td class="rapi" style="width: 20%; ">Bag / Bid / Lab</td>
                <td  class="rapi"style="width: 2%;">:</td>
                <td class="rapi">
                    @if ($data->pegawai->subdivisi_id !=null)
                        {{$data->pegawai->subdivisi->nama_subdiv}} ( {{$data->pegawai->divisi->nama}} )
                    @else
                        {{$data->pegawai->divisi->nama}}
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
                <th>NO</th>
                <th>NAMA BARANG</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
                <th>KEPERLUAN</th>
                <th>Ada</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no= 1;
            @endphp
            @foreach ($isi as $item)
            <tr>
                <td>{{$no++}}</td>
                <td style="text-align: left;">{{$item->barang->nama_barang}}</td>
                <td>{{$item->satuan->satuan}}</td>
                <td>{{$item->jumlah_aju}}</td>
                <td>{{$item->ket}}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>