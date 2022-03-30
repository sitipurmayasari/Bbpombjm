@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pegawai"> Pegawai</a></li>
    <li>Edit Data Pegawai</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/amdk/pegawai/update/{{$data->id}}" enctype="multipart/form-data">
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
                            for="form-field-1">  NIP. Pegawai
                            </label>
                            <div class="col-sm-8" id="tambah">
                                <input type="text" readonly value="{{$data->no_pegawai}}"
                                        class="col-xs-10 col-sm-10 required" 
                                        name="no_pegawai" required  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Pegawai
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->name}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama (Tanpa gelar)
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$data->namanogelar}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="namanogelar" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tempat Lahir
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="tempat_lhr" class="col-xs-10 col-sm-10 required" 
                                placeholder ="tempat lahir" required value="{{$data->tempat_lhr}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Lahir
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_lhr" value="{{$data->tgl_lhr}}" 
                                class="col-xs-10 col-sm-10" data-date-format="yyyy-mm-dd" 
                                data-provide="datepicker" readonly>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Kelamin
                            </label>
                            <div class="col-sm-8" style="margin: center;">
                                @if ($data->jkel=='L')
                                    <input type="radio" required value="L" checked name="jkel" id="L"/> 
                                    &nbsp; Laki - laki  &nbsp;
                                    <input type="radio" required value="P" name="jkel" id="P"/> 
                                    &nbsp; Perempuan
                                @else
                                    <input type="radio" required value="L" name="jkel" id="L"/> 
                                    &nbsp; Laki - Laki  &nbsp;
                                    <input type="radio" required value="P" checked name="jkel" id="P"/> 
                                    &nbsp; Perempuan  
                                @endif
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Agama
                            </label>
                            <div class="col-sm-8">
                                <select id="agama" name="agama" class="col-xs-10 col-sm-10" required>
                                    @if ($data->agama=='Katolik')
                                        <option value="Islam" >Islam</option>
                                        <option value="Katolik" selected>Katolik</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    @elseif($data->agama=='Protestan')
                                        <option value="Islam" >Islam</option>
                                        <option value="Katolik" >Katolik</option>
                                        <option value="Protestan" selected>Protestan</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    @elseif($data->agama=='Hindu')
                                        <option value="Islam" >Islam</option>
                                        <option value="Katolik" >Katolik</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Hindu" selected>Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    @elseif($data->agama=='Budha')
                                        <option value="Islam" >Islam</option>
                                        <option value="Katolik" >Katolik</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha" selected>Budha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    @elseif($data->agama=='Khonghucu')
                                        <option value="Islam" >Islam</option>
                                        <option value="Katolik" >Katolik</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha" >Budha</option>
                                        <option value="Khonghucu" selected>Khonghucu</option>
                                    @else
                                        <option value="Islam" selected>Islam</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Alamat
                            </label>
                            <div class="col-sm-8">
                                <textarea
                                class="col-xs-10 col-sm-10"  name="alamat">{{$data->alamat}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Telp
                            </label>
                            <div class="col-sm-8">
                                <input type="number"  value="{{$data->telp}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="telp" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Email
                            </label>
                            <div class="col-sm-8">
                                <input type="email"  value="{{$data->email}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="email" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Status Pernikahan
                            </label>
                            <div class="col-sm-8" style="margin: center;">
                                @if ($data->nikah=='Y')
                                <input type="radio" required value="Y" checked name="nikah" id="Y"/> 
                                &nbsp; Menikah  &nbsp;
                                <input type="radio" required value="N" name="nikah" id="N"/> 
                                &nbsp; Lajang
                                @else
                                <input type="radio" required value="Y" name="nikah" id="Y"/> 
                                &nbsp; Menikah  &nbsp;
                                <input type="radio" required value="N" checked name="nikah" id="N"/> 
                                &nbsp; Lajang  
                                @endif
                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Status Kepegawaian
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="status" class="col-xs-10 col-sm-10">
                                    @if ($data->status==="PNS")
                                        <option value="">Pilih Status</option>
                                        <option value="PNS" selected>PNS</option>
                                        <option value="PPNPN">PPNPN</option>
                                        <option value="Magang">Magang</option>
                                        <option value="OSC">Outsourcing</option>
                                    @elseif ($data->status==="PPNPN")
                                        <option value="">Pilih Status</option>
                                        <option value="PNS">PNS</option>
                                        <option value="PPNPN" selected>PPNPN</option>
                                        <option value="Magang">Magang</option>
                                        <option value="OSC">Outsourcing</option>
                                    @elseif ($data->status==="Magang")
                                        <option value="">Pilih Status</option>
                                        <option value="PNS">PNS</option>
                                        <option value="PPNPN">PPNPN</option>
                                        <option value="Magang" selected>Magang</option>
                                        <option value="OSC">Outsourcing</option>
                                    @elseif ($data->status==="OSC")
                                        <option value="">Pilih Status</option>
                                        <option value="PNS">PNS</option>
                                        <option value="PPNPN">PPNPN</option>
                                        <option value="Magang">Magang</option>
                                        <option value="OSC" selected>Outsourcing</option>
                                    @else
                                        <option value="">Pilih Status</option>
                                        <option value="PNS">PNS</option>
                                        <option value="PPNPN">PPNPN</option>
                                        <option value="Magang">Magang</option>
                                        <option value="OSC">Outsourcing</option>
                                    @endif
                                    
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
                                        @if ($data->jabatan_id==$jab->id)
                                            <option value="{{$jab->id}}" selected>{{$jab->jabatan}}</option>
                                        @else
                                            <option value="{{$jab->id}}">{{$jab->jabatan}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Desk Job
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->deskjob}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="deskjob" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kelompok
                            </label>
                            <div class="col-sm-8">
                                <select  name="divisi_id" id="divisi_id" onchange="getSubdivisiId()" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih kelompok</option>
                                    @foreach ($divisi as $div)
                                        @if ($data->divisi_id==$div->id)
                                            <option value="{{$div->id}}" selected>{{$div->nama}}</option>
                                        @else
                                            <option value="{{$div->id}}">{{$div->nama}}</option>
                                        @endif
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
                                    @foreach ($subdivisi as $sub)
                                        @if ($data->subdivisi_id==$sub->id)
                                            <option value="{{$sub->id}}" selected>{{$sub->nama_subdiv}}</option>
                                        @else
                                            <option value="{{$sub->id}}">{{$sub->nama_subdiv}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Jabatan Fungsional*
                            </label>
                            <div class="col-sm-8">
                                <select name="jabasn_id" id="jabasn_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Jabatan Fungsional</option>
                                    @foreach ($jabasn as $sub)
                                       @if ($data->jabasn_id==$sub->id)
                                       <option value="{{$sub->id}}" selected>{{$sub->nama}}</option>
                                       @else
                                       <option value="{{$sub->id}}">{{$sub->nama}}</option>
                                       @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pangkat & Golongan*
                            </label>
                            <div class="col-sm-8">
                                <select name="golongan_id" id="golongan_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Pangkat dan Golongan</option>
                                    @foreach ($gol as $sub)
                                       @if ($data->golongan_id==$sub->id)
                                       <option value="{{$sub->id}}" selected>{{$sub->jenis}} / {{$sub->golongan}}/{{$sub->ruang}}</option>
                                       @else
                                       <option value="{{$sub->id}}">{{$sub->jenis}} / {{$sub->golongan}}/{{$sub->ruang}}</option>
                                       @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nomor Seri Karpeg*
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  class="col-xs-10 col-sm-10 required " 
                                name="seri_karpeg"  value="{{$data->seri_karpeg}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> TMT Capeg*
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="TMT_Capeg" readonly class="col-xs-10 col-sm-10 required" value="{{$data->TMT_Capeg}}"
                                data-date-format="yyyy-mm-dd" data-provide="datepicker" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Password
                            </label>
                            <div class="col-sm-8">
                                <input type="password"  value=""
                                        placeholder="Kosongkan password jika tidak ingin merubah"
                                        class="col-xs-10 col-sm-10 required "
                                        name="password_new" id="myInpute"/> &nbsp; 
                                <i class="fa fa-eye" onclick="eye()"></i>
                            </div>
                        </div>
                        
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-4">
                &nbsp;
                <div class="form-group">
                    <div class="col-sm-10">
                        @if ($data->aktif=='Y')
                        <input type="radio" required value="Y" checked name="aktif" id="Y"/> &nbsp; Aktif
                        <input type="radio" required value="N" name="aktif" id="N"/> &nbsp; NonAktif
                        @else
                        <input type="radio" required value="Y" name="aktif" id="Y"/> &nbsp; Aktif
                        <input type="radio" required value="N" checked name="aktif" id="N"/> &nbsp; NonAktif
                        @endif
                        
                    </div>
                </div>
                <div class="form-actions" style="text-align: center">
                    <input type="file" name="foto2" class="btn btn-success btn-sm" id="" 
                        value="Upload Ulang Foto Barang">   
                    <img src="{{$data->getFoto()}}"  style="height:250px;width:250px">
                    <br>
                    <label><i class="bg bg-warning">** Kosongkan Upload ulang jika tidak ingin merubah gambar</i></label>
                </div>    
           </div>
            </div>
        </div>
    </div><!-- /.col -->
    
    <div class="col-sm-12">
       
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
<script>
function eye() {
    var x = document.getElementById("myInpute");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


// function getSubdivisiId(){
         var divisi_id = $("#divisi_id").val();
         var peg = {{$data->subdivisi_id}}
         console.log(peg);
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

                // $.each(data, function(index, value) {
                //     if (peg==value.id) {
                //         string = string + `<option value="` + value.id + `" selected>` + value.nama_subdiv + `</option>`;
                //     } else {
                //         string = string + `<option value="` + value.id + `">` + value.nama_subdiv + `</option>`;
                //     }
                    
                // })

               $("#subdivisi_id").html(string);
               
            }
        );
    }

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});

</script>
@endsection