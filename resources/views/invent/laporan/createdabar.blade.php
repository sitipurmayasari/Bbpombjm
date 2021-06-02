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
    <title>Document</title>
</head>
<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Daftar Inventaris</b>
            </div><br>
            <div class="col-sm-12" style="text-align: left">
            @if ($lokasi="")
                <label for="form-field-1" style="font-size: 14px;">lokasi : {{$lokasi}}</label><br>
            @endif
            @if ($request->tahun!="1")
                <label for="form-field-1" style="font-size: 14px;">tahun : {{$request->daftartahun}}</label>
            @endif
            </div><br>
            <div class="col-sm-12 table-responsive row" style="text-align: left">
                <table id="simple-table" class="table  table-bordered" style="font-size: 11px;" >
                    <thead>
                        <tr>
                            <th width="20px">No</th>
                            <th>Nama Barang</th>
                            <th>Merk / Type</th>
                            <th>No. Seri</th>
                            <th>Tanggal diterima</th>
                            <th>Lokasi</th>
                            <th>Penanggung Jawab</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1;  @endphp
                        @foreach ($data as $key=>$row)
                            <tr style="text-align: center">
                                <td style="text-align: center">{{$no++}}</td>
                                <td>{{$row->nama_barang}}</td>
                                <td>{{$row->merk}}</td>
                                <td>{{$row->no_seri}}</td>
                                <td>{{$row->tanggal_diterima}}</td>
                                <td>{{$row->location->nama}}</td>
                                <td>{{$row->penanggung->no_pegawai}}<br>{{$row->penanggung->name}}</td>
                                <td style="text-align: center">{{$row->jumlah_barang}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br><br>
        </div>
    </main>
   {{-- <footer>
    <img src="{{asset('images/kopsurat2.jpg')}}" style="width: 100%">
   </footer> --}}
    
</body>
</html>