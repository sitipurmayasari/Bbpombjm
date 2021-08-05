@extends('layouts.mon')
@section('breadcrumb')
    <li>Surat Tugas</li>
    <li><a href="/finance/outstation">Surat Tugas</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

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
                        for="form-field-1"> Nomor Surat Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text" required
                                    class="col-xs-10 col-sm-10 required " 
                                    name="code"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Maksud Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama kegiatan" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis Dinas
                        </label>
                        <div class="col-sm-8">
                            <select name="type" class="col-xs-10 col-sm-10 required">
                                <option value="DL">Dalam Kota</option>
                                <option value="LK">Luar Kota</option>
                                <option value="LN">Luar Negeri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kota Tujuan
                        </label>
                        <div class="col-sm-8"> 
                            <select name="destination_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Kode Kota</option>
                                @foreach ($destination as $item)
                                    <option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Dari Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" name="from" class="col-xs-3 col-sm-3 required" 
                            value="{{date('Y-m-d')}}" required
                            data-date-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Sampai Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" name="to" class="col-xs-3 col-sm-3 required" 
                            value="{{date('Y-m-d')}}" required
                            data-date-format="yyyy-mm-dd">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Lama hari
                        </label>
                        <div class="col-sm-8">
                            <input type="text" name="daylong" class="col-xs-3 col-sm-3 required" 
                             required readonly>
                        </div>
                    </div>
                </fieldset>   
   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Daftar Pegawai SPPD</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover">
                    <thead>
                        <th class="text-left col-md-1">NO</th>
                        <th class="text-center col-md-4">Nama</th>
                        <th class="text-right col-md-5">Keterangan</th>
                        <th class="text-center col-md-1">Aksi</th>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td>
                                1
                            </td>
                            <td>
                                <select name="aduan_detail[]" class="form-control select2" required>
                                    <option value="">-Pilih-</option>
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->name}} | {{$item->no_pegawai}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="note[]" class="form-control">
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
               </div>
            </div>
        </div>
    </div>
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
       function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi =  '<tr id="cell-'+new_baris+'">'+
            '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<select name="aduan_detail[]" class="form-control select2" required>'+
                        '<option value="">-Pilih-</option>'+
                        '@foreach ($user as $item)'+
                            '<option value="{{$item->id}}">{{$item->name}} | {{$item->no_pegawai}}</option>'+
                        '@endforeach'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="note[]" class="form-control">'+
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
   </script>
@endsection