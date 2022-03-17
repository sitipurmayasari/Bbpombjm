<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Aduan Kerusakan TIK</title>
    <style>
         @page {
            size: A4 landscape;
            font-family: Arial;
            -moz-transform:rotate(-90deg) scale(.58,.58);
            -moz-transform:rotate(-90deg) scale(.58,.58);
        }

        table, tr, td, th{
            border:1px solid;
            border-collapse: collapse;
        }
         
    </style>
</head>
<body>
    <div class="col-sm-12" style="text-align: center;font-size: 18px;">
        <b>Laporan Daftar Aduan Kerusakan Barang</b>
    </div><br>
    <div class="col-sm-12" style="text-align: left">
    @if ($request->tahun!="1")
        <label for="form-field-1" style="font-size: 14px;">tahun : {{$request->daftartahun}}</label>
    @endif
    </div><br>
    <div class="col-sm-12 table-responsive row" style="text-align: left">
        <table style="width: 100%">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Nomor Aduan</th>
                    <th>Tanggal Aduan</th>
                    <th>Nama Pegawai</th>
                    <th>Daftar Barang</th>
                    <th>Masalah / Kerusakan</th>
                    <th>Tindak Lanjut</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td style="text-align: center">{{$no}}</td>
                        <td>{{$item->no_aduan}}</td>
                        <td>{{$item->tanggal}}</td>
                        <td>{{$item->lapor->name}}</td>
                        <td>{{$item->barang->nama_barang}}</td>
                        <td>{{$item->problem}}</td>
                        <td>
                            @if ($item->follow_up != null)
                                {{$item->follow_up}}
                            @else
                                Belum Diperiksa
                            @endif
                        </td>
                        <td>
                            @if ($item->result != null)
                                {{$item->result}}
                            @else
                                Belum Selesai
                            @endif
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach 
            </tbody>
        </table>
    </div><br><br>
</body>
</html>