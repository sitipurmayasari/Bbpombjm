@extends('amdk.layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pegawai"> Pegawai</a></li>
    <li>Detail Data Pegawai {{$data->name}}</li>
@endsection
@section('content')

<style>
     table, td, th {
            /* border: 1px solid black; */
            text-align: left;
        }
</style>
 <table class="table table-responsive">
    <tr>
        <td rowspan="8" style="text-align: center">
            <img src="{{$data->getFoto()}}" alt="" height="100px" width="100px">
        </td>
        <td>NIP</td>
        <td>{{$data->no_pegawai}}</td>
        <td>Status Kepegawaian</td>
        <td>
            @if ($data->status=='PNS')
                PNS
            @elseif ($data->status=='Kontrak')
                Pegawai Kontrak
            @elseif ($data->status=='OSC')
                Outsourcing
            @else
                Magang
            @endif
        </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>{{$data->name}}</td>
        <td>Kelompok</td>
        <td>{{$data->divisi->nama}}</td>
    </tr>
    <tr>
        <td>Tempat/Tgl Lahir</td>
        <td>{{$data->tempat_lhr}}, {{\Carbon\Carbon::parse($data->tgl_lahir)->format('d M Y')}}</td>
        <td>Sub Kelompok</td>
        <td>
            @if ($data->subdivisi_id != null)
            {{$data->subdivisi->nama}}
            @else
            -
            @endif
        </td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>
            @if ($data->jkel=='P')
                Perempuan
            @else
                Laki - laki
            @endif
        </td>
        <td>Jabatan Struktural</td>
        <td>{{$data->jabatan->jabatan}}</td>
    </tr>
    <tr>
        <td>Status Pernikahan</td>
        <td>
            @if ($data->nikah=='Y')
                Menikah
            @else
                Lajang
            @endif
        </td>
        <td>Jabatan Fungsional</td>
        <td>
            @if ($data->jabasn_id != null)
            {{$data->jabasn->nama}}
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{$data->email}}</td>
        <td>Pangkat & Golongan </td>
        <td>
            @if ($data->golongan_id != null)
            {{$data->gol->jenis}} / {{$data->gol->golongan}}/{{$data->gol->ruang}}
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <td>No Telp</td>
        <td>{{$data->telp}}</td>
        <td></td>
        <td>
            
        </td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td colspan="3">{{$data->alamat}}</td>
    </tr>
   
 </table>
 <div class="clearfix"></div>
 <ul class="nav nav-tabs">
     <li class="active"><a href="#tab-keluarga" data-toggle="tab">Keluarga</a></li>
     <li><a href="#tab-dokument" data-toggle="tab">Dokumen Pendukung</a></li>
     <li><a href="#tab-pengalaman-kerja" data-toggle="tab">Pengalaman</a></li>
     <li><a href="#tab-riwayat-pendidikan" data-toggle="tab">Riwayat Pendidikan</a></li>
     <li><a href="#tab-dokpeg" data-toggle="tab">Dokumen Kepegawaian</a></li>

 </ul>
 <div class="tab-content">
    @include('amdk.Pegawai.partials.keluarga')
    @include('amdk.Pegawai.partials.dokument')
    @include('amdk.Pegawai.partials.riwayat-pendidikan')
    @include('amdk.Pegawai.partials.pengalaman-kerja')
    @include('amdk.Pegawai.partials.dokpeg')

 </div>
