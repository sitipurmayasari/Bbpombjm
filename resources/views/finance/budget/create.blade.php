@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup Umum</li>
    <li><a href="/finance/budget">Kode Anggaran Dinas</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('budget.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Kode Anggaran Dinas</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kode Anggaran Dinas
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="kode Anggaran Dinas" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Anggaran Dinas
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Anggaran Dinas" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Angaran
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nomor Anggaran" 
                                        class="col-xs-10 col-sm-10 " 
                                        name="nomor"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Anggaran
                            </label>
                            <div class="col-sm-8">
                                <input type="date"  placeholder="Nama Anggaran Dinas" 
                                        class="col-xs-3 col-sm-3 " 
                                        name="tanggal"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tahun Anggaran
                            </label>
                            <div class="col-sm-8">
                                <input type="number"  placeholder="20XX" 
                                class="col-xs-3 col-sm-3 required " 
                                        name="tahun" required/>
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