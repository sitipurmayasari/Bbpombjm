@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Pegawai</li>
    <li> Dokumen Pendukung</li>
@endsection
@section('content')
@include('layouts.validasi')
 
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Dokumen Pendukung</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                    <div class="col-md-6">
                        <label > Nama Pegawai</label>
                        <select id="user_id" name="user_id" class="col-xs-10 col-sm-10 select2" onchange="getpeg();getData()">
                                <option value="">pilih nama pegawai</option>
                            @foreach ($user as $peg)
                                <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                            @endforeach
                        </select>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="daftar">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Data Dokumen Pendukung</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <th class="text-left col-md-1">No</th>
                            <th class="text-center col-md-2">Jenis</th>
                            <th class="text-center col-md-3">Nomor</th>
                            <th class="text-center col-md-3">Upload File</th>
                            <th class="text-center col-md-2">Aksi</th>
                        </thead>
                        <tbody id="isi"  style="text-align: center;">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <button type="button" class="form-control btn-default" onclick="Addata()" id="Addata">
                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH DOKUMEN PENDUKUNG</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="tambah">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Tambah Dokumen Pendukung</h3></div>
            <div class="panel-body">
                <form class="form-horizontal validate-form" role="form" 
                method="post" action="{{route('dokumen.store')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12">
                <fieldset>
                    <input type="text" name="users_id" class="jenjuser" hidden/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis Dokumen
                        </label>
                        <div class="col-sm-8">
                            <select name="jendok_id" class="col-xs-10 col-sm-10 required" >
                                <option value="">Pilih jenis Dokumen</option>
                                @foreach ($jenis as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Dokumen
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nomor dokumen" class="col-xs-10 col-sm-10 required " 
                            name="nomor" id="nomor"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Upload Dokumen
                        </label>
                        <div class="col-sm-8">
                            <input type="file" name="upload" class="btn btn-default btn-sm" id="" value="Upload Foto Dokumen">      
                            <label><i>ex:Lorem_ipsum.jpg/png/jpeg</i></label>
                        </div>
                    </div>
                    
                </fieldset>
                </div>
                <div class="col-sm-12">
                    <div class="form-actions right">
                        <button class="btn btn-success btn-sm " type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                        </button>
                        <button class="btn btn-success btn-sm kembali" type="button">
                            <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-12" id="edit">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Ubah Dokumen Pendukung</h3></div>
            <div class="panel-body">
                <form class="form-horizontal validate-form" role="form" id="formubah"
                method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12">
                <fieldset>
                    <input type="text" name="users_id" class="jenjuser" hidden/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis Dokumen
                        </label>
                        <div class="col-sm-8">
                            <select name="jendok_id" class="col-xs-10 col-sm-10 required" 
                            id="editjen">
                                <option value="">Pilih jenis Dokumen</option>
                                @foreach ($jenis as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Dokumen
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="editno"  placeholder="nomor dokumen" class="col-xs-10 col-sm-10 required " 
                            name="nomor" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Upload Dokumen
                        </label>
                        <div class="col-sm-8">
                            <input type="file" name="upload" class="btn btn-default btn-sm" id="editupt" value="Upload Foto Dokumen">      
                            <label><i>ex:Lorem_ipsum.jpg/png/jpeg</i></label>
                        </div>
                    </div>
                </fieldset>
                </div>
                <div class="col-sm-12">
                    <div class="form-actions right">
                        <button class="btn btn-success btn-sm " type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>Update
                        </button>
                        <button class="btn btn-success btn-sm kembali" type="button">
                            <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
@section('footer')
<script>
     $().ready( function () {

        $("#tambah").hide();
        $("#edit").hide();

        $('#Addata').click(function () {
            $("#daftar").hide();
            $("#tambah").show();
            $("#edit").hide();
        });

        $('.kembali').click(function () {
            $("#daftar").show();
            $("#tambah").hide();
            $("#edit").hide();
        });

       

    } );

    function getpeg(){
        var user_id = $("#user_id").val();
    }

    function getData(){
        var user_id = $("#user_id").val();
        $(".jenjuser").val(user_id);

        $.get(
            "{{route('dokumen.getData') }}",
            {
                user_id: user_id
            },
            function(response) {
                var isi="";
                for (let i = 0; i < response.dok.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isi+='<tr>'+
                        '<td>'+no+'</td>'+
                        '<td>'+response.dok[i].nama+'</td>'+
                        '<td>'+response.dok[i].nomor+'</td>'+
                        '<td>'+response.dok[i].upload+'</td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-warning ubah"'+
                            'r-id="'+response.dok[i].id+'">'+
                            '<i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a href="#" class="btn btn-danger hapus"'+
                                    'r-name="'+response.dok[i].nama+'" r-id="'+response.dok[i].id+'">'+
                            '<i class="glyphicon glyphicon-trash"></i></a>'+
                        '</td>'+
                    '</tr>';
                }
                $("#isi").html(isi);

                $(".hapus").click(function() {
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
                            window.location = "/amdk/dokumen/delete/"+id;
                        }
                    });
                });

                $(".ubah").click(function() {
                    var id = $(this).attr('r-id');
                    $("#daftar").hide();
                    $("#tambah").hide();
                    $("#edit").show();
                    var r = document.getElementById("formubah").action = "/amdk/dokumen/update/"+id;
                    
                    $.get(
                        "{{route('dokumen.datadok') }}",
                        {
                           id:id
                        },
                        function(response) {
                            $(".jenjuser").val(response.data.users_id);
                            $("#editjen").val(response.data.jendok_id);
                            $("#editno").val(response.data.nomor);
                            $("#editupt").val(response.data.upload);

                        }
                    );



                });

            }
        );
    }

</script>
@endsection