@extends('layouts.pr')
@section('breadcrumb')
<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">User Profile</li>
    </ol>
  </nav>
@endsection
@section('content')
<style>
    .sidebar{
        overflow: auto;
    }
</style>
@include('layouts.validasi')
    <form action="/profile/update/{{auth()->user()->id}}" method="POST">
      {{ csrf_field() }}
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{auth()->user()->getFoto()}}" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{auth()->user()->name}}</h4>
                      <p class="text-secondary mb-1">{{auth()->user()->jabatan->jabatan}}</p>
                      <p class="text-muted font-size-sm">{{auth()->user()->divisi->nama}}</p>
                      <input type="submit" class="btn btn-primary" value="UPDATE PASSWORD"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">
					            	<span class="text-secondary"> Password Lama</span><br>
                        <input type="password"  value="" id="myInputa"
                               class="required" minlength="8" required
                              name="oldpass"/> &nbsp; 
                        <i class="fa fa-eye" onclick="myFunction()"></i>
                    </h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">
					            	<span class="text-secondary"> Password Baru</span><br>
                        <input type="password"  placeholder="password min 8 character" 
                        class="required" minlength="8" id="myInputb"
                                        name="password_new" required  />
                        <i class="fa fa-eye" onclick="myFunctionb()"></i>
                    </h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">
                        <div>
                          <span class="text-secondary"> Ketik ulang password baru </span><br>
                          <input type="password"  placeholder="password min 8 character" 
                          class="required" minlength="8" id="myInputc"
                                          name="repassword" required  />
                          <i class="fa fa-eye" onclick="myFunctionc()"></i>
                        </div>
                    </h6>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <br>
                  <div class="row">
                    <div class="col-sm-2">
                      Tempat/ Tanggal Lahir
                    </div>
                    <div class="col-sm-4 text-secondary">
                      {{auth()->user()->tempat_lhr}}, {{auth()->user()->tgl_lhr}}
                    </div>
                    <div class="col-sm-2">
                        Status Kepegawaian
                    </div>
                    <div class="col-sm-4 text-secondary">
                        @if (auth()->user()->status=='PNS')
                            PNS
                        @elseif (auth()->user()->status=='PPNPN')
                            PPNPN
                        @elseif (auth()->user()->status=='OSC')
                            Outsourcing
                        @else
                            Magang
                        @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                        Jenis Kelamin
                    </div>
                    <div class="col-sm-4 text-secondary">
                        @if (auth()->user()->jkel=='P')
                            Perempuan
                        @else
                            Laki - laki
                        @endif
                    </div>
                    <div class="col-sm-2">
                        Jabatan Fungsional
                      </div>
                      <div class="col-sm-4 text-secondary">
                        @if ($data->jabasn_id != null)
                            {{auth()->user()->jabasn->nama}}
                        @else
                            -
                        @endif
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                        Status Pernikahan
                    </div>
                    <div class="col-sm-4 text-secondary">
                        @if (auth()->user()->nikah=='Y')
                            Menikah
                        @else
                            Lajang
                        @endif
                    </div>
                    <div class="col-sm-2">
                        Pangkat & Golongan
                    </div>
                    <div class="col-sm-4 text-secondary">
                        @if (auth()->user()->golongan_id != null)
                            {{auth()->user()->gol->jenis}} / {{auth()->user()->gol->golongan}}/{{auth()->user()->gol->ruang}}
                        @else
                            -
                        @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                        No. Telp
                    </div>
                    <div class="col-sm-4 text-secondary">
                      {{auth()->user()->telp}}
                    </div>
                    <div class="col-sm-2">
                        Kelompok
                    </div>
                    <div class="col-sm-4 text-secondary">
                        {{auth()->user()->divisi->nama}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                        Email
                    </div>
                    <div class="col-sm-4 text-secondary">
                      {{auth()->user()->email}}
                    </div>
                    <div class="col-sm-2">
                        Sub Kelompok
                    </div>
                    <div class="col-sm-4 text-secondary">
                        @if (auth()->user()->subdivisi_id != null)
                            {{auth()->user()->subdivisi->nama}}
                        @else
                        -
                        @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                        Alamat
                    </div>
                    <div class="col-sm-10 text-secondary">
                      {{auth()->user()->alamat}}
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>

    </form>
    <div class="clearfix"></div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-keluarga" data-toggle="tab">Keluarga</a></li>
        <li><a href="#tab-dokument" data-toggle="tab">Dokumen Pendukung</a></li>
        <li><a href="#tab-pengalaman-kerja" data-toggle="tab">Pengalaman</a></li>
        <li><a href="#tab-riwayat-pendidikan" data-toggle="tab">Riwayat Pendidikan</a></li>
        <li><a href="#tab-dokpeg" data-toggle="tab">Dokumen Kepegawaian</a></li>

        @if (auth()->user()->status=='PNS')
            <li><a href="#tab-tukin" data-toggle="tab">TuKin</a></li>
            <li><a href="#tab-dupak" data-toggle="tab">Angka Kredit</a></li>
        @endif
        
    </ul>

    <div class="tab-content">
        @include('amdk.Pegawai.partials.keluarga')
        @include('profile.partials.dokument')
        @include('profile.partials.riwayat-pendidikan')
        @include('profile.partials.pengalaman-kerja')
        @include('profile.partials.dokpeg')
        @include('profile.partials.tukin')
        @include('profile.partials.dupak')
      
    </div>
@endsection

@section('footer')
<script>
    function myFunction() {
    var x = document.getElementById("myInputa");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function myFunctionb() {
    var x = document.getElementById("myInputb");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function myFunctionc() {
    var x = document.getElementById("myInputc");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

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
                    window.location = "/profile/deletesaudara/"+id;
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
                            window.location = "/profile/deletesaudara/"+id;
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
                            window.location = "/profile/deleteanak/"+id;
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
                            window.location = "/profile/deletepen/"+id;
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
                        '<td><a href="images/pegawai/'+response.dok[i].users_id+'/dokument/'+response.dok[i].upload+'" target="_blank" >'+response.dok[i].upload+'</a></td>'+
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
                            window.location = "/profile/deletedok/"+id;
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
                            window.location = "/profile/deletepengalaman/"+id;
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
                        '<td><a href="images/pegawai/'+response.dok_peg[i].users_id+'/dok_kepegawaian/'+response.dok_peg[i].upload+'" target="_blank" >'+response.dok_peg[i].upload+'</a></td>'+
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
                            window.location = "/profile/deletedokpeg/"+id;
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
