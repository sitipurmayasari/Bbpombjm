@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/ikuIndicator">Indikator Kinerja Utama</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('ikuIndicator.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Indikator Kinerja</h4>
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
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Sasaran Kegiatan
                            </label>
                            <div class="col-sm-8">
                                <select name="target_id" class="col-xs-10 col-sm-10 required " required>
                                    <option value="">Pilih</option>
                                    @foreach ($target as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Komponen
                            </label>
                            <div class="col-sm-8">
                                <select name="komponencode_id" class="col-xs-10 col-sm-10 required " required>
                                    <option value="">Pilih Kode</option>
                                    @foreach ($komponen as $item)
                                        <option value="{{$item->id}}">{{$item->det->unit->code}}-{{$item->det->code}}-{{$item->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Indikator Kinerja
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Indikator" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="indicator" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Target
                            </label>
                            <div class="col-sm-8">
                                <input type="number"  min="0"  step="0.01" placeholder="0.00" 
                                        class="col-xs-2 col-sm-2 required " 
                                        name="poin" required/>
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