@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/divisi"> Kelompok Substansi</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('divisi.store')}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form Tambah Sub Kelompok</h4>
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
                        for="form-field-1"> Nama Kelompok
                        </label>
                        <div class="col-sm-10">
                            <select name="divisi_id" class="col-xs-10 col-sm-10 required " >
                                <option value="">Pilih Nama Kelompok</option>
                                @foreach ($divisi as $div)
                                        <option value="{{$div->id}}">{{$div->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                        
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Sub Kelompok
                        </label>

                        <div class="col-sm-10">
                            <input type="text"  placeholder="Nama sub kelompok" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="nama_subdiv" required />
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