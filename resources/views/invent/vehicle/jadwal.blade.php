@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/vehicle"> Jadwal Maintenance</a></li>
    <li>Jadwal Maintenance</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="{{route('vehicle.storejadwal')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Jadwal Maintenance</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> kode 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="code" readonly value="{{$data->code}}"  />
                                <input type="hidden" name="car_id" value="{{$data->id}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk / Jenis Kendaraan
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$data->merk}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="merk" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Polisi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$data->police_number}}" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="police_number" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Maintenance
                            </label>
                            <div class="col-sm-8 date">
                                <input type="text" name="tanggal" readonly class="col-xs-10 col-sm-10" 
                                data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik disini">
                            </div>
                        </div>
                        </fieldset>        
                    </div>
               </div>

            </div>
            <div class="col-sm-6">
                <br>
               <div class="table-responsive">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                            <th width="40px">No</th>
                            <th>Jadwal</th>
                            <th>Hapus</th>
                        <thead>
                        <tbody>   	
                            @php $no=1; @endphp
                            @foreach($jadwal as $key=>$row)
                            <tr>
                                <td style="text-align: center">{{$no++}}</td>
                                <td>{{$row->tanggal}}</td>
                                <td style="text-align: center">
                                    <a href="#" class="btn btn-danger delete"
                                        r-name="{{$row->tanggal}}" 
                                        r-id="{{$row->id}}">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        
                            @endforeach
                        <tbody>
                    </table>
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
                    window.location = "/invent/vehicle/deletejadwal/"+id;
                }
            });
        });
    } );
</script>
@endsection
