@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li><a href="/arsip/disposisi"> SURAT MASUK / Disposisi </a></li>
    <li>Ubah SURAT MASUK / Disposisi </li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/arsip/disposisi/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Surat Masuk</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body col-sm-10">
                <div class="widget-main no-padding">
                    tanda *) tidak wajib input
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal
                        </label>
                        <div class="col-sm-10" >
                            <input type="date" required readonly class="col-xs-3 col-sm-3"  name="tanggal" id="tanggal" value="{{$data->tanggal}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Agenda
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="no_agenda" readonly class="col-xs-12 col-sm-12" value="{{$data->no_agenda}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Surat
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="no_surat" class="col-xs-12 col-sm-12" required value="{{$data->no_surat}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Surat
                        </label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl_surat" class="col-xs-3 col-sm-3"  required value="{{$data->tgl_surat}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pengirim
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="pengirim" class="col-xs-12 col-sm-12" required value="{{$data->pengirim}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Hal
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="hal" class="col-xs-12 col-sm-12" required value="{{$data->hal}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tujuan*
                        </label>
                        <div class="col-sm-10">
                            <select  name="divisi_id" id="divisi_id" class="col-xs-12 col-sm-12 required">
                                <option value="">Pilih Bidang</option>
                                @foreach ($div as $item)
                                    @if ($data->divisi_id == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan*
                        </label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="" class="col-xs-12 col-sm-12"  rows="3">{{$data->keterangan}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> File
                        </label>
                        <div class="col-sm-10">
                            <input type="file" name="fileDispo" class="btn btn-default btn-sm" id="" value="Upload Ulang File User Disposisi">
                            <label><a href="{{$data->getfileDispo()}}" target="_blank" >{{$data->fileDispo}}</a></label>
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
