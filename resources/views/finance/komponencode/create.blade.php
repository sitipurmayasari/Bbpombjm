@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/komponencode">Kode Komponen</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('komponencode.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Kode Komponen</h4>
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
                            for="form-field-1"> Kode Rincian Output
                            </label>
                            <div class="col-sm-8">
                                <select name="detailcode_id" class="col-xs-10 col-sm-10 required select2" required>
                                    <option value="">Pilih Kode</option>
                                    @foreach ($detail as $peg)
                                        <option value="{{$peg->id}}">{{$peg->unit->code}} - {{$peg->code}}
                                        </option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Komponen
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="kode Komponen" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Komponen
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama Komponen" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="name" required/>
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