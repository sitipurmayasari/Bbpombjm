@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
<li>Rekapitulasi</li>
<li><a href="/amdk/rekappelatihan"> Kompetensi Pegawai</a></li>
<li>Tambah Baru</li>
@endsection
@section('content')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('pelatihan.impor')}}"  enctype="multipart/form-data">
         {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">  Upload Pelatihan Pegawai</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding" col-sm-8>
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Upload File
                        </label>
                        <div class="col-sm-10">
                            <input type="file" name="imporfile" class="btn btn-default btn-sm" id="" value="Upload File">
                            <label><i>*File Excel</i></label>   
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
                <i class="ace-icon fa fa-check bigger-110"></i>Generate
            </button>
        </div>
    </div>
    </form>
</div>
@endsection