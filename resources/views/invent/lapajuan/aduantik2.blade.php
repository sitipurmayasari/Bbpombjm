<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Aduan-Kerusakan-TIK.xls");
?>
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
        <b>Laporan Daftar Aduan Kerusakan TIK</b>
    </div><br>
    <div class="col-sm-12" style="text-align: left">
        Periode :
        @if ($request->piltgl==1)
            @php
                if ($request->daftarbulan=='1') {
                    $request->daftarbulan = "Januari";
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
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Aduan Kerusakan</th>
                    <th>Tanggal Analisa</th>
                    <th>Analisa Pemeriksa</th>
                    <th>Tanggal Tindak Lanjut</th>
                    <th>Tindak Lanjut</th>
                    <th>Tanggal Hasil Akhir</th>
                    <th>Hasil Akhir</th>
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
                        <td>{{$item->barang->kode_barang}}</td>
                        <td>{{$item->barang->nama_barang}}</td>
                        <td>{{$item->barang->jenisnya->kelompok}}</td>
                        <td>{{$item->trouble}}</td>
                        @if ($item->analisa != null)
                            <td>{{$item->analyze_date}}</td>
                            <td>{{$item->analisa}}</td>
                        @else
                            <td></td>
                            <td>Belum Diperiksa</td>
                        @endif
                        @if ($item->follow_up != null)
                            <td>{{$item->followup_date}}</td>
                            <td>{{$item->follow_up}}</td>
                        @else
                            <td></td>
                            <td>Belum Ditindak Lanjuti</td>
                        @endif
                        @if ($item->result != null)
                            <td>{{$item->result_date}}</td>
                            <td>{{$item->result}}</td>
                        @else
                            <td></td>
                            <td>Belum Ada Hasil Tindak Lanjut</td>
                        @endif
                       
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