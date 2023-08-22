@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li><a href="/arsip/disposisi"> SURAT MASUK / Disposisi </a></li>
    <li>Buat SURAT MASUK / Disposisi </li>
@endsection
@section('content')

<style>

</style>


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('disposisi.store')}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Buat SURAT MASUK / Disposisi </h4>
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
                            <input type="date" required readonly class="col-xs-3 col-sm-3"  name="tanggal" id="tanggal" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Agenda
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="no_agenda" readonly class="col-xs-12 col-sm-12" value="{{$nodis}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Surat
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="no_surat" class="col-xs-12 col-sm-12" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Surat
                        </label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl_surat" class="col-xs-3 col-sm-3"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pengirim
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="pengirim" class="col-xs-12 col-sm-12" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Hal
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="hal" class="col-xs-12 col-sm-12" required>
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
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan*
                        </label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="" class="col-xs-12 col-sm-12"  rows="3"></textarea>
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