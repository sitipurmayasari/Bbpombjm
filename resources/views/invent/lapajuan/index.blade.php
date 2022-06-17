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
                                    <option value="baru">Laporan Pengajuan barang Baru</option>
                                    <option value="rusaktik">Laporan Kerusakan TIK</option>
                                    <option value="rusak">Laporan Kerusakan Inventaris</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pilih Tahun
                            </label>
                            <div class="col-sm-8">
                                <select name="daftartahun" class="col-xs-10 col-sm-10">
                                    <?php
                                        $now=date('Y');
                                        for ($a=2022;$a<=$now;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div  class="form-group" id="pilihminggu">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pilih Daftar
                            </label>
                            <div class="col-sm-9">
                                <div id ="allthn" class="col-xs-2 col-sm-4">
                                    <input type="radio" name="piltgl" value="3" id="tgl3">
                                    <label class="control-label no-padding-right" for="form-field-1"> Per Tahun</label> 
                                    &nbsp;&nbsp;
                                </div>
                                <div id="allbln" class="col-xs-2 col-sm-4">
                                    <input type="radio" name="piltgl" value="1" checked id="tgl">
                                    <label class="control-label no-padding-right" for="form-field-1"> Per Bulan</label> 
                                    &nbsp;&nbsp;
                                </div>
                                <div id="alltgl" class="col-xs-2 col-sm-4">
                                    <input type="radio" name="piltgl" value="2" id="tgl2">
                                    <label class="control-label no-padding-right" for="form-field-1"> Per Tanggal</label>
                                </div>
                            </div>
                        </div>
                        <div  class="form-group" id="pilihbulan">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pilih Bulan
                            </label>
                            <div class="col-sm-8">
                                <select id="bulan" name="daftarbulan" class="col-xs-10 col-sm-10" required>
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
                        <div  class="form-group" id="a">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Mulai
                            </label>
                            <div class="col-sm-8" >
                                <input type="date" name="awal" class="col-xs-10 col-sm-10"/>
                        </div>
                        <div  class="form-group" id="b">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Akhir
                            </label>
                            <div class="col-sm-8" >
                                <input type="date" name="akhir" class="col-xs-10 col-sm-10"/>
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
        $("#pilihbulan").show();
        $("#pilihminggu").show();
        $("#a").hide();
        $("#b").hide();
        $("#allthn").hide();

        $("#jenis").on("change", function(){
            var v = $(this).val();
            if(v=="baru"){
                $("#pilihbulan").show();
                $("#pilihminggu").show();
                $("#alltgl").show();
                $("#allthn").hide();
                $("#a").hide();
                $("#b").hide();
            }else if(v=="rusaktik"){
                $("#pilihbulan").show();
                $("#pilihminggu").show();
                $("#alltgl").hide();
                $("#allthn").show();
                $("#a").hide();
                $("#b").hide();      
            }else{
                $("#pilihbulan").show();
                $("#pilihminggu").hide();
                $("#a").hide();
                $("#b").hide();             
            } 
        });

        $("#tgl").click(function(){
            $("#a").hide();
            $("#b").hide();
            $("#pilihbulan").show();
        });
        $("#tgl2").click(function(){
            $("#a").show();
            $("#b").show();
            $("#pilihbulan").hide();
        });
        $("#tgl3").click(function(){
            $("#a").hide();
            $("#b").hide();
            $("#pilihbulan").hide();
        });

    });
</script>
@endsection