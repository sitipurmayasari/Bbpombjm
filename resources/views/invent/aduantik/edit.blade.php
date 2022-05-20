@extends('layouts.app')
@section('breadcrumb')
    <li>Aduan</li>
    <li><a href="/invent/aduantik/bidang">Aduan TIK</a></li>
    <li>Ubah Aduan TIK</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="/invent/aduantik/perbaharui/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <fieldset>
                <div class="col-md-4">
                    <label for="">NO. ADUAN*</label>
                    <input type="text" id="no_adu" readonly required
                    class="col-xs-10 col-sm-10 required " 
                    name="no_aduan"
                    value="{{$data->no_aduan}}"/>
                </div>
                <div class="col-md-4">
                    <label for="">TANGGAL ADUAN *</label>
                    <input type="text" name="tanggal" readonly 
                                class="col-xs-10 col-sm-10 required" value="{{$data->tanggal}}"
                                data-date-format="yyyy-mm-dd" data-provide="datepicker">
                </div>
                <div class="col-md-4">
                    <label > Pelapor *</label>
                    <input type="text" readonly  class="col-xs-10 col-sm-10" name="nama_pegawai"
                     value="{{$data->lapor->name}}"/>
                    <input type="hidden" name="pegawai_id" value={{$data->pegawai_id}}/>
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
                            <select name="inventaris_id" class="col-xs-10 col-sm-10 select2" id="inventaris_id" onchange="getData()">
                                <option value="">-Pilih-</option>
                                @foreach ($inventaris as $item)
                                    @if ($data->inventaris_id == $item->id)
                                    <option value="{{$item->id}}" selected>{{$item->nama_barang}}|{{$item->merk}} (Kode : {{$item->kode_barang}}) </option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->nama_barang}}|{{$item->merk}} (Kode : {{$item->kode_barang}}) </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Merk*
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="merk" readonly value="{{$data->barang->merk}}"
                            class="col-xs-10 col-sm-10 ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Seri*
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="no_seri" readonly value="{{$data->barang->no_seri}}"
                            class="col-xs-10 col-sm-10"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Masalah / Kerusakan*
                        </label>
                        <div class="col-sm-8">
                            <textarea name="problem"  required class="col-xs-10 col-sm-10" rows="10">{{$data->problem}}</textarea>
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
        function getData(){
            var barang_id = $("#inventaris_id").val();

            $.get(
                "{{route('inventaris.getbarang') }}",
                {
                    barang_id: barang_id
                },
                function(response) {
                    $("#merk").val(response.data.merk);
                    $("#no_seri").val(response.data.no_seri);
                }
            );
        }
    </script>
@endsection
