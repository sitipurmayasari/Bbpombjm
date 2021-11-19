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
    <title>Laporan Stok Barang {{$data->nama_barang}}</title>
</head>
<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Kartu Stok</b><br>
                <b><i>{{$data->nama_barang}}</i></b>
            </div><br>
            <div class="col-sm-12" style="text-align: left">
                Periode :
                @if ($request->bulan!="1")
                    @php
                        if ($request->daftarbulan=='1') {
                            $bulan = "Januari";
                        } else if($request->daftarbulan=='2') {
                            $bulan = "Februari";
                        } else if($request->daftarbulan=='3') {
                            $bulan = "Maret";
                        } else if($request->daftarbulan=='4') {
                            $bulan = "April";
                        } else if($request->daftarbulan=='5') {
                            $bulan = "Mei";
                        } else if($request->daftarbulan=='6') {
                            $bulan = "Juni";
                        } else if($request->daftarbulan=='7') {
                            $bulan = "Juli";
                        } else if($request->daftarbulan=='8') {
                            $bulan = "Agustus";
                        } else if($request->daftarbulan=='9') {
                            $bulan = "September";
                        } else if($request->daftarbulan=='10') {
                            $bulan = "Oktober";
                        } else if($request->daftarbulan=='11') {
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
                <table id="simple-table" class="table  table-bordered" style="font-size: 11px;" >
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align:middle;" width="20px">No</th>
                            <th style="text-align: center; vertical-align:middle;">Tanggal Masuk</th>
                            <th style="text-align: center; vertical-align:middle;">Tanggal Expired</th>
                            <th style="text-align: center; vertical-align:middle;">Barang Masuk</th>
                            <th style="text-align: center; vertical-align:middle;">Barang Keluar</th>
                            <th style="text-align: center; vertical-align:middle;">Sisa</th>
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
                               <td>{{tgl_indo($item->exp_date)}}</td>
                               <td style="text-align: center">{{$item->stockawal}} {{$item->barang->satuan->satuan}}</td>
                               <td style="text-align: center">{{$item->keluar}}  {{$item->barang->satuan->satuan}}</td>
                               <td style="text-align: center">{{$item->stock}}  {{$item->barang->satuan->satuan}}</td>
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