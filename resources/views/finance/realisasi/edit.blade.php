@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/realisasi">Realisasi Anggaran</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/finance/realisasi/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Realisasi Anggaran</h4>
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
                                   name="number" required readonly value="{{$data->number}}"/>
                                <input type="hidden" name="users_id" value="{{$data->users_id}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Keterangan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="col-xs-10 col-sm-10 required " placeholder="Keterangan Realisasi"
                                   name="keterangan" required value="{{$data->keterangan}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Pilih Tahun *
                            </label>
                            <div class="col-sm-8">
                                <select id="tahun" name="year" class="col-xs-10 col-sm-10 select2" required  onchange="getAsal()">
                                    @php
                                        $now=date('Y');
                                        $a = $now+1;
                                        if($a==$data->year){ 
                                                $pilih="selected";
                                            }else {
                                                $pilih="";
                                            }
                                        echo 
                                        "<option value=\"$now\" $pilih>$now</option>
                                        <option value=\"$a\" $pilih>$a</option>";
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
                            for="form-field-1">  Kode Anggaran *
                            </label>
                            <div class="col-sm-8">
                                <select name="pok_detail_id"  class="col-xs-10 col-sm-10 select2" id="pok_detail_id">
                                    <option value="">Kode Anggaran</option>
                                       {{-- getAgg --}}
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
                                @php
                                    $noRow = 1;
                                @endphp
                                @foreach ($detail as $item)
                                <tr id="cell-{{$noRow}}">
                                    <td>
                                        <select id="bulan-1" name="month[]" class="form-control select2" required style="width: 90%">
                                            @php
                                                $bulan2 = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                                            "September", "Oktober", "November", "Desember");
                                                for($a=1;$a<=12;$a++){
                                                    if($a == $item->month){ 
                                                        $pilih="selected";
                                                    }else {
                                                        $pilih="";
                                                    }
                                                    echo("<option value=\"$a\" $pilih>$bulan2[$a]</option>"."\n");
                                                }
                                            @endphp
                                        </select>
                                    </td>
                                    <td>
                                        <select name="week[]" id="minggu-1">
                                            @if ($item->week == 1)
                                                <option value="1" selected>minggu 1</option>
                                                <option value="2">minggu 2</option>
                                                <option value="3">minggu 3</option>
                                                <option value="4">minggu 4</option>
                                            @elseif ($item->week == 2)
                                                <option value="1" >minggu 1</option>
                                                <option value="2" selected>minggu 2</option>
                                                <option value="3">minggu 3</option>
                                                <option value="4">minggu 4</option>
                                            @elseif ($item->week == 3)
                                                <option value="1">minggu 1</option>
                                                <option value="2">minggu 2</option>
                                                <option value="3" selected>minggu 3</option>
                                                <option value="4">minggu 4</option>
                                            @else
                                                <option value="1">minggu 1</option>
                                                <option value="2">minggu 2</option>
                                                <option value="3">minggu 3</option>
                                                <option value="4" selected>minggu 4</option>
                                                
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="biaya[]" class="form-control hitung" min="0" style="width: 90%"
                                        onkeyup="hitung()" id="biaya-1" value="{{$item->biaya}}">
                                    </td>
                                    <td>
                                        @if ($noRow==1)
                                            <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                            <i class="glyphicon glyphicon-plus"></i></button>
                                        @else 
                                            <button type="button" class="btn btn-danger"
                                             onclick="deleteRow({{$noRow}})"><i class="glyphicon glyphicon-trash"></i>
                                            </button>

                                        @endif
                                       
                                    </td>
                                </tr>
                                @php
                                    $noRow ++
                                @endphp
                                @endforeach
                                <input type="hidden" id="countRow" value="{{$noRow-1}}">

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
                                <input type="number" class="col-xs-10 col-sm-10 required " readonly value="{{$total}}"
                                   name="asaluang" required  id="asaluang"/>
                                   <input type="hidden" name="pok_detail_id" id=pok_detail_id value="{{$pok_detail_id}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  realisasi
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="col-xs-10 col-sm-10 required " readonly 
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
        document.getElementById("simpan").disabled = false;

        var sum = 0;
        $('.hitung').each(function(){
            sum += parseFloat(this.value);
        });
        $("#realisasi").val(sum);
        getAsal();

    } );

    function getAsal(){
         var year = $("#tahun").val();
        $.get(
            "{{route('realisasi.getAsal') }}",
            {
                year:year
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih</option>";
                $.each(data, function(index, value) {
                    var idasal = "<?php echo $sub['asalpok'] ?>";
                    if(value.id  == idasal){
                        string = string + '<option value="'+ value.id +'" selected>'+ value.asal_pok +' ( '+value.act+' )</option>';
                    }else{
                        string = string + '<option value="'+ value.id +'">'+ value.asal_pok +' ( '+value.act+' )</option>';
                   }
                })
               $("#asalpok").html(string);
               getKomponen();
            }
        );
    }

    function getKomponen(){
         var pok_id = $("#asalpok").val();

        $.get(
            "{{route('realisasi.getKomponen') }}",
            {
                pok_id:pok_id
            },
            function(response) {
                var data = response.data;

                var string ="<option value=''>Pilih Kode Anggaran</option>";
                $.each(data, function(index, value) {
                    var idasal = "<?php echo $pok_detail_id ?>";
                    if(value.id  == idasal){
                        string = string + '<option value="'+ value.id +'" selected>'+ value.act +'/'+value.sub +'/'+value.akun+' ( '+value.nama+' )'+
                        '</option>';
                    }else{
                        string = string + '<option value="'+ value.id +'">'+ value.act +'/'+value.sub +'/'+value.akun+' ( '+value.nama+' )'+
                        '</option>';
                    }
                })
                $("#pok_detail_id").html(string);
                getNilai();
            }
        );
    }

    function getNilai() {  
        var pok_detail_id = $('#pok_detail_id').val();

        $.get(
            "{{route('realisasi.getNilai') }}",
            {
                pok_detail_id:pok_detail_id
            },
            function(response) {
		        var id = response.data.id;
		        var nilai = response.data.total;

		        $("#asaluang").val(nilai);
		        $("#id_pok_detail").val(id);
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
                '<td>'+                        
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