@extends('layouts.mon')
@section('breadcrumb')
    <li><a href="/finance/travelexpenses">Biaya Perjalanan Dinas</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/travelexpenses/update/{{$data->id}}">
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
                
                  centanguang+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.expen1[i].name+
                            '<input type="hidden" name="outst_employee_id[]" class="outid" value='+response.expen1[i].outst_employee_id+'>'+
                        '</td>'+
                        '<td>'+
                            '@if ('+response.expen1[i].dailywage+'=="Y")'+
                                '<input type="checkbox" name="dailywage[]" value="Y" checked>&nbsp;'+
                            '@else'+
                                '<input type="checkbox" name="dailywage[]" value="Y">&nbsp;'+
                            '@endif'+  
                            '<input type="text" name="hitdaily[]" value='+response.expen1[i].hitdaily+' readonly style="width:50%">/hr'+
                        '</td>'+
                        '<td>'+
                        '@if ('+response.expen1[i].diklat+'=="Y")'+
                                '<input type="checkbox" name="diklat[]" value="Y" checked>&nbsp;'+
                            '@else'+
                                '<input type="checkbox" name="diklat[]" value="Y">&nbsp;'+
                            '@endif'+  
                            '<input type="text" name="hitdiklat[]" value='+response.expen1[i].hitdiklat+' readonly style="width:50%">/hr'+
                        '</td>'+            
                        '<td>@if ('+response.expen1[i].fullboard+'=="Y")'+
                                '<input type="checkbox" name="fullboard[]" value="Y" checked>&nbsp;'+
                            '@else'+
                                '<input type="checkbox" name="fullboard[]" value="Y">&nbsp;'+
                            '@endif'+  
                            '<input type="text" name="hitfullb[]" value='+response.expen1[i].hitfullb+' readonly style="width:50%">/hr'+
                        '</td>'+             
                        '<td>@if ('+response.expen1[i].fullday+'=="Y")'+
                                '<input type="checkbox" name="fullday[]" value="Y" checked>&nbsp;'+
                            '@else'+
                                '<input type="checkbox" name="fullday[]" value="Y">&nbsp;'+
                            '@endif'+  
                            '<input type="text" name="hithalf[]" value='+response.expen1[i].hithalf+' readonly style="width:50%">/hr'+
                        '</td>'+
                        '<td>@if ('+response.expen1[i].representatif+'=="Y")'+
                                '<input type="checkbox" name="representatif[]" value="Y" checked>&nbsp;'+
                            '@else'+
                                '<input type="checkbox" name="representatif[]" value="Y">&nbsp;'+
                            '@endif'+  
                            '<input type="text" name="hitrep[]" value='+response.expen1[i].hitrep+' readonly style="width:50%">/hr'+
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
                            '<input type="hidden" name="outst_employee_id[]" class="outid" value='+response.expen2[i].outst_employee_id+'>'+
                        '</td>'+
                        '<td><input type="text" name="innname_1[]" value="'+response.expen2[i].innname_1+'"/></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].inn_fee_1+'" name="inn_fee_1[]" /></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].long_stay_1+'" name="long_stay_1[]" /></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].isi_1+'" name="isi_1[]" style="width: 70%"/>org'+
                        '</td>'+
                        '<td><input type="text" name="innname_2[]"  value="'+response.expen2[i].innname_2+'"/></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].inn_fee_2+'" name="inn_fee_2[]" /></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].long_stay_2+'" name="long_stay_2[]" /></td>'+
                        '<td><input type="number" min="0" value="'+response.expen2[i].isi_2+'" name="isi_2[]" style="width: 70%"/>org'+
                        '</td>'+   
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
                        '<td><input type="number" style="width: 35%" min="0" value="'+response.expen2[i].taxy_count_from+'" name="taxy_count_from[]" /> kali</td>'+            
                        '<td><input type="number" min="0" value="'+response.expen2[i].taxy_fee_from+'" name="taxy_fee_from[]" /></td>'+            
                        '<td><input type="number" style=" width: 35%" min="0" value="'+response.expen2[i].taxy_count_to+'" name="taxy_count_to[]" /> kali</td>'+            
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
                        '<td><input type="number" min="0" name="dayshalf[]" value="'+response.expen1[i].dayshalf+'"/></td>'+       
                        '<td><input type="number" min="0" name="feehalf[]" value="'+response.expen1[i].feehalf+'"/></td>'+                   
                        '<td><input type="number" min="0" name="daysfull[]" value="'+response.expen1[i].daysfull+'"/></td>'+  
                        '<td><input type="number" min="0" name="feefull[]" value="'+response.expen1[i].feefull+'" /></td>'+                 
                    '</tr>';
                }
                $("#meeting").html(meeting);
            }
        );
       }
   </script>
@endsection