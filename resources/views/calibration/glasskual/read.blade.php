@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.lab')
@section('breadcrumb')
    <li>Persediaan Lab</li>
    <li>Alat Gelas Kualitatif</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5" style="float: right">
                            <div class="input-group">
                                <input type="text" class="form-control gp-search" name="keyword" placeholder="Cari " value="{{request('keyword')}}" autocomplete="off">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                                    <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <div class="table-responsive">
        <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
                <th width="40px">No</th>
                <th>Kode Barang</th>
                <th>No. Katalog</th>
                <th class="col-md-4">Nama Barang</th>
                <th>Nama Lain / Sinonim</th>
                <th class="col-md-1">Stok</th>
                <th class="col-md-1">Qr Code</th>
                <th>Gambar</th>
                <th>Kartu Stok</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->kode_barang}}</td>
                    <td>{{$row->no_seri}}</td>
                    <td>{{$row->nama_barang}}</td>
                    <td>{{$row->sinonim}}</td>
                    <td> <a href="/calibration/glasskual/stockread/{{$row->id}}" class="btn btn-success">
                        @php
                            $total = $injectQuery->laststock($row->id)
                        @endphp
                        @if ($total != null)
                            {{$total->stock}}
                        @else
                            {{0}}
                        @endif
                    </a></td>
                    <td> <a href="/calibration/glasskual/qrcode/{{$row->id}}" class="btn btn-success">
                        <i class="glyphicon glyphicon-qrcode"></i>
                    </a></td>
                    <td>
                        <a class="btn btn-primary" href="/calibration/glasskual/viewimg/{{$row->id}}" target="_blank" rel="noopener noreferrer">LIHAT</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="/calibration/glasskual/kartustock/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                    </td>
                </tr>
              
                @endforeach
            <tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection
