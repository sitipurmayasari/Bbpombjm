@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li> Barang Rusak</li>
@endsection
@section('content')
<style>
    th{
        text-align: center;
        vertical-align: middle;
    }
</style>

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('broken.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th>No</th>
                <th class="col-md-2">Nomor</th>
                <th class="col-md-1">Tanggal</th>
                <th class="col-md-2">Laboratorium</th>
                <th class="col-md-4">Nama Barang</th>
                <th class="col-md-1">Cetak</th>
                {{-- <th class="col-md-1">Aksi</th> --}}
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td style="text-align: center">{{$data->firstItem() + $key}}</td>
                    <td>{{$row->nomor}}</td>
                    <td>{{$row->tanggal}}</td>
                    <td>
                       @if ($row->labory_id == 0)
                        Non Lab / Gudang
                       @else
                        {{$row->lab->name}}
                       @endif
                    </td>
                    <td>{{$row->barang->nama_barang}} - {{$row->barang->merk}}</td>
                    <td>
                        <a class="btn btn-primary" href="/invent/broken/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
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
