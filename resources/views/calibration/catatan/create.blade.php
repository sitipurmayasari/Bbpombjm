@extends('layouts.ot')
@section('breadcrumb')
    <li><a href="/calibration/catatan"> Catatan Pengujian</a></li>
    <li>Input Catatan Pengujian</li>
@endsection

@section('content')
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="{{route('catatan.store')}}" enctype="multipart/form-data"   >
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3 class="panel-title">SAMPEL</h3></div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label>Pembuat</label><br>
                                    <input type="text" value="{{auth()->user()->name}}" readonly
                                        class="col-xs-9 col-sm-9 required " 
                                        name="users_name"/>  
                                    <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                                </div>
                                <div class="col-md-12">
                                    <label>Tanggal Uji</label><br>
                                    <input type="date" required id="st_date" value="{{date('Y-m-d')}}" class="col-xs-9 col-sm-9 required " 
                                        name="date"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label>Nama Sampel*</label><br>
                                    <input type="text" required class="col-xs-9 col-sm-9 required " 
                                        name="nama_sampel" />
                                </div>
                                <div class="col-md-12">
                                    <label>Kode Sampel*</label><br>
                                    <input type="text" required class="col-xs-9 col-sm-9 required " 
                                        name="kode_sampel" />
                                </div>
                                <div class="col-md-12">
                                    <label>Komuditi *</label><br>
                                    <select name="komuditi" id="komuditi" class="col-xs-9 col-sm-9" onchange="getkelompok()">
                                        <option value="">Pilih Komuditi</option>
                                        <option value="OBA">OBAT BAHAN ALAM / OBAT TRADISIONAL</option>
                                        <option value="KOS">KOSMETIK</option>
                                        <option value="SK">SUPLEMEN KESEHATAN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Parameter Uji</h3></div>
                    <div class="panel-body">
                       <div class="col-md-12">
                        <div class="form-actions center">
                            <input type="file" name="foto" class="btn btn-success btn-sm" id="" 
                                value="Upload Foto Barang">   
                                <label><i>ex:Lorem_ipsum.jpg/.jpeg/.png</i></label>
                        </div>     
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
            "{{route('atkrequest.getKelompok') }}",
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
            "{{route('atkrequest.getKelompok') }}",
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
                "{{route('atkrequest.getbarang') }}",
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
                "{{route('atkrequest.getbarang') }}",
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