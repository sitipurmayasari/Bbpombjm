@extends('layouts.app')
@section('breadcrumb')
    <li>Persetujuan</li>
    <li><a href="/invent/rekapsbb">Rekapitulasi Arsip SBB</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/invent/rekapsbb/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form Upload SBB</h4>
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
                        for="form-field-1">Substansi 
                        </label>
                        <div class="col-sm-10">
                            <select name="divisi_id" id="divisi_id" class="col-xs-10 col-sm-10 required ">
                                <option value="">Pilih Substansi</option>
                                @foreach ($divisi as $item)
                                    @if ($data->divisi_id == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->nama}}</option>  
                                    @else
                                        <option value="{{$item->id}}">{{$item->nama}}</option> 
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Dokumen
                        </label>
                        <div class="col-sm-10">
                            <input type="hidden" name="users_id" value="{{$data->users_id}}">
                            <input type="hidden" name="archive_time_id" value="6">
                            <input type="text"  placeholder="Nama file" class="col-xs-10 col-sm-10 required " 
                                    name="nama" required  value="{{$data->nama}}"/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Upload File
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><a href="{{$data->getFIledosir()}}" target="_blank" >{{$data->file}}</a></label>
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