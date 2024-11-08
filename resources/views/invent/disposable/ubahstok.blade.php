@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/disposable/"> Inventaris Asset Sekali Pakai</a></li>
    <li><a href="/invent/disposable/stock/{{$data->inventaris_id}}"> Stok Barang</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/invent/disposable/updatestok/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Data Stok</h4>
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
                                <input type="text" readonly
                                        class="col-xs-10 col-sm-10 required " 
                                        
                                        value="{{$data->barang->kode_barang}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama barang
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->barang->nama_barang}}" readonly
                                        class="col-xs-10 col-sm-10 required " 
                                         />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk/Type
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->barang->merk}}" readonly
                                        class="col-xs-10 col-sm-10 required " 
                                        />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tgl Barang Masuk
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="entry_date" class="col-xs-6 col-sm-6" 
                                value="{{$data->entry_date}}"  data-date-format="yyyy-mm-dd"  data-provide="datepicker">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tgl Expired
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="exp_date" class="col-xs-6 col-sm-6" 
                                value="{{$data->exp_date}}"  data-date-format="yyyy-mm-dd"  data-provide="datepicker">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Barang Masuk
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="stockawal" class="col-xs-2 col-sm-2" id="awal" 
                                value="{{$data->stockawal}}"  >
                                <label>{{$data->barang->satuan->satuan}}</label> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Barang keluar
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="keluar" class="col-xs-2 col-sm-2" id="keluar" 
                                value="{{$data->keluar}}"  >
                                <label>{{$data->barang->satuan->satuan}}</label> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Sisa Stok
                            </label>
                            <div class="col-sm-8">
                                <input type="number" name="stock" class="col-xs-2 col-sm-2" required  value="{{$data->stock}}"
                                       >&nbsp;&nbsp;
                                <label>{{$data->barang->satuan->satuan}}</label> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Penyedia
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  class="col-xs-9 col-sm-9 required " name="provider" value="{{$data->provider}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Harga Satuan
                            </label>
                            <div class="col-sm-8">
                                <input type="number" value="{{$data->harga}}"
                                class="col-xs-10 col-sm-10 required"  min="0" name="harga" />
                            </div>
                        </div>

                        
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-6">
                   <br>
                <div class="widget-main no-padding">
                    <div class="form-actions" style="text-align: center">
                          
                        <img src="{{$data->barang->getFoto()}}"  style="height:250px;width:250px">
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