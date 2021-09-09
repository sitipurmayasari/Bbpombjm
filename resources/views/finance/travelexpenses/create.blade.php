@extends('layouts.mon')
@section('breadcrumb')
    <li>Biaya Perjalanan Dinas</li>
    <li><a href="/finance/travelexpenses"></a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<style>
    .scrollit {
    overflow:scroll;
    height:100px;
}
</style>

<form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('travelexpenses.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Input Biaya Perjalanan Dinas</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" required id="st_date"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="st_date"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Surat Tugas
                        </label>
                        <div class="col-sm-8"> 
                            <select name="outstation_id" class="col-xs-10 col-sm-10 required select2" required id="out" 
                            onchange="getpeg()">
                                <option value="">Pilih Nomor Surat Tugas</option>
                                @foreach ($st as $item)
                                    <option value="{{$item->id}}">{{$item->number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Maksud Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama kegiatan" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="purpose" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Maksud Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama kegiatan" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="purpose" required/>
                        </div>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-employee" data-toggle="tab">Pegawai</a></li>
        <li><a href="#tab-transport" data-toggle="tab">Biaya Transport</a></li>
        <li><a href="#tab-ticket" data-toggle="tab">Tiket Pesawat</a></li>
        <li><a href="#tab-inn" data-toggle="tab">Penginapan</a></li>
        <li><a href="#tab-driver" data-toggle="tab">Kendaraan Dinas</a></li>
    </ul>

    <div class="tab-content">
        @include('finance.travelexpenses.partials.transport')
        @include('finance.travelexpenses.partials.ticket')
        @include('finance.travelexpenses.partials.inn')
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

@endsection

@section('footer')
   <script>
   </script>
@endsection