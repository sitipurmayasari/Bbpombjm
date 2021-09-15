@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pelatihan"> Kompetensi Pegawai</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/pelatihan/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Tambah Kegiatan Kompetensi</h4>
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
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-10">
                            <input type="hidden" name="admin" value="true">
                            <select id="status" name="users_id" class="col-xs-10 col-sm-10 select2">
                                <option value="">Pilih Pegawai</option>
                                @foreach ($user as $peg)
                                    @if ($data->users_id==$peg->id)
                                    <option value="{{$peg->id}}" selected>{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @else
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endif
                                    
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis Kegiatan
                        </label>
                        <div class="col-sm-10">
                            <select name="jenis_pelatihan_id" id="" class="col-xs-10 col-sm-10 select2">
                                <option value="">Pilih Jenis</option>
                                @foreach ($jenis as $isi)
                                    @if ($data->jenis_pelatihan_id==$isi->id)
                                    <option value="{{$isi->id}}" selected>{{$isi->name}}</option>
                                    @else
                                        <option value="{{$isi->id}}">{{$isi->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Kegiatan
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="Nama kegiatan" class="col-xs-10 col-sm-10 required " 
                                    name="nama" required value="{{$data->nama}}"/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penyelenggara
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="nama penyelenggara" class="col-xs-10 col-sm-10 required " 
                                    name="penyelenggara" required value="{{$data->penyelenggara}}"/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Mulai
                        </label>
                        <div class="col-sm-10">
                            <input type="date"  class="col-xs-2 col-sm-2 required " 
                                    name="dari" required value="{{$data->dari}}"/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Selesai
                        </label>
                        <div class="col-sm-10">
                            <input type="date"  class="col-xs-2 col-sm-2 required " 
                            name="sampai" required value="{{$data->sampai}}"/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Lama Pelatihan
                        </label>
                        <div class="col-sm-10">
                            <input type="number"  placeholder="0" class="col-xs-1 col-sm-1 required " 
                                    name="lama" required min="0" value="{{$data->lama}}"/>&nbsp;
                                    <label class="control-label" 
                                    for="form-field-1"> Jam
                                    </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Terekam di SIASN BPOM
                        </label>
                        <div class="col-sm-10" style="vertical-align: middle;" >
                            @if ($data->terekam=='Y')
                                    <input type="radio" required value="N" 
                                         name="terekam" id="N"/> &nbsp; Belum  &nbsp;
                                    <input type="radio" required value="Y" checked
                                        name="terekam" id="Y"/> &nbsp; Sudah
                                @else
                                    <input type="radio" required value="N" checked 
                                        name="terekam" id="N"/> &nbsp; Belum  &nbsp;
                                    <input type="radio" required value="Y"
                                        name="terekam" id="Y"/> &nbsp; Sudah
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Upload File
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><a href="{{$data->getFIleSert()}}" target="_blank" >{{$data->file}}</a></label>
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