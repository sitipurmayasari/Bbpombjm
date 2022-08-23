@extends('layouts.app')
@section('breadcrumb')
    <li>Pengajuan</li>
    <li><a href="/invent/planlab">Perencanaan Pengadaan Laboratorium</a></li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('planlab.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Perencanaan Pengadaan Laboratorium</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <label>NO. PENGAJUAN*</label><br>
                                <input type="text" id="no_adu" readonly required
                                class="col-xs-9 col-sm-9 required " 
                                name="no_ajuan"
                                value="{{$no_ajuan}}"
                                />
                            </div>
                            <div class="col-md-12">
                                <label>Asal Lab *</label><br>
                                <select name="labory_id" id="labory_id" class="col-xs-9 col-sm-9 required" required>
                                    @foreach ($lab as $lok)
                                        <option value="{{$lok->id}}">{{$lok->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12">
                                <label>TANGGAL AJUAN *</label><br>
                                <input type="text" name="tgl_ajuan" readonly 
                                            class="col-xs-9 col-sm-9 " value="{{date('Y-m-d')}}">
                            </div>
                            <div class="col-md-12">
                                <label> Tahun Ajuan *</label><br>
                                <select id="tahun" name="years" class="col-xs-9 col-sm-9" required>
                                    @php
                                        $now=date('Y');
                                        $c = $now+1;
                                            for ($a=$now;$a<=$c;$a++)
                                                {
                                                    echo "<option value='$a'>$a</option>";
                                                }
                                    @endphp
                                </select>
                                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Barang yang di Ajukan</h3></div>
                <div class="panel-body">

                        <table id="myTable" class="table table-bordered table-hover text-center">
                            <thead>
                                <th>No</th>
                                <th class="text-center col-md-3">Nama Barang</th>
                                <th class="text-center col-md-2">No_Katalog</th>
                                <th class="text-center col-md-1">Kemasan</th>
                                <th class="text-center col-md-1">Satuan</th>
                                <th class="text-center col-md-1">Jumlah</th>
                                <th class="text-center col-md-3">Foto Barang</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <tr id="cell-1">
                                    <td>
                                        1
                                    </td>       
                                    <td> 
                                        <input type="text" name="names[]" class="form-control required" required>
                                    </td>
                                    <td>
                                        <input type="text" name="katalog[]" class="form-control required" required>
                                    </td>
                                    <td>
                                        <input type="text" name="kemasan[]" class="form-control required" required placeholder="2,5L">
                                    </td>
                                    <td>
                                        <select name="satuan_id[]" class="form-control select2" required>
                                            @foreach ($satuan as $brg)
                                                <option value="{{$brg->id}}">{{$brg->satuan}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control" value="0" required>
                                    </td>
                                    <td>
                                        <input type="file" name="file_foto[]" class="btn btn-success form-control">   
                                        <label><i>jenis:.jpg/.jpeg/.png & max:2MB</i></label>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <span id="row-new"></span>
                            </tbody>  
                            <tfoot>
                                <tr>
                                    <td colspan="8">
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
    <div class="panel-footer">
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
                    '<input type="text" name="names[]" class="form-control required" required>'+
                '</td>'+
                '<td>'+
                    '<input type="text" name="katalog[]" class="form-control required" required>'+
                '</td>'+
                '<td>'+
                    '<input type="text" name="kemasan[]" class="form-control required" required placeholder="2,5L">'+
                '</td>'+
                '<td>'+
                    '<select name="satuan_id[]" class="form-control select2" required>'+
                        ' @foreach ($satuan as $brg)'+                       
                            '<option value="{{$brg->id}}">{{$brg->satuan}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="jumlah[]" class="form-control" value="0 required">'+
                '</td>'+
                '<td>'+
                    '<input type="file" name="file_foto[]" class="btn btn-success form-control">'+  
                    '<label><i>jenis:.jpg/.jpeg/.png & max:2MB</i></label>'+  
                '</td>'+
                '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
            '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
       }

    
       function deleteRow(cell) {
            $("#cell-"+cell).remove();
        }

   </script>
@endsection