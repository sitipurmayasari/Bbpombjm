@extends('layouts.app')
@section('breadcrumb')
    <li><a href="/invent/lapajuarusak">Laporan</a></li>
    <li>Laporan Pengajuan dan Kerusakan Barang</li>

@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('lapajuan.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Laporan Pengajuan dan Kerusakan Barang</h4>
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
                            for="form-field-1"> Jenis Laporan
                            </label>
                            <div class="col-sm-8">
                                <select name="jenis_Laporan" id="jenis" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Jenis Laporan</option>
                                    <option value="baru">Laporan Pengajuan barang Baru</option>
                                    <option value="rusak">Laporan Kerusakan </option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tahun
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" name="tahun" value="1" checked id="thn">
                                <label class="control-label no-padding-right" for="form-field-1"> Semua</label> 
                                &nbsp;&nbsp;
                                <input type="radio" name="tahun" value="2" id="thn2">
                                <label class="control-label no-padding-right" for="form-field-1"> Per Tahun</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">
                            </label>
                            <div class="col-sm-8" id='mew'>
                                <select name="daftartahun" class="col-xs-10 col-sm-10">
                                    <option value=""></option>
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


                        </fieldset>        
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right" id="tjawab">
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
        $("#mew").hide();
        $("#thn").click(function(){
            $("#mew").hide();
        });
        $("#thn2").click(function(){
            $("#mew").show();
        });
    
    });
</script>
@endsection