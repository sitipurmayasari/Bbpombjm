@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Absensi Pramubakti</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-4" style="float: right">
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
                <th style="text-align: center">Nama</th>
                <th style="text-align: center">Periode</th>
                <th style="text-align: center">tipe</th>
                <th style="text-align: center">Jam Masuk</th>
                <th style="text-align: center">Jam Pulang</th>
                <th style="text-align: center">terlambat</th>
                <th style="text-align: center">Pulang Cepat</th>
                <th style="text-align: center">keterangan</th>
                <th style="text-align: center">poin</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->peg->name}}</td>
                    <td>{{tgl_indo($row->tanggal)}}</td>
                    <td>{{$row->tipe}}</td>
                    <td>{{$row->scan_masuk}}</td>
                    <td>{{$row->scan_pulang}}</td>
                    <td>{{$row->terlambat}}</td>
                    <td>{{$row->pulang_cepat}}</td>
                    <td>{{$row->status->ket}}</td>
                    <td>{{$row->poin}}</td>
                </tr>
              
                @endforeach
            <tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection
