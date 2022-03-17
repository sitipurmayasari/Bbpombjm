@extends('layouts.mon')
@section('breadcrumb')
@section('breadcrumb')
    <li>Biaya Perjalanan Dinas</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('travelexpenses.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th>Tanggal Pengeluaran</th>
                <th class="col-md-2">Nomor Surat Tugas</th>
                <th>Nama Kegiatan</th>
                <th>Cetak Kuitansi</th>
                <th>Cetak Riil</th>
                <th>Cetak Surat Pernyataan</th>
                <th>File</th>
                <th  class="col-md-2">Aksi</th>
            </thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->date}}</td>
                    <td>{{$row->st->number}}</td>
                    <td>{{$row->st->purpose}}</td>
                    <td>
                        <a class="btn btn-primary" href="/finance/travelexpenses/receipt/{{$row->id}}" target="_blank" 
                            rel="noopener noreferrer">Kuitansi</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="/finance/travelexpenses/riil/{{$row->id}}" target="_blank" 
                            rel="noopener noreferrer">Riil</a>
                    </td>
                    <td style="text-align: center">
                        <a class="btn btn-primary" href="/finance/travelexpenses/super/{{$row->id}}" target="_blank" 
                            rel="noopener noreferrer">SuPer</a> <br>
                        <a class="btn btn-warning" href="/finance/travelexpenses/super30/{{$row->id}}" target="_blank" 
                            rel="noopener noreferrer">SuPer30%</a>
                        @if ($row->st->type == 'DL8')
                            <a class="btn btn-success" href="/finance/travelexpenses/super8J/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">SuPer>8Jam</a>
                        @endif
                    </td>
                    <td>
                        @foreach ($row->filess as $item)
                            <li><a href="{{$item->getFIleReceipt()}}" target="_blank" >{{$item->file}}</a></li>
                        @endforeach
                    </td>
                    <td>
                        <a href="/finance/travelexpenses/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                                r-name="{{$row->st->number}}" 
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
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/finance/travelexpenses/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
