@extends('layouts.forma')
@section('breadcrumb')
<li>RAPK</li>
<li><a href="/finance/renta">Realisasi Capaian Target Substansi {{$div->nama}}</a></li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('renta.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th>Dasar Renstra</th>
                <th>Periode</th>
                <th>Pejabat</th>
                <th>Status</th>
            </thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td style="text-align: center">{{$data->firstItem() + $key}}</td>
                    <td>{{$row->dates}}</td>
                    <td>Tahun {{$row->eselon->years}} 
                        (dasar renstra : {{$row->eselon->renstrakal->filename}} -
                        {{$row->eselon->renstrakal->yearfrom}} s/d {{$row->eselon->renstrakal->yearto}})</td>
                    <td>
                        @php
                            if ($row->periodebln==2) {
                            $bulannya = "Februari";
                            } elseif ($row->periodebln==3) {
                                $bulannya = "Maret";
                            } elseif ($row->periodebln==4) {
                                $bulannya = "April";
                            } elseif ($row->periodebln==5) {
                                $bulannya = "Mei";
                            } elseif ($row->periodebln==6) {
                                $bulannya = "Juni";
                            } elseif ($row->periodebln==7) {
                                $bulannya = "Juli";
                            } elseif ($row->periodebln==8) {
                                $bulannya = "Agustus";
                            } elseif ($row->periodebln==9) {
                                $bulannya = "September";
                            } elseif ($row->periodebln==10) {
                                $bulannya = "Oktober";
                            } elseif ($row->periodebln==11) {
                                $bulannya = "November";
                            } elseif ($row->periodebln==12) {
                                $bulannya = "Desember";
                            } else {
                                $bulannya = "Januari";
                            }
                        @endphp
                        {{$bulannya}}
                    </td>
                    <td>{{$row->peg->name}}</td>
                    <td>
                        @if ($row->verif == 'Y')
                            <span id="selesai" class="badge badge-pill badge-success">Terverifikasi</span>
                        @else
                            <a href="/finance/renta/edit/{{$row->id}}" class="btn btn-warning">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger delete"
                                r-name="{{$row->filename}}" 
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
                    window.location = "/finance/renta/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection