<!DOCTYPE html>
<html lang="en">
<head>
    @inject('injectQuery', 'App\InjectQuery')
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
            font-size: 12;
            margin-left: 10%;
            margin-right: 10%;
            line-height: 2;
        }
        
        table, td, tr {
            /* text-align: justify; */
            vertical-align: top;
            line-height: 2;
            
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
                PERJANJIAN KINERJA TAHUN {{$data->years}} <br>
                BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN
           </b>
       </div>
       <br>
    </div>
    <div id="isi">
        <p style="text-align: justify;">
            Dalam rangka mewujudkan manajemen pemerintahan yang efektif, 
                    transparan, dan akuntabel serta berorientasi pada hasil, 
                    kami yang bertanda tangan di bawah ini:
        </p>
        <table style="width: 100%">
            <tr>
                <td>Nama</td>
                <td style="width:85%;">: 
                    <b>{{$data->pejabat->name}} </b>
                </td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: 
                    <b>{{$data->pejabat->deskjob}}</b>
                </td>
            </tr>
            <tr>
                <td colspan="3">Selanjutnya disebut <b>Pihak Pertama</b></td>
            </tr>
            <tr>
                <td colspan="3">Menyatakan dengan sesungguhnya bahwa :</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td style="width:85%;">: 
                    <b>{{$data->kapom->name}}</b>
                </td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: 
                    <b>{{$data->kapom->deskjob}}</b>
                </td>
            </tr>
            <tr>
                <td colspan="3">selaku atasan langsung pihak pertama, selanjutnya disebut <b>Pihak Kedua</b></td>
            </tr>
        </table>
        <p style="text-align: justify;">
            Pihak  Pertama  berjanji  akan  mewujudkan  target  kinerja  yang  seharusnya sesuai lampiran perjanjian ini, 
            dalam rangka mencapai target kinerja jangka menengah seperti yang telah ditetapkan dalam dokumen perencanaan. 
            Keberhasilan dan kegagalan pencapaian target kinerja tersebut menjadi tanggung jawab kami.
        </p>
        <p style="text-align: justify;">
            Pihak Kedua akan melakukan supervisi yang diperlukan serta akan melakukan evaluasi terhadap capaian kinerja 
            dari perjanjian ini dan mengambil tindakan yang diperlukan dalam rangka pemberian penghargaan dan sanksi.
        </p>
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
            <thead style="background: greenyellow">
                <tr>
                    <th class="tabelisi" style="width: 40%">Sasaran Kinerja</th>
                    <th class="tabelisi" style="width: 50%">Indikator Kinerja</th>
                    <th class="tabelisi" style="width: 10%">Target</th>
                </tr>
            </thead>
            <tbody>
                {{-- @php
                    $target="";
                @endphp --}}
                @foreach ($isi as $item)
                     <tr>
                        {{-- @if ($target!=$item->indi->target_id)
                            @php
                                $hitung =$injectQuery->getTarget($item->indi->target_id);
                                $cell = $hitung->rows;
                            @endphp
                            <td class="tabelisi" rowspan="{{$cell}}">{{$item->indi->target->name}}</td>
                        @endif --}}
                        <td class="tabelisi" >{{$item->indi->target->name}}</td>
                        <td class="tabelisi">{{$item->indi->indicator}}</td>
                        <td class="tabelisi" style="text-align: center;">{{$item->persentages}}</td>
                    </tr>
                {{-- @php
                    $target=$item->indi->target_id;
                @endphp --}}
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