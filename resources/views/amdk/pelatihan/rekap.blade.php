@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Rekapitulasi</li>
    <li><a href="/amdk/rekappelatihan">Rekap Kompetensi Pegawai</a></li>
    <li>Cetak Rekapitulasi</li>
@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('pelatihan.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Cetak Rekapitulasi Kompetensi Pegawai</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body col-sm-8">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis Data
                        </label>
                        <div class="col-sm-9" >
                            <input type="radio" name="peg" value="1" checked id="all">
                                <label class="control-label no-padding-right" for="form-field-1"> Semua</label> 
                                &nbsp;&nbsp;
                                <input type="radio" name="peg" value="2" id="per">
                                <label class="control-label no-padding-right" for="form-field-1"> Per Pegawai</label>
                        </div>
                    </div>
                    <div class="form-group"  id="pegawai">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-9">
                            <select name="user" class="col-xs-10 col-sm-10 select2">
                                <option value="">Pilih Pegawai</option>
                                @foreach ($user as $peg)
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="listtahun">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pilih Tahun
                        </label>
                        <div class="col-sm-3" >
                            <select name="daftartahun" class="col-xs-10 col-sm-10">
                                <option value="">Tahun</option>
                                <?php
                                    $now=date('Y');
                                    for ($a=2020;$a<=$now;$a++)
                                    {
                                        echo "<option value='$a'>$a</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div  class="form-group" id="a">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Mulai
                        </label>
                        <div class="col-sm-9" >
                            <input type="date" name="awal" class="col-xs-5 col-sm-5"/>
                    </div>
                    <div  class="form-group" id="b">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Akhir
                        </label>
                        <div class="col-sm-9" >
                            <input type="date" name="akhir" class="col-xs-5 col-sm-5"/>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-warning btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>CETAK
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
<script>
    $(document).ready(function(){
        $("#pegawai").hide();
        $("#a").hide();
        $("#b").hide();

        $("#all").click(function(){
            $("#pegawai").hide();
            $("#a").hide();
            $("#b").hide();
            $("#listtahun").show();
        });
        $("#per").click(function(){
            $("#pegawai").show();
            $("#a").show();
            $("#b").show();
            $("#listtahun").hide();
        });

    });
</script>
@endsection