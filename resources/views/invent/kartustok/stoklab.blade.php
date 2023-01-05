@inject('injectQuery', 'App\InjectQuery')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
</head>
    <title>Laporan Permintaan Barang Keluar  {{$data->name}}</title>
</head>
<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Jumlah DPB Keluar </b><br>
                <b><i>{{$data->name}}</i></b>
            </div><br>
            <div style="text-align: left">
                <table style="width: 100%;font-size: 11px; margin-right:10px;" >
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align:middle;" width="5%">No</th>
                            <th style="text-align: center; vertical-align:middle;">Nama Barang</th>
                            <th style="text-align: center; vertical-align:middle;">kelompok Barang</th>
                            <th style="text-align: center; vertical-align:middle;">Jumlah Barang</th>
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