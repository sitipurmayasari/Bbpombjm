@extends('layouts.app')
@section('breadcrumb')
    <li>BMN</li>
    <li><a href="/invent/bpla">laporan Pemakaian Alat Lab</a></li>
@endsection

@section('content')
<div class="row">
    <form method="post" action="{{Route('bpla.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Laporan Pemakaian Alat Lab</h4>
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
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Laporan
                            </label>
                            <div class="col-sm-8">
                                <select name="jenis_Laporan" id="jenis" class="col-xs-10 col-sm-10" onchange="myFunction()">
                                    <option value="1">Laporan Penggunaan Per orang</option>
                                    <option value="2">Laporan Pengunaan Per Lab</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="lab">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Laboratorium
                            </label>
                            <div class="col-sm-8">
                                <select name="labory_id" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Laboratorium</option>
                                    @foreach ($lab as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="user">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Pengguna
                            </label>
                            <div class="col-sm-8">
                                <select name="user_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Pegawai</option>
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="year">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Pilih Tahun
                            </label>
                            <div class="col-sm-8" id='mew'>
                                <select name="daftartahun" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                        $now=date('Y');
                                        for ($a=2024;$a<=$now;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="tampilbulan">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Bulan
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" name="bulan" value="1" checked id="bln">
                                <label class="control-label no-padding-right" for="form-field-1"> Semua</label> 
                                &nbsp;&nbsp;
                                <input type="radio" name="bulan" value="2" id="bln2">
                                <label class="control-label no-padding-right" for="form-field-1"> Per bulan</label>
                            </div>
                        </div>
                        <div class="form-group" id="tampildetilbulan">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">
                            </label>
                            <div class="col-sm-8">
                                <select id="bulan" name="daftarbulan" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Bulan</option>
                                    @php
                                    $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                                     "September", "Oktober", "November", "Desember");
                                    for($a=1;$a<=12;$a++){
                                        $pilih="";
                                        echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
                                    }
                                    @endphp
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
        $("#lab").hide();
        $("#tampildetilbulan").hide();

        $("#bln").click(function(){
            $("#tampildetilbulan").hide();
        });
        
        $("#bln2").click(function(){
            $("#tampildetilbulan").show();
        });
        
        $("#jenis").on("change", function(){
            var v = $(this).val();
            if(v=="1"){
                $("#user").show();
                $("#lab").hide();
            }else{
                $("#user").hide();
                $("#lab").show();
               
            } 
        });

    });
</script>
@endsection