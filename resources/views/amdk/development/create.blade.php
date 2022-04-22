@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>skp</li>
    <li><a href="/amdk/skp">SKP</a></li>
    <li>Input SKP</li>
@endsection
@section('content')
@include('layouts.validasi')
<style>
    .over{
        height: 50px;
        line-height: 50px;
        -webkit-appearance: menulist-button;  
        -moz-appearance:none;
    }
</style>
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('skp.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Input SKP</h3></div>
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
                            <input type="hidden" name="jabasn_id"  value="{{auth()->user()->jabasn_id}}"/>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Tanggal *</label><br>
                            <input type="date" required id="dates" value="{{date('Y-m-d')}}"
                            class="col-xs-10 col-sm-10 required " name="dates"/>
                        </div>
                        <div class="col-md-12">
                            <label> Pejabat Penilai *</label><br>
                            <select id="peg" name="pejabat_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih nama Pejabat</option>
                                @foreach ($tahu as $lok)
                                    <option value="{{$lok->id}}">{{$lok->user->name}} ({{$lok->jabatan->jabatan}} {{$lok->divisi->nama}})</option>
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
            <div class="panel-heading"><h3 class="panel-title">Sasaran</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th class="text-center col-md-1" rowspan="2">No</th>
                            <th class="text-center col-md-4" rowspan="2">Kegiatan Tugas Jabatan</th>
                            <th class="text-center col-md-1" rowspan="2">AK</th>
                            <th class="text-center col-md-1" rowspan="2">Total KAK</th>
                            <th class="text-center" colspan="4">Target</th>
                            <th class="text-center col-md-1" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th class="text-center">KUAN / OUTPUT</th>
                            <th class="text-center">KUAL / MUTU</th>
                            <th class="text-center">time (Bulan)</th>
                            <th class="text-center">cost (Rp.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td class=>
                                1
                            </td>
                            <td>
                                <select name="setup_ak_id[]" id="uraian" class="form-control over select2" required  onchange="getData1()">
                                    @foreach ($ak as $item)
                                        <option value="{{$item->id}}">{{$item->uraian}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="n_ak[]" class="form-control" id="ak-1" step="0.01" value="0"></td>
                            <td><input type="number" name="tot_ak[]" id="tot_ak-1" class="form-control" readonly value="0" ></td>
                            <td>
                                <input type="number" name="quan[]" id="kuan-1" class="form-control"  value="0" min="0" onchange="hitung()" onclick="hitung()">
                                <select name="jen[]" class="form-control" style="font-size: 9.5px">
                                    <option value="Laporan">Laporan</option>
                                    <option value="Dokumen">Dokumen</option>
                                    <option value="Jam Pelajaran">Jam Pelajaran</option>
                                </select>
                            </td>
                            <td><input type="number" name="kual[]" class="form-control" value="0" min="0"></td>
                            <td><input type="number" name="time[]" class="form-control" value="0" min="0"></td>
                            <td><input type="number" name="cost[]" class="form-control" value="0" min="0"></td>
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
                        '<select name="setup_ak_id[]" id="uraian" class="form-control select2" required  onchange="getData1()">'+
                            '@foreach ($ak as $item)'+
                                '<option value="{{$item->id}}">{{$item->uraian}}</option>'+        
                            '@endforeach'+        
                        '</select>'+       
                    '</td>'+
                    '<td><input type="number" name="n_ak[]" class="form-control" id="ak-'+new_baris+'" step="0.01" value="0" ></td>'+        
                    '<td><input type="number" name="tot_ak[]" class="form-control" readonly value="0" id="tot_ak-'+new_baris+'"></td>'+        
                    '<td>'+
                        '<input type="number" name="quan[]" class="form-control" id="kuan-'+new_baris+'"  value="0" min="0" onchange="hitung2('+new_baris+')" onclick="hitung2('+new_baris+')">'+        
                        '<select name="jen[]" class="form-control" style="font-size: 9.5px">'+        
                            '<option value="Laporan">Laporan</option>'+        
                            '<option value="Dokumen">Dokumen</option>'+        
                            '<option value="Jam Pelajaran">Jam Pelajaran</option>'+        
                        '</select>'+        
                    '</td>'+        
                    '<td><input type="number" name="kual[]" class="form-control" value="0" min="0"></td>'+        
                    '<td><input type="number" name="time[]" class="form-control" value="0" min="0"></td>'+        
                    '<td><input type="number" name="cost[]" class="form-control" value="0" min="0"></td>'+        
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

        function hitung() {
            var a = $("#ak-1").val();
            var b = $("#kuan-1").val();
            var c = a*b;
            $("#tot_ak-1").val(c);
        }

        function hitung2(i) {
            var a = $("#ak-"+i).val();
            var b = $("#kuan-"+i).val();
            var c = a*b;
            $("#tot_ak-"+i).val(c);
        }
   </script>
@endsection