@endsection
@section('footer')
<script>
     $().ready( function () {
        getKeluarga();
        getRiwayat();
        getDokument();
        getPengalaman();
        getDokkepegawaian();

       

        //untuk keluarga
        $(".ta").hide();
        $(".ua").hide();
        $(".tf").hide();
        $(".uf").hide();
        $("#jur").hide();

        $("#jenj").on("change", function(){
            var v = $(this).val();
            if(v==1 || v==2 || v==3){
                $("#jur").hide();
            }else{
                $("#jur").show();
            } 
        });
        
        $('#addfam').click(function () {
            $( '[data-toggle="tab"][href="#TambahSaudara"]' ).trigger( 'click' );
            $(".af").hide();
            $(".tf").show();
            $(".uf").hide();
        });

        $('#addanak').click(function () {
            $( '[data-toggle="tab"][href="#TambahAnak"]' ).trigger( 'click' );
            $(".aa").hide();
            $(".ta").show();
            $(".ua").hide();
        });

      
      
        $(".deletesau").click(function() {
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
                    window.location = "/amdk/keluarga/deletesaudara/"+id;
                }
            });
        });

        //untuk riwayat pendidikan
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

        //for dokument
        $("#tambah-dokument").hide();
        $("#edit-dokument").hide();

        $('#AddataDokument').click(function () {
            $("#daftar-dokument").hide();
            $("#tambah-dokument").show();
            $("#edit-dokument").hide();
        });

        $('.kembaliDokument').click(function () {
            $("#daftar-dokument").show();
            $("#tambah-dokument").hide();
            $("#edit-dokument").hide();
        });

          //for dokpeg
        $("#tambah-dokpeg").hide();
        $("#edit-dokpeg").hide();

        $('#AddataDokpeg').click(function () {
            $("#daftar-dokpeg").hide();
            $("#tambah-dokpeg").show();
            $("#edit-dokpeg").hide();
        });

        $('.kembaliDokpeg').click(function () {
            $("#daftar-dokpeg").show();
            $("#tambah-dokpeg").hide();
            $("#edit-dokpeg").hide();
        });


        $(".optionjendok").on("change", function(){
            var v = $(this).val();
            if(v=="1" || v=="2"){
                $(".namapangkat").hide();
                $(".namatmt").hide();
            }else{
                $(".namapangkat").show();
                $(".namatmt").show();
            } 
        });

        // FOR PENGALAMAN
        $("#tambah-pengalaman").hide();
        $("#edit-pengalaman").hide();

        $('#Addata-pengalaman').click(function () {
            $("#daftar-pengalaman").hide();
            $("#tambah-pengalaman").show();
            $("#edit-pengalaman").hide();
        });

        $('.kembaliPengalaman').click(function () {
            $("#daftar-pengalaman").show();
            $("#tambah-pengalaman").hide();
            $("#edit-pengalaman").hide();
        });

    } );


    function getpeg(){
        var user_id = $("#user_id").val();
    }

    function getKeluarga(){
        var user_id = $("#user_id").val();
        $(".jenjuser").val(user_id);

        $.get(
            "{{route('keluarga.getKeluarga') }}",
            {
                user_id: user_id
            },
            function(response) {
                // -----------------------ORANG TUA------------------------------------------
                document.getElementsByName("nama_ayah")[0].value = response.ortu.nama_ayah ;
                document.getElementsByName("nama_ibu")[0].value = response.ortu.nama_ibu ;
                document.getElementsByName("t_lhr_ayah")[0].value = response.ortu.t_lhr_ayah ;
                document.getElementsByName("t_lhr_ibu")[0].value = response.ortu.t_lhr_ibu ;
                document.getElementsByName("tgl_lhr_ayah")[0].value = response.ortu.tgl_lhr_ayah ;
                document.getElementsByName("tgl_lhr_ibu")[0].value = response.ortu.tgl_lhr_ibu ;
                document.getElementsByName("pekerjaan_ayah")[0].value = response.ortu.pekerjaan_ayah ;
                document.getElementsByName("pekerjaan_ibu")[0].value = response.ortu.pekerjaan_ibu ;
                document.getElementsByName("telp_ayah")[0].value = response.ortu.telp_ayah ;
                document.getElementsByName("telp_ibu")[0].value = response.ortu.telp_ibu ;
                document.getElementsByName("alamat_ayah")[0].value = response.ortu.alamat_ayah ;
                document.getElementsByName("alamat_ibu")[0].value = response.ortu.alamat_ibu ;

                // -----------------------SAUDARA------------------------------------------
                var isifam="";
                for (let i = 0; i < response.saudara.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isifam+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.saudara[i].nama_saudara+'</td>'+
                        '<td>'+response.saudara[i].tempat_lhr_saudara+'</td>'+
                        '<td>'+response.saudara[i].tgl_lhr_saudara+'</td>'+
                        '<td>'+response.saudara[i].jkel_saudara+'</td>'+
                        '<td>'+response.saudara[i].pekerjaan_saudara+'</td>'+
                        '<td>'+response.saudara[i].alamat_saudara+'</td>'+
                        '<td>'+response.saudara[i].telp_saudara+'</td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-warning ubah-saudara"'+
                            'r-id="'+response.saudara[i].id+'">'+
                            '<i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a href="#" class="btn btn-danger hapus-saudara"'+
                                    'r-name="'+response.saudara[i].nama_saudara+'" r-id="'+response.saudara[i].id+'">'+
                            '<i class="glyphicon glyphicon-trash"></i></a>'+
                        '</td>'+
                    '</tr>';
                }

                $("#isifam").html(isifam);

                $(".hapus-saudara").click(function() {
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
                            window.location = "/amdk/keluarga/deletesaudara/"+id;
                        }
                    });
                });

                    $('.kembaliFam').click(function () {
                        $( '[data-toggle="tab"][href="#Family"]' ).trigger( 'click' );
                        $(".aa").show();
                        $(".ta").hide();
                        $(".ua").hide();
                    });

                    $(".ubah-saudara").click(function() {
                        var id = $(this).attr('r-id');
                        $( '[data-toggle="tab"][href="#UbahSaudara"]' ).trigger( 'click' );
                        $(".af").hide();
                        $(".tf").hide();
                        $(".uf").show();
                        var r = document.getElementById("formubah-saudara").action = "/amdk/keluarga/updatesaudara/"+id;
                        
                        $.get(
                            "{{route('keluarga.datapersaudara') }}",
                            {
                            id:id
                            },
                            function(response) {
                                $(".jenjuser").val(response.data.users_id);
                                $("#namasau").val(response.data.nama_saudara);
                                $("#tlsau").val(response.data.tempat_lhr_saudara);
                                $("#tgllhrsau").val(response.data.tgl_lhr_saudara);
                                $("#kersau").val(response.data.pekerjaan_saudara);
                                $("#alasau").val(response.data.alamat_saudara);
                                $("#telpsau").val(response.data.telp_saudara);
                                
                                if (response.data.jkel_saudara=='P') {
                                    $("#jkelsauP").attr('checked', 'checked');
                                }else{
                                    $("#jkelsauL").attr('checked', 'checked');
                                }


                            }
                        );

                    });
                   


                // -----------------------ANAK------------------------------------------

                var isianak="";
                for (let i = 0; i < response.anak.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isianak+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.anak[i].nama_anak+'</td>'+
                        '<td>'+response.anak[i].tempat_lhr_anak+'</td>'+
                        '<td>'+response.anak[i].tgl_lhr_anak+'</td>'+
                        '<td>'+response.anak[i].jkel_anak+'</td>'+
                        '<td>'+response.anak[i].status_anak+'</td>'+
                        '<td>'+response.anak[i].jenjang+'</td>'+
                        '<td>'+response.anak[i].pekerjaan_anak+'</td>'+
                        '<td>'+response.anak[i].tunjangan_anak+'</td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-warning ubah-anak"'+
                            'r-id="'+response.anak[i].id+'">'+
                            '<i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a href="#" class="btn btn-danger hapus-anak"'+
                                    'r-name="'+response.anak[i].nama_anak+'" r-id="'+response.anak[i].id+'">'+
                            '<i class="glyphicon glyphicon-trash"></i></a>'+
                        '</td>'+
                    '</tr>';
                }

                $("#isianak").html(isianak);

                $(".hapus-anak").click(function() {
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
                            window.location = "/amdk/keluarga/deleteanak/"+id;
                        }
                    });
                });

                    $(".ubah-anak").click(function() {
                        var id = $(this).attr('r-id');
                        $( '[data-toggle="tab"][href="#UbahAnak"]' ).trigger( 'click' );
                        $(".aa").hide();
                        $(".ta").hide();
                        $(".ua").show();
                        var r = document.getElementById("formubah-anak").action = "/amdk/keluarga/updateanak/"+id;
                        
                        $.get(
                            "{{route('keluarga.dataperanak') }}",
                            {
                            id:id
                            },
                            function(response) {
                                $(".jenjuser").val(response.data.users_id);
                                $("#UbahNamaAnak").val(response.data.nama_anak);
                                $("#UbahTLahirAnak").val(response.data.tempat_lhr_anak);
                                $("#UbahTglLhrAnak").val(response.data.tgl_lhr_anak);
                                $("#UbahJkelAnak").val(response.data.jkel_anak);
                                $("#UbahStatusAnak").val(response.data.status_anak);
                                $("#UbahJenjAnak").val(response.data.pendidikan_id_anak);
                                $("#UbahJurAnak").val(response.data.jurusan_id_anak);
                                $("#UbahKerAnak").val(response.data.pekerjaan_anak);

                                if (response.data.tunjangan_anak=='Y') {
                                    $("#UbahTunjAnak").attr('checked', 'checked');
                                }
                                if (response.data.jkel_anak=='P') {
                                    $("#anakP").attr('checked', 'checked');
                                }else{
                                    $("#anakL").attr('checked', 'checked');
                                }

                            }
                        );

                    });

                    $('.kembaliAnak').click(function () {
                        $( '[data-toggle="tab"][href="#Anak"]' ).trigger( 'click' );
                        $(".aa").show();
                        $(".ta").hide();
                        $(".ua").hide();
                    });
                   
     
                 // -----------------------PASANGAN------------------------------------------
                 document.getElementsByName("nama_psg")[0].value = response.istri.nama_psg ;
                 document.getElementsByName("tempat_lhr_psg")[0].value = response.istri.tempat_lhr_psg ;
                 document.getElementsByName("tgl_lhr_psg")[0].value = response.istri.tgl_lhr_psg ;
                 document.getElementsByName("jurusan_id_psg")[0].value = response.istri.jurusan_id_psg ;
                 document.getElementsByName("tgl_nikah_psg")[0].value = response.istri.tgl_nikah_psg ;
                 document.getElementsByName("no_buku_nikah_psg")[0].value = response.istri.no_buku_nikah_psg ;
                 document.getElementsByName("pekerjaan_psg")[0].value = response.istri.pekerjaan_psg ;
                 document.getElementsByName("telp_psg")[0].value = response.istri.telp_psg ;

                 if (response.istri.PNS_psg=='Y') {
                    document.getElementsByName("PNS_psg")[0].checked=true;
                 }
                 if (response.istri.tunjangan_psg=='Y') {
                    document.getElementsByName("tunjangan_psg")[0].checked=true;
                 }

                 // -----------------------MERTUA------------------------------------------
                document.getElementsByName("nama_ayah_m")[0].value = response.mertua.nama_ayah_m ;
                document.getElementsByName("nama_ibu_m")[0].value = response.mertua.nama_ibu_m ;
                document.getElementsByName("t_lhr_ayah_m")[0].value = response.mertua.t_lhr_ayah_m ;
                document.getElementsByName("t_lhr_ibu_m")[0].value = response.mertua.t_lhr_ibu_m ;
                document.getElementsByName("tgl_lhr_ayah_m")[0].value = response.mertua.tgl_lhr_ayah_m ;
                document.getElementsByName("tgl_lhr_ibu_m")[0].value = response.mertua.tgl_lhr_ibu_m ;
                document.getElementsByName("pekerjaan_ayah_m")[0].value = response.mertua.pekerjaan_ayah_m ;
                document.getElementsByName("pekerjaan_ibu_m")[0].value = response.mertua.pekerjaan_ibu_m ;
                document.getElementsByName("telp_ayah_m")[0].value = response.mertua.telp_ayah_m ;
                document.getElementsByName("telp_ibu_m")[0].value = response.mertua.telp_ibu_m ;
                document.getElementsByName("alamat_ayah_m")[0].value = response.mertua.alamat_ayah_m ;
                document.getElementsByName("alamat_ibu_m")[0].value = response.mertua.alamat_ibu_m ;

                 

            }
        );
    }

    function getRiwayat(){
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
                            if(response.data.jurusan_id != null || response.data.jurusan_id != ''){
                                $("#editjur").val(response.data.jurusan_id);
                            }
                            $("#editns").val(response.data.nama_sekolah);
                            $("#editalt").val(response.data.alamat);
                            $("#editthnlul").val(response.data.thn_lulus);
                        }
                    );



                });

            }
        );
    }
    
    function getDokument(){
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
                        '<td>'+response.dok[i].tanggal+'</td>'+
                        '<td><a href="/images/pegawai/'+response.dok[i].users_id+'/dokument/'+response.dok[i].upload+'" target="_blank" >'+response.dok[i].upload+'</a></td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-warning ubah-dokument"'+
                            'r-id="'+response.dok[i].id+'">'+
                            '<i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a href="#" class="btn btn-danger hapus-dokument"'+
                                    'r-name="'+response.dok[i].nama+'" r-id="'+response.dok[i].id+'">'+
                            '<i class="glyphicon glyphicon-trash"></i></a>'+
                        '</td>'+
                    '</tr>';
                }
                $("#isiDokument").html(isi);

                $(".hapus-dokument").click(function() {
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

                $(".ubah-dokument").click(function() {
                    var id = $(this).attr('r-id');
                    $("#daftar-dokument").hide();
                    $("#tambah-dokument").hide();
                    $("#edit-dokument").show();
                    var r = document.getElementById("formubah-dokument").action = "/amdk/dokumen/update/"+id;
                    
                    $.get(
                        "{{route('dokumen.datadok') }}",
                        {
                           id:id
                        },
                        function(response) {
                            $(".jenjuser").val(response.data.users_id);
                            $("#editjen").val(response.data.jendok_id);
                            $("#editno").val(response.data.nomor);
                            $("#edittgl").val(response.data.tanggal);
                            $("#editupt").val(response.data.upload);

                        }
                    );



                });

            }
        );
    }

    function getPengalaman(){
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
                            '<a href="#" class="btn btn-warning ubah-pengalaman"'+
                            'r-id="'+response.kerja[i].id+'">'+
                            '<i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a href="#" class="btn btn-danger hapus-pengalaman"'+
                                    'r-name="'+response.kerja[i].instansi+'" r-id="'+response.kerja[i].id+'">'+
                            '<i class="glyphicon glyphicon-trash"></i></a>'+
                        '</td>'+
                    '</tr>';
                }
                $("#isi-pengalaman").html(isi);

                $(".hapus-pengalaman").click(function() {
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


                $(".ubah-pengalaman").click(function() {
                    var id = $(this).attr('r-id');
                    $("#daftar-pengalaman").hide();
                    $("#tambah-pengalaman").hide();
                    $("#edit-pengalaman").show();
                    var r = document.getElementById("formubah-pengalaman").action = "/amdk/pengalaman/update/"+id;
                    
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


    function getDokkepegawaian(){
        var user_id = $("#user_id").val();
        $(".jenjuser").val(user_id);

        $.get(
            "{{route('dokpeg.getData') }}",
            {
                user_id: user_id
            },
            function(response) {
                var isi="";
                for (let i = 0; i < response.dok_peg.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isi+='<tr>'+
                        '<td>'+no+'</td>'+
                        '<td>'+response.dok_peg[i].jenis+'</td>'+
                        '<td>'+response.dok_peg[i].nomor+'</td>'+
                        '<td>'+response.dok_peg[i].tanggal+'</td>'+
                        '<td>'+response.dok_peg[i].keterangan+'</td>'+
                        '<td>'+response.dok_peg[i].tmt+'</td>'+
                        '<td><a href="/images/pegawai/'+response.dok_peg[i].users_id+'/dok_kepegawaian/'+response.dok_peg[i].upload+'" target="_blank" >'+response.dok_peg[i].upload+'</a></td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-warning ubah-dokpeg"'+
                            'r-id="'+response.dok_peg[i].id+'">'+
                            '<i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a href="#" class="btn btn-danger hapus-dokpeg"'+
                                    'r-name="'+response.dok_peg[i].jenis+'" r-id="'+response.dok_peg[i].id+'">'+
                            '<i class="glyphicon glyphicon-trash"></i></a>'+
                        '</td>'+
                    '</tr>';
                }
                $("#isidokpeg").html(isi);

                $(".hapus-dokpeg").click(function() {
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
                            window.location = "/amdk/dokpeg/delete/"+id;
                        }
                    });
                });

                $(".ubah-dokpeg").click(function() {
                    var id = $(this).attr('r-id');
                    $("#daftar-dokpeg").hide();
                    $("#tambah-dokpeg").hide();
                    $("#edit-dokpeg").show();
                    var r = document.getElementById("formubah-dokpeg").action = "/amdk/dokpeg/update/"+id;
                    
                    $.get(
                        "{{route('dokpeg.datadokpeg') }}",
                        {
                           id:id
                        },
                        function(response) {
                            $(".jenjuser").val(response.data.users_id);
                            $("#jendokpeg").val(response.data.jendok_id);
                            $("#nodokpeg").val(response.data.nomor);
                            $("#tgldokpeg").val(response.data.tanggal);
                            $("#nodokpeg").val(response.data.nomor);
                            $("#tmtpeg").val(response.data.tmt);
                            $("#edituptdok").val(response.data.upload);

                            if(response.data.jendok_id=="1" || v=="2"){
                                $(".namapangkat").hide();
                                $(".namatmt").hide();
                            }else{
                                $(".namapangkat").show();
                                $(".namatmt").show();
                            }

                        }
                    );



                });

            }
        );
    }
</script>
@endsection  