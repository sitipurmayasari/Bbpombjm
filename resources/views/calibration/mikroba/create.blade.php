@extends('layouts.tomi')
@section('breadcrumb')
    <li><a href="/calibration/mikroba"> Monitoring Mikroba</a></li>
    <li>Input Monitoring Mikroba</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
        method="post" action="{{route('mikroba.store')}}" enctype="multipart/form-data"   >
   {{ csrf_field() }}
   <style>
        th{
            text-align: center;
            vertical-align: middle;
        }
   </style>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pengujian</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> No. Kode Baku Uji
                        </label>
                        <div class="col-sm-8">
                            <input type="text" readonly value="{{$nomor}}"
                                    class="col-xs-3 col-sm-3 required " 
                                    name="number" required/> &nbsp; &nbsp;
                            <input type="text" name="kode"  class="col-xs-5 col-sm-5 required" placeholder="kode" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal
                        </label>
                        <div class="col-sm-8">
                            <input type="date" name="dates" 
                                        class="col-xs-3 col-sm-3 required" value="{{date('Y-m-d')}}" required
                                        data-date-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Nama Bakteri
                        </label>
                        <div class="col-sm-8">
                           <select name="bakteri_id" id="bakteri" required class="col-xs-10 col-sm-10 required select2" onchange="getMedia()">
                                <option value="">Pilih Bakteri</option>
                                @foreach ($bakteri as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penguji
                        </label>
                        <div class="col-sm-8">
                            <select name="users_id" required class="col-xs-10 col-sm-10 required select2" >
                                <option value="">Pilih Penguji Mikrobiologi</option>
                                @php
                                    $users =auth()->user()->id;
                                @endphp
                                @foreach ($peg as $item)
                                    @if ($item->id == $users)
                                        <option value="{{$item->id}}" selected>{{$item->name}} ({{$item->no_pegawai}})</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->name}} ({{$item->no_pegawai}})</option>
                                    @endif
                                @endforeach
                           </select>
                        </div>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Kegiatan Pengujian</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="table-responsive">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <th>No</th>
                                <th class="col-sm-2">Tangal</th>
                                <th>Kegiatan</th>
                                <th class="col-sm-6">Keterangan</th>
                            <thead>
                            <tbody>   	
                                <tr>
                                    <td style="text-align: center">1</td>
                                    <td>
                                        <input type="date" name="media_date" class="form-control"  value="{{date('Y-m-d')}}" required
                                        data-date-format="yyyy-mm-dd">
                                    </td>
                                    <td>Pembuatan Media</td>
                                    <td>
                                        <input type="text" class="form-control" name="media_ket">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">2</td>
                                    <td>
                                        <input type="date" name="baku_date" class="form-control"  value="{{date('Y-m-d')}}" required
                                        data-date-format="yyyy-mm-dd">
                                    </td>
                                    <td>Pengambilan Baku Uji</td>
                                    <td>
                                        <input type="number" class="col-sm-2" name="baku_ket" value="0"> &nbsp;&nbsp;
                                        Bead
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">3</td>
                                    <td>
                                        <input type="date" name="tumbuh_date" class="form-control"  value="{{date('Y-m-d')}}" required
                                        data-date-format="yyyy-mm-dd">
                                    </td>
                                    <td>Media Pertumbuhan</td>
                                    <td>
                                        <input type="number" class="col-sm-2" name="tumbuh_ket" value="0"> &nbsp;&nbsp;
                                        mL BHIB
                                    </td>
                                </tr>
                            <tbody>
                        </table>
                    </div>
                </fieldset>   
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Pengamatan</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="table-responsive">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="col-sm-2">Tanggal</th>
                                    <th rowspan="2">Media</th>
                                    <th colspan="2">Inkubasi</th>
                                    <th colspan="2">Pengamatan</th>
                                </tr>
                                <tr>
                                    <th>Suhu (°C)</th>
                                    <th>Waktu (Jam)</th>
                                    <th class="col-sm-3">Baku Uji</th>
                                    <th class="col-sm-3">Pengamatan</th>
                                </tr>
                            <thead>
                            <tbody id="daftarmedia">
                            </tbody>	
                        </table>
                    </div>
                </fieldset>   
   
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Hasil Pengamatan</h3></div>
            <div class="panel-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Pengamatan
                        </label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Positif"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="hasil"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kesimpulan
                        </label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="kesimpulan"
                                    class="col-xs-10 col-sm-10 required " 
                                    name="kesimpulan"/>
                        </div>
                    </div>
                   
                </fieldset>   
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
@endsection
@section('footer')
    <script>
        function getMedia(){
            var bakteri_id = $("#bakteri").val();

            $.get(
                "{{route('bakteri.getDaftarMedia') }}",
                {
                    bakteri_id: bakteri_id
                },
                function(response) {
                    var daftarmedia="";
                    for (let i = 0; i < response.data.length; i++) {
                        var is_check = '';
                        var no = i+1;
                        
                        daftarmedia+='<tr>'+
                            '<td>'+
                                '<input type="date" name="amati_date[]" class="form-control" data-date-format="form-control" onchange="getKontrol('+no+')"/>'+
                            '</td>'+
                            '<td>'+response.data[i].name+
                                '<input type="hidden" name="media_id[]" value="'+response.data[i].id+'" id="mediaId-'+no+'">'+
                            '</td>'+
                            '<td>'+response.data[i].temperature+
                            '</td>'+
                            '<td>'+response.data[i].period+
                            '</td>'+
                            '<td>'+
                                '<select name="kontrol_id[]"  select2"  class="form-control" id="kontrol-'+no+'">'+
                                    '<option value="">Pilih Kontrol</option>'+
                                '</select>'+
                            '</td>'+
                            '<td>'+response.data[i].status+
                            '</td>'+
                        '</tr>';
                        ;
                    }
                    $("#daftarmedia").html(daftarmedia);
                }
            );
        }

        function getKontrol(i){
            var media_id = $("#mediaId-"+i).val();

            $.get(
                "{{route('kontrol.getKontrol') }}",
                {
                    media_id: media_id
                },
                function(response) {
                    var data = response.data;
                    var string ="<option value=''>Pilih Kontrol</option>";
                        $.each(data, function(index, value) {
                            string = string + `<option value="` + value.id + `">` + value.status + `</option>`;
                        })
                    $("#kontrol-"+i).html(string);
                }
            );
        }

    </script>
@endsection