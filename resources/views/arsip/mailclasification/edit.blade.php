@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/arsip/mailclasification">Klasifikasi Surat</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/arsip/mailclasification/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Klasifikasi Surat</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode SubKelompok
                            </label>
                            <div class="col-sm-8">
                                <select name="mailsubgroup_id" class="col-xs-10 col-sm-10 required select2" required>
                                    <option value="">Pilih Kode</option>
                                    @foreach ($subg as $peg)
                                        @if ($data->mailsubgroup_id==$peg->id)
                                            <option value="{{$peg->id}}" selected>{{$peg->alias}} || {{$peg->names}}</option>
                                        @else
                                            <option value="{{$peg->id}}">{{$peg->alias}} || {{$peg->names}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Klasifikasi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="kode Klasifikasi" 
                                        class="col-xs-10 col-sm-10 required " value="{{$data->code}}"
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Klasifikasi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Klasifikasi" value="{{$data->names}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="names" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Masa Aktif
                            </label>
                            <div class="col-sm-2">
                                <input type="number"  placeholder="0" id="aktif" onkeyup="hitung()" onclick="hitung()"
                                        class="col-xs-5 col-sm-5 required" name="actived" required  value="{{$data->actived}}"/>
                                <label class="col-sm-2 control-label no-padding-right" 
                                        for="form-field-1"> Tahun
                                        </label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text"  placeholder="keterangan" value="{{$data->ketactive}}"
                                    class="col-xs-9 col-xs-9 required " name="ketactive" />
                                       
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Masa Inaktif
                            </label>
                            <div class="col-sm-2">
                                <input type="number" required value="{{$data->innactive}}"  onkeyup="hitung()" onclick="hitung()"
                                        class="col-xs-5 col-sm-5 required " id="pasif"  name="innactive"  placeholder="0"/>
                                       
                                <label class="col-sm-2 control-label no-padding-right" 
                                        for="form-field-1"> Tahun
                                        </label>
                                <input type="hidden" value="{{$data->akhir}}" name="akhir" id="akhir">
                            </div>
                            <div class="col-sm-6">
                                <input type="text"  placeholder="keterangan" value="{{$data->ketinactive}}"
                                        class="col-xs-9 col-xs-9 keterangan " name="ketinactive"  />
                                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Status Akhir
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="mis: permanen, musnah, dll"  name="thelast"
                                        class="col-xs-10 col-sm-10 required "  value="{{$data->thelast}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Klasifikasi Keamanan
                            </label>
                            <div class="col-sm-8">
                                <select name="securitiesklas" class="col-xs-10 col-sm-10 required " id="klas" required onchange="getklas()">
                                    @if ($data->securitiesklas=='T')
                                        <option value="B">Biasa / Terbuka</option>
                                        <option value="T" selected>Terbatas</option>
                                        <option value="R">Rahasia</option>
                                        <option value="S">Sangat Rahasia</option>
                                    @elseif ($data->securitiesklas=='R')
                                        <option value="B">Biasa / Terbuka</option>
                                        <option value="T">Terbatas</option>
                                        <option value="R" selected>Rahasia</option>
                                        <option value="S">Sangat Rahasia</option>
                                    @elseif ($data->securitiesklas=='S')
                                        <option value="B">Biasa / Terbuka</option>
                                        <option value="T">Terbatas</option>
                                        <option value="R">Rahasia</option>
                                        <option value="S" selected>Sangat Rahasia</option>
                                    @else
                                        <option value="B" selected>Biasa / Terbuka</option>
                                        <option value="T">Terbatas</option>
                                        <option value="R">Rahasia</option>
                                        <option value="S">Sangat Rahasia</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Akses Internal
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$data->internal}}" id="inter"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="internal" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Akses Eksternal
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$data->eksternal}}" id="ekster"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="eksternal" required/>
                            </div>
                        </div>
                        </fieldset>        
               </div>
           </div>
        </div>
    </div>
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
    function hitung() {
        var a = parseInt($("#aktif").val());
        var b = parseInt($("#pasif").val());
        var c = a+b;
        $("#akhir").val(c);
    }

    function getklas(){
        var klas = $("#klas").val();

        if (klas=='S') {
            var a = "Pejabat Eselon I terkait, Pengawas Internal";
            var b = "Pengawas Eksternal, Penegak Hukum";
        } else if (klas=='T') {
            var a = "Pejabat Eselon II terkait, Pengawas Internal";
            var b = "Pengawas Eksternal, Penegak Hukum";
        } else if (klas=='R') {
            var a = "Pejabat Eselon I terkait, Pengawas Internal";
            var b = "Pengawas Eksternal, Penegak Hukum";
        } else {
            var a = "Pejabat Eselon III Terkait yang diberikan izin, pengawas internal";
            var b = "Pengawas eksternal, penegak hukum, publik (masyarakat umum)";
        }
        $("#inter").val(a);
        $("#ekster").val(b);

    }
   </script>
@endsection