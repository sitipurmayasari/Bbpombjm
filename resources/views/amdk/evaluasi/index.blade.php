@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Evaluasi Pelatihan</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: right">
                            <div class="input-group">
                                <input type="text" class="form-control gp-search" name="keyword" placeholder="Cari" value="{{request('keyword')}}"  autocomplete="off">
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
                <th>Nama Pegawai</th>
                <th>Nama Kegiatan</th>
                <th>Jenis</th>
                <th>Tanggal pelatihan</th>
                <th>Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->user->name}} ({{$row->user->no_pegawai}})</td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->jenis->name}}</td>
                    <td>{{$row->dari}} s/d  {{$row->sampai}} </td>
                    <td>
                        @if ($row->evaluasi == 'Y')
                            <a href="/amdk/pelatihan/hasilverif/{{$row->id}}" target="_blank" class="btn btn-success pill">
                                <i class="glyphicon glyphicon-print" target="_blank"></i> Cetak
                            </a>
                        @elseif($row->evaluasi == 'D')
                            <a href="/amdk/evaluasi/proses/{{$row->id}}" class="btn btn-warning pill">
                                <i class="glyphicon glyphicon-edit" target="_blank"></i> Verifikasi
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