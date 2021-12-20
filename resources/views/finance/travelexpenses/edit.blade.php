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
                @include('finance.travelexpenses.partials.employee')
                @include('finance.travelexpenses.partials.transport')
                @include('finance.travelexpenses.partials.ticket')
                @include('finance.travelexpenses.partials.inn')
                @include('finance.travelexpenses.partials.meeting')
                @include('finance.travelexpenses.partials.uploads')
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
        $().ready( function () {
            getIsian();
        } );

       function getIsian(){
           var id = $("#expenses_id").val();

           $.get(
            "{{route('travelexpenses.getIsian') }}",
            {
                id:id
            },
            function(response) {

                 // ------uang harian--------------//
                var centanguang="";
                for (let i = 0; i < response.expen1.length; i++) {
                  var is_check = '';
                  var no = i+1;
                    //---centang UH----
                    if (response.expen1[i].dailywage == 'Y') {
                        var dai = '<input type="checkbox" name="dailywage[]" value="Y" checked>';
                    } else {
                        var dai = '<input type="checkbox" name="dailywage[]" value="Y">';
                    }
                    //---centang UH DIKLAT----
                    if (response.expen1[i].diklat == 'Y') {
                        var dik = '<input type="checkbox" name="diklat[]" value="Y" checked>';
                    } else {
                        var dik = '<input type="checkbox" name="diklat[]" value="Y">';
                    }

                    //---centang UH FULLBOARD----
                    if (response.expen1[i].fullboard == 'Y') {
                        var fb = '<input type="checkbox" name="fullboard[]" value="Y" checked>';
                    } else {
                        var fb = '<input type="checkbox" name="fullboard[]" value="Y">';
                    }

                    //---centang UH HALFDAYS----
                    if (response.expen1[i].fullday == 'Y') {
                        var fday = '<input type="checkbox" name="fullday[]" value="Y" checked>';
                    } else {
                        var fday = '<input type="checkbox" name="fullday[]" value="Y">';
                    }

                     //---centang UH REPRESENTATIF----
                     if (response.expen1[i].representatif == 'Y') {
                        var rep = '<input type="checkbox" name="representatif[]" value="Y" checked>';
                    } else {
                        var rep = '<input type="checkbox" name="representatif[]" value="Y">';
                    }
                    
                  centanguang+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.expen1[i].name+
                            '<input type="hidden" name="outst_employee_id[]" class="outid" value='+response.expen1[i].outst_employee_id+'>'+
                        '</td>'+
                        '<td>'+dai+'&nbsp;'+
                            '<input type="number" name="hitdaily[]"  min="0" value="'+response.expen1[i].hitdaily+'" style="width: 50%;"  id="hitdaily-'+no+'"> X '+
                            '<input type="number" name="jumdaily[]"  min="0" value="'+response.expen1[i].jumdaily+'" style="width:25%"  id="jumdaily-'+no+'" onkeyup="totdaily('+no+')">'+
                            ' = <input type="text" name="totdaily[]"  min="0" value="'+response.expen1[i].totdaily+'" readonly style="width: 85%;" id="totdaily-'+no+'">'+
                        '</td>'+
                        '<td>'+dik+'&nbsp;'+
                            '<input type="number" name="hitdiklat[]"  min="0" value="'+response.expen1[i].hitdiklat+'" style="width: 50%;"  id="hitdiklat-'+no+'"> X '+
                            '<input type="number" name="jumdiklat[]"  min="0" value="'+response.expen1[i].jumdiklat+'" style="width:25%"  id="jumdiklat-'+no+'" onkeyup="totdiklat('+no+')">'+
                            ' = <input type="text" name="totdiklat[]"  min="0" value="'+response.expen1[i].totdiklat+'" readonly style="width: 85%;" id="totdiklat-'+no+'">'+
                        '</td>'+   
                        '<td>'+fb+'&nbsp;'+         
                            '<input type="number" name="hitfullb[]"   min="0" value="'+response.expen1[i].hitfullb+'" style="width: 50%;"  id="hitfullb-'+no+'"> X '+
                            '<input type="number" name="jumfullb[]"   min="0" value="'+response.expen1[i].jumfullb+'" style="width:25%"  id="jumfullb-'+no+'" onkeyup="totfullb('+no+')">'+
                            ' = <input type="text" name="totfullb[]"  min="0" value="'+response.expen1[i].totfullb+'" readonly style="width: 85%;" id="totfullb-'+no+'">'+
                        '</td>'+  
                        '<td>'+fday+'&nbsp;'+              
                            '<input type="number" name="hithalf[]" value="'+response.expen1[i].hithalf+'"  style="width: 50%;"  id="hithalf-'+no+'"> X '+
                            '<input type="number" name="jumhalf[]"  min="0" value="'+response.expen1[i].jumhalf+'"  style="width:25%"  id="jumhalf-'+no+'" onkeyup="tothalf('+no+')">'+
                            ' = <input type="text" name="tothalf[]"  min="0" value="'+response.expen1[i].tothalf+'"  readonly style="width: 85%;" id="tothalf-'+no+'">'+
                        '</td>'+
                        '<td>'+rep+'&nbsp;'+   
                            '<input type="number" name="hitrep[]"   min="0" value="'+response.expen1[i].hitrep+'" style="width: 50%;"  id="hitrep-'+no+'"> X '+
                            '<input type="number" name="jumrep[]"   min="0" value="'+response.expen1[i].jumrep+'" style="width:25%"  id="jumrep-'+no+'" onkeyup="totrep('+no+')">'+
                            ' = <input type="text" name="totrep[]"  min="0" value="'+response.expen1[i].totrep+'" readonly style="width: 85%;" id="totrep-'+no+'">'+
                        '</td>'+
                    '</tr>';
                }
                $("#centanguang").html(centanguang);

                 // ------uang penginapan--------------//
                 var nginap="";
                for (let i = 0; i < response.expen2.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  nginap+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.expen2[i].name+
                        '</td>'+
                        '<td><input type="text" name="innname_1[]" value="'+response.expen2[i].innname_1+'"/></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].inn_fee_1+'" name="inn_fee_1[]" id="innfee1-'+no+'"/></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].long_stay_1+'" name="long_stay_1[]" id="longstay1-'+no+'" style="width: 50px"/></td>' +
                        '<td><input type="number" min="0" value="'+response.expen2[i].isi_1+'" name="isi_1[]" style="width: 50px"  id="isi1-'+no+'" onkeyup="longstay1('+no+')"/>org</td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].klaim_1+'" name="klaim_1[]"  id="klaim1-'+no+'"/></td>'+
                        '<td><input type="text" name="innname_2[]" value="'+response.expen2[i].innname_2+'"/></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].inn_fee_2+'" name="inn_fee_2[]" id="innfee2-'+no+'"/></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].long_stay_2+'" name="long_stay_2[]" id="longstay2-'+no+'" style="width: 50px"/></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].isi_2+'" name="isi_2[]" style="width: 50px" id="isi2-'+no+'" onkeyup="longstay2('+no+')"/>org </td>'+ 
                        '<td><input type="number" min="0" value="'+response.expen2[i].klaim_2+'" name="klaim_2[]" id="klaim2-'+no+'"/></td>'+
                    '</tr>';
                }
                $("#nginap").html(nginap);

                 // ------uang tiket pesawat--------------//
                 var pesawat="";
                for (let i = 0; i < response.expen2.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  pesawat+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.expen2[i].name+
                        '</td>'+
                        '<td>'+
                            '<select name="plane_id1[]"  select2" >'+
                                '<option value="">Pilih Maskapai</option>'+
                                    '@foreach ($plane as $item)'+
                                        '@if ('+response.expen2[i].plane_id1+'==$item->id)'+
                                            '<option value="{{$item->id}}" selected>{{$item->code}} - {{$item->name}}</option>'+
                                        '@else'+
                                            '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                                        '@endif'+
                                    '@endforeach'+
                            '</select>'+
                        '</td>'+
                        '<td><input type="text" placeholder="nomor tiket" name="planenumber1[]" value="'+response.expen2[i].planenumber1+'"/></td>'+
                        '<td><input type="number" min="0" name="planefee1[]" value="'+response.expen2[i].planefee1+'"/></td>'+
                        '<td><input type="date" name="godate1[]" value="'+response.expen2[i].godate1+'"/></td>'+
                        '<td>'+
                            '<select name="plane_id2[]"  select2" >'+
                                '<option value="">Pilih Maskapai</option>'+
                                    '@foreach ($plane as $item)'+
                                        '@if ('+response.expen2[i].plane_id2+'==$item->id)'+
                                            '<option value="{{$item->id}}" selected>{{$item->code}} - {{$item->name}}</option>'+
                                        '@else'+
                                            '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                                        '@endif'+
                                    '@endforeach'+
                            '</select>'+
                        '</td>'+
                        '<td><input type="text" placeholder="nomor tiket" name="planenumber2[]" value="'+response.expen2[i].planenumber2+'"/></td>'+
                        '<td><input type="number" min="0"  name="planefee2[]" value="'+response.expen2[i].planefee2+'"/></td>'+
                        '<td><input type="date" name="godate2[]" value="'+response.expen2[i].godate2+'"/></td>'+
                        '<td>'+
                            '<select name="plane_id3[]"  select2" >'+
                                '<option value="">Pilih Maskapai</option>'+
                                    '@foreach ($plane as $item)'+
                                        '@if ('+response.expen2[i].plane_id3+'==$item->id)'+
                                            '<option value="{{$item->id}}" selected>{{$item->code}} - {{$item->name}}</option>'+
                                        '@else'+
                                            '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                                        '@endif'+
                                    '@endforeach'+
                            '</select>'+
                        '</td>'+
                        '<td><input type="text" placeholder="nomor tiket" name="planenumber3[]" value="'+response.expen2[i].planenumber3+'"/></td>'+
                        '<td><input type="number" min="0" name="planefee3[]" value="'+response.expen2[i].planefee3+'"/></td>'+
                        '<td><input type="date" name="godate3[]" value="'+response.expen2[i].godate3+'"/></td>'+
                        '<td>'+
                            '<select name="plane_idreturn[]"  select2" >'+
                                '<option value="">Pilih Maskapai</option>'+
                                    '@foreach ($plane as $item)'+
                                        '@if ('+response.expen2[i].plane_idreturn+'==$item->id)'+
                                            '<option value="{{$item->id}}" selected>{{$item->code}} - {{$item->name}}</option>'+
                                        '@else'+
                                            '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                                        '@endif'+
                                    '@endforeach'+
                            '</select>'+
                        '</td>'+
                        '<td><input type="text" placeholder="nomor tiket" name="planenumberreturn[]" value="'+response.expen2[i].planenumberreturn+'"/></td>'+
                        '<td><input type="number" min="0" name="planereturnfee[]" value="'+response.expen2[i].planereturnfee+'"/> </td>'+
                        '<td><input type="date" name="returndate[]"value="'+response.expen2[i].returndate+'" /> </td>'+
                        
                    '</tr>';
                }
                $("#pesawat").html(pesawat);

                 // ------uang transport--------------//
                 var transport="";
                for (let i = 0; i < response.expen2.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  transport+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.expen2[i].name+
                        '</td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].bbm+'" name="bbm[]" /></td>'+
                        '<td><input type="number" style="width: 50%" min="0" value="'+response.expen2[i].taxy_count_from+'" name="taxy_count_from[]" /> kali</td>'+            
                        '<td><input type="number" min="0" value="'+response.expen2[i].taxy_fee_from+'" name="taxy_fee_from[]" /></td>'+            
                        '<td><input type="number" style=" width: 50%" min="0" value="'+response.expen2[i].taxy_count_to+'" name="taxy_count_to[]" /> kali</td>'+            
                        '<td><input type="number" min="0" value="'+response.expen2[i].taxy_fee_to+'" name="taxy_fee_to[]" /></td>'+              
                    '</tr>';
                }
                $("#transport").html(transport);

                 // ------uang pertemuan--------------//
                 var meeting="";
                for (let i = 0; i < response.expen1.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  meeting+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.expen1[i].name+
                        '</td>'+
                        '<td><input type="number" min="0" value="'+response.expen1[i].dayshalf+'" name="dayshalf[]" style="width:50px;" id="dayshalf-'+no+'"/></td>'+       
                        '<td><input type="number" min="0" value="'+response.expen1[i].feehalf+'" name="feehalf[]" id="feehalf-'+no+'" onkeyup="feehalf('+no+')"/></td>'+    
                        '<td><input type="number" min="0" value="'+response.expen1[i].totdayshalf+'" name="totdayshalf[]" readonly id="totdayshalf-'+no+'"/></td>'+                   
                        '<td><input type="number" min="0" value="'+response.expen1[i].daysfull+'" name="daysfull[]" style="width:50px;" id="daysfull-'+no+'"/></td>'+  
                        '<td><input type="number" min="0" value="'+response.expen1[i].feefull+'" name="feefull[]" id="feefull-'+no+'" onkeyup="feefull('+no+')"/></td>'+   
                        '<td><input type="number" min="0" value="'+response.expen1[i].totdaysfull+'" name="totdaysfull[]" readonly id="totdaysfull-'+no+'"/></td>'+  
                    '</tr>';
                }
                $("#meeting").html(meeting);

                //------Uploads File Kuitansi---------//
                 var uploads="";
                for (let i = 0; i < response.expen1.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  if (response.expen1[i].file != null) {
                      var ada = '<label><a href="'+response.expen1[i].getFIleReceipt+'" target="_blank" >'+response.expen1[i].file+'</a></label>';
                  }else{
                      var ada = '';
                  }

                  uploads+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.expen1[i].name+'</td>'+
                        '<td>'+
                            '<input type="file" name="file-'+no+'" class="btn btn-default btn-sm" id="" value="Upload File">'+ada+     
                        '</td>'+
                    '</tr>';
                }
                $("#uploads").html(uploads);
            });
        }
        function totdaily(i) {
            var a = $("#hitdaily-"+i).val();
            var b =  $("#jumdaily-"+i).val();
            var c = a * b;
            var hasil = parseFloat(c).toFixed(2);
            $("#totdaily-"+i).val(hasil);
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
   </script>
@endsection