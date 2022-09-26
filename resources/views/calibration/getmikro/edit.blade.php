@extends('layouts.tomi')
@section('breadcrumb')
<li><a href="/calibration/getmikro"> Pengambilan Mikroba Baku</a></li>
<li>Ubah Pengambilan Mikroba Baku</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="/calibration/getmikro/update/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">>Ubah Pengambilan Mikroba Baku</h3></div>
                <div class="panel-body">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="dates" 
                                            class="col-xs-3 col-sm-3 required" value="{{$data->dates}}" required
                                            data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">Nama Bakteri
                            </label>
                            <div class="col-sm-8">
                               <select name="bakteri_id" id="bakteri" required class="col-xs-10 col-sm-10 required select2">
                                    <option value="">Pilih Bakteri</option>
                                    @foreach ($bakteri as $item)
                                        @if ($data->bakteri_id == $item->id)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Petugas
                            </label>
                            <div class="col-sm-8">
                                <select name="users_id" required class="col-xs-10 col-sm-10 required select2" >
                                    <option value="">Pilih Petugas</option>
                                    @foreach ($peg as $item)
                                        @if ($item->id == $data->users_id)
                                            <option value="{{$item->id}}" selected>{{$item->name}} ({{$item->no_pegawai}})</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}} ({{$item->no_pegawai}})</option>
                                        @endif
                                    @endforeach
                               </select>
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

@endsection