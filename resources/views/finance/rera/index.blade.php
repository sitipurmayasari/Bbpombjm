@extends('layouts.mon')
@section('breadcrumb')
<li>Laporan</a></li>
<li>Rekap Realisasi Anggaran</li>

@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('rera.cetakrekap')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Rekapitulasi Realisasi Anggaran</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Rekap
                            </label>
                            <div class="col-sm-8">
                                <select name="jenis" id="jenis" class="col-xs-10 col-sm-10" onchange="myFunction()">
                                    <option value="1">Rekap Per Minggu</option>
                                    <option value="2">Rekap Per Bulan</option>
                                    <option value="3">Rekap Per Triwulan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tahun
                            </label>
                            <div class="col-sm-8">
                                <select name="tahun" class="col-xs-10 col-sm-10">
                                    <?php
                                        $now=date('Y');
                                        for ($a=2021;$a<=$now;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-group" id="bulanan">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Bulan
                            </label>
                            <div class="col-sm-8">
                                <select id="bulan" name="bulan"  class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="mingguan">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Minggu
                            </label>
                            <div class="col-sm-8">
                                <select name="minggu" id="minggu" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Minggu</option>
                                    <option value="1">minggu 1</option>
                                    <option value="2">minggu 2</option>
                                    <option value="3">minggu 3</option>
                                    <option value="4">minggu 4</option>
                                </select>
                            </div>
                        </div> --}}
                        </fieldset>        
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right" id="tjawab">
            <div class="form-group col-xs-12 col-sm-3" style="float: left">
                <input type="submit" value="LIHAT" class="btn btn-primary">
            </div>
        </div>

    </div>
    </form>
</div>

@endsection

@section('footer') 
<script>
     $(document).ready(function(){
    });
</script>
@endsection