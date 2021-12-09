@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/revision">POK</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" id="form_id"
         method="post" action="{{route('revision.impor')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">POK Revisi</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Kode Kegiatan *
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="nama" class="col-xs-10 col-sm-10" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">  Kode Kegiatan *
                            </label>
                            <div class="col-sm-8">
                                <select id="activitycode_id" name="activitycode_id" class="col-xs-10 col-sm-10 select2" required>
                                        <option value="">Pilih Kode</option>
                                    @foreach ($act as $data)
                                        <option value="{{$data->id}}">{{$data->prog->code}} - {{$data->code}} || {{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tahun Pelaksanaan *
                            </label>
                            <div class="col-sm-8">
                                <select id="tahun" name="year" class="col-xs-10 col-sm-10 select2" required>
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
                            for="form-field-1"> Nama Pegawai
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                                <input type="text" name="users_name" class="col-xs-10 col-sm-10" readonly
                                value="{{auth()->user()->name}}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis POK
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" required value="AWAL" checked onclick="respe();"
                                name="jenis" id="A"/> &nbsp; Awal &nbsp;
                                <input type="radio" required value="REVISI" onclick="respe();"
                                name="jenis" id="R"/> &nbsp; Revisi
                            </div>
                        </div>
                        <div class="form-group" id="revke">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> POK Revisi Ke-
                            </label>
                            <div class="col-sm-8">
                                <input type="number" name="revisi" class="col-xs-2 col-sm-2" min="0" value="0" required/>
                            </div>
                        </div>
                        <div class="form-group" id="asalasal">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Asal
                            </label>
                            <div class="col-sm-8" >
                                <select name="asal"  class="col-xs-10 col-sm-10">
                                    <option value="DIPA">DIPA</option>
                                    <option value="SATKER">SATKER</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="kodeasal">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kode Asal
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="kode_asal" class="col-xs-2 col-sm-2" value="0" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">DATA POK</h3></div>
                <div class="panel-body">
                   <div class="col-md-12">
    
                    <button type="button"  class="btn btn-danger" onclick="myFunction()" id="aut">
                        <i class="ace-icon fa fa-check bigger-110"></i>Import From Excel</button>
                    <button type="button"  class="btn btn-danger" onclick="getAsn()" id="man">
                        <i class="ace-icon fa fa-check bigger-110"></i>Manual</button>
                    
    
                    <br><br>
                    <div id="manual">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <th class="text-center">NO</th>
                                <th class="text-center col-md-3">Subkomponen</th>
                                <th class="text-center col-md-2">Akun</th>
                                <th class="text-center col-md-1">Volume</th>
                                <th class="text-center col-md-2">Harga</th>
                                <th class="text-center col-md-2">Total</th>
                                <th class="text-center col-md-1">Sumber</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody id="isi">
                                <tr  id="cell-1">
                                    <td class="center">1</td>
                                    <td>
                                        <select id="subcode_id" name="subcode_id[]" class="select2 form-control">
                                            <option value="">Pilih Kode</option>
                                            @foreach ($sub as $data)
                                                <option value="{{$data->id}}">{{$data->kodeall}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select id="accountcode_id" name="accountcode_id[]" class="select2 form-control">
                                            <option value="">Pilih Kode</option>
                                            @foreach ($acc as $data)
                                                <option value="{{$data->id}}">{{$data->code}} - {{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" name="loka_id[]" value="1">
                                        <input type="number" name="volume[]" id="volume-1" value="0" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" name="price[]" id="price-1"  value="0" class="form-control" onkeyup="hitung(1)">
                                    </td>
                                    <td>
                                        <input type="number" name="total[]" id="total-1"  value="0" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <select id="sd" name="sd[]" class="select2 form-control">
                                            <option value="RM">RM</option>
                                            <option value="PNBP">PNBP</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <span id="row-new"></span>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        <input type="hidden" id="countRow" value="1">
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>
                    </div>
                    <br>
                    <div id="auto">
                        <input type="file" name="diimpor" class="btn btn-default btn-sm" id="" value="Upload File">
                    </div>
                   </div>
                </div>
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
</form>

@endsection
@section('footer')
<script>
    $().ready( function () {
        $("#revke").hide();
        $("#asalasal").hide();
        $("#kodeasal").hide();
        $("#manual").hide();
        myFunction();
    } );


    function respe(){
        if (document.getElementById('R').checked) 
        {
            $("#revke").show();
            $("#asalasal").show();
            $("#kodeasal").show();
        } else if(document.getElementById('A').checked) {
            $("#revke").hide();
            $("#asalasal").hide();
            $("#kodeasal").hide();
            var c = 0;
            $("#revke").val(c);
            $("#kodeasal").val(c);
        }
    }

    function myFunction() {
        document.getElementById("aut").classList.remove('btn-danger');  
        document.getElementById("aut").classList.add('btn-success');

        document.getElementById("man").classList.remove('btn-success');
        document.getElementById("man").classList.add('btn-danger');
        
        document.getElementById("form_id").action = "{{route('revision.impor')}}";

        $("#manual").hide();
        $("#auto").show()
             
    }

    function getAsn(){
        document.getElementById("man").classList.remove('btn-danger');  
        document.getElementById("man").classList.add('btn-success');
        document.getElementById("aut").classList.remove('btn-success');
        document.getElementById("aut").classList.add('btn-danger');
        document.getElementById("form_id").action = "{{route('revision.store')}}";

        $("#manual").show();
        $("#auto").hide()
    }

    function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi =  '<tr id="cell-'+new_baris+'">'+
            '<td class="center">'+new_baris+'</td>'+
            '<td>'+
                '<select id="subcode_id" name="subcode_id[]" class="select2 form-control">'+
                    '<option value="">Pilih Kode</option>'+
                        '@foreach ($sub as $data)'+
                            '<option value="{{$data->id}}">{{$data->kodeall}}</option>'+
                        '@endforeach'+
                '</select>'+
            '</td>'+
            '<td>'+
                '<select id="accountcode_id" name="accountcode_id[]" class="select2 form-control">'+
                    '<option value="">Pilih Kode</option>'+
                        '@foreach ($acc as $data)'+
                            '<option value="{{$data->id}}">{{$data->code}} - {{$data->name}}</option>'+
                        '@endforeach'+
                '</select>'+
            '</td>'+
            '<td>'+
                '<input type="hidden" name="loka_id[]" value="1">'+
                '<input type="number" name="volume[]" id="volume-'+new_baris+'" value="0" class="form-control">'+
            '</td>'+
            '<td>'+
                '<input type="number" name="price[]" id="price-'+new_baris+'"  value="0" class="form-control" onkeyup="hitung('+new_baris+')">'+                        
            '</td>'+
            '<td>'+
                '<input type="number" name="total[]" id="total-'+new_baris+'"  value="0" class="form-control" readonly>'+
            '</td>'+
            '<td>'+
                '<select id="sd" name="sd[]" class="select2 form-control">'+
                    '<option value="RM">RM</option>'+
                    '<option value="PNBP">PNBP</option>'+
                '</select>'+
            '</td>'+   
                '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
            '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();

       }

    function hitung(i) {
        var a = $("#volume-"+i).val();
        var b =  $("#price-"+i).val();
        var c = a * b;
        var hasil = parseFloat(c).toFixed(2);
        $("#total-"+i).val(hasil);
    }

    function deleteRow(cell) {
        $("#cell-"+cell).remove();
    }

</script>
@endsection
