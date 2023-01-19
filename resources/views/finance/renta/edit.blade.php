@extends('layouts.ren')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/renta">Rencana Target Tahunan</a></li>
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
method="post" action="/finance/renta/update/{{$data->id}}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Ubah Renstra Balai</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Jenis Renstra
                        </label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$data->renstrakal->filename}}"   class="col-xs-10 col-sm-10" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">pilih Tahun
                        </label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$data->years}}"   class="col-xs-10 col-sm-10" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Keterangan
                        </label>
                        <div class="col-sm-8">
                            <input type="text" name="ket" class="col-xs-10 col-sm-10" value="{{$data->ket}}">
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
                            <th rowspan="2" style="width: 40px;">No</th>
                            <th rowspan="2" style="width: 300px;">Indikator</th>
                            <th rowspan="2" style="width: 80px;">Target {{$data->years}} </th>
                            <th colspan="3">TRIWULAN I</th>
                            <th colspan="3">TRIWULAN II</th>
                            <th colspan="3">TRIWULAN III</th>
                            <th colspan="3">TRIWULAN IV</th>
                        </tr>
                        <tr>
                            <th style="width: 80px;" >Jan</th>
                            <th style="width: 80px;" >Feb</th>
                            <th style="width: 80px;" >Mar </th>
                            <th style="width: 80px;" >Apr</th>
                            <th style="width: 80px;" >Mei</th>
                            <th style="width: 80px;" >Jun</th>
                            <th style="width: 80px;" >Jul</th>
                            <th style="width: 80px;" >Aug</th>
                            <th style="width: 80px;" >Sep</th>
                            <th style="width: 80px;" >Oct</th>
                            <th style="width: 80px;" >Nov</th>
                            <th style="width: 80px;" >Dec</th>
                        </tr>
                    </thead> 
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($target as $item)
                        <tr>
                            <td>{{$no}}
                                <input type="hidden" name="outemp_id[]" value="{{$item->id}}">
                            </td>
                            <td>{{$item->indi->indicator}}
                                <input type="hidden"  name="indicator_id[]" value="{{$item->indicator_id}}">
                            </td>
                            <td>
                                <input type="hidden" name="renstrakal_detail_id[]" value="{{$item->renstrakal_detail_id}}">
                                <input type="text"  class="form-control" style="text-align:center;"  name="setahun[]" value="{{$item->setahun}}" readonly>
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="jan[]" value="{{$item->jan}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="feb[]" value="{{$item->feb}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="mar[]" value="{{$item->mar}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="apr[]" value="{{$item->apr}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="mei[]" value="{{$item->mei}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="jun[]" value="{{$item->jun}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="jul[]" value="{{$item->jul}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="aug[]" value="{{$item->aug}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="sep[]" value="{{$item->sep}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="oct[]" value="{{$item->oct}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="nov[]" value="{{$item->nov}}">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" step="0.1" name="dec[]" value="{{$item->dec}}">
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
            <i class="ace-icon fa fa-check bigger-110"></i>UPDATE
        </button>
    </div>
</div>
</form>
@endsection

@section('footer')
    
@endsection