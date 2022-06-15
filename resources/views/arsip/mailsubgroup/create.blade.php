@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/arsip/mailsubgroup">Subkelompok Surat</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('mailsubgroup.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Subkelompok Surat</h4>
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
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Kelompok
                            </label>
                            <div class="col-sm-8">
                                <select name="mailgroup_id" class="col-xs-10 col-sm-10 required " required>
                                    <option value="">Pilih Kode</option>
                                    @foreach ($group as $peg)
                                        <option value="{{$peg->id}}">{{$peg->code}} || {{$peg->names}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode SubKelompok
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="mis : 02" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Sub Kelompok
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Rincian" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="names" required/>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Kelompok
                            </label>
                            <div class="col-sm-8">
                                <select name="securities" class="col-xs-10 col-sm-10 required " required>
                                    <option value="B">Biasa</option>
                                    <option value="T">Terbatas</option>
                                    <option value="R">Rahasia</option>
                                    <option value="S">Sangat Rahasia</option>
                                </select>
                            </div>
                        </div> --}}
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