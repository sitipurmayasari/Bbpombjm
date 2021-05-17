@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li><a href="/aduan"> Input Aduan</a></li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('aduan.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Form Aduan Kerusakan</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Aduan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" id="no_adu" readonly
                                        class="col-xs-10 col-sm-10 required " 
                                        name="no_aduan"
                                        value="{{$no_aduan}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Barang
                            </label>
                            <div class="col-sm-8">
                                <select id="barang_id" name="barang_id" class="col-xs-10 col-sm-10 select2" 
                                onchange="getDataBarang()">
                                        <option value="null">pilih nama barang</option>
                                    @foreach ($data as $isi)
                                        <option value="{{$isi->id}}">{{$isi->kode_barang}} || {{$isi->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk/Type
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="merk" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="merk" id="merk" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No.Seri
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="seri" id="seri" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="no_seri" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Aduan
                            </label>
                            <div class="col-sm-8 date">
                                    <input type="text" name="tanggal" readonly 
                                    class="col-xs-10 col-sm-10" value="{{date('Y-m-d')}}"
                                    data-date-format="yyyy-mm-dd" data-provide="datepicker">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Pelapor
                            </label>
                            <div class="col-sm-8">
                                <select id="peg" name="pegawai_id" class="col-xs-10 col-sm-10 select2">
                                        <option value="null">pilih nama pegawai</option>
                                    @foreach ($user as $peg)
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Keterangan
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                name="aduan"></textarea>
                            </div>
                        </div>
                        
                        </fieldset>        
                    </div>
                </div>
                <div class="col-sm-6">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Foto Barang
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="foto" class="btn btn-success btn-sm" id="" 
                            value="Upload Foto Barang">   
                            <label><i>ex:Lorem_ipsum.jpg/.jpeg/.png</i></label>   
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
    function getDataBarang(){
        var barang_id = $("#barang_id").val();
        if (barang_id == '') return false;
        $.get(
            "{{route('inventaris.getbarang') }}",
            {
                barang_id: barang_id
            },
            function(response) {
                $("#merk").val(response.data.merk);
                $("#seri").val(response.data.no_seri);
            }
        );
    }


</script>
@endsection