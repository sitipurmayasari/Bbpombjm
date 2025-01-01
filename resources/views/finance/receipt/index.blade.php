@extends('layouts.din')
@section('breadcrumb')
@section('breadcrumb')
    <li>Biaya Perjalanan Dinas Ver 2</i></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('receipt.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
        <p style="text-align: right;"><b>*Diprint Dengan kertas F4</b></p>
        <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
                <th width="40px" style="text-align: center">No</th>
                <th style="text-align: center">Tanggal Kuitansi</th>
                <th style="text-align: center" class="col-md-2">Nomor Surat Tugas</th>
                <th style="text-align: center">Nama Kegiatan</th>
                <th style="text-align: center">Kuitansi</th>
                <th style="text-align: center">Riil & KKP</th>
                <th style="text-align: center">Surat Pernyataan</th>
                <th>Aksi</th>
            </thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td style="text-align: center">{{$data->firstItem() + $key}}</td>
                    <td>{{$row->date}}</td>
                    <td>{{$row->st->number}}</td>
                    <td>{{$row->st->purpose}}</td>
                    @if ($row->st->budget_id == 21)
                        <td colspan="3" style="text-align: center">
                            <a class="btn btn-danger agr" href="/finance/outstation/edit/{{$row->id}}"
                            rel="noopener noreferrer">Non Anggaran</a>
                            <br>
                            *Silahkan Cek Kembali Surat Tugas Anda 
                        </td>
                    @else
                        <td style="text-align: center">
                            <a class="btn btn-primary agr" href="/finance/receipt/cost/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">Kuitansi</a>
                            <a class="btn btn-warning agr" href="/finance/receipt/nominatif/{{$row->id}}" target="_blank" 
                                    rel="noopener noreferrer">Nominatif</a>
                        </td>
                        <td style="text-align: center">
                            <a class="btn btn-primary agr" href="/finance/receipt/riil/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">Riil</a>
                            <a class="btn btn-warning agr" href="/finance/receipt/riilkkp/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">KKP</a>
                        </td>
                        <td style="text-align: center">
                            <a class="btn btn-success agr" href="/finance/receipt/spextend/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">Extend</a> <br>
                            <a class="btn btn-primary agr" href="/finance/receipt/super/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">SuPer</a> <br>
                            <a class="btn btn-warning agr" href="/finance/receipt/super30/{{$row->id}}" target="_blank" 
                                rel="noopener noreferrer">SuPer30%</a>
                            @if ($row->st->type == 'DL8')
                                <a class="btn btn-success agr" href="/finance/travelexpenses/super8J/{{$row->id}}" target="_blank" 
                                    rel="noopener noreferrer">SuPer>8Jam</a>
                                    
                            @endif
                        </td>
                    @endif
                    <td>
                        <a href="/finance/receipt/edit/{{$row->id}}" class="btn btn-warning">
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
                    window.location = "/finance/receipt/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
