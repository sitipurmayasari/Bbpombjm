@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/maintenance">BA PERPINDAHAN BMN</a></li>
    <li>Input BA</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('maintenance.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <fieldset>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <label>Nomor (SIPANDA)*</label><br>
                            <input type="text" name="nomor"
                                class="col-xs-10 col-sm-10 required " />
                        </div>
                   </div>
                   <div class="col-md-4">
                        <div class="col-md-12">
                            <label>Tanggal</label><br>
                            <input type="date" name="tanggal" value="{{date('Y-m-d')}}"  required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <label>Kelompok</label><br>
                            <select name="kelompok" id="kelompok">
                                <option value="tik">Perangkat TIK</option>
                                <option value="lab">BMN LAB</option>
                                <option value="umum">BMN NON LAB</option>
                                <option value="motor">Kendaraan Dinas</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Daftar barang</h3></div>
            <div class="panel-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pemilik Asal
                        </label>
                        <div class="col-sm-9">
                            <select id="peg" name="asal_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih nama pegawai</option>
                                @foreach ($user as $peg)
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Alamat Pemilik Asal
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="alamat_lama" class="col-xs-10 col-sm-10" required
                            value="Jl. Brigjend H. Hasan Basri No. 40, Banjarmasin">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pemilik Baru
                        </label>
                        <div class="col-sm-9">
                            <select id="peg" name="baru_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">pilih nama pegawai</option>
                                @foreach ($user as $peg)
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Alamat Pemilik Baru
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="alamat_baru" class="col-xs-10 col-sm-10" required
                            value="Jl. Brigjend H. Hasan Basri No. 40, Banjarmasin">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Nama Barang
                        </label>
                        <div class="col-sm-9">
                            <select name="inventaris_id[]" class="col-xs-10 col-sm-1o select2 kelompok" required id="barang_id-1"
                                    onchange="getData1()">
                                        <option value="">Pilih Barang</option>
                                        @foreach ($data as $item)
                                            <option value="{{$item->id}}">{{$item->nama_barang}} ({{$item->kode_barang}}) || NUP : {{$item->no_seri}}</option>
                                        @endforeach
                                    </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Merk
                        </label>
                        <div class="col-sm-9">
                            <input type="text" id="merk-1" class="col-xs-10 col-sm-10" readonly> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Seri
                        </label>
                        <div class="col-sm-9">
                            <input type="text"id="no_seri-1" class="col-xs-10 col-sm-10" readonly>
                        </div>
                    </div>

                    </fieldset>        
               
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
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
        function getData1(){
            var barang_id = $("#barang_id-1").val();

            $.get(
                "{{route('inventaris.getbarang') }}",
                {
                    barang_id: barang_id
                },
                function(response) {
                    $("#merk-1").val(response.data.merk);
                    $("#no_seri-1").val(response.data.no_seri);
                }
            );
        }

    </script>
@endsection
