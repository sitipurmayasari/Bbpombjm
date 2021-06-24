@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
<li>Rekapitulasi</a></li>
<li>Rekap Angka Kredit</li>

@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('rekapdupak.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Rekapitulasi Angka Kredit</h4>
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
                                <select name="jenis" id="jenis" class="col-xs-10 col-sm-10 select2" onchange="myFunction()">
                                    <option value="1">Rekap Umum</option>
                                    <option value="2">Rekap Per Pegawai</option>
                                    <option value="3">Rekap per Poin</option>
                                    <option value="4">Rekap per Jabatan</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="user">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Nama Pegawai
                            </label>
                            <div class="col-sm-8">
                                <select name="pegawai" class="col-xs-10 col-sm-10 required select2">
                                    <option value="">Pilih pegawai</option>
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->name}} || {{$item->no_pegawai}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="jabatan">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Jabatan
                            </label>
                            <div class="col-sm-8">
                                <select name="jabasn" class="col-xs-10 col-sm-10 required select2">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabasn as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="poin">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Poin
                            </label>
                            <div class="col-sm-8">
                                <select name="poin" class="col-xs-10 col-sm-10 required select2">
                                    <option value="">Pilih Poin</option>
                                    <option value="a">< 94</option>
                                    <option value="b">>= 94 < 185 </option>
                                    <option value="c">>= 185 < 370</option>
                                    <option value="d">>= 370 < 735 </option>
                                    <option value="e">>= 735</option>
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
                <input type="submit" value="LIHAT" class="btn btn-primary">
            </div>
        </div>

    </div>
    </form>
</div>

@endsection

@section('footer')
<script>
     $(document).ready(function(){
        $("#poin").hide();
        $("#jabatan").hide();
        $("#user").hide();
    });

    function myFunction() {
        var v = $("#jenis").val();
        if (v=="2") {
            $("#poin").hide();
                $("#jabatan").hide();
                $("#user").show();
        }else if(v=="3"){
                $("#poin").show();
                $("#jabatan").hide();
                $("#user").hide();
        }else if(v=="4"){
                $("#poin").hide();
                $("#jabatan").show();
                $("#user").hide();
        }else{
                $("#poin").hide();
                $("#jabatan").hide();
                $("#user").hide();
            
        }
      
    }
</script>
@endsection