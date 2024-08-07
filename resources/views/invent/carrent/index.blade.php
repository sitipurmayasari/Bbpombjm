@extends('layouts.app')
@section('breadcrumb')
    <li>Kendaraan</li>
    <li>Peminjaman Kendaraan Dinas</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('carrent.create')}}"  class="btn btn-primary">Tambah Data</a>   
                           <a class="btn btn-default" href="/calendars" target="_blank" rel="noopener noreferrer">Cek Ketersediaan</a>
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
                <th>Kode Peminjaman</th>
                <th>Tanggal Peminjaman</th>
                <th>Tujuan</th>
                <th>Kendaraan Dinas</th>
                <th>Supir</th>
                <th>Status</th>
                <th>Aksi</th>
            </head>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->code}}</td>
                    <td style="text-align: center">
                        {{tgl_indo($row->date_from)}} <br> s/d <br> {{tgl_indo($row->date_to)}}
                    </td>
                    <td>
                        {{$row->destination}}
                    </td>
                    <td>
                        @if ($row->status=='Y')
                            {{$row->car->merk}} - {{$row->car->police_number}}
                        @endif
                    </td>
                    <td>
                        @if ($row->driver_id != null)
                            {{$row->supir->name}}
                        @else
                             -
                        @endif
                    </td>
                    <td>
                        @if($row->status == 'N')
                            <a href="#" class="btn btn-danger">Ditolak</a>
                        @elseif($row->status == 'Y')
                            <a class="btn btn-success" href="/invent/carrent/edit/{{$row->id}}" target="_blank" rel="noopener noreferrer">Diterima</a>
                        @else
                            <a href="#" class="btn btn-primary">Menunggu</a>
                        @endif
                    </td>
                    <td>
                        @if ($row->status == 'Y')
                            {{ "" }}
                        @elseif ($row->status == 'N')
                            {{ "" }}
                        @else
                            <a href="/invent/carrent/ubah/{{$row->id}}" class="btn btn-warning">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger delete"
                                r-name="{{$row->destination}}" 
                                r-id="{{$row->id}}">
                                <i class="glyphicon glyphicon-trash"></i></a>
                        @endif
                    </td>
                </tr>
              
                @endforeach
            </tbody>
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
                    window.location = "/invent/carrent/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
