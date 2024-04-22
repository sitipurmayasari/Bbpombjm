@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.ren')
@section('breadcrumb')
    <li>Indikator Kinerja</li>  
    <li><a href="/finance/ikuIndicator">Indikator Kinerja Utama</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/ikuIndicator/update/{{$data->id}}">
    {{ csrf_field() }}
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title"> Input Indikator Kinerja Utama</h4>
                    <div class="widget-toolbar">
                    </div>
                </div>
                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <fieldset>
                            <br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" 
                                for="form-field-1"> Sasaran Kegiatan
                                </label>
                                <div class="col-sm-10">
                                    <select name="target_id" class="col-xs-10 col-sm-10 required select2" required>
                                        <option value="">Pilih</option>
                                        @foreach ($target as $item)
                                        @if ($data->target_id==$item->id)
                                            <option value="{{$item->id}}" selected>{{$item->code}} - {{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" 
                                for="form-field-1"> Kode IKU
                                </label>
                                <div class="col-sm-10">
                                    <input type="text"  placeholder="input kode" value="{{$data->ikucode}}"
                                            class="col-xs-10 col-sm-10 required " 
                                            name="ikucode" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" 
                                for="form-field-1"> Indikator Kinerja
                                </label>
                                <div class="col-sm-10">
                                    <textarea name="indicator" placeholder="Indikator" id="" rows="3"  class="col-xs-10 col-sm-10 required " >{{$data->indicator}}
                                    </textarea>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" 
                                for="form-field-1"> Substansi
                                </label>
                                <div class="col-sm-10">
                                    <select name="divisi_id" class="col-xs-10 col-sm-10 required select2" required>
                                        <option value="">Pilih</option>
                                        @foreach ($div as $item)
                                        @if ($data->divisi_id==$item->id)
                                            <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Pilih Tim Kerja</h4>
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
                                
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div> --}}
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