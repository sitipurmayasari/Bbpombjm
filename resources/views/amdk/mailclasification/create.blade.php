@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/mailclasification">Klasifikasi Surat</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('mailclasification.store')}}" enctype="multipart/form-data">
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
                                        <option value="{{$peg->id}}">{{$peg->alias}} || {{$peg->names}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Klasifikasi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="mis : 02" 
                                        class="col-xs-2 col-sm-2 required " 
                                        name="code" required />
                                <label> *jika tidak ada klasifikasi turunan ketik : 00
                                </label>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Klasifikasi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Klasifikasi" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="names" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Masa Aktif
                            </label>
                            <div class="col-sm-8">
                                <input type="number"  placeholder="0" value="0"
                                        class="col-xs-1 col-sm-1 required " 
                                        name="actived" required />
                                <label class="col-sm-1 control-label no-padding-right" 
                                        for="form-field-1"> Tahun
                                        </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Masa Inaktif
                            </label>
                            <div class="col-sm-8">
                                <input type="number"  placeholder="0" value="0"
                                        class="col-xs-1 col-sm-1 required " 
                                        name="innactive" required />
                                <label class="col-sm-1 control-label no-padding-right" 
                                        for="form-field-1"> Tahun
                                        </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Melewati Pengececkan
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" required value="Y" checked 
                                    name="ceking" id="L"/> &nbsp; Ya  &nbsp;
                                <input type="radio" required value="N"
                                    name="ceking" id="P"/> &nbsp; Tidak
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Status Akhir
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" required value="permanen" checked 
                                    name="thelast" id="L"/> &nbsp; permanen  &nbsp;
                                <input type="radio" required value="musnah" 
                                    name="thelast" id="P"/> &nbsp; musnah &nbsp;
                                <input type="radio" required value="dinilai kembali"
                                    name="thelast" id="P"/> &nbsp; dinilai kembali
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
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>

@endsection