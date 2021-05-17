@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/jurusan"> Jurusan</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/jurusan/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Jurusan</h4>
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
                        for="form-field-1"> Jenjang Pendidikan
                        </label>

                        <div class="col-sm-8">
                            <select id="pendidikan_id" name="pendidikan_id" class="col-xs-10 col-sm-10 select2">
                                <option value="null">Pilih Jenjang Pendidikan</option>
                                @foreach ($jenjang as $peg)
                                    @if ($data->pendidikan_id==$peg->id)
                                    <option value="{{$peg->id}}" selected >{{$peg->jenjang}}</option>
                                    @else
                                        <option value="{{$peg->id}}">{{$peg->jenjang}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jurusan Pendidikan
                        </label>

                        <div class="col-sm-8">
                            <input type="text"  placeholder=" Masukkan Jurusan Pendidikan" 
                                    class="col-xs-10 col-sm-10 required " value="{{$data->jurusan}}"
                                    name="jurusan" required />
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