@extends('layouts.tomi')
@section('breadcrumb')
    <li>>Laporan</li>
    <li>Laporan Perjalanan Dinas</li>

@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('laptomiku.cetak')}}">

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
                                <input type="text" value="Laporan Pengambilan Mikroba Baku"  class="col-xs-12 col-sm-12" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">
                            </label>
                            <div class="col-sm-8" id='mew'>
                                <select name="daftartahun" class="col-xs-12 col-sm-12">
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
                                <select id="bulan" name="daftarbulan" class="col-xs-12 col-sm-12 select2">
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
