@extends('layouts.ot')
@section('breadcrumb')
    <li>Setup</li>
    <li> Parameter Uji</li>
@endsection
@section('content')


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('parameter.store')}}">
         {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Parameter Uji</h4>
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
                        for="form-field-1"> Komuditi
                        </label>
                        <div class="col-sm-8">
                            <select name="komuditi"  class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Komuditi</option>
                                <option value="OBA">OBAT BAHAN ALAM / OBAT TRADISIONAL</option>
                                <option value="KOS">KOSMETIK</option>
                                <option value="SK">SUPLEMEN KESEHATAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Parameter Uji
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder=" Masukkan Parameter uji" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="nama" required />
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
                <th>No</th>
                <th>Asal Komuditi</th>
                <th>Parameter Uji</th>
                <th>Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td style="width: 40px; text-align:center">{{$data->firstItem() + $key}}</td>
                    <td>{{$row->nama}}</td>
                    <td style="text-align:center">{{$row->komuditi}}</td>
                    <td>
                        <a href="/calibration/parameter/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->name}}" 
                            r-id="{{$row->id}}">
                            <i class="glyphicon glyphicon-trash"></i></a>
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
                var jenis = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+nama+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/calibration/parameter/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection