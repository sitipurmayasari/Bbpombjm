@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
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
                <th class="col-md-4">Penerima</th>
                <th class="col-md-1">Cetak SBBK</th>
                <th class="col-md-1">Cetak SBB</th>
                <th>Upload SBBK</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td><a href="/invent/barangkeluar/edit/{{$row->id}}" >{{$row->nomor}}</a></td>
                    <td>{{$row->tanggal}}</td>
                    <td>{{$row->pegawai->no_pegawai}} || {{$row->pegawai->name}}</td>
                    <td>
                        <a class="btn btn-primary" href="/invent/barangkeluar/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                    </td>
                    <td>
                        @if ($row->jenis != 'L')
                            <a class="btn btn-primary" href="/invent/atkrequest/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                        @else
                        <a class="btn btn-primary" href="/invent/labrequest/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{$row->getFIleSbb()}}" target="_blank" >{{$row->file}}</a>
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
