@extends('layouts.app')
@section('breadcrumb')
    <li>Persetujuan</li>
    <li>Daftar Permintaan Barang Lab</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
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
                <th class="col-md-2">No. Ajuan</th>
                <th class="col-md-2">Tanggal</th>
                <th class="col-md-4">Pengaju</th>
                {{-- <th class="col-md-4">daftar</th> --}}
                <th>Status</th>
            </head>
            <tbody>   	
                @if ($data != null)	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->nomor}}</td>
                    <td>{{tgl_indo($row->tanggal)}}</td>
                    <td>{{$row->pegawai->name}} ({{$row->pegawai->divisi->nama}})</td>
                    {{-- <td>
                        @if ($row->stat_aduan == 'S')
                            @foreach ($row->isi as $item)
                                <li>{{$item->barang->nama_barang}} 
                                    (
                                      @if ($item->status != 'Y')
                                          <b>ditolak</b>
                                      @else
                                          <b>disetujui</b>
                                      @endif  
                                    )
                                </li>
                            @endforeach
                        @endif
                    </td> --}}
                    <td>
                        @if ($row->stat_aduan == 'B')
                            <a href="/invent/labrequestok/yes/{{$row->id}}" class="btn btn-warning">
                                Lakukan Persetujuan
                            </a>
                        @else
                            <a href="#" class="btn btn-danger">Selesai</a>
                        @endif
                </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" style="text-align: center"> Tidak ada permintaan persetujuan</td>
                </tr>
                @endif
              
               
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
