@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/realisasi">Realisasi Anggaran</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('realisasi.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Realisasi Anggaran</h4>
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
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kode Realisasi
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="col-xs-10 col-sm-10 required " placeholder="masukan kode POA"
                                   name="number" required />
                                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Keterangan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="col-xs-10 col-sm-10 required " placeholder="Keterangan Realisasi"
                                   name="keterangan" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Pilih Tahun *
                            </label>
                            <div class="col-sm-8">
                                <select id="tahun" name="year" class="col-xs-10 col-sm-10 select2" required  onchange="getAsal()">
                                    <option value="">Pilih Tahun</option>
                                    @php
                                        $now=date('Y');
                                        $a = $now+1;
                                        echo 
                                        "<option value='$now'>$now</option>
                                        <option value='$a'>$a</option>";
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Asal POK
                            </label>
                            <div class="col-sm-8">
                                <select id="asalpok" name="asalpok" class="col-xs-10 col-sm-10 select2"  
                                    required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Kode Kegiatan *
                            </label>
                            <div class="col-sm-8">
                                <select id="activitycode_id" name="activitycode_id" class="col-xs-10 col-sm-10 select2" 
                                onchange="getKomponen()" required>
                                        <option value="">Pilih Kode</option>
                                    @foreach ($act as $data)
                                        <option value="{{$data->id}}">{{$data->code}} || {{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Kode Sub Komponen *
                            </label>
                            <div class="col-sm-8">
                                <select id="subcode_id" name="subcode_id" class="col-xs-10 col-sm-10 select2" onchange="getAkunId()">
                                    <option value="">Pilih Kode</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Kode Akun *
                            </label>
                            <div class="col-sm-8">
                                <select id="akuncode_id" name="accountcode_id" class="col-xs-10 col-sm-10 select2" onchange="getLokasi()">
                                    <option value="">Pilih Kode</option>
                                    {{-- getakun --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Lokasi *
                            </label>
                            <div class="col-sm-8">
                                <select id="loka_id" name="loka_id" class="col-xs-10 col-sm-10 select2" onchange="getNilai()">
                                        <option value="">Pilih Lokasi</option>
                                        {{-- getloka --}}
                                </select>
                            </div>
                        </div>
                    </fieldset>        
               </div>
           </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Realisasi Anggaran </h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                <fieldset>
                    <div class="col-sm-6" id="plus">
                        <br>
                        <table id="TabelBulan">
                            <thead>
                                <tr>
                                    <th class="text-left col-md-2">Bulan</th>
                                    <th class="text-left col-md-2">Minggu</th>
                                    <th class="text-left col-md-3">Biaya</th>
                                    <th class="text-center col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" id="countRow" value="1">
                                <tr id="cell-1">
                                    <td>
                                        <select id="bulan-1" name="month[]" class="form-control select2" required style="width: 90%">
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
                                    </td>
                                    <td>
                                        <select name="week[]" id="minggu-1">
                                            <option value="1">minggu 1</option>
                                            <option value="2">minggu 2</option>
                                            <option value="3">minggu 3</option>
                                            <option value="4">minggu 4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="biaya[]" class="form-control hitung" min="0" value="0" style="width: 90%"
                                        onkeyup="hitung()" id="biaya-1">
                                    </td>
                                    <td>
                                        <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                        <i class="glyphicon glyphicon-plus"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Anggaran
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="col-xs-10 col-sm-10 required " readonly value="0"
                                   name="asaluang" required  id="asaluang"/>
                                   <input type="hidden" name="pok_detail_id" id=pok_detail_id>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  realisasi
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="col-xs-10 col-sm-10 required " readonly value="0"
                                 id="realisasi"  name="asal" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Balance
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="col-xs-10 col-sm-10 required " value="0"
                                  id="balance" name="balance" required readonly/>
                            </div>
                        </div>
                        </select>

                    </div>
                </fieldset>    
               </div>
           </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit" id="simpan">
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
        document.getElementById("simpan").disabled = true;
    } );

    function getAsal(){
         var activitycode_id = $("#activitycode_id").val();
         var year = $("#tahun").val();
        $.get(
            "{{route('realisasi.getAsal') }}",
            {
                year:year,
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih</option>";
                $.each(data, function(index, value) {
                    string = string + '<option value="'+ value.id +'">'+ value.asal_pok +'</option>';
                })
               $("#asalpok").html(string);
            }
        );
    }

    function getKomponen(){
         var activitycode_id = $("#activitycode_id").val();
         var pok_id = $("#asalpok").val();
        $.get(
            "{{route('realisasi.getKomponen') }}",
            {
                pok_id:pok_id,
                activitycode_id: activitycode_id
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih Kode</option>";
                $.each(data, function(index, value) {
                    string = string + '<option value="'+ value.subcode_id +'">'+ value.kro +'-'+value.ro +'-'+value.kom +'-'+value.sub+'</option>';
                })
               $("#subcode_id").html(string);
            }
        );
    }

    function getAkunId(){
         var activitycode_id = $("#activitycode_id").val();
         var pok_id = $("#asalpok").val();
         var subcode_id = $("#subcode_id").val();
        $.get(
            "{{route('realisasi.getAkunId') }}",
            {
                pok_id:pok_id,
                activitycode_id:activitycode_id,
                subcode_id:subcode_id
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih Kode</option>";
                $.each(data, function(index, value) {
                    string = string + '<option value="'+ value.id +'">'+ value.code +'('+value.name +')</option>';
                })
               $("#akuncode_id").html(string);
            }
        );
    }

    function getLokasi(){
        var pok_id = $("#asalpok").val();
         var subcode_id = $("#subcode_id").val();
         var accountcode_id = $("#akuncode_id").val();
        $.get(
            "{{route('realisasi.getLokasi') }}",
            {
                pok_id:pok_id,
                accountcode_id:accountcode_id,
                subcode_id:subcode_id
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih Lokasi</option>";
                $.each(data, function(index, value) {
                    string = string + '<option value="'+ value.id +'">'+ value.nama +'</option>';
                })
               $("#loka_id").html(string);
            }
        );
    }

    function getNilai(){
        var pok_id = $("#asalpok").val();
        var subcode_id = $("#subcode_id").val();
        var accountcode_id = $("#akuncode_id").val();
        var loka_id = $("#loka_id").val();
        $.get(
            "{{route('realisasi.getNilai') }}",
            {
                pok_id:pok_id,
                accountcode_id:accountcode_id,
                subcode_id:subcode_id,
                loka_id:loka_id
            },
            function(response) {
                var id = response.data.id
                var nilai = response.data.total

                $("#asaluang").val(nilai);
                $("#pok_detail_id").val(id);
            }
        );
    }

    function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi =  '<tr id="cell-'+new_baris+'">'+
                '<td>'+
                    '<select id="bulan-'+new_baris+'" name="month[]" class="form-control select2" required style="width: 90%">'+
                        '<option value="1">Januari</option>'+
                        '<option value="2">Februari</option>'+
                        '<option value="3">Maret</option>'+
                        '<option value="4">April</option>'+
                        '<option value="5">Mei</option>'+
                        '<option value="6">Juni</option>'+
                        '<option value="7">Juli</option>'+
                        '<option value="8">Agustus</option>'+
                        '<option value="9">September</option>'+
                        '<option value="10">Oktober</option>'+
                        '<option value="11">November</option>'+
                        '<option value="12">Desember</option>'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<select name="week[]" id="minggu-1">'+                  
                        '<option value="1">minggu 1</option>'+                   
                        '<option value="2">minggu 2</option>'+                   
                        '<option value="3">minggu 3</option>'+                    
                        '<option value="4">minggu 4</option>'+                    
                    '</select>'+                    
                '</td>'+
                '<td>'+
                    '<input type="number" name="biaya[]" class="form-control hitung" min="0" value="0" style="width: 90%" onkeyup="hitung()" id="biaya-'+new_baris+'">'+                          
                '</td>'+                       
                '<td>' +                      
                    // '<button type="button" class="form-control btn-default" onclick="addBarisNew()"><i class="glyphicon glyphicon-plus"></i></button>'+
                    '<button type="button" class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button>'+
                '</td>'+
            '</tr>';
        $("#TabelBulan").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
       }
    
       function deleteRow(cell) {
            $("#cell-"+cell).remove();
            this.hitung();

        }

        function hitung() {
            var isi = $("#asaluang").val();
            var sum = 0;
            $('.hitung').each(function(){
                sum += parseFloat(this.value);
            });
            $("#realisasi").val(sum);

            var s= isi - sum;
            $("#balance").val(s);
            
            var balance = $("#balance").val();
            if (balance !=0) {
                document.getElementById("simpan").disabled = true;
            } else {
                document.getElementById("simpan").disabled = false;
            }

        }





</script>
@endsection