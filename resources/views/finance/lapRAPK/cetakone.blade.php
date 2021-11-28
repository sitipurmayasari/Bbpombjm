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
        <b style="font-size: 18px;">CAPAIAN RENCANA AKSI PERJANJIAN KINERJA (RAPK) TAHUN {{$kepala->years}}</b> <br>
        <b style="font-size: 18px;">BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</b> <br>
        <i style="font-size: 14px;">TRIWULAN 
            @if ($kepala->triwulan=="TWI")
                I
            @elseif ($kepala->triwulan=="TWII")
               II
            @elseif ($kepala->triwulan=="TWIII")
               III
            @else
                IV
            @endif
        </i>
    </div>
    <table id="isi" style="width: 100%">
        <thead>
            <tr>
                <th rowspan="2" style="width: 20%">Sasaran Kinerja</th>
                <th rowspan="2" style="width: 30%">Indikator Kinerja</th>
                <th rowspan="2" >Target Tahunan</th>
                <th rowspan="2" >Target {{$kepala->triwulan}}</th>
                <th rowspan="2" >Realisasi {{$kepala->triwulan}}</th>
                <th colspan="2" >Capaian Terhadap Target {{$kepala->triwulan}}</th>
                <th colspan="2" >Capaian Terhadap Target Tahunan</th>
            </tr>
            <tr>
                <th>%</th>
                <th>Kriteria</th>
                <th>%</th>
                <th>Kriteria</th>
            </tr>
        </thead>
        <tbody class="tbl">
            @php 
                $no=1;
                $target="";
            @endphp
            @foreach ($data as $key=>$row)
                <tr style="text-align: center">
                    @if ($target!=$row->indi->target_id)
                        @php
                            $hitung =$injectQuery->getTarget($row->indi->target_id);
                            $cell = $hitung->rowing;
                        @endphp
                        <td rowspan="{{$cell}}" style="text-align: left">
                            {{$row->indi->target->name}}
                        </td>
                    @endif
                    <td style="text-align: left">{{$row->indi->indicator}}</td>
                    <td>
                        @php
                            $nilai =$injectQuery->getRenstrakal($kepala->eselon->renstrakal_id, $kepala->years,$row->indicator_id);
                            $renstra = $nilai->persentages;
                        @endphp
                        {{$renstra}}
                    </td>
                    <td>
                        @php
                            $nilai =$injectQuery->geteselontw($kepala->eselontwo_id,$row->indicator_id);
                            if ($kepala->triwulan=="TWI") {
                                $target = $nilai->twI;
                            } else if ($kepala->triwulan=="TWII") {
                                $target = $nilai->twII;
                            } else if ($kepala->triwulan=="TWIII") {
                                $target = $nilai->twIII;
                            } else {
                                $target = $nilai->twIV;
                            }
                        @endphp
                        {{$target}}
                    </td>
                    <td>
                        {{$row->realisasi}}
                    </td>
                    <td>
                        {{$row->hasil}}
                    </td>
                    <td>
                        @php
                            $hsl = $row->hasil;
                            $KriteriaTW =$injectQuery->getKriteriaTW($hsl);
                        @endphp
                          {{$KriteriaTW->kriteria}}
                    </td>
                    <td>
                        {{$row->hasiltahun}}
                    </td>
                    <td>
                        @php
                            $KriteriaTH =$injectQuery->getKriteriaTH($row->hasiltahun);
                        @endphp
                        {{$KriteriaTH->kriteria}}
                    </td>
                </tr>
                @php
                    $target=$row->indi->target_id;
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
