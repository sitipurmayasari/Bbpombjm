@extends('layouts.ren')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/renstrakal">Renstra Balai</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
method="post" action="{{route('renstrakal.store')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="col-sm-12">
    @php
        $tahun = $data->yearfrom;
       
    @endphp
    
    @for ($i=0; $i <= $data->yearto - $data->yearfrom;$i++)
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title"> Tambah Renstra Balai Tahun {{$tahun}}</h4>
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
                            <th style="text-align: center">Target Nasional</th>
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
                                <input type="hidden" name="years[]" value="{{$tahun}}">
                                <input type="hidden" name="renstrakal_id[]" value="{{$data->id}}">
                                {{$row->indicator}}
                            </td>
                            @php
                                $isi = $injectQuery->getNasional($tahun,$row->id);
                            @endphp
                        <td><input type="text" name="targetnas[]" readonly value="{{$isi->persentages}}"></td>
                        {{-- <td><input type="text" name="targetnas[]" readonly value=""></td> --}}
                        <td><input type="number" name="persentages[]" value="0" step="0.01"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>  
        </div>
    </div>
    @php
        $tahun++;
    @endphp
    @endfor
    
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