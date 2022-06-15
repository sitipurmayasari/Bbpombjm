@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/arsip/mailsubgroup">Subkelompok Surat</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/arsip/mailsubgroup/update/{{$data->id}}">
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
                                        @if ($data->mailgroup_id==$peg->id)
                                            <option value="{{$peg->id}}" selected>{{$peg->code}} || {{$peg->names}}</option>
                                        @else
                                            <option value="{{$peg->id}}">{{$peg->code}} || {{$peg->names}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode SubKelompok
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="kode SubKelompok" 
                                        class="col-xs-10 col-sm-10 required " value="{{$data->code}}"
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama SubKelompok
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama SubKelompok" value="{{$data->names}}"
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
                                    @if ($data->securities=='T')
                                        <option value="B">Biasa</option>
                                        <option value="T" selected>Terbatas</option>
                                        <option value="R">Rahasia</option>
                                        <option value="S">Sangat Rahasia</option>
                                    @elseif ($data->securities=='R')
                                        <option value="B">Biasa</option>
                                        <option value="T">Terbatas</option>
                                        <option value="R" selected>Rahasia</option>
                                        <option value="S">Sangat Rahasia</option>
                                    @elseif ($data->securities=='S')
                                        <option value="B">Biasa</option>
                                        <option value="T">Terbatas</option>
                                        <option value="R">Rahasia</option>
                                        <option value="S" selected>Sangat Rahasia</option>
                                    @else
                                        <option value="B" selected>Biasa</option>
                                        <option value="T">Terbatas</option>
                                        <option value="R">Rahasia</option>
                                        <option value="S">Sangat Rahasia</option>
                                    @endif
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
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>

@endsection