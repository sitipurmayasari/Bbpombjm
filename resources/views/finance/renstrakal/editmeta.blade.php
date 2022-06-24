@extends('layouts.ren')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/renstrakal">Renstra Balai</a></li>
    <li>Ubah Meta Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form"   
method="post" action="/finance/renstrakal/updatemeta/{{$data->id}}">
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Ubah Meta Data Renstra Balai</h3></div>
       <div class="panel-body">
           <div class="col-md-12">
               <br>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" 
                for="form-field-1">Tanggal
                </label>
                <div class="col-sm-8">
                    <input type="date" id="dates" value="{{$data->dates}}"
                            class="col-xs-3 col-sm-3 " 
                            name="dates"/>
                </div>
            </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Periode Tahun
                    </label>
                    <div class="col-sm-8">
                        <input type="number"  style="width: 10%" placeholder="2021"
                        name="yearfrom" value="{{$data->yearfrom}}"/>
                        <label class="control-label" > s/d </label>
                        <input type="number"  style="width: 10%" placeholder="2025"
                        name="yearto" value="{{$data->yearto}}" />
                    </div>
                </div>
               <div class="form-group">
                   <label class="col-sm-2 control-label no-padding-right" 
                   for="form-field-1"> Jenis Renstra
                   </label>
                   <div class="col-sm-8">
                        @if ($data->types=='AWAL')
                            <input type="radio" value="AWAL" checked name="types" id="A"/> &nbsp; Awal &nbsp;
                            <input type="radio" value="REVIU" name="types" id="V"/> &nbsp; Reviu  &nbsp;
                            <input type="radio" value="REVISI" name="types" id="R"/> &nbsp; Revisi
                        @elseif ($data->types=='REVIU')
                            <input type="radio" value="AWAL"  name="types" id="A"/> &nbsp; Awal &nbsp;
                            <input type="radio" value="REVIU" checked name="types" id="V"/> &nbsp; Reviu  &nbsp;
                            <input type="radio" value="REVISI" name="types" id="R"/> &nbsp; Revisi
                        @else
                            <input type="radio" value="AWAL" checked name="types" id="A"/> &nbsp; Awal &nbsp;
                            <input type="radio" value="REVIU" name="types" id="V"/> &nbsp; Reviu  &nbsp;
                            <input type="radio" value="REVISI" checked name="types" id="R"/> &nbsp; Revisi
                        @endif
                       
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-sm-2 control-label no-padding-right" 
                   for="form-field-1"> Nama File
                   </label>
                   <div class="col-sm-8">
                       <input type="text" name="filename" class="col-xs-10 col-sm-10" value="{{$data->filename}}"/>
                   </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Nomor SK
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="sknumber" class="col-xs-10 col-sm-10" value="{{$data->sknumber}}"/>
                    </div>
                </div>
           </div>
       </div>
   </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>UPDATE
        </button>
        <a href="/finance/renstrakal/edit/{{$data->id}}" class="btn btn-sm">
            <i class="glyphicon glyphicon-arrow-right"> UPDATE RENSTRA</i>
        </a>
    </div>
</div>
</form>

@endsection