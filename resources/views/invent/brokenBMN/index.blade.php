@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li>BA penyerahan BMN Rusak Berat</li>
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
                           <a href="{{Route('brokenBMN.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th class="col-md-4">Nama Pengaju</th>
                <th class="col-md-2">Bidang</th>
                <th class="col-md-1">Cetak</th>
                <th class="col-md-1">Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td style="text-align: center">{{$data->firstItem() + $key}}</td>
                    <td>{{$row->nomor}}</td>
                    <td>{{tgl_indo($row->tanggal)}}</td>
                    <td>{{$row->pegawai->name}}</td>
                    <td>{{$row->div->nama}}</td>
                    <td>
                        <a class="btn btn-primary" href="/invent/brokenBMN/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                    </td>
                    <td style="text-align: center">
                        <a href="/invent/brokenBMN/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                        r-name="BA tanggal {{$row->tanggal}}" 
                        r-id="{{$row->id}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
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
                   window.location = "/invent/brokenBMN/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
