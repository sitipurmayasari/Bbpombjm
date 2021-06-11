@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li><a href="/invent/aduan"> Daftar Aduan</a></li>
    <li>Detail Aduan</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/invent/aduan/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Detail Aduan Kerusakan</h4>
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
                            for="form-field-1"> No. Aduan
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nomor aduan" id="kode"
                                        class="col-xs-10 col-sm-10  " readonly
                                        name="no_aduan" value="{{$data->no_aduan}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Barang
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nomor aduan" id="kode"
                                class="col-xs-10 col-sm-10  " value="{{$data->barang_id}}"
                                name="no_aduan"readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk/Type
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="merk" 
                                        class="col-xs-10 col-sm-10  " 
                                        name="merk" id="merk" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No.Seri
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="seri" id="seri" 
                                        class="col-xs-10 col-sm-10  " 
                                        name="no_seri" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Aduan
                            </label>
                            <div class="col-sm-8 date">
                                <input type="text"  placeholder="nomor aduan" id="kode" readonly
                                class="col-xs-10 col-sm-10 " value="{{$data->tanggal}}"
                                name="pegawai_id"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pelapor
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nomor aduan" id="kode" readonly
                                        class="col-xs-10 col-sm-10 " value="{{$data->pegawai_id}}"
                                        name="pegawai_id"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Keterangan
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-10 col-sm-10"  readonly
                                name="aduan">{{$data->aduan}}</textarea>
                            </div>
                        </div>

                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> 
                            </label>
                            <div>
                                &nbsp;&nbsp;
                                <input type="checkbox"name="tindak" value="Y">
                                &nbsp; Telah di tanggapi
                            </div>
                        </div>

                        
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-6">
                   <br>
                <div class="widget-main no-padding">
                    <div class="form-actions" align="center">
                        <img src="{{$data->getFoto()}}"  style="height:250px;width:250px">
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