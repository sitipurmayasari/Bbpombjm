@extends('qms/layouts_qms.app')
@section('breadcrumb')
    <li><a href="/qms/inputqms">Input QMS</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('inputqms.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input QMS</h4>
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
                        for="form-field1"> Jenis SOP
                        </label>
                        <div class="col-sm-8">
                            <input type="radio" required value="Mikro" checked 
                            name="type" > &nbsp; Mikro  &nbsp;
                            <input type="radio" required value="Makro"
                            name="type" > &nbsp; Makro
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Nama File
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama file"
                            class="col-xs-10 col-sm-10 required " name="names" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> File 
                        </label>
                        <div class="col-sm-8">
                            <input type="file" name="file" class="btn btn-default btn-sm" value="Upload File SOP">      
                            <label><i>*pdf max 10 Mb</i></label>
                        </div>
                    </div>
                    </fieldset>                   
               </div>
           </div>
        </div>
    </div>
    <div class="col-sm12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger1-10"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
<script>
</script>
@endsection