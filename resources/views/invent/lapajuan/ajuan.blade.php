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
    <title>Pengajuan Barang</title>
</head>
<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Daftar Pengajuan Barang</b>
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
                            <th width="20px">No</th>
                            <th>Nomor Ajuan</th>
                            <th>Tanggal Pengajuan/th>
                            <th>Nama Pengaju</th>
                            <th>Kelompok Barang</th>
                            <th>Daftar Barang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->no_ajuan}}</td>
                                <td>{{$item->tgl_ajuan}}</td>
                                <td>{{$item->lapor->name}}</td>
                                <td>{{$item->kelompok}}</td>
                                <td>
                                    @php
                                        $daftarajuan = $injectQuery->getDaftarBrgAjuan($item->id)
                                    @endphp
                                        @foreach ($daftarajuan as $key=>$isi)
                                            - {{$isi->nama_barang}}  ({{$isi->jumlah}} {{$isi->satuan->satuan}})<br>
                                        @endforeach 
                                </td>
                                <td>
                                    @if ($item->status=='0')
                                        Menunggu
                                    @elseif ($item->status=='1')
                                        Sedang Diperiksa
                                    @else
                                        Selesai
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