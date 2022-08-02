@extends('layouts.app')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/atkrequest"> Permintaan Persediaan Kantor</a></li>
    <li>Pengajuan Persediaan Kantor</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="/invent/atkrequest/update/{{$data->id}}" enctype="multipart/form-data"   >
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
                            <input type="text" value="{{$data->pegawai->name}}" readonly
                                class="col-xs-9 col-sm-9 required " 
                                name="users_name"/>  
                            <input type="hidden" name="users_id" value="{{$data->pegawai->id}}">
                        </div>
                        <div class="col-md-12">
                            <label>NO. SPB*</label><br>
                            <input type="text" id="nomor" readonly required
                            class="col-xs-9 col-sm-9 required " 
                            name="nomor"
                            value="{{$data->nomor}}"
                            />
                            <input type="hidden" name="jenis" value="A">
                            
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>MENGETAHUI *</label><br>
                            <select name="pejabat_id" class="col-xs-9 col-sm-9 select2">
                                <option value="">Pilih Pejabat</option>
                                @foreach ($tahu as $lok)
                                    @if ($lok->id == $data->pejabat_id)
                                        <option value="{{$lok->id}}" selected>{{$lok->user->name}} ({{$lok->jabatan->jabatan}})</option>
                                    @else
                                        <option value="{{$lok->id}}">{{$lok->user->name}} ({{$lok->jabatan->jabatan}})</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="hidden" name="tanggal" readonly 
                                        class="col-xs-9 col-sm-9 required" value="{{$data->tanggal}}" required
                                        data-date-format="yyyy-mm-dd">
                        </div>
                        <div class="col-md-12">
                            <label> Kelompok Barang *</label><br>
                            <select name="jenis_barang" id="jenisbrg" class="col-xs-9 col-sm-9" onchange="getkelompok()">
                                <option value="">Pilih Jenis Barang</option>
                                @foreach ($jenis as $lok)
                                    @if ($kel->barang->jenis->id == $lok->id)
                                        <option value="{{$lok->id}}" selected>{{$lok->nama}}</option>
                                    @endif
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
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($ajuan as $item)
                            <tr id="cell-{{$no}}">
                                <td class=>
                                    {{$no}}
                                </td>       
                                <td>
                                    <select name="inventaris_id[]" class="col-xs-11 col-sm-11 select2 kelompok" required id="barang_id-{{$no}}"
                                    onchange="getDataBarang({{$no}})">
                                        @foreach ($inv as $brg)
                                            @if ($brg->id == $item->inventaris_id)
                                                <option value="{{$brg->id}}" selected>{{$brg->nama_barang}}</option>
                                            @else
                                                <option value="{{$brg->id}}">{{$brg->nama_barang}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type=hidden name="satuan_id[]" class="form-control" id="satuan_id-{{$no}}" value="{{$item->satuan_id}}">
                                    <input type="text" name="satuan[]" class="form-control" readonly id="satuan-{{$no}}" value="{{$item->satuan->satuan}}">
                                </td>
                                @php
                                    $stok = $injectQuery->getSTokBarang($item->inventaris_id);
                                @endphp
                                <td>
                                    <input type="number" name="stok[]" class="form-control" readonly id="stok-{{$no}}" value="{{$stok->stok}}">
                                </td>
                                <td>
                                    <input type="number"  min="1" name="jumlah[]" class="form-control" value="{{$item->jumlah}}" id="jum-{{$no}}" onchange="hitung2({{$no}})">
                                    @php
                                        $a = $stok->stok;
                                        $b = $item->jumlah;
                                        $c = $a-$b;
                                    @endphp
                                    <input type="hidden" name="sisa[]" class="form-control" value="0" id="sisa-{{$no}}" value="$c">
                                
                                </td>
                                <td>
                                    <input type="text" name="ket[]" class="form-control" required value="{{$item->ket}}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="deleteRow({{$no}})"><i class="glyphicon glyphicon-trash"></i></button>
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
                            <td colspan="7">
                                <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                <input type="hidden" id="countRow" value="{{$no}}">
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
            <i class="ace-icon fa fa-check bigger-110"></i>Update
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

    function hitung2(i) {
        var a = $("#stok-"+i).val();
        var b =  $("#jum-"+i).val();
        var c = a - b;
        $("#sisa-"+i).val(c);
    }
    
   </script>
@endsection
