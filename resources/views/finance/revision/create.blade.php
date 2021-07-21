@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/revision">POK</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('revision.impor')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">POK Revisi</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Kode Kegiatan *
                            </label>
                            <div class="col-sm-8">
                                <select id="activitycode_id" name="activitycode_id" class="col-xs-10 col-sm-10 select2" required>
                                        <option value="">Pilih Kode</option>
                                    @foreach ($act as $data)
                                        <option value="{{$data->id}}">{{$data->prog->code}} - {{$data->code}} || {{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tahun Pelaksanaan *
                            </label>
                            <div class="col-sm-8">
                                <select id="tahun" name="year" class="col-xs-10 col-sm-10 select2" required>
                                    <option value="">Pilih Tahun</option>
                                    @php
                                        $now=date('Y');
                                        $a = $now+1;
                                        echo 
                                        "<option value='$now'>$now</option>
                                        <option value='$a'>$a</option>";
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Pegawai
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                                <input type="text" name="users_name" class="col-xs-10 col-sm-10" readonly
                                value="{{auth()->user()->name}}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis POK
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" required value="AWAL" checked onclick="respe();"
                                name="jenis" id="A"/> &nbsp; Awal &nbsp;
                                <input type="radio" required value="REVISI" onclick="respe();"
                                name="jenis" id="R"/> &nbsp; Revisi
                            </div>
                        </div>
                        <div class="form-group" id="revke">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> POK Revisi Ke-
                            </label>
                            <div class="col-sm-8">
                                <input type="number" name="revisi" class="col-xs-2 col-sm-2" min="0" value="0" required/>
                            </div>
                        </div>
                        <div class="form-group" id="asalasal">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Asal
                            </label>
                            <div class="col-sm-8" >
                                <select name="asal"  class="col-xs-10 col-sm-10">
                                    <option value="DIPA">DIPA</option>
                                    <option value="SATKER">SATKER</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="kodeasal">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kode Asal
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="kode_asal" class="col-xs-2 col-sm-2" value="0" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Impor Excel</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <input type="file" name="diimpor" class="btn btn-default btn-sm" id="" value="Upload File">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Simpan
        </button>
    </div>
</div>
</form>

@endsection
@section('footer')
<script>
    $().ready( function () {
        $("#revke").hide();
        $("#asalasal").hide();
        $("#kodeasal").hide();
    } );

    function respe(){
        if (document.getElementById('R').checked) 
        {
            $("#revke").show();
            $("#asalasal").show();
            $("#kodeasal").show();
        } else if(document.getElementById('A').checked) {
            $("#revke").hide();
            $("#asalasal").hide();
            $("#kodeasal").hide();
            var c = 0;
            $("#revke").val(c);
            $("#kodeasal").val(c);
        }
    }

</script>
@endsection
