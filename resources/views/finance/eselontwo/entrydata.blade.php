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
method="post" action="{{route('eselontwo.store')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Tambah PK Eselon II tahun {{$data->years}}</h3></div>
       <div class="panel-body">
           <table  id="simple-table" class="table  table-bordered table-hover">
               <thead>
                <tr>
                    <th rowspan="2" style="width: 40px;">No</th>
                    <th rowspan="2" style="width: 300px;">Indikator</th>
                    <th rowspan="2" style="width: 80px;">Target Renstra {{$data->years}} </th>
                    <th rowspan="2" style="width: 80px;">Target {{$data->years}} </th>
                    <th colspan="3">TRIWULAN I</th>
                    <th colspan="3">TRIWULAN II</th>
                    <th colspan="3">TRIWULAN III</th>
                    <th colspan="3">TRIWULAN IV</th>
                </tr>
                <tr>
                    <th style="width: 80px;" >Jan</th>
                    <th style="width: 80px;" >Feb</th>
                    <th style="width: 80px;" >Mar </th>
                    <th style="width: 80px;" >Apr</th>
                    <th style="width: 80px;" >Mei</th>
                    <th style="width: 80px;" >Jun</th>
                    <th style="width: 80px;" >Jul</th>
                    <th style="width: 80px;" >Aug</th>
                    <th style="width: 80px;" >Sep</th>
                    <th style="width: 80px;" >Oct</th>
                    <th style="width: 80px;" >Nov</th>
                    <th style="width: 80px;" >Dec</th>
                </tr>
               </thead>
               <tbody>
                   @php
                       $no = 1;
                   @endphp
                    @foreach ($indi as $key=>$row)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td>
                                <input type="hidden" name="eselontwo_id[]" value="{{$data->id}}">
                                <input type="hidden" name="indicator_id[]" value="{{$row->id}}">
                                {{$row->indicator}}
                            </td>
                            @php
                                $isi = $injectQuery->getRenstrakal($data->renstrakal_id, $data->years,$row->id);
                            @endphp
                            <td><input type="text" name="targetrens[]" readonly value="{{$isi->persentages}}"  class="form-control"></td>
                            <td><input type="text" name="setahun[]" value="0" step="0.1" class="col-sm-10"></td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="jan[]" >
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="feb[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="mar[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="apr[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="mei[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="jun[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="jul[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="aug[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="sep[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="oct[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="nov[]">
                            </td>
                            <td style="vertical-align:top;">
                                <input type="number" class="form-control" value="0" step="0.1" name="dec[]">
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
            <i class="ace-icon fa fa-check bigger-110"></i>SIMPAN
        </button>
    </div>
</div>
</form>

@endsection