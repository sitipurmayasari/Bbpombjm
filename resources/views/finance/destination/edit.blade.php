@extends('layouts.din')
@section('breadcrumb')
    <li>Setup Umum</li>
    <li><a href="/finance/destination">Kota Tujuan</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/destination/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Kota Tujuan</h4>
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
                            @if ($data->type=='D')
                                    <input type="radio" required value="D" checked 
                                    name="type" id="D" onclick="getAsal(this.value)"/> &nbsp; Dalam Negeri  &nbsp;
                                    <input type="radio" required value="L"
                                    name="type" id="L" onclick="getAsal(this.value)"/> &nbsp; Luar Negeri
                                @else
                                    <input type="radio" required value="D" 
                                    name="type" id="D" onclick="getAsal(this.value)"/> &nbsp; Dalam Negeri  &nbsp;
                                    <input type="radio" required value="L" checked
                                    name="type" id="L" onclick="getAsal(this.value)"/> &nbsp; Luar Negeri
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Kode Kota
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="kode" value="{{$data->code}}"
                            class="col-xs-10 col-sm-10 required " name="code" required />
                        </div>
                    </div>
                    <div class="form-group" id="country">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Negara
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Negara" id="country-name" value="{{$data->country}}"
                            class="col-xs-10 col-sm-10 required " name="country" required />
                        </div>
                    </div>
                    <div class="form-group" id="province">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Provinsi
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Provinsi" value="{{$data->province}}"
                            class="col-xs-10 col-sm-10 required " name="province" />
                        </div>
                    </div>
                    <div class="form-group" id="district">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Kabupaten/Kota
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Kab/kota" value="{{$data->district}}"
                            class="col-xs-10 col-sm-10 required " name="district" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field1"> Kota
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="kota" value="{{$data->capital}}"
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
                                    <td>Uang Transport</td>
                                    <td> <input type="number"  placeholder="Rp. 0,-"min="0" value="{{$data->trans1}}"
                                         name="trans1" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->trans2}}"
                                        name="trans2" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->trans3}}"
                                            name="trans3" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->trans4}}"
                                           name="trans4" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->trans5}}"
                                           name="trans5" /></td>    
                                </tr>
                                <tr>
                                    <td>Upah Harian LK</td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageLK1}}"
                                         name="dailywageLK1" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageLK2}}"
                                        name="dailywageLK2" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageLK3}}"
                                            name="dailywageLK3" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageLK4}}"
                                           name="dailywageLK4" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageLK5}}"
                                           name="dailywageLK5" /></td>    
                                </tr>
                                <tr>
                                    <td>Upah Harian DK > 8 jam</td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageDK1}}"
                                         name="dailywageDK1" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageDK2}}"
                                        name="dailywageDK2" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageDK3}}"
                                            name="dailywageDK3" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageDK4}}"
                                           name="dailywageDK4" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->dailywageDK5}}"
                                           name="dailywageDK5" /></td>    
                                </tr>
                                <tr>
                                    <td>Upah Harian Diklat</td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->diklat1}}"
                                         name="diklat1" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->diklat2}}"
                                        name="diklat2" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->diklat3}}"
                                            name="diklat3" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->diklat4}}"
                                           name="diklat4" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->diklat5}}"
                                           name="diklat5" /></td>    
                                </tr>
                                <tr>
                                    <td>Upah Harian FB DK</td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBDK1}}"
                                         name="FBDK1" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBDK2}}"
                                        name="FBDK2" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBDK3}}"
                                            name="FBDK3" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBDK4}}"
                                           name="FBDK4" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBDK5}}"
                                           name="FBDK5" /></td>    
                                </tr>
                                <tr>
                                    <td>Upah Harian FullDay/HalfDay</td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBFD1}}"
                                         name="FBFD1" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBFD2}}"
                                        name="FBFD2" /></td> 
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBFD3}}"
                                            name="FBFD3" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBFD4}}"
                                           name="FBFD4" /></td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" min="0" value="{{$data->FBFD5}}"
                                           name="FBFD5" /></td>    
                                </tr>
                                <tr>
                                    <td>Uang Representatif</td>
                                    <td> <input type="number"  placeholder="Rp. 0,-" value="{{$data->representatif}}" min="0"
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
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Supir</h4>
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
                            <tr>
                                <td style="width: 16.5%">Uang Harian Dalam Kota</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="{{$data->DKDriver}}" min="0"
                                     name="DKDriver" /></td>
                            </tr>
                            <tr>
                                <td>Uang Harian Luar Kota</td>
                                <td> <input type="number"  placeholder="Rp. 0,-" value="{{$data->DKDriver}}" min="0"
                                     name="LKDriver" /></td>
                            </tr>
                    </table>
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