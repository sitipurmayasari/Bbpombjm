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
                $("#tujuan").val(response.dest.capital);

                if (response.st.type=='DL') {
                    var r = 'Dalam Kota';
                } else if (response.st.type=='LK') {
                    var r = 'Luar Kota';
                } else {
                    var r = 'Luar Negeri';
                }
                $("#jenis").val(r);

                 // ------uang harian--------------//
                var centanguang="";
                for (let i = 0; i < response.peg.length; i++) {
                  var is_check = '';
                  var no = i+1;
                
                if (response.st.type=='DL') {
                    if (response.peg[i].deskjob='Non ASN / Sopir') {
                        var daily = response.dest.DKDriver;
                    } else {
                        if (response.peg[i].jabatan_id=='6') { //kabalai
                            var daily = response.dest.dailywageDK1;
                        } else if(response.peg[i].jabatan_id=='11') { //kabag
                            var daily = response.dest.dailywageDK2;
                        } else if(response.peg[i].jabatan_id=='7') { //koor
                            var daily = response.dest.dailywageDK3;
                        } else if(response.peg[i].jabatan_id=='5') { //sub
                            var daily = response.dest.dailywageDK4;
                        } else {
                            var daily = response.dest.dailywageDK5;
                        }
                    }
                } else{
                    if (response.peg[i].deskjob='Non ASN / Sopir') {
                        var daily = response.dest.LKDriver;
                    } else {
                        if (response.peg[i].jabatan_id=='6') { //kabalai
                            var daily = response.dest.dailywageLK1;
                        } else if(response.peg[i].jabatan_id=='11') { //kabag
                            var daily = response.dest.dailywageLK2;
                        } else if(response.peg[i].jabatan_id=='7') { //koor
                            var daily = response.dest.dailywageLK3;
                        } else if(response.peg[i].jabatan_id=='5') { //sub
                            var daily = response.dest.dailywageLK4;
                        } else {
                            var daily = response.dest.dailywageLK5;
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
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.peg[i].name+
                            '<input type="hidden" name="outst_employee_id[]" class="outid" value='+response.peg[i].id+'>'+
                            '<input type="hidden" name="jabatan[]" value='+response.peg[i].jabatan_id+'>'+
                        '</td>'+
                        '<td><input type="checkbox" name="dailywage[]" value="Y">'+
                            '<input type="text" name="hitdaily[]" value='+daily+' readonly style="width:50%">/hr'+
                        '</td>'+
                        '<td><input type="checkbox" name="diklat[]" value="Y">'+
                            '<input type="text" name="hitdiklat[]" value='+diklat+' readonly style="width:50%">/hr'+
                        '</td>'+            
                        '<td><input type="checkbox" name="fullboard[]" value="Y">'+
                            '<input type="text" name="hitfullb[]" value='+fullb+' readonly style="width:50%">/hr'+
                        '</td>'+             
                        '<td><input type="checkbox" name="fullday[]" value="Y">'+
                            '<input type="text" name="hithalf[]" value='+half+' readonly style="width:50%">/hr'+
                        '</td>'+
                        '<td><input type="checkbox" name="representatif[]" value="Y">'+
                            '<input type="text" name="hitrep[]" value='+rep+' readonly style="width:50%">/hr'+
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
                        '<td>'+response.peg[i].name+
                            '<input type="hidden" name="idpeg[]" class="outid" value='+response.peg[i].id+'>'+
                        '</td>'+
                        '<td><input type="text" name="innname_1[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_1[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="long_stay_1[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="isi_1[]" style="width: 70%"/>org'+
                        '</td>'+
                        '<td><input type="text" name="innname_2[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_2[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="long_stay_2[]" /></td>'+
                        '<td><input type="number" min="0" value="0" name="isi_2[]" style="width: 70%"/>org'+
                        '</td>'+   
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
                        '<td>'+response.peg[i].name+
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
                        '<td>'+response.peg[i].name+
                            '<input type="hidden" name="idpeg[]" class="outid" value='+response.peg[i].id+'>'+
                        '</td>'+
                        '<td><input type="number" min="0" value="0" name="bbm[]" /></td>'+
                        '<td><input type="number" style="width: 35%" min="0" value="0" name="taxy_count_from[]" /> kali</td>'+            
                        '<td><input type="number" min="0" value="0" name="taxy_fee_from[]" /></td>'+            
                        '<td><input type="number" style=" width: 35%" min="0" value="0" name="taxy_count_to[]" /> kali</td>'+            
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
                        '<td>'+response.peg[i].name+
                            '<input type="hidden" name="idpeg[]" class="outid" value='+response.peg[i].id+'>'+
                        '</td>'+
                        '<td><input type="number" min="0" value="0" name="dayshalf[]" /></td>'+       
                        '<td><input type="number" min="0" value="0" name="feehalf[]" /></td>'+                   
                        '<td><input type="number" min="0" value="0" name="daysfull[]" /></td>'+  
                        '<td><input type="number" min="0" value="0" name="feefull[]" /></td>'+                 
                    '</tr>';
                }
                $("#meeting").html(meeting);
            }
        );
       }
   </script>
@endsection