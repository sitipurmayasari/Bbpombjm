@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/itasset"> Inventaris Asset Tetap</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/invent/itasset/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Data Inventaris Asset Tetap</h4>
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
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode-NUP
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="kodebarang-NUP" value="{{$data->kode_barang}}"
                                        class="col-xs-11 col-sm-11 required " 
                                        name="kode_barang" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis
                            </label>
                            <div class="col-sm-8">
                                <select name="jenistik_id" class="col-xs-11 col-sm-11 required select2" >
                                    @foreach ($jenis as $item)
                                        @if ($item->id == $data->jenistik_id)
                                        <option value="{{$item->id}}" selected>{{$item->kelompok}}</option>
                                        @else
                                        <option value="{{$item->id}}">{{$item->kelompok}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama + Merk
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama" required value="{{$data->nama_barang}}"
                                        class="col-xs-11 col-sm-11 required " 
                                        name="nama_barang" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Penanggung Jawab
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="users_id" class="col-xs-11 col-sm-11 select2">
                                    <option value="">Pilih Nama Pegawai</option>
                                    @foreach ($user as $peg)
                                       @if ($peg->id == $data->users_id)
                                       <option value="{{$peg->id}}" selected>{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                       @else
                                       <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                       @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Lokasi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="lokasi barang" required
                                        class="col-xs-11 col-sm-11 required " value="{{$data->lokasi}}"
                                        name="lokasi" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right"
                            for="form-field-1"> Spesifikasi
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-11 col-sm-11"  
                                name="spesifikasi">{{$data->spesifikasi}}</textarea>
                            </div>
                        </div>
                        
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-6">
                   <br>
                <div class="widget-main no-padding">
                    <div class="form-actions" style="text-align: center">
                        <input type="file" name="file_foto2" class="btn btn-success btn-sm" id="" 
                            value="Upload Ulang Foto Barang">   
                        <img src="{{$data->getFoto()}}"  style="height:250px;width:250px">
                        <br>
                        <label><i class="bg bg-warning">** Kosongkan Upload ulang jika tidak ingin merubah gambar</i></label>
                    </div>     
                </div>
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