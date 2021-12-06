@extends('layouts.mon')
@section('breadcrumb')
    <li>Surat Tugas</li>
    <li><a href="/finance/stbook">Nomor ST & SPPD</a></li>
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
         method="post" action="/finance/stbook/update/{{$data->id}}">
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Input Nomor ST & SPPD</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" required id="st_date" value="{{$data->stbook_date}}"
                                    class="col-xs-3 col-sm-3 required " readonly
                                    name="stbook_date"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Substansi
                        </label>
                        <div class="col-sm-8"> 
                            <select name="divisi_id" class="col-xs-10 col-sm-10 required select2" required id="div">
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
                        for="form-field-1"> Nomor ST
                        </label>
                        <div class="col-sm-8">
                            <input type="text" required readonly id="nost" value="{{$data->stbook_number}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="stbook_number"/>
                        </div>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Nomor SPPD</h3></div>
            <div class="panel-body">
                <fieldset>
                    <table id="myTable" class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th style="text-align: center;">NO</th>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($sppd as $item)
                            <tr id="cell-{{$no}}">
                                <td style="text-align: center;">
                                    {{$no}}
                                </td>
                                <td>
                                    <input type="text" required readonly 
                                    class="col-xs-10 col-sm-10 required " value="{{$item->nomor_sppd}}"
                                    name="nomor_sppd[]"/>
                                </td>
                                <td>
                                    {{-- <button type="button"  class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button> --}}
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
                                <td colspan="3">
                                    <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                        <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                    <input type="hidden" id="countRow" value="0">
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
    function addBarisNew(){
        var date = $("#st_date").val();
        var divisi_id = $("#div").val();
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;

        $.get(
            "{{route('stbook.getnosppdnext') }}",
            {
                date:date,
                divisi_id:divisi_id,
                new_baris:new_baris
            },
            function(response) {
                 $isi =  '<tr id="cell-'+new_baris+'">'+
                        '<td style="text-align: center;">'+new_baris+'</td>'+
                            '<td>'+
                                '<input type="text" required readonly class="col-xs-10 col-sm-10 required " name="nomor_sppd[]" id="sppd'+new_baris+'" value="'+response.no_sppd+'"/>'+        
                            '</td>'+
                            '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                        '</tr>';
                $("#myTable").find('tbody').append($isi);
                $("#countRow").val(new_baris);

            }
        );
    }

   </script>
@endsection