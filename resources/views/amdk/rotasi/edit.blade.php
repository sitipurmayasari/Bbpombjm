@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/rotasi/assignment">Mutasi/Rotasi</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/rotasi/update/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Tambah Pegawai</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body col-sm-10">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-10" >
                            <select id="users_id" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                                @foreach ($user as $peg)
                                    @if ($peg->id == $data->users_id)
                                        <option value="{{$peg->id}}" selected>NIP. {{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @else
                                        <option value="{{$peg->id}}">NIP. {{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis
                        </label>
                        <div class="col-sm-10" >
                            <select id="status" name="status" class="col-xs-10 col-sm-10 select2" required>
                                @if ($data->status == "R")
                                    <option value="R" selected>Rotasi/Mutasi Pegawai</option>
                                    <option value="M">Penempatan Pegawai Pindahan</option>
                                    <option value="N">Penempatan Pegawai Baru</option>
                                    <option value="P">Evaluasi PPNPN</option>
                                @elseif($data->status == "M")
                                    <option value="R" >Rotasi/Mutasi Pegawai</option>
                                    <option value="M" selected>Penempatan Pegawai Pindahan</option>
                                    <option value="N">Penempatan Pegawai Baru</option>
                                    <option value="P">Evaluasi PPNPN</option>
                                @elseif($data->status == "N")
                                    <option value="R" >Rotasi/Mutasi Pegawai</option>
                                    <option value="M" >Penempatan Pegawai Pindahan</option>
                                    <option value="N" selected>Penempatan Pegawai Baru</option>
                                    <option value="P">Evaluasi PPNPN</option>
                                @else
                                    <option value="R">Rotasi/Mutasi Pegawai</option>
                                    <option value="M">Penempatan Pegawai Pindahan</option>
                                    <option value="N">Penempatan Pegawai Baru</option>
                                    <option value="P" selected>Evaluasi PPNPN</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Penempatan
                        </label>
                        <div class="col-sm-10" >
                            <input type="date" name="placementDate" readonly class="col-xs-2 col-sm-2 required" value="{{$data->placementDate}}"
                                data-date-format="yyyy-mm-dd" data-provide="datepicker" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penempatan Lama
                        </label>
                        <div class="col-sm-10" >
                            <input type="text" class="col-xs-10 col-sm-10 " 
                            name="old" value="{{$data->old}}"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penempatan Baru
                        </label>
                        <div class="col-sm-10" >
                            <input type="text" class="col-xs-10 col-sm-10 " 
                            name="new" value="{{$data->new}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Evaluator
                        </label>
                        <div class="col-sm-10" >
                            <select id="evaluator" name="evaluator" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">Pilih Ketua Tim</option>
                                @foreach ($katim as $katim)
                                    @if ($katim->users_id == $data->evaluator)
                                        <option value="{{$katim->users_id}}" selected>{{$katim->peg->name}}</option>
                                    @else
                                        <option value="{{$katim->users_id}}">{{$katim->peg->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nilai Minimal
                        </label>
                        <div class="col-sm-10" >
                            <input type="number" class="col-xs-1 col-sm-1 " 
                            name="min" value="{{$data->min}}"/>
                        </div>
                    </div>
                    </fieldset>        
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
                        <th class="text-center col-md-3">Pernyataan</th>
                        <th class="text-center col-md-1">Aksi</th>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($detail as $item)
                            <tr id="cell-{{$no}}">
                                <td>
                                    {{$no}}
                                    <input type="hidden" name="outemp_id[]" value="{{$item->id}}">
                                </td>       
                                <td>
                                    <textarea name="statement[]" cols="100%" rows="2">{{$item->statement}}</textarea>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger delete"
                                        r-name="{{$item->statement}}" 
                                        r-id="{{$item->id}}">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
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
                                    <input type="hidden" id="countRow" value="{{$hit->jum}}">
                            </td>
                        </tr>
                        
                    </tfoot>
                </table>
               </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>

@endsection
@section('footer')
   <script>
        function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi ='<tr id="cell-'+new_baris+'">'+
                '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<textarea name="statement[]" cols="100%" rows="2"></textarea>'+            
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
   </script>
@endsection