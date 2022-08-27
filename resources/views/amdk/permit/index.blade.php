@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Surat Izin Pramubakti {{auth()->user()->name}}</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6" style="float: left">
                           <a href="{{Route('permit.create')}}"  class="btn btn-primary">Download Format Surat Izin</a>         
                        </div>
                        <div class="form-group col-xs-12 col-sm-3" style="float: right">
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
                <th width="40px" style="text-align: center">No</th>
                <th style="text-align: center">Tanggal</th>
                <th style="text-align: center">Scan Masuk</th>
                <th style="text-align: center">Scan Pulang</th>
                <th style="text-align: center">Terlambat</th>
                <th style="text-align: center">Pulang Cepat</th>
                <th style="text-align: center">Keterangan</th>
                <th style="text-align: center">Poin</th>
                <th style="text-align: center">Data dukung</th> 
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{tgl_indo($row->tanggal)}}</td>
                    <td>{{$row->scan_masuk}}</td>
                    <td>{{$row->scan_pulang}}</td>
                    <td>{{$row->terlambat}}</td>
                    <td>{{$row->pulang_cepat}}</td>
                    <td>{{$row->keterangan}}</td>
                    <td>{{$row->poin}}</td>
                    <td>
                        <a href="/amdk/permit/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                    </td>
                </tr>
              
                @endforeach
            <tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection