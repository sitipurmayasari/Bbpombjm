@extends('layouts.din')
@section('breadcrumb')
    <li>Surat Tugas</li>
    <li><a href="/finance/outsideduties">Surat Tugas</a></li>
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
        method="post" action="/finance/outsideduties/update/{{$data->id}}" enctype="multipart/form-data">
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
                            &nbsp; &nbsp;
                            @if ($data->lkdp == 'Y')
                                <input type="checkbox" name="lkdp" value="Y" checked> LKDP
                            @else
                                <input type="checkbox" name="lkdp" value="Y"> LKDP
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Substansi
                        </label>
                        <div class="col-sm-8"> 
                            <select name="divisi_id" class="col-xs-10 col-sm-10 required" required id="div" onchange="getnomor()">
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
                            <textarea name="purpose" id="" class="col-xs-10 col-sm-10" rows="3" required>{{$data->purpose}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Menimbang
                        </label>
                        <div class="col-sm-8">
                            <textarea name="menimbang" id="menimbang" class="col-xs-10 col-sm-10" rows="3">{{$data->menimbang}}
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Dasar Pelaksanaan 1 (*Tidak Wajib)
                        </label>
                        <div class="col-sm-8">
                            <textarea name="dasar" id="" class="col-xs-10 col-sm-10" rows="2">{{$data->dasar}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Dasar Pelaksanaan 2 (*Tidak Wajib)
                        </label>
                        <div class="col-sm-8">
                            <textarea name="dasar" id="" class="col-xs-10 col-sm-10" rows="2">{{$data->dasar2}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> PPK
                        </label>
                        <div class="col-sm-8"> 
                            <select name="ppk_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="0">Tanpa PPK</option>
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
                        for="form-field-1"> Ketua Tim
                        </label>
                        <div class="col-sm-8"> 
                            <select name="teamleader_id" class="col-xs-10 col-sm-10 required select2" required>
                                    <option value="">Pilih Pejabat</option>>
                                @foreach ($tim as $item)
                                    @if ($data->teamleader_id == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->peg->name}} ({{$item->detail}})</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->peg->name}} ({{$item->detail}})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Beban Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="budget_id" class="col-xs-10 col-sm-10 required select2"  required id="budget"  onchange="cekagg()">
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
                    <div class="form-group" id="kodeagg">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kode Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="activitycode_id" class="col-xs-3 col-sm-3 required select2" required>
                                <option value="">Pilih Anggaran</option>
                                @foreach ($act as $item)
                                    @if ($data->activitycode_id == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->lengkap}}                         
                                        </option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->lengkap}}                           
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <select name="subcode_id" class="col-xs-4 col-sm-4 required select2" required>
                                <option value="">Pilih Anggaran</option>
                                @foreach ($sub as $item)
                                    @if ($data->subcode_id == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->kodeall}}
                                        </option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->kodeall}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <select name="accountcode_id" class="col-xs-3 col-sm-3 required select2" required>
                                <option value="">Pilih Anggaran</option>
                                @foreach ($akun as $item)
                                    @if ($data->accountcode_id == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->code}}
                                        </option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->code}}
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
                        for="form-field-1"> Jenis Dinas
                        </label>
                        <div class="col-sm-8">
                            <select name="type" class="col-xs-10 col-sm-10 required" onchange="getAsal()" id="jenas">
                                @if ($data->type=="DL")
                                    <option value="DL" selected>Dalam Kota</option>
                                    <option value="DL8">Dalam Kota > 8 Jam</option>
                                    <option value="LK">Luar Kota</option>
                                    <option value="LN">Luar Negri</option>
                                @elseif($data->type=="DL8")
                                    <option value="DL">Dalam Kota</option>
                                    <option value="DL8" selected>Dalam Kota > 8 Jam</option>
                                    <option value="LK">Luar Kota</option>
                                    <option value="LN">Luar Negri</option>
                                @elseif($data->type=="LK")
                                    <option value="DL">Dalam Kota</option>
                                    <option value="DL8">Dalam Kota > 8 Jam</option>
                                    <option value="LK" selected>Luar Kota</option>
                                    <option value="LN">Luar Negri</option>
                                @else
                                    <option value="DL">Dalam Kota</option>
                                    <option value="DL8">Dalam Kota > 8 Jam</option>
                                    <option value="LK">Luar Kota</option>
                                    <option value="LN">Luar Negri</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Petugas
                        </label>
                        <div class="col-sm-8">
                           @if ($data->external=='N')
                                <input type="radio" required value="N" checked
                                name="external"/> &nbsp; Internal &nbsp;
                                <input type="radio" required value="L"
                                name="external"/> &nbsp; External &nbsp;
                                <input type="radio" required value="Y"
                                name="external"/> &nbsp; Tamu (diundang ke BPOM)
                            
                            @elseif($data->external=='L')
                                <input type="radio" required value="N" 
                                name="external"/> &nbsp; Internal &nbsp;
                                <input type="radio" required value="L" checked
                                name="external"/> &nbsp; External &nbsp;
                                <input type="radio" required value="Y"
                                name="external"/> &nbsp; Tamu (diundang ke BPOM)

                           @else
                                <input type="radio" required value="N"
                                name="external"/> &nbsp; Internal &nbsp;
                                <input type="radio" required value="L"
                                name="external"/> &nbsp; External &nbsp;
                                <input type="radio" required value="Y" checked
                                name="external"/> &nbsp; Tamu (diundang ke BPOM)
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
                                <th class="text-center col-md-5" >Nama</th>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Aksi</th>
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
                                        <input type="text" required readonly id="nosppd1" value="{{$item->no_sppd}}"
                                        class="form-control required " 
                                        name="no_sppd[]"/>
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
                                    <input type="hidden" id="tambahan" value="0">
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
                                        <a href="#" class="btn btn-danger deletetujuan"
                                            r-name="{{$item->destiny->capital}}" 
                                            r-id="{{$item->id}}">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                @php
                                    $nomor++;
                                @endphp
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
                   window.location = "/finance/outsideduties/deletepeg/"+id;
                }
            });
        });
    });

    $().ready( function () {
        $(".deletetujuan").click(function() {
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
                   window.location = "/finance/outsideduties/deletetujuan/"+id;
                }
            });
        });
    });

    function addBarisNew(){
        var date = $("#st_date").val();
        var divisi_id = $("#div").val();
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;

        var tambahan = $("#tambahan").val();
        var plusplus = parseInt(tambahan)+1;

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
                            '<input type="text" required readonly class="col-xs-10 col-sm-10 required " name="no_sppd[]" id="sppd'+new_baris+'" value="'+response.no_sppd+'"/>'+        
                        '</td>'+
                        '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                    '</tr>';
                $("#myTable").find('tbody').append($isi);
                $("#countRow").val(new_baris);
                $("#tambahan").val(plusplus);

            }
        );
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
                "{{route('outsideduties.getnomorsppd') }}",
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