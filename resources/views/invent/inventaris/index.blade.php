@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li> Data Inventaris</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('inventaris.create')}}"  class="btn btn-primary">Tambah Data</a>   
                        </div>
                        <div class="form-group col-xs-12 col-sm-5" style="float: right">
                            {{-- <select onchange="this.form.submit()" name="filter" 
                            id="filterKategori" class="form-control input-sm pull-right" style="width: 250px;">
                                <option value="">--Filter --</option>
                             </select> --}}
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
                <th class="col-md-2">Nama Barang</th>
                <th class="col-md-1">Merk</th>
                <th>Sisa Stok</th>
                <th>Lokasi</th>
                <th  class="col-md-2">Penanggung Jawab</th>
                <th>UserManual</th>
                <th>Troubleshouting</th>
                <th>IKA</th>
                <th>jadwal</th>
                <th>Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->nama_barang}}</td>
                    <td>{{$row->merk}}</td>
                    <td>{{$row->jumlah_barang}}</td>
                    <td>{{$row->location->nama}}</td>
                    <td>{{$row->penanggung->no_pegawai}}<br>{{$row->penanggung->name}}</td>
                    <td><a href="{{$row->getFIleUserManual()}}" target="_blank" >{{$row->file_user_manual}}</a></td>
                    <td><a href="{{$row->getFIleTrouble()}}" target="_blank" >{{$row->file_trouble}}</a></td>
                    <td><a href="{{$row->getFIleIka()}}" target="_blank" >{{$row->file_ika}}</a></td>
                    <td>
                        <a href="/inventaris/jadwal/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </a>
                    </td>
                    <td>
                        <a href="/invent/inventaris/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->nama}}" 
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
                    window.location = "/invent/inventaris/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
