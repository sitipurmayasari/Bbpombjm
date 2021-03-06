@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Dokumen Arsip</li>
    <li><a href="/amdk/dosir"> Dosir</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="{{route('dosir.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form Upload Dosir</h4>
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
                        for="form-field-1"> Jenis Dokumen
                        </label>
                        <div class="col-sm-10">
                            <select name="archive_time_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Jenis</option>
                                @foreach ($masa as $div)
                                        <option value="{{$div->id}}">{{$div->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Dokumen
                        </label>
                        <div class="col-sm-10">
                            <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            <input type="hidden" name="divisi_id" value="{{auth()->user()->divisi_id}}">
                            <input type="text"  placeholder="Nama file" class="col-xs-10 col-sm-10 required " 
                                    name="nama" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Upload File
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><i>ex:Lorem_ipsum.pdf,.doc, .docx,.ppt,.xls, .xlsx,.jpeg,.jpg,.png</i></label>
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
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>
    
@endsection