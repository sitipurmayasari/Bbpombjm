@extends('layouts.mon')
@section('breadcrumb')
    <li><a href="/finance/travelexpenses">Biaya Perjalanan Dinas</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/travelexpenses/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
        {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Ubah Biaya Perjalanan Dinas</h3></div>
                <div class="panel-body">
                    <input type="hidden" value="{{$data->id}}" id="expenses_id">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 15%">Tanggal Kuitansi</td>
                            <td style="width: 3%">:</td>
                            <td>{{$data->date}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Surat Tugas</td>
                            <td>:</td>
                            <td>{{$data->st->number}}</td>
                        </tr>
                        <tr>
                            <td>Maksud Tugas</td>
                            <td>:</td>
                            <td>{{$data->st->purpose}}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">Tujuan</td>
                            <td style="vertical-align: top">:</td>
                            <td>
                                @if (count($data->st->outst_destiny) == 1)
                                @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->first)
                                        {{$kota->destiny->capital}} 
                                    @endif
                                    
                                @endforeach
           
                            @elseif (count($data->st->outst_destiny) == 2)
                                @foreach ($tujuan as $key=>$kota)
                                    {{$kota->destiny->capital}}
                                    @if ($tujuan->count()-1 != $key)
                                        {{' dan '}}
                                    @endif
                                @endforeach
           
                            @else
                                @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->last-1)
                                        {{$kota->destiny->capital}}{{','}} 
                                    @endif
                                    @if ($loop->last)
                                        {{' dan '}} {{$kota->destiny->capital}}
                                    @endif
                                    
                                @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lama Hari</td>
                            <td>:</td>
                            <td>{{$lama->lamahari}} ( {{terbilang($lama->lamahari)}} ) Hari
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-employee" data-toggle="tab">Uang Harian</a></li>
                <li><a href="#tab-transport" data-toggle="tab">Biaya Transport</a></li>
                <li><a href="#tab-ticket" data-toggle="tab">Tiket Pesawat</a></li>
                <li><a href="#tab-inn" data-toggle="tab">Penginapan</a></li>
                <li><a href="#tab-meeting" data-toggle="tab">Pertemuan</a></li>
                <li><a href="#tab-uploads" data-toggle="tab">Upload File</a></li>
        </ul>
        <div  class="tab-content" style="overflow: scroll">
                @include('finance.travelexpenses.partials2.employee')
                @include('finance.travelexpenses.partials2.transport')
                @include('finance.travelexpenses.partials2.ticket')
                @include('finance.travelexpenses.partials2.inn')
                @include('finance.travelexpenses.partials2.meeting')
                @include('finance.travelexpenses.partials2.uploads')
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
        function totdaily(i) {
            var a = $("#hitdaily-"+i).val();
            var b =  $("#jumdaily-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totdaily-"+i).val(hasil);
        }
        function totdaily2(i) {
            var a = $("#hitdaily2-"+i).val();
            var b =  $("#jumdaily2-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totdaily2-"+i).val(hasil);
        }
        function totdaily3(i) {
            var a = $("#hitdaily3-"+i).val();
            var b =  $("#jumdaily3-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totdaily3-"+i).val(hasil);
        }
        function totdiklat(i) {
            var a = $("#hitdiklat-"+i).val();
            var b =  $("#jumdiklat-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totdiklat-"+i).val(hasil);
        }
        function totfullb(i) {
            var a = $("#hitfullb-"+i).val();
            var b =  $("#jumfullb-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totfullb-"+i).val(hasil);
        }
        function tothalf(i) {
            var a = $("#hithalf-"+i).val();
            var b =  $("#jumhalf-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#tothalf-"+i).val(hasil);
        }
        function totrep(i) {
            var a = $("#hitrep-"+i).val();
            var b =  $("#jumrep-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totrep-"+i).val(hasil);
        }
        function longstay1(i) {
            var a = $("#longstay1-"+i).val();
            var b =  $("#isi1-"+i).val();
            var c = $("#innfee1-"+i).val();
            var d = ((c*a)/b);
            var hasil = parseFloat(d).toFixed(2);
            $("#klaim1-"+i).val(hasil);
        }
        function longstay2(i) {
            var a = $("#longstay2-"+i).val();
            var b =  $("#isi2-"+i).val();
            var c = $("#innfee2-"+i).val();
            var d = ((c*a)/b);
            var hasil = parseFloat(d).toFixed(2);
            $("#klaim2-"+i).val(hasil);
        }
        function feehalf(i) {
            var a = $("#dayshalf-"+i).val();
            var b =  $("#feehalf-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totdayshalf-"+i).val(hasil);
        }
        function feefull(i) {
            var a = $("#daysfull-"+i).val();
            var b =  $("#feefull-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totdaysfull-"+i).val(hasil);
        }
        function jumtlokal(i) {
            var a = $("#hittlokal-"+i).val();
            var b =  $("#jumtlokal-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#tottlokal-"+i).val(hasil);
        }
   </script>
@endsection