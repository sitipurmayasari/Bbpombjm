@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/brokenBMN">BA penyerahan BMN</a></li>
    <li>Input BA</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('brokenBMN.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <fieldset>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <label>Nomor (SIPANDA)*</label><br>
                            <input type="text" readonly name="nomor"
                                class="col-xs-10 col-sm-10 required " />
                        </div>
                        <div class="col-md-12">
                            <label>Tanggal</label><br>
                            <input type="date" name="tanggal" value="{{date('Y-m-d')}}" 
                            class="col-xs-10 col-sm-10 required"/>
                        </div>
                   </div>
                   <div class="col-md-5">
                        <div class="col-md-12">
                            <label>Bidang</label><br>
                            <select id="peg" name="divisi_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih Bagian</option>
                                @foreach ($div as $peg)
                                    <option value="{{$peg->id}}">{{$peg->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>pegawai</label><br>
                            <select id="peg" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih nama pegawai</option>
                                @foreach ($user as $peg)
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <label>Kondisi Pengembalian</label><br>
                            <select name="jenis_ba" class="col-xs-10 col-sm-10 select2" required>
                               <option value="B">Baik</option>
                               <option value="R">Rusak</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Daftar barang</h3></div>
            <div class="panel-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <table id="myTable" class="table table-bordered table-hover text-center">
                        <thead>
                            <th class="text-center col-md-1">No</th>
                            <th class="text-center col-md-4">Nama Barang</th>
                            <th class="text-center col-md-2">Merk</th>
                            <th class="text-center col-md-1">NUP</th>
                            <th class="text-center col-md-2">Kondisi</th>
                            <th class="text-center col-md-1">Aksi</th>
                        </thead>
                        <tbody>
                            <tr id="cell-1">
                                <td class=>
                                    1
                                </td>       
                                <td>
                                    <select name="inventaris_id[]" class="col-xs-11 col-sm-11 select2 kelompok" required id="barang_id-1"
                                    onchange="getData1()">
                                        <option value="">Pilih Barang</option>
                                        @foreach ($data as $item)
                                            <option value="{{$item->id}}">{{$item->nama_barang}} ({{$item->kode_barang}}) || NUP : {{$item->no_seri}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" readonly id="merk-1">
                                </td>
                                <td>
                                    <input type="text" class="form-control" readonly id="no_seri-1">
                                </td>
                                <td>
                                    <input type="text" name="ket[]" class="form-control" placeholder="rusak/rusak berat" required>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <span id="row-new"></span>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
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
        function getData1(){
            var barang_id = $("#barang_id-1").val();

            $.get(
                "{{route('inventaris.getbarang') }}",
                {
                    barang_id: barang_id
                },
                function(response) {
                    $("#merk-1").val(response.data.merk);
                    $("#no_seri-1").val(response.data.no_seri);
                }
            );
        }

        function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi ='<tr id="cell-'+new_baris+'">'+
                '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<select name="inventaris_id[]" class="col-xs-11 col-sm-11 select2" required id="barang_id-'+new_baris+'" onchange="getData('+new_baris+')">'+
                            '<option value="">Pilih Barang</option>'+   
                            '@foreach ($data as $item)'+
                                '<option value="{{$item->id}}">{{$item->nama_barang}} {{$item->merk}} ({{$item->kode_barang}}) || NUP : {{$item->no_seri}}</option>'+              
                            '@endforeach'+                   
                        '</select>'+            
                    '</td>'+
                    '<td><input type="text" class="form-control" readonly id="merk-'+new_baris+'"></td>'+
                    '<td><input type="text" class="form-control" readonly id="no_seri-'+new_baris+'"></td>'+
                    '<td>'+
                        '<input type="text" name="ket[]" placeholder="rusak/rusak berat"  class="form-control" required>'+
                    '</td>'+
                        '<td><button type="button" class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                    '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
       }

       function getData(i){
            var barang_id = $("#barang_id-"+i).val();

            $.get(
                "{{route('inventaris.getbarang') }}",
                {
                    barang_id: barang_id
                },
                function(response) {
                    $("#merk-"+i).val(response.data.merk);
                    $("#no_seri-"+i).val(response.data.no_seri);
                }
            );
        }

        function deleteRow(cell) {
            $("#cell-"+cell).remove();
            this.hitungTotal();

        }

    </script>
@endsection
