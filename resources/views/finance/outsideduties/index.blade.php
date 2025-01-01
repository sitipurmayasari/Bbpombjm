@extends('layouts.din')
@section('breadcrumb')
@section('breadcrumb')
    <li>Surat Tugas Versi 2</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('outsideduties.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
        {{-- <table id="simple-table" class="table  table-bordered table-hover datatable"> --}}
            <thead >
                <th style="text-align: center" width="40px">No</th>
                <th style="text-align: center" class="col-md-2">Nomor Surat Tugas</th>
                <th style="text-align: center">Nama Kegiatan</th>
                <th style="text-align: center">Destinasi</th>
                <th style="text-align: center">Cetak ST</th>
                <th style="text-align: center">Cetak SPPD</th>
                <th style="text-align: center">Aksi</th>
            </thead>
            <tbody>   	
                @php
                    $no=1;
                @endphp
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$row->number}}</td>
                    <td>{{$row->purpose}}</td>
                    <td>
                        @foreach ($row->outst_destiny as $item)
                            <li>{{$item->destiny->capital}}</li>
                        @endforeach
                    </td>
                    <td style="text-align: center">
                        <a class="btn btn-info" href="/finance/outsideduties/cetakST/{{$row->id}}" target="_blank" rel="noopener noreferrer">Tanpa KOP</a> <br>
                    </td>
                    <td style="text-align: center">
                        @if ($row->type=="LK")
                            <a class="btn btn-primary" href="/finance/outsideduties/printSppdD/{{$row->id}}" target="_blank" rel="noopener noreferrer">DEPAN</a>
                            <a class="btn btn-success" href="/finance/outsideduties/printSppdB/{{$row->id}}" target="_blank" rel="noopener noreferrer">BELAKANG</a>
                        @elseif($row->type=="DL8")
                            <a class="btn btn-primary" href="/finance/outsideduties/printSppdD/{{$row->id}}" target="_blank" rel="noopener noreferrer">DEPAN</a>
                            <a class="btn btn-success" href="/finance/outsideduties/printSppdB/{{$row->id}}" target="_blank" rel="noopener noreferrer">BELAKANG</a>
                            <a class="btn btn-primary" href="/finance/outsideduties/printSppd/{{$row->id}}" target="_blank" rel="noopener noreferrer">LANDSCAPE</a>
                        @elseif($row->type=="LN")
                            <a class="btn btn-primary" href="/finance/outsideduties/sppdEngD/{{$row->id}}" target="_blank" rel="noopener noreferrer">DEPAN</a>
                            <a class="btn btn-success" href="/finance/outsideduties/sppdEngB/{{$row->id}}" target="_blank" rel="noopener noreferrer">BELAKANG</a>
                        @else
                            <a class="btn btn-primary" href="/finance/outsideduties/printSppd/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                        @endif
                    </td>
                    <td>
                        <a href="/finance/outsideduties/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->number}}" 
                            r-id="{{$row->id}}">
                            <i class="glyphicon glyphicon-trash"></i></a>
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
                text: "Yakin ingin menghapus ST  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/finance/outsideduties/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
