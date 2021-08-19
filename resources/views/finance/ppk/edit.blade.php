@extends('layouts.app')
@section('breadcrumb')
    <li>Setup Umum</li>
    <li><a href="/finance/ppk"> Pejabat Pembuat Komitmen</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/finance/ppk/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Pejabat Pembuat Komitmen</h4>
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
                        for="form-field-1"> Kode PPK
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="kode"  value="{{$data->code}}" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="code" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama
                        </label>
                        <div class="col-sm-10">
                            <select id="users_id" name="users_id" class="col-xs-10 col-sm-10 select2">
                                <option value="null">Pilih Nama Petugas</option>
                                @foreach ($user as $peg)
                                    @if ($data->users_id==$peg->id)
                                        <option value="{{$peg->id}}" selected>{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @else
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jabatan
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="Pejabat Pembuat Komitmen 1" 
                                    class="col-xs-10 col-sm-10 required "  value="{{$data->jabatan}}" 
                                    name="jabatan" required />
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
    </div><!-- /.col -->
    
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