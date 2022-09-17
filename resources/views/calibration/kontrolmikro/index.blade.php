@extends('layouts.tomi')
@section('breadcrumb')
    <li>Setup</li>
    <li> Kontrol Media Mikrobiologi</li>
@endsection
@section('content')


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('kontrol.store')}}">
         {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Kontrol Media Mikrobiologi</h4>
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
                        for="form-field-1"> Media
                        </label>
                        <div class="col-sm-8">
                            <select name="media_id"  class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Media</option>
                                @foreach ($media as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Status Kontrol
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="KERUH/JERNIH,DLL" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="status" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Default
                        </label>
                        <div class="col-sm-8">
                            <input type="radio" required value="N" checked
                                name="default" id="N"/> 
                            <label class="control-label" > Tidak  </label> &nbsp; &nbsp; 
                            <input type="radio" required value="Y" 
                                name="default" id="Y"/>
                            <label class="control-label" > Ya  </label>
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
                <th>Media</th>
                <th>Kontrol</th>
                <th class="col-sm-2">Aksi</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td style="width: 40px; text-align:center">{{$data->firstItem() + $key}}</td>
                    <td>{{$row->media->name}}</td>
                    <td style="text-align:center">{{$row->status}}</td>
                    <td>
                        <a href="/calibration/kontrolmikro/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete"
                            r-name="{{$row->status}}" 
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
                text: "Yakin ingin menghapus data  : "+jenis+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/calibration/kontrolmikro/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection