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
            font-size: 10;
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
        periode :
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
        {{$request->daftartahun}}
    </div><br>
    <div class="col-sm-12 table-responsive row" style="text-align: left">
        <table style="width: 100%">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Nomor Aduan</th>
                    <th>Tanggal Aduan</th>
                    <th>Nama Pegawai</th>
                    <th>Nama Barang</th>
                    <th style="width: 20%">Masalah / Kerusakan</th>
                    <th style="width: 20%">Tindak Lanjut</th>
                    <th style="width: 15%">Hasil</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td style="text-align: center">{{$no}}</td>
                        <td>{{$item->aduan->no_aduan}}</td>
                        <td>{{$item->aduan->tanggal}}</td>
                        <td>{{$item->aduan->lapor->name}}</td>
                        <td>
                            {{$item->barang->nama_barang}}  {{$item->barang->merk}}
                        </td>
                        <td>
                            {{$item->keterangan}}
                        </td>
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