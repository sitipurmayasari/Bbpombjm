@inject('PoaQuery', 'App\PoaQuery')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 100px 0px 100px 0px;
            font-family: 'Times New Roman';
            font-size: 11px;
            page-break-after: always;
      
        }

        .isi{
            margin-left: 8%;
            margin-right: 8%;
        }

        header {
                position:fixed;
                padding-top: 0%;
                /* height: 15%; */
                top: 0%;
                margin-left: 5%;
                margin-right: 5%;
                margin-top: -50px;
        }

        table, th, td, tr{
            border: 1px solid black;
            text-align: center;
            vertical-align: top;
        }

        table{
            width: 100%;
        }
        

    </style>
</head>
<body>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div style="align=center font-size: 18px">
                <b>Rekapitulasi Realisasi Anggaran Bulanan</b>
            </div>
            <br>
            <div>
                <label for="form-field-1" style="font-size: 14px;">
                    Periode :{{$request->tahun}}
                </label><br>
                <label for="form-field-1" style="font-size: 14px;"></label>
            </div>
         </div>
             <div class="table-responsive isi">
                 <table id="simple-table" class="table  table-bordered table-hover " style="font-size: 11px;" >
                     <thead style="text-align: center">
                         <tr>
                            <th width="10px" rowspan="2">No</th>
                            <th rowspan="2">Asal POK</th>
                            <th rowspan="2">Kode Akun</th>
                            <th rowspan="2">Lokasi</th>
                            <th colspan="{{$bulan->count()}}">Bulan</th>
                        </tr>
                        <tr>
                            @foreach ($bulan as $item)
                                <th>
                                    @if ($item->month == "1")
                                        Januari
                                    @elseif($item->month == "2")
                                        Februari
                                    @elseif($item->month == "3")
                                        Maret
                                    @elseif($item->month == "4")
                                        April
                                    @elseif($item->month == "5")
                                        Mei
                                    @elseif($item->month == "6")
                                        Juni
                                    @elseif($item->month == "7")
                                        Juli
                                    @elseif($item->month == "8")
                                        Agustus
                                    @elseif($item->month == "9")
                                        September
                                    @elseif($item->month == "10")
                                        Oktober
                                    @elseif($item->month == "11")
                                        November
                                    @else
                                        Desember
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                    <tbody>   	
                        @php $no=1;  @endphp
                        @foreach($data as $key=>$row)
                        <tr>
                             <td style="text-align: center">{{$no++}}</td>
                             <td>
                                @if ($row->asal_pok == 'AWAL(0)')
                                    AWAL
                                @else
                                    {{$row->asal_pok}} - {{$row->asal}}({{$row->kode_asal}})
                                @endif
                                 </td>
                             <td>{{$row->act}}/{{$row->sub}}/{{$row->akun}} </td>
                             <td>{{$row->nama}}</td>
                                @foreach ($bulan as $item)
                                <td>
                                    @php
                                        $q = $PoaQuery->nilaibulan($request->tahun,$item->month);
                                        echo $q;
                                    @endphp
                                </td>
                                @endforeach
                        </tr>
                        @endforeach
                    <tbody>
                 </table>
             </div>
    </main>
</body>
</html>