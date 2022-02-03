@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.app')
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
    th{
        padding-left: 3px;
        border-bottom: 0;
        border-top: 0;
        vertical-align: top;
    }

    .header {
        text-align: center;
    }

    .pjk{
        background:blue;
        color: white;
        text-align: center;
    }

    .plt{
        background:red;
        color: white;
        text-align: center;
    }

    .main{
        background:green;
        color: white;
        text-align: center;
    }
    
</style>

<div class="col-sm-12 header">
    <b><h4>
        MATRIKS TANGGAL MAINTENANCE DAN PAJAK KENDARAAN DINAS <br>
        TAHUN {{$now}}
    </h4></b>
</div>  

<div class="col-sm-12">
    <div class="col-sm-12">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Merk/Type</th>
                    <th>Nomor Polisi</th>
                    <th>JAN</th>
                    <th>FEB</th>
                    <th>MAR</th>
                    <th>APR</th>
                    <th>MEI</th>
                    <th>JUN</th>
                    <th>JUL</th>
                    <th>AGU</th>
                    <th>SEP</th>
                    <th>OKT</th>
                    <th>NOV</th>
                    <th>DES</th>
                </tr>  
            </thead>  
            <tbody>
                @php $no=1;  $a=1; @endphp
                @foreach($data as $key=>$row)
                    <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>
                            @if ($row->type=="M")
                                MOTOR
                            @else
                                MOBIL
                            @endif
                        </td>
                        <td>{{$row->merk}}</td>
                        <td>{{$row->police_number}}</td>
                        <td>
                            @php
                                $mon1 = '01';
                                $jan = $injectQuery->pajak($row->id,$now,$mon1);
                                $jadwal1 = $injectQuery->jadmain($row->id,$now,$mon1);

                                if ($jan != null) {
                                    $pajak1= date("d", strtotime($jan->tax_date));
                                    $plat1= date("d", strtotime($jan->police_number_date));
                                }else{
                                    $pajak1 = '';
                                    $plat1 = '';
                                } 
                                
                                if ($jadwal1 != null) {
                                    $main1 = date("d", strtotime($jadwal1->tanggal));
                                } else {
                                    $main1 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak1}}</div>
                            <div class="plt"> {{$plat1}}</div>
                            <div class="main"> {{$main1}}</div>
                        </td>
                        <td>
                            @php
                                $mon2 = '02';
                                $feb = $injectQuery->pajak($row->id,$now,$mon2);
                                $jadwal2 = $injectQuery->jadmain($row->id,$now,$mon2);

                                if ($feb != null) {
                                    $pajak2= date("d", strtotime($feb->tax_date));
                                    $plat2= date("d", strtotime($feb->police_number_date));
                                }else{
                                    $pajak2 = '';
                                    $plat2 = '';
                                } 
                                
                                if ($jadwal2 != null) {
                                    $main2 = date("d", strtotime($jadwal2->tanggal));
                                } else {
                                    $main2 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak2}}</div>
                            <div class="plt"> {{$plat2}}</div>
                            <div class="main"> {{$main2}}</div>
                        </td>
                        <td>
                            @php
                                $mon3 = '03';
                                $mar = $injectQuery->pajak($row->id,$now,$mon3);
                                $jadwal3 = $injectQuery->jadmain($row->id,$now,$mon3);

                                if ($mar != null) {
                                    $pajak3= date("d", strtotime($mar->tax_date));
                                    $plat3= date("d", strtotime($mar->police_number_date));
                                }else{
                                    $pajak3 = '';
                                    $plat3 = '';
                                } 
                                
                                if ($jadwal3 != null) {
                                    $main3 = date("d", strtotime($jadwal3->tanggal));
                                } else {
                                    $main3 = '';
                                }
                                
                            @endphp

                        <div class="pjk"> {{$pajak3}}</div>
                        <div class="plt"> {{$plat3}}</div>
                        <div class="main"> {{$main3}}</div>
                        </td>
                        <td>
                            @php
                                $mon4 = '04';
                                $apr = $injectQuery->pajak($row->id,$now,$mon4);
                                $jadwal4 = $injectQuery->jadmain($row->id,$now,$mon4);

                                if ($apr != null) {
                                    $pajak4= date("d", strtotime($apr->tax_date));
                                    $plat4= date("d", strtotime($apr->police_number_date));
                                }else{
                                    $pajak4 = '';
                                    $plat4 = '';
                                } 
                                
                                if ($jadwal4 != null) {
                                    $main4 = date("d", strtotime($jadwal4->tanggal));
                                } else {
                                    $main4 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak4}}</div>
                            <div class="plt"> {{$plat4}}</div>
                            <div class="main"> {{$main4}}</div>
                        </td>
                        <td>
                            @php
                                $mon5 = '05';
                                $mei = $injectQuery->pajak($row->id,$now,$mon5);
                                $jadwal5 = $injectQuery->jadmain($row->id,$now,$mon5);

                                if ($mei != null) {
                                    $pajak5= date("d", strtotime($mei->tax_date));
                                    $plat5= date("d", strtotime($mei->police_number_date));
                                }else{
                                    $pajak5 = '';
                                    $plat5 = '';
                                } 
                                
                                if ($jadwal5 != null) {
                                    $main5 = date("d", strtotime($jadwal5->tanggal));
                                } else {
                                    $main5 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak5}}</div>
                            <div class="plt"> {{$plat5}}</div>
                            <div class="main"> {{$main5}}</div>
                        </td>
                        <td>
                            @php
                                $mon6 = '06';
                                $jun = $injectQuery->pajak($row->id,$now,$mon6);
                                $jadwal6 = $injectQuery->jadmain($row->id,$now,$mon6);

                                if ($jun != null) {
                                    $pajak6= date("d", strtotime($jun->tax_date));
                                    $plat6= date("d", strtotime($jun->police_number_date));
                                }else{
                                    $pajak6 = '';
                                    $plat6 = '';
                                } 
                                
                                if ($jadwal6 != null) {
                                    $main6 = date("d", strtotime($jadwal6->tanggal));
                                } else {
                                    $main6 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak6}}</div>
                            <div class="plt"> {{$plat6}}</div>
                            <div class="main"> {{$main6}}</div>
                        </td>
                        <td>
                            @php
                                $mon7 = '07';
                                $jul = $injectQuery->pajak($row->id,$now,$mon7);
                                $jadwal7 = $injectQuery->jadmain($row->id,$now,$mon7);

                                if ($jul != null) {
                                    $pajak7= date("d", strtotime($jul->tax_date));
                                    $plat7= date("d", strtotime($jul->police_number_date));
                                }else{
                                    $pajak7 = '';
                                    $plat7 = '';
                                } 
                                
                                if ($jadwal7 != null) {
                                    $main7 = date("d", strtotime($jadwal7->tanggal));
                                } else {
                                    $main7 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak7}}</div>
                            <div class="plt"> {{$plat7}}</div>
                            <div class="main"> {{$main7}}</div>
                        </td>
                        <td>
                            @php
                                $mon8 = '08';
                                $agu = $injectQuery->pajak($row->id,$now,$mon8);
                                $jadwal8 = $injectQuery->jadmain($row->id,$now,$mon8);

                                if ($agu != null) {
                                    $pajak8= date("d", strtotime($agu->tax_date));
                                    $plat8= date("d", strtotime($agu->police_number_date));
                                }else{
                                    $pajak8 = '';
                                    $plat8 = '';
                                } 
                                
                                if ($jadwal8 != null) {
                                    $main8 = date("d", strtotime($jadwal8->tanggal));
                                } else {
                                    $main8 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak8}}</div>
                            <div class="plt"> {{$plat8}}</div>
                            <div class="main"> {{$main8}}</div>
                        </td>
                        <td>
                            @php
                                $mon9 = '09';
                                $sep = $injectQuery->pajak($row->id,$now,$mon9);
                                $jadwal9 = $injectQuery->jadmain($row->id,$now,$mon9);

                                if ($sep != null) {
                                    $pajak9= date("d", strtotime($sep->tax_date));
                                    $plat9= date("d", strtotime($sep->police_number_date));
                                }else{
                                    $pajak9 = '';
                                    $plat9 = '';
                                } 
                                
                                if ($jadwal9 != null) {
                                    $main9 = date("d", strtotime($jadwal9->tanggal));
                                } else {
                                    $main9 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak9}}</div>
                            <div class="plt"> {{$plat9}}</div>
                            <div class="main"> {{$main9}}</div>
                        </td>
                        <td>
                            @php
                                $mon10 = '10';
                                $okt = $injectQuery->pajak($row->id,$now,$mon10);
                                $jadwal10 = $injectQuery->jadmain($row->id,$now,$mon10);

                                if ($okt != null) {
                                    $pajak10= date("d", strtotime($okt->tax_date));
                                    $plat10= date("d", strtotime($okt->police_number_date));
                                }else{
                                    $pajak10 = '';
                                    $plat10 = '';
                                } 
                                
                                if ($jadwal10 != null) {
                                    $main10 = date("d", strtotime($jadwal10->tanggal));
                                } else {
                                    $main10 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak10}}</div>
                            <div class="plt"> {{$plat10}}</div>
                            <div class="main"> {{$main10}}</div>
                        </td>
                        <td>
                            @php
                                $mon11 = '11';
                                $nov = $injectQuery->pajak($row->id,$now,$mon11);
                                $jadwal11 = $injectQuery->jadmain($row->id,$now,$mon11);

                                if ($nov != null) {
                                    $pajak11= date("d", strtotime($nov->tax_date));
                                    $plat11= date("d", strtotime($nov->police_number_date));
                                }else{
                                    $pajak11 = '';
                                    $plat11 = '';
                                } 
                                
                                if ($jadwal11 != null) {
                                    $main11 = date("d", strtotime($jadwal11->tanggal));
                                } else {
                                    $main11 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak11}}</div>
                            <div class="plt"> {{$plat11}}</div>
                            <div class="main"> {{$main11}}</div>
                        </td>
                        <td>
                            @php
                                $mon12 = '12';
                                $des = $injectQuery->pajak($row->id,$now,$mon12);
                                $jadwal12 = $injectQuery->jadmain($row->id,$now,$mon12);

                                if ($des != null) {
                                    $pajak12= date("d", strtotime($des->tax_date));
                                    $plat12= date("d", strtotime($des->police_number_date));
                                }else{
                                    $pajak12 = '';
                                    $plat12 = '';
                                } 
                                
                                if ($jadwal12 != null) {
                                    $main12 = date("d", strtotime($jadwal12->tanggal));
                                } else {
                                    $main12 = '';
                                }
                                
                            @endphp

                            <div class="pjk"> {{$pajak12}}</div>
                            <div class="plt"> {{$plat12}}</div>
                            <div class="main"> {{$main12}}</div>
                        </td>
                        
                    </tr>
                  
                @endforeach
            </tbody>
        </table>
        <br>
        Keterangan : <br>
        Merah = Tanggal Plat <br>
        Biru = Tanggal Pajak <br>
        Hijau = Tanggal Maintenance 
    </div>
</div>

@endsection

@section('footer')
@endsection