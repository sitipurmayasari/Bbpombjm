@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/dupak"> Daftar Usulan Penetapan Angka Kredit</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="{{route('dupak.store')}}" enctype="multipart/form-data">
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
                            name="nomor_kp" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Penetapan
                        </label>
                        <div class="col-sm-9">
                            <input type="date"  style="width: 20%" value="{{date('Y-m-d')}}"
                            name="tanggal" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Masa Penilaian
                        </label>
                        <div class="col-sm-9">
                            <input type="date"  style="width: 20%"
                            name="dari" required />
                            <label class="control-label" > S/d </label>
                            <input type="date"  style="width: 20%"
                            name="sampai" required />
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
                                <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Nomor Seri Karpeg
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  class="col-xs-8 col-sm-8 required " 
                            name="seri_karpeg" id="karpeg"  readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Pendidikan Terakhir
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  class="col-xs-8 col-sm-8 required " readonly 
                            name="pend" required id="pend"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Tmt Pang&Gol Lama
                        </label>
                        <div class="col-sm-9">
                            <input type="date" style="width: 20%" required
                            name="tmt" />
                        </div>
                    </div>
                    <div class="form-group" id="tmtlama">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> TMT Jabatan Lama
                        </label>
                        <div class="col-sm-9" >
                            <input type="date" style="width: 20%" 
                            name="tmtlama" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Pangkat & Golongan
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  class="col-xs-8 col-sm-8 required " readonly 
                            name="gol" id="gol" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Jabatan Fungsional
                        </label>
                        <div class="col-sm-9">
                            <input type="text"  class="col-xs-8 col-sm-8 required " readonly 
                            name="jafung" id="jafung" required />
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Masa Kerja Pan&Gol
                        </label>
                        <div class="col-sm-9">
                            <input type="number"  value="0" min="0" style="width: 5%"
                            name="masa_lama_thn" required />&nbsp;
                            <label for="">Tahun</label>&nbsp;&nbsp;&nbsp;
                            <input type="number"  value="0"min="0" style="width: 5%"
                            name="masa_lama_bln" required />&nbsp;
                            <label for="">Bulan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Masa Kerja Baru
                        </label>
                        <div class="col-sm-9">
                            <input type="number"  value="0" min="0" style="width: 5%"
                            name="masa_baru_thn" required />&nbsp;
                            <label for="">Tahun</label>&nbsp;&nbsp;&nbsp;
                            <input type="number"  value="0"min="0" style="width: 5%"
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
                                <option value="N">Tetap</option>
                                <option value="P">Kenaikan Pangkat</option>
                                <option value="J">Kenaikan Jabatan</option>
                                <option value="A">kenaikan Pangkat & Jabatan</option>
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
                                    <option value="{{$item->id}}">{{$item->golongan}} / {{$item->ruang}}</option>
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
                                <option value="{{$peg->id}}">{{$peg->nama}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group" id="tmtusul">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> TMT Golongan Baru
                        </label>
                        <div class="col-sm-9" >
                            <input type="date" class="col-xs-2 col-sm-2 required " 
                            name="tmtusul" />
                        </div>
                    </div>
                    <div class="form-group" id="tmtjabbaru">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> TMT Jabatan Baru
                        </label>
                        <div class="col-sm-9" >
                            <input type="date" class="col-xs-2 col-sm-2 required " 
                            name="tmtjabbaru" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Reset Poin
                        </label>
                        <div class="col-sm-9" >
                            <input type="checkbox" id="reset" name="reset" value="Y" onclick="respe();">&nbsp;
                            <label class="control-label" for="form-field-1"> Ya </label>
                        </div>
                    </div>
                    <div class="form-group" id="startpoin">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Start Poin
                        </label>
                        <div class="col-sm-9" >
                            <input type="number" step="0.001" min="0" class="col-xs-1 col-sm-1 required "  placeholder="0" onkeyup="reskredit()"
                            name="startpoin" id="darinol"/>&nbsp;
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">  Upload File
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><i>ex:Lorem_ipsum.pdf</i></label>
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
                            <td><input type="number" step="0.001" min="0" name="sa1" placeholder="0" value="0" id="1a1" onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%"></td>
                            <td>2. Pendidikan dan pelatihan fungsional di bidang Pengawas Farmasi dan Makanan
                                dan mendapatkan Surat Tanda Tamat Pendididikan dan Pelatihan (STTPL)
                            </td>
                            <td><input type="number" step="0.001" min="0" name="sa2" placeholder="0" id="1a2"   value="0" onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%">b.</td>
                            <td>Pengawas Farmasi dan Makanan
                            </td>
                            <td><input type="number" step="0.001" min="0" name="sb" placeholder="0" id="1b"  value="0" onkeyup=onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%">c.</td>
                            <td>Pengembangan Profesi
                            </td>
                            <td><input type="number" step="0.001" min="0" name="sc" placeholder="0" id="1c"  value="0" onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 5%"></td>
                            <td style="text-align: right">JUMLAH
                            </td>
                            <td><input type="number" step="0.001" min="0" name="jum1" placeholder="0" readonly id="jum1"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td colspan="5"><b>UNSUR PENUNJANG</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">Penunjang Tugas FPM</td>
                            <td><input type="number" step="0.001" min="0" name="da" placeholder="0" id="2a"  value="0" onkeyup="hitung(); sum()"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>JUMLAH UNSUR UTAMA DAN UNSUR PENUNJANG</b></td>
                            <td><input type="number" step="0.001" min="0" name="jumlah" placeholder="0" readonly id="jumlah"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>JUMLAH KREDIT LAMA</b></td>
                            <td><input type="number" step="0.001" min="0" name="jumlama" placeholder="0" readonly id="jumlama">
                                <input type="hidden" id="oldjum">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right"><b>TOTAL AKUMULASI KREDIT</b></td>
                            <td><input type="number" step="0.001" min="0" name="total" placeholder="0" readonly id="total"></td>
                        </tr>
                    </table>
               </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
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
            var nol = '0';
            var old = $("#oldjum").val();
            $("#darinol").val(nol);
            $("#jumlama").val(old);
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
                $("#jafung").val(response.riwayat.jafung);
                $("#karpeg").val(response.riwayat.seri_karpeg);
                

                if (response.riwayat.jl != null) {
                    $("#jumlama").val(response.riwayat.jl);
                    $("#oldjum").val(response.riwayat.jl);
                } else {
                    var c = 0;
                    $("#jumlama").val(c);
                }
                
            }
        );
    }

    function reskredit(){
        var rp = $("#darinol").val();
       

        if (document.getElementById('reset').checked==true) 
        {
            $("#jumlama").val(rp);
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
        $("#jumlah").val(y);  
    }

    function sum() {
        var y = $("#jumlah").val();
        var jumlama = $("#jumlama").val();

        var z = parseFloat(y) + parseFloat(jumlama);
        $("#total").val(z);
        
    }



   
</script>
@endsection