@extends('layouts.mon')
@section('breadcrumb')
<li>RAPK</a></li>
<li>Laporan RAPK</li>

@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('lapRAPK.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Laporan RAPK</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-12">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group" id="nas">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Laporan
                            </label>
                            <div class="col-sm-10">
                                <select id="bulan" name="jenis" class="col-xs-6 col-sm-6 select2">
                                    <option value="1">Realisasi </option>
                                    <option value="2">Capaian Rencana </option>
                                    <option value="3">Nilai Pencapaian </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Periode Tahun
                            </label>
                            <div class="col-sm-10">
                                <select name="years" class="col-xs-6 col-sm-6 select2">
                                    <option value=""> Pilih Tahun</option>
                                    <?php
                                        $a=date('Y');
                                        $pus = $a+4;
                                        for ($a=date('Y');$a<=$pus;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Periode Triwulan
                            </label>
                            <div class="col-sm-10">
                                <select name="triwulan" class="col-xs-6 col-sm-6 select2">
                                    <option value="TWI">Triwulan I</option>
                                    <option value="TWII">Triwulan II</option>
                                    <option value="TWIII">Triwulan III</option>
                                    <option value="TWIV">Triwulan IV</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        </fieldset>        
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <div class="form-group col-xs-12 col-sm-3" style="float: left">
                <input type="submit" value="CETAK" class="btn btn-primary">
            </div>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer') 
<script>
     $(document).ready(function(){
        $("#balai").hide();

        $("#N").click(function(){
            $("#nas").show();
            $("#balai").hide();
        });

        $("#B").click(function(){
            $("#nas").hide();
            $("#balai").show();
        });
    });
</script>
@endsection