@extends('layouts.mon')
@section('breadcrumb')
    <div>
        <button type="button" class="btn btn-primary no-border btn-sm noPrint" 
            id="PrintPage" onclick="window.print();">
            <i class="ace-icon fa fa-print icon-on-right bigger-110"></i> &nbsp; cetak
        </button>
    </div>
    
@endsection
@section('content')

<style>
    @page {
            font-family: 'Times New Roman';
            font-size: 11px;
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

    .header {
        margin-left: 5%;
        margin-right: 5%;
        margin-bottom: 5%
    }
    
</style>

<div class="row">
    <div class="col-sm-12 header">
        <table class="tbl" >
            <tr class="tbl">
                <td colspan="3" class="tbl" style="text-align: center;"><b><h4>RINCIAN KERTAS KERJA SATKER T.A {{$request->tahun}}</h4></b></td>
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
                <td class="tbl">(432881)</td>
                <td class="tbl">BALAI BESAR PENGAWAS OBAT DAN MAKANAN BANJARMASIN</td>
            </tr>
            <tr class="tbl">
                <td class="tbl"><b>ALOKASI</b></td>
                <td class="tbl">
                    @php
                        $angka = $alokasi->jum;
                        echo "Rp. " . number_format($angka, 2, ".", ",");
                    @endphp
                </td>
            </tr>
        </table>
    </div>
    
    <div class="col-sm-12">
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
                        $progcode="";
                        $activitycode="";
                        $krocode="";
                        $detcode="";
                        $komcode="";
                        $subcode="";
                        $akuncode="";
                        
                    @endphp
                    @foreach ($data as $item)
                        @if ($progcode != $item->implemen->act->prog->id)
                            <tr>
                                <td style="color: navy;">
                                    <b>{{$item->implemen->act->prog->unit->klcode->code}}.{{$item->implemen->act->prog->unit->code}}.{{$item->implemen->act->prog->code}}</b>
                                </td>
                                <td style="color: navy;">
                                    <b>{{$item->implemen->act->prog->name}}</b><br>
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right; color: navy;">
                                    <b>
                                        @foreach ($prog as $ini)
                                            @if ($item->implemen->act->programcode_id == $ini->programcode_id)
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
                        @if ($activitycode != $item->implemen->act->id)
                            <tr>
                                <td style="color: blue;">
                                    <b>{{$item->implemen->act->code}}</b>
                                </td>
                                <td style="color: blue;">
                                    <b>{{$item->implemen->act->name}}</b><br>
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right; color: blue;">
                                    <b>
                                        @foreach ($activ as $ini)
                                            @if ($item->implemen->activitycode_id == $ini->activitycode_id)
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
                        @if ($krocode != $item->implemen->kro->id) 
                            <tr>
                                <td style="border-bottom:dashed; color: red; border-bottom-color: black;">
                                    <b>{{$item->implemen->act->code}}.{{$item->implemen->kro->code}}</b>
                                </td>
                                <td style="border-bottom:dashed; color: red; border-bottom-color: black;">
                                    <b>{{$item->implemen->kro->name}}</b><br>
                                </td>
                                <td style="border-bottom:dashed; color: red; border-bottom-color: black;"> 1.0 Lembaga</td>
                                <td style="border-bottom:dashed;"></td>
                                <td style="text-align: right; border-bottom:dashed; color: red; border-bottom-color: black;">
                                    <b>
                                        @foreach ($add as $ini)
                                            @if ($item->implemen->krocode_id == $ini->krocode_id)
                                                @php
                                                    $angka = $ini->jum  ;
                                                    echo "Rp. " . number_format($angka, 2, ".", ",");
                                                @endphp
                                            @endif
                                        @endforeach
                                    </b>
                                </td>
                                <td style="border-bottom:dashed;"></td>
                            </tr>
                        @endif
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
                                <td style="text-align: right;">
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
                            $progcode       = $item->implemen->act->prog->id;
                            $activitycode   = $item->implemen->act->id;
                            $krocode        = $item->implemen->kro->id;
                            $detcode        = $item->implemen->det->id;
                            $komcode        = $item->implemen->komponen->id;
                            $subcode        = $item->implemen->sub->id;
                            $akuncode       = $item->akun->id;
                        @endphp
                     @endforeach                           
                </tbody>
            </table>
    </div>
</div>

@endsection

@section('footer')
@endsection