@extends('layouts.mon')
@section('breadcrumb')
    <li>Indikator Kinerja</li>
    <li><a href="/finance/ikutagging">Tagging Anggaran</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('ikutagging.impor')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">A. Upload Pagu</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">Tanggal
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_pagu" 
                                class="col-xs-3 col-sm-3 required" value="{{date('Y-m-d')}}" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tahun Pagu *
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
                            for="form-field-1"> Bulan Pagu *
                            </label>
                            <div class="col-sm-8">
                                <select id="tahun" name="month" class="col-xs-10 col-sm-10 select2" required>
                                    <option value="">Pilih Bulan</option>
                                    @php
                                            $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                                            "September", "Oktober", "November", "Desember");
                                            for($a=1;$a<=12;$a++){
                                            if($a==date("m")){ 
                                                $pilih="selected";
                                            }else {
                                                $pilih="";
                                            }
                                                echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
                                            }
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Dibuat Oleh
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                                <input type="text" name="users_name" class="col-xs-10 col-sm-10" readonly
                                value="{{auth()->user()->name}}" />
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