@extends('ppnpn/layouts.app')
@section('breadcrumb')
    <li>Rekapitulasi</li>
    <li><a href="/amdk/rekpermit">Rekap Absensi Pramubakti</a></li>
    <li>Upload Absensi Pramubakti</li>
@endsection
@section('content')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('rekpermit.cetak')}}"  enctype="multipart/form-data">
         {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">  Upload Absensi Pramubakti</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding" col-sm-8>
                    <fieldset>
                    <br>
                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis Laporan 
                        </label>
                        <div class="col-sm-8">
                            <select id="jenis" name="jenis" class="col-xs-5 col-sm-5" required>
                                <option value="1">Laporan Poin Si Amat</option>
                                <option value="2">Rekap Absensi</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group" id="amat">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Data Pegawai 
                        </label>
                        <div class="col-sm-8">
                            <input type="radio" name="peg" value="1" checked id="all">
                            <label class="control-label no-padding-right" for="form-field-1"> Semua Pegawai</label> 
                            &nbsp;&nbsp;
                            <input type="radio" name="peg" value="2" id="per">
                            <label class="control-label no-padding-right" for="form-field-1"> Per Pegawai</label>
                        </div>
                    </div>
                    <div class="form-group"  id="pegawai">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-8">
                            <select name="user" class="col-xs-10 col-sm-10 select2">
                                <option value="">Pilih Pegawai</option>
                                @foreach ($user as $peg)
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Periode Tahun 
                        </label>
                        <div class="col-sm-8">
                            <select id="tahun" name="tahun" class="col-xs-10 col-sm-10" required>
                                @php
                                    $now=date('Y');
                                        for ($a=2022;$a<=$now;$a++)
                                            {
                                                echo "<option value='$a'>$a</option>";
                                            }
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Periode Bulan 
                        </label>
                        <div class="col-sm-8">
                            <select id="bulan" name="bulan" class="col-xs-10 col-sm-10 select2" required>
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
    </div><!-- /.col -->
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Cetak
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

        $("#all").click(function(){
            $("#pegawai").hide();
        });
        $("#per").click(function(){
            $("#pegawai").show();
        });
        // $("#jenis").on("change", function(){
        //     var v = $(this).val();
        //     if(v=="Daftar"){
        //         $("#brg").hide();
        //         $("#ruang").show();
        //     }else if(v=="TJawab"){
        //         $("#brg").hide();
        //         $("#ruang").show();
        //     }else if(v=="Main"){
        //         $("#brg").show();
        //         $("#ruang").hide();
        //     }else{
        //         $("#brg").hide();
        //         $("#ruang").show();
        //     } 
        // });

    });
</script>
@endsection