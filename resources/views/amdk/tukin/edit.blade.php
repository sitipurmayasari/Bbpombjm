@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Tunjangan</li>
    <li><a href="/amdk/tukin">Tunjangan Kinerja</a></li>
    <li>Ubah Tunjangan Kinerja</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/tukin/update/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <div class="col-md-2">
                    <label for="">NO. TUKIN*</label>
                    <input type="text" id="no_adu" readonly required
                    class="col-xs-12 col-sm-12 required " 
                    name="no_aduan"
                    value="{{$data->nomor}}"/>
                </div>
                <div class="col-md-2">
                    <label for="">TANGGAL *</label>
                    <input type="text" name="tanggal" readonly 
                                class="col-xs-10 col-sm-10 required" value="{{$data->tanggal}}" required
                                data-date-format="yyyy-mm-dd" data-provide="datepicker">
                </div>
                <div class="col-md-2">
                    <label > Bulan *</label>
                    <select id="bulan" name="bulan" class="col-xs-10 col-sm-10 select2" required>
                        @php
                            $bulan2 = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                         "September", "Oktober", "November", "Desember");
                            for($a=1;$a<=12;$a++){
                                if($a == $data->bulan){ 
                                    $pilih="selected";
                                }else {
                                    $pilih="";
                                }
                                echo("<option value=\"$a\" $pilih>$bulan2[$a]</option>"."\n");
                            }
                        @endphp
                    </select>
                </div>
                <div class="col-md-2">
                    <label > Tahun *</label>
                    <select id="tahun" name="tahun" class="col-xs-10 col-sm-10" required>
                        @php
                            $now=date('Y');
                            $a = $now+1;
                            if($a==$data->tahun){ 
                                    $pilih="selected";
                                }else {
                                    $pilih="";
                                }
                             echo 
                             "<option value=\"$now\" $pilih>$now</option>
                             <option value=\"$a\" $pilih>$a</option>";
                        @endphp
                    </select>
                </div>
                <div class="col-md-2">
                    <label > Bulan Terima *</label>
                    <select id="bulan" name="blnkasih" class="col-xs-10 col-sm-10 select2" required>
                        @php
                            $bulan2 = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                         "September", "Oktober", "November", "Desember");
                            for($a=1;$a<=12;$a++){
                                if($a == $data->blnkasih){ 
                                    $pilih="selected";
                                }else {
                                    $pilih="";
                                }
                                echo("<option value=\"$a\" $pilih>$bulan2[$a]</option>"."\n");
                            }
                        @endphp
                    </select>
                </div>
                <div class="col-md-2">
                    <label > Tahun Terima *</label>
                    <select id="tahun" name="thnkasih" class="col-xs-10 col-sm-10" required>
                        @php
                            $now=date('Y');
                            $a = $now+1;
                            if($a==$data->thnkasih){ 
                                    $pilih="selected";
                                }else {
                                    $pilih="";
                                }
                             echo 
                             "<option value=\"$now\" $pilih>$now</option>
                             <option value=\"$a\" $pilih>$a</option>";
                        @endphp
                    </select>
                </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">PENERIMA TUKIN</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover">
                    <thead>
                        <th class="text-center col-md-1">NO</th>
                        <th class="text-center col-md-4">Nama</th>
                        <th class="text-center col-md-2">Nilai</th>
                        <th class="text-center col-md-1">Potongan(%)</th>
                        <th class="text-center col-md-1">Potongan(Rp)</th>
                        <th class="text-center col-md-2">Total Terima</th>
                    </thead>
                    <tbody id="isi">
                        @php
                            $no=1;
                        @endphp
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{$no}}
                                    <input type="hidden" name="users_id[]"  value="{{$item->users_id}}">
                                </td>
                                <td>{{$item->pegawai->name}}</td>
                                <td><input type="number"
                                     name="nilai[]" 
                                     id="nilai-{{$no}}"
                                     value="{{$item->nilai}}"
                                      onkeyup="hitung({{$no}})"/>
                                </td>
                                <td><input type="number"
                                    name="potongan[]"  step="0.001"
                                    id="potongan-{{$no}}"
                                    value="{{$item->potongan}}"
                                     onkeyup="hitung({{$no}})"/></td>
                                <td><input type="number"
                                    name="potonganRp[]" 
                                    id="potrp-{{$no}}"
                                    value="{{$item->potonganRp}}"
                                    readonly/></td>
                                <td>
                                    <input type="number"
                                     name="terima[]" 
                                     id="terima-{{$no}}"
                                     readonly
                                     value="{{$item->terima}}"/>
                                </td>
                            </tr>
                            @php  $no++; @endphp
                        @endforeach
                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Update
        </button>
    </div>
</div>
</form>

@endsection
@section('footer')
   <script>
    $().ready( function () {

    } );
    function hitung(i) {
        var a = $("#nilai-"+i).val();
        var b =  $("#potongan-"+i).val();
        var c = a * (b/100);
        var d = a - c;
        var pot = parseFloat(c).toFixed(2);
        var hasil = parseFloat(d).toFixed(2);
        $("#terima-"+i).val(hasil);
        $("#potrp-"+i).val(pot);
    }
   </script>
@endsection
