@extends('layouts.mon')
@section('breadcrumb')
    <li><a href="/finance/travelexpenses">Biaya Perjalanan Dinas</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/travelexpenses/update/{{$data->id}}">
    {{ csrf_field() }}
        {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Ubah Biaya Perjalanan Dinas</h3></div>
                <div class="panel-body">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">Tanggal Kuitansi
                            </label>
                            <div class="col-sm-8">
                                <input type="date" required id="date" value="{{$data->date}}"
                                        class="col-xs-3 col-sm-3 required " 
                                        name="date"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Surat Tugas
                            </label>
                            <div class="col-sm-8"> 
                                <input type="text" required value="{{$data->st->number}}" readonly
                                        class="col-xs-3 col-sm-3 required " 
                                        name="nomorST"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Maksud Tugas
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly  value="{{$data->st->purpose}}" 
                                        class="col-xs-10 col-sm-10 " 
                                        name="purpose"/>
                            </div>
                        </div>
                    </fieldset>   
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-employee" data-toggle="tab">Uang Harian</a></li>
                <li><a href="#tab-transport" data-toggle="tab">Biaya Transport</a></li>
                <li><a href="#tab-ticket" data-toggle="tab">Tiket Pesawat</a></li>
                <li><a href="#tab-inn" data-toggle="tab">Penginapan</a></li>
        </ul>
        <div  class="tab-content" style="overflow: scroll">
                @include('finance.travelexpenses.partials_edits.employee')
                @include('finance.travelexpenses.partials_edits.transport')
                @include('finance.travelexpenses.partials_edits.ticket')
                @include('finance.travelexpenses.partials_edits.inn')
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