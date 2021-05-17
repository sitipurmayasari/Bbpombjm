@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pegawai"> Pegawai</a></li>
    <li>Tambah Data Pegawai</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('pegawai.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Data Pegawai</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-8">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> NIP. Pegawai
                            </label>
                            <div class="col-sm-8" id="tambah">
                                <input type="text"  placeholder="nomor pegawai"
                                        class="col-xs-10 col-sm-10 required" 
                                        name="no_pegawai" required  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Pegawai
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tempat Lahir
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="tempat_lhr" class="col-xs-10 col-sm-10 required" 
                                placeholder ="tempat talhir" required>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Lahir
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_lhr" readonly class="col-xs-10 col-sm-10 required" 
                                data-date-format="yyyy-mm-dd" data-provide="datepicker" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Kelamin
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" required value="L" checked 
                                name="jkel" id="L"/> &nbsp; Laki - Laki  &nbsp;
                                <input type="radio" required value="P"
                                name="jkel" id="P"/> &nbsp; Perempuan
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Alamat
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                name="alamat"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Telp
                            </label>
                            <div class="col-sm-8">
                                <input type="number"  placeholder="telp" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="telp" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Email
                            </label>
                            <div class="col-sm-8">
                                <input type="email"  placeholder="example@email.com" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="email" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Status Pernikahan
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" required value="Y" checked 
                                name="nikah" id="Y"/> &nbsp; Lajang  &nbsp;
                                <input type="radio" required value="N"
                                name="nikah" id="N"/> &nbsp; Menikah
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Status Kepegawaian
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="status" class="col-xs-10 col-sm-10">
                                    <option value="PNS">PNS</option>
                                    <option value="PPNPN">PPNPN</option>
                                    <option value="Magang">Magang</option>
                                    <option value="OSC">Outsourcing</option>
                                </select>
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jabatan Struktural
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="jabatan_id" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabatan as $jab)
                                        <option value="{{$jab->id}}">{{$jab->jabatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kelompok
                            </label>
                            <div class="col-sm-8">
                                <select  name="divisi_id" id="divisi_id" onchange="getSubdivisiId()" class="col-xs-10 col-sm-10 required" required>
                                    <option value="">Pilih Kelompok</option>
                                    @foreach ($divisi as $div)
                                        <option value="{{$div->id}}">{{$div->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Sub Kelompok
                            </label>
                            <div class="col-sm-8">
                                <select name="subdivisi_id" id="subdivisi_id" class="col-xs-10 col-sm-10">
                                    <option value="">Tanpa Sub Kelompok</option>
                                    {{-- @foreach ($subdivisi as $sub)
                                        <option value="{{$sub->id}}">{{$sub->nama_subdiv}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jabatan Fungsional
                            </label>
                            <div class="col-sm-8">
                                <select name="jabasn_id" id="jabasn_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Jabatan Fungsional</option>
                                    @foreach ($jabasn as $sub)
                                        <option value="{{$sub->id}}">{{$sub->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pangkat & Golongan
                            </label>
                            <div class="col-sm-8">
                                <select name="golongan_id" id="golongan_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Pangkat dan Golongan</option>
                                    @foreach ($gol as $sub)
                                        <option value="{{$sub->id}}">{{$sub->jenis}} / {{$sub->golongan}}/{{$sub->ruang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Username
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="username" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="username" required/>
                            </div>
                        </div> --}}

                        {{-- <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Password
                            </label>
                            <div class="col-sm-8">
                                <input type="password"  placeholder="password min 8 character" 
                                        class="col-xs-10 col-sm-10 required " minlength="8"
                                        name="password" id="myInput"/> &nbsp; 
                                <i class="fa fa-eye" onclick="myFunction()"></i>
                            </div>
                        </div> --}}
                        
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-4">
                &nbsp;
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="radio" required value="Y" checked
                                name="aktif" id="Y"/> &nbsp; Aktif
                        <input type="radio" required value="N"
                                name="aktif" id="N"/> &nbsp; NonAktif
                    </div>
                </div>
                <div class="widget-main no-padding">
                    <div class="form-actions center">
                        <input type="file" name="foto" class="btn btn-success btn-sm" id="" 
                            value="Upload Foto Barang">   
                            <label><i>ex:Lorem_ipsum.jpg/.jpeg/.png</i></label>
                    </div>     
                </div>
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

@endsection

@section('footer')
<script>
    function getSubdivisiId(){
         var divisi_id = $("#divisi_id").val();
        $.get(
            "{{route('divisi.getDivisi') }}",
            {
                divisi_id: divisi_id
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Tanpa Sub Kelompok</option>";
                $.each(data, function(index, value) {
                    string = string + `<option value="` + value.id + `">` + value.nama_subdiv + `</option>`;
                })
               $("#subdivisi_id").html(string);
            }
        );
    }
   function myFunction() {
    var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
  

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d'
    });

</script>
@endsection