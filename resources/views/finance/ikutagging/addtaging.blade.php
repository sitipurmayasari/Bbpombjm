@extends('layouts.mon')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>Indikator Kinerja</li>
    <li><a href="/finance/ikutagging">Tagging Anggaran</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" method="post" enctype="multipart/form-data"
    action="{{route('ikutagging.store')}}" >
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">B. Tagging Anggaran {{$data->sub->kodeall}}</h3></div>
                <div class="panel-body">
                        <div class="col-md-4">
                            <label for="">PAGU Rp.</label>
                            <input type="number" id="pagusub" value="{{$data->pagusub}}" 
                                class="col-xs-12 col-sm-12" readonly
                                name="pagusub" />
                                <input type="hidden" value="{{$pagu->id}}" 
                                name="pagu_id" />
                                <input type="hidden" value="{{$data->subcode_id}}" 
                                 name="subcode_id" id="subcode_id/">
                        </div>
                        <div class="col-md-4">
                            <label for="">REALISASI Rp.</label>
                            <input type="number" value="{{$data->realisasisub}}"
                                class="col-xs-12 col-sm-12" readonly id="realisasisub"
                                name="realisasisub" />
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Indikator</h3>
        </div>
        <div class="panel-body">
           <div class="col-md-12">
            <table id="myTable" class="table table-bordered table-hover">
                <thead>
                    <th class="text-center col-md-5">Indikator</th>
                    <th class="text-center col-md-1">Persentase</th>
                    <th class="text-center col-md-3">Pagu Iku</th>
                    <th class="text-center col-md-3">Realisasi Iku</th>
                </thead>
                <tbody id="auto">
                    @php
                        $no = 1
                    @endphp
                    @foreach ($last as $daftar)
                        <tr id="{{$no}}">
                            <td>
                                <select name="indicator_id[]" id="indicator_id-{{$no}}"  class="col-xs-12 col-sm-12 select2">
                                    <option value="">Pilih Indikator</option>
                                        @foreach ($iku as $item)
                                            @if ($item->id == $daftar->indicator_id)
                                                <option value="{{$item->id}}" selected>{{$item->indicator}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->indicator}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" id="ikupersen-{{$no}}"  name="ikupersen[]" min="0" value={{$daftar->ikupersen}}  onkeyup="hitung(1)"  class="col-xs-12 col-sm-12 persen">
                            </td>
                            <td><input type="text" readonly id="paguiku-{{$no}}" name="paguiku[]" class="col-xs-12 col-sm-12 pagu"></td>
                            <td><input type="text" readonly id="realisasiiku-{{$no}}" name="realisasiiku[]" class="col-xs-12 col-sm-12 real"></td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    @endforeach
                <span id="row-new"></span>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                            <input type="hidden" id="countRow" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">TOTAL</td>
                        <td><input type="number" id="totalpersen" value="0" readonly></td>
                        <td><input type="number" id="totalpagu" value="0" readonly></td>
                        <td><input type="number" id="totalrealisasi" value="0" readonly></td>
                    </tr>
                </tfoot>
            </table>
           </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit" id="simpan">
            <i class="ace-icon fa fa-check bigger-110"></i>Simpan
        </button>
    </div>
</div>
</form>

@endsection
@section('footer')
<script>
     $().ready( function () {
        hitung(i);
    } );

    function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi =  '<tr id="cell-'+new_baris+'">'+
                '<td>'+
                    '<select name="indicator_id[]" id="indicator_id"  class="col-xs-12 col-sm-12 select2">'+
                        '<option value="">Pilih Indikator</option>'+                
                            '@foreach ($iku as $item)'+
                                '<option value="{{$item->id}}">{{$item->indicator}}</option>'+
                            '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<input type="number" min="0" value="0" class="col-xs-12 col-sm-12 persen" id="ikupersen-'+new_baris+'" onkeyup="hitung('+new_baris+')" name="ikupersen[]" />'+
                '</td>'+
                '<td>'+
                    '<input type="number" min="0" value="0" class="col-xs-12 col-sm-12 pagu" readonly id="paguiku-'+new_baris+'" name="paguiku[]"/>'+
                '</td>'+
                '<td>'+
                    '<input type="number" min="0" value="0" class="col-xs-12 col-sm-12 real" readonly id="realisasiiku-'+new_baris+'" name="realisasiiku[]" />'+
                '</td>'+
            '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
    }

    function hitung(i) {
        var a = $("#pagusub").val();
        var b = $("#realisasisub").val();
        var c = $("#ikupersen-"+i).val();

        var d = c*(a/100);
        var e = c*(b/100);

        var pagu = parseFloat(d).toFixed(2);
        var real = parseFloat(e).toFixed(2);
        $("#paguiku-"+i).val(pagu);
        $("#realisasiiku-"+i).val(real);

        var sumpersen=0;
        $(".persen").each(function(){
            if($(this).val() !== "")
            sumpersen += parseInt($(this).val());   
        });
        $("#totalpersen").val(sumpersen);

        var sumpagu=0;
        $(".pagu").each(function(){
            if($(this).val() !== "")
            sumpagu += parseInt($(this).val());   
        });
        $("#totalpagu").val(sumpagu);

        var sumreal=0;
        $(".real").each(function(){
            if($(this).val() !== "")
            sumreal += parseInt($(this).val());   
        });
        $("#totalrealisasi").val(sumreal);


        var balance = $("#totalpersen").val();
        if (balance !="100") {
            document.getElementById("simpan").disabled = true;
        } else {
            document.getElementById("simpan").disabled = false;
        }

    }


    // function getIndiPer(){
    //     var subcode_id = $("#subcode_id").val();

    //     $.get(
    //         "{{route('ikutagging.getdatalama')}}",
    //         {
    //             subcode_id:subcode_id
    //         },
    //         function(response) {
    //             var isi="";
    //             for (let i = 0; i < response.data.length; i++) {
    //               var no = i+1;

    //               isi+='<tr id="'+i+'">'+
    //                     '<td>'+
    //                         '<select name="indicator_id[]" id="indicator_id-1"  class="col-xs-12 col-sm-12 select2">'+
    //                             '<option value="">Pilih Indikator</option>'+
    //                             '@foreach ($iku as $item)'+
    //                                 '@if ($item->id=='+response.data[i].indicator_id+')'+
    //                                     '<option value="{{$item->id}}" selected>{{$item->indicator}}</option>'+
    //                                 '@else'+
    //                                     '<option value="{{$item->id}}">{{$item->indicator}}</option>'+
    //                                 '@endif'+
    //                             '@endforeach'+
    //                         '</select>'+   
    //                     '</td>'+
    //                     '<td>'+
    //                         '<input type="number" id="ikupersen-'+i+'"  name="ikupersen[]" min="0" onkeyup="hitung('+i+')" class="col-xs-12 col-sm-12 persen" value="'+response.data[i].ikupersen+'">'+
    //                     '</td>'+
    //                     '<td>'+
    //                         '<input type="text" readonly id="paguiku-'+i+'" name="paguiku[]" class="col-xs-12 col-sm-12 pagu" value="0">'+
    //                     '</td>'
    //                     '<td>'+
    //                         '<input type="text" readonly id="realisasiiku-'+i+'" name="realisasiiku[]" class="col-xs-12 col-sm-12 real" value="0"></td>'+
    //                     '</td>'
    //                 '</tr>';
    //             }
    //             $("#auto").html(isi);
    //         }
    //     );
    }
</script>
@endsection