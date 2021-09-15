@extends('layouts.mon')
@section('breadcrumb')
    <li>Surat Tugas</li>
    <li><a href="/finance/outstation">Surat Tugas</a></li>
    <li>Edit</li>
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
        method="post" action="/finance/outstation/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Update Surat Tugas</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" required id="st_date" value="{{$data->st_date}}"
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
                                    @if ($data->divisi_id==$item->id)
                                        <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Surat Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text" required readonly id="nost" value="{{$data->number}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="number"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Maksud Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama kegiatan" value="{{$data->purpose}}"
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
                                    @if ($data->budget_id==$item->id)
                                        <option value="{{$item->id}}" selected>{{$item->code}}/{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->code}}/{{$item->name}}</option>
                                    @endif
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
                                    @if ($data->ppk_id == $item->id)
                                        <option value="{{$item->id}}">{{$item->user->name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kode Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="activitycode_id" class="col-xs-3 col-sm-3 required select2" required>
                                <option value="">Aktivitas</option>
                                @foreach ($act as $item)
                                    @if ($data->activitycode_id == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->prog->unit->klcode->code}}.{{$item->prog->unit->code}}.
                                        {{$item->prog->code}}.{{$item->code}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->prog->unit->klcode->code}}.{{$item->prog->unit->code}}.
                                        {{$item->prog->code}}.{{$item->code}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <select name="subcode_id" class="col-xs-4 col-sm-4 required select2" required>
                                <option value="">Subakun</option>
                                @foreach ($sub as $item)
                                   @if ($data->subcode_id==$item->id)
                                        <option value="{{$item->id}}" selected>{{$item->kodeall}}</option>
                                   @else
                                        <option value="{{$item->id}}">{{$item->kodeall}}</option>
                                   @endif
                                @endforeach
                            </select>
                            <select name="accountcode_id" class="col-xs-3 col-sm-3 required select2" required>
                                <option value="">Akun</option>
                                @foreach ($akun as $item)
                                    @if ($data->accountcode_id==$item->id)
                                        <option value="{{$item->id}}" selected>{{$item->code}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->code}}</option>
                                    @endif
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
                                @if ($data->transport=="Transportasi Darat")
                                    <option value="Transportasi Darat" selected>Transportasi Darat</option>
                                    <option value="Transportasi Laut">Transportasi Laut</option>
                                    <option value="Transportasi Udara">Transportasi Udara</option>
                                @elseif($data->transport=="Transportasi Laut") 
                                    <option value="Transportasi Darat">Transportasi Darat</option>
                                    <option value="Transportasi Laut" selected>Transportasi Laut</option>
                                    <option value="Transportasi Udara">Transportasi Udara</option>  
                                @else
                                    <option value="Transportasi Darat">Transportasi Darat</option>
                                    <option value="Transportasi Laut">Transportasi Laut</option>
                                    <option value="Transportasi Udara" selected>Transportasi Udara</option>
                                @endif
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
                                    @if ($data->city_from==$item->id)
                                        <option value="{{$item->id}}" selected>{{$item->code}}-{{$item->capital}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>
                                    @endif
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
                                @if ($data->type=="DL")
                                    <option value="">Pilih Jenis</option>
                                    <option value="DL" selected>Dalam Kota</option>
                                    <option value="LK">Luar Kota</option>
                                    <option value="LN">Luar Negeri</option>
                                @elseif($data->type=="LK")
                                    <option value="">Pilih Jenis</option>
                                    <option value="DL">Dalam Kota</option>
                                    <option value="LK" selected>Luar Kota</option>
                                    <option value="LN">Luar Negeri</option>
                                @elseif($data->type=="LN")
                                    <option value="">Pilih Jenis</option>
                                    <option value="DL">Dalam Kota</option>
                                    <option value="LK">Luar Kota</option>
                                    <option value="LN" selected>Luar Negeri</option>
                                @else
                                    <option value="">Pilih Jenis</option>
                                    <option value="DL">Dalam Kota</option>
                                    <option value="LK">Luar Kota</option>
                                    <option value="LN">Luar Negeri</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pilih Pegawai</h3></div>
            <div class="panel-body">
                <fieldset>
                    *Menambah Baris Baru otomatis memasukkan nomor SPPD yang baru.
                    <table id="myTable" class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">No SPDD</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($petugas as $item)
                                <tr id="cell-"{{$no}}>
                                    <td style="text-align: center;">
                                        {{$no}}
                                    </td>
                                    <td>
                                        <select name="users_id[]" class="form-control select2">
                                            <option value="">Pilih Pegawai</option>
                                            @foreach ($user as $peg)
                                                @if ($peg->id == $item->users_id)
                                                    <option value="{{$peg->id}}" selected>{{$peg->name}} | {{$peg->no_pegawai}}</option> 
                                                @else 
                                                    <option value="{{$peg->id}}">{{$peg->name}} | {{$peg->no_pegawai}}</option>
                                                   
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="no_sppd[]" readonly
                                        value="{{$item->no_sppd}}" required>
                                    </td>
                                    <td>
                                        <button type="button"  class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                           
                            <span id="row-new"></span>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
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
    <div class="col-md-7">
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
                            @php
                                $no=1;
                            @endphp
                            @foreach ($kota as $item)
                                <tr id="cell-{{$no}}">
                                    <td style="text-align: center;">
                                        {{$no}}
                                    </td>
                                    <td>
                                        <select name="destination_id[]" id="destination_id" class="required select2" required>
                                            <option value="">Pilih Kode Kota</option>
                                            @foreach ($destination as $tujuan)
                                               @if ($item->destination_id == $tujuan->id)
                                                    <option value="{{$tujuan->id}}" selected>{{$tujuan->code}}-{{$tujuan->capital}}</option>
                                               @else
                                                    <option value="{{$tujuan->id}}">{{$tujuan->code}}-{{$tujuan->capital}}</option>
                                               @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" name="go_date[]" id="date_from" class="required" 
                                        value="{{$item->go_date}}" required>
                                    </td>
                                    <td>
                                        <input type="date" name="return_date[]" id="date_to" class="required" 
                                        value="{{$item->return_date}}" required>
                                    </td>
                                    <td>
                                        <button type="button"  class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
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
            <i class="ace-icon fa fa-check bigger-110"></i>Update
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
                '<td><input type="text" name="no_sppd[]" readonly required </td>'+
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

        

   </script>
@endsection