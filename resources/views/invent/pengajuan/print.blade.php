<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/print.css')}}" rel="stylesheet"> --}}
    <title>SPB Baru</title>
</head>
<style>
        @page {
            size: A4;
            /* margin: 170px 0px 100px 0px; */
            font-family: 'Times New Roman';
            font-size: 11px;
            page-break-after: always;
            
        }
        

        body, html {
            height: 100%;
            margin: 0;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .header {
            position:fixed;
            padding-top: 0%;
            /* height: 15%; */
            top: 0%;
            margin-left: 5%;
            margin-right: 5%;
            margin-top: -170px;
        }

        footer {
                position:fixed;
                height: 70px;
                bottom: 0;
                width: 100%;
                margin-bottom: 20px;
                z-index: -100;
        }

    
        html, table{
            font-family: "Bookman Old Style";
            font-size: 12;

            
        }

        #kop{
            font-family: "Bookman Old Style";
            margin-left: 10%;
            margin-right: 10%;
            line-height: 1.5;
            margin-top: 130px;
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
            line-height: 1;
            font-size: 12;
        }

        .ttdini{
            text-align: center;
            margin-right: 10%;
            font-size: 12;
        }

        .detail{
            font-family: "Bookman Old Style";
            border: 1px solid black;
            font-size: 10;
            text-align: left;
            line-height: 2;
            vertical-align: top
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
<body background="{{asset('images/kop.png')}}">
     {{-- <header>
        <img src="{{asset('images/kop.png')}}" style="width: 100%"> <br>
    </header> --}}
    <div class="col-sm-12" style="text-align: center">
        <div style="align=center;" id="kop">
            <u><b style="font-size: 14">DAFTAR PERMINTAAN BARANG BARU</b></u><br>
            <p style="font-size: 12">NOMOR : {{$data->no_ajuan}}</p>
        </div>
        <br>
     </div>
     <div id="isi">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    {{$data->lapor->name}} 
                    @if ($data->lapor->status == 'PNS')
                        (NIP. {{$data->lapor->no_pegawai}})
                    @endif
                </td>
            </tr>
            <tr>
                <td>Bidang/Bagian</td>
                <td>:</td>
                <td>
                    {{$data->lapor->divisi->nama}}
                    @if ($data->lapor->subdivisi_id != null)
                        {{$data->lapor->subdivisi->nama}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Kelompok Barang</td>
                <td>:</td>
                <td>{{$data->kelompok}}</td>
            </tr>
        </table>
        <br><br>
        <table style="width:100%" class="detail">
            <thead class="detail">
                <tr class="detail">
                    <th style="width: 5%">NO</th>
                    <th style="width: 25%">NAMA BARANG</th>
                    <th style="width: 30%">SPESIFIKASI</th>
                    <th style="width: 15%">JUMLAH</th>
                    <th style="width: 25%">KETERANGAN</th>
                </tr>
            </thead>
            <tbody class="detail">
                @php
                    $no = 1;
                @endphp
                @foreach ($isi as $item)
                    <tr class="detail">
                        <td class="detail" style="text-align: center">{{$no}}</td>
                        <td class="detail">{{$item->nama_barang}}</td>
                        <td class="detail">{{$item->spek}}</td>
                        <td class="detail" style="text-align: center">{{$item->jumlah}} {{$item->satuan->satuan}}</td>
                        <td class="detail">{{$item->keperluan}}</td>
                    </tr>
                    @php
                        $no++
                    @endphp
                @endforeach
            </tbody>
        </table>
        <br><br>
        <br><br><br>
        <table class="ttdini" style="width: 100%">
            <tr>
                <td style="width: 50%; "></td>
                <td style="width: 50%; text-align:center;">Banjarmasin, 
                    {{tgl_indo($data->tgl_ajuan)}}
                </td>
            </tr>
            <tr>
               <td style="text-align:center;">
                   Mengetahui, <br>
                    @if ($mengetahui != null)
                        @if ($mengetahui->pjs != null)
                        {{$mengetahui->pjs}}
                        {{$mengetahui->jabatan->jabatan}} 
                        @if ($mengetahui->subdivisi_id is null)
                            {{$mengetahui->divisi->nama}}
                        @else
                            {{$mengetahui->subdivisi->nama_subdiv}}
                        @endif
                        @else
                        {{$mengetahui->jabatan->jabatan}} 
                        {{$mengetahui->divisi->nama}}
                        @endif
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif   
                    <br><br><br><br><br>
               </td>
               <td  style="text-align:center;">Yang Meminta, </td>
            </tr>
            <tr>
                <td style="text-align:center;">
                    @if ($mengetahui != null)
                        <u>{{$mengetahui->user->name}}</u> <br>
                        NIP. {{$mengetahui->user->no_pegawai}}
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif   
                </td>
                <td style="text-align:center;">
                    <u>{{$data->lapor->name}}</u> <br>
                    @if ($data->lapor->status == 'PNS')
                        (NIP. {{$data->lapor->no_pegawai}})
                    @endif
                </td>

            </tr>

        </table>
    </div>
</body>
</html>