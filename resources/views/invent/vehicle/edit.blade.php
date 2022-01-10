@extends('layouts.app')
@section('breadcrumb')
    <li>Kendaraan</li>
    <li><a href="/invent/vehicle"> Kendaraan Dinas</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/invent/vehicle/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Ubah Data Kendaraan Dinas</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Kendaraan
                            </label>
                            <div class="col-sm-9">
                                <input type="text"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="code" required value="{{$data->code}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Kendaraan
                            </label>
                            <div class="col-sm-9">
                             @if ($data->type=='M')
                                <input type="radio" required value="M" checked name="type" id="M"/> 
                                &nbsp; Motor  &nbsp;
                                <input type="radio" required value="C" name="type" id="C"/> 
                                &nbsp; Mobil
                            @else
                                <input type="radio" required value="M"  name="type" id="M"/> 
                                &nbsp; Motor  &nbsp;
                                <input type="radio" required value="C" checked name="type" id="C"/> 
                                &nbsp; Mobil
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk / Jenis Kendaraan
                            </label>
                            <div class="col-sm-9">
                                <input type="text"  value="{{$data->merk}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="merk" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Polisi
                            </label>
                            <div class="col-sm-9">
                                <input type="text"  value="{{$data->police_number}}" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="police_number" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Pajak
                            </label>
                            <div class="col-sm-5">
                                <input type="date" value="{{$data->tax_date}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="tax_date" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal PLat
                            </label>
                            <div class="col-sm-5">
                                <input type="date" value="{{$data->police_number_date}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="police_number_date" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Operasional
                            </label>
                            <div class="col-sm-9">
                                @if ($data->operasional=='Y')
                                    <input type="radio" required value="Y" checked name="operasional" id="Y"/> 
                                    &nbsp; Ya  &nbsp;
                                    <input type="radio" required value="N" name="operasional" id="N"/> 
                                    &nbsp; Tidak
                                @else
                                    <input type="radio" required value="Y"  name="operasional" id="Y"/> 
                                    &nbsp; Ya  &nbsp;
                                    <input type="radio" required value="N" checked name="operasional" id="N"/> 
                                    &nbsp; Tidak
                                @endif
                            </div>
                        </div>

                </div>
           </div>
            </div>
        </div>
    </div><!-- /.col -->
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>

@endsection