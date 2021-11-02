@extends('layouts.mon')
@section('breadcrumb')
    <li>Indikator Kinerja</li>
    <li><a href="/finance/ikutagging">Tagging Anggaran</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('ikutagging.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">B. Tagging Anggaran {{$pagu->name}}</h3></div>
                <div class="panel-body">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="col-sm-2">SubKomponen</th>
                                <th colspan="2">Pagu</th>
                                <th colspan="2">Tagging</th>
                                <th colspan="2">Nilai</th>
                            </tr>
                            <tr>
                                <th>Pagu Akhir</th>
                                <th>Realisasi</th>
                                <th class="col-sm-3">IKU</th>
                                <th class="col-sm-1">%</th>
                                <th>Pagu Iku</th>
                                <th>Realisasi Iku</th>
                            </tr>
                        </thead>
                    </table>
                    @foreach ($data as $row)
                        <table id="tabel-{{$row->subocode_id}}">
                            <tbody>
                                <tr>
                                    <td class="col-sm-2">
                                        <input type="text" value="{{$row->sub->kodeall}}" 
                                        class="col-xs-12 col-sm-12" readonly
                                        name="sub" />
                                        <input type="hidden" name="subocode_id" value="{{$row->subocode_id}}">
                                    </td>
                                    <td><input type="number" value="{{$row->pagusub}}" style="text-align: center"
                                        class="col-xs-12 col-sm-12" readonly id="pagusub"
                                        name="pagusub" />
                                    </td>
                                    <td>
                                        <input type="number" value="{{$row->realisasisub}}" style="text-align: center"
                                        class="col-xs-12 col-sm-12" readonly id="realisasisub-"
                                        name="realisasisub" />
                                    </td>
                                    <td class="col-sm-3">
                                        <select name="indicator_id" id="indicator_id"  class="col-xs-12 col-sm-12 select2">
                                            <option value="">Pilih Indikator</option>
                                            @foreach ($iku as $item)
                                                <option value="{{$item->id}}">{{$item->indicator}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="col-sm-1">
                                        <input type="number" min="0" value="0" style="text-align: center"
                                            class="col-xs-12 col-sm-12" id="ikupersen-" onkeyup="hitung()"
                                            name="ikupersen" required />
                                        
                                        <br>
                                    </td>
                                    <td>
                                        <input type="number" min="0" style="text-align: center" value="0"
                                            class="col-xs-12 col-sm-12" readonly id="paguiku-"
                                            name="paguiku" required />
                                    </td>
                                    <td>
                                        <input type="number" min="0" style="text-align: center" value="0"
                                        class="col-xs-12 col-sm-12" readonly id="realisasiiku-"
                                        name="realisasiiku" required />
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                            <i class="glyphicon glyphicon-plus"></i></button>
                                        <input type="hidden" id="countRow" value="1">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>  
                    @endforeach   
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
                '<td></td>'+
                '<td></td>'+
                '<td></td>'+
                '<td>'+
                    '<select name="indicator_id" id="indicator_id"  class="col-xs-12 col-sm-12 select2">'+
                        '<option value="">Pilih Indikator</option>'+                
                            '@foreach ($iku as $item)'+
                                '<option value="{{$item->id}}">{{$item->indicator}}</option>'+
                            '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td class="col-sm-1">'+
                    '<input type="number" min="0" value="0" style="text-align: center" class="col-xs-12 col-sm-12" id="ikupersen-" onkeyup="hitung()" name="ikupersen" />'+
                '</td>'+
                '<td>'+
                    '<input type="number" min="0" style="text-align: center" value="0" class="col-xs-12 col-sm-12" readonly id="paguiku-" name="paguiku"/>'+
                '</td>'+
                '<td>'+
                    '<input type="number" min="0" style="text-align: center" value="0" class="col-xs-12 col-sm-12" readonly id="realisasiiku-" name="realisasiiku" />
                '</td>'+
            '</tr>'+
            '<tr>'+
                '<td>'+
                    '<button type="button" class="form-control btn-default" onclick="addBarisNew()">'+
                        '<i class="glyphicon glyphicon-plus"></i></button>'+
                    '<input type="hidden" id="countRow" value="1">'+
                '</td>'+
            '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
    }





    function hitung(i) {
        var a = $("#pagusub-"+i).val();
        var b = $("#realisasisub-"+i).val();
        var c = $("#ikupersen-"+i).val();

        var d = a*(b/100);
        var e = b*(b/100);

        var pagu = parseFloat(d).toFixed(2);
        var real = parseFloat(e).toFixed(2);
        $("#paguiku-"+i).val(pagu);
        $("#realisasiiku-"+i).val(real);
    }
    </script>
@endsection