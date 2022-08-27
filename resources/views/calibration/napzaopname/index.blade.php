@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.lab')
@section('breadcrumb')
<li>Laporan</li>
<li>Laporan Stok Opname</i></li>
@endsection
@section('content')
 <form class="form-horizontal validate-form" role="form" id="form_id"
         method="post" action="{{route('napzaopname.cetak')}}">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <div class="col-md-4">
                    <a href="{{Route('napzaopname.create')}}"  class="btn btn-primary">Tambah Data</a>  
                </div>
                <div class="col-md-3" style="float: right">
                    <a class="btn btn-default" href="/calibration/napzaopname/formopname/" target="_blank" rel="noopener noreferrer">Download Format Laporan</a>
                </div>
               </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Laporan Stok Opname</h3></div>
            <div class="panel-body">
                <div class="col-md-6">
                    <fieldset>
=======
</div>
<div class="row">
    <form method="post" action="{{Route('napzaopname.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Laporan Stok Opname</h4>
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
>>>>>>> ee4ea469b37aaecb372dbb64bfd922284df3bfbd
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{tgl_indo(date('Y-m-d'))}}" readonly  class="col-xs-10 col-sm-10">
                            </div>
                        </div>
                        <div class="form-group" id="gudang">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Gudang
                            </label>
                            <div class="col-sm-8">
                               <input type="text" value="Lab Obat & Nappza" readonly  class="col-xs-10 col-sm-10">
                            </div>
                        </div>
                        <div class="form-group" id="kelompok">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kelompok
                            </label>
                            <div class="col-sm-8">
                                <select name="kelompok" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih kelompok</option>
                                    @foreach ($jenis as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>  
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Cetak
        </button>
    </div>
</div>
</form>

@endsection