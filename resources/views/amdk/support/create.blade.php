@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>skp</li>
    <li><a href="/amdk/support">kegiatanPenunjang Perencanaan</a></li>
    <li>Input Penunjang Perencanaan</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
            method="post" action="{{route('support.store')}}" enctype="multipart/form-data"   >
        {{ csrf_field() }}
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">InputPenunjang Perencanaan</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Nama*</label><br>
                            <input type="text" readonly class="col-xs-10 col-sm-10 " 
                            name="users_name" value="{{auth()->user()->name}}"/>
                            <input type="hidden" name="users_id" value="{{auth()->user()->id}}"/>
                        </div>
                        <div class="col-md-12">
                            <label> Jabatan</label><br>
                            <input type="text" readonly class="col-xs-10 col-sm-10 " 
                            name="jabatan" value="{{$jab->nama}}"/>
                            <input type="hidden" name="jabasn" id="jabasn"  value="{{$jab->jabatan}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Tanggal *</label><br>
                            <input type="date" required value="{{date('Y-m-d')}}"
                            class="col-xs-10 col-sm-10 required " name="plan_date"/>
                        </div>
                        <div class="col-md-12">
                            <label> SKP *</label><br>
                            <select id="skp" name="skp_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih SKP</option>
                                @foreach ($skp as $lok)
                                    <option value="{{$lok->id}}">{{tgl_indo($lok->dates)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>         
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Sasaran</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover scrollit text-center">
                    <thead>
                        <tr>
                            <th class="text-center" >No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center col-md-4">Butir Kegiatan</th>
                            <th class="text-center col-md-2">keluaran Kegiatan</th>
                            <th class="text-center col-md-1">Angka Kredit</th>
                            <th class="text-center col-md-1">Volume Kegiatan</th>
                            <th class="text-center col-md-3">Bukti Fisik</th>
                            <th class="text-center col-md-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td class=>
                                1
                            </td>
                            <td>
                                <input type="date" required value="{{date('Y-m-d')}}"  class="form-control" name="kin_date[]"/>
                            </td>
                            <td>
                                <select name="setup_ak_id[]" class="form-control select2" id="setupid1"  onchange="getnilai1()">
                                    <option value="">Pilih Kegiatan</option>
                                    @foreach ($ak as $item)
                                        <option value="{{$item->id}}">{{$item->kode_ak}}-{{$item->uraian}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" readonly class="form-control" id="keluaran1" name="keluaran[]"></td>
                            <td><input type="number" min=0 class="form-control" id="volume1" name="volume[]" value="0"></td>
                            <td><input type="text" readonly class="form-control" id="ak1" name="ak[]"></td>
                            <td><input type="number" min=0 class="form-control" name="bukti[]" value="0"></td>
                            <td></td>
                        
                        </tr>
                        <span id="row-new"></span>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
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
                        '<input type="date" id="dates" value="{{date("Y-m-d")}}" class="form-control" name="kin_date[]"/>'+        
                    '</td>'+        
                    '<td>'+
                        '<select name="setup_ak_id[]" class="form-control select2" id="setupid-'+new_baris+'"  onchange="getnilainext('+new_baris+')">'+
                            '<option value="">Pilih Kegiatan</option>'+
                            '@foreach ($ak as $item)'+
                                '<option value="{{$item->id}}">{{$item->kode_ak}}-{{$item->uraian}}</option>'+
                            '@endforeach'+        
                        '</select>'+
                    '</td>'+
                    '<td><input type="text" readonly class="form-control" id="keluaran-'+new_baris+'" name="keluaran[]"></td>'+
                    '<td><input type="number" min=0 class="form-control" name="volume[]" value="0"></td>'+
                    '<td><input type="text" readonly class="form-control" id="ak-'+new_baris+'" name="ak[]"></td>'+
                    '<td><input type="number" min=0 class="form-control" name="bukti[]" value="0"></td>'+     
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
    
    function getnilai1(){
        var setup_id = $("#setupid1").val();
        var jabasn = $("#jabasn").val();

        $.get(
            "{{route('ak.getnilai') }}",
            {
                setup_id: setup_id
            },

            function(response) {

                if (jabasn == 'Ahli Pertama') {
                     ak = response.data.pertama;
                }else if (jabasn == 'Ahli Muda') {
                     ak = response.data.muda;
                }else if (jabasn == 'Ahli Madya') {
                     ak = response.data.madya;
                } else {
                     ak = response.data.utama;
                }

                $("#keluaran1").val(response.data.hasil);
                $("#ak1").val(ak);
            }
        );
    }

    function getnilainext(i){
        var setup_id = $("#setupid-"+i).val();
        var jabasn = $("#jabasn").val();

        $.get(
            "{{route('ak.getnilai') }}",
            {
                setup_id: setup_id
            },

            function(response) {

                if (jabasn == 'Ahli Pertama') {
                     ak = response.data.pertama;
                }else if (jabasn == 'Ahli Muda') {
                     ak = response.data.muda;
                }else if (jabasn == 'Ahli Madya') {
                     ak = response.data.madya;
                } else {
                     ak = response.data.utama;
                }

                $("#keluaran-"+i).val(response.data.hasil);
                $("#ak-"+i).val(ak);
            }
        );
    }
</script>
@endsection
