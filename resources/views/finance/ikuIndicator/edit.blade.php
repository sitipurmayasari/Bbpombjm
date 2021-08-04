@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
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
                                    @if ($data->target_id==$item->id)
                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode SubKomponen
                            </label>
                            <div class="col-sm-8">
                                <select name="subcode_id" class="col-xs-10 col-sm-10 required " required>
                                    <option value="">Pilih Kode</option>
                                    @foreach ($komponen as $item)
                                        @if ($data->subcode_id==$item->id)
                                            <option value="{{$item->id}}" selected>{{$item->kodeall}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->kodeall}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Indikator Kinerja
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Indikator" value="{{$data->indicator}}"
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
                                        class="col-xs-2 col-sm-2 required "  value="{{$data->poin}}"
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
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>

@endsection