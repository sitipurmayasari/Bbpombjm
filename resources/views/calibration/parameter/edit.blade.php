@extends('layouts.ot')
@section('breadcrumb')
    <li>Setup</li>
    <li> Parameter Uji</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/calibration/parameter/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Parameter Uji</h4>
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
                        for="form-field-1"> Komuditi
                        </label>
                        <div class="col-sm-8">
                            <select name="komuditi"  class="col-xs-10 col-sm-10 required select2" required>
                                @if ($data->komuditi == "OBA")
                                    <option value="OBA" selected>OBAT BAHAN ALAM / OBAT TRADISIONAL</option>
                                    <option value="KOS">KOSMETIK</option>
                                    <option value="SK">SUPLEMEN KESEHATAN</option>
                                @elseif ($data->komuditi == "KOS")
                                    <option value="OBA">OBAT BAHAN ALAM / OBAT TRADISIONAL</option>
                                    <option value="KOS" selected>KOSMETIK</option>
                                    <option value="SK">SUPLEMEN KESEHATAN</option>
                                @else
                                    <option value="OBA">OBAT BAHAN ALAM / OBAT TRADISIONAL</option>
                                    <option value="KOS">KOSMETIK</option>
                                    <option value="SK" selected>SUPLEMEN KESEHATAN</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Parameter Uji
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder=" Masukkan Parameter uji" value="{{$data->nama}}"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="nama" required />
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