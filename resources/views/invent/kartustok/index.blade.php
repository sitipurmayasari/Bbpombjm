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
                                    <option value="2">Laporan Fisik Kelompok Barang</option>
                                    <option value="1">Laporan Per Barang</option>
                                    <option value="3">Laporan Permintaan Per Laboratorium</option>
                                    <option value="4">Laporan Permintaan Persediaan</option>
                                    {{-- <option value="5">Laporan Transaksi Persediaan</option> --}}
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
                        <br>
                        <div class="form-group" id="gudang">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pilih Gudang
                            </label>
                            <div class="col-sm-8">
                                <select name="gudang" class="col-xs-10 col-sm-10">
                                    <option value="">Semua Lokasi</option>
                                    @foreach ($gudang as $item)
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
                                <select name="years" class="col-xs-10 col-sm-10">
                                    <?php
                                        $a=2022;
                                        $pus = $a+3;
                                        for ($a=2022;$a<=$pus;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div  class="form-group" id="pilihbulan">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pilih Bulan
                            </label>
                            <div class="col-sm-8">
                                <select id="bulan" name="bulan" class="col-xs-10 col-sm-10" required>
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
        $("#pilihbulan").hide();
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
                $("#pilihbulan").hide();
                $("#gudang").hide();
            }else if(v=="3"){
                $("#kelompok").hide();
                $("#barang").hide();
                $("#lab").show();
                $("#pilihtahun").show();
                $("#pilihbulan").hide();
                $("#gudang").hide();
            }else if(v=="4"){
                $("#kelompok").hide();
                $("#barang").hide();
                $("#lab").hide();
                $("#pilihtahun").show();
                 $("#pilihbulan").show();
                 $("#gudang").hide();
            }else if(v=="5"){
                $("#kelompok").show();
                $("#pilihtahun").show();
                 $("#pilihbulan").show();
                 $("#gudang").hide();
            }else{
                $("#barang").hide();
                $("#kelompok").show();
                $("#lab").hide();
                $("#pilihtahun").hide();
                $("#pilihbulan").hide();
                $("#gudang").show();
               
            } 
        });

    });
</script>
@endsection