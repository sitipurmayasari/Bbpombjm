@extends('ppnpn/layouts.app')
@section('breadcrumb')
    <li>Rekapitulasi</li>
    <li><a href="/amdk/rekpermit">Rekap Absensi Pramubakti</a></li>
    <li>Upload Absensi Pramubakti</li>
@endsection
@section('content')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('rekpermit.store')}}"  enctype="multipart/form-data">
         {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">  Upload Absensi Pramubakti</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding" col-sm-8>
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Periode Bulan 
                        </label>
                        <div class="col-sm-8">
                            <select id="bulan" name="periode_year" class="col-xs-5 col-sm-5 select2" required>
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
                        for="form-field-1"> Periode Tahun 
                        </label>
                        <div class="col-sm-8">
                            <select id="tahun" name="periode_month" class="col-xs-5 col-sm-5" required>
                                @php
                                    $now=date('Y');
                                        for ($a=2023;$a<=$now;$a++)
                                            {
                                                echo "<option value='$a'>$a</option>";
                                            }
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Upload File
                        </label>
                        <div class="col-sm-10">
                            <input type="file" name="imporfile" class="btn btn-default btn-sm" id="" value="Upload File">
                            <label><i>*File Excel</i></label>   
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
                <i class="ace-icon fa fa-check bigger-110"></i>Generate
            </button>
        </div>
    </div>
    </form>
</div>
@endsection