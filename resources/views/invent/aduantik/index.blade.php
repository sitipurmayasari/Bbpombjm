@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li> Daftar Aduan TIK</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                            <a href="{{Route('aduantik.create2')}}"  class="btn btn-primary">Tambah Data</a>   
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="col-md-12">
    
    <button type="button"  class="btn btn-danger" onclick="getBaru()" id="new">
        <i class="ace-icon fa fa-check bigger-110"></i>Baru</button>
    <button type="button"  class="btn btn-danger" onclick="getLama()" id="old">
        <i class="ace-icon fa fa-check bigger-110"></i>Lama</button>

        <div id="lama">
            <div class="table-responsive">
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                        <th width="40px">No</th>
                        <th>No. Aduan</th>
                        <th>Tanggal</th>
                        <th>Pelapor</th>
                        <th>Status</th>
                        <th>Cetak</th>
                        <th>Hapus</th>
                    <thead>
                    <tbody>   	
                        @foreach($data as $key=>$row)
                        <tr>
                            <td>{{$data->firstItem() + $key}}</td>
                            <td><a href="/invent/aduantik/detail/{{$row->id}}">{{$row->no_aduan}}</a></td>
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
                                @if ($row->aduan_status==2)
                                <a class="btn btn-primary" href="/invent/aduantik/printhasil/{{$row->id}}" target="_blank" rel="noopener noreferrer">HASIL</a>
                                @else
                                    <a class="btn btn-primary" href="/invent/aduantik/print/{{$row->id}}" target="_blank" rel="noopener noreferrer">PENGAJUAN</a>
                                @endif
                            </td>
                            <td>
                                @if ($row->aduan_status==0)
                                <a href="/invent/aduantik/edit/{{$row->id}}" class="btn btn-warning">
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
                {{$data->appends(Request::all())->links()}}
            </div>
        </div>
        <div id="baru">
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
                        @foreach($data2 as $key=>$row2)
                        <tr>
                            <td>{{$data2->firstItem() + $key}}</td>
                            <td><a href="/invent/aduantik/detail2/{{$row2->id}}">{{$row2->no_aduan}}</a></td>
                            <td>{{$row2->tanggal}}</td>
                            <td>{{$row2->lapor->no_pegawai}}<br>{{$row2->lapor->name}}</td>
                            <td>@if ($row2->status==0)
                                    Belum Diperiksa
                                @elseif ($row2->status==1)
                                    Sedang Diproses
                                @else
                                    Selesai Diproses 
                                @endif
        
                            </td>
                            <td>
                                {{-- @if ($row2->status==2)
                                <a class="btn btn-primary" href="/invent/aduantik/printhasil2/{{$row2->id}}" target="_blank" rel="noopener noreferrer">HASIL</a>
                                @else --}}
                                    <a class="btn btn-primary" href="/invent/aduantik/print2/{{$row2->id}}" target="_blank" rel="noopener noreferrer">PENGAJUAN</a>
                                {{-- @endif --}}
                            </td>
                            <td>
                                @if ($row2->status==0)
                                <a href="/invent/aduantik/edit2/{{$row2->id}}" class="btn btn-warning">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                               
                                    <a href="#" class="btn btn-danger delete2"
                                        r-name="{{$row2->no_aduan}}" 
                                        r-id="{{$row2->id}}">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                 @endif
                            </td>
                        </tr>
                        @endforeach
                    <tbody>
                </table>
                {{$data2->appends(Request::all())->links()}}
            </div>
        </div>
</div>


@endsection

@section('footer')
<script>
     $().ready( function () {
        getBaru()
        $("#lama").hide();

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
                   window.location = "/invent/aduantik/delete/"+id;
                }
            });
        });

        $(".delete2").click(function() {
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
                   window.location = "/invent/aduantik/delete2/"+id;
                }
            });
        });

    } );

    function getBaru() {
        document.getElementById("new").classList.remove('btn-danger');  
        document.getElementById("new").classList.add('btn-success');

        document.getElementById("old").classList.remove('btn-success');
        document.getElementById("old").classList.add('btn-danger');

        $("#lama").hide();
        $("#baru").show()
             
    }

    function getLama() {
        document.getElementById("old").classList.remove('btn-danger');  
        document.getElementById("old").classList.add('btn-success');

        document.getElementById("new").classList.remove('btn-success');
        document.getElementById("new").classList.add('btn-danger');

        $("#lama").show();
        $("#baru").hide()
             
    }

</script>
@endsection