@extends('qms/layouts_qms.app')
@section('breadcrumb')
    <li><a href="/qms/inputqms">Input QMS</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
method="post" action="{{route('inputqms.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Input QMS</h3></div>
            <div class="panel-body">
                <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field1"> Jenis SOP
                        </label>
                        <div class="col-sm-8"> 
                            <input type="radio" required value="Mikro"  onclick="handleChange1();" id ="mikro"
                            name="type" > &nbsp; Mikro  &nbsp; 
                            <input type="radio" required value="Makro"  onclick="handleChange2();" id ="mikro"
                            name="type" > &nbsp; Makro
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field1"> Nama folder
                        </label>
                        <div class="col-sm-8">
                            <select id="folderes" name="folder_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih Folder</option>
                        </select>
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

@endsection

@section('footer')
<script>
    function handleChange1(){
         var type = 1;
        $.get(
            "{{route('inputqms.getfolder') }}",
            {
                type: type
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih Folder</option>";
                $.each(data, function(index, value) {
                    string = string + `<option value="` + value.id + `">` + value.name + ` (Mikro) </option>`;
                })
               $("#folderes").html(string);
            }
        );
    }

    function handleChange2(){
         var type = 2;
        $.get(
            "{{route('inputqms.getfolder') }}",
            {
                type: type
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih Folder</option>";
                $.each(data, function(index, value) {
                    string = string + `<option value="` + value.id + `">` + value.name + ` (Makro) </option>`;
                })
               $("#folderes").html(string);
            }
        );
    }

</script>
@endsection