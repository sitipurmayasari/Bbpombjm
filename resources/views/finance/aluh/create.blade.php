@extends('layouts.aluh')
@section('breadcrumb')
    <li><a href="/finance/aluh">Input Link Analisa Laporan akUntabilitas Hasil kinerja</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('aluh.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Link Analisa Laporan akUntabilitas Hasil kinerja</h4>
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
                            for="form-field-1"> Tahun
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Input Tahun" 
                                        class="col-xs-10 col-sm-2 required " 
                                        name="year" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Pilih IKU
                            </label>
                            <div class="col-sm-8">
                                <select  name="indicator_id" id="indicator_id" class="col-xs-10 col-sm-10 required select2" required>
                                    <option value="">Pilih IKU</option>
                                    @foreach ($iku as $item)
                                        <option value="{{$item->id}}">{{$item->ikucode}} - {{$item->indicator}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Laporan
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama laporan" 
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