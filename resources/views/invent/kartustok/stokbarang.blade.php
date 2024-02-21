@inject('injectQuery', 'App\InjectQuery')
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Format-Laporan-Stok-Barang.xls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/print.css')}}" rel="stylesheet"> --}}
</head>
    <title>Laporan Stok Barang {{$data->nama_barang}}</title>
    <style>
        @page {
            size: A4;
            margin-top: 150px;
            margin-bottom: 100px;
            /* margin: 170px 0px 100px 0px; */
            font-family: 'Times New Roman';
            font-size: 11;
            page-break-after: always;
        }

        .isi{
            margin-left: 8%;
            margin-right: 8%;
            /* width: 100%; */
        }

        header {
                position:fixed;
                padding-top: 0%;
                /* height: 15%; */
                top: 0%;
                margin-left: 5%;
                margin-right: 5%;
                margin-top: -150px;
        }

        table{
            width: 100%;
            font-size: 11;
        }

        table,tr,td, th{
            border: solid black 1px;
            vertical-align: top;
        }

        th{
            text-align: center;
            vertical-align: middle;
        }

    </style>
</head>
<body>
    {{-- <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header> --}}
    <main>
        <div class="isi">
            <div class="col-sm-12" style="text-align: center;font-size: 16;;">
                <b>Laporan Kartu Stok</b><br>
                <b><i>{{$data->nama_barang}}</i></b> <br>
                kode :  {{$item->kode_barang}}
            </div><br>
            <div class="col-sm-12" style="text-align: left;" >
                Periode :
                @if ($now!="1")
                    @php
                        if ($now=='1') {
                            $bulan = "Januari";
                        } else if($now=='2') {
                            $bulan = "Februari";
                        } else if($now=='3') {
                            $bulan = "Maret";
                        } else if($now=='4') {
                            $bulan = "April";
                        } else if($now=='5') {
                            $bulan = "Mei";
                        } else if($now=='6') {
                            $bulan = "Juni";
                        } else if($now=='7') {
                            $bulan = "Juli";
                        } else if($now=='8') {
                            $bulan = "Agustus";
                        } else if($now=='9') {
                            $bulan = "September";
                        } else if($now=='10') {
                            $bulan = "Oktober";
                        } else if($now=='11') {
                            $bulan = "November";
                        } else {
                            $bulan = "Desember";
                        }
                    @endphp
                   {{$bulan}}
                @endif
                {{$request->years}}
            </div><br>
            <div class="col-sm-12 table-responsive row" style="text-align: left">
                <table >
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align:middle;" width="20px">No</th>
                            <th style="text-align: center; vertical-align:middle;">Tanggal</th>      
                            <th style="text-align: center; vertical-align:middle;">Masuk</th>
                            <th style="text-align: center; vertical-align:middle;">Keluar</th>
                            <th style="text-align: center; vertical-align:middle;">Sisa</th>
                            <th style="text-align: center; vertical-align:middle;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($stock as $item)
                            <tr>
                               <td style="text-align: center">{{$no}}</td>
                               <td>{{tgl_indo($item->entry_date)}}</td>
                               <td style="text-align: center">{{$item->stockawal}} {{$item->barang->satuan->satuan}}</td>
                               <td style="text-align: center">{{$item->keluar}}  {{$item->barang->satuan->satuan}}</td>
                               <td style="text-align: center">{{$item->stock}}  {{$item->barang->satuan->satuan}}</td>
                               <td>
                                    @if ($item->barang->kind == 'L' && $item->exp_date != null)
                                        Exp. Date : {{$item->exp_date}}
                                    @else
                                        -
                                    @endif
                               </td>
                            </tr>
                            @php
                                $no++
                            @endphp
                        @endforeach 
                    </tbody>
                </table>
            </div><br><br>
        </div>
    </main>
</body>
</html>