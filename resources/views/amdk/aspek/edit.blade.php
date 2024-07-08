@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Kompetensi Pegawai</li>
    <li><a href="/amdk/aspek"> Aspek Evaluasi</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/aspek/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Aspek Evaluasi</h4>
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
                        for="form-field-1"> Aspek
                        </label>

                        <div class="col-sm-8">
                            <input type="text"  placeholder=" Masukkan Aspek Evaluasi" 
                                    class="col-xs-10 col-sm-10 required " value="{{$data->aspek}}"
                                    name="aspek" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Aktif
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
    </div><!-- /.col -->
    
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