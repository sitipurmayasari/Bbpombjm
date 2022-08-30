@extends('layouts.lab')
@section('breadcrumb')
<li>Laporan</li>
<li>Laporan Stok Opname</i></li>
@endsection
@section('content')
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
                        <br>
                        <div class="form-group" >
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Opname
                            </label>
                            <div class="col-sm-8">
                                <select name="opname_id" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih stok Opname</option>
                                    @foreach ($opname as $item)
                                        <option value="{{$item->id}}">{{tgl_indo($item->dates)}}</option>
                                    @endforeach
                                </select>
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
    <div class="col-sm-12">
        <div class="form-actions right">
            <div class="form-group col-xs-12 col-sm-3" style="float: left">
                <input type="submit" value="CETAK" class="btn btn-primary">
            </div>
        </div>

    </div>
    </form>
</div>

@endsection
