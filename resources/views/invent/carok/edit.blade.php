@extends('layouts.app')
@section('breadcrumb')
    <li>Kendaraan</li>
    <li><a href="/invent/carok">Persetujuan Peminjaman Kendaraan Dinas</a></li>
    <li>Pesetujuan</li>
@endsection
@section('content')
@include('layouts.validasi')
<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="/invent/carok/update/{{$data->id}}">
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
                            for="form-field-1"> Jenis Kendaraan
                            </label>
                            <div class="col-sm-9">
                                @if ($data->type =="C")
                                    <input type="radio" required value="C" id="mobil" checked disabled="disabled"
                                    name="type"/> &nbsp; Mobil &nbsp;
                                    <input type="radio" required value="M" id="motor" disabled="disabled"
                                    name="type"/> &nbsp; Motor
                                @else
                                    <input type="radio" required value="C" id="mobil" disabled="disabled"
                                    name="type"/> &nbsp; Mobil &nbsp;
                                    <input type="radio" required value="M" id="motor" checked disabled="disabled"
                                    name="type"/> &nbsp; Motor
                                @endif
                            </div>
                        </div>
                       @if ($data->type =="C")
                        <div class="form-group" id="supir">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Dengan Supir
                            </label>
                            <div class="col-sm-9">
                                @if ($data->drivers=="N")
                                    <input type="radio" required value="N" checked disabled="disabled"
                                    name="drivers"/> &nbsp; Tidak &nbsp;
                                    <input type="radio" required value="Y" disabled="disabled"
                                    name="drivers"/> &nbsp; Ya
                                @else
                                    <input type="radio" required value="N"  disabled="disabled"
                                    name="drivers"/> &nbsp; Tidak &nbsp;
                                    <input type="radio" required value="Y" checked disabled="disabled"
                                    name="drivers"/> &nbsp; Ya
                                @endif
                                
                            </div>
                        </div>
                        @if ($data->drivers=="N")
                            <div class="form-group" id="pengemudi">
                                <label class="col-sm-2 control-label no-padding-right" 
                                for="form-field-1"> Pengemudi 
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$data->pengemudi}}" readonly
                                    class="col-xs-10 col-sm-10 required " 
                                    name="pengemudi"/> 
                                </div>
                            </div>
                        @endif
                        <div class="form-group" id="jum">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jumlah Pengguna
                            </label>
                            <div class="col-sm-5">
                                <input type="number" placeholder="0" readonly
                                class="col-xs-1 col-sm-1 required "  value="{{$data->total}}" 
                                name="total"/> 
                                <label class="col-sm-4 control-label no-padding-right" 
                                for="form-field-1"> Dalam Satu Mobil
                                </label>
                            </div>
                        </div>
                       @endif
                       <div class="form-group" id="jum">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Keterangan
                            </label>
                            <div class="col-sm-9">
                                <textarea  class="col-xs-10 col-sm-10"  readonly
                                name="keterangan">{{$data->keterangan}}</textarea>
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
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kendaraan
                            </label>
                            <div class="col-sm-9">
                                <select name="car_id" class="col-xs-10 col-sm-10 required select2" id="car_id" required>
                                    <option value="">Pilih Kendaraan</option>
                                    @foreach ($car as $item)
                                        @if ($data->car_id == $item->id)
                                            <option value="{{$item->id}}" selected>{{$item->merk}} ( {{$item->police_number}} )</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->merk}} ( {{$item->police_number}} )</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       @if ($data->type=="C")
                       <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Supir
                        </label>
                        <div class="col-sm-9">
                            <select name="driver_id" id="driver_id" class="col-xs-10 col-sm-10 required select2">
                                <option value="">Pilih Supir</option> 
                                @foreach ($driver as $item)
                                    @if ($data->driver_id==$item->id)
                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                       @endif
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Status
                            </label>
                            <div class="col-sm-9">
                                @if ($data->status=="Y")
                                    <input type="radio" required value="Y" checked
                                    name="status" id="Y"/> &nbsp; Disetujui  &nbsp;
                                    <input type="radio" required value="N"
                                    name="status" id="N"/> &nbsp; Ditolak
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