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
                                <label>Pengaju</label><br>
                                <select name="users_id" class="col-xs-9 col-sm-9 select2">
                                    <option value="">Pilih Pengaju</option>
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->name}} ({{$item->no_pegawai}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>NO. SPB*</label><br>
                                <input type="text" id="nomor" readonly required
                                class="col-xs-9 col-sm-9 required " 
                                name="nomor"
                                value="{{$nosbb}}"
                                />
                                <input type="hidden" name="jenis" value="A">
                                <input type="hidden" name="stat_aduan" value="D">
                            </div>
                       </div>
                       <div class="col-md-6">
                            <div class="col-md-12">
                                <label>MENGETAHUI *</label><br>
                                <select name="mengetahui_id" class="col-xs-9 col-sm-9 select2">
                                    <option value="">Pilih Pejabat</option>
                                    @foreach ($tahu as $item)
                                        <option value="{{$item->peg->id}}">{{$item->peg->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="tanggal" readonly 
                                            class="col-xs-9 col-sm-9 required" value="{{date('Y-m-d')}}" required
                                            data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="col-md-12">
                                <label> Kelompok Barang *</label><br>
                                <select name="jenis_barang" id="jenisbrg" class="col-xs-9 col-sm-9" onchange="getkelompok()">
                                    <option value="">Pilih Jenis Barang</option>
                                    @foreach ($jenis as $lok)
                                        <option value="{{$lok->id}}">{{$lok->nama}}</option>
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
                                <td>
                                    1
                                </td>       
                                <td>
                                    <select name="inventaris_id[]" class="col-xs-11 col-sm-11 select2 kelompok" required id="barang_id-1"
                                    onchange="getData1()">
                                        <option value="">Pilih Barang</option>
                                    </select>
                                </td>
                                <td>
                                    <input type=hidden name="satuan_id[]" class="form-control" id="satuan_id-1">
                                    <input type="text" name="satuan[]" class="form-control" readonly id="satuan-1">
                                </td>
                                <td>
                                    <input type="number" name="stok[]" class="form-control" readonly id="stok-1">
                                </td>
                                <td>
                                    <input type="number"  min="1" name="jumlah[]" class="form-control" value="0" id="jum-1" onclick="hitung()"  onkeyup="hitung()">
                                    <input type="hidden" name="jumlah_aju[]" id="jum_aju-1">
                                    <input type="hidden" name="sisa[]" id="sisa-1">
                                    <input type="hidden" name="status[]" id="status-1" value="Y">
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
            $isi ='<tr id="cell-'+new_baris+'">'+
                    '<td>'+new_baris+'</td>'+
                        '<td>'+
                            '<select name="inventaris_id[]" class="col-xs-11 col-sm-11 select2" required id="barang_id-'+new_baris+'" onchange="getDataBarang('+new_baris+')">'+
                                '<option value="">Pilih Barang</option>'+                      
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
                            '<input type="number" min="1" name="jumlah[]" class="form-control" value="0" id="jum-'+new_baris+'" onclick="hitung2('+new_baris+')" onkeyup="hitung2('+new_baris+')">'+
                            '<input type="hidden" name="jumlah_aju[]" id="jum_aju-'+new_baris+'">'+
                            '<input type="hidden" name="sisa[]" id="sisa-'+new_baris+'">'+
                            '<input type="hidden" name="status[]" id="status-'+new_baris+'" value="Y">'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="ket[]" class="form-control" required>'+
                        '</td>'+
                            '<td><button type="button" class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                        '</tr>';
            $("#myTable").find('tbody').append($isi);
            $("#countRow").val(new_baris);
            $('.select2').select2();
            getkelompoknext(new_baris);
    
           }
    
        
           function deleteRow(cell) {
                $("#cell-"+cell).remove();
                this.hitungTotal();
    
            }
    
            function getkelompok(){
                var jenis_barang = $("#jenisbrg").val();
    
                $.get(
                "{{route('barangkeluar.getKelompok') }}",
                {
                    jenis_barang: jenis_barang
                },
                function(response) {
                    var data2 = response.data;
                    var string ="<option value=''>Pilih Barang</option>";
                        $.each(data2, function(index, value) {
                            string = string + '<option value="'+ value.id +'">'+ value.nama_barang +'</option>';
                        })
                    $(".kelompok").html(string);
                }
            );
            }
    
            function getkelompoknext(i){
                var jenis_barang = $("#jenisbrg").val();
    
                $.get(
                "{{route('barangkeluar.getKelompok') }}",
                {
                    jenis_barang: jenis_barang
                },
                function(response) {
                    var data2 = response.data;
                    var string ="<option value=''>Pilih Barang</option>";
                        $.each(data2, function(index, value) {
                            string = string + '<option value="'+ value.id +'">'+ value.nama_barang +'</option>';
                        })
                    $("#barang_id-"+i).html(string);
                }
            );
            }
    
            function getData1(){
                var barang_id = $("#barang_id-1").val();
    
                $.get(
                    "{{route('barangkeluar.getbarang') }}",
                    {
                        barang_id: barang_id
                    },
                    function(response) {
    
                        if (response.data.stock == null) {
                            v = 0;
                        } else {
                            v = response.data.stock;
                        }
    
                        $("#satuan_id-1").val(response.data.satuan_id);
                        $("#satuan-1").val(response.data.satuan);
                        $("#stok-1").val(v);
                        var x = $("#stok-1").val();
                        document.getElementById("jum-1").setAttribute("max", x);
                    }
                );
            }
    
            function hitung() {
                var a = $("#stok-1").val();
                var b =  $("#jum-1").val();
                var c = a - b;
                $("#jum_aju-1").val(b);
                $("#sisa-1").val(c);
            }
    
            function hitung2(i) {
                var a = $("#stok-"+i).val();
                var b =  $("#jum-"+i).val();
                var c = a - b;
                $("#jum_aju-"+i).val(b);
                $("#sisa-"+i).val(c);
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
                        if (response.data.stock == null) {
                            v = 0;
                        } else {
                            v = response.data.stock;
                        }
                        $("#satuan_id-"+i).val(response.data.satuan_id);
                        $("#satuan-"+i).val(response.data.satuan);
                        $("#stok-"+i).val(v);
                        var x = $("#stok-"+i).val();
                        document.getElementById("jum-"+i).setAttribute("max", x);
                    }
                );
            }
        
       </script>
    @endsection
