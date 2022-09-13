@extends('layouts.tomi')
@section('breadcrumb')
    <li><a href="/calibration/bakterimikro"> Monitoring Mikroba</a></li>
    <li>Input Monitoring Mikroba</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
        method="post" action="{{route('bakteri.store')}}" enctype="multipart/form-data"   >
   {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Monitoring Mikroba</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Nama Bakteri
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama Bakteri" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Keterangan" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="ket" required/>
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
                                <th class="text-center col-md-4" >Media</th>
                                <th class="text-center  col-md-3">Suhu (C)</th>
                                <th class="text-center  col-md-3">waktu (jam)</th>
                                <th class="text-center col-md-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="cell-1">
                                <td class="text-center">
                                    1
                                </td>
                                <td>
                                    <select name="media_id[]" class="form-control select2" id="media-1" onchange="getDetail1()">
                                        <option value="">Pilih Media</option>
                                        @foreach ($media as $peg)
                                            <option value="{{$peg->id}}">{{$peg->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="suhu-1" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="waktu-1" readonly>
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
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi ='<tr id="cell-'+new_baris+'">'+
                '<td style="text-align:center;">'+new_baris+'</td>'+
                '<td>'+
                    '<select name="media_id[]" class="form-control select2" id="media-'+new_baris+'" onchange="getDetail('+new_baris+')">'+
                        '<option value="">Pilih Media</option>'+
                        '@foreach ($media as $peg)'+
                            '<option value="{{$peg->id}}">{{$peg->name}}</option>'+    
                        '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<input type="text" class="form-control" id="suhu-'+new_baris+'" readonly>'+
                '</td>'+
                '<td>'+
                    '<input type="text" class="form-control" id="waktu-'+new_baris+'" readonly>'+
                ' </td>'+
                '<td><button type="button" class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
            '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
       }

        function deleteRow(cell) {
            $("#cell-"+cell).remove();
        }

        function getDetail1(){
            var media_id = $("#media-1").val();

            $.get(
                "{{route('media.getMedia') }}",
                {
                    media_id: media_id
                },
                function(response) {
                    $("#suhu-1").val(response.data.temperature);
                    $("#waktu-1").val(response.data.period);
                }
            );
        }

        
        function getDetail(i){
            var media_id = $("#media-"+i).val();

            $.get(
                "{{route('media.getMedia') }}",
                {
                    media_id: media_id
                },
                function(response) {
                    $("#suhu-"+i).val(response.data.temperature);
                    $("#waktu-"+i).val(response.data.period);
                }
            );
        }

    </script>
@endsection