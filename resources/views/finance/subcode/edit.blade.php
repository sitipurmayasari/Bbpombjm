@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/subcode">Kode Sub Komponen</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/subcode/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Kode Sub Komponen</h4>
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
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Komponen
                            </label>
                            <div class="col-sm-8">
                                <select name="komponencode_id" class="col-xs-10 col-sm-10 required " required>
                                    <option value="">Pilih Kode</option>
                                    @foreach ($kode as $peg)
                                        @if ($data->komponencode_id==$peg->id)
                                            <option value="{{$peg->id}}" selected>{{$peg->det->unit->code}} - {{$peg->det->code}} - {{$peg->code}}</option>
                                        @else
                                            <option value="{{$peg->id}}">{{$peg->det->unit->code}} - {{$peg->det->code}} - {{$peg->code}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Sub Komponen
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="kode Sub Komponen" 
                                        class="col-xs-10 col-sm-10 required " value="{{$data->code}}"
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Sub Komponen
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Sub Komponen" value="{{$data->name}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" required/>
                            </div>
                        </div>
                        </fieldset>        
               </div>
           </div>
        </div>
    </div>
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