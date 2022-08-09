@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/dupak"> Daftar Usulan Penetapan Angka Kredit</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/dupak/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form Daftar Usulan Penetapan Angka Kredit</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Nomor KP
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  placeholder="Nomor KP" class="col-xs-8 col-sm-8 required " 
                            name="nomor_kp" required value="{{$data->nomor_kp}}"/>
                            <input type="hidden" name="status" value="A">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Rapel Kredit
                        </label>
                        <div class="col-sm-9" >
                            @if ($data->rapel=='Y')
                                <input type="checkbox"  id="rapel" name="rapel" value="Y" checked>&nbsp;
                                <label class="control-label" for="form-field-1"> Ya </label>
                            @else
                                <input type="checkbox"  id="rapel" name="rapel" value="Y" >&nbsp;
                                <label class="control-label" for="form-field-1"> Ya </label>
                            @endif  


                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Penetapan
                        </label>
                        <div class="col-sm-9">
                            <input type="date"  style="width: 20%" 
                            name="tanggal" required value="{{$data->tanggal}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Masa Penilaian
                        </label>
                        <div class="col-sm-9">
                            <input type="date"  style="width: 20%"
                            name="dari" required value="{{$data->dari}}"/>
                            <label class="control-label" > S/d </label>
                            <input type="date"  style="width: 20%"
                            name="sampai" required value="{{$data->sampai}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-9">
                            <select id="users_id" name="users_id" class="col-xs-8 col-sm-8 select2" onchange="getDataPeg()">
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($user as $peg)
                                    @if ($data->users_id==$peg->id)
                                        <option value="{{$peg->id}}" selected>{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @else
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Nomor Seri Karpeg
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  class="col-xs-8 col-sm-8 required " value="{{$data->seri_karpeg}}"
                            name="seri_karpeg" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Pendidikan Terakhir
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  class="col-xs-8 col-sm-8 required " readonly 
                            name="pend" required id="pend" value="{{$data->jurusan}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Tmt Pang&Gol Lama
                        </label>
                        <div class="col-sm-9">
                            <input type="date" style="width: 20%" value="{{$data->tmt}}"
                            name="tmt" />
                        </div>
                    </div>
                    <div class="form-group" id="tmtlama">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> TMT Jabatan Lama
                        </label>
                        <div class="col-sm-9" >
                            <input type="date" style="width: 20%" value="{{$data->tmtlama}}"
                            name="tmtlama" />
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Pangkat & Golongan
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  class="col-xs-8 col-sm-8 required " readonly 
                            name="gol" id="gol" required value="{{$data->golongan}} / {{$data->ruang}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Jabatan Fungsional
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  class="col-xs-8 col-sm-8 required " readonly 
                            name="gol" id="gol" value="{{$data->pegawai->jabasn->nama}}"/>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Masa Kerja Pan&Gol
                        </label>
                        <div class="col-sm-9">
                            <input type="number"  min="0" style="width: 5%" value="{{$data->masa_lama_thn}}"
                            name="masa_lama_thn" required />&nbsp;
                            <label for="">Tahun</label>&nbsp;&nbsp;&nbsp;
                            <input type="number"  min="0" style="width: 5%" value="{{$data->masa_lama_bln}}"
                            name="masa_lama_bln" required />&nbsp;
                            <label for="">Bulan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Masa Kerja Baru
                        </label>
                        <div class="col-sm-9">
                            <input type="number" min="0" style="width: 5%" value="{{$data->masa_baru_thn}}"
                            name="masa_baru_thn" required />&nbsp;
                            <label for="">Tahun</label>&nbsp;&nbsp;&nbsp;
                            <input type="number" min="0" style="width: 5%" value="{{$data->masa_baru_bln}}"
                            name="masa_baru_bln" required />&nbsp;
                            <label for="">Bulan</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Kenaikan Pangkat & Jabatan
                        </label>
                        <div class="col-sm-9" >
                            <select name="promoted" id="promoted" onchange="ubah()" class="col-xs-8 col-sm-8 required select2">
                                @if ($data->promoted=='P')
                                    <option value="N">Tetap</option>
                                    <option value="P" selected>Kenaikan Pangkat</option>
                                    <option value="J">Kenaikan Jabatan</option>
                                    <option value="A">kenaikan Pangkat & Jabatan</option>

                                @elseif ($data->promoted=='J')
                                    <option value="N" selected>Tetap</option>
                                    <option value="P">Kenaikan Pangkat</option>
                                    <option value="J" selected>Kenaikan Jabatan</option>
                                    <option value="A">kenaikan Pangkat & Jabatan</option>
                                @elseif ($data->promoted=='A')
                                    <option value="N" selected>Tetap</option>
                                    <option value="P">Kenaikan Pangkat</option>
                                    <option value="J">Kenaikan Jabatan</option>
                                    <option value="A" selected>kenaikan Pangkat & Jabatan</option>
                                @else
                                    <option value="N" selected>Tetap</option>
                                    <option value="P">Kenaikan Pangkat</option>
                                    <option value="J">Kenaikan Jabatan</option>
                                    <option value="A">kenaikan Pangkat & Jabatan</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="usul">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Usul Kenaikan Pangkat
                        </label>
                        <div class="col-sm-9" >
                            <select id="status" name="golongan_id" class="col-xs-2 col-sm-2 select2">
                                <option value="">Pilih Golongan</option>
                                @foreach ($gol as $item)
                                    @if  ($data->golongan_id==$item->id)
                                        <option value="{{$item->id}}" selected>{{$item->golongan}} / {{$item->ruang}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->golongan}} / {{$item->ruang}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="jabasn">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Usul Kenaikan Jabatan
                        </label>
                        <div class="col-sm-9">
                            <select name="jabasn_id" class="col-xs-8 col-sm-8 select2">
                                <option value="">Pilih Jabatan</option>
                            @foreach ($jabasn as $peg)
                                @if ($data->jabasn_id==$peg->id)
                                    <option value="{{$peg->id}}" selected>{{$peg->nama}}</option>
                                @else
                                    <option value="{{$peg->id}}">{{$peg->nama}}</option>
                                @endif
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group" id="tmtusul">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> TMT Golongan Baru
                        </label>
                        <div class="col-sm-9" >
                            <input type="date" class="col-xs-2 col-sm-2 required " value="{{$data->tmtusul}}"
                            name="tmtusul" />
                        </div>
                    </div>
                    <div class="form-group" id="tmtjabbaru">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> TMT Jabatan Baru
                        </label>
                        <div class="col-sm-9" >
                            <input type="date" class="col-xs-2 col-sm-2 required " value="{{$data->tmtjabbaru}}"
                            name="tmtjabbaru" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Reset Poin
                        </label>
                        <div class="col-sm-9" >
                            @if ($data->reset=='Y')
                                <input type="checkbox" id="reset" name="reset" value="Y" onclick="respe();" checked>&nbsp;
                                <label class="control-label" for="form-field-1"> Ya </label>
                            @else
                                <input type="checkbox" id="reset" name="reset" value="Y" onclick="respe();">&nbsp;
                                <label class="control-label" for="form-field-1"> Ya </label>
                            @endif      
                        </div>
                    </div>
                    <div class="form-group" id="startpoin">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Start Poin
                        </label>
                        <div class="col-sm-9" >
                            <input type="number" step="0.0001" min="0" class="col-xs-1 col-sm-1 required "  placeholder="0" onkeyup="reskredit()"
                            name="startpoin" id="darinol" value="{{$data->startpoin}}" step="c" />&nbsp;
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">  Upload File
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><a href="{{$data->getFIleDupak()}}" target="_blank" >{{$data->file}}</a></label>
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
    </div><!-- /.col -->

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">ANGKA KREDIT</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                    <table id="myTable" class="table table-bordered table-hover">
                        <tr style="text-align: center">
                            <td colspan="3"><b>PENETAPAN ANGKA KREDIT</b></td>
                            <td><b>BARU</b></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td colspan="5"><b>UNSUR UTAMA</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%">a</td>
                            <td style="width: 80%">Pendidikan: <br>
                                1. Pendidikan sekolah dan memperoleh ijasah / gelar
                            </td>
                            <td><input type="number" min="0" step="0.0001" name="sa1" placeholder="0" value="{{$data->sa1}}" id="1a1" onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%"></td>
                            <td>2. Pendidikan dan pelatihan fungsional di bidang Pengawas Farmasi dan Makanan
                                dan mendapatkan Surat Tanda Tamat Pendididikan dan Pelatihan (STTPL)
                            </td>
                            <td><input type="number" min="0"  step="0.0001" name="sa2" placeholder="0" id="1a2"   value="{{$data->sa2}}" onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%">b.</td>
                            <td>Pengawas Farmasi dan Makanan
                            </td>
                            <td><input type="number" min="0" step="0.0001" name="sb" placeholder="0" id="1b"  value="{{$data->sb}}" onkeyup=onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%">c.</td>
                            <td>Pengembangan Profesi
                            </td>
                            <td><input type="number" min="0" step="0.0001" name="sc" placeholder="0" id="1c"  value="{{$data->sc}}" onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%"></td>
                            <td style="text-align: right">JUMLAH
                            </td>
                            <td><input type="number" min="0" step="0.0001" name="jum1" placeholder="0" readonly id="jum1" value="{{$data->jum1}}"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td colspan="5"><b>UNSUR PENUNJANG</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">Penunjang Tugas FPM</td>
                            <td><input type="number" min="0" step="0.0001" name="da" placeholder="0" id="2a"  value="{{$data->da}}" onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>JUMLAH UNSUR UTAMA DAN UNSUR PENUNJANG</b></td>
                            <td><input type="number" min="0"  step="0.0001" name="jumlah" placeholder="0" readonly id="jumlah" value="{{$data->jumlah}}"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>JUMLAH KREDIT LAMA</b></td>
                            <td><input type="number" min="0" step="0.0001" name="jumlama" placeholder="0" readonly id="jumlama" value="{{$data->jumlama}}"></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right"><b>TOTAL AKUMULASI KREDIT</b></td>
                            <td><input type="number" min="0" step="0.0001" name="total" placeholder="0" readonly id="total" value="{{$data->total}}"></td>
                        </tr>
                    </table>
               </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>
    
@endsection

@section('footer')
<script>
    $().ready( function () {

        $("#usul").hide();
        $("#tmtusul").hide();
        $("#tmtjabbaru").hide();
        $("#jabasn").hide();

        $("#startpoin").hide();

    } );

    function ubah() {
        isi = $("#promoted").val()
        if (isi=='P') {
            $("#usul").show();
            $("#tmtusul").show();
            $("#tmtjabbaru").hide();
            $("#jabasn").hide();
        }else if (isi=='J'){    
            $("#usul").hide();
            $("#tmtusul").hide();
            $("#tmtjabbaru").show();
            $("#jabasn").show();
        }else if (isi=='A'){  
            $("#usul").show();
            $("#tmtusul").show();
            $("#tmtjabbaru").show();
            $("#jabasn").show();
        } else {
            $("#usul").hide();
            $("#tmtusul").hide();
            $("#tmtjabbaru").hide();
            $("#jabasn").hide();
        }
    }

    function respe(){
        if (document.getElementById('reset').checked) 
        {
            $("#startpoin").show();
        } else {
            $("#startpoin").hide();
        }
    }

    function getDataPeg(){
        var users_id = $("#users_id").val();
        $.get(
            "{{route('dupak.getDataPeg') }}",
            {
                users_id: users_id
            },

            function(response) {
                $("#pend").val(response.riwayat.jurusan);
                $("#gol").val(response.riwayat.golongan+"/"+response.riwayat.ruang);

                if (response.riwayat.jl != null) {
                    $("#jumlama").val(response.riwayat.jl);
                } else {
                    var c = 0;
                    $("#jumlama").val(c);
                }
                
            }
        );
    }

    function reskredit(){
        var rp = $("#darinol").val();

        if (document.getElementById('reset').checked) 
        {
            $("#jumlama").val(rp);
        // } else {
        //     $("#jumlama").val();
        }
    }

    function hitung(){
        var a = $("#1a1").val();
        var b = $("#1a2").val();
        var c = $("#1b").val();
        var d = $("#1c").val();
        var e = $("#2a").val();
        var jumlama = $("#jumlama").val();

        var x =  parseFloat(a) +  parseFloat(b) + parseFloat(c) +  parseFloat(d);
        $("#jum1").val(x);

        var y = parseFloat(e) + parseFloat(x);
        var m =parseFloat(y).toFixed(4);
        $("#jumlah").val(m);  
    }

    function sum() {
        var y = $("#jumlah").val();
        var jumlama = $("#jumlama").val();

        var z = parseFloat(y) + parseFloat(jumlama);
        var n =parseFloat(z).toFixed(4);
        $("#total").val(n);
        
    }



   
</script>
@endsection