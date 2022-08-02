@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Arsiparis</li>
    <li>Arsip {{$div->nama}}</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        {{-- @if (auth()->user()->divisi_id == $div->id) --}}
                            <div class="form-group col-xs-12 col-sm-3" style="float: left">
                                <a href="/arsip/archives/create/{{$div->id}}"  class="btn btn-primary">Tambah Data</a> 
                            </div>
                        {{-- @endif --}}
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
                <th>Klasifikasi</th>
                <th>Uraian Berkas</th>
                <th>Nama Dokumen</th>
                <th>Tanggal</th>
                <th>Klasifikasi Keamanan</th>
                <th>Akses Internal</th>
                <th>Akses Eksternal</th>
                <th>File</th>
                <th>Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->alias}}</td>
                    <td>{{$row->uraian_berkas}}</td>
                    <td>{{$row->uraian}}</td>
                    <td>{{$row->date}}</td>
                    <td>
                        @if ($row->klas->securitiesklas == 'B')
                            Biasa / Terbuka
                        @elseif($row->klas->securitiesklas == 'T')
                            Terbatas
                        @elseif($row->klas->securitiesklas == 'R')
                            Rahasia
                        @else
                            Sangat Rahasia
                        @endif
                    </td>
                    <td>{{$row->klas->internal}}
                    </td>
                    <td>{{$row->klas->eksternal}}</td>
                    <td><a href="{{$row->getFIlearsip()}}" target="_blank" >{{$row->file}}</a></td>
                    <td>
                        @if (auth()->user()->divisi_id == $div->id)
                            @if ($row->hari_ini < $row->batas_aktif)
                                <a href="/arsip/archives/edit/{{$div->id}}/{{$row->id}}" class="btn btn-warning">
                                    <i class="glyphicon glyphicon-edit"></i>
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
        $(".delete").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/arsip/archives/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
