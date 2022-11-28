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
            size: A4;
            font-family: 'Arial';
            font-size: 10;
        }

        th,td{
            vertical-align: middle;
            text-align: center;
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
                            $request->bulan = "Januari";
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
                <th>Poin</th>
                <th>Pelanggaran (menit)</th>
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
                    <td>{{$item->poin}}</td>
                    <td>{{$item->total}}</td>
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