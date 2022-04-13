@extends('layouts.mon')
@section('breadcrumb')
    <li>Surat Tugas</li>
    <li><a href="/finance/outstation">Surat Tugas</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<style>
    .scrollit {
    overflow:scroll;
    height:100px;
}
</style>

<form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('outstation.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Input Surat Tugas</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" required id="st_date" value="{{date('Y-m-d')}}"
                                    class="col-xs-3 col-sm-3 required " 
                                    name="st_date"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Substansi
                        </label>
                        <div class="col-sm-8"> 
                            <select name="divisi_id" class="col-xs-10 col-sm-10 required select2" required id="divisi_id" onchange="getnomorst()">
                                <option value="">Pilih Substansi</option>
                                @foreach ($div as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Surat Tugas
                        </label>
                        <div class="col-sm-8">
                            <select name="number" class="col-xs-10 col-sm-10 required select2" required id="nomorst" onchange="getnomorsppd()">
                                <option value="">Pilih Nomor Surat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Maksud Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama kegiatan" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="purpose" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Beban Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="budget_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Anggaran</option>
                                @foreach ($budget as $item)
                                    <option value="{{$item->id}}">{{$item->code}}/{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> PPK
                        </label>
                        <div class="col-sm-8"> 
                            <select name="ppk_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Pejabat</option>
                                @foreach ($ppk as $item)
                                    <option value="{{$item->id}}">{{$item->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kode Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="pok_detail_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="0">Non Anggaran</option>
                                @foreach ($pok as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->pok->act->lengkap}}/{{$item->sub->kodeall}}/
                                                                {{$item->akun->code}} 
                                                                ( Tersisa Rp. {{number_format($item->sisa)}} )                           
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Transportasi
                        </label>
                        <div class="col-sm-8">
                            <select name="transport" class="col-xs-10 col-sm-10 required select2" required >
                                <option value="Transportasi Darat">Transportasi Darat</option>
                                <option value="Transportasi Laut">Transportasi Laut</option>
                                <option value="Transportasi Udara">Transportasi Udara</option>
                                <option value="Transportasi Sungai">Transportasi Sungai</option>
                                <option value="-">Non Transportasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kota Asal
                        </label>
                        <div class="col-sm-8"> 
                            <select name="city_from" class="col-xs-10 col-sm-10 required select2" required id="city_from">
                                <option value="">Pilih Kode Kota</option>
                                @foreach ($destination as $item)
                                    <option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis Dinas
                        </label>
                        <div class="col-sm-8">
                            <select name="type" class="col-xs-10 col-sm-10 required" onchange="getAsal()" id="jenas">
                                <option value="">Pilih Jenis</option>
                                <option value="DL">Dalam Kota</option>
                                <option value="LK">Luar Kota</option>
                                <option value="DL8">Dalam Kota > 8 Jam</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Petugas External
                        </label>
                        <div class="col-sm-8">
                            <input type="radio" required value="N" checked
                            name="external"/> &nbsp; Tidak &nbsp;
                            <input type="radio" required value="Y"
                            name="external"/> &nbsp; Ya
                        </div>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pilih Pegawai</h3></div>
            <div class="panel-body">
                <fieldset>
                    <table id="myTable" class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th class="text-center col-md-1">NO</th>
                                <th class="text-center col-md-5" >Nama</th>
                                <th class="text-center  col-md-5">Nomor SPPD</th>
                                <th class="text-center col-md-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="cell-1">
                                <td class="text-center">
                                    1
                                </td>
                                <td>
                                    <select name="users_id[]" class="form-control select2">
                                        <option value="">Pilih Pegawai</option>
                                        @foreach ($user as $peg)
                                            <option value="{{$peg->id}}">{{$peg->name}} | {{$peg->no_pegawai}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="no_sppd[]" class="form-control select2 penomoransppd">
                                        <option value="">Pilih no SPPD</option>
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
                                <td colspan="3">
                                    <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                        <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                    <input type="hidden" id="countRow" value="1">
                                </td>
                            </tr>
                            
                        </tfoot>
                    </table>
                </fieldset>   
   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Kota Tujuan</h3></div>
            <div class="panel-body">
                <fieldset>
                    <table id="DesTable" class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th class="text-center col-md-1">NO</th>
                                <th class="text-center col-md-4">Kota Tujuan</th>
                                <th class="text-center col-md-3">Dari Tanggal</th>
                                <th class="text-center col-md-3">Sampai Tanggal</th>
                                <th class="text-center col-md-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="cell-1">
                                <td style="text-align: center;">
                                    1
                                </td>
                                <td>
                                    <select name="destination_id[]" id="destination_id" class=" form-control required select2" required>
                                        <option value="">Pilih Kode Kota</option>
                                        @foreach ($destination as $item)
                                            <option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="go_date[]" id="date_from" class="required form-control" 
                                    value="{{date('Y-m-d')}}" required>
                                </td>
                                <td>
                                    <input type="date" name="return_date[]" id="date_to" class="required form-control" 
                                    value="{{date('Y-m-d')}}" required>
                                </td>
                                <td>
                                    {{-- <button type="button"  class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button> --}}
                                </td>
                            </tr>
                            <span id="row-new"></span>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <button type="button" class="form-control btn-default" onclick="addBarisDes()">
                                        <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                    <input type="hidden" id="countRow" value="1">
                                </td>
                            </tr>
                            
                        </tfoot>
                    </table>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pengesah SPPD*</h3></div>
            <div class="panel-body">
                <fieldset>
                    <table id="myTable" class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th class="text-center col-md-1">Tujuan</th>
                                <th class="text-center col-md-4" >Nama</th>
                                <th class="text-center  col-md-4">Jabatan</th>
                                <th class="text-center col-md-2">NIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tujuan 1</td>
                                <td>
                                    <input type="text" placeholder="Nama Pengesah" class="form-control" 
                                    name="nama_petugas"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="Jabatan Pengesah" class="form-control" 
                                    name="jab_petugas"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="NIP Pengesah" class="form-control" 
                                    name="nip_petugas"/>
                                    *Jika ada
                                </td>
                            </tr>
                            <tr>
                                <td>Tujuan 2</td>
                                <td>
                                    <input type="text" placeholder="Nama Pengesah" class="form-control" 
                                    name="nama_petugas2"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="Jabatan Pengesah" class="form-control" 
                                    name="jab_petugas2"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="NIP Pengesah" class="form-control" 
                                    name="nip_petugas2"/>
                                    *Jika ada
                                </td>
                            </tr>
                            <tr>
                                <td>Tujuan 3</td>
                                <td>
                                    <input type="text" placeholder="Nama Pengesah" class="form-control" 
                                    name="nama_petugas3"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="Jabatan Pengesah" class="form-control" 
                                    name="jab_petugas3"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="NIP Pengesah" class="form-control" 
                                    name="nip_petugas3"/>
                                    *Jika ada
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    *Jika Sudah Mengetahui
                </fieldset>   
   
            </div>
        </div>
    </div>
  
    <div class="clearfix"></div>
</div>
<div class="col-sm-12">
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
        function getnomorst(){
            var divisi_id = $("#divisi_id").val();

            $.get(
                "{{route('outstation.getnomorst') }}",
                {
                        divisi_id:divisi_id
                },
                function(response) {
                    var data = response.nost;
                    var string ="<option value=''>Pilih</option>";
                        $.each(data, function(index, value) {
                            string = string + '<option value="'+ value.stbook_number +'">'+ value.stbook_number +'</option>';
                        })
                    $("#nomorst").html(string);
                }
            );
        }

        function getnomorsppd(){
            var stbook_number = $("#nomorst").val();
            $.get(
                "{{route('outstation.getnomorsppd') }}",
                {
                    stbook_number:stbook_number
                },
                function(response) {
                    var data2 = response.nosppd;
                    var string ="<option value=''>Pilih</option>";
                        $.each(data2, function(index, value) {
                            string = string + '<option value="'+ value.nomor_sppd +'">'+ value.nomor_sppd +'</option>';
                        })
                    $(".penomoransppd").html(string);
                }
            );
        }

        function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi =  '<tr id="cell-'+new_baris+'">'+
            '<td>'+new_baris+'</td>'+
                '<td>'+
                    '<select name="users_id[]" class="form-control select2">'+
                        '<option value="">-Pilih Pegawai-</option>'+
                        '@foreach ($user as $item)'+
                            '<option value="{{$item->id}}">{{$item->name}} | {{$item->no_pegawai}}</option>'+
                        '@endforeach'+
                    '</select>'+                
                '</td>'+
                    '<td>'+
                        '<select name="no_sppd[]" class="form-control select2 penomoransppd">'+
                            '<option value="">Pilih no SPPD</option>'+
                            '</select>'+
                    '</td>'+
                '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
            '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
        getnomorsppd();

       }

       function deleteRow(cell) {
            $("#cell-"+cell).remove();
            this.hitungTotal();
        }

        function addBarisDes(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi =  '<tr id="cell-'+new_baris+'">'+
            '<td>'+new_baris+'</td>'+
            '<td>'+
                '<select name="destination_id[]" id="destination_id" class="required select2" required>'+
                    '<option value="">Pilih Kode Kota</option>'+
                    '@foreach ($destination as $item)'+
                        '<option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>'+
                    '@endforeach'+
                '</select>'+
            '</td>'+
            '<td>'+
                '<input type="date" name="go_date[]" id="date_from" class="required" value="{{date('Y-m-d')}}" required>'+ 
            '</td>'+
            '<td>'+
                '<input type="date" name="return_date[]" id="date_to" class="required" value="{{date('Y-m-d')}}" required>'+ 
            '</td>'+
            '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
            '</tr>';
        $("#DesTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
       }

       function deleteRowwil(cell) {
            $("#cell-"+cell).remove();
            this.hitungTotal();

        }
        
   </script>
@endsection