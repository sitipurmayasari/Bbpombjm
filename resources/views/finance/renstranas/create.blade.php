@extends('layouts.mon')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/renstranas">Renstra Nasional</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
method="post" action="{{route('renstranas.generate')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Tambah Renstra Nasional</h3></div>
       <div class="panel-body">
           <div class="col-md-12">
               <br>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" 
                for="form-field-1">Tanggal
                </label>
                <div class="col-sm-8">
                    <input type="date" required id="dates" value="{{date('Y-m-d')}}"
                            class="col-xs-3 col-sm-3 required " 
                            name="dates"/>
                </div>
            </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Periode Tahun
                    </label>
                    <div class="col-sm-8">
                        <input type="number"  style="width: 10%" placeholder="2021"
                        name="yearfrom" required />
                        <label class="control-label" > s/d </label>
                        <input type="number"  style="width: 10%" placeholder="2025"
                        name="yearto" required />
                    </div>
                </div>
               <div class="form-group">
                   <label class="col-sm-2 control-label no-padding-right" 
                   for="form-field-1"> Jenis Renstra
                   </label>
                   <div class="col-sm-8">
                       <input type="radio" required value="AWAL" checked name="types" id="A"/> &nbsp; Awal &nbsp;
                       <input type="radio" required value="REVISI" name="types" id="R"/> &nbsp; Revisi
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-sm-2 control-label no-padding-right" 
                   for="form-field-1"> Nama File
                   </label>
                   <div class="col-sm-8">
                       <input type="text" name="filename" class="col-xs-10 col-sm-10"  required placeholder="REVISI-01"/>
                   </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Nomor SK
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="sknumber" class="col-xs-10 col-sm-10" />
                    </div>
                </div>
           </div>
       </div>
   </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Generate
        </button>
    </div>
</div>
</form>

@endsection