@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Rekapitulasi</li>
    <li><a href="/amdk/rekpermit">Rekap Absensi Pramubakti</a></li>
    <li>Ubah Keterangan Absensi</li>
@endsection
@section('content')
@include('layouts.validasi')

<style>

</style>


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/rekpermit/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Keterangan Absensi</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body col-sm-10">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama
                        </label>
                        <div class="col-sm-9" >
                            <input type="text" name="name" class="col-xs-10 col-sm-10" value="{{$data->peg->name}}"
                             readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> keterangan
                        </label>
                        <div class="col-sm-9" >
                            <select name="ket_absen_id" class="col-xs-10 col-sm-10 select2">
                                @foreach ($kets as $sub)
                                        @if ($data->ket_absen_id==$sub->id)
                                            <option value="{{$sub->id}}" selected>{{$sub->ket}}</option>
                                        @else
                                            <option value="{{$sub->id}}">{{$sub->ket}}</option>
                                        @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Poin
                        </label>
                        <div class="col-sm-9">
                            <input type="number" required  value="{{$data->poin}}"
                            class="col-xs-2 col-sm-2 required "
                            name="poin"/>
                        </div>
                    </div>
                    @php
                        if ($data->terlambat != null) {
                            $ter = $data->terlambat;
                        } else {
                            $ter = "00:00:00";
                        }

                        if ($data->pulang_cepat != null) {
                            $pul = $data->pulang_cepat;
                        } else {
                            $pul = "00:00:00";
                        }
                        
                        
                    @endphp
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Terlambat
                        </label>
                        <div class="col-sm-9" >
                            
                            <input type="text" name="terlambat" class="col-xs-10 col-sm-10" value="{{$ter}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pulang Cepat
                        </label>
                        <div class="col-sm-9" >
                            <input type="text" name="pulang_cepat"  class="col-xs-10 col-sm-10" value="{{$pul}}" >
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

@section('footer')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js " referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: "textarea"
    });
</script>
@endsection