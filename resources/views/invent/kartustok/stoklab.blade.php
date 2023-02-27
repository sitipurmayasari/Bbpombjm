@inject('injectQuery', 'App\InjectQuery')
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Format-Laporan-Stok-Lab.xls");
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
    <style>
        @page {
            size: A4;
            margin-top: 150px;
            margin-bottom: 100px;
            /* margin: 170px 0px 100px 0px; */
            font-family: 'Times New Roman';
            font-size: 11px;
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
    <title>Laporan Permintaan Barang Keluar  {{$data->name}}</title>
</head>
<body>
    <main>
        <div class="isi">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Jumlah DPB Keluar </b><br>
                <b><i>{{$data->name}}</i></b>
            </div><br>
            <div>
                <table style="width: 100%; font-size: 11px;" >
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama Barang</th>
                            <th>kelompok Barang</th>
                            <th style="width: 10%">Jumlah Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($stock as $item)
                            <tr>
                                <td style="text-align: center">{{$no++}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>
                                    {{$item->jenis->nama}}
                                </td>
                                <td style="text-align: center">
                                    {{$item->jumlah}}
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div><br><br>
        </div>
    </main>
</body>
</html>