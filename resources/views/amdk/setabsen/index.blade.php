@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li>Absensi</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/setabsen/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Ubah Poin Absensi</h4>
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
                        for="form-field-1"> Tanggal Max Daduk
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min = "0"
                                    class="col-xs-2 col-sm-2 required " value="{{$data->kunci_tanggal}}"
                                    name="kunci_tanggal" required />
                        </div>
                    </div>
                    <hr>
                    <h4> &nbsp;&nbsp;&nbsp;Poin Keterlambatan</h4>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> 1 s/d 15 menit
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min = "0"
                                    class="col-xs-2 col-sm-2 required " value="{{$data->poin1}}"
                                    name="poin1" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> 16 s/d 30 menit
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min = "0"
                                    class="col-xs-2 col-sm-2 required " value="{{$data->poin16}}"
                                    name="poin16" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> 31 s/d 60 menit
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min = "0"
                                    class="col-xs-2 col-sm-2 required " value="{{$data->poin31}}"
                                    name="poin31" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> 61 s/d 90 menit
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min = "0"
                                    class="col-xs-2 col-sm-2 required " value="{{$data->poin61}}"
                                    name="poin61" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> >90 menit 
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min = "0"
                                    class="col-xs-2 col-sm-2 required " value="{{$data->poin91}}"
                                    name="poin91" required />
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