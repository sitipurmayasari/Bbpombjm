@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/implementation">Pelaksanaan Anggaran</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
                method="post" action="/finance/implementation/update/{{$data->id}}" enctype="multipart/form-data"   >       
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
                                @foreach ($act as $row)
                                    @if ($data->activitycode_id==$row->id)
                                        <option value="{{$row->id}}" selected>{{$row->code}} || {{$row->name}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->code}} || {{$row->name}}</option>
                                    @endif
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
                                if($a==$data->month){ 
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
                        <div class="col-md-12">
                            <label> Nama Pegawai</label><br>
                            <input type="text" name="users_name" class="col-xs-10 col-sm-10" readonly
                            value="{{$data->pegawai->name}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label > Kode Kelompok Rincian Output *</label>
                            <select id="kro" name="krocode_id" class="col-xs-10 col-sm-10 select2" required onchange="getRO()">
                                    <option value="">Pilih Kode</option>
                                @foreach ($kro as $row)
                                @if ($data->krocode_id==$row->id)
                                    <option value="{{$row->id}}" selected>{{$row->code}} || {{$row->name}}</option>
                                @else
                                    <option value="{{$row->id}}">{{$row->code}} || {{$row->name}}</option>
                                @endif
                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label > Kode Rincian Output *</label>
                            <select id="ro" name="detailcode_id" class="col-xs-10 col-sm-10 select2" required onchange="getKomponen()">
                                    <option value="">Pilih Kode</option>
                                    @foreach ($det as $row)
                                        @if ($data->detailcode_id==$row->id)
                                            <option value="{{$row->id}}" selected>{{$row->code}} || {{$row->name}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->code}} || {{$row->name}}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label > Kode Komponen *</label>
                            <select id="kom" name="komponencode_id" class="col-xs-10 col-sm-10 select2" required onchange="getSubkom()">
                                    <option value="">Pilih Kode</option>
                                    @foreach ($kom as $row)
                                        @if ($data->komponencode_id==$row->id)
                                            <option value="{{$row->id}}" selected>{{$row->code}} || {{$row->name}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->code}} || {{$row->name}}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label > Kode SubKomponen *</label>
                            <select id="sub" name="subcode_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">Pilih Kode</option>
                                @foreach ($sub as $row)
                                    @if ($data->subcode_id==$row->id)
                                        <option value="{{$row->id}}" selected>{{$row->code}} || {{$row->name}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->code}} || {{$row->name}}</option>
                                    @endif
                                @endforeach
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
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($detail as $item)
                                    <td>{{$no}}</td>
                                    <td>
                                        <select name="accountcode_id[]" class="col-xs-12 col-sm-12 select2" required>
                                            <option value="">-Pilih-</option>
                                            @foreach ($akun as $ak)
                                                @if ($item->accountcode_id==$ak->id)
                                                    <option value="{{$ak->id}}" selected>{{$ak->code}} | {{$ak->name}}</option>
                                                @else
                                                    <option value="{{$ak->id}}">{{$ak->code}} | {{$ak->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="loka_id[]" class="col-xs-12 col-sm-12 select2" required>
                                            <option value="">-Pilih-</option>
                                            @foreach ($loka as $lok)
                                                @if ($item->loka_id==$lok->id)
                                                    <option value="{{$lok->id}}" selected>{{$lok->nama}}</option>
                                                @else
                                                    <option value="{{$lok->id}}">{{$lok->nama}}</option>
                                                @endif
                                                
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="volume[]" step="0.1" class="form-control" id="volume-{{$no}}" 
                                        value="{{$item->volume}}" onkeyup="hitung({{$no}})">
                                    </td>
                                    <td>
                                        <input type="text" name="price[]"  class="form-control" id="price-{{$no}}" 
                                        value="{{$item->price}}" onkeyup="hitung({{$no}})">
                                    </td>
                                    <td>
                                        <input type="number" name="total[]" class="form-control" id="total-{{$no}}" 
                                        readonly value="{{$item->total}}">
                                    </td>
                                    <td>
                                        <select name="sd[]" class="form-control" required>
                                            @if ($item->sd=='RM')
                                                <option value="RM" selected> RM </option>
                                                <option value="PNBP"> PNBP </option>
                                            @else
                                                <option value="RM"> RM </option>
                                                <option value="PNBP" selected> PNBP </option>
                                            @endif
                                        </select>
                                    </td>
                                @endforeach
                            </tbody>
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
            <i class="ace-icon fa fa-check bigger-110"></i>Update
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


    function hitung(i) {
        var a = $("#volume-"+i).val();
        var b = $("#price-"+i).val();
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
