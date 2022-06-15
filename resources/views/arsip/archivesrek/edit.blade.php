@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Arsiparis</li>
    <li><a href="/arsip/archivesrek">Rekapitulasi Arsip</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/arsip/archivesrek/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form Ubah Arsip</h4>
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
                        for="form-field-1">Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" required value="{{$data->date}}"
                                    class="col-xs-3 col-sm-3 required " 
                                    name="date"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Klasifikasi Surat
                        </label>
                        <div class="col-sm-10">
                            <select name="mailclasification_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Klasifikasi</option>
                                @foreach ($masa as $isi)
                                    @if ($isi->id == $data->mailclasification_id)
                                        <option value="{{$isi->id}}" selected>{{$isi->alias}} - {{$isi->names}}</option>
                                    @else
                                        <option value="{{$isi->id}}">{{$isi->alias}} - {{$isi->names}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Surat
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor" class="col-xs-10 col-sm-10 required"  required value="{{$data->nomor}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tingkat Keaslian
                        </label>
                        <div class="col-sm-10">
                            @if ($data->tingkat=="asli")
                                <input type="radio" required value="asli" checked 
                                name="tingkat" id="L"/> &nbsp; Asli  &nbsp;
                                <input type="radio" required value="copy"
                                name="tingkat" id="P"/> &nbsp; Copy &nbsp;
                                <input type="radio" required value="soft copy"
                                name="tingkat" id="P"/> &nbsp; Soft Copy
                            @elseif ($data->tingkat=="soft copy")
                                <input type="radio" required value="asli"  
                                name="tingkat" id="L"/> &nbsp; Asli  &nbsp;
                                <input type="radio" required value="copy"
                                name="tingkat" id="P"/> &nbsp; Copy &nbsp;
                                <input type="radio" required value="soft copy" checked
                                name="tingkat" id="P"/> &nbsp; Soft Copy
                            @else
                                <input type="radio" required value="asli"  
                                name="tingkat" id="L"/> &nbsp; Asli  &nbsp;
                                <input type="radio" required value="copy" checked
                                name="tingkat" id="P"/> &nbsp; Copy &nbsp;
                                <input type="radio" required value="soft copy"
                                name="tingkat" id="P"/> &nbsp; Soft Copy
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Uraian
                        </label>
                        <div class="col-sm-10">
                            <textarea name="uraian" id="" cols="95%" rows="5" required>{{$data->uraian}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jumlah (lembar)
                        </label>
                        <div class="col-sm-10">
                            <input type="number"  class="col-xs-1 col-sm-1" value="{{$data->jumlah}}"
                                name="jumlah"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Upload File
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><a href="{{$data->getFIlearsip()}}" target="_blank" >{{$data->file}}</a></label>
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