@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/broken"> Stok Rusak</a></li>
    <li>Input Aduan Kerusakan Stok</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('broken.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <fieldset>
                <div class="col-md-3">
                    <label for="">NO. ADUAN*</label>
                    <input type="text" id="no_adu" readonly required
                    class="col-xs-10 col-sm-10 required " 
                    name="nomor"
                    value="{{$norusak}}"/>
                    <input type="hidden" name="tanggal" value="{{date('Y-m-d')}}"/>
                </div>
                {{-- <div class="col-md-3">
                    <label > Mengetahui *</label>
                    <select id="peg" name="pejabat_id" class="col-xs-10 col-sm-10 select2" required>
                            <option value="">pilih nama pejabat</option>
                        @foreach ($tahu as $lok)
                            <option value="{{$lok->id}}">{{$lok->user->name}} ({{$lok->jabatan->jabatan}})</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col-md-3">
                    <label > Mengetahui *</label>
                    <select id="peg" name="mengetahui" class="col-xs-10 col-sm-10 select2" required>
                            <option value="">pilih nama pejabat</option>
                        @foreach ($tahu as $lok)
                            <option value="{{$lok->id}}">{{$lok->name}} ({{$lok->no_pegawai}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label >Pegawai *</label>
                    <select id="peg" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                            <option value="">pilih nama pegawai</option>
                        @foreach ($user as $peg)
                            <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label >Laboratorium *</label>
                    <select id="peg" name="labory_id" class="col-xs-10 col-sm-10 select2" required>
                            <option value="0">Non Lab / Gudang</option>
                        @foreach ($lab as $peg)
                            <option value="{{$peg->id}}">{{$peg->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                </fieldset>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Data Barang Rusak</h3></div>
            <div class="panel-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Barang
                        </label>
                        <div class="col-sm-8">
                            <select name="inventaris_id" class="col-xs-10 col-sm-10 select2" id="inventaris_id" onchange="getData()" required>
                                <option value="">-Pilih-</option>
                                @foreach ($data as $item)
                                    <option value="{{$item->id}}">{{$item->nama_barang}}|{{$item->merk}} (Kode : {{$item->kode_barang}}) </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Merk
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="merk" readonly
                            class="col-xs-10 col-sm-10 ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Seri
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="no_seri" readonly
                            class="col-xs-10 col-sm-10"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jumlah
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="1" class="col-xs-2 col-sm-2" name="jumlah" value="0" required id="jumlah"
                                onkeyup="hitung()" onclick="hitung()"> 
                            <label for="form-field-1" class="control-label"> &nbsp;  Buah </label>
                            <input type="hidden" name="asal" id="asal">
                            <input type="hidden" name="stock" id="sisa">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan*
                        </label>
                        <div class="col-sm-8">
                            <textarea name="ket"  class="col-xs-10 col-sm-10"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Foto Bukti*
                        </label>
                        <div class="col-sm-8">
                            <input type="file" name="foto" class="btn btn-success btn-sm" id="" 
                            value="Upload Foto Barang">   
                            <label><i>ex:Lorem_ipsum.jpg/.jpeg/.png</i></label>   
                        </div>
                    </div>
                    *Tidak Wajib
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
        function getData(){
            var barang_id = $("#inventaris_id").val();

            $.get(
                "{{route('labrequest.getbarang') }}",
                {
                    barang_id: barang_id
                },
                function(response) {
                    $("#merk").val(response.data.merk);
                    $("#no_seri").val(response.data.no_seri);
                    $("#asal").val(response.data.stock);
                }
            );
        }

         function hitung() {
            var a = $("#asal").val();
            var b = $("#jumlah").val();
            var c = parseFloat(a) -  parseFloat(b);
            $("#sisa").val(c);
        }
    </script>
@endsection
