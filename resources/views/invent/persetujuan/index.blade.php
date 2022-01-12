@extends('layouts.app')
@section('breadcrumb')
    <li>Pengajuan</li>
    <li> Daftar Pengajuan Barang</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                            <a href="{{Route('pengajuan.create')}}"  class="btn btn-primary">Tambah Data</a>   
                         </div>
                        <div class="form-group col-xs-12 col-sm-3" style="float: right">
                            <div class="input-group">
                                <input type="text" class="form-control gp-search" name="keyword" placeholder="Cari " value="" autocomplete="off">
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
                <th>No. Pengajuan</th>
                <th>Tanggal</th>
                <th>Kelompok Barang</th>
                <th>Status</th>
                <th>Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->no_ajuan}}</td>
                    <td>{{$row->tgl_ajuan}}</td>
                    <td>{{$row->kelompok}}</td>
                    <td>@if ($row->status==0)
                            Menunggu
                        @elseif($row->status==1)
                            Pengecekkan
                        @else 
                            Selesai
                        @endif

                    </td>
                    <td>
                        <a class="btn btn-primary" href="/invent/pengajuan/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
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
</script>
@endsection