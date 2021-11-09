@extends('layouts.mon')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/renstranas">Renstra Nasional</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/renstranas/update/{{$data->id}}">
{{ csrf_field() }}
<div class="col-sm-12">
    @foreach ($renstra as $item)
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title"> Tambah Renstra Nasional Tahun {{$item->years}}</h4>
            <div class="widget-toolbar">
                <a href="#" data-action="collapse">
                    <i class="ace-icon fa fa-chevron-down"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main no-padding">  
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center">No</th>
                            <th style="text-align: center">Indikator</th>
                            <th style="text-align: center">Target</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($indi as $key=>$row)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td>
                                <input type="hidden" name="indicator_id[]" value="{{$row->id}}">
                                <input type="hidden" name="years[]" value="{{$item->years}}">
                                <input type="hidden" name="renstranas_id[]" value="{{$data->id}}">
                                {{$row->indicator}}
                            </td>
                            <td>
                                @php
                                    $isi = $injectQuery->getRenstra($data->id,$item->years,$row->id);
                                @endphp
                                <input type="hidden" name="id[]" value="{{$isi->id}}">
                                <input type="number" name="persentages[]" value={{$isi->persentages}} step="0.01">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>  
        </div>
    </div>
    @endforeach
    
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