<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Rekapitulasi Si Amat Periode {{$request->tahun}}{{$request->bulan}}</title>

    <style>
        @page {
            size: A4 landscape;
            font-family: 'Arial';
            font-size: 10;
        }

        th,td{
            vertical-align: middle;
            text-align: center;
        }

        thead, tfoot td{
            color: white;
            background-color:  rgb(153, 149, 149);
        }

        </style>

</head>  
<body>
    <br>
    <div style="text-align: center">
        <h5><b>LAPORAN POIN SI AMAT</b></h5>
    </div>
    <br>
    <p>
        Periode :
                    @php
                        if ($request->bulan=='1') {
                            $bulan = "Januari";
                        } else if($request->bulan=='2') {
                            $bulan = "Februari";
                        } else if($request->bulan=='3') {
                            $bulan = "Maret";
                        } else if($request->bulan=='4') {
                            $bulan = "April";
                        } else if($request->bulan=='5') {
                            $bulan = "Mei";
                        } else if($request->bulan=='6') {
                            $bulan = "Juni";
                        } else if($request->bulan=='7') {
                            $bulan = "Juli";
                        } else if($request->bulan=='8') {
                            $bulan = "Agustus";
                        } else if($request->bulan=='9') {
                            $bulan = "September";
                        } else if($request->bulan=='10') {
                            $bulan = "Oktober";
                        } else if($request->bulan=='11') {
                            $bulan = "November";
                        } else {
                            $bulan = "Desember";
                        }
                    @endphp
                   {{$bulan}}
                {{$request->tahun}}
    </p>
    <div class="table-responsive">
        <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
               <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jadwal Kerja</th>
                <th>Scan Masuk</th>
                <th>Scan Pulang</th>
                <th>Terlambat</th>
                <th>Pulang Cepat</th>
                <th>Keterangan</th>
                <th>Poin</th>
               </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $item)
                <tr>
                    <td>{{$no}}</td>
                    <td style="text-align: left">{{$item->peg->name}}</td>
                    <td>{{tgl_indo($item->tanggal)}}</td>
                    <td>
                        @php
                            $c = date('D', strtotime($item->tanggal));
                            if ($c=='sun') {
                            $days='Minggu';
                            }else if ($c=='Mon') {
                                $days='Senin';
                            }else if ($c=='Tue') {
                                $days='Selasa';
                            }else if ($c=='Wed') {
                                $days='Rabu';
                            }else if ($c=='Thu') {
                                $days='Kamis';
                            }else if ($c=='Fri') {
                                $days='Jumat';
                            }else{
                                $days='Sabtu';
                            };
                        @endphp
                        {{$days}}
                    </td>
                    <td>{{$item->scan_masuk}}</td>
                    <td>{{$item->scan_pulang}}</td>
                    <td>{{$item->terlambat}}</td>
                    <td>{{$item->pulang_cepat}}</td>
                    <td>{{$item->status->ket}}</td>
                    <td>{{$item->poin}}</td>
                </tr>
                @php
                     $no++;
                @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"></td>
                    <td>{{$lambat->total}} menit</td>
                    <td>{{$pulang->total}} menit</td>
                    <td>Grand Total</td>
                    <td>{{$total->poin}}</td>
                </tr>
                <tr>
                    <td colspan="8"></td>
                    <td>Total Keterlambatan</td>
                    <td>
                        @php
                            $a = $lambat->total;
                            $b = $pulang->total;
                            $c = $a+$b;
                        @endphp
                        {{$c}} menit
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    
</body>

</html>