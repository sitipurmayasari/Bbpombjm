@extends('layouts.app')
@section('breadcrumb')
    <li>Pengajuan</li>
    <li><a href="/invent/pengajuan"> Input Pengajuan</a></li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('pengajuan.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>NO. PENGAJUAN*</label><br>
                            <input type="text" id="no_adu" readonly required
                            class="col-xs-9 col-sm-9 required " 
                            name="no_ajuan"
                            value="{{$no_ajuan}}"/>
                        </div>
                        <div class="col-md-12">
                            <label> Kelompok Barang *</label><br>
                            <select id="peg" name="kelompok" class="col-xs-9 col-sm-9 select2" required>
                                    @foreach ($kelompok as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>TANGGAL AJUAN *</label><br>
                            <input type="text" name="tgl_ajuan" readonly 
                                        class="col-xs-9 col-sm-9 required" value="{{date('Y-m-d')}}" required
                                        data-date-format="yyyy-mm-dd" data-provide="datepicker">
                        </div>
                        <div class="col-md-12">
                            <label> Pengaju *</label><br>
                            <select id="peg" name="pegawai_id" class="col-xs-9 col-sm-9 select2" required>
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
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Barang yang di Ajukan</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover text-center">
                    <thead>
                        <th class="text-center col-md-1">No</th>
                        <th class="text-center col-md-4">Nama Barang</th>
                        <th class="text-center col-md-3">Spesifikasi</th>
                        <th class="text-center col-md-2">Satuan</th>
                        <th class="text-center col-md-1">Jumlah</th>
                        <th class="text-center col-md-3">Keperluan</th>
                        <th class="text-center col-md-1">Aksi</th>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td class=>
                                1
                            </td>       
                            <td>
                                <input type="text" name="nama_barang[]" class="form-control">
                            </td>
                            <td>
                                <textarea name="spek" class="form-control"></textarea>
                            </td>
                            <td>
                                <select name="satuan_id[]" class="col-xs-9 col-sm-9 select2" required>
                                    @foreach ($satuan as $brg)
                                        <option value="{{$brg->id}}">{{$brg->satuan}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="jumlah[]" class="form-control" value="0">
                            </td>
                            <td>
                                <input type="text" name="keperluan[]" class="form-control" style="width:200px;">
                            </td>
                            <td>
                            </td>
                        </tr>
                        <span id="row-new"></span>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
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
                        '<input type="text" name="nama_barang[]" class="form-control">'+
                    '</td>'+
                    '<td>'+
                        '<textarea name="spek" class="form-control"></textarea>'+
                    '</td>'+
                    '<td>'+
                        '<select name="satuan_id[]" class="col-xs-9 col-sm-9 select2" required>'+
                            '@foreach ($satuan as $brg)'+
                                '<option value="{{$brg->id}}">{{$brg->satuan}}</option>'+
                            '@endforeach </select>'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" name="jumlah[]" class="form-control" value="0">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="keperluan[]" class="form-control" style="width:200px;">'+
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
