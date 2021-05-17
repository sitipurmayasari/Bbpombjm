@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li><a href="/invent/aduan"> Input Aduan</a></li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('aduan.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <div class="col-md-4">
                    <label for="">NO. ADUAN*</label>
                    <input type="text" id="no_adu" readonly required
                    class="col-xs-10 col-sm-10 required " 
                    name="no_aduan"
                    value="{{$no_aduan}}"/>
                </div>
                <div class="col-md-4">
                    <label for="">TANGGAL ADUAN *</label>
                    <input type="text" name="tanggal" readonly 
                                class="col-xs-10 col-sm-10 required" value="{{date('Y-m-d')}}" required
                                data-date-format="yyyy-mm-dd" data-provide="datepicker">
                </div>
                <div class="col-md-4">
                    <label > Pelapor *</label>
                    <select id="peg" name="pegawai_id" class="col-xs-10 col-sm-10 select2" required>
                            <option value="">pilih nama pegawai</option>
                        @foreach ($user as $peg)
                            <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                        @endforeach
                    </select>
                </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Barang yang di Adukan</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover">
                    <thead>
                        <th class="text-left col-md-1">NO</th>
                        <th class="text-center col-md-4">Kode Barang</th>
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
                                    @foreach ($data as $item)
                                        <option value="{{$item->id}}">{{$item->kode_barang}} | {{$item->nama_barang}}</option>
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
                        '<select name="aduan_detail[]" class="form-control select2" required>'+
                        '<option value="">-Pilih-</option>'+
                        '@foreach ($data as $item)'+
                            '<option value="{{$item->id}}">{{$item->kode_barang}} | {{$item->nama_barang}}</option>'+
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
