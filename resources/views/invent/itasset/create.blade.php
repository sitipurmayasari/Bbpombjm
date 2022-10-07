@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/itasset">Peralatan TIK</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('itasset.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Peralatan TIK</h4>
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
                                <input type="text"  placeholder="kodebarang-NUP" 
                                        class="col-xs-11 col-sm-11 required " 
                                        name="kode_barang" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis
                            </label>
                            <div class="col-sm-8">
                                <select name="jenistik_id" class="col-xs-11 col-sm-11 required select2"  required>
                                    @foreach ($jenis as $item)
                                        <option value="{{$item->id}}">{{$item->kelompok}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama + Merk
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama" required
                                        class="col-xs-11 col-sm-11 required " 
                                        name="nama_barang" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Penanggung Jawab
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="users_id" class="col-xs-11 col-sm-11 select2" required>
                                    <option value="">Pilih Nama Pegawai</option>
                                    @foreach ($user as $peg)
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
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
                                        class="col-xs-11 col-sm-11 required " 
                                        name="lokasi" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right"
                            for="form-field-1"> Spesifikasi
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-11 col-sm-11"  
                                name="spesifikasi"></textarea>
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
                        for="form-field-1"> Foto Barang
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file_foto" class="btn btn-success btn-sm" id="" 
                            value="Upload Foto Barang">   
                            <label><i>ex:Lorem_ipsum.jpg/.jpeg/.png</i></label>   
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
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>

@endsection