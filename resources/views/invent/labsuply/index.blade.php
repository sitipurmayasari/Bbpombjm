@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li>Persediaan Laboratorium</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('labsuply.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th class="col-md-2">Nama Barang</th>
                <th>Merk</th>
                <th>Lokasi</th>
                <th class="col-md-1">Stok</th>
                <th class="col-md-1">Qr Code</th>
                <th class="col-md-2">Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->nama_barang}}</td>
                    <td>{{$row->merk}}</td>
                    <td>{{$row->location->nama}}</td>
                    <td> <a href="/invent/labsuply/stock/{{$row->id}}" class="btn btn-success">
                        @php
                            $total = $injectQuery->laststock($row->id)
                        @endphp
                        @if ($total != null)
                            {{$total->stock}}
                        @else
                            {{0}}
                        @endif
                    </a></td>
                    <td> <a href="/invent/inventaris/qrcode/{{$row->id}}" class="btn btn-success">
                        <i class="glyphicon glyphicon-qrcode"></i>
                    </a></td>
                    <td>
                        <a href="/invent/labsuply/edit/{{$row->id}}" class="btn btn-warning">
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
                    window.location = "/invent/labsuply/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
