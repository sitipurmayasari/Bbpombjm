@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/teamlead"> Ketua Tim</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/teamlead/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Data Ketua Tim</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body col-sm-9">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group" id="div">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Bidang/Kelompok
                        </label>
                        <div class="col-sm-9" >
                            <select  name="divisi_id" id="divisi_id" class="col-xs-10 col-sm-10">
                                <option value="">Pilih kelompok</option>
                                    @foreach ($divisi as $div)
                                        @if ($data->divisi_id==$div->id)
                                            <option value="{{$div->id}}" selected>{{$div->nama}}</option>
                                        @else
                                            <option value="{{$div->id}}">{{$div->nama}}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Pejabat
                            </label>
                            <div class="col-sm-9">
                                <select id="status" name="users_id" class="ccol-xs-10 col-sm-10 select2" required>
                                    @foreach ($user as $peg)
                                        @if ($data->users_id==$peg->id)
                                            <option value="{{$peg->id}}" selected>{{$peg->name}} (NIP: {{$peg->no_pegawai}})</option> 
                                        @else
                                        <option value="{{$peg->id}}">{{$peg->name}} (NIP: {{$peg->no_pegawai}})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Nama Jabatan
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="detail" class="col-xs-10 col-sm-10" value="{{$data->detail}}"
                            placeholder="Ketua Tim Infokom" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Dari
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="datefrom" readonly class="col-xs-10 col-sm-10" value="{{$data->datefrom}}"
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Sampai
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="dateto" readonly class="col-xs-10 col-sm-10" value="{{$data->dateto}}"
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal" required>
                        </div>
                    </div>
                   
                    
                    </fieldset>        
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
           
           


        </div>
    </div><!-- /.col -->
</div>
@endsection
