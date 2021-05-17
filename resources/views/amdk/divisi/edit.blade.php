@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/divisi"> Kelompok Substansi</a></li>
    <li>Edit Baru</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/divisi/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form Edit Sub Substansi</h4>
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
                        for="form-field-1"> Nama Kelompok
                        </label>
                        <div class="col-sm-10">
                            <select id="status" name="divisi_id" class="col-xs-10 col-sm-10">
                                @foreach ($divisi as $div)
                                    @if ($data->divisi_id==$div->id)
                                        <option value="">Pilih Kelompok</option>
                                        <option value="{{$div->id}}" selected>{{$div->nama}}</option>
                                    @else
                                        <option value="{{$div->id}}">{{$div->nama}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Sub Kelompok
                            </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="Nama" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="nama_subdiv" required
                                    value="{{$data->nama_subdiv}}" />
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