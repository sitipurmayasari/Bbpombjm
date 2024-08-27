@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>SURAT MASUK / Disposisi </li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('disposisi.create')}}"  class="btn btn-primary">Buat Surat Masuk</a>   
                        </div>
                        <div class="form-group col-xs-12 col-sm-1" style="float: left">
                            <a href="{{Route('disposisi.rekap')}}"  class="btn btn-primary">Cetak Rekapitulasi</a>   
                         </div>
                        <div class="form-group col-xs-12 col-sm-3" style="float: right">
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
                <th>No. Disposisi</th>
                <th>No. Surat</th>
                <th>Asal Surat</th>
                <th>Hal</th>
                <th>Tujuan Disposisi</th>
                <th>File</th>
                <th>Edit</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->tanggal}}</td>
                    <td>{{$row->no_agenda}}</td>
                    <td>{{$row->no_surat}}</td>
                    <td>{{$row->pengirim}}</td>
                    <td>{{$row->hal}}</td>
                    <td>
                        @if ($row->divisi_id != null)
                         {{$row->div->nama}}
                        @endif
                    </td>
                    <td>
                        <a href="{{$data->getfileDispo()}}" target="_blank" >{{$data->file}}</a>
                    </td>
                    <td>
                        <a href="/arsip/disposisi/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->judul}}" 
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
                var jenis = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+jenis+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/arsip/disposisi/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection