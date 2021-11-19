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
    <title>Laporan Stok Kelompok Barang {{$data->nama}}</title>
</head>
<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Sisa Stok</b><br>
                <b><i>{{$data->nama}}</i></b>
            </div><br>
            <div class="col-sm-12 table-responsive row" style="text-align: left">
                <table id="simple-table" class="table  table-bordered" style="font-size: 11px;" >
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align:middle;" width="20px">No</th>
                            <th style="text-align: center; vertical-align:middle;">Nama Barang</th>
                            <th style="text-align: center; vertical-align:middle;">Lokasi</th>
                            <th style="text-align: center; vertical-align:middle;">Stok</th>
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
                                   {{$item->location->nama}}
                            </td>
                               <td style="text-align: center">{{$item->stok}}  {{$item->satuan->satuan}}</td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div><br><br>
        </div>
    </main>
</body>
</html>