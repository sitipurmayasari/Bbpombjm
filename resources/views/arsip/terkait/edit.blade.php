@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li><a href="/arsip/terkait">Input Link Terkait</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/arsip/terkait/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Link Terkait</h4>
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
                                <input type="text"  placeholder="Nama"  value="{{$data->name}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Link
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="https://contoh" value="{{$data->link}}"
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
                                    @if ($data->lokasi=="1")
                                        <option value="0">Semua Portal</option>
                                        <option value="1" selected>Portal Awal</option>
                                        <option value="2">Portal SiAnangGaluh</option>
                                    @elseif ($data->lokasi=="2")
                                        <option value="0">Semua Portal</option>
                                        <option value="1">Portal Awal</option>
                                        <option value="2" selected>Portal SiAnangGaluh</option>
                                    @else
                                        <option value="0" selected>Semua Portal</option>
                                        <option value="1">Portal Awal</option>
                                        <option value="2">Portal SiAnangGaluh</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Status
                            </label>
                            <div class="col-sm-8">
                                @if ($data->aktif=='Y')
                                    <input type="radio" required value="Y" checked name="aktif" id="Y"/> &nbsp; Aktif
                                    <input type="radio" required value="N" name="aktif" id="N"/> &nbsp; NonAktif
                                @else
                                    <input type="radio" required value="Y" name="aktif" id="Y"/> &nbsp; Aktif
                                    <input type="radio" required value="N" checked name="aktif" id="N"/> &nbsp; NonAktif
                                @endif
                            </div>
                        </div>
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Icon
                            </label>
                            <div class="col-sm-9">
                                <input type="file" name="icon2" class="btn btn-success btn-sm" id="" 
                                    value="Upload Ulang Foto Barang">   
                                <img src="{{$data->getFoto()}}"  style="height:150px;width:150px">
                                <br>
                                <label><i class="bg bg-warning">** Kosongkan Upload ulang jika tidak ingin merubah gambar (max 100kb)</i></label>
                            </div>
                            
                        </div>
                    </div>
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