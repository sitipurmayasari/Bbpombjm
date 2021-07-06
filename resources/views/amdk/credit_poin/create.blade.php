@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Dupak</li>
    <li><a href="/amdk/credit_poin">Rapel Kredit Poin</a></li>
    <li>Tambah Rapel Kredit Poin</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" id="form_id"
         method="post" action="{{route('credit_poin.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}

    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form Tambah Rapel Kredit Poin</h4>
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
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-8">
                            <select name="users_id" class="col-xs-10 col-sm-10 required select2" >
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($user as $div)
                                        <option value="{{$div->id}}">{{$div->name}} ({{$div->no_pegawai}})</option>
                                    @endforeach
                            </select>
                            <input type="hidden" name="status" value="R" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Masa Penilaian
                        </label>
                        <div class="col-sm-8">
                            <input type="date"  style="width: 20%"
                            name="dari" required />
                            <label class="control-label" >&nbsp; S/d &nbsp;</label>
                            <input type="date"  style="width: 20%"
                            name="sampai" required />
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Nilai Kredit
                        </label>
                        <div class="col-sm-8" >
                            <input type="number" step="0.001" min="0" class="col-xs-2 col-sm-2 required "  placeholder="0"
                            name="jumlah"/>&nbsp;
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
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>

@endsection
