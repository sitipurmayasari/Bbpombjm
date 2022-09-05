@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li> Hari Kerja</li>
@endsection
@section('content')

<div class="col-sm-5">
    <div class="row">
        <form class="form-horizontal validate-form" role="form" 
             method="post" action="{{route('libur.store')}}">
             {{ csrf_field() }}
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title"> Tambah Hari Kerja</h4>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
    
                <div class="widget-body">
                    <div class="widget-main no-padding" col-sm-8>
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal 
                            </label>
                            <div class="col-sm-8">
                                <input type="date" class="col-xs-10 col-sm-10"  value="{{date('Y-m-d')}}"
                                name="tanggal" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jam Masuk 
                            </label>
                            <div class="col-sm-8">
                                <input type="time" class="col-xs-10 col-sm-10" 
                                name="chekin" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jam Pulang 
                            </label>
                            <div class="col-sm-8">
                                <input type="time" class="col-xs-10 col-sm-10" 
                                name="chekot" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Hari
                            </label>
                            <div class="col-sm-8">
                                <select name="keterangan" class="col-xs-10 col-sm-10 select2" required>
                                    <option value="Senin">senin</option>
                                    <option value="Selasa">selasa</option>
                                    <option value="Rabu">rabu</option>
                                    <option value="Kamis">kamis</option>
                                    <option value="Jumat">jumat</option>
                                    <option value="Besar">besar</option>
                                </select>
                            </div>
                           
                        </div>
                        *hari besar = hari libur yang diwajibkan melakukan e-presensi
                        </fieldset>        
                    </div>
                </div>
            </div>
        </div><!-- /.col -->
        
        <div class="col-sm-12">
            <div class="form-actions right">
                <button class="btn btn-success btn-sm " type="submit">
                    <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="col-sm-7">
    <div class="table-responsive">
        <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
                <th class="col-md-1" style="text-align: center">No</th>
                <th class="col-md-3" style="text-align: center">Tanggal</th>
                <th class="col-md-2" style="text-align: center">Jam Masuk</th>
                <th class="col-md-2" style="text-align: center">Jam Pulang</th>
                <th class="col-md-2" style="text-align: center">Keterangan</th>
                <th style="text-align: center">Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td style="text-align: center">{{$data->firstItem() + $key}}</td>
                    <td>{{tgl_indo($row->tanggal)}}</td>
                    <td>{{$row->chekin}}</td>
                    <td>{{$row->chekot}}</td>
                    <td>{{$row->keterangan}}</td>
                    <td style="text-align: center">
                       @if ($row->tanggal > $now)
                        <a href="/amdk/libur/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->libur}}" 
                            r-id="{{$row->id}}">
                            <i class="glyphicon glyphicon-trash"></i></a>
                       @endif
                    </td>
                </tr>
              
                @endforeach
            <tbody>
        </table>
    </div>
    {{$data->appends(Request::all())->links()}}
</div>

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
                    window.location = "/amdk/libur/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection