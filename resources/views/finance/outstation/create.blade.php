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
                            <select name="divisi_id" class="col-xs-10 col-sm-10 required select2" required id="div" onchange="getnomor()">
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
                            <input type="text" required readonly id="nost"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="number"/>
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
                                <option value="">Kode Anggaran</option>
                                @foreach ($pok as $item)
                                    <option value="{{$item->id}}">{{$item->pok->act->lengkap}}/{{$item->sub->kodeall}}/
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
                                <option value="LN">Luar Negeri</option>
                            </select>
                        </div>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pilih Pegawai</h3></div>
            <div class="panel-body">
                <fieldset>
                    <table id="myTable" class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="cell-1">
                                <td style="text-align: center;">
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
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Kota Tujuan</h3></div>
            <div class="panel-body">
                <fieldset>
                    <table id="DesTable" class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                <th class="text-center col-md-4">Kota Tujuan</th>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th class="text-center col-md-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="cell-1">
                                <td style="text-align: center;">
                                    1
                                </td>
                                <td>
                                    <select name="destination_id[]" id="destination_id" class="required select2" required>
                                        <option value="">Pilih Kode Kota</option>
                                        @foreach ($destination as $item)
                                            <option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="go_date[]" id="date_from" class="required" 
                                    value="{{date('Y-m-d')}}" required>
                                </td>
                                <td>
                                    <input type="date" name="return_date[]" id="date_to" class="required" 
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

       function getnomor(){
           var date = $("#st_date").val();
           var divisi_id = $("#div").val();

           $.get(
            "{{route('outstation.getnost') }}",
            {
                date:date,
                divisi_id,divisi_id
            },
            function(response) {
                document.getElementsByName("number")[0].value = response.no_sppd ;
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
                '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
            '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
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

        

   </script>``
@endsection