@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/maintenance">Maintenance</a></li>
    <li>Input Maintenance</li>
@endsection
@section('content')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('maintenance.store')}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Form Maintenance</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-8">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No Pemeliharaan
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nomor Pemeliharaan" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="no_pemeliharaan" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Pemeliharaan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="tgl_pelihara" readonly class="col-xs-10 col-sm-10 required" 
                                    data-date-format="yyyy-mm-dd" data-provide="datepicker" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Barang
                            </label>
                            <div class="col-sm-8">
                                <select id="barang_id" name="inventaris_id" class="col-xs-10 col-sm-10 select2" 
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
                                <input type="text" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="merk" id="merk" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No.Seri
                            </label>
                            <div class="col-sm-8">
                                <input type="text"   id="seri" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="no_seri" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Lokasi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  class="col-xs-10 col-sm-10 required " id="lok"
                                name="lokasi" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Penanggung Jawab
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  class="col-xs-10 col-sm-10 required " id="pj"
                                 name="penanggung_jawab" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Petugas
                            </label>
                            <div class="col-sm-8">
                                <select id="status" name="pegawai_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="null">Pilih Nama Petugas</option>
                                    @foreach ($user as $peg)
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kegiatan
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  class="col-xs-10 col-sm-10 required " 
                                 name="kegiatan"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Hasil Pemeriksaan
                            </label>
                            <div class="col-sm-8">
                                <select name="hasil" class="col-xs-10 col-sm-10 required " >
                                    <option value="">Pilih Hasil</option>
                                    <option value="baik">Baik</option>
                                    <option value="rusak">Rusak-Tidak Bisa Digunakan Lagi</option>
                                    <option value="perbaiki">Rusak-Diperbaiki</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Keterangan
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                name="keterangan"></textarea>
                            </div>
                        </div>
                        
                        </fieldset>        
                    </div>
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
                $("#lok").val(response.data.bola);
                $("#pj").val(response.data.name);
            }
        );
    }

</script>
@endsection