@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Tunjangan</li>
    <li><a href="/amdk/tukin">Tunjangan Kinerja</a></li>
    <li>Tambah Tunjangan Kinerja</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" id="form_id"
         method="post" action="{{route('tukin.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <div class="col-md-2">
                    <label for="">NO. TUKIN*</label>
                    <input type="text" id="no_tukin" readonly required
                    class="col-xs-12 col-sm-12 required " 
                    name="nomor"
                    value="{{$no_tukin}}"/>
                </div>
                <div class="col-md-2">
                    <label for="">TANGGAL *</label>
                    <input type="text" name="tanggal" readonly 
                                class="col-xs-10 col-sm-10 required" value="{{date('Y-m-d')}}" required
                                data-date-format="yyyy-mm-dd" data-provide="datepicker">
                </div>
                <div class="col-md-2">
                    <label > Bulan *</label>
                    <select id="bulan" name="bulan" class="col-xs-10 col-sm-10 select2" required>
                        @php
                        $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                         "September", "Oktober", "November", "Desember");
                        for($a=1;$a<=12;$a++){
                        if($a==date("m")){ 
                            $pilih="selected";
                        }else {
                            $pilih="";
                        }
                            echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
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
                             echo 
                             "<option value='$now'>$now</option>
                             <option value='$a'>$a</option>";
                        @endphp
                    </select>
                </div>
                <div class="col-md-2">
                    <label > Bulan Terima *</label>
                    <select id="bulan" name="blnkasih" class="col-xs-10 col-sm-10 select2" required>
                        @php
                        $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                         "September", "Oktober", "November", "Desember");
                        for($a=1;$a<=12;$a++){
                        if($a==date("m")){ 
                            $pilih="selected";
                        }else {
                            $pilih="";
                        }
                            echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
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
                             echo 
                             "<option value='$now'>$now</option>
                             <option value='$a'>$a</option>";
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

                <button type="button"  class="btn btn-danger" onclick="getAsn()" id="man">
                    <i class="ace-icon fa fa-check bigger-110"></i>Manually</button>
                <button type="button"  class="btn btn-danger" onclick="myFunction()" id="aut">
                    <i class="ace-icon fa fa-check bigger-110"></i>Import From Excel</button>
                

                <br><br>
                <div id="manual">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <th class="text-center col-md-1">NO</th>
                            <th class="text-center col-md-4">Nama</th>
                            <th class="text-center col-md-2">Nilai (Rp)</th>
                            <th class="text-center col-md-1">Potongan(%)</th>
                            <th class="text-center col-md-1">Potongan(Rp)</th>
                            <th class="text-center col-md-2">Total Terima (Rp)</th>
                        </thead>
                        <tbody id="isi">
                            
                        </tbody>
                    </table>
                </div>
                <br>
                <div id="auto">
                    <input type="file" name="diimpor" class="btn btn-default btn-sm" id="" value="Upload File">
                </div>
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
    $().ready( function () {

        getAsn();

        $("#auto").hide();

    } );

    function myFunction() {
        document.getElementById("aut").classList.remove('btn-danger');  
        document.getElementById("aut").classList.add('btn-success');

        document.getElementById("man").classList.remove('btn-success');
        document.getElementById("man").classList.add('btn-danger');
        
        document.getElementById("form_id").action = "{{route('tukin.impor')}}";

        $("#manual").hide();
        $("#auto").show()
             
    }

    function getAsn(){
        document.getElementById("man").classList.remove('btn-danger');  
        document.getElementById("man").classList.add('btn-success');

        document.getElementById("aut").classList.remove('btn-success');
        document.getElementById("aut").classList.add('btn-danger');

        document.getElementById("form_id").action = "{{route('tukin.store')}}";
       

        $("#manual").show();
        $("#auto").hide()
        $.get(
            "{{route('tukin.getAsn') }}",
            function(response) {
                var isi="";
                for (let i = 0; i < response.asn.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isi+='<tr>'+
                        '<td>'+no+'</td>'+
                        '<td>'+
                        '<input type="text" name="users_id[]" hidden value="'+response.asn[i].id+'">'+
                        response.asn[i].name+' &nbsp; ('+response.asn[i].no_pegawai+')</td>'+
                        '<td><input type="number" name="nilai[]" class="nilai"  id="nilai-'+i+'" value="0" onkeyup="hitung('+i+')"></td>'+
                        '<td><input type="number" name="potongan[]"  id="potongan-'+i+'"  class="potongan"  onkeyup="hitung('+i+')"  value="0" step="0.001"></td>'+
                        '<td><input type="number" name="potonganRp[]"  id="potrp-'+i+'" readonly value="0"></td>'+
                        '<td><input type="number" name="terima[]" id="terima-'+i+'" readonly value="0"></td>'+
                    '</tr>';
                }
                $("#isi").html(isi);
            }
        );
    }
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
