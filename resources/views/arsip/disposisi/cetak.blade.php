<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
    <title>Rekapitulasi Surat Masuk / Disposisi</title>
    <style>
        @page {
            size: A4 landscape;
            font-family: 'Times New Roman';
            line-height: 1;
            margin: 50px 30px 30px 50px;
        }

        #header{
            text-align: center;
            font-weight: bold;
        }

        hr.s5 {
            height:5px;
            border-top:2px solid black;
            border-bottom:1px solid black;
        }

        table{
            width: 100%;
            
        }

    </style>
</head>
<body>
    <div id="header">
        REKAPITULASI SURAT MASUK (DISPOSISI) <br>
        PERIODE
        @if ($request->piltgl==1)
            @php
                if ($request->daftarbulan=='1') {
                    $bulan = "JANUARI";
                } else if($request->daftarbulan=='2') {
                    $bulan = "FEBRUARI";
                } else if($request->daftarbulan=='3') {
                    $bulan = "MARET";
                } else if($request->daftarbulan=='4') {
                    $bulan = "APRIL";
                } else if($request->daftarbulan=='5') {
                    $bulan = "MEI";
                } else if($request->daftarbulan=='6') {
                    $bulan = "JUNI";
                } else if($request->daftarbulan=='7') {
                    $bulan = "JULI";
                } else if($request->daftarbulan=='8') {
                    $bulan = "AGUSTUS";
                } else if($request->daftarbulan=='9') {
                    $bulan = "SEPTEMBER";
                } else if($request->daftarbulan=='10') {
                    $bulan = "OKTOBER";
                } else if($request->daftarbulan=='11') {
                    $bulan = "NOVEMBER";
                } else {
                    $bulan = "DESEMBER";
            }
            @endphp    
            {{$bulan}}  {{$request->daftartahun}}       
        @elseif($request->piltgl==2)    
            {{tgl_indo($request->awal)}} S/D {{tgl_indo($request->akhir)}}
        @else
            {{$request->daftartahun}} 
        @endif
        <br>
        BALAI BESAR POM DI BANJARMASIN
    </div>
    <hr class="s5">
    <br>
    <div>
        <table>
            <thead>
                <th width="40px">No</th>
                <th>Tanggal</th>
                <th>No. Disposisi</th>
                <th>Tanggal Surat</th>
                <th>No. Surat</th>
                <th>Asal Surat</th>
                <th>Hal</th>
                <th>Tujuan Disposisi</th>
                <th>Keterangan</th>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td style="text-align: center;">{{$no}}</td>
                        <td>{{$item->tanggal}}</td>
                        <td>{{$item->no_agenda}}</td>
                        <td>{{$item->tgl_surat}}</td>
                        <td>{{$item->no_surat}}</td>
                        <td>{{$item->pengirim}}</td>
                        <td>{{$item->hal}}</td>
                        <td>
                            @if  ($item->divisi_id != null)
                                {{$item->div->nama}}  
                            @else
                                Belum Terdisposisi
                            @endif
                        </td>
                        <td>{{$item->hal}}</td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                @endforeach
            </tbody>
        </table>   
    </div>
</body>
</html>