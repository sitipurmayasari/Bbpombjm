@extends('layouts.app')
@section('breadcrumb')
    <li><i class="ace-icon fa fa-table home-icon"></i>  <a href="/invent/aduantik">Aduan</a></li>
    <li>No {{$aduan->no_aduan}}</li>

@endsection
@section('content')
<form Class="form-horizontal validate-form" role="form" 
method="post" action="/invent/aduantik/update2/{{$aduan->id}}">
{{ csrf_field() }}
<div class="panel panel-default table-responsive hidden-xs">
    <fieldset>
    <table class="table table-condensed table-bordered">
        <tr>
            <td class="col-xs-2 text-center">No. Aduan</td>
            <td class="col-xs-2 text-center">Tanggal</td>
            <td class="col-xs-2 text-center">Pelapor</td>
            <td class="col-xs-2 text-center">Status</td>
        </tr>
        <tr>
            <td class="text-center lead" style="border-top: none;">{{$aduan->no_aduan}}</td>
            <td class="text-center lead" style="border-top: none;">{{$aduan->tanggal}}</td>
            <td class="text-center lead" style="border-top: none;">{{$aduan->lapor->no_pegawai}} <br> {{$aduan->lapor->name}}</td>
            <td>
                @if ($aduan->status != 2)
                    <select name="status"  class="form-control">
                        <option value="0" {{$aduan->status==0 ? 'selected' : ''}}>Belum diperiksa</option>
                        <option value="1" {{$aduan->status==1 ? 'selected' : ''}}>Sedang Diproses</option>
                        <option value="2" {{$aduan->status==2 ? 'selected' : ''}}>Selesai Diproses</option>
                    </select>                   
                @else
                    <input type="hidden" name="status" value="{{$aduan->status}}">Selesai Diproses
                @endif
            </td>
        </tr>
    </table>
    </fieldset>
</div>
<div class="clearfix"></div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Barang yang di Adukan</h3></div>
        <div class="panel-body">
            <div class="widget-main no-padding">
                <fieldset>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Tanggal Aduan 
                    </label>
                    <div class="col-sm-8">
                        <input type="date" name="analyze_date" 
                        class="col-xs-3 col-sm-3 required" value="{{$aduan->tanggal}}" readonly required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Nama Barang
                    </label>
                    <div class="col-sm-8">
                        <input type="text" readonly value="{{$aduan->barang->nama_barang}}"
                        class="col-xs-10 col-sm-10 ">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Kode Barang
                    </label>
                    <div class="col-sm-8">
                        <input type="text" readonly value="{{$aduan->barang->kode_barang}}"
                        class="col-xs-10 col-sm-10 ">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Lokasi*
                    </label>
                    <div class="col-sm-8">
                        <input type="text" id="lokasi" readonly name="lokasi" value="{{$aduan->barang->lokasi}}"
                        class="col-xs-10 col-sm-10 ">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Penanggung Jawab*
                    </label>
                    <div class="col-sm-8">
                        <input type="text" id="tanggung" readonly value="{{$aduan->barang->penanggung->name}}"
                        class="col-xs-10 col-sm-10"  >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Masalah / Kerusakan
                    </label>
                    <div class="col-sm-8">
                        <textarea class="col-xs-10 col-sm-10" style="background-color:rgb(233, 233, 233);" >{{$aduan->trouble}}
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Tanggal Analisa 
                    </label>
                    <div class="col-sm-8">
                        <input type="date" name="analyze_date" 
                        class="col-xs-3 col-sm-3 required" value="{{$aduan->analyze_date}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1">Analisa Pemeriksa
                    </label>
                    <div class="col-sm-8">
                        <textarea name="analisa" required class="col-xs-10 col-sm-10">{{$aduan->analisa}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Tanggal Tindak Lanjut 
                    </label>
                    <div class="col-sm-8">
                        <input type="date" name="followup_date" 
                        class="col-xs-3 col-sm-3 required" value="{{$aduan->followup_date}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1">Tindak Lanjut
                    </label>
                    <div class="col-sm-8">
                        <textarea name="follow_up" required class="col-xs-10 col-sm-10">{{$aduan->follow_up}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Tanggal Hasil 
                    </label>
                    <div class="col-sm-8">
                        <input type="date" name="result_date" 
                        class="col-xs-3 col-sm-3 required" value="{{$aduan->result_date}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Hasil
                    </label>
                    <div class="col-sm-8">
                        <textarea name="result" class="col-xs-10 col-sm-10">{{$aduan->result}}</textarea>
                    </div>
                </div>
                </fieldset>        
           
            </div>
        </div>
    </div>
</div>
    <div class="form-actions right">
        {{-- @if ($aduan->status != 2) --}}
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>UPDATE
        </button>
        {{-- @endif --}}
       
    </div>
</form>
  
@endsection
