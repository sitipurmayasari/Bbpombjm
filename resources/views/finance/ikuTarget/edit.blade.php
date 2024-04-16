@extends('layouts.ren')
@section('breadcrumb')
    <li>Indikator Kinerja</li>
    <li><a href="/finance/ikuTarget">Sasaran Kegiatan</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post"action="/finance/ikuTarget/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Update Sasaran Kegiatan</h4>
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
                            for="form-field-1"> Perspective
                            </label>
                            <div class="col-sm-10">
                                <select name="perspective_id" class="col-xs-10 col-sm-10 required " required>
                                    <option value="">Pilih</option>
                                    @foreach ($per as $item)
                                        @if ($data->perspective_id==$item->id)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kode Sasaran
                            </label>
                            <div class="col-sm-10">
                                <input type="text"  placeholder="input kode" value="{{$data->code}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="code" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Sasaran
                            </label>
                            <div class="col-sm-10">
                                <input type="text"  placeholder="input sasaran" value="{{$data->name}}"
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