@extends('layouts.din')
@section('breadcrumb')
    <li>>Laporan</li>
    <li>Laporan Perjalanan Dinas</li>

@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('outreport.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Laporan Perjalanan Dinas</h4>
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
                                    <option value="">Pilih Jenis Laporan</option>
                                    <option value="ST">Laporan daftar ST Keluar</option>
                                    <option value="Peg">Laporan Daftar Pegawai Dinas</option>
                                    <option value="Per">Laporan Perjadin Per Pegawai</option>
                                    <option value="Kui">Laporan Biaya Perjalanan Dinas</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="ruang">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Bidang
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="divisi" class="col-xs-10 col-sm-10">
                                    <option value="">Semua Bidang</option>
                                    @foreach ($div as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="pok">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Anggaran
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="pok_detail" class="col-xs-10 col-sm-10 select2">
                                    @foreach ($pok as $item)
                                        <option value="{{$item->id}}">
                                            {{$item->pok->act->lengkap}}/{{$item->sub->kodeall}}/
                                            {{$item->akun->code}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="Datapeg">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Pegawai
                            </label>
                            <div class="col-sm-8">
                                <select id="users" name="users" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Pegawai</option>
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->name}} (NIP/NIK. {{$item->no_pegawai}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <br> --}}
                        {{-- <div class="form-group">
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
                        <br> --}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">
                            </label>
                            <div class="col-sm-8" id='mew'>
                                <select name="daftartahun" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Tahun</option>
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
                        <br>
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
                        </div>


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
        // $("#mew").hide();
        $("#brg").hide();
        // $("#tampilbulan").hide();
        $("#tampildetilbulan").hide();
        $("#Datapeg").hide();
        $("#pok").hide();

        // $("#thn").click(function(){
        //     $("#mew").hide();
        // });

        // $("#thn2").click(function(){
        //     $("#mew").show();
        //     $("#tampilbulan").show();
        // });

        $("#bln").click(function(){
            $("#tampildetilbulan").hide();
        });
        
        $("#bln2").click(function(){
            $("#tampildetilbulan").show();
        });

    });


    $("#jenis").on("change", function(){
            var v = $(this).val();
            if(v=="Per"){
                $("#ruang").hide();
                $("#Datapeg").show();
                $("#pok").hide();
            }else if(v=="Kui"){
                $("#pok").show();
            }else{
                $("#Datapeg").hide();
                $("#ruang").show();
                $("#pok").hide();
            } 
        });
</script>
@endsection
