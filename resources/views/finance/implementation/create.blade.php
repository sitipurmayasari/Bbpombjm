@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/implementation">Pelaksanaan Anggaran</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('implementation.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pelaksanaan Anggaran</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label > Kode Kegiatan *</label>
                            <select id="peg" name="activitycode_id" class="col-xs-10 col-sm-10 select2" required>
                                    <option value="">Pilih Kode</option>
                                @foreach ($act as $data)
                                    <option value="{{$data->id}}">{{$data->code}} || {{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label > Bulan Pelaksanaan</label>
                            <select id="bulan" name="month" class="col-xs-10 col-sm-10 select2" required>
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
                        <div class="col-md-12">
                            <label > Tahun Pelaksanaan</label>
                            <select id="tahun" name="year" class="col-xs-10 col-sm-10" required>
                                @php
                                    $now=date('Y');
                                    $a = $now+1;
                                    echo 
                                    "<option value='$now'>$now</option>
                                    <option value='$a'>$a</option>";
                                @endphp
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label> Nama Pegawai</label><br>
                            <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            <input type="text" name="users_name" class="col-xs-10 col-sm-10" readonly
                            value="{{auth()->user()->name}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label > Kode Kelompok Rincian Output *</label>
                            <select id="kro" name="krocode_id" class="col-xs-10 col-sm-10 select2" required onchange="getRO()">
                                    <option value="">Pilih Kode</option>
                                @foreach ($kro as $data)
                                    <option value="{{$data->id}}">{{$data->code}} || {{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label > Kode Rincian Output *</label>
                            <select id="ro" name="detailcode_id" class="col-xs-10 col-sm-10 select2" required onchange="getKomponen()">
                                    <option value="">Pilih Kode</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label > Kode Komponen *</label>
                            <select id="kom" name="komponencode_id" class="col-xs-10 col-sm-10 select2" required onchange="getSubkom()">
                                    <option value="">Pilih Kode</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label > Kode SubKomponen *</label>
                            <select id="sub" name="subcode_id" class="col-xs-10 col-sm-10 select2" required>
                                    <option value="">Pilih Kode</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Detail Anggaran</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <th class="text-left" style="width: 40px;">NO</th>
                                <th class="text-center col-md-3">Kode Akun</th>
                                <th class="text-center col-md-3">Lokasi</th>
                                <th class="text-center">Volume</th>
                                <th class="text-center col-md-2">Harga Satuan</th>
                                <th class="text-center col-md-2">Jumlah Biaya</th>
                                <th class="text-center">Sumber Dana</th>
                                <th class="text-center">Aksi</th>
                            </thead>
                            <tbody>
                                <tr id="cell-1">
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        <select name="accountcode_id[]" class="col-xs-12 col-sm-12 select2" required>
                                            <option value="">-Pilih-</option>
                                            @foreach ($akun as $item)
                                                <option value="{{$item->id}}">{{$item->code}} | {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="loka_id[]" class="col-xs-12 col-sm-12 select2" required>
                                            <option value="">-Pilih-</option>
                                            @foreach ($loka as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="volume[]" step="0.1" class="form-control" id="volume-1" value="0" onchange="hitung()">
                                    </td>
                                    <td>
                                        <input type="text" name="price[]"  class="form-control" id="price-1" value="0" onchange="hitung()">
                                    </td>
                                    <td>
                                        <input type="number" name="total[]" class="form-control" id="total-1" readonly value="0">
                                    </td>
                                    <td>
                                        <select name="sd[]" class="form-control" required>
                                            <option value="RM"> RM </option>
                                            <option value="PNBP"> PNBP </option>
                                        </select>
                                    </td>
                                    <td>
                                        {{-- <button type="button"  class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button> --}}
                                    </td>
                                </tr>
                                <span id="row-new"></span>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH DATA</button>
                                        <input type="hidden" id="countRow" value="1">
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>
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
    function getRO(){
         var kro_id = $("#kro").val();
        $.get(
            "{{route('detailcode.getRO') }}",
            {
                kro_id: kro_id
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih Rincian Output</option>";
                $.each(data, function(index, value) {
                    string = string + `<option value="` + value.id + `">` + value.code+ '|| ' +value.name + `</option>`;
                })
               $("#ro").html(string);
            }
        );
    }

    function getKomponen(){
         var detailcode_id = $("#kro").val();
        $.get(
            "{{route('komponencode.getKomponen') }}",
            {
                detailcode_id: detailcode_id
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih Komponen</option>";
                $.each(data, function(index, value) {
                    string = string + `<option value="` + value.id + `">` + value.code+ '|| ' +value.name + `</option>`;
                })
               $("#kom").html(string);
            }
        );
    }

    function getSubkom(){
         var komponencode_id = $("#kom").val();
        $.get(
            "{{route('subcode.getSubkom') }}",
            {
                komponencode_id: komponencode_id
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih SubKomponen</option>";
                $.each(data, function(index, value) {
                    string = string + `<option value="` + value.id + `">` + value.code+ '|| ' +value.name + `</option>`;
                })
               $("#sub").html(string);
            }
        );
    }

    function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi =  '<tr id="cell-'+new_baris+'">'+
            '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<select name="accountcode_id[]"  class="col-xs-12 col-sm-12 select2" required>'+
                        '<option value="">-Pilih-</option>'+
                        '@foreach ($akun as $item)'+
                            '<option value="{{$item->id}}">{{$item->code}} | {{$item->name}}</option>'+
                        '@endforeach'+
                    '</td>'+
                    '<td>'+
                        '<select name="loka_id[]" class="col-xs-12 col-sm-12 select2" required>'+
                            '<option value="">-Pilih-</option>'+
                            '@foreach ($loka as $item)'+
                                '<option value="{{$item->id}}">{{$item->nama}}</option>'+
                            '@endforeach'+
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" name="volume[]" value="0" step="0.1" class="form-control" id="volume-'+new_baris+'" onchange="hitung2('+new_baris+')">'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" name="price[]" value="0" class="form-control" id="price-'+new_baris+'" onchange="hitung2('+new_baris+')">'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" name="total[]" value="0" class="form-control" id="total-'+new_baris+'" readonly onchange="hitung2('+new_baris+')">'+
                    '</td>'+
                    '<td>'+
                        '<select name="sd[]" class="form-control" required>'+
                            '<option value="RM"> RM </option>' +
                            '<option value="PNBP"> PNBP </option>'+
                        '</select>'+
                    '</td>'+
                    '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
       }

    function hitung() {
        var a = $("#volume-1").val();
        var b =  $("#price-1").val();
        var c = a * parseFloat(b);
        var t = parseFloat(c).toFixed(2);
        $("#total-1").val(t);
    }

    function hitung2(i) {
        var a = $("#volume-"+i).val();
        var b =  $("#price-"+i).val();
        var c = a * b;
        var t = parseFloat(c).toFixed(2);
        $("#total-"+i).val(t);
    }


       function deleteRow(cell) {
            $("#cell-"+cell).remove();
            this.hitungTotal();

        }
</script>
@endsection
