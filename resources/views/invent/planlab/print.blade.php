<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/print.css')}}" rel="stylesheet"> --}}
    <title>PERENCANAAN PENGADAAN LAB TAHUN {{$data->years}}</title>
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
            border-collapse: collapse;
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

        .gbr{
            padding-left: 5px;
            padding-top: 5px;
        }

</style>
<body>
     {{-- <header>
        <img src="{{asset('images/kop.png')}}" style="width: 100%"> <br>
    </header> --}}
    <div class="col-sm-12" style="text-align: center">
        <div style="align=center;" id="kop">
            <u><b style="font-size: 14">PERENCANAAN PENGADAAN LAB TAHUN {{$data->years}}</b></u><br>
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
                    {{$data->user->name}} 
                    @if ($data->user->status == 'PNS')
                        (NIP. {{$data->user->no_pegawai}})
                    @endif
                </td>
            </tr>
            <tr>
                <td>Bidang/Bagian</td>
                <td>:</td>
                <td>
                    {{$data->user->divisi->nama}}
                    @if ($data->user->subdivisi_id != null)
                        {{$data->user->subdivisi->nama}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Keperluan</td>
                <td>:</td>
                <td>{{$data->lab->name}}</td>
            </tr>
        </table>
        <br><br>
        <table style="width:100%" class="detail">
            <thead class="detail">
                <tr class="detail">
                    <th style="width: 5%">NO</th>
                    <th style="width: 30%">NAMA BARANG</th>
                    <th>NO. KATALOG</th>
                    <th>KEMASAN</th>
                    <th>JUMLAH</th>
                    <th>FOTO BARANG</th>
                    
                </tr>
            </thead>
            <tbody class="detail">
                @php
                    $no = 1;
                @endphp
                @foreach ($detail as $item)
                    <tr class="detail">
                        <td class="detail" style="text-align: center">{{$no}}</td>
                        <td class="detail"> {{$item->names}}</td>
                        <td class="detail"> {{$item->katalog}}</td>
                        <td class="detail"> {{$item->kemasan}} / {{$item->satuan->satuan}}</td>
                        <td class="detail" style="text-align: center">{{$item->jumlah}} {{$item->satuan->satuan}}</td>
                        <td class="detail">
                            <div class="gbr">
                                <img src="{{$item->getFoto()}}"  style="width:100px">
                            </div>
                        </td>
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
               </td>
               <td  style="text-align:center; vertical-align:top; height: 10%">Yang Meminta, </td>
            </tr>
            <tr>
                <td style="text-align:center;">
                </td>
                <td style="text-align:center;">
                    <u>{{$data->user->name}}</u> <br>
                    @if ($data->user->status == 'PNS')
                        (NIP. {{$data->user->no_pegawai}})
                    @endif
                </td>
            </tr>

        </table>
    </div>
</body>
</html>