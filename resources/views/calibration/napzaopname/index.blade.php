@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.lab')
@section('breadcrumb')
    <li>Laporan</li>
    <li>Laporan Stok Opname</i></li>
@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('napzastock.cetak')}}">

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
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{tgl_indo(date('Y-m-d'))}}" readonly  class="col-xs-10 col-sm-10">
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="gudang">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Gudang
                            </label>
                            <div class="col-sm-8">
                               <input type="text" value="Lab Obat & Nappza" readonly  class="col-xs-10 col-sm-10">
                            </div>
                        </div>
                        <br>
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
        <div class="form-actions">
            <div class="form-group col-xs-12 col-sm-3" style="float: left">
                <input type="submit" value="CETAK" class="btn btn-primary">
            </div>
        </form>
        </div>
        

    </div>
    
</div>

@endsection