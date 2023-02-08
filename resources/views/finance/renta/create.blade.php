@extends('layouts.forma')
@section('breadcrumb')
    <li>RAPK</li>
    <li><a href="/finance/renta">Realisasi Capaian Target</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
method="post" action="{{route('renta.generate')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Realisasi capaian {{$div->nama}}</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" id="dates" value="{{date('Y-m-d')}}"
                                    class="col-xs-3 col-sm-3 " 
                                    name="dates"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Nama
                        </label>
                        <div class="col-sm-8">
                           <input type="text" class="col-xs-10 col-sm-10" value="{{auth()->user()->name}}" readonly>
                           <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                           <input type="hidden" name="divisi_id" value="{{auth()->user()->divisi_id}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Perjanjian Kinerja
                        </label>
                        <div class="col-sm-8">
                            <select name="eselontwo_id" class="col-xs-10 col-sm-10 select2">
                               @foreach ($rens as $item)
                                   <option value="{{$item->id}}"> Tahun {{$item->years}} 
                                    (dasar renstra : {{$item->renstrakal->filename}} -
                                    {{$item->renstrakal->yearfrom}} s/d {{$item->renstrakal->yearto}})</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Bulan
                        </label>
                        <div class="col-sm-8">
                            <select name="periodebln" class="col-xs-10 col-sm-10 select2">
                                <option value="">Pilih Bulan</option>
                                    @php
                                    $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                                     "September", "Oktober", "November", "Desember");
                                    for($a=1;$a<=12;$a++){
                                        $pilih="";
                                        echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
                                    }
                                    @endphp
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pilih Pagu
                        </label>
                        <div class="col-sm-8">
                            <select name="pagu_id" class="col-xs-10 col-sm-10 select2">
                                <option value="">Pilih Pagu</option>
                                @foreach ($pagu as $item)
                                    <option value="{{$item->id}}">{{$item->name}} ( {{tgl_indo($item->tgl_pagu)}} )</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Generate
        </button>
    </div>
</div>
</form>
@endsection

@section('footer')
    
@endsection