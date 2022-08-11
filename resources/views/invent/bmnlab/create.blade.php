@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/bmnlab">BMN LAB</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('bmnlab.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input BMN LAB</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Barang
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" value="R" name="kind"  />
                                <input type="text"  placeholder="nomor pegawai" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="kode_barang" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama barang
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="nama_barang" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk/Type
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="merk" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="merk" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Terima
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="tanggal_diterima" readonly class="col-xs-10 col-sm-10" 
                                data-date-format="yyyy-mm-dd" data-provide="datepicker">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Seri
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="merk" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="no_seri" />
                                <input type="hidden" value="22" name="jenis_barang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Satuan
                            </label>
                            <div class="col-sm-8">
                                <select name="satuan_id" id="satuan_id" class="col-xs-10 col-sm-10">
                                        @foreach ($satuan as $lok)
                                            <option value="{{$lok->id}}">{{$lok->satuan}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Lokasi
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="lokasi" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Lokasi Barang</option>
                                    @foreach ($lokasi as $lok)
                                        <option value="{{$lok->id}}">{{$lok->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Penanggung Jawab
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="penanggung_jawab" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Nama Pegawai</option>
                                    @foreach ($user as $peg)
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Status
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" name="status" value="baik" checked>
                                <label class="control-label no-padding-right" for="form-field-1"> Baik</label> 
                                &nbsp;&nbsp;
                                <input type="radio" name="status" value="rusak">
                                <label class="control-label no-padding-right" for="form-field-1"> Rusak</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Link Video Penggunaan
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="merk" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="link_video" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" s
                            for="form-field-1"> Spesifikasi Barang
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                name="spesifikasi"></textarea>
                            </div>
                        </div>
                        
                        </fieldset>        
                    </div>
               </div>
               <div class="col-sm-6">
                   <br>
                <div class="widget-main no-padding">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Prosedur Maintenace
                        </label>
                        <div class="col-sm-9">
                                <input type="file" name="file_user_manual" class="btn btn-default btn-sm" id="" value="Upload File Prosedur Maintenance">      
                                <label><i>ex:Lorem_ipsum.pdf</i></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> IKA
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file_user_manual" class="btn btn-default btn-sm" id="" value="Upload File IKA">      
                            <label><i>ex:Lorem_ipsum.pdf</i></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> SERTIFIKAT KALIBRASI
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file_sert" class="btn btn-default btn-sm" id="" value="Upload File Sertifikasi">      
                            <label><i>ex:Lorem_ipsum.pdf</i></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Foto Barang
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file_foto" class="btn btn-success btn-sm" id="" 
                            value="Upload Foto Barang">   
                            <label><i>ex:Lorem_ipsum.jpg/.jpeg/.png</i></label>   
                        </div>
                        
                    </div>
{{-- 
                    <div class="form-actions" align="center">
                        <div class="col-sm-9">
                            <input type="file" name="file_foto" class="btn btn-default btn-sm" id="" 
                            value="Upload File User Manual">      
                            <label><i>ex:Lorem_ipsum_dolor_sit_amet.jpg</i></label>
                        </div>
                         <button class="btn btn-success btn-sm " type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>Upload Foto Barang
                        </button><br>
                        <img src="{{asset('images/user/userempty.png')}}"  style="height:250px;width:200px">
                        <br>
                    </div>      --}}
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