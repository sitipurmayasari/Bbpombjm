@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Kompetensi Pegawai</li>
@endsection
@section('content')

<style>
   /* ============================ */
/* TOOLTIP                      */
/* ============================ */
        [data-tooltip] {
        position: relative;
        /* tooltip arrow */   
        /* tooltip box */
        }
        [data-tooltip]:before, [data-tooltip]:after {
        -webkit-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        -o-transform: translateX(-50%);
        transform: translateX(-50%);
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        position: absolute;
        top: 100%;
        left: 50%;
        -webkit-transition-property: opacity;
        -moz-transition-property: opacity;
        transition-property: opacity;
        -webkit-transition-duration: 0.2s;
        -moz-transition-duration: 0.2s;
        transition-duration: 0.2s;
        -webkit-transition-timing-function: linear;
        -moz-transition-timing-function: linear;
        transition-timing-function: linear;
        position: absolute;
        left: 50%;
        top: 100%;
        bottom: 100%;
        visibility: hidden;
        opacity: 0;
        z-index: 9999;
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
        }
        [data-tooltip]:before {
        content: "";
        border-color: #323232;
        border-style: none;
        border: 5px solid transparent;
        border-bottom: 6px solid #323232;
        margin-top: -4px;
        }
        [data-tooltip]:after {
        content: attr(data-tooltip);
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        width: auto;
        height: 15px;
        padding: 5px 5px 0 5px;
        font-size: 11px;
        line-height: 11px;
        white-space: nowrap;
        background-color: #323232;
        color: #ecf0f1;
        margin-top: 7px;
        }
        [data-tooltip]:hover, [data-tooltip]:focus {
        background-color: transparent;
        }
        [data-tooltip]:hover:before, [data-tooltip]:hover:after, [data-tooltip]:focus:before, [data-tooltip]:focus:after {
        -webkit-transform: translate(-50%, 0);
        -moz-transform: translate(-50%, 0);
        -ms-transform: translate(-50%, 0);
        -o-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
        opacity: 1;
        visibility: visible;
        }
    </style>

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        {{-- <div class="form-group col-xs-12 col-sm-2" style="float: left">
                           <a href="{{Route('pelatihan.create')}}"  class="btn btn-primary">Tambah Data</a>   
                        </div> --}}
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
                        <a href="/amdk/pelatihan/edit/{{$row->id}}" class="btn btn-warning " data-tooltip="Ubah & Unggah Sertifikat">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete" data-tooltip="Hapus"
                            r-name="{{$row->nama}}" 
                            r-id="{{$row->id}}">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
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
