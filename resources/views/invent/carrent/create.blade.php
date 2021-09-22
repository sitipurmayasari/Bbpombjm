@extends('layouts.app')
@section('breadcrumb')
    <li>Kendaraan</li>
    <li>Peminjaman Kendaraan Dinas</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('carrent.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input peminjaman Kendaraan Dinas</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-12">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Ajuan
                            </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$kode}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="code"/>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Pengaju
                            </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{auth()->user()->name}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="users_name"/>  
                                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Peminjaman
                            </label>
                            <div class="col-sm-2">
                                <input type="date" value="{{date('Y-m-d')}}" onchange="getCar()"
                                class="col-xs-10 col-sm-10 required " 
                                name="date_from" required id="date_from" />  
                                <label class="col-sm-2 control-label no-padding-right" 
                                    for="form-field-1"> s/d
                                </label>
                            </div>
                            <div class="col-sm-2">
                                <input type="date" value="{{date('Y-m-d')}}"
                                class="col-xs-10 col-sm-10 required " 
                                name="date_to" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Kendaraan
                            </label>
                            <div class="col-sm-9">
                                <select name="car_id" class="col-xs-10 col-sm-10 required select2" id="car_id" required>
                                    <option value="">Pilih Kendaraan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tujuan
                            </label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Tujuan"
                                class="col-xs-10 col-sm-10 required " 
                                name="destination"/>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Supir
                            </label>
                            <div class="col-sm-9">
                                <select name="driver_id" id="driver_id" class="col-xs-10 col-sm-10 required select2" required>
                                    <option value="">Pilih Supir</option> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Upload File Pendukung *
                            </label>
                           
                            <div class="col-sm-9">
                                <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">       
                                <label><i>ex:Lorem_ipsum.pdf (*tidak wajib)</i></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.col -->
    
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
        function getCar(){
            var tgl = $("#date_from").val();

            $.get(
                "{{route('carrent.getCar') }}",
                {
                    tgl:tgl
                },
                function(response) {
                    var car = response.car;
                    var string ="<option value=''>Pilih Kendaraan</option>";
                    $.each(car, function(index, value) {
                        string = string + '<option value="' + value.id + '">' + value.merk + ' ('+ value.police_number+')</option>';
                    })
                    $("#car_id").html(string);

                    var driver = response.driver;
                    var string ="<option value=''>Pilih Supir</option>";
                    $.each(driver, function(index, value) {
                        string = string + '<option value="' + value.id + '">' + value.name +'</option>';
                    })
                    $("#driver_id").html(string);
                }
            );
        }
    </script>
@endsection