@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Pegawai</li>
    <li><a href="/amdk/outsourcing"> Pegawai External</a></li>
    <li>Ubah Data Pegawai External</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/amdk/outsourcing/update/{{$data->id}}" enctype="multipart/form-data">
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
                                <input type="text"  placeholder="nomor pegawai" value="{{$data->no_pegawai}}"
                                        class="col-xs-10 col-sm-10 required" 
                                        name="no_pegawai" required  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Pegawai
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama"  value="{{$data->name}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama (Tanpa gelar)
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nama (tanpa gelar)" value="{{$data->namanogelar}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="namanogelar" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Kelamin
                            </label>
                            <div class="col-sm-8">
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
                            for="form-field-1"> Status Kepegawaian
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="status" class="col-xs-10 col-sm-10">
                                    @if ($data->status==="PNS")
                                        <option value="">Pilih Status</option>
                                        <option value="PNS" selected>PNS</option>
                                        <option value="OSC">Outsourcing</option>
                                    @elseif ($data->status==="OSC")
                                        <option value="">Pilih Status</option>
                                        <option value="PNS">PNS</option>
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
                            for="form-field-1"> Desk Job
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="desk job"  value="{{$data->deskjob}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="deskjob" />
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
                                       @if ($data->jabasn_id==$sub->id)
                                       <option value="{{$sub->id}}" selected>{{$sub->nama}}</option>
                                       @else
                                       <option value="{{$sub->id}}">{{$sub->nama}}</option>
                                       @endif
                                    @endforeach
                                </select>
                                *Jika PNS
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
                                *Jika PNS
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
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
<script>

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});

</script>
@endsection