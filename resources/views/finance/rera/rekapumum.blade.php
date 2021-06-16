<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
    <style>
        @page {
            size: A4;
            margin: 150px 0px 100px 0px;
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
                padding-top: 2%;
                /* height: 15%; */
                top: 0%;
                margin-left: 5%;
                margin-right: 5%;
                margin-top: -150px;
        }

        table{
            width: 100%;
        }
        table, th, td{
            border: 1px solid black;
        }

        th{
            text-align: center;
        }
        td{
            padding-left: 3px;
            border-bottom: 0;
            border-top: 0;
            vertical-align: top;
        }

        .tbl{
            border-collapse: collapse;
            border: none;
        }
        

    </style>
</head>
    <title>Document</title>
</head>
<body>
    <header class="isi">
        <table class="tbl" >
            <tr class="tbl">
                <td colspan="3" class="tbl" style="text-align: center;"><h4>RINCIAN KERTAS KERJA SATKER T.A {{$request->tahun}}</h4></td>
            </tr>
            <tr class="tbl">
                <td style="width: 20%;" class="tbl"><b>KEMEN/LEMB</b></td>
                <td style="width: 10%;" class="tbl">({{$head->act->prog->unit->klcode->code}})</td>
                <td style="width: 70%;" class="tbl">{{$head->act->prog->unit->klcode->name}}</td>
            </tr>
            <tr class="tbl">
                <td class="tbl"><b>UNIT ORG</b></td>
                <td class="tbl">({{$head->act->prog->unit->code}})</td>
                <td class="tbl">{{$head->act->prog->unit->name}}</td>
            </tr>
            <tr class="tbl">
                <td class="tbl"><b>UNIT KERJA</b></td>
                <td class="tbl">({{$head->act->prog->code}})</td>
                <td class="tbl">{{$head->act->prog->name}}</td>
            </tr>
        </table>
    </header>
    <main>
        <div class="isi">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2"><b>KODE</b></th>
                        <th rowspan="2" style="width: 40%; "><b>PROGRAM AKTIVITAS/ KRO/ RO/ KOOMPONEN/ SUBKOMP/ DETIL</b></th>  
                        <th colspan="3"><b>PERHITUNGAN TAHUN {{$request->tahun}}</b></th> 
                        <th rowspan="2"style="width: 5%;"><b>SD/CP</b></th>                  
                    </tr>
                    <tr>  
                        <th><b>VOLUME</b></th>  
                        <th><b>HARGA SATUAN</b></th>  
                        <th><b>JUMLAH BIAYA</b></th>                    
                    </tr>
                    <tr>
                        <th>(1)</th>
                        <th>(2)</th>  
                        <th>(3)</th>  
                        <th>(4)</th>  
                        <th>(5)</th>  
                        <th>(6)</th>                   
                    </tr>
                </thead>
                <tbody class="tbl">
                    @php
                        $no= 1;
                        $detcode="";
                        $komcode="";
                        $subcode="";
                        $akuncode="";
                    @endphp
                    @foreach ($data as $item)
                        @if ($detcode != $item->implemen->det->id)
                            <tr>
                                <td>
                                    <b>{{$item->implemen->act->code}}.{{$item->implemen->kro->code}}.{{$item->implemen->det->code}}</b>
                                </td>
                                <td>
                                    <b>{{$item->implemen->det->name}}</b><br>
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">
                                    <b>
                                        @foreach ($deta as $ini)
                                            @if ($item->implemen->detailcode_id == $ini->detailcode_id)
                                                @php
                                                    $angka = $ini->jum  ;
                                                    echo "Rp. " . number_format($angka, 2, ".", ",");
                                                @endphp
                                            @endif
                                        @endforeach
                                    </b>
                                </td>
                                <td></td>
                            </tr>
                        @endif
                        @if ($komcode != $item->implemen->komponen->id)
                            <tr>
                                <td>
                                    <b>{{$item->implemen->komponen->code}}</b>
                                </td>
                                <td>
                                    <b> {{$item->implemen->komponen->name}}</b>
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">
                                    <b>
                                        @foreach ($komp as $ini)
                                            @if ($item->implemen->komponencode_id == $ini->komponencode_id)
                                                @php
                                                    $angka = $ini->jum  ;
                                                    echo "Rp. " . number_format($angka, 2, ".", ",");
                                                @endphp
                                            @endif
                                        @endforeach
                                    </b>
                                </td>
                                <td></td>
                            </tr>
                        @endif
                        @if ($subcode != $item->implemen->sub->id)
                            <tr>
                                <td>
                                    {{$item->implemen->sub->code}}
                                </td>
                                <td>
                                    {{$item->implemen->sub->name}}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        @if ($akuncode != $item->akun->id)
                            <tr>
                                <td>
                                    {{$item->akun->code}}
                                </td>
                                <td>
                                    {{$item->akun->name}}
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;">
                                    @foreach ($akun as $ini)
                                        @if ($item->accountcode_id == $ini->accountcode_id and $item->subcode_id == $ini->subcode_id)
                                            @php
                                                $angka = $ini->jum  ;
                                                echo "Rp. " . number_format($angka, 2, ".", ",");
                                            @endphp
                                        @endif
                                    @endforeach
                                </td>
                                <td style="text-align: center;">
                                    {{$item->sd}}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td></td>
                            <td>
                                {{$item->loka->nama}}
                            </td>
                            <td style="text-align: center;">{{$item->volume}}</td>
                            <td style="text-align: right;">
                                @php
                                    $angka = $item->price ;
                                    echo "Rp. " . number_format($angka, 2, ".", ",");
                                @endphp
                            </td>
                            <td style="text-align: right;">
                                @php
                                    $angka = $item->total ;
                                    echo "Rp. " . number_format($angka, 2, ".", ",");
                                @endphp
                            </td>
                            <td></td>
                        </tr>
                        @php
                            $detcode = $item->implemen->det->id;
                            $komcode = $item->implemen->komponen->id;
                            $subcode = $item->implemen->sub->id;
                            $akuncode = $item->akun->id;
                        @endphp
                     @endforeach                           
                </tbody>
            </table>
        </div>
    </main>
    
</body>
</html>