@extends('layouts.app')
@section('breadcrumb')
    <li>Persediaan</li>
    <li>Permintaan Persediaan Lab</li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('labrequest.create')}}"  class="btn btn-primary">Tambah Data</a>   
                        </div>
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
                <th class="col-md-1">No</th>
                <th class="col-md-2">No. Ajuan</th>
                <th class="col-md-2">Tanggal</th>
                <th class="col-md-4">Pengaju</th>
                <th class="col-md-1">Status</th>
                <th class="col-md-1">Diterima</th>
                <th class="col-md-1">Cetak</th>
            <thead>
            <tbody>  
                 	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->nomor}}</td>
                    <td>{{$row->tanggal}}</td>
                    <td>{{$row->pegawai->no_pegawai}} || {{$row->pegawai->name}}</td>
                    <td>
                        @if ($row->stat_aduan=="B")
                            <a href="/invent/atkrequest/ubah/{{$row->id}}" class="btn btn-warning"> Ubah
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        @elseif($row->stat_aduan=="D")
                            <span id="selesai" class="badge badge-pill badge-secondary">Selesai</span>
                        @elseif($row->stat_aduan=="T")
                            <span id="selesai" class="badge badge-pill badge-danger">Ditolak</span>
                        @elseif($row->stat_aduan=="S")
                            <span id="selesai" class="badge badge-pill badge-success">Disetujui</span>
                        @else
                            <span id="selesai" class="badge badge-pill badge-secondary">Mengetahui</span>
                        @endif
                    </td>
                    <td>
                        @if ($row->stat_aduan=="S")
                            <form class="form-horizontal validate-form" role="form" 
                                method="post" action="/invent/atkrequest/updatestat/{{$row->id}}" >
                                {{ csrf_field() }}
                                <input type="text" hidden value="D" name="stat_aduan">
                                <input type="hidden" name="tgl_terima" id="" value="{{date('Y-m-d')}}">
                                <button class="btn btn-success btn-sm " type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>Diterima
                                </button>
                            </form>
                        @elseif ($row->stat_aduan=="D")
                            <span id="selesai" class="badge badge-pill badge-success">Diterima</span>
                        @endif
                    </td>
                    <td>
                        @if ($row->stat_aduan=='D')
                            @if ($row->mengetahui_id != null)
                                <a class="btn btn-primary" href="/invent/atkrequest/print2/{{$row->id}}" target="_blank" rel="noopener noreferrer">
                                    CETAK <i class="glyphicon glyphicon-print"></i>
                                </a>
                                @else
                                <a class="btn btn-primary" href="/invent/atkrequest/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">
                                    CETAK <i class="glyphicon glyphicon-print"></i>
                                </a>
                            @endif
                        @endif
                    </td>
                </tr>
              
                @endforeach
            <tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection

@section('footer')
<script>
    $().ready( function () {
    } );
</script>
@endsection
