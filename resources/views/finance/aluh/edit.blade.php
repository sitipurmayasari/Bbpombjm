@extends('layouts.aluh')
@section('breadcrumb')
    <li><a href="/finance/aluh">Input Link Analisa Laporan akUntabilitas Hasil kinerja</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
</style>

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/aluh/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Link Kulihanku</h4>
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
                                <input type="number"  placeholder="2024" value="{{$data->year}}"
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
                                        @if ($item->id == $data->indicator_id)
                                            <option value="{{$item->id}}" selected>{{$item->ikucode}} - {{$item->indicator}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->ikucode}} - {{$item->indicator}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Laporan
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Laporan" value="{{$data->name}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Link
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="https://contoh" value="{{$data->link}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="link" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Laporan
                            </label>
                            <div class="col-sm-8">
                                @if ($data->aktif=='Y')
                                    <input type="radio" required value="Y" checked name="aktif" id="Y"/> &nbsp; Aktif
                                    <input type="radio" required value="N" name="aktif" id="N"/> &nbsp; NonAktif
                                @else
                                    <input type="radio" required value="Y" name="aktif" id="Y"/> &nbsp; Aktif
                                    <input type="radio" required value="N" checked name="aktif" id="N"/> &nbsp; NonAktif
                                @endif
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
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>

@endsection