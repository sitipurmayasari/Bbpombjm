@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/setupttd"> Tanda Tangan</a></li>
    <li>Buat Tanda Tangan</li>
@endsection
@section('content')

<style>

</style>


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('setupttd.store')}}"  enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Buat Tanda Tangan</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body col-sm-10">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-10" >
                            <select id="status" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">Pilih Pegawai</option>
                                @foreach ($user as $peg)
                                    <option value="{{$peg->id}}">NIP. {{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Scan TTD
                        </label>
                        <div class="col-sm-10">
                            <input type="file" name="scan_ttd" class="btn btn-success btn-sm" multiple accept="image/*"
                            value="Upload Scan TTD" required>   
                            <label><i>ex:Lorem_ipsum.jpg/.jpeg/.png</i></label>
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