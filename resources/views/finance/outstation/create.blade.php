@extends('layouts.mon')
@section('breadcrumb')
    <li>Surat Tugas</li>
    <li><a href="/finance/outstation">Surat Tugas</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<style>
    .scrollit {
    overflow:scroll;
    height:100px;
}
</style>

<form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('outstation.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Input Surat Tugas</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" required id="st_date"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="st_date"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Substansi
                        </label>
                        <div class="col-sm-8"> 
                            <select name="divisi_id" class="col-xs-10 col-sm-10 required select2" required id="div" onchange="getnomor()">
                                <option value="">Pilih Substansi</option>
                                @foreach ($div as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Surat Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text" required value="{{$no_st}}" readonly
                                    class="col-xs-10 col-sm-10 required " 
                                    name="number"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Maksud Tugas
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama kegiatan" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="purpose" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Beban Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="budget_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Anggaran</option>
                                @foreach ($budget as $item)
                                    <option value="{{$item->id}}">{{$item->code}}/{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> PPK
                        </label>
                        <div class="col-sm-8"> 
                            <select name="ppk_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Pejabat</option>
                                @foreach ($ppk as $item)
                                    <option value="{{$item->id}}">{{$item->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kode Anggaran
                        </label>
                        <div class="col-sm-8">
                            <select name="from" class="col-xs-10 col-sm-10 required select2" required >
                                <option value="">Pilih Kode Anggaran</option>
                                @foreach ($pok as $item)
                                    <option value="{{$item->id}}">{{$item->sub->kodeall}}/{{$item->akun->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kota Asal
                        </label>
                        <div class="col-sm-8"> 
                            <select name="city_from" class="col-xs-10 col-sm-10 required select2" required id="city_from">
                                <option value="">Pilih Kode Kota</option>
                                @foreach ($destination as $item)
                                    <option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis Dinas
                        </label>
                        <div class="col-sm-8">
                            <select name="type" class="col-xs-10 col-sm-10 required" onchange="getAsal()" id="jenas">
                                <option value="">Pilih Jenis</option>
                                <option value="DL">Dalam Kota</option>
                                <option value="LK">Luar Kota</option>
                                <option value="LN">Luar Negeri</option>
                            </select>
                        </div>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Kota Tujuan</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group" id="to_1">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Kota Tujuan 1
                        </label>
                        <div class="col-sm-9"> 
                            <select name="city_1" id="city_1" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Kode Kota</option>
                                @foreach ($destination as $item)
                                    <option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Dari Tanggal
                        </label>
                        <div class="col-sm-9">
                            <input type="date" name="date_from_1" class="col-xs-5 col-sm-5 required" 
                            value="{{date('Y-m-d')}}" required
                            data-date-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Sampai Tanggal
                        </label>
                        <div class="col-sm-9">
                            <input type="date" name="date_to_1" class="col-xs-5 col-sm-5 required" 
                            value="{{date('Y-m-d')}}" required
                            data-date-format="yyyy-mm-dd">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Lama hari
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="daylong_1" class="col-xs-3 col-sm-3 required" 
                             required readonly>
                        </div>
                    </div>
                </fieldset>   
   
            </div>
        </div>
    </div>
    <div class="col-md-6" id="kotakedua">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Kota Tujuan</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group" id="to">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Kota Tujuan 2
                        </label>
                        <div class="col-sm-9"> 
                            <select name="city_2" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Kode Kota</option>
                                @foreach ($destination as $item)
                                    <option value="{{$item->id}}">{{$item->code}}-{{$item->capital}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Dari Tanggal
                        </label>
                        <div class="col-sm-9">
                            <input type="date" name="date_from_2" class="col-xs-5 col-sm-5 required" 
                            value="{{date('Y-m-d')}}" required
                            data-date-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Sampai Tanggal
                        </label>
                        <div class="col-sm-9">
                            <input type="date" name="date_to_2" class="col-xs-5 col-sm-5 required" 
                            value="{{date('Y-m-d')}}" required
                            data-date-format="yyyy-mm-dd">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Lama hari
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="daylong_2" class="col-xs-3 col-sm-3 required" 
                             required readonly>
                        </div>
                    </div>
                </fieldset>   
   
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-employee" data-toggle="tab">Pegawai</a></li>
        <li><a href="#tab-driver" data-toggle="tab">Kendaraan Dinas</a></li>
    </ul>

    <div class="tab-content">
        @include('finance.outstation.partials.employee')
        @include('finance.outstation.partials.driver')
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

@endsection

@section('footer')
   <script>
       function getnomor(){
           var div = $("#st_date").val();
           var div = $("#divisi_id").val();
           $.get(
            "{{route('realisasi.getAsal') }}",
            {
                year:year,
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih</option>";
                $.each(data, function(index, value) {
                    string = string + '<option value="'+ value.id +'">'+ value.asal_pok +'</option>';
                })
               $("#asalpok").html(string);
            }
        );
       }

        function getAsal() {
            d = $("#city_from").val();
            e = $("#jenas").val();

            if (e = "DL") {
                $("#kotakedua").hide();
                $("#city_1").val(d);
            } else {
                $("#kotakedua").show();
            }
        }
   </script>
@endsection