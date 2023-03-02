@extends('layouts.ren')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/teamwork"> Tim Kerja</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/finance/teamwork/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Ketua Tim Kerja</h4>
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
                        for="form-field-1"> Ketua Tim
                        </label>

                        <div class="col-sm-10">
                            <select id="users_id" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="null">Pilih Nama Ketua Tim</option>
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan
                        </label>

                        <div class="col-sm-10">
                            <input type="text"  placeholder="keterangan" value="{{$data->detail}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="detail" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">
                        </label>
                        <div class="col-sm-10">
                            @if ($data->aktif=='Y')
                            <input type="radio" required value="Y" checked name="aktif" id="Y"/><label class="control-label">Aktif </label>&nbsp;&nbsp;
                            <input type="radio" required value="N" name="aktif" id="N"/><label class="control-label">NonAktif </label>
                            @else
                            <input type="radio" required value="Y" name="aktif" id="Y"/> &nbsp; Aktif
                            <input type="radio" required value="N" checked name="aktif" id="N"/> &nbsp; NonAktif
                            @endif
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