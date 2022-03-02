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
                                    <option value="3">Laporan Permintaan Per Laboratorium</option>
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

        $("#barang").hide();
        $("#lab").hide();
        $("#pilihtahun").hide();
        $("#jenis").on("change", function(){
            var v = $(this).val();
            if(v=="1"){
                $("#kelompok").hide();
                $("#barang").show();
                $("#lab").hide();
                $("#pilihtahun").hide();
            }else if(v=="3"){
                $("#kelompok").hide();
                $("#barang").hide();
                $("#lab").show();
                $("#pilihtahun").show();
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