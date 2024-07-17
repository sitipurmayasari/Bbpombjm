@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Rotasi / Mutasi Pegawai</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('rotasi.create')}}"  class="btn btn-primary">Tambah Pegawai</a>   
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
                <th width="40px">No</th>
                <th>Tanggal Penempatan</th>
                <th>Nama</th>
                <th>Asal</th>
                <th>Status</th>
            <thead>
            <tbody>
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{tgl_indo($row->placementDate)}}</td>
                    <td>
                        {{$row->old}} ke <br>
                        {{$row->new}}
                    </td>
                    <td>
                        {{$row->pegawai->name}} <br>
                        NIP. {{$row->pegawai->no_pegawai}}
                    </td>
                    <td>
                        @if ($row->stats=='N')
                            <a href="/amdk/rotasi/evaluation/{{$row->id}}" class="btn btn-warning">Belum Di Evaluasi
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        @else
                            <a href="/amdk/rotasi/cetak/{{$row->id}}" class="btn btn-success" target="_blank" >Telah Dievaluasi
                                <i class="glyphicon glyphicon-print"></i>
                            </a>
                        @endif
                    </td>
                </tr>
              
                @endforeach
            <tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection
