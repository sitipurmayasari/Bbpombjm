@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/disposable"> Inventaris Asset Sekali Pakai</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/invent/disposable/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Data Inventaris Asset Sekali Pakai</h4>
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
                            for="form-field-1"> Kode Barang
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" value="D" name="kind"  />
                                <input type="text" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="kode_barang" 
                                        value="{{$data->kode_barang}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama barang
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->nama_barang}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="nama_barang" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk/Type
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->merk}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="merk" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Seri
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->no_seri}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="no_seri" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Barang
                            </label>
                            <div class="col-sm-8">
                                <select name="jenis_barang" id="jenis" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Jenis Barang</option>
                                    @foreach ($jenis as $lok)
                                        @if ($data->jenis_barang==$lok->id)
                                            <option value="{{$lok->id}}" selected>{{$lok->nama}}</option>
                                        @else
                                            <option value="{{$lok->id}}">{{$lok->nama}}</option>
                                        @endif
                                    @endforeach
                                       
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Satuan
                            </label>
                            <div class="col-sm-8">
                                <select name="satuan_id" id="satuan_id" class="col-xs-10 col-sm-10">
                                        @foreach ($satuan as $lok)
                                            @if ($data->satuan_id==$lok->id)
                                                <option value="{{$lok->id}}" selected>{{$lok->satuan}}</option>
                                            @else
                                                <option value="{{$lok->id}}">{{$lok->satuan}}</option>
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
                                <select id="status" name="lokasi" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Lokasi Barang</option>
                                    @foreach ($lokasi as $lok)
                                        @if ($data->lokasi==$lok->id)
                                            <option value="{{$lok->id}}" selected>{{$lok->nama}}</option>
                                        @else
                                            <option value="{{$lok->id}}">{{$lok->nama}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" s
                            for="form-field-1"> Keterangan
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                name="spesifikasi">{{$data->spesifikasi}}</textarea>
                            </div>
                        </div>
                        
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-6">
                   <br>
                <div class="widget-main no-padding">
                    <div class="form-actions" align="center">
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