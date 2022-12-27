@extends('layouts.app')
@section('breadcrumb')
    <li>Persediaan</li>
    <li> Barang keluar</li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('barangkeluar.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th class="col-md-2">No. SBBK</th>
                <th class="col-md-2">Tanggal</th>
                <th class="col-md-4">Pengaju</th>
                <th>Status</th>
                <th class="col-md-1">Aksi</th>
                {{-- <th>Upload SBBK</th> --}}
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td style="text-align: center">{{$data->firstItem() + $key}}</td>
                    <td>{{$row->nomor}} </td>
                    <td>{{$row->tanggal}}</td>
                    <td>{{$row->pegawai->name}} ( {{$row->pegawai->divisi->nama}} )</td>
                    <td>
                        @if ($row->stat_aduan=='S')
                            DITERIMA GUDANG
                        @elseif ($row->stat_aduan=='A')
                            DITERIMA ATASAN LANGSUNG
                        @elseif ($row->stat_aduan=='T')
                            DITOLAK
                        @elseif ($row->stat_aduan=='D')
                            DITERIMA PENGAJU
                        @endif
                    </td>
                    <td>
                        @if ($row->stat_aduan=='D')
                            @if ($row->jenis != 'L')
                                <a class="btn btn-primary" href="/invent/atkrequest/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">
                                    CETAK <i class="glyphicon glyphicon-print"></i>
                                </a>
                            @else
                                <a class="btn btn-primary" href="/invent/labrequest/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">
                                    CETAK <i class="glyphicon glyphicon-print"></i>
                                </a>
                            @endif
                        @elseif ($row->stat_aduan=='A' || $row->stat_aduan=='S')
                            <a href="/invent/barangkeluar/edit/{{$row->id}}" class="btn btn-warning"> 
                                PROSES <i class="glyphicon glyphicon-edit"></i>
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

@section('footer')
<script>
    $().ready( function () {
    } );
</script>
@endsection
