@extends('layouts.din')
@section('breadcrumb')
    <li>Surat Tugas</li>
    <li><a href="/finance/outsideduties">Surat Tugas</a></li>
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
         method="post" action="{{route('outsideduties.store')}}" enctype="multipart/form-data">
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
                            <input type="date" required id="st_date" value="{{date('Y-m-d')}}" onchange="cekplh()"
                                    class="col-xs-3 col-sm-3 required " name="st_date"/>
                        </div>
                    </div>
                    {{-- @if () --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">Penanda Tangan
                            </label>
                            <div class="col-sm-8" id="plh_today">
                                <input type="text" required id="nama_plh" value="{{$cekplh->user->name}}"
                                        class="col-xs-8 col-sm-8 " readonly
                                        name="today"/>
                                &nbsp; &nbsp;
                                <input type="checkbox" name="plh" value="Y" id="plhok"
                                <?php if ($cekplh->pjs == 'Plh.') echo "checked='checked'"; ?>
                                > 
                                PLH
                            </div>
                        </div>
                    {{-- @endif --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Substansi
                        </label>
                        <div class="col-sm-8"> 
                            <select name="divisi_id" class="col-xs-10 col-sm-10 required" required id="div" onchange="getnomor()">
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
                            <input type="text" name="number" class="col-xs-10 col-sm-10 required" required> <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Maksud Tugas
                        </label>
                        <div class="col-sm-8">
                            <textarea name="purpose" id="" class="col-xs-10 col-sm-10" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Menimbang
                        </label>
                        <div class="col-sm-8">
                            <input type="checkbox" id="reset" name="reset" value="Y" onclick="respe();">&nbsp;
                            <label class="control-label" for="form-field-1"> Manual </label> <br>
                            <textarea name="menimbang" id="menimbang" cols="70%" rows="5">Bahwa untuk menunjang pelaksanaan tugas dan fungsi Balai Besar POM di Banjarmasin sebagai unit Pelaksana Teknis di lingkungan Badan POM RI, dipandang perlu untuk menerbitkan Surat Tugas
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Dasar Pelaksanaan 1 (*Tidak Wajib)
                        </label>
                        <div class="col-sm-8">
                            <textarea name="dasar" id="" class="col-xs-10 col-sm-10" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Dasar Pelaksanaan 2 (*Tidak Wajib)
                        </label>
                        <div class="col-sm-8">
                            <textarea name="dasar2" id="" class="col-xs-10 col-sm-10" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> PPK
                        </label>
                        <div class="col-sm-8"> 
                            <select name="ppk_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Pejabat</option>
                                <option value="0">Tanpa PPK</option>
                                @foreach ($ppk as $item)
                                    <option value="{{$item->id}}">{{$item->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Ketua Tim
                        </label>
                        <div class="col-sm-8"> 
                            <select name="teamleader_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Pejabat</option>>
                                @foreach ($tim as $item)
                                    <option value="{{$item->id}}">{{$item->peg->name}} ({{$item->detail}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Beban Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="budget_id" class="col-xs-10 col-sm-10 required select2" required id="budget"  onchange="cekagg()">
                                <option value="">Pilih Anggaran</option>
                                @foreach ($budget as $item)
                                    <option value="{{$item->id}}">{{$item->code}}/{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="kodeagg">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kode Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="activitycode_id" class="col-xs-3 col-sm-3 required select2" required>
                                <option value="">Pilih Anggaran</option>
                                @foreach ($act as $item)
                                    <option value="{{$item->id}}">{{$item->lengkap}}                           
                                    </option>
                                @endforeach
                            </select>
                            <select name="subcode_id" class="col-xs-4 col-sm-4 required select2" required>
                                <option value="">Pilih Anggaran</option>
                                @foreach ($sub as $item)
                                    <option value="{{$item->id}}">{{$item->kodeall}}
                                    </option>
                                @endforeach
                            </select>
                            <select name="accountcode_id" class="col-xs-3 col-sm-3 required select2" required>
                                <option value="">Pilih Anggaran</option>
                                @foreach ($akun as $item)
                                    <option value="{{$item->id}}">{{$item->code}}
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
                                <option value="DL8">Dalam Kota > 8 Jam</option>
                                <option value="LK">Luar Kota</option>
                                <option value="LN">Luar Negri</option>
                            </select>
                            &nbsp; &nbsp;
                            <input type="checkbox" name="lkdp" value="Y"> LKDP
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Petugas
                        </label>
                        <div class="col-sm-8">
                            <input type="radio" required value="N" checked
                            name="external"/> &nbsp; Internal &nbsp;
                            <input type="radio" required value="L"
                            name="external"/> &nbsp; External &nbsp;
                            <input type="radio" required value="Y"
                            name="external"/> &nbsp; Tamu (diundang ke BPOM)
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
                                <th class="text-center">Nomor</th>
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
                                    <input type="text" required readonly id="nosppd1"
                                    class="form-control required " 
                                    name="no_sppd[]"/>
                                </td>
                                <td>
                                    {{-- <button type="button"  class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button> --}}
                                </td>
                            </tr>
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
                    <a href="{{Route('outsourcing.create')}}" class="btn btn-primary" target="_blank"><i class="glyphicon glyphicon-plus"></i> Pegawai External</a>
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
        $().ready( function () {
            $("#menimbang").hide();
            $("#kodeagg").show();
        } );

       function respe(){
        if (document.getElementById('reset').checked) 
            {
                $("#menimbang").show();
            } else {
                $("#menimbang").hide();
            }
        }

        function cekagg(){
            var budget = $("#budget").val();
            if (budget == 21) {
                $("#kodeagg").hide();
            } else {
                $("#kodeagg").show();
            }
        }

        function cekplh(){
            var date = $("#st_date").val();
            $.get(
                "{{route('outsideduties.getpejabat') }}",
                {
                    date:date,
                },
                function(response) {
                    $("#nama_plh").val(response.data.name);
                    $("#plhok").prop('checked', true);
                }
            );
        }

        function getnomor(){
            var date = $("#st_date").val();
            var divisi_id = $("#div").val();
            var last_baris = $("#countRow").val();
            $.get(
                "{{route('outsideduties.getnosppd') }}",
                {
                    date:date,
                    divisi_id:divisi_id,
                    last_baris:last_baris
                },
                function(response) {
                    $("#nosppd1").val(response.no_sppd);
                }
            );
        }

       function addBarisNew(){
        var date = $("#st_date").val();
        var divisi_id = $("#div").val();
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        var plusplus = new_baris;

        $.get(
            "{{route('outsideduties.getnosppdnext') }}",
            {
                date:date,
                divisi_id:divisi_id,
                plusplus:plusplus
            },
            function(response) {
                 $isi =  '<tr id="cell-'+new_baris+'">'+
                        '<td style="text-align: center;">'+new_baris+'</td>'+
                        '<td>'+
                            '<select name="users_id[]" class="form-control select2">'+
                                '<option value="">-Pilih Pegawai-</option>'+
                                '@foreach ($user as $item)'+
                                    '<option value="{{$item->id}}">{{$item->name}} | {{$item->no_pegawai}}</option>'+
                                '@endforeach'+
                            '</select>'+                
                        '</td>'+
                        '<td>'+
                            '<input type="text" required readonly class="form-control required " name="no_sppd[]" id="sppd'+new_baris+'" value="'+response.no_sppd+'"/>'+        
                        '</td>'+
                        '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                    '</tr>';
                $("#myTable").find('tbody').append($isi);
                $("#countRow").val(new_baris);

            }
        );
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