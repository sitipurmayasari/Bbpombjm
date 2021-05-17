@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Pegawai</li>
    <li> Pengalaman Kerja</li>
@endsection
@section('content')
@include('layouts.validasi')
 
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pengalaman Kerja</h3></div>
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
            <div class="panel-heading"><h3 class="panel-title">Pengalaman Kerja</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover">
                    <thead>
                        <th class="text-left col-md-1">NO</th>
                        <th class="text-center col-md-2">Tanggal Kerja</th>
                        <th class="text-center col-md-3">Instansi</th>
                        <th class="text-center col-md-2">Jabatan</th>
                        <th class="text-center col-md-2">Masa Kerja (thn)</th>
                        <th class="text-center col-md-2">Aksi</th>
                        </thead>
                        <tbody id="isi"  style="text-align: center;">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <button type="button" class="form-control btn-default" onclick="Addata()" id="Addata">
                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH PENGALAMAN KERJA</button>
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
            <div class="panel-heading"><h3 class="panel-title">Tambah Pengalaman Kerja</h3></div>
            <div class="panel-body">
                <form class="form-horizontal validate-form" role="form" 
                method="post" action="{{route('pengalaman.store')}}">
                {{ csrf_field() }}
                <div class="col-md-12">
                <fieldset>
                    <input type="text" name="users_id" class="jenjuser" hidden/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Instansi
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama Instansi" class="col-xs-10 col-sm-10 required " 
                            name="instansi"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Mulai Kerja
                        </label>
                        <div class="col-sm-8">
                            <input type="date"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                            name="tgl_mulai"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jabatan Terakhir
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama jabatan" class="col-xs-10 col-sm-10 required " 
                            name="jabatan" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Masa Kerja (THN)
                        </label>
                        <div class="col-sm-8">
                            <input type="number"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                            name="lama_thn" />
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
            <div class="panel-heading"><h3 class="panel-title">Ubah Pengalaman Kerja</h3></div>
            <div class="panel-body">
                <form class="form-horizontal validate-form" role="form" id="formubah"
                method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12">
                <fieldset>
                    <input type="text" name="users_id" class="jenjuser" hidden/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Instansi
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama Instansi" class="col-xs-10 col-sm-10 required " 
                            id="editins"     name="instansi"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Mulai Kerja
                        </label>
                        <div class="col-sm-8">
                            <input type="date"  placeholder="nama" class="col-xs-10 col-sm-10 required " id="edittmk"
                            name="tgl_mulai"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jabatan Terakhir
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama jabatan" class="col-xs-10 col-sm-10 required "  id="editjab"
                            name="jabatan" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Masa Kerja (THN)
                        </label>
                        <div class="col-sm-8">
                            <input type="number"  placeholder="nama" class="col-xs-10 col-sm-10 required " id="edittahun"
                            name="lama_thn" />
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
            "{{route('pengalaman.getData') }}",
            {
                user_id: user_id
            },
            function(response) {
                var isi="";
                for (let i = 0; i < response.kerja.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isi+='<tr>'+
                        '<td>'+no+'</td>'+
                        '<td>'+response.kerja[i].tgl_mulai+'</td>'+
                        '<td>'+response.kerja[i].instansi+'</td>'+
                        '<td>'+response.kerja[i].jabatan+' </td>'+
                        '<td>'+response.kerja[i].lama_thn+'</td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-warning ubah"'+
                            'r-id="'+response.kerja[i].id+'">'+
                            '<i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a href="#" class="btn btn-danger hapus"'+
                                    'r-name="'+response.kerja[i].instansi+'" r-id="'+response.kerja[i].id+'">'+
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
                            window.location = "/amdk/pengalaman/delete/"+id;
                        }
                    });
                });

                $(".ubah").click(function() {
                    var id = $(this).attr('r-id');
                    $("#daftar").hide();
                    $("#tambah").hide();
                    $("#edit").show();
                    var r = document.getElementById("formubah").action = "/amdk/pengalaman/update/"+id;
                    
                    $.get(
                        "{{route('pengalaman.dataker') }}",
                        {
                           id:id
                        },
                        function(response) {
                            $(".jenjuser").val(response.data.users_id);
                            $("#edittmk").val(response.data.tgl_mulai);
                            $("#editjab").val(response.data.jabatan);
                            $("#editins").val(response.data.instansi);
                            $("#edittahun").val(response.data.lama_thn);
                        }
                    );



                });

            }
        );
    }

</script>
@endsection