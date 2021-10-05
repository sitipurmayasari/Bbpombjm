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
    <title>Laporan Peminjaman Kendaraan Dinas</title>
</head>
<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Peminjaman Kendaraan Dinas</b>
            </div><br>
            <div class="col-sm-12" style="text-align: left">
            @if ($request->tahun!="1")
                <label for="form-field-1" style="font-size: 14px;">tahun : {{$request->daftartahun}}</label>
            @endif
            </div><br>
            <div class="col-sm-12 table-responsive row" style="text-align: left">
                <table id="simple-table" class="table  table-bordered" style="font-size: 11px;" >
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align:middle;" width="20px">No</th>
                            <th style="text-align: center; vertical-align:middle;">Nomor</th>
                            <th style="text-align: center; vertical-align:middle;">Nama Pengaju</th>
                            <th style="text-align: center; vertical-align:middle;">Bidang</th>
                            <th style="text-align: center; vertical-align:middle;">Kendaraan Dinas</th>
                            <th style="text-align: center; vertical-align:middle;">Tanggal Pinjam</th>
                            <th style="text-align: center; vertical-align:middle;">Tujuan</th>
                            <th style="text-align: center; vertical-align:middle;">Driver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td style="vertical-align: top;">{{$no++}}</td>
                                <td style="vertical-align: top;">{{$item->code}}</td>
                                <td style="vertical-align: top;">{{$item->pegawai->name}}</td>
                                <td style="vertical-align: top;">{{$item->pegawai->divisi->nama}}</td>
                                <td style="vertical-align: top;">{{$item->car->merk}} ({{$item->car->police_number}})</td>
                                <td style="vertical-align: top;">{{$item->date_from}} <br> s/d <br> {{$item->date_to}} </td>
                                <td style="vertical-align: top;">{{$item->destination}}</td>
                                <td style="vertical-align: top;">
                                    @if ($item->driver_id != null)
                                        {{$item->supir->name}}
                                    @else
                                        -
                                    @endif
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