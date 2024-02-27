@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pelatihan"> Kompetensi Pegawai</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="{{route('pelatihan.store')}}" enctype="multipart/form-data">
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
                        for="form-field-1"> Jenis Kegiatan
                        </label>
                        <div class="col-sm-10">
                            <select name="jenis_pelatihan_id" id="" class="col-xs-10 col-sm-10 select2" required>
                               <option value="">Pilih Jenis</option>
                               @foreach ($jenis as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                           </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Kegiatan
                        </label>
                        <div class="col-sm-10">
                            <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            <input type="text"  placeholder="Nama kegiatan" class="col-xs-10 col-sm-10 required " 
                                    name="nama" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penyelenggara
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="nama penyelenggara" class="col-xs-10 col-sm-10 required " 
                                    name="penyelenggara" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Mulai
                        </label>
                        <div class="col-sm-10">
                            <input type="date"  class="col-xs-2 col-sm-2 required " 
                                    name="dari" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Selesai
                        </label>
                        <div class="col-sm-10">
                            <input type="date"  class="col-xs-2 col-sm-2 required " 
                            name="sampai" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Lama Pelatihan
                        </label>
                        <div class="col-sm-10">
                            <input type="number"  placeholder="0" class="col-xs-1 col-sm-1 required " 
                                    name="lama" required min="0" value="0"/>&nbsp;
                                    <label class="control-label" 
                                    for="form-field-1"> Jam
                                    </label>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Deskripsi Pelatihan
                        </label>
                        <div class="col-sm-10">
                            <textarea name="deskripsi" id="" class="col-xs-10 col-sm-10" rows="3" required></textarea>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Terekam di SIASN BPOM
                        </label>
                        <div class="col-sm-10" style="vertical-align: middle;" >
                            <input type="radio" required value="N" checked 
                            name="terekam" id="N"/> &nbsp; Belum  &nbsp;
                            <input type="radio" required value="Y"
                            name="terekam" id="Y"/> &nbsp; Sudah
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Unggah Sertifikat
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File" required>      
                            <label><i>max : 2 MB</i></label>
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