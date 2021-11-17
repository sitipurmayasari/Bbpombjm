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
        <b style="font-size: 18px;">NILAI PENCAPAIAN STRATEGIS TAHUN {{$kepala->years}}</b> <br>
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
                <th colspan="3" >Indikator Kinerja</th>
                <th colspan="3" >Sasaran Kinerja</th>
                <th colspan="3" >Perspektif</th>
               
            </tr>
            <tr>
                <th>% Capaian</th>
                <th>NPS IK</th>
                <th>Kriteria</th>
                <th>% Capaian</th>
                <th>NPS SK</th>
                <th>Kriteria</th>
                <th>% Capaian</th>
                <th>NPS Perspektif</th>
                <th>Kriteria</th>
            </tr>
        </thead>
        <tbody class="tbl">
            @php 
                $no=1;
                $target="";
                $pers="";
            @endphp
            @foreach ($data as $key=>$row)
                <tr style="text-align: center">
                    @if ($target!=$row->indi->target_id)
                        @php
                            $hitung =$injectQuery->getTarget($row->indi->target_id);
                            $cell = $hitung->rows;
                        @endphp
                        <td rowspan="{{$cell}}" style="text-align: left">
                            {{$row->indi->target->name}}
                        </td>
                    @endif
                    <td style="text-align: left">{{$row->indi->indicator}}</td>
                    <td>
                        {{$row->hasil}}
                    </td>
                    <td>
                        {{$row->nps}}
                    </td>
                    <td>
                        @php
                            $kriteriaIK =$injectQuery->getKriteriaTW($row->nps);
                        @endphp
                            {{$kriteriaIK->kriteria}}
                    </td>
                    @if ($target!=$row->indi->target_id)
                        @php
                            $hitung =$injectQuery->getTarget($row->indi->target_id);
                            $cell = $hitung->rows;

                            $avgSK=$injectQuery->getAVGSK($row->indi->target_id);
                            $nilaiSK = round($avgSK->hasil,2);
                        @endphp

                        <td rowspan="{{$cell}}" style="text-align: center">
                            {{$nilaiSK}}
                        </td>
                        <td rowspan="{{$cell}}" style="text-align: center">
                           @php
                                $sesuaiSK = $nilaiSK <= '120' ? $nilaiSK : '120';
                           @endphp
                            {{$sesuaiSK}}
                        </td>
                        <td rowspan="{{$cell}}" style="text-align: center">
                            @php
                                $kriteriaSK =$injectQuery->getKriteriaTW($sesuaiSK);
                            @endphp
                                {{$kriteriaSK->kriteria}}
                        </td>
                        @if ($pers!=$row->indi->target->perspective_id)
                            @php
                                $hitung = $injectQuery->getPers($row->indi->target->perspective_id);
                                $cell = $hitung->rows;

                                $avgPers=$injectQuery->getAVGPers($row->indi->target->perspective_id);
                                $nilaiPers = round($avgPers->hasil,2);
                            @endphp

                            <td rowspan="{{$cell}}" style="text-align: left">
                                {{$nilaiPers}}
                            </td>
                        @endif
                        <td rowspan="{{$cell}}" style="text-align: center">
                            @php
                                 $sesuaiPers = $nilaiPers <= '120' ? $nilaiPers : '120';
                            @endphp
                             {{$sesuaiPers}}
                         </td>
                         <td rowspan="{{$cell}}" style="text-align: center">
                            @php
                                $kriteriaPers =$injectQuery->getKriteriaTW($sesuaiPers);
                            @endphp
                                {{$kriteriaPers->kriteria}}
                        </td>
                    @endif
                    
                </tr>
                @php
                    $target=$row->indi->target_id;
                    $pers=$row->indi->target->perspective_id;
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
