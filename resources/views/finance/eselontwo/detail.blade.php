@php
//     header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=DataEselonDua.xls");
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    @inject('injectQuery', 'App\InjectQuery')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/no_header.css')}}" rel="stylesheet"> --}}
    <title>Document</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 100px 50px 50px 50px;
            line-height: 1.5;
        }
        html, table{
            font-family: "Bookman Old Style";
        }
        #isi{
            font-family: "Bookman Old Style";
            font-size: 12;
            /* margin-left: 10%;
            margin-right: 10%; */ 
        }
        
        table, td, tr {
            /* text-align: justify; */
            vertical-align: top;
            /* border: solid; */
        }

        .ttdini{
            float: right;
            margin-left: 15%;
            margin-right: 15%;
            font-size: 12;
        }

        th{
            text-align: center;
        }

        .tabelisi{
            border: 1px solid black;
            border-collapse: collapse;
            margin-left: 15;
            margin-right: 15;

        }

    </style>
</head>
<body>
    <div class="col-sm-12" style="text-align: center">
        <div style="align=center font-size: 12">
             <b>
                 RENCANA AKSI PERJANJIAN KINERJA TAHUN {{$data->years}} <br>
                 BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN <br>
             </b>
             <i style="font-size: 11;">
                 @if ($renstra->types=="AWAL")
                     ( Renstra {{$renstra->yearfrom}}-{{$renstra->yearto}} BBPOM di Banjarmasin Tahun {{$data->years}})
                 @else
                     ( {{$renstra->types}} Renstra {{$renstra->yearfrom}}-{{$renstra->yearto}} BBPOM di Banjarmasin Tahun
                         {{$data->years}}
                 )
                 @endif
             </i>
        </div>
        <br>
     </div>
     <div id="isi">
        <table style="width: 100%" class="tabelisi">
            <thead style="background: greenyellow">
                <tr>
                    <th class="tabelisi" style="width: 25%" rowspan="2">Sasaran Kinerja</th>
                    <th class="tabelisi" style="width: 25%" rowspan="2">Indikator Kinerja</th>
                    <th class="tabelisi" rowspan="2">Target <br> Tahunan</th>
                    <th class="tabelisi"  colspan="12">Target Tahunan</th>
                </tr>
                <tr>
                    <th class="tabelisi">Jan</th>
                    <th class="tabelisi">Feb</th>
                    <th class="tabelisi">Mar</th>
                    <th class="tabelisi">Apr</th>
                    <th class="tabelisi">Mei</th>
                    <th class="tabelisi">Jun</th>
                    <th class="tabelisi">Jul</th>
                    <th class="tabelisi">Agt</th>
                    <th class="tabelisi">Sep</th>
                    <th class="tabelisi">Okt</th>
                    <th class="tabelisi">Nov</th>
                    <th class="tabelisi">Des</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $target="";
                @endphp
                @foreach ($ese as $item)
                    <tr>
                        <td class="tabelisi" >{{$item->indi->target->name}}</td>
                        <td class="tabelisi">{{$item->indi->indicator}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->setahun}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->jan}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->feb}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->mar}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->apr}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->mei}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->jun}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->jul}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->aug}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->sep}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->oct}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->nov}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->dec}}</td>
                    </tr>
                @php
                    $target=$item->indi->target_id;
                @endphp
                @endforeach
            </tbody>
        </table>
     </div>
     <br>
     <div class="ttdini">
         <table style="width: 100%">y8/n
             <tr>
                 <td ></td>
                 <td></td>
                 <td style="text-align: center;">Banjarmasin, {{tgl_indo($data->dates)}}
                 </td>
             </tr>
             <tr>
                 <td style="text-align: center;"><b>Pihak Kedua</b></td>
                 <td></td>
                 <td style="text-align: center;"><b>Pihak Pertama</b></td>
             </tr>
             <tr>
                <td style="height: 90px;"></td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td style="text-align: center; line-height: 0;">
                     <b>{{$data->kapom->name}}</b>
                 </td>
                 <td></td>
                 <td style="text-align: center; line-height: 0;">
                     <b>{{$data->pejabat->name}}</b>
                 </td>
             </tr>
         </table>
     </div>
</body>
</html>