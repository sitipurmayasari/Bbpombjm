@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li><a href="/arsip/terkait">Input Link Terkait</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="{{route('terkait.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Link terkait</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Link
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="https://contoh"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="link" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> lokasi
                            </label>
                            <div class="col-sm-8">
                                <select name="lokasi" id="" class="col-xs-10 col-sm-10 required " required>
                                    <option value="0">Semua Portal</option>
                                    <option value="1">Portal Awal</option>
                                    <option value="2">Portal SiAnangGaluh</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Status
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" required value="Y" checked
                                        name="aktif" id="Y"/> &nbsp; Aktif
                                <input type="radio" required value="N"
                                        name="aktif" id="N"/> &nbsp; NonAktif
                            </div>
                        </div>
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-6">
                   <br>
                <div class="widget-main no-padding">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Icon
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="icon" class="btn btn-success btn-sm" id="" 
                            value="Upload Icon Aplikasi">   
                            <label><i>ex:Lorem_ipsum.jpg/.jpeg/.png (max 100kb)</i></label>   
                        </div>
                        
                    </div>
                </div>
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