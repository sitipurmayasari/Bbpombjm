@extends('layouts.app')
@section('breadcrumb')
    <li>Kendaraan</li>
    <li><a href="/invent/carrent"> Daftar pengajuan</a></li>
    <li>Persetujuan Kendaraan Dinas</li>
@endsection
@section('content')
@include('layouts.validasi')
<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/invent/carrent/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Persetujuan peminjaman Kendaraan Dinas</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-12">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Ajuan
                            </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$data->code}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="code"/>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Pengaju
                            </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$data->pegawai->name}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="users_name"/>  
                                <input type="hidden" name="users_id" value="{{$data->pegawai->id}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Peminjaman
                            </label>
                            <div class="col-sm-2">
                                <input type="text" value="{{$data->date_from}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="date_from" required id="date_from" />  
                                <label class="col-sm-2 control-label no-padding-right" 
                                    for="form-field-1"> s/d
                                </label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" value="{{$data->date_to}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="date_to" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kendaraan
                            </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$data->car->merk}} ({{$data->car->police_number}})" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="car_name"/> 
                                <input type="hidden" value="{{$data->car_id}})"
                                name="car-id"/>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tujuan
                            </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$data->destination}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="destination"/>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Supir
                            </label>
                            <div class="col-sm-9">
                                @if ($data->driver_id != '0')
                                    <input type="text" value="{{$data->supir->name}}" readonly
                                    class="col-xs-10 col-sm-10 required " 
                                    name="nama_driver"/>  
                                    <input type="hidden" value="{{$data->driver_id}}"
                                    name="driver_id"/>  
                                @else
                                    <input type="text" value="Tidak Menggunakan Supir" readonly
                                    class="col-xs-10 col-sm-10 required " 
                                    name="nama_driver"/>  
                                @endif
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Status
                            </label>
                            <div class="col-sm-9">
                                <input type="radio" required value="Y" 
                                name="status" id="Y"/> &nbsp; Disetujui  &nbsp;
                                <input type="radio" required value="N"
                                name="status" id="N"/> &nbsp; Ditolak
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> File Pendukung
                            </label>
                            <div class="col-sm-9">
                                @if ($data->file != null)
                                    <label><a href="{{$data->getFile()}}" target="_blank" >{{$data->file}}</a></label>
                                @else
                                    Tidak Ada Lampiran
                                @endif
                            </div>
                        </div>
                        </fieldset>
                    </div>
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