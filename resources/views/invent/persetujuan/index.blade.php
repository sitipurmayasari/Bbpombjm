@extends('layouts.app')
@section('breadcrumb')
    <li>Persetujuan</li>
    <li> Daftar persetujuan Barang Baru</li>
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
                <th>No. persetujuan</th>
                <th>Tanggal</th>
                <th>Kelompok Barang</th>
                <th>Status</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->no_ajuan}}</td>
                    <td>{{$row->tgl_ajuan}}</td>
                    <td>{{$row->kelompok}}</td>
                    <td>@if ($row->status==0)
                            <a class="btn btn-primary" href="/invent/persetujuan/edit/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">Menunggu</a>
                        @else 
                            <a class="btn btn-success" href="/invent/persetujuan/edit/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">Selesai</a>
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
</script>
@endsection