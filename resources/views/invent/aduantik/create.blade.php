@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li><a href="/invent/aduantik/bidang">Aduan TIK</a></li>
    <li>Input Aduan TIK</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('aduantik.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <fieldset>
                <div class="col-md-4">
                    <label for="">NO. ADUAN*</label>
                    <input type="text" id="no_adu" readonly required
                    class="col-xs-10 col-sm-10 required " 
                    name="no_aduan"
                    value="{{$no_aduan}}"/>
                    <input type="hidden" name="divisi_id" value={{$div}}/>
                </div>
                <div class="col-md-4">
                    <label for="">TANGGAL ADUAN *</label>
                    <input type="text" name="tanggal" readonly 
                                class="col-xs-10 col-sm-10 required" value="{{date('Y-m-d')}}" required
                                data-date-format="yyyy-mm-dd" data-provide="datepicker">
                </div>
                <div class="col-md-4">
                    <label > PELAPOR *</label><br>
                    <select id="peg" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                            <option value="">pilih nama pegawai</option>
                        @foreach ($user as $peg)
                            <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                        @endforeach
                    </select>
                </div>
                </fieldset>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Barang yang di Adukan</h3></div>
            <div class="panel-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Barang*
                        </label>
                        <div class="col-sm-8">
                            <select name="itasset_id" class="col-xs-10 col-sm-10 select2" id="itasset_id">
                                <option value="">-Pilih-</option>
                                @foreach ($data as $item)
                                    <option value="{{$item->id}}">{{$item->nama_barang}} (Kode barang : {{$item->kode_barang}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Masalah / Kerusakan*
                        </label>
                        <div class="col-sm-8">
                            <textarea name="trouble"  required class="col-xs-10 col-sm-10" rows="10"></textarea>
                        </div>
                    </div>
                    </fieldset>        
               
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Simpan
        </button>
    </div>
</div>
</form>

@endsection
