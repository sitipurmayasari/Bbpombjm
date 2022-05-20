@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li> Daftar Aduan TIK</li>
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
                <th>No. Aduan</th>
                <th>Tanggal</th>
                <th>Pelapor</th>
                <th>Status</th>
                <th>Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td><a href="/invent/aduantik/detail/{{$row->id}}">{{$row->no_aduan}}</a></td>
                    <td>{{$row->tanggal}}</td>
                    <td>{{$row->lapor->no_pegawai}}<br>{{$row->lapor->name}}</td>
                    <td>@if ($row->aduan_status==0)
                            Belum Diperiksa
                        @elseif ($row->aduan_status==1)
                            Sedang Diproses
                        @else
                            Selesai Diproses 
                        @endif

                    </td>
                    <td>
                        <a class="btn btn-primary" href="/invent/aduantik/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">PENGAJUAN</a>
                        {{-- @if ($row->aduan_status==2)
                            <a class="btn btn-primary" href="/invent/aduantik/printhasil/{{$row->id}}" target="_blank" rel="noopener noreferrer">HASIL</a>
                        @endif --}}
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