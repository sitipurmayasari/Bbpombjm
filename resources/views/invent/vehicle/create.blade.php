@extends('layouts.app')
@section('breadcrumb')
    <li>Kendaraan</li>
    <li><a href="/invent/vehicle"> Kendaraan Dinas</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('vehicle.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Kendaraan Dinas</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Kendaraan
                            </label>
                            <div class="col-sm-9">
                                <input type="text"  placeholder="kode" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Kendaraan
                            </label>
                            <div class="col-sm-9">
                                <input type="radio" required value="M" checked 
                                name="type" id="M"/> &nbsp; Motor  &nbsp;
                                <input type="radio" required value="C"
                                name="type" id="C"/> &nbsp; Mobil
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk / Jenis Kendaraan
                            </label>
                            <div class="col-sm-9">
                                <input type="text"  placeholder="Merk/Jenis" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="merk" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Polisi
                            </label>
                            <div class="col-sm-9">
                                <input type="text"  placeholder="DA 9999 AAA" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="police_number" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Pajak
                            </label>
                            <div class="col-sm-5">
                                <input type="date"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="tax_date" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal PLat
                            </label>
                            <div class="col-sm-5">
                                <input type="date"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="police_number_date" required />
                            </div>
                        </div>

                </div>
           </div>
            </div>
        </div>
    </div><!-- /.col -->
    
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