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
                            <input type="text" required readonly id="nomorst" value="{{$data->number}}"
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
                                        <option value="{{$item->id}}" selected>{{$item->user->name}}</option>
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
                            <select name="pok_detail_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="0">non Anggaran</option>
                                <option value="1" selected> -  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  (*mis : menggunakan anggaran pusat)</option>
                                @foreach ($pok as $item)
                                    @if ($item->id==$data->pok_detail_id)
                                        <option value="{{$item->id}}" selected>{{$item->pok->act->lengkap}}/{{$item->sub->kodeall}}/
                                            {{$item->akun->code}} 
                                            ( Tersisa Rp. {{number_format($item->sisa)}} )
                                        </option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->pok->act->lengkap}}/{{$item->sub->kodeall}}/
                                            {{$item->akun->code}} 
                                            ( Tersisa Rp. {{number_format($item->sisa)}} )
                                        </option>
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
                                    <option value="Transportasi Sungai">Transportasi Sungai</option>
                                    <option value="-">Non Transportasi</option>
                                @elseif($data->transport=="Transportasi Laut") 
                                    <option value="Transportasi Darat">Transportasi Darat</option>
                                    <option value="Transportasi Laut" selected>Transportasi Laut</option>
                                    <option value="Transportasi Udara">Transportasi Udara</option>  
                                    <option value="Transportasi Sungai">Transportasi Sungai</option>
                                    <option value="-">Non Transportasi</option>
                                @elseif($data->transport=="Transportasi Udara") 
                                    <option value="Transportasi Darat">Transportasi Darat</option>
                                    <option value="Transportasi Laut">Transportasi Laut</option>
                                    <option value="Transportasi Udara" selected>Transportasi Udara</option>  
                                    <option value="Transportasi Sungai">Transportasi Sungai</option>
                                    <option value="-">Non Transportasi</option>
                                @elseif($data->transport=="Transportasi Sungai") 
                                    <option value="Transportasi Darat">Transportasi Darat</option>
                                    <option value="Transportasi Laut">Transportasi Laut</option>
                                    <option value="Transportasi Udara" >Transportasi Udara</option>  
                                    <option value="Transportasi Sungai" selected>Transportasi Sungai</option>
                                    <option value="-">Non Transportasi</option>
                                @else
                                    <option value="Transportasi Darat">Transportasi Darat</option>
                                    <option value="Transportasi Laut">Transportasi Laut</option>
                                    <option value="Transportasi Udara" >Transportasi Udara</option>
                                    <option value="Transportasi Sungai">Transportasi Sungai</option>
                                    <option value="-" selected>Non Transportasi</option>
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
                        for="form-field-1"> Dasar Pelaksanaan (*Tidak Wajib)
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Dasar Pelaksanaan" value="{{$data->dasar}}"
                                    class="col-xs-10 col-sm-10 " 
                                    name="dasar"/>
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
                                    <option value="DL8">Dalam Kota > 8 Jam</option>
                                @elseif($data->type=="LK")
                                    <option value="">Pilih Jenis</option>
                                    <option value="DL">Dalam Kota</option>
                                    <option value="LK" selected>Luar Kota</option>
                                    <option value="DL8">Dalam Kota > 8 Jam</option>
                                @elseif($data->type=="DL8")
                                    <option value="">Pilih Jenis</option>
                                    <option value="DL">Dalam Kota</option>
                                    <option value="LK">Luar Kota</option>
                                    <option value="DL8" selected>Dalam Kota > 8 Jam</option>
                                @else
                                    <option value="">Pilih Jenis</option>
                                    <option value="DL">Dalam Kota</option>
                                    <option value="LK">Luar Kota</option>
                                    <option value="DL8">Dalam Kota > 8 Jam</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Petugas External
                        </label>
                        <div class="col-sm-8">
                           @if ($data->external=='N')
                                <input type="radio" required value="N" checked
                                name="external"/> &nbsp; Tidak &nbsp;
                                <input type="radio" required value="Y"
                                name="external"/> &nbsp; Ya
                           @else
                                <input type="radio" required value="N"
                                name="external"/> &nbsp; Tidak &nbsp;
                                <input type="radio" required value="Y" checked
                                name="external"/> &nbsp; Ya
                           @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Upload Scan ST
                        </label>
                        <div class="col-sm-8">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><i>ex:Lorem_ipsum.pdf</i></label>
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
                                <th class="text-center col-md-5">Nama</th>
                                <th class="text-center col-md-5">No SPDD</th>
                                <th class="text-center col-md-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($petugas as $item)
                                <tr id="cella-{{$no}}">
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
                                        <input type="hidden" name="outemp_id[]" value="{{$item->id}}">
                                    </td>
                                    <td>
                                        <input type="text" name="no_sppd[]" readonly class="form-control"
                                        value="{{$item->no_sppd}}" required>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger delete"
                                            r-name="{{$item->pegawai->name}}" 
                                            r-id="{{$item->id}}">
                                            <i class="glyphicon glyphicon-trash"></i></a>
                                        {{-- <button type="button" class="btn btn-danger" onclick="deleteRowPeg({{$no}})"><i class="glyphicon glyphicon-trash"></i></button> --}}
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
                                    <input type="hidden" id="countRow" value="{{$hitpeserta->jumpes}}">
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
                            @php
                                $nomor=1;
                            @endphp
                            @foreach ($kota as $item)
                                <tr id="cellb-{{$nomor}}">
                                    <td style="text-align: center;">
                                        {{$nomor}}
                                    </td>
                                    <td>
                                        <select name="destination_id[]" id="destination_id" class="form-control required select2" required>
                                            <option value="">Pilih Kode Kota</option>
                                            @foreach ($destination as $tujuan)
                                               @if ($item->destination_id == $tujuan->id)
                                                    <option value="{{$tujuan->id}}" selected>{{$tujuan->code}}-{{$tujuan->capital}}</option>
                                               @else
                                                    <option value="{{$tujuan->id}}">{{$tujuan->code}}-{{$tujuan->capital}}</option>
                                               @endif
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="outdes_id[]" value="{{$item->id}}">
                                    </td>
                                    <td>
                                        <input type="date" name="go_date[]" id="date_from" class="required form-control" 
                                        value="{{$item->go_date}}" required>
                                    </td>
                                    <td>
                                        <input type="date" name="return_date[]" id="date_to" class="required form-control" 
                                        value="{{$item->return_date}}" required>
                                    </td>
                                    <td>
                                        <button type="button" onclick="deleteRowwil({{$nomor}})"  class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
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
                                    name="nama_petugas" value="{{$data->nama_petugas}}"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="Jabatan Pengesah" class="form-control" 
                                    name="jab_petugas" value="{{$data->jab_petugas}}"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="NIP Pengesah" class="form-control" 
                                    name="nip_petugas" value="{{$data->nip_petugas}}"/>
                                    *Jika ada
                                </td>
                            </tr>
                            <tr>
                                <td>Tujuan 2</td>
                                <td>
                                    <input type="text" placeholder="Nama Pengesah" class="form-control" 
                                    name="nama_petugas2" value="{{$data->nama_petugas2}}"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="Jabatan Pengesah" class="form-control" 
                                    name="jab_petugas2" value="{{$data->jab_petugas2}}"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="NIP Pengesah" class="form-control" 
                                    name="nip_petugas2" value="{{$data->nip_petugas2}}"/>
                                    *Jika ada
                                </td>
                            </tr>
                            <tr>
                                <td>Tujuan 3</td>
                                <td>
                                    <input type="text" placeholder="Nama Pengesah" class="form-control" 
                                    name="nama_petugas3" value="{{$data->nama_petugas3}}"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="Jabatan Pengesah" class="form-control" 
                                    name="jab_petugas3" value="{{$data->jab_petugas3}}"/>
                                </td>
                                <td>
                                    <input type="text" placeholder="NIP Pengesah" class="form-control" 
                                    name="nip_petugas3" value="{{$data->nip_petugas3}}"/>
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
            <i class="ace-icon fa fa-check bigger-110"></i>Update
        </button>
    </div>
</div>
</form>

@endsection

@section('footer')
   <script>
       $().ready( function () {
        $(".delete").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                   window.location = "/finance/outstation/deletepeg/"+id;
                }
            });
        });
    } );

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
                    '<input type="hidden" name="outemp_id[]">'+              
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

       function deleteRowPeg(cell) {
            $("#cella-"+cell).remove();

        }

        function addBarisDes(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi =  '<tr id="cellb-'+new_baris+'">'+
            '<td class="center">'+new_baris+'</td>'+
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
                ' <input type="hidden" name="outdes_id[]">'+
            '</td>'+
            '<td>'+
                '<input type="date" name="return_date[]" id="date_to" class="required" value="{{date('Y-m-d')}}" required>'+ 
            '</td>'+
            '<td><button type="button"  class="btn btn-danger" onclick="deleteRowwil('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
            '</tr>';
        $("#DesTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
       }

       function deleteRowwil(cell) {
            $("#cellb-"+cell).remove();

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

        

   </script>
@endsection