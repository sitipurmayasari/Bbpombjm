@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Pegawai</li>
    <li> Riwayat Pendidikan</li>
@endsection
@section('content')
@include('layouts.validasi')
 
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Riwayat Pendidikan</h3></div>
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
            <div class="panel-heading"><h3 class="panel-title">Daftar Riwayat Pendidikan</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <th class="text-left col-md-1">NO</th>
                            <th class="text-center col-md-2">Pendidikan</th>
                            <th class="text-center col-md-2">Jurusan</th>
                            <th class="text-center col-md-3">Nama Sekolah</th>
                            <th class="text-center col-md-3">Alamat Sekolah</th>
                            <th class="text-center col-md-1">Tahun Lulus</th>
                            <th class="text-center col-md-2">Aksi</th>
                        </thead>
                        <tbody id="isi"  style="text-align: center;">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <button type="button" class="form-control btn-default" onclick="Addata()" id="Addata">
                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH DATA PENDIDIKAN</button>
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
            <div class="panel-heading"><h3 class="panel-title">Tambah Riwayat Pendidikan</h3></div>
            <div class="panel-body">
                <form class="form-horizontal validate-form" role="form" 
                method="post" action="{{route('riwayatpend.store')}}">
                {{ csrf_field() }}
                <div class="col-md-12">
                <fieldset>
                    <input type="text" name="users_id" class="jenjuser" hidden/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenjang Pendidikan
                        </label>
                        <div class="col-sm-8">
                            <select name="pendidikan_id" class="col-xs-10 col-sm-10 required" 
                            id="jenj" onchange="pend()">
                                <option value="">Pilih Jenjang Pendidikan</option>
                                @foreach ($jenjang as $item)
                                    <option value="{{$item->id}}">{{$item->jenjang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jurusan
                        </label>
                        <div class="col-sm-8">
                            <select name="jurusan_id" class="col-xs-10 col-sm-10 required">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{$item->id}}"> {{$item->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Sekolah
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                            name="nama_sekolah" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Alamat Sekolah
                        </label>
                        <div class="col-sm-8">
                            <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tahun Lulus
                        </label>
                        <div class="col-sm-8">
                            <select name="daftartahun" class="col-xs-10 col-sm-10">
                                <option value="">Pilih Tahun Kelulusan</option>
                                <?php
                                    $now=date('Y');
                                    for ($a=1970;$a<=$now;$a++)
                                    {
                                        echo "<option value='$a'>$a</option>";
                                    }
                                    ?>
                            </select>
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
            <div class="panel-heading"><h3 class="panel-title">Ubah Riwayat Pendidikan</h3></div>
            <div class="panel-body">
                <form class="form-horizontal validate-form" role="form" id="formubah"
                method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12">
                <fieldset>
                    <input type="text" name="users_id" class="jenjuser" hidden/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenjang Pendidikan
                        </label>
                        <div class="col-sm-8">
                            <select name="pendidikan_id" class="col-xs-10 col-sm-10 required" 
                            id="editjenj" onchange="pend()">
                                <option value="">Pilih Jenjang Pendidikan</option>
                                @foreach ($jenjang as $item)
                                    <option value="{{$item->id}}">{{$item->jenjang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jurusan
                        </label>
                        <div class="col-sm-8">
                            <select name="jurusan_id" class="col-xs-10 col-sm-10 required" id="editjur">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{$item->id}}"> {{$item->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Sekolah
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " id="editns" 
                            name="nama_sekolah" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right"  
                        for="form-field-1"> Alamat Sekolah
                        </label>
                        <div class="col-sm-8">
                            <textarea  placeholder="" class="col-xs-10 col-sm-10" id="editalt" 
                                name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tahun Lulus
                        </label>
                        <div class="col-sm-8">
                            <select name="daftartahun" class="col-xs-10 col-sm-10" id="editthnlul">
                                <option value="">Pilih Tahun Kelulusan</option>
                                <?php
                                    $now=date('Y');
                                    for ($a=1970;$a<=$now;$a++)
                                    {
                                        echo "<option value='$a'>$a</option>";
                                    }
                                    ?>
                            </select>
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
            "{{route('riwayatpend.getData') }}",
            {
                user_id: user_id
            },
            function(response) {
                var isi="";
                for (let i = 0; i < response.riwayat.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isi+='<tr>'+
                        '<td>'+no+'</td>'+
                        '<td>'+response.riwayat[i].jenjang+'</td>'+
                        '<td>'+response.riwayat[i].jurusan+'</td>'+
                        '<td>'+response.riwayat[i].nama_sekolah+'</td>'+
                        '<td>'+response.riwayat[i].alamat+'</td>'+
                        '<td>'+response.riwayat[i].thn_lulus+'</td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-warning ubah"'+
                            'r-id="'+response.riwayat[i].id+'">'+
                            '<i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a href="#" class="btn btn-danger hapus"'+
                                    'r-name="'+response.riwayat[i].nama_sekolah+'" r-id="'+response.riwayat[i].id+'">'+
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
                            window.location = "/amdk/riwayatpend/delete/"+id;
                        }
                    });
                });

                $(".ubah").click(function() {
                    var id = $(this).attr('r-id');
                    $("#daftar").hide();
                    $("#tambah").hide();
                    $("#edit").show();
                    var r = document.getElementById("formubah").action = "/amdk/riwayatpend/update/"+id;
                    
                    $.get(
                        "{{route('riwayatpend.datapen') }}",
                        {
                           id:id
                        },
                        function(response) {
                            $(".jenjuser").val(response.data.users_id); // 
                            $("#editjenj").val(response.data.pendidikan_id)
                            // $("#editjenj").val(response.data.pendidikan_id);
                            if(response.data.jurusan_id != null || response.data.jurusan_id != ''){
                                $("#editjur").val(response.data.jurusan_id);
                            }
                            $("#editns").val(response.data.nama_sekolah);
                            $("#editalt").val(response.data.alamat);
                            // $("#editthnlul").val(response.data.thn_lulus);
                        }
                    );



                });

            }
        );
    }

</script>
@endsection