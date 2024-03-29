@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Log User</li>
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
                <th>Tanggal - Waktu</th>
                <th>Nama Pegawai</th>
                <th>Aksi</th>
                <th>IP ADRESSS</th>
                <th>Agent</th>
            <thead>
            <tbody>   	
                @foreach ($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->created_at}}</td>
                    <td>{{$row->peg->name}} || 
                        @if ($row->peg->golongan_id != null)
                            {{$row->peg->no_pegawai}}
                        @endif</td>
                    <td>{{$row->subject}}</td>
                    <td>{{$row->ip}}</td>
                    <td>{{$row->agent}}</td>
                </tr>
                @endforeach
            <tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection