@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/barangkeluar"> Barang keluar</a></li>
    <li>Tambah Barang Keluar</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('barangkeluar.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>UNIT KERJA</label><br>
                            <label><b>Balai besar Pengawas Obat dan Makanan di Banjarmasin</b></label>
                        </div>
                        <div class="col-md-12">
                            <label>NO. SPB*</label><br>
                            <input type="text" id="nomor" readonly required
                            class="col-xs-9 col-sm-9 required " 
                            name="nomor"
                            value="{{$nosbb}}"
                            />
                            <input type="hidden" name="jenis" value="U">
                            <input type="hidden" name="stat_aduan" value="S">
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>TANGGAL KELUAR *</label><br>
                            <input type="text" name="tanggal" readonly 
                                        class="col-xs-9 col-sm-9 required" value="{{date('Y-m-d')}}" required
                                        data-date-format="yyyy-mm-dd" data-provide="datepicker">
                        </div>
                        <div class="col-md-12">
                            <label> Penerima *</label><br>
                            <select id="peg" name="users_id" class="col-xs-9 col-sm-9 select2" required>
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
                        <th class="text-center col-md-3">Nama Barang</th>
                        <th class="text-center col-md-2">Satuan</th>
                        <th class="text-center col-md-1">Stok</th>
                        <th class="text-center col-md-1">Jumlah</th>
                        <th class="text-center col-md-4">Keterangan</th>
                        <th class="text-center col-md-1">Aksi</th>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td class=>
                                1
                            </td>       
                            <td>
                                <select name="inventaris_id[]" class="form-control col-xs-11 col-sm-11 select2" required id="barang_id-1"
                                onchange="getData1()">
                                    <option value="">Pilih Barang</option>
                                    @foreach ($data as $brg)
                                        <option value="{{$brg->id}}">{{$brg->nama_barang}} || {{$brg->merk}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type=hidden name="satuan_id[]" class="form-control" id="satuan_id-1">
                                <input type="text" name="satuan" class="form-control" readonly id="satuan-1">
                            </td>
                            <td>
                                <input type="number" name="stok[]" class="form-control" readonly id="stok-1">
                            </td>
                            <td>
                                <input type="number"  min="1" name="jumlah[]" class="form-control" value="0" id="jum-1" onchange="hitung()">
                                <input type="hidden" name="sisa[]" class="form-control" value="0" id="sisa-1">
                               
                            </td>
                            <td>
                                <input type="text" name="ket[]" class="form-control" required>
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
                    '<select name="inventaris_id[]" class="form-control col-xs-11 col-sm-11 select2" required id="barang_id-'+new_baris+'" onchange="getDataBarang('+new_baris+')">'+
                        '<option value="">Pilih Barang</option>'+            
                        '@foreach ($data as $brg)'+
                            '<option value="{{$brg->id}}">{{$brg->nama_barang}} || {{$brg->merk}}</option>'+                
                        '@endforeach'+            
                    '</select>'+            
                '</td>'+
                '<td>'+
                    '<input type=hidden name="satuan_id[]" class="form-control" id="satuan_id-'+new_baris+'">'+
                    '<input type="text" name="satuan" class="form-control" readonly id="satuan-'+new_baris+'">'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="stok[]" class="form-control" readonly id="stok-'+new_baris+'">'+
                '</td>'+
                '<td>'+
                    '<input type="number" min="1" name="jumlah[]" class="form-control" value="0" id="jum-'+new_baris+'" onchange="hitung2('+new_baris+')">'+
                    '<input type="hidden" name="sisa[]" class="form-control" value="0" id="sisa-'+new_baris+'">'+
                '</td>'+
                '<td>'+
                    '<input type="text" name="ket[]" class="form-control" required>'+
                '</td>'+
                    '<td><button type="button" class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
       }

    
       function deleteRow(cell) {
            $("#cell-"+cell).remove();
            this.hitungTotal();

        }


        function getData1(){
            var barang_id = $("#barang_id-1").val();

            $.get(
                "{{route('barangkeluar.getbarang') }}",
                {
                    barang_id: barang_id
                },
                function(response) {
                    $("#satuan_id-1").val(response.data.satuan_id);
                    $("#satuan-1").val(response.data.satuan);
                    $("#stok-1").val(response.data.sisa);
                    var x = $("#stok-1").val();
                    document.getElementById("jum-1").setAttribute("max", x);
                }
            );
        }

        function hitung() {
        var a = $("#stok-1").val();
        var b =  $("#jum-1").val();
        var c = a - b;
        $("#sisa-1").val(c);
        }

        function getDataBarang(i){
            var barang_id =  $("#barang_id-"+i).val();
            if (barang_id == '') return false;
            $.get(
                "{{route('barangkeluar.getbarang') }}",
                {
                    barang_id: barang_id
                },
                function(response) {
                    $("#satuan_id-"+i).val(response.data.satuan_id);
                    $("#satuan-"+i).val(response.data.satuan);
                    $("#stok-"+i).val(response.data.sisa);
                    var x = $("#stok-"+i).val();
                    document.getElementById("jum-"+i).setAttribute("max", x);
                }
            );
        }

    function hitung2(i) {
        var a = $("#stok-"+i).val();
        var b =  $("#jum-"+i).val();
        var c = a - b;
        $("#sisa-"+i).val(c);
    }
    
   </script>
@endsection
