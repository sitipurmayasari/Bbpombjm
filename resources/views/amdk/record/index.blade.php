@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Rekapitulasi</li>
    <li>Cetak Rekapitulasi</li>
@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('record.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Cetak Rekaman Personil </h4>
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
                            <input type="radio" name="peg" value="1" checked id="1">
                                <label class="control-label no-padding-right" for="form-field-1"> PNS</label> 
                                &nbsp;&nbsp;
                                <input type="radio" name="peg" value="2" id="2">
                                <label class="control-label no-padding-right" for="form-field-1"> PPNPN</label>
                        </div>
                    </div>
                    <div class="form-group"  id="pns">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-9">
                            <select name="pns" class="col-xs-10 col-sm-10 select2">
                                <option value="">Pilih Pegawai</option>
                                @foreach ($pns as $peg)
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"  id="ppnpn">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-9">
                            <select name="ppnpn" class="col-xs-10 col-sm-10 select2">
                                <option value="">Pilih Pegawai</option>
                                @foreach ($ppnpn as $peg)
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-warning btn-sm " type="submit"  id="kliik">
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
        $("#ppnpn").hide();
        document.getElementById("kliik").disabled = true;

        $("#1").click(function(){
            $("#pns").show();
            $("#ppnpn").hide();
        });
        $("#2").click(function(){
            $("#pns").hide();
            $("#ppnpn").show();
        });
        $("#pns").on("change", function(){
            var v = $(this).val();
            if(v != null){
                document.getElementById("kliik").disabled = false;
            }else{
                document.getElementById("kliik").disabled = true;
            } 
        });
        $("#ppnpn").on("change", function(){
            var v = $(this).val();
            if(v != null){
                document.getElementById("kliik").disabled = false;
            }else{
                document.getElementById("kliik").disabled = true;
            } 
        });
    });
</script>
@endsection