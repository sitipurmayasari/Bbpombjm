@extends('layouts.mon')
@section('breadcrumb')
    <li>RAPK</li>
    <li>Setup Capaian & Kriteria</i></li>
@endsection
@section('content')
<form class="form-horizontal validate-form" role="form" 
method="post" action="/finance/setupRAPK/update">
<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Rentang Capaian Lapkin</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
           
                <table id="simple-table" class="table  table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 20%; text-align:center;">Rentang Awal</th>
                            <th style="width: 20%; text-align:center;">Rentang Akhir</th>
                            <th style="text-align:center;">Kriteria</th>
                        </tr>
                    </thead>
                   <tbody>
                        @foreach ($datasatu as $item)
                            <tr>
                                <input type="hidden" name="jenis[]" value="{{$item->jenis}}">
                                <input type="hidden" name="id[]" value="{{$item->id}}">
                                <td><input type="text" name="rentang_awal[]" value="{{$item->rentang_awal}}" class="col-sm-12 col-xs-12" ></td>
                                <td><input type="text" name="rentang_akhir[]" value="{{$item->rentang_akhir}}" class="col-sm-12 col-xs-12" ></td>
                                <td><input type="text" name="kriteria[]" value="{{$item->kriteria}}" class="col-sm-12 col-xs-12" ></td>
                            </tr>
                        @endforeach
                   </tbody>
                </table>
           </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Capaian & Kriteria TE</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <table id="simple-table" class="table  table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th  style="width: 15%; text-align:center;">Rentang Awal</th>
                            <th  style="width: 15%; text-align:center;">Rentang Akhir</th>
                            <th  style="width: 15%; text-align:center;">Capaian</th>
                            <th  style=" text-align:center;">Kriteria</th>
                        </tr>
                    </thead>
                   <tbody>
                        @foreach ($datadua as $item)
                            <tr>
                                <input type="hidden" name="jenis[]" value="TE">
                                <input type="hidden" name="id[]" value="{{$item->id}}">
                                <td><input type="text" name="rentang_awal[]" value="{{$item->rentang_awal}}" class="col-sm-12 col-xs-12" ></td>
                                <td><input type="text" name="rentang_akhir[]" value="{{$item->rentang_akhir}}" class="col-sm-12 col-xs-12" ></td>
                                <td><input type="text" name="Capaian[]" value="{{$item->rentang_akhir}}" class="col-sm-12 col-xs-12" ></td>
                                <td><input type="text" name="kriteria[]" value="{{$item->kriteria}}" class="col-sm-12 col-xs-12" ></td>
                            </tr>
                        @endforeach
                   </tbody>
                </table>
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
