@extends('layouts.tomi')
@section('breadcrumb')
    <li><a href="/calibration/bakterimikro"> Daftar Bakteri</a></li>
    <li>Ubah Daftar Bakteri</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="/calibration/bakterimikro/update/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Input Daftar Bakteri</h3></div>
                <div class="panel-body">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">Nama Bakteri
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Bakteri" value="{{$data->name}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Keterangan
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Keterangan" value="{{$data->ket}}"
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
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($detail as $item)
                                <tr id="cella-{{$no}}">
                                    <td class="text-center">
                                        {{$no}}
                                    </td>
                                    <td>
                                        <select name="media_id[]" class="form-control select2" id="media-{{$no}}" onchange="getDetail({{$no}})">
                                            <option value="">Pilih Media</option>
                                            @foreach ($media as $peg)
                                                @if ($peg->id == $item->media_id)
                                                    <option value="{{$peg->id}}" selected>{{$peg->name}}</option>
                                                @else
                                                    <option value="{{$peg->id}}">{{$peg->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="detail_id[]" value="{{$item->id}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="suhu-{{$no}}" readonly value="{{$item->media->temperature}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="waktu-{{$no}}" readonly value="{{$item->media->period}}">
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger delete"
                                            r-name="{{$item->media->name}}" 
                                            r-id="{{$item->id}}">
                                            <i class="glyphicon glyphicon-trash"></i></a>
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
                                    <td colspan="5">
                                        <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        <input type="hidden" id="countRow" value="{{$no}}">
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
                    window.location = "/calibration/bakterimikro/deletemed/"+id;
                    }
                });
            });
        });

        function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris);
        $isi ='<tr id="cell-'+new_baris+'">'+
                '<td style="text-align:center;">'+new_baris+'</td>'+
                '<td>'+
                    '<select name="media_id[]" class="form-control select2" id="media-'+new_baris+'" onchange="getDetail('+new_baris+')">'+
                        '<option value="">Pilih Media</option>'+
                        '@foreach ($media as $peg)'+
                            '<option value="{{$peg->id}}">{{$peg->name}}</option>'+    
                        '@endforeach'+
                    '</select>'+
                    ' <input type="hidden" name="detail_id[]">'
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