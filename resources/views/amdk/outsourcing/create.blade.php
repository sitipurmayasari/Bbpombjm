@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Pegawai</li>
    <li><a href="/amdk/outsourcing"> Pegawai External</a></li>
    <li>Tambah Data Pegawai External</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('outsourcing.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Data Pegawai External</h4>
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
                            for="form-field-1"> NIP. Pegawai External
                            </label>
                            <div class="col-sm-8" id="tambah">
                                <input type="text"  placeholder="nomor pegawai"
                                        class="col-xs-10 col-sm-10 required" 
                                        name="no_pegawai" required  />
                                        *tidak boleh sama
                                <input type="hidden" value="N" name="aktif">
                                @error('no_pegawai')
                                    <span class="text-danger role="alert">
                                        {{ $message}}
                                    </span>
                                @enderror
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
                            for="form-field-1"> Nama (Tanpa gelar)
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nama (tanpa gelar)" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="namanogelar" />
                                <input type="hidden" name="tempat_lhr" value="osc">
                                <input type="hidden"  value="{{date('Y-m-d')}}" name="tanggal" />
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
                            for="form-field-1"> Status Kepegawaian
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="status" class="col-xs-10 col-sm-10" required>
                                    <option value="PNS">PNS</option>
                                    <option value="PPPK">PPPK</option>
                                    <option value="OSC">Lainnya</option>
                                </select>
                                <input type="hidden" name="jabatan_id" value="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Desk Job
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="desk job" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="deskjob" />
                                <input type="hidden" name="divisi_id" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jabatan Fungsional*
                            </label>
                            <div class="col-sm-8">
                                <select name="jabasn_id" id="jabasn_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Jabatan Fungsional</option>
                                    @foreach ($jabasn as $sub)
                                        <option value="{{$sub->id}}">{{$sub->nama}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalone">
                                    <i class="glyphicon glyphicon-plus"></i></button>
                                  </button>
                                  *Jika PNS/PPPK
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
                                        <option value="{{$sub->id}}">{{$sub->jenis}} / {{$sub->golongan}}/{{$sub->ruang}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltwo">
                                    <i class="glyphicon glyphicon-plus"></i></button>
                                  </button>
                                *Jika PNS/PPPK
                            </div>
                        </div>
                        
                        </fieldset>        
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

{{-- Modal 1 --}}
<div class="modal fade" id="modalone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jabatan Fungsional</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal validate-form" role="form" 
                method="post" action="{{route('outsourcing.storejafung')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    {{-- <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Jabatan
                        </label>
                        <div class="col-sm-8">
                            <select name="jabatan"  class="col-xs-10 col-sm-10 required " >
                                <option value="">Pilih Jabatan</option>
                                <option value="Ahli Pertama">Ahli Pertama</option>
                                <option value="Ahli Muda">Ahli Muda</option>
                                <option value="Ahli Madya">Ahli Madya</option>
                                <option value="Ahli Utama">Ahli Utama</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Nama Jabatan
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Mis : Apoteker Ahli Muda" class="col-xs-10 col-sm-10 required " 
                                    name="nama" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Kelompok Jabatan
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Mis : Ahli Muda" class="col-xs-10 col-sm-10 required " 
                                    name="kelompok" required />
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal 2 --}}
<div class="modal fade" id="modaltwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pangkat dan Golongan</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal validate-form" role="form" 
                    method="post" action="{{route('outsourcing.storepangol')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Jenis
                        </label>
                        <div class="col-sm-8" id="tambah" >
                            <input type="text"  placeholder="contoh : Pembina Tingkat I / BRIPKA"
                                    class="col-xs-10 col-sm-10 required" 
                                    name="jenis" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Golongan / Ruang 
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="contoh : IV"
                                    class="col-xs-2 col-sm-4 required" 
                                    name="golongan" required /> 
                            <input type="text"  placeholder="contoh : c"
                                    class="col-xs-2 col-sm-4 required" 
                                    name="ruang" required /> 
                        </div>    
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer')
<script>
   
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