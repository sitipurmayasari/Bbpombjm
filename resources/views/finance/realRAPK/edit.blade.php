
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
                        <th style="text-align: center" >Target {{$data->triwulan}}</th>
                        <th style="text-align: center">Realisasi {{$data->triwulan}}</th>
                    </tr>
               </thead>
               <tbody>
                   @php
                       $no = 1;
                   @endphp
                    @foreach ($rapk as $key=>$row)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td>
                                <input type="hidden" name="indicator_id[]" value="{{$row->indicator_id}}">
                                {{$row->indi->indicator}}
                            </td>
                            @php
                                $isi = $injectQuery->geteselontw($data->years, $row->indicator_id);

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
                            <input type="hidden" name="id[]" readonly  class="col-sm-10" value={{$row->id}}>
                            <input type="hidden" name="eselontwo_id[]" readonly  class="col-sm-10" value={{$row->eselontwo_id}}>
                            <td><input type="text" name="isi" readonly class="col-sm-10" value={{$tw}}></td>
                            <td><input type="number" name="realisasi[]" value="{{$row->realisasi}}" step="0.01" class="col-sm-10" ></td>
                        </tr>
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