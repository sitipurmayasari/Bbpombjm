@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li>Aduan Kerusakan - {{$divisi->nama}}</li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('aduan.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
            <th>No. Aduan</th>
            <th>Tanggal</th>
            <th>Pelapor</th>
            <th>Status</th>
            <th>Cetak</th>
            <th>Aksi</th>
        <thead>
        <tbody>   	
            @foreach($data as $key=>$row)
            <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td><a href="/invent/aduan/detail/{{$row->id}}">{{$row->no_aduan}}</a></td>
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
                    <a class="btn btn-primary" href="/invent/aduan/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">PENGAJUAN</a>
                </td>
                <td>
                    @if ($row->aduan_status==0)
                        <a href="/invent/aduan/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->no_aduan}}" 
                            r-id="{{$row->id}}">
                            <i class="glyphicon glyphicon-trash"></i></a>
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
                    window.location = "/invent/aduan/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection