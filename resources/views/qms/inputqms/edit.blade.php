@extends('qms/layouts_qms.app')
@section('breadcrumb')
    <li><a href="/qms/inputqms">Input QMS</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/qms/inputqms/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah QMS</h4>
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
                            @if ($data->type == 'Mikro')
                                <input type="radio" required value="Mikro" checked 
                                name="type" > &nbsp; Mikro  &nbsp;
                                <input type="radio" required value="Makro"
                                name="type" > &nbsp; Makro
                            @else
                                <input type="radio" required value="Mikro"  
                                name="type" > &nbsp; Mikro  &nbsp;
                                <input type="radio" required value="Makro" checked
                                name="type" > &nbsp; Makro
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field1"> Nama folder
                        </label>
                        <div class="col-sm-8">
                            <select id="peg" name="folder_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih Folder</option>
                            @foreach ($folder as $peg)
                                @if ($peg->id == $data->folder_id)
                                <option value="{{$peg->id}}" selected>{{$peg->name}} ({{$peg->type == '1' ? 'Mikro' : 'Makro'}}) </option>
                                @else
                                <option value="{{$peg->id}}">{{$peg->name}} ({{$peg->type == '1' ? 'Mikro' : 'Makro'}}) </option>
                                @endif
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Nama File
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="nama file" value="{{$data->names}}"
                            class="col-xs-10 col-sm-10 required " name="names" required />
                        </div>
                    </div>
                    <div class="form-group" id="country">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> File 
                        </label>
                        <div class="col-sm-8">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload Ulang File SOP">
                            <label><a href="{{$data->getFIleQms()}}" target="_blank" >{{$data->file}}</a></label> <br> 
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
                <i class="ace-icon fa fa-check bigger1-10"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
<script>
$().ready( function () {
    if ($data->type="D") {
        $("#country").hide();
    } else {
        $("#country").show();
        $("#province").hide();
        $("#district").hide();
    }

} );
function getAsal(){
    var a = "";
    var b = "Indonesia"
    if(document.getElementById('D').checked) {
        $("#country-name").val(b);
        $("#country").hide();
        $("#province").show();
        $("#district").show();
    }else if(document.getElementById('L').checked) {    
        $("#country-name").val(a);
        $("#country").show();
        $("#province").hide();
        $("#district").hide();
    }

}

</script>
@endsection