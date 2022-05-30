@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup Umum</li>
    <li><a href="/finance/budget"> Kode Anggaran Dinas</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/finance/budget/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Anggaran Dinas</h4>
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
                        for="form-field-1"> kode Anggaran Dinas
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="kode Anggaran Dinas" value="{{$data->code}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="code" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Anggaran Dinas
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama Anggaran Dinas" value="{{$data->name}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Angaran
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nomor Anggaran" value="{{$data->nomor}}"
                                    class="col-xs-10 col-sm-10 " 
                                    name="nomor"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Anggaran
                        </label>
                        <div class="col-sm-8">
                            <input type="date"  placeholder="Nama Anggaran Dinas" 
                                    cl class="col-xs-3 col-sm-3 " value="{{$data->tanggal}}"
                                    name="tanggal"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tahun Anggaran
                        </label>
                        <div class="col-sm-8">
                            <input type="number"  placeholder="20XX"  value="{{$data->tahun}}"
                            class="col-xs-3 col-sm-3 required " 
                                    name="tahun" required/>
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