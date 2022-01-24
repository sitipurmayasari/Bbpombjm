@extends('layouts.app')
@section('breadcrumb')
    <li><a href="/invent/laporan">Laporan</a></li>
    <li>Laporan Inventaris</li>

@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('kartustok.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Laporan Inventaris</h4>
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
                                <select name="jenis_Laporan" id="jenis" class="col-xs-10 col-sm-10" onchange="myFunction()">
                                    <option value="2">Sisa Stok Kelompok Barang</option>
                                    <option value="3">Lapooran Permintaan Per Laboratorium</option>
                                    <option value="1">Laporan Per Barang</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="kelompok">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kelompok
                            </label>
                            <div class="col-sm-8">
                                <select name="kelompok" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih kelompok</option>
                                    @foreach ($jenis as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="lab">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Laboratorium
                            </label>
                            <div class="col-sm-8">
                                <select name="labory" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Laboratorium</option>
                                    @foreach ($lab as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="barang">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Barang
                            </label>
                            <div class="col-sm-8">
                                <select name="inventaris_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Barang</option>
                                    @foreach ($dataman as $item)
                                        <option value="{{$item->id}}">{{$item->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="pilihtahun">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tahun
                            </label>
                            <div class="col-sm-8">
                                <select name="years" class="col-xs-10 col-sm-10 select2">
                                    <?php
                                        $a=2022;
                                        $pus = $a+3;
                                        for ($a=date('Y');$a<=$pus;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        {{-- <div class="form-group" id="pilihbulan">
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
                        <br>
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
        // $("#tampildetilbulan").hide();
        $("#barang").hide();
        $("#lab").hide();

        // $("#bln").click(function(){
        //     $("#tampildetilbulan").hide();
        // });
        // $("#bln2").click(function(){
        //     $("#tampildetilbulan").show();
        // });
    
        $("#jenis").on("change", function(){
            var v = $(this).val();
            if(v=="1"){
                $("#kelompok").hide();
                $("#barang").show();
                $("#lab").hide();
                $("#pilihtahun").show();
                // $("#pilihbulan").show();
            }else if(v=="3"){
                $("#kelompok").hide();
                $("#barang").hide();
                $("#lab").show();
                $("#pilihtahun").show();
                // $("#pilihbulan").hide();
            }else{
                $("#barang").hide();
                $("#kelompok").show();
                $("#lab").hide();
                $("#pilihtahun").hide();
                // $("#pilihbulan").hide();
            } 
        });

    });
</script>
@endsection