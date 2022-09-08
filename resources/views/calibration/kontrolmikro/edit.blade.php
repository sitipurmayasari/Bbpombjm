@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/calibration/kontrolmikro"> Kontrol Media Mikrobiologi</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/calibration/kontrolmikro/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Kontrol Media Mikrobiologi</h4>
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
                        for="form-field-1"> Media
                        </label>
                        <div class="col-sm-8">
                            <select name="media_id"  class="col-xs-10 col-sm-10 required " required>
                                <option value="">Pilih Media</option>
                                @foreach ($media as $item)
                                    @if ($item->id == $data->media_id)
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
                        for="form-field-1"> Status Kontrol
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="KERUH/JERNIH,DLL" value="{{$data->status}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="status" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Default
                        </label>
                        <div class="col-sm-8">
                            @if ($data->default=='N')
                                <input type="radio" required value="N" checked name="default" id="N"/> 
                                <label class="control-label" > Tidak  </label> &nbsp; &nbsp; 
                                <input type="radio" required value="Y" name="default" id="Y"/>
                                <label class="control-label" > Ya  </label> 
                            @else
                                <input type="radio" required value="N"  name="default" id="N"/> 
                                <label class="control-label" > Tidak  </label> &nbsp; &nbsp; 
                                <input type="radio" required value="Y" checked name="default" id="Y"/>
                                <label class="control-label" > Ya  </label>
                            @endif
                            
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