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
    <div class="col-sm12">
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
                        for="form-field1"> Tujuan
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
                            for="form-field1"> Kode Kota
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="kode"
                            class="col-xs-10 col-sm-10 required " name="code" required />
                        </div>
                    </div>
                    <div class="form-group" id="country">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Negara
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Negara" id="country-name"
                            class="col-xs-10 col-sm-10 required " name="country" required />
                        </div>
                    </div>
                    <div class="form-group" id="province">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Provinsi
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Provinsi" 
                            class="col-xs-10 col-sm-10 required " name="province" />
                        </div>
                    </div>
                    <div class="form-group" id="district">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Kabupaten/Kota
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Kab/kota" 
                            class="col-xs-10 col-sm-10 required " name="district" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Kota
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
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Biaya</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center;" class="col-md3">Jenis</th>
                                @foreach ($jab  as $key=>$row)
                                    <th class="col-md2">{{$row->jabatan}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Upah Harian LK</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                     name="dailywageLK1" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                    name="dailywageLK2" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                        name="dailywageLK3" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="dailywageLK4" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="dailywageLK5" /></td>    
                            </tr>
                            <tr>
                                <td>Upah Harian DK > 8 jam</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                     name="dailywageDK1" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                    name="dailywageDK2" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                        name="dailywageDK3" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="dailywageDK4" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="dailywageDK5" /></td>    
                            </tr>
                            <tr>
                                <td>Upah Harian Diklat</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                     name="diklat1" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                    name="diklat2" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                        name="diklat3" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="diklat4" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="diklat5" /></td>    
                            </tr>
                            <tr>
                                <td>Upah Harian FB DK</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                     name="FBDK1" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                    name="FBDK2" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                        name="FBDK3" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="FBDK4" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="FBDK5" /></td>    
                            </tr>
                            <tr>
                                <td>Upah Harian FB LK</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                     name="FBLK1" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                    name="FBLK2" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                        name="FBLK3" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="FBLK4" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="FBLK5" /></td>    
                            </tr>
                            <tr>
                                <td>Upah Harian FB Full Day</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                     name="FBFD1" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                    name="FBFD2" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                        name="FBFD3" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="FBFD4" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="FBFD5" /></td>    
                            </tr>
                            <tr>
                                <td>Upah Harian FB Half Day</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                     name="FBHD1" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                    name="FBHD2" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                        name="FBHD3" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="FBHD4" /></td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                       name="FBHD5" /></td>    
                            </tr>
                            <tr>
                                <td>Uang Representatif</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="0" min="0"
                                     name="representatif" /></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>   
                            </tr>
                        </tbody>
                    </table>
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