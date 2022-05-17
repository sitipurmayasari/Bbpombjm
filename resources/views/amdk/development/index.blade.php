@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>SiKeren</li>
    <li>kegiatan Pengembangan</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('development.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Penilai</th>
                <th>Lampiran SKP</th>
                <th>Penilai Kegiatan</th>
                <th>Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    {{-- <td>{{$data->firstItem() + $key}}</td>
                    <td>{{tgl_indo($row->plan_date)}}</td>
                    <td>{{$row->skp->peg->name}} <br> (SKP tgl : {{tgl_indo($row->skp->dates)}})</td>
                    <td>{{$row->skp->jab->nama}}</td>
                    <td>{{$row->skp->pejabat->user->name}}</td>
                    <td>
                        <a class="btn btn-primary" href="/amdk/development/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="/amdk/development/print2/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                    </td>
                    <td>
                        <a href="/amdk/development/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->uraian}}" 
                            r-id="{{$row->id}}">
                            <i class="glyphicon glyphicon-trash"></i></a>
                    </td> --}}
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
                text: "Yplanningin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/amdk/development/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
