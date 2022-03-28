@extends('layouts.mon')
@section('breadcrumb')
    <li><a href="/finance/travelexpenses">Biaya Perjalanan Dinas</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="{{route('travelexpenses.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Input Biaya Perjalanan Dinas</h3></div>
                <div class="panel-body">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">Tanggal Kuitansi
                            </label>
                            <div class="col-sm-8">
                                <input type="date" required id="date" value="{{date('Y-m-d')}}"
                                        class="col-xs-3 col-sm-3 required " 
                                        name="date"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Surat Tugas
                            </label>
                            <div class="col-sm-8"> 
                                <select name="outstation_id" class="col-xs-10 col-sm-10 required select2" required id="outstation_id"
                                    onchange="getMaksud()"
                                >
                                    <option value="">Pilih Nomor Surat Tugas</option>
                                    @foreach ($st as $item)
                                        <option value="{{$item->id}}">{{$item->number}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Maksud Tugas
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama kegiatan" readonly id="maksud"
                                        class="col-xs-10 col-sm-10 " 
                                        name="purpose"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Dinas
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama kegiatan" readonly id="jenis"
                                        class="col-xs-10 col-sm-10 " 
                                        name="jenis"/>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tujuan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly id="tujuan"
                                        class="col-xs-10 col-sm-10 " 
                                        name="tujuan"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> lama hari
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  readonly id="lamahari"
                                        class="col-xs-1 col-sm-1 " 
                                        name="lama"/>
                            </div>
                        </div>
                       
                    </fieldset>   
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
        </ul>
        <div  class="tab-content" style="overflow: scroll">
                @include('finance.travelexpenses.partials.employee')
                @include('finance.travelexpenses.partials.transport')
                @include('finance.travelexpenses.partials.ticket')
                @include('finance.travelexpenses.partials.inn')
                @include('finance.travelexpenses.partials.meeting')
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
       function getMaksud(){
           var id = $("#outstation_id").val();

           $.get(
            "{{route('travelexpenses.getMaksud') }}",
            {
                id:id
            },
            function(response) {

                // ------DATA ST--------------//
                $("#maksud").val(response.st.purpose);
                $("#lamahari").val(response.lama.lawas);

                var tujuan1 = response.dest.capital;
                var tujuan2 = response.dest2.capital;
                var tujuan3 = response.dest3.capital;

                if (response.jumltu.hitung ==1) {
                    var isitujuan = tujuan1;
                } else if (response.jumltu.hitung ==2) {
                    var isitujuan = tujuan1+' dan '+tujuan2;
                } else {
                    var isitujuan = tujuan1+' , '+tujuan2+' dan '+tujuan3;
                }
                
                $("#tujuan").val(isitujuan);

               

                if (response.st.type=='DL') {
                    var r = 'Dalam Kota';
                } else if (response.st.type=='LK') {
                    var r = 'Luar Kota';
                } else {
                    var r = 'Dalam Kota > 8 Jam';
                }
                $("#jenis").val(r);

                 // ------uang harian--------------//
                var centanguang="";
                for (let i = 0; i < response.peg.length; i++) {
                  var is_check = '';
                  var no = i+1;
                
                if (response.st.type=='DL8') { //DALAM KOTA
                    if (response.peg[i].deskjob != 'Sopir') {
                        if (response.peg[i].jabatan_id=='6') { //kabalai
                            var daily = response.dest.dailywageDK1;
                            var daily2 = 0;
                            var daily3 = 0;
                        } else if(response.peg[i].jabatan_id=='11') { //kabag
                            var daily = response.dest.dailywageDK2;
                            var daily2 = 0;
                            var daily3 = 0;
                        } else if(response.peg[i].jabatan_id=='7') { //koor
                            var daily = response.dest.dailywageDK3;
                            var daily2 = 0;
                            var daily3 = 0;
                        } else if(response.peg[i].jabatan_id=='5') { //sub
                            var daily = response.dest.dailywageDK4;
                            var daily2 = 0;
                            var daily3 = 0;
                        } else {
                            var daily = response.dest.dailywageDK5;
                            var daily2 = 0;
                            var daily3 = 0;
                        }
                    } else {
                        var daily = response.dest.DKDriver;
                        var daily2 = 0;
                        var daily3 = 0;
                    }
                } else{ //LUAR KOTA
                    if (response.jumltu.hitung ==1) { //jumlah tujuan 1
                        if (response.peg[i].deskjob !='Sopir') {
                            if (response.peg[i].jabatan_id=='6') { //kabalai
                                var daily = response.dest.dailywageLK1;
                                var daily2 = 0;
                                var daily3 = 0;
                            } else if(response.peg[i].jabatan_id=='11') { //kabag
                                var daily = response.dest.dailywageLK2;
                                var daily2 = 0;
                                var daily3 = 0;
                            } else if(response.peg[i].jabatan_id=='7') { //koor
                                var daily = response.dest.dailywageLK3;
                                var daily2 = 0;
                                var daily3 = 0;
                            } else if(response.peg[i].jabatan_id=='5') { //sub
                                var daily = response.dest.dailywageLK4;
                                var daily2 = 0;
                                var daily3 = 0;
                            } else {
                                var daily = response.dest.dailywageLK5;
                                var daily2 = 0;
                                var daily3 = 0;
                            }
                        } else { 
                            var daily = response.dest.LKDriver;
                            var daily2 = 0;
                            var daily3 = 0;
                        }  
                    } else if(response.jumltu.hitung ==2) { //jumlah tujuan 2
                        if (response.peg[i].deskjob !='Sopir') {
                            if (response.peg[i].jabatan_id=='6') { //kabalai
                                var daily = response.dest.dailywageLK1;
                                var daily2 = response.dest3.dailywageLK1;
                                var daily3 = 0;
                            } else if(response.peg[i].jabatan_id=='11') { //kabag
                                var daily = response.dest.dailywageLK2;
                                var daily2 = response.dest3.dailywageLK2;
                                var daily3 = 0;
                            } else if(response.peg[i].jabatan_id=='7') { //koor
                                var daily = response.dest.dailywageLK3;
                                var daily2 = response.dest3.dailywageLK3;
                                var daily3 = 0;
                            } else if(response.peg[i].jabatan_id=='5') { //sub
                                var daily = response.dest.dailywageLK4;
                                var daily2 = response.dest3.dailywageLK4;
                                var daily3 = 0;
                            } else {
                                var daily = response.dest.dailywageLK5;
                                var daily2 = response.dest3.dailywageLK5;
                                var daily3 = 0;
                            }
                        } else { 
                            var daily = response.dest.LKDriver;
                            var daily2 = response.dest3.LKDriver;
                            var daily3 = 0;
                        }  
                    } else { //jumlah tujuan 3
                        if (response.peg[i].deskjob !='Sopir') {
                            if (response.peg[i].jabatan_id=='6') { //kabalai
                                var daily = response.dest.dailywageLK1;
                                var daily2 = response.dest2.dailywageLK1;
                                var daily3 = response.dest3.dailywageLK1;
                            } else if(response.peg[i].jabatan_id=='11') { //kabag
                                var daily = response.dest.dailywageLK2;
                                var daily2 = response.dest2.dailywageLK2;
                                var daily3 = response.dest3.dailywageLK2;
                            } else if(response.peg[i].jabatan_id=='7') { //koor
                                var daily = response.dest.dailywageLK3;
                                var daily2 = response.dest2.dailywageLK3;
                                var daily3 = response.dest3.dailywageLK3;
                            } else if(response.peg[i].jabatan_id=='5') { //sub
                                var daily = response.dest.dailywageLK4;
                                var daily2 = response.dest2.dailywageLK4;
                                var daily3 = response.dest3.dailywageLK4;
                            } else {
                                var daily = response.dest.dailywageLK5;
                                var daily2 = response.dest2.dailywageLK5;
                                var daily3 = response.dest3.dailywageLK5;
                            }
                        } else { 
                            var daily = response.dest.LKDriver;
                            var daily2 = response.dest3.LKDriver;
                            var daily3 = 0;
                        }  
                    }
                }

                if (response.peg[i].jabatan_id=='6') { //kabalai
                    var trans = response.dest.trans1;
                    var half = response.dest.FBFD1;
                    var fullb = response.dest.FBDK1;
                    var diklat = response.dest.diklat1;
                    var rep = response.dest.representatif;
                } else if(response.peg[i].jabatan_id=='11') { //kabag
                    var trans = response.dest.trans2;
                    var half = response.dest.FBFD2;
                    var fullb = response.dest.FBDK2;
                    var diklat = response.dest.diklat2;
                    var rep = 0;
                } else if(response.peg[i].jabatan_id=='7') { //koor
                    var trans = response.dest.trans3;
                    var half = response.dest.FBFD3;
                    var fullb = response.dest.FBDK3;
                    var diklat = response.dest.diklat3;
                    var rep = 0;
                } else if(response.peg[i].jabatan_id=='5') { //sub
                    var trans = response.dest.trans4;
                    var half = response.dest.FBFD4;
                    var fullb = response.dest.FBDK4;
                    var diklat = response.dest.diklat4;
                    var rep = 0;
                } else {
                    var trans = response.dest.trans5;
                    var half = response.dest.FBFD5;
                    var fullb = response.dest.FBDK5;
                    var diklat = response.dest.diklat5;
                    var rep = 0;
                }


                  centanguang+='<tr>'+
                        '<td style="text-align: center; width: 200px;">'+no+'</td>'+
                        '<td style="width: 120px;">'+response.peg[i].name+
                            '<input type="hidden" name="outst_employee_id[]" class="outid" value='+response.peg[i].id+'>'+
                            '<input type="hidden" name="jabatan[]" value='+response.peg[i].jabatan_id+'>'+
                        '</td>'+
                        '<td><input type="checkbox" name="dailywage1_'+response.peg[i].id+'" value="Y">'+
                            '<input type="number" name="hitdaily1[]"  min="0" value="'+daily+'" style="width: 75px;"  id="hitdaily-'+no+'"> X '+
                            '<input type="number" name="jumdaily1[]"  min="0" value="0" style="width: 35px;"  id="jumdaily-'+no+'" onkeyup="totdaily('+no+')"  onclick="totdaily('+no+')">'+
                            ' = <input type="text" name="totdaily1[]"  min="0" value="0" readonly style="width: 150px;" id="totdaily-'+no+'">'+
                        '</td>'+
                        '<td><input type="checkbox" name="dailywage2_'+response.peg[i].id+'" value="Y">'+
                            '<input type="number" name="hitdaily2[]"  min="0" value="'+daily2+'"  style="width: 75px;"  id="hitdaily2-'+no+'"> X '+
                            '<input type="number" name="jumdaily2[]"  min="0" value="0" style="width: 35px;"  id="jumdaily2-'+no+'" onkeyup="totdaily2('+no+')"  onclick="totdaily2('+no+')">'+
                            ' = <input type="text" name="totdaily2[]"  min="0" value="0" readonly style="width: 150px;" id="totdaily2-'+no+'">'+
                        '</td>'+
                        '<td><input type="checkbox" name="dailywage3_'+response.peg[i].id+'" value="Y">'+
                            '<input type="number" name="hitdaily3[]"  min="0" value="'+daily3+'"  style="width: 75px;"  id="hitdaily3-'+no+'"> X '+
                            '<input type="number" name="jumdaily3[]"  min="0" value="0" style="width: 35px;"  id="jumdaily3-'+no+'" onkeyup="totdaily3('+no+')"  onclick="totdaily3('+no+')">'+
                            ' = <input type="text" name="totdaily3[]"  min="0" value="0" readonly style="width: 150px;" id="totdaily3-'+no+'">'+
                        '</td>'+
                        '<td><input type="checkbox" name="diklat_'+response.peg[i].id+'" value="Y">'+
                            '<input type="number" name="hitdiklat[]"  min="0" value='+diklat+'  style="width: 75px;" id="hitdiklat-'+no+'"> X '+
                            '<input type="number" name="jumdiklat[]"  min="0" value="0" style="width: 35px;" id="jumdiklat-'+no+'" onkeyup="totdiklat('+no+')" onclick="totdiklat('+no+')">'+
                            ' = <input type="text" name="totdiklat[]"  min="0" value="0" readonly style="width: 150px;" id="totdiklat-'+no+'">'+
                        '</td>'+            
                        '<td><input type="checkbox" name="fullboard_'+response.peg[i].id+'" value="Y">'+
                            '<input type="number" name="hitfullb[]"   min="0"value='+fullb+'  style="width: 75px;"  id="hitfullb-'+no+'"> X '+
                            '<input type="number" name="jumfullb[]"   min="0"value="0" style="width: 35px;"  id="jumfullb-'+no+'" onkeyup="totfullb('+no+')" onclick="totfullb('+no+')">'+
                            ' = <input type="text" name="totfullb[]"  min="0" value="0" readonly style="width: 150px;" id="totfullb-'+no+'">'+
                        '</td>'+             
                        '<td><input type="checkbox" name="fullday_'+response.peg[i].id+'" value="Y">'+
                            '<input type="number" name="hithalf[]" value='+half+' style="width: 75px;" id="hithalf-'+no+'"> X '+
                            '<input type="number" name="jumhalf[]"  min="0" value="0" style="width: 35px;"  id="jumhalf-'+no+'" onkeyup="tothalf('+no+')" onclick="tothalf('+no+')">'+
                            ' = <input type="text" name="tothalf[]"  min="0" value="0" readonly style="width: 150px;" id="tothalf-'+no+'">'+
                        '</td>'+
                        '<td><input type="checkbox" name="representatif_'+response.peg[i].id+'" value="Y">'+
                            '<input type="number" name="hitrep[]"   min="0" value='+rep+' style="width: 75px;" id="hitrep-'+no+'"> X '+
                            '<input type="number" name="jumrep[]"   min="0"value="0" style="width: 35px;" id="jumrep-'+no+'" onkeyup="totrep('+no+')" onclick="totrep('+no+')">'+
                            ' = <input type="text" name="totrep[]"  min="0" value="0" readonly style="width: 150px;" id="totrep-'+no+'">'+
                        '</td>'+
                    '</tr>';
                }
                $("#centanguang").html(centanguang);

                 // ------uang penginapan--------------//
                 var nginap="";
                for (let i = 0; i < response.peg.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  nginap+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td style="width: 120px;">'+response.peg[i].name+
                            '<input type="hidden" name="idpeg[]" class="outid" value='+response.peg[i].id+'>'+
                        '</td>'+
                        '<td><input type="text" name="innname_1[]" /></td>'+
                        '<td><input type="text" name="inn_loc1[]" /></td>'+
                        '<td><input type="number" name="inn_telp1[]" /></td>'+
                        '<td><input type="text" name="inn_room1[]" /></td>'+
                        '<td><input type="date" name="checkin1[]" /></td>'+
                        '<td><input type="date" name="checkout1[]" /></td>'+
                        '<td><input type="checkbox" name="inap1[]" value="Y"> Ya </td>'+
                        '<td><input type="number" min="0" value="0" name="hotelmax1[]"/></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_1[]" id="innfee1-'+no+'"/></td>'+
                        '<td><input type="number" min="0" value="0" name="long_stay_1[]" id="longstay1-'+no+'" style="width: 50px"/></td>' +
                        '<td><input type="number" min="0" value="0" name="isi_1[]" style="width: 50px"  id="isi1-'+no+'" onkeyup="longstay1('+no+')"/>org</td>'+
                        '<td><input type="number" min="0" value="0" name="klaim_1[]"  id="klaim1-'+no+'"/></td>'+
                        '<td><input type="text" name="innvoice1[]" /></td>'+
                        '<td><input type="text" name="innname_2[]" /></td>'+
                        '<td><input type="text" name="inn_loc2[]" /></td>'+
                        '<td><input type="number" name="inn_telp2[]" /></td>'+
                        '<td><input type="text" name="inn_room2[]" /></td>'+
                        '<td><input type="date" name="checkin2[]" /></td>'+
                        '<td><input type="date" name="checkout2[]" /></td>'+
                        '<td><input type="checkbox" name="inap2[]" value="N"> Ya</td>'+
                        '<td><input type="number" min="0" value="0" name="hotelmax2[]"/></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_2[]" id="innfee2-'+no+'"/></td>'+
                        '<td><input type="number" min="0" value="0" name="long_stay_2[]" id="longstay2-'+no+'" style="width: 50px"/></td>'+
                        '<td><input type="number" min="0" value="0" name="isi_2[]" style="width: 50px" id="isi2-'+no+'" onkeyup="longstay2('+no+')"/>org </td>'+ 
                        '<td><input type="number" min="0" value="0" name="klaim_2[]" id="klaim2-'+no+'"/></td>'+
                        '<td><input type="text" name="innvoice2[]" /></td>'+
                    '</tr>';
                }
                $("#nginap").html(nginap);

                 // ------uang tiket pesawat--------------//
                 var pesawat="";
                for (let i = 0; i < response.peg.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  pesawat+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td style="width: 120px;">'+response.peg[i].name+
                            '<input type="hidden" name="idpeg[]" class="outid" value='+response.peg[i].id+'>'+
                        '</td>'+
                        '<td>'+
                            '<select name="plane_id1[]"  select2" >'+
                                '<option value="">Pilih Maskapai</option>'+
                                    '@foreach ($plane as $item)'+
                                        '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                                    '@endforeach'+
                            '</select>'+
                        '</td>'+
                        '<td><input type="text" placeholder="nomor tiket" name="planenumber1[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="planefee1[]" /></td>'+
                        '<td><input type="date" name="godate1[]" /></td>'+
                        '<td><input type="text" name="plane_book1[]" /></td>'+
                        '<td><input type="text" name="plane_flight1[]" /></td>'+
                        '<td>'+
                            '<select name="plane_id2[]"  select2" >'+
                                '<option value="">Pilih Maskapai</option>'+
                                    '@foreach ($plane as $item)'+
                                        '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                                    '@endforeach'+
                            '</select>'+
                        '</td>'+
                        '<td><input type="text" placeholder="nomor tiket" name="planenumber2[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="planefee2[]" /></td>'+
                        '<td><input type="date" name="godate2[]" /></td>'+
                        '<td><input type="text" name="plane_book2[]" /></td>'+
                        '<td><input type="text" name="plane_flight2[]" /></td>'+
                        '<td>'+
                            '<select name="plane_id3[]"  select2" >'+
                                '<option value="">Pilih Maskapai</option>'+
                                    '@foreach ($plane as $item)'+
                                        '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                                    '@endforeach'+
                            '</select>'+
                        '</td>'+
                        '<td><input type="text" placeholder="nomor tiket" name="planenumber3[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="planefee3[]" /></td>'+
                        '<td><input type="date" name="godate3[]" /></td>'+
                        '<td><input type="text" name="plane_book3[]" /></td>'+
                        '<td><input type="text" name="plane_flight3[]" /></td>'+
                        '<td>'+
                            '<select name="plane_idreturn[]"  select2" >'+
                                '<option value="">Pilih Maskapai</option>'+
                                    '@foreach ($plane as $item)'+
                                        '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                                    '@endforeach'+
                            '</select>'+
                        '</td>'+
                        '<td><input type="text" placeholder="nomor tiket" name="planenumberreturn[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="planereturnfee[]" /> </td>'+
                        '<td><input type="date" name="returndate[]" /> </td>'+
                        '<td><input type="text" name="plane_bookreturn[]" /></td>'+
                        '<td><input type="text" name="plane_flightreturn[]" /></td>'+
                        
                    '</tr>';
                }
                $("#pesawat").html(pesawat);

                 // ------uang transport--------------//
                 var transport="";
                for (let i = 0; i < response.peg.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  transport+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td style="width: 120px;">'+response.peg[i].name+
                            '<input type="hidden" name="idpeg[]" class="outid" value='+response.peg[i].id+'>'+
                        '</td>'+
                        '<td><input type="checkbox" name="tlokal[]" value="Y">'+
                            '<input type="number" name="hittlokal[]"  min="0" value="'+trans+'" style="width: 75px;"  id="hittlokal-'+no+'"> X '+
                            '<input type="number" name="jumtlokal[]"  min="0" value="0" style="width: 35px;"  id="jumtlokal-'+no+'" onkeyup="jumtlokal('+no+')"  onclick="jumtlokal('+no+')">'+
                            ' = <input type="text" name="tottlokal[]"  min="0" value="0" readonly style="width: 150px;" id="tottlokal-'+no+'">'+
                        '</td>'+
                        '<td><input type="number" min="0" value="0" name="bbm[]" /></td>'+
                        '<td><input type="number" style="width: 50px" min="0" value="0" name="taxy_count_from[]" /> kali'+
                            '<input type="checkbox" name="taxyriil[]" value="Y">Riils</td>'+            
                        '<td><input type="number" min="0" value="0" name="taxy_fee_from[]" /></td>'+            
                        '<td><input type="number" style=" width: 50px" min="0" value="0" name="taxy_count_to[]" /> kali'+
                            '<input type="checkbox" name="taxyriil2[]" value="Y">Riil</td>'+            
                        '<td><input type="number" min="0" value="0" name="taxy_fee_to[]" /></td>'+              
                    '</tr>';
                }
                $("#transport").html(transport);

                 // ------uang pertemuan--------------//
                 var meeting="";
                for (let i = 0; i < response.peg.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  meeting+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td style="width: 120px;">'+response.peg[i].name+
                            '<input type="hidden" name="idpeg[]" class="outid" value='+response.peg[i].id+'>'+
                        '</td>'+
                        '<td><input type="number" min="0" value="0" name="dayshalf[]" style="width:50px;" id="dayshalf-'+no+'"/></td>'+       
                        '<td><input type="number" min="0" value="0" name="feehalf[]" id="feehalf-'+no+'" onkeyup="feehalf('+no+')"/></td>'+    
                        '<td><input type="number" min="0" value="0" name="totdayshalf[]" readonly id="totdayshalf-'+no+'"/></td>'+                   
                        '<td><input type="number" min="0" value="0" name="daysfull[]" style="width:50px;" id="daysfull-'+no+'"/></td>'+  
                        '<td><input type="number" min="0" value="0" name="feefull[]" id="feefull-'+no+'" onkeyup="feefull('+no+')"/></td>'+   
                        '<td><input type="number" min="0" value="0" name="totdaysfull[]" readonly id="totdaysfull-'+no+'"/></td>'+                  
                    '</tr>';
                }
                $("#meeting").html(meeting);
            });
        }
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
        function jumtlokal(i) {
            var a = $("#hittlokal-"+i).val();
            var b =  $("#jumtlokal-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#tottlokal-"+i).val(hasil);
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
   </script>
@endsection