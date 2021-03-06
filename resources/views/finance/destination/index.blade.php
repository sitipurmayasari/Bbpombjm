@extends('layouts.din')
@section('breadcrumb')
@section('breadcrumb')
    <li>Setup Umum</li>
    <li>Kota Tujuan</li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('destination.create')}}"  class="btn btn-primary">Tambah Data</a>   
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

<div class="panel-body">
    <div class="col-md-12">

     <button type="button"  class="btn btn-success" onclick="dalam()" id="dn">
         <i class="ace-icon fa fa-check bigger-110"></i>Dalam Negeri</button>
     <button type="button"  class="btn btn-danger" onclick="luar()" id="ln">
         <i class="ace-icon fa fa-check bigger-110"></i>Luar Negeri</button>
     

     <br><br>
     <div id="in">
        <div class="table-responsive">
            <table id="simple-table" class="table  table-bordered table-hover">
                <thead>
                    <th width="40px">No</th>
                    <th class="col-md-1">Kode Kota</th>
                    <th>Provinsi</th>
                    <th>Kota/Kabupaten</th>
                    <th>IbuKota Daerah</th>
                    <th  class="col-md-2">Aksi</th>
                </thead>
                <tbody>   	
                    @foreach($data as $key=>$row)
                    <tr>
                        <td>{{$data->firstItem() + $key}}</td>
                        <td>{{$row->code}}</td>
                        <td>{{$row->province}}</td>
                        <td>{{$row->district}}</td>
                        <td>{{$row->capital}}</td>
                        <td>
                            <a href="/finance/destination/edit/{{$row->id}}" class="btn btn-warning">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger delete"
                                r-name="{{$row->name}}" 
                                r-id="{{$row->id}}">
                                <i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                  
                    @endforeach
                </tbody>
            </table>
        </div>
     </div>
     <br>
     <div id="out">
        <div class="table-responsive">
            <table id="simple-table" class="table  table-bordered table-hover">
                <thead>
                    <th width="40px">No</th>
                    <th class="col-md-1">Kode Kota</th>
                    <th>Negara</th>
                    <th>Kota</th>
                    <th  class="col-md-2">Aksi</th>
                </thead>
                <tbody>   	
                    @foreach($dataln as $key=>$row)
                    <tr>
                        <td>{{$data->firstItem() + $key}}</td>
                        <td>{{$row->code}}</td>
                        <td>{{$row->country}}</td>
                        <td>{{$row->capital}}</td>
                        <td>
                            <a href="/finance/destination/edit/{{$row->id}}" class="btn btn-warning">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger delete"
                                r-name="{{$row->name}}" 
                                r-id="{{$row->id}}">
                                <i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                  
                    @endforeach
                </tbody>
            </table>
        </div>
     </div>
    </div>
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
                    window.location = "/finance/destination/delete/"+id;
                }
            });
        });

        $("#out").hide();
    } );

    function dalam() {
        document.getElementById("dn").classList.add('btn-success');
        document.getElementById("dn").classList.remove('btn-danger');  
        document.getElementById("ln").classList.remove('btn-success');  
        document.getElementById("ln").classList.add('btn-danger');
        $("#in").show()
        $("#out").hide()
             
    }

    function luar() {
        document.getElementById("ln").classList.add('btn-success');
        document.getElementById("ln").classList.remove('btn-danger');  
        document.getElementById("dn").classList.remove('btn-success');  
        document.getElementById("dn").classList.add('btn-danger');
        $("#in").hide()
        $("#out").show()
             
    }

</script>
@endsection
