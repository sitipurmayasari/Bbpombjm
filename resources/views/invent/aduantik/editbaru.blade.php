@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li><a href="/invent/aduantik/bidang">Aduan TIK</a></li>
    <li>Ubah Aduan TIK</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="/invent/aduantik/perbaharui2/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <fieldset>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label for="">NO. ADUAN*</label>
                            <input type="text" id="no_adu" readonly required
                            class="col-xs-10 col-sm-10 required " 
                            name="no_aduan"
                            value="{{$data->no_aduan}}"/>
                            <input type="hidden" name="jenis" value="T"/>
                        </div>
                        <div class="col-md-12">
                            <label for="">TANGGAL ADUAN *</label>
                            <input type="text" name="tanggal" readonly 
                                        class="col-xs-10 col-sm-10 required" value="{{$data->tanggal}}" required
                                        data-date-format="yyyy-mm-dd" data-provide="datepicker">
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="col-md-12">
                            <label > PELAPOR *</label><br>
                            <input type="text" class="col-xs-10 col-sm-10" readonly value="{{$data->lapor->name}}">
                       </div>
                       <div class="col-md-12">
                            <label > BIDANG</label><br>
                            <input type="text" class="col-xs-10 col-sm-10" readonly value="{{$data->divisi->nama}}">
                   </div>
                </fieldset>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Barang yang di Adukan</h3></div>
            <div class="panel-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Barang*
                        </label>
                        <div class="col-sm-8">
                            <select id="barang" name="itasset_id" class="col-xs-10 col-sm-10 select2" required onchange="getBarang()">
                                <option value="">-Pilih-</option>
                                @foreach ($inventaris as $item)
                                    @if ($data->itasset_id == $item->id)
                                    <option value="{{$item->id}}" selected>{{$item->nama_barang}} (Kode : {{$item->kode_barang}}) </option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->nama_barang}} (Kode : {{$item->kode_barang}}) </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Lokasi*
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="lokasi" readonly name="lokasi" value="{{$data->barang->lokasi}}"
                            class="col-xs-10 col-sm-10 ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penanggung Jawab*
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="tanggung" readonly value="{{$data->barang->penanggung->name}}"
                            class="col-xs-10 col-sm-10"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Masalah / Kerusakan*
                        </label>
                        <div class="col-sm-8">
                            <textarea name="trouble"  required class="col-xs-10 col-sm-10" rows="10">{{$data->trouble}}</textarea>
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
    function getBarang(){
        var id = $("#barang").val();
        
        $.get(
            "{{route('aduantik.getbarang') }}",
            {
                id: id
            },
            function(response) {
                $("#tanggung").val(response.data.pj);
                $("#lokasi").val(response.data.lokasi);
            }
        );
    }

</script>
@endsection
