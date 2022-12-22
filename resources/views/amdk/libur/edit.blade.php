@extends('ppnpn/layouts.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/libur"> Hari Kerja</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/libur/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Hari Kerja</h4>
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
                        for="form-field-1"> Tanggal 
                        </label>
                        <div class="col-sm-8">
                            <input type="date" class="col-xs-3 col-sm-3"  value="{{$data->tanggal}}"
                            name="tanggal" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan
                        </label>

                        <div class="col-sm-8">
                            <select name="keterangan" class="col-xs-3 col-sm-3 select2" required>
                                @if ($data->keterangan =="Senin")
                                    <option value="Senin" selected>senin</option>
                                    <option value="Selasa">selasa</option>
                                    <option value="Rabu">rabu</option>
                                    <option value="Kamis">kamis</option>
                                    <option value="Jumat">jumat</option>
                                    <option value="Besar">besar</option>
                                @elseif($data->keterangan =="Selasa")
                                    <option value="Senin">senin</option>
                                    <option value="Selasa" selected>selasa</option>
                                    <option value="Rabu">rabu</option>
                                    <option value="Kamis">kamis</option>
                                    <option value="Jumat">jumat</option>
                                    <option value="Besar">besar</option>
                                @elseif($data->keterangan =="Selasa")
                                    <option value="Senin">senin</option>
                                    <option value="Selasa" selected>selasa</option>
                                    <option value="Rabu">rabu</option>
                                    <option value="Kamis">kamis</option>
                                    <option value="Jumat">jumat</option>
                                    <option value="Besar">besar</option>
                                @elseif($data->keterangan =="Selasa")
                                    <option value="Senin">senin</option>
                                    <option value="Selasa" selected>selasa</option>
                                    <option value="Rabu">rabu</option>
                                    <option value="Kamis">kamis</option>
                                    <option value="Jumat">jumat</option>
                                    <option value="Besar">besar</option>
                                @elseif($data->keterangan =="Selasa")
                                    <option value="Senin">senin</option>
                                    <option value="Selasa" selected>selasa</option>
                                    <option value="Rabu">rabu</option>
                                    <option value="Kamis">kamis</option>
                                    <option value="Jumat">jumat</option>
                                    <option value="Besar">besar</option>
                                @elseif($data->keterangan =="Selasa")
                                    <option value="Senin">senin</option>
                                    <option value="Selasa" selected>selasa</option>
                                    <option value="Rabu">rabu</option>
                                    <option value="Kamis">kamis</option>
                                    <option value="Jumat">jumat</option>
                                    <option value="Besar">besar</option>
                                @else
                                    <option value="Senin">senin</option>
                                    <option value="Selasa">selasa</option>
                                    <option value="Rabu">rabu</option>
                                    <option value="Kamis">kamis</option>
                                    <option value="Jumat">jumat</option>
                                    <option value="Besar" selected>besar</option>
                                @endif
                            </select>
                            *hari besar = hari libur tapi wajib hadir dan absen
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