@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>skp</li>
    <li><a href="/amdk/planning">Kegiatan Perencanaan</a></li>
    <li>Input Perencanaan</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
            method="post" action="{{route('planning.store')}}" enctype="multipart/form-data"   >
        {{ csrf_field() }}
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Input Perencanaan</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Nama*</label><br>
                            <input type="text" readonly class="col-xs-10 col-sm-10 " 
                            name="users_name" value="{{auth()->user()->name}}"/>
                            <input type="hidden" name="users_id" value="{{auth()->user()->id}}"/>
                        </div>
                        <div class="col-md-12">
                            <label> Jabatan</label><br>
                            <input type="text" readonly class="col-xs-10 col-sm-10 " 
                            name="jabatan" value="{{$jab->nama}}"/>
                            <input type="hidden" name="jabasn" id="jabasn"  value="{{$jab->jabatan}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Tanggal *</label><br>
                            <input type="date" required value="{{date('Y-m-d')}}"
                            class="col-xs-10 col-sm-10 required " name="plan_date"/>
                        </div>
                        <div class="col-md-12">
                            <label> SKP *</label><br>
                            <select id="skp" name="skp_id" class="col-xs-10 col-sm-10 select2" required onchange="getkelompok()">
                                <option value="">pilih SKP</option>
                                @foreach ($skp as $lok)
                                    <option value="{{$lok->id}}">{{tgl_indo($lok->dates)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>         
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Sasaran</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center col-md-3">Rencana Kinerja Utama</th>
                            <th class="text-center col-md-3">Butir Kegiatan</th>
                            <th class="text-center col-md-1">Kode Butir</th>
                            <th class="text-center col-md-3">keluaran Kegiatan</th>
                            <th class="text-center col-md-1">pelaksana</th>
                            <th class="text-center col-md-1">AK</th>
                            <th class="text-center col-md-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td class=>
                                1
                            </td>
                            <td>
                                <input type="date" required value="{{date('Y-m-d')}}"  class="form-control" name="kin_date[]"/>
                            </td>
                            <td>
                                <select name="skp_detail_id[]" id="uraian" class="form-control select2 rencana1">
                                  <option value="">Pilih Rencana</option>
                                </select>
                            </td>
                            <td>
                                <select name="setup_ak_id[]" class="form-control select2" id="setup_id-1"  onchange="getnilai1()">
                                    <option value="">Pilih Kegiatan</option>
                                    @foreach ($ak as $item)
                                        <option value="{{$item->id}}">{{$item->kode_ak}}-{{$item->uraian}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" readonly class="form-control" id="butir1" name="butir[]"></td>
                            <td><input type="text" readonly class="form-control" id="keluaran1" name="keluaran[]"></td>
                            <td><input type="text" readonly class="form-control" id="pelaksana1" name="pelaksana[]"></td>
                            <td><input type="text" readonly class="form-control" id="ak-1" name="nilai_ak[]"></td>
                            <td></td>
                        
                        </tr>
                        <span id="row-new"></span>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                <input type="hidden" id="countRow" value="1">
                            </td>
                        </tr>
                        
                    </tfoot>
                </table>
               </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
</div>
</form>
@endsection
@section('footer')
<script>
    function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi ='<tr id="cell-'+new_baris+'">'+
                    '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<input type="date" id="dates" value="{{date("Y-m-d")}}" class="form-control" name="kin_date[]"/>'+        
                    '</td>'+        
                    '<td>'+
                        '<select name="skp_detail_id[]" id="uraian-'+new_baris+'" class="form-control select2">'+        
                            '<option value="">Pilih Rencana</option>'+
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<select name="setup_ak_id[]" class="form-control select2" id="setup_id-'+new_baris+'"  onchange="getnilainext('+new_baris+')">'+
                            '<option value="">Pilih Kegiatan</option>'+
                            '@foreach ($ak as $item)'+
                                '<option value="{{$item->id}}">{{$item->kode_ak}}-{{$item->uraian}}</option>'+
                            '@endforeach'+        
                        '</select>'+
                    '</td>'+
                    '<td><input type="text" readonly class="form-control" id="butir-'+new_baris+'" name="butir[]"></td>'+
                    '<td><input type="text" readonly class="form-control" id="keluaran-'+new_baris+'" name="keluaran[]"></td>'+
                    '<td><input type="text" readonly class="form-control" id="pelaksana-'+new_baris+'" name="pelaksana[]"></td>'+
                    '<td><input type="text" readonly class="form-control" id="ak-'+new_baris+'" name="nilai_ak[]"></td>'+          
                    '<td><button type="button" class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
        getkelompoknext(new_baris);
    }

    function deleteRow(cell) {
        $("#cell-"+cell).remove();
        this.hitungTotal();
    }

    function getkelompok(){
        var skp_id = $("#skp").val();

        $.get(
            "{{route('skp.getdata') }}",
            {
            skp_id: skp_id
            },
            function(response) {
                var data2 = response.data;
                var string ="<option value=''>Pilih Rencana</option>";
                    $.each(data2, function(index, value) {
                        string = string + '<option value="'+ value.id +'">'+ value.activity +'</option>';
                    })
                $(".rencana1").html(string);
            }
        );
    }

    function getkelompoknext(i){
        var skp_id = $("#skp").val();

        $.get(
            "{{route('skp.getdata') }}",
            {
            skp_id: skp_id
            },
            function(response) {
                var data2 = response.data;
                var string ="<option value=''>Pilih Rencana</option>";
                    $.each(data2, function(index, value) {
                        string = string + '<option value="'+ value.id +'">'+ value.activity +'</option>';
                    })
                $("#uraian-"+i).html(string);
            }
        );
    }

    
    function getnilai1(){
        var setup_id = $("#setup_id-1").val();
        var jabasn = $("#jabasn").val();

        $.get(
            "{{route('ak.getnilai') }}",
            {
                setup_id: setup_id
            },
            function(response) {

                if (jabasn == 'Ahli Pertama') {
                     ak = response.data.pertama;
                }else if (jabasn == 'Ahli Muda') {
                     ak = response.data.muda;
                }else if (jabasn == 'Ahli Madya') {
                     ak = response.data.madya;
                } else {
                     ak = response.data.utama;
                }

                document.getElementById("butir1").value = response.data.kode_ak;
                $("#keluaran1").val(response.data.uraian);
                $("#pelaksana1").val(response.data.hasil);
                $("#ak-1").val(ak);
            }
        );
    }

    function getnilainext(i){
        var setup_id = $("#setup_id-1").val();
        var jabasn = $("#jabasn").val();

        $.get(
            "{{route('ak.getnilai') }}",
            {
                setup_id: setup_id
            },
            function(response) {

                if (jabasn == 'Ahli Pertama') {
                     ak = response.data.pertama;
                }else if (jabasn == 'Ahli Muda') {
                     ak = response.data.muda;
                }else if (jabasn == 'Ahli Madya') {
                     ak = response.data.madya;
                } else {
                     ak = response.data.utama;
                }

                document.getElementById("butir-"+i).value = response.data.kode_ak;
                $("#keluaran-"+i).val(response.data.uraian);
                $("#pelaksana-"+i).val(response.data.hasil);
                $("#ak-"+i).val(ak);
            }
        );
    }
</script>
@endsection
