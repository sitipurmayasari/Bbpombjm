@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Surat Izin</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('rekpermit.create')}}"  class="btn btn-primary">Buat Surat Izin</a>   
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
                <th width="40px" style="text-align: center">No</th>
                <th  class="col-sm-5" style="text-align: center">Judul</th>
                <th style="text-align: center">Kategori</th>
                <th style="text-align: center">Dari</th>
                <th style="text-align: center">Sampai</th>
                <th style="text-align: center">Edit</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->titles}}</td>
                    <td>{{$row->kategori->nama}}</td>
                    <td>{{$row->date_from}}</td>
                    <td>{{$row->date_to}}</td>
                    <td>
                        <a href="/amdk/rekpermit/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->titles}}" 
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
                    window.location = "/amdk/rekpermit/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection