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
                                    <option value="1">Rekap Tahunan</option>
                                    <option value="2">Rekap Tahunan Per Lokasi</option>
                                    <option value="3">Rekap Tahunan Per Sumber Dana</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="lokasi">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Lokasi
                            </label>
                            <div class="col-sm-8">
                                <select name="loka" class="col-xs-10 col-sm-10 required ">
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($loka as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="sd">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Sumber Dana
                            </label>
                            <div class="col-sm-8">
                                <select name="sd" class="col-xs-10 col-sm-10 required ">
                                    <option value="">Pilih Sumber</option>
                                    <option value="RM">RM</option>
                                    <option value="PNBP">PNBP</option>
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
        $("#lokasi").hide();
        $("#sd").hide();
    
        $("#jenis").on("change", function(){
            var v = $(this).val();
            if(v=="2"){
                $("#lokasi").show();
                $("#sd").hide();
            }else if(v=="3"){
                $("#lokasi").hide();
                $("#sd").show();
            }else{
                $("#lokasi").hide();
                $("#sd").hide();
            } 
        });
    });
</script>
@endsection