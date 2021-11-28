@extends('layouts.mon')
@inject('injectQuery', 'App\InjectQuery')
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
            size: landscape;
            font-family: 'Times New Roman';
            font-size: 11px;      
    }

    table{
        width: 100%;
    }

    table, th, td, tr{
        border: 1px solid black;
    }

    th{
        text-align: center;
    }
 
    }
    .tbl{
        border-collapse: collapse;
        border: none;
    }
    td{
        padding-left: 3px;
        border-bottom: 0;
        border-top: 0;
        vertical-align: top;
    }

    .ttdini{
            text-align: center;
            font-size: 12;
            border-collapse: collapse;
            border: none;
        }
    
</style>

<div class="row">
    <br>
    <div class="header"  style="text-align: center">
        <b style="font-size: 18px;">RENSTRA  TAHUN {{$kepala->yearfrom}}-{{$kepala->yearto}}</b> <br>
        <i style="font-size: 14px;">( Renstra {{$kepala->yearfrom}}-{{$kepala->yearto}} Target Nasional )</i>
    </div>
    <table id="isi" style="width: 100%">
        <thead>
            <tr>
                <th style="width: 5%" rowspan="2">No</th>
                <th rowspan="2"  style="width: 10%">Perspektif</th>
                <th rowspan="2" style="width: 20%">Sasaran Kinerja</th>
                <th rowspan="2" style="width: 30%">Indikator Kinerja</th>
                <th colspan="5">Target Nasional</th>
            </tr>
            <tr>
                @foreach ($thn as $item)
                <th>{{$item->tahun}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="tbl">
            @php 
                $no=1;
                $target="";
                $pers="";
            @endphp
            @foreach ($indi as $key=>$row)
                <tr style="text-align: center">
                    <td style="text-align: center">{{$no++}}</td>
                    @if ($pers!=$row->target->perspective_id)
                        @php
                            $hitung = $injectQuery->getPers($row->target->perspective_id);
                            $cell = $hitung->rowing;
                        @endphp
                        <td rowspan="{{$cell}}" style="text-align: left">
                            {{$row->target->pers->name}}
                        </td>
                    @endif
                    @if ($target!=$row->target_id)
                        @php
                            $hitung =$injectQuery->getTarget($row->target_id);
                            $cell = $hitung->rowing;
                        @endphp
                        <td rowspan="{{$cell}}" style="text-align: left">
                            {{$row->target->name}}
                        </td>
                    @endif
                    <td style="text-align: left">{{$row->indicator}}</td>
                    @foreach ($thn as $item)
                        @php
                            $nilai =$injectQuery->getRenstra($kepala->id,$item->tahun, $row->id);
                        @endphp
                        <td style="vertical-align: middle;">{{$nilai->persentages}}</td>
                    @endforeach
                </tr>
                @php
                    $target=$row->target_id;
                    $pers=$row->target->perspective_id;
                @endphp
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="ttdini"  style="width: 30%; float: right;">
        <tr class="ttdini" >
            <td class="ttdini" >Banjarmasin, 
                @php
                    $a = $kepala->dates;
                    echo tgl_indo($a); 
                @endphp
                
            </td>
        </tr>
        <tr class="ttdini" >
            <td class="ttdini" style="text-align: center"><b>
                @if ($menyetujui->pjs !=null)
                {{$menyetujui->pjs}} Kepala BBPOM di Banjarmasin
                @else
                    Kepala BBPOM di Banjarmasin
                @endif
                </b></td>
        </tr>
        <tr class="ttdini" >
            <td class="ttdini" class="ttdini" style="text-align: center"><br><br><br><br></td>
        </tr>
        <tr class="ttdini" >
            <td class="ttdini" class="ttdini" style="text-align: center"><b>{{$menyetujui->user->name}}</b></td>
        </tr>
    </table>
</div>

@endsection
