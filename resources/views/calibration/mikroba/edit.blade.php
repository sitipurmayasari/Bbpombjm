@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.tomi')
@section('breadcrumb')
    <li><a href="/calibration/mikroba"> Monitoring Mikroba</a></li>
    <li>Ubah Monitoring Mikroba</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
    method="post" action="/calibration/mikroba/update/{{$data->id}}">
   {{ csrf_field() }}
   <style>
        th{
            text-align: center;
            vertical-align: middle;
        }
   </style>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pengujian</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Kode Baku Uji
                        </label>
                        <div class="col-sm-8">
                            <input type="text" readonly value="{{$data->number}}"
                                    class="col-xs-3 col-sm-3 required " 
                                    required/> &nbsp; &nbsp;
                            <input type="text" name="kode"  class="col-xs-5 col-sm-5 required" placeholder="kode" value="{{$data->kode}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" name="dates" readonly class="col-xs-3 col-sm-3 required" 
                                value="{{$data->dates}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Nama Bakteri
                        </label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="col-xs-10 col-sm-10 required" 
                            value="{{$data->bakteri->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penguji
                        </label>
                        <div class="col-sm-8">
                            <select name="users_id" required class="col-xs-10 col-sm-10 required select2" >
                                <option value="">Pilih Penguji Mikrobiologi</option>
                                @foreach ($peg as $item)
                                    @if ($item->id == $data->users_id)
                                        <option value="{{$item->id}}" selected>{{$item->name}} ({{$item->no_pegawai}})</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->name}} ({{$item->no_pegawai}})</option>
                                    @endif
                                @endforeach
                           </select>
                        </div>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Kegiatan Pengujian</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="table-responsive">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <th>No</th>
                                <th class="col-sm-2">Tangal</th>
                                <th>Kegiatan</th>
                                <th class="col-sm-6">Keterangan</th>
                            <thead>
                            <tbody>   	
                                <tr>
                                    <td style="text-align: center">1</td>
                                    <td>
                                        <input type="date" name="media_date" class="form-control"  value="{{$data->media_date}}" 
                                        required>
                                    </td>
                                    <td>Pembuatan Media</td>
                                    <td>
                                        <input type="text" class="form-control" name="media_ket" value="{{$data->media_ket}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">2</td>
                                    <td>
                                        <input type="date" name="baku_date" class="form-control" value="{{$data->baku_date}}" 
                                        required>
                                    </td>
                                    <td>Pengambilan Baku Uji</td>
                                    <td>
                                        <input type="number" class="col-sm-2" name="baku_ket" value="{{$data->baku_ket}}"> &nbsp;&nbsp;
                                        Bead
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">3</td>
                                    <td>
                                        <input type="date" name="tumbuh_date" class="form-control"  value="{{$data->tumbuh_date}}" 
                                        required>
                                    </td>
                                    <td>Media Pertumbuhan</td>
                                    <td>
                                        <input type="number" class="col-sm-2" name="tumbuh_ket" value="{{$data->tumbuh_ket}}"> &nbsp;&nbsp;
                                        mL BHIB
                                    </td>
                                </tr>
                            <tbody>
                        </table>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pengamatan</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="table-responsive">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="col-sm-2">Tanggal</th>
                                    <th rowspan="2">Media</th>
                                    <th colspan="2">Inkubasi</th>
                                    <th colspan="2">Pengamatan</th>
                                </tr>
                                <tr>
                                    <th>Suhu (°C)</th>
                                    <th>Waktu (Jam)</th>
                                    <th class="col-sm-3">Baku Uji</th>
                                    <th class="col-sm-3">Pengamatan</th>
                                </tr>
                            <thead>
                            <tbody>
                                @foreach ($detail as $item)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="detail_id[]" value="{{$item->id}}">
                                            <input type="date" name="amati_date[]" class="form-control" value="{{$item->amati_date}}"/>
                                        </td>
                                        <td>{{$item->media->name}}
                                        </td>
                                        <td>{{$item->media->temperature}}
                                        </td>
                                        <td>{{$item->media->period}}
                                        </td>
                                        <td>
                                            @php
                                                $daftarkontrol = $injectQuery->dafkontrol($item->media_id);
                                            @endphp

                                            <select name="kontrol_id[]" class="form-control select2">
                                                @foreach ($daftarkontrol as $isi)
                                                    @if ($isi->id == $item->kontrol_id)
                                                        <option value="{{$isi->id}}" selected>{{$isi->status}}</option>
                                                    @else
                                                        <option value="{{$isi->id}}">{{$isi->status}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            @php
                                                $kontrol = $injectQuery->carikontrol($item->media_id);
                                            @endphp
                                            {{$kontrol->status}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>	
                        </table>
                    </div>
                </fieldset>   
   
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Hasil Pengamatan</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pengamatan
                        </label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Positif" value="{{$data->hasil}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="hasil"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kesimpulan
                        </label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="kesimpulan" value="{{$data->kesimpulan}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="kesimpulan"/>
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
@endsection