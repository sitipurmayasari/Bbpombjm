@extends('layouts.lab')
@section('breadcrumb')
    <li>Laporan</li>
    <li><a href="/calibration/napzaopname">Laporan Stok Opname</a></li>
    <li>Upload Stok Opname</li>
@endsection
@section('content')


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('napzaopname.store')}}"  enctype="multipart/form-data">
         {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">  Upload Laporan Stok Opname</h4>
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
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal 
                        </label>
                        <div class="col-sm-8">
                            <input type="hidden" value="{{auth()->user()->id}}" name="upload_by"  />
                            <input type="date" value="{{date('Y-m-d')}}"
                                    class="col-xs-3 col-sm-3 required " 
                                    name="dates" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Periode Stok Opname
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="periode" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="periode" />
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Upload File
                        </label>
                        <div class="col-sm-8">
                            <input type="file" name="imporfile" class="btn btn-default btn-sm" id="" value="Upload File">
                            <label><i>*File Excel</i></label>   
                        </div>
                    </div>
                    
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

    <hr><br><br>
    <div class="table-responsive">
        <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
                <th width="40px">No</th>
                <th>Tanggal</th>
                <th class="col-md-5">Periode</th>
                <th  class="col-md-1">Laporan</th>
                <th  class="col-md-2">Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                @php
                    $no = 1;
                @endphp
                <tr>
                    <td>{{$no}}</td>
                    <td>{{tgl_indo($row->dates)}}</td>
                    <td>{{$row->periode}}</td>
                    <td>
                        <a class="btn btn-primary" href="/calibration/napzaopname/cetakopname/{{$row->id}}" target="_blank" rel="noopener noreferrer">CETAK</a>
                    </td>
                    <td>
                        <a href="/calibration/napzaopname/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->periode}}" 
                            r-id="{{$row->id}}">
                            <i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
              @php
                  $no++;
              @endphp
                @endforeach
            <tbody>
        </table>
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
                    window.location = "/calibration/napzaopname/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection