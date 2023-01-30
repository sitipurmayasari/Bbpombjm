@extends('layouts.ren')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>Perjanjian Kinerja</li>
    <li><a href="/finance/eselontwo">PK Eselon II</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<style>
    th{
        text-align: center;
        font-weight: bold;
    }

    .scrollit{
        overflow: auto;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>

<form class="form-horizontal validate-form" role="form" 
method="post" action="/finance/eselontwo/update/{{$data->id}}">
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Tambah PK Eselon II tahun {{$data->years}}</h3></div>
       <div class="panel-body">
           <table  id="simple-table" class="table  table-bordered table-hover">
               <thead>
                    <tr>
                        <th style="text-align: center" rowspan="2">No</th>
                        <th style="text-align: center" rowspan="2" >Indikator</th>
                        <th rowspan="2" style="text-align: center">Target<br>Renstra<br>{{$data->years}} </th>
                        <th rowspan="2" style="text-align: center">Target<br>{{$data->years}} </th>
                        <th colspan="3">TRIWULAN I</th>
                        <th colspan="3">TRIWULAN II</th>
                        <th colspan="3">TRIWULAN III</th>
                        <th colspan="3">TRIWULAN IV</th>
                    </tr>
                    <tr>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>Mei</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                    </tr>
               </thead>
               <tbody>
                   @php
                       $no = 1;
                   @endphp
                    @foreach ($ese as $key=>$row)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td>
                                <input type="hidden" name="id[]" value="{{$row->id}}">
                                <input type="hidden" name="eselontwo_id[]" value="{{$row->eselontwo_id}}">
                                <input type="hidden" name="indicator_id[]" value="{{$row->indicator_id}}">
                                {{$row->indi->indicator}}
                            </td>
                            @php
                                $isi = $injectQuery->getRenstrakal($data->renstrakal_id, $data->years,$row->indicator_id);
                            @endphp
                            <td><input type="text" name="target[]" readonly value="{{$isi->persentages}}" class="form-control"></td>
                            <td><input type="text" name="setahun[]" value="{{$row->setahun}}" step="0.1" class="form-control"></td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->jan}}" step="0.1" name="jan[]" >
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->feb}}" step="0.1" name="feb[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->mar}}" step="0.1" name="mar[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->apr}}" step="0.1" name="apr[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->mei}}" step="0.1" name="mei[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->jun}}" step="0.1" name="jun[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->jul}}" step="0.1" name="jul[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->aug}}" step="0.1" name="aug[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->sep}}" step="0.1" name="sep[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->oct}}" step="0.1" name="oct[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->nov}}" step="0.1" name="nov[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="{{$row->dec}}" step="0.1" name="dec[]">
                            </td>
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
            <i class="ace-icon fa fa-check bigger-110"></i>UPDATE
        </button>
    </div>
</div>
</form>

@endsection