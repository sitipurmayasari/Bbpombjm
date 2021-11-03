@extends('layouts.mon')
@inject('injectQuery', 'App\InjectQuery')
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
                <div class="panel-heading"><h3 class="panel-title">B. Tagging Anggaran {{$pagu->name}} 
                    ({{tgl_indo($pagu->tanggal)}})
                </h3></div>
                <div class="panel-body">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center">No</th>
                                <th rowspan="2" style="text-align: center" class="col-sm-3" >SubKomponen</th>
                                <th colspan="2" style="text-align: center">Pagu</th>
                                <th rowspan="2" style="text-align: center">Taging</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Pagu Akhir</th>
                                <th style="text-align: center">Realisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $row)
                                <tr>
                                    <td style="text-align: center">{{$no++}}</td>
                                    <td class="col-sm-2">
                                        <input type="text" value="{{$row->sub->kodeall}}" 
                                        class="col-xs-12 col-sm-12" readonly
                                        name="sub" />
                                        <input type="hidden" name="subocode_id" value="{{$row->pagu_id}}">
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
                                        @php
                                            $cek = $injectQuery->getTag($pagu->id,$row->subcode_id);
                                        @endphp
                                        @if ($cek != null)
                                            <a href="/finance/editagging/{{$pagu->id}}/{{$row->subcode_id}}" target="_blank" rel="noopener noreferrer">Ubah</a>
                                        @else
                                            <a href="/finance/addagging/{{$pagu->id}}/{{$row->subcode_id}}" target="_blank" rel="noopener noreferrer">Tambah</a>
                                        @endif
                                        
                                        
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>    
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