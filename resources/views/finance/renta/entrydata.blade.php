@extends('layouts.ren')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/renta">Rencana Target Tahunan</a></li>
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
method="post" action="{{route('renta.store')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="row">
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Rencana target per bulan</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                {{-- <div class="col-sm-12" > --}}
                    <table  class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 40px;">No</th>
                                <th rowspan="2" style="width: 300px;">Indikator</th>
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
                            @foreach ($detail as $item)
                            <tr>
                                <td>{{$no}}
                                    <input type="hidden"  name="renta_id[]" value="{{$data->id}}">
                                </td>
                                <td>{{$item->indi->indicator}}
                                    <input type="hidden"  name="indicator_id[]" value="{{$item->indicator_id}}">
                                </td>
                                <td>
                                    <input type="hidden" name="renstrakal_detail_id[]" value="{{$item->id}}">
                                    <input type="text"  class="form-control" style="text-align:center;"  name="setahun[]" value="{{$item->persentages}}" readonly>
                                </td>
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
                            @php
                                $no++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
               {{-- </div> --}}
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
</div>
</form>



@endsection