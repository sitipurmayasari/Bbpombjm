@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup Umum</li>
    <li><a href="/finance/destination">Kota Tujuan</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('destination.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Kota Tujuan</h4>
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
                        for="form-field-1"> Tujuan
                        </label>
                        <div class="col-sm-8">
                            <input type="radio" required value="D" checked 
                            name="type" id="D" onclick="getAsal(this.value)"/> &nbsp; Dalam Negeri  &nbsp;
                            <input type="radio" required value="L"
                            name="type" id="L" onclick="getAsal(this.value)"/> &nbsp; Luar Negeri
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kode Kota
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="kode"
                            class="col-xs-10 col-sm-10 required " name="code" required />
                        </div>
                    </div>
                    <div class="form-group" id="country">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Negara
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Negara" id="country-name"
                            class="col-xs-10 col-sm-10 required " name="country" required />
                        </div>
                    </div>
                    <div class="form-group" id="province">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Provinsi
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Provinsi" 
                            class="col-xs-10 col-sm-10 required " name="province" />
                        </div>
                    </div>
                    <div class="form-group" id="district">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kabupaten/Kota
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Kab/kota" 
                            class="col-xs-10 col-sm-10 required " name="district" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kota
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="kota" 
                            class="col-xs-10 col-sm-10 required " name="capital" required />
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

@section('footer')
<script>
$().ready( function () {
    $("#country-name").val("Indonesia");
    $("#country").hide();
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