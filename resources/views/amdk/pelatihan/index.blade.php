@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Kompetensi Pegawai</li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-2" style="float: left">
                           <a href="{{Route('pelatihan.create')}}"  class="btn btn-primary">Tambah Data</a>   
                        </div>
                        <div class="form-group col-xs-12 col-sm-1" style="float: left">
                            <a href="{{Route('pelatihan.rekappeg')}}"  class="btn btn-primary">Cetak Rekapitulasi</a>   
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
                <th>Jenis</th>
                <th>Nama Kegiatan</th>
                <th>Penyelenggara</th>
                <th>Tanggal pelatihan</th>
                <th>Jumlah Jam</th>
                <th>Terekam di SIASN</th>
                <th>Sertifikat</th>
                <th>Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->jenis->name}}</td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->penyelenggara}}</td>
                    <td>{{$row->dari}} s/d  {{$row->sampai}} </td>
                    <td>{{$row->lama}}</td>
                    <td>
                        @if ($row->terekam=="Y")
                            Sudah
                        @else
                            Belum
                        @endif
                    </td>
                    <td><a href="{{$row->getFIleSert()}}" target="_blank" >{{$row->file}}</a></td>
                    <td>
                        <a href="/amdk/pelatihan/edit/{{$row->id}}" class="btn btn-warning">
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
                    window.location = "/amdk/pelatihan/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
