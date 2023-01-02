@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/brokenBMN">BA penyerahan BMN Rusak Berat</a></li>
    <li>Ubah BA</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
    method="post" action="/invent/brokenBMN/update/{{$data->id}}" enctype="multipart/form-data"   >
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
                            <input type="text" readonly name="nomor" value="{{$data->nomor}}"
                                class="col-xs-10 col-sm-10 required " />
                        </div>
                        <div class="col-md-12">
                            <label>Tanggal</label><br>
                            <input type="date" name="tanggal" value="{{$data->tanggal}}"
                            class="col-xs-10 col-sm-10 required"/>
                        </div>
                   </div>
                   <div class="col-md-5">
                        <div class="col-md-12">
                            <label>Bidang</label><br>
                            <select id="peg" name="divisi_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih Bagian</option>
                                @foreach ($div as $peg)
                                    @if ($peg->id == $data->divisi_id)
                                        <option value="{{$peg->id}}" selected>{{$peg->nama}}</option>
                                    @else
                                        <option value="{{$peg->id}}">{{$peg->nama}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>pegawai</label><br>
                            <select id="peg" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih nama pegawai</option>
                                @foreach ($user as $peg)
                                    @if ($peg->id = $data->users_id)
                                        <option value="{{$peg->id}}" selected>{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @else
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <label>Kondisi Pengembalian</label><br>
                            <select name="jenis_ba" class="col-xs-10 col-sm-10 select2" required>
                                @if ($data->jenis_ba == 'R')
                                    <option value="B">Baik</option>
                                    <option value="R" selected>Rusak</option>
                                @else
                                    <option value="B" selected>Baik</option>
                                    <option value="R">Rusak</option>
                                @endif
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
                            <th class="text-center col-md-3">Nama Barang</th>
                            <th class="text-center col-md-2">Merk</th>
                            <th class="text-center col-md-1">NUP</th>
                            <th class="text-center col-md-4">Kondisi</th>
                            <th class="text-center col-md-1">Aksi</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($detail as $item)
                                <tr id="cell-{{$no}}">
                                    <td class=>
                                        {{$no}}
                                        <input type="hidden" name="outemp_id[]" value="{{$item->id}}">
                                    </td>       
                                    <td>
                                        <select name="inventaris_id[]" class="col-xs-11 col-sm-11 select2 kelompok" required id="barang_id-{{$no}}"
                                        onchange="getData({{$no}})">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($barang as $isi)
                                                @if ($isi->id == $item->inventaris_id)
                                                    <option value="{{$isi->id}}" selected>{{$isi->nama_barang}} ({{$isi->kode_barang}}) || NUP : {{$item->no_seri}}</option>
                                                @else
                                                    <option value="{{$isi->id}}">{{$isi->nama_barang}} ({{$isi->kode_barang}}) || NUP : {{$item->no_seri}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" readonly id="merk-{{$no}}" value="{{$item->barang->merk}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" readonly id="no_seri-{{$no}}" value="{{$item->barang->no_seri}}">
                                    </td>
                                    <td>
                                        <input type="text" name="ket[]" class="form-control" required value="{{$item->ket}}">
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger delete"
                                        r-name="{{$item->barang->nama_barang}}" 
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
                                <td colspan="6">
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
        var new_baris = parseInt(last_baris);
        $isi =  '<tr id="cell-'+new_baris+'">'+
            '<td style="text-align:center;">'+new_baris+'</td>'+
                '<td>'+
                    '<select name="inventaris_id[]" class="col-xs-11 col-sm-11 select2" required id="barang_id-'+new_baris+'" onchange="getData('+new_baris+')">'+
                            '<option value="">Pilih Barang</option>'+   
                            '@foreach ($barang as $isi)'+
                                '<option value="{{$isi->id}}">{{$isi->nama_barang}} {{$isi->merk}} ({{$isi->kode_barang}}) || NUP : {{$item->no_seri}}</option>'+              
                            '@endforeach'+                   
                        '</select>'+ 
                    '<input type="hidden" name="outemp_id[]">'+              
                '</td>'+
                '<td><input type="text" class="form-control" readonly id="merk-'+new_baris+'"></td>'+
                '<td><input type="text" class="form-control" readonly id="no_seri-'+new_baris+'"></td>'+
                '<td>'+
                    '<input type="text" name="ket[]" class="form-control" required>'+
                '</td>'+
                '<td><button type="button"  class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
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
                   window.location = "/invent/brokenBMN/deletelist/"+id;
                }
            });
        });

    </script>
@endsection
