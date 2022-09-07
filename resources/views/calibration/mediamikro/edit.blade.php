@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/calibration/mediamikro"> Media Mikrobiologi</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/calibration/mediamikro/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Media Mikrobiologi</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Media
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder=" Masukkan Media Mikrobiologi" value="{{$data->name}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="name" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Suhu (°C)
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="contoh : 37 ±1" value="{{$data->temperature}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="temperature" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Waktu (jam)
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="contoh : 22-26" value="{{$data->period}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="period" required />
                        </div>
                    </div>

                    </fieldset>        
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