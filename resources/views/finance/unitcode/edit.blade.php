@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/unitcode">Kode Kementrian Lembaga</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/unitcode/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Kode Kementrian Lembaga</h4>
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
                            for="form-field-1"> Kode Kementrian Lembaga
                            </label>
                            <div class="col-sm-8">
                                <select name="klcode_id" class="col-xs-10 col-sm-10 required " required>
                                    <option value="">Pilih Kode</option>
                                    @foreach ($kode as $peg)
                                        @if ($data->klcode_id==$peg->id)
                                            <option value="{{$peg->id}}" selected>{{$peg->code}} || {{$peg->name}}</option>
                                        @else
                                            <option value="{{$peg->id}}">{{$peg->code}} || {{$peg->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Unit
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="kode Unit" 
                                        class="col-xs-10 col-sm-10 required " value="{{$data->code}}"
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Unit
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Unit" value="{{$data->name}}"
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