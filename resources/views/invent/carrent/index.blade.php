@extends('layouts.app')
@section('breadcrumb')
    <li>Kendaraan</li>
    <li>Peminjaman Kendaraan Dinas</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('carrent.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th width="40px">No</th>
                <th>Kode Peminjaman</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Tujuan</th>
                <th>Kendaraan Dinas</th>
                <th>Supir</th>
                <th>Aksi</th>
            </head>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->code}}</td>
                    <td>
                        {{$row->pegawai->name}} <br>
                        @if ($row->pegawai->subdivisi_id != null)
                            {{$row->pegawai->divisi->nama}} - {{$row->pegawai->subdivisi->nama_subdiv}}
                        @else
                            {{$row->pegawai->divisi->nama}}
                        @endif
                    </td>
                    <td>
                        {{$row->date_from}} s/d {{$row->date_to}}
                    </td>
                    <td>
                        {{$row->destination}}
                    </td>
                    <td>
                        @if ($row->status=='Y')
                            {{$row->car->merk}} - {{$row->car->police_number}}
                        @endif
                    </td>
                    <td>
                        @if ($row->status =='Y')
                            @if ($row->driver_id != null)
                                {{$row->supir->name}}
                            @else
                                -
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($row->status == null)
                            <a href="/invent/carrent/edit/{{$row->id}}" class="btn btn-warning">
                                Lakukan Persetujuan
                            </a>
                        @elseif($row->status == 'N')
                            <a href="#" class="btn btn-danger">Ditolak</a>
                        @else 
                            <a href="#" class="btn btn-success">Diterima</a>
                        @endif

                </td>
                </tr>
              
                @endforeach
            </tbody>
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
