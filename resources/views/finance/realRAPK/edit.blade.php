
@extends('layouts.mon')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>RAPK</li>
    <li><a href="/finance/realRAPK">Realisasi Capaian</a></li>
    <li>Ubah Data </li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
method="post" action="/finance/realRAPK/update/{{$data->id}}">
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Ubah RAPK tahun {{$data->years}} - {{$data->triwulan}}</h3></div>
       <div class="panel-body">
           <table  id="simple-table" class="table  table-bordered table-hover">
               <thead>
                    <tr>
                        <th style="text-align: center" >No</th>
                        <th style="text-align: center" >Indikator</th>
                        <th style="text-align: center" >Target Tahunan</th>
                        <th style="text-align: center" >Target {{$data->triwulan}}</th>
                        <th style="text-align: center">Realisasi {{$data->triwulan}}</th>
                        <th style="text-align: center">Hasil (%) {{$data->triwulan}}</th>
                        <th style="text-align: center">Hasil Tahunan (%) {{$data->triwulan}}</th>
                    </tr>
               </thead>
               <tbody>
                   @php
                       $no = 1;
                   @endphp
                    @foreach ($rapk as $key=>$row)
                        <tr>
                            <td style="text-align: center">{{$no}}</td>
                            <td>
                                <input type="hidden" name="id[]" value="{{$row->id}}">
                                <input type="hidden" name="indicator_id[]" value="{{$row->indicator_id}}">
                                {{$row->indi->indicator}}
                            </td>
                            <td>
                                @php
                                    $isi = $injectQuery->getRenstrakal($data->eselon->renstrakal_id,$data->years, $row->indicator_id);
                                @endphp
                                <input type="text" name="isi" readonly class="col-sm-10" value={{$isi->persentages}} id="renstra-{{$no}}">
                            </td>
                            <td>
                                @php
                                    $isi = $injectQuery->geteselontw($data->eselontwo_id, $row->indicator_id);

                                    if ($data->triwulan=="TWI") {
                                        $tw = $isi->twI;
                                    } else if ($data->triwulan=="TWI") {
                                        $tw = $isi->twII;
                                    } else if ($data->triwulan=="TWI") {
                                        $tw = $isi->twIII;
                                    } else {
                                        $tw = $isi->twIV;
                                    }
                                @endphp
                                <input type="text" name="isi" readonly class="col-sm-10" value={{$tw}} id="target-{{$no}}">
                            </td>
                            <td><input type="number" name="realisasi[]" value="{{$row->realisasi}}" step="0.01" class="col-sm-10" id="real-{{$no}}" onkeyup="hitung({{$no}})"></td>
                            <td><input type="number" name="hasil[]" value="{{$row->hasil}}" step="0.01" class="col-sm-10" id="hasil-{{$no}}" readonly></td>
                            <td><input type="number" name="hasiltahun[]" value="{{$row->hasiltahun}}" step="0.01" class="col-sm-10" id="hasiltahun-{{$no}}" readonly></td>
                            <input type="hidden" name="nps[]" value="{{$row->nps}}" step="0.01" class="col-sm-10" id="nps-{{$no}}" readonly>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    @endforeach
               </tbody>
           </table>
       </div>
   </div>
</div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>SIMPAN
        </button>
    </div>
</div>
</form>

@endsection

@section('footer')
<script>
    function hitung(i) {
        var a = $("#target-"+i).val();
        var b =  $("#real-"+i).val();
        var c = $("#renstra-"+i).val();

        var d = (b / a) * 100;
        var hasil = parseFloat(d).toFixed(2);
        $("#hasil-"+i).val(hasil);

        var e = (b / d) * 100;
        var hasiltahun = parseFloat(e).toFixed(2);
        $("#hasiltahun-"+i).val(hasiltahun);

        if (hasil <= 120) {
                $("#nps-"+i).val(hasil);
            } else {
                $("#nps-"+i).val(120);
            }

    }
</script>
@endsection