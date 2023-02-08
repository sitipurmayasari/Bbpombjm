@extends('layouts.forma')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/realRAPK">Realisasi Capaian</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<style>
    th{
        text-align: center;
        font-weight: bold;
    }

    .scrollit{
        overflow: auto;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>

<form class="form-horizontal validate-form" role="form" 
method="post" action="/finance/realRAPK/update/{{$data->id}}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Ubah Realisasi capaian {{$data->div->nama }}</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" value="{{$data->dates}}"
                                    class="col-xs-3 col-sm-3 " />
                            <input type="hidden" name="verif" value="Y">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Nama
                        </label>
                        <div class="col-sm-8">
                           <input type="text" class="col-xs-10 col-sm-10" value="{{$data->peg->name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Periode Perjanjian Kinerja 
                        </label>
                        <div class="col-sm-8">
                            @php
                                if($data->periodebln == 2){
                                    $bln = "Februari";
                                }elseif($data->periodebln == 3){
                                    $bln = "Maret";
                                }elseif($data->periodebln == 4){
                                    $bln = "April";
                                }elseif($data->periodebln == 5){
                                    $bln = "Mei";
                                }elseif($data->periodebln == 6){
                                    $bln = "Juni";
                                }elseif($data->periodebln == 7){
                                    $bln = "Juli";
                                }elseif($data->periodebln == 8){
                                    $bln = "Agustus";
                                }elseif($data->periodebln == 9){
                                    $bln = "September";
                                }elseif($data->periodebln == 10){
                                    $bln = "Oktober";
                                }elseif($data->periodebln == 11){
                                    $bln = "November";
                                }elseif($data->periodebln == 12){
                                    $bln = "Januari";
                                }else{
                                    $bln = "Januari";
                                };
                            @endphp
                            <input type="text" class="col-xs-10 col-sm-10" readonly 
                            value="{{$bln}} {{$data->eselon->years}}"  
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title"> Rencana target per bulan</h4>
            <div class="widget-toolbar">
                <a href="#" data-action="collapse">
                    <i class="ace-icon fa fa-chevron-down"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            {{-- <div class="col-sm-12" > --}}
                <table  class="table table-bordered table-hover scrollit">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Indikator</th>
                            <th class="col-md-1">Target {{$data->eselon->years}} </th>
                            <th class="col-md-1">Target {{$bln}}</th>
                            <th class="col-md-1">Capaian {{$bln}} </th>
                            <th class="col-md-3">Keterangan</th>
                        </tr>
                    </thead> 
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($detail as $item)
                        <tr>
                            <td style="text_align:center">{{$no}}
                                <input type="hidden" name="outemp_id[]" value="{{$item->id}}">
                            </td>
                            <td>{{$item->ed_det->indi->indicator}}
                                <input type="hidden" name="eselontwo_detail_id[]" value="{{$item->eselontwo_detail_id}}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="setahun[]" value="{{$item->ed_det->setahun}}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="sebulan[]" value="{{$item->sebulan}}" readonly>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$item->capaian}}" step="0.1" name="capaian[]" required>
                            </td>
                            <td>
                                <textarea name="keterangan[]" class="form-control" required>{{$item->keterangan}}</textarea>
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
           {{-- </div> --}}
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>VERIFIKASI
        </button>
    </div>
</div>
</form>
@endsection

@section('footer')
    
@endsection