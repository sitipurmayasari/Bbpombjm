@extends('qms/layouts_qms.app')
@section('breadcrumb')
    <li><a href="/qms/folderqms">Folder QMS</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('folderqms.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Folder QMS</h4>
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
                            <input type="radio" required value="1" checked 
                            name="type" > &nbsp; Mikro  &nbsp;
                            <input type="radio" required value="2"
                            name="type" > &nbsp; Makro
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Nama Folder
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama"
                            class="col-xs-10 col-sm-10 required " name="name" required />
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