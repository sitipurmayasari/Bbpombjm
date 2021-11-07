<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/no_header.css')}}" rel="stylesheet">
    <title>Document</title>
    <style>
        @page {
            size: A4;
            margin: 150px 0px 100px 0px;
        }
        html, table{
            font-family: "Bookman Old Style";
        }
        #isi{
            font-family: "Bookman Old Style";
            font-size: 10;
            margin-left: 10%;
            margin-right: 10%;
            line-height: 2;
        }
        
        table, td, tr {
            text-align: justify;
            vertical-align: top;
            line-height: 2;
        }

        th{
            text-align: center;
        }

        .ttdini{
            float: right;
            margin-left: 15%;
            margin-right: 15%;
            font-size: 12;
        }


        .tabelisi{
            border: solid 1px;
        }

    </style>
</head>
<body>
    <div class="col-sm-12" style="text-align: center">
       <div style="align=center font-size: 12">
            <b>
                PERJANJIAN KINERJA TAHUN {{$data->years}} <br>
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
           <thead>
               <tr>
                   <th>Sasaran Kinerja</th>
                   <th>Indikator Kinerja</th>
                   <th>Target</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($isi as $item)
                   <tr>
                       <td>{{$item->indi->target->name}}</td>
                       <td>{{$item->indi->indicator}}</td>
                       <td style="text-align: center;">{{$item->persentages}}</td>
                   </tr>
               @endforeach
           </tbody>
       </table>
    </div>
    <br>
    <div class="ttdini">
        <table style="width: 100%">
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
                <td><br><br></td>
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