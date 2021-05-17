@extends('layouts.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/invent/petugas"> Petugas</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/invent/petugas/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Petugas</h4>
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
                        for="form-field-1"> Jenis Petugas
                        </label>

                        <div class="col-sm-10">
                            <input type="text"  placeholder="jenis tugas"  value="{{$data->jenis}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="jenis" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Petugas
                        </label>

                        <div class="col-sm-10">
                            <select id="user_id" name="user_id" class="col-xs-10 col-sm-10 select2">
                                <option value="null">Pilih Nama Petugas</option>
                                @foreach ($user as $peg)
                                    @if ($data->user_id==$peg->id)
                                        <option value="{{$peg->id}}" selected>{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @else
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endif
                                @endforeach
                            </select>
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