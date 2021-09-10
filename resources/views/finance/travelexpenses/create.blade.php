@extends('layouts.mon')
@section('breadcrumb')
    <li><a href="/finance/travelexpenses"></a>Biaya Perjalanan Dinas</li>
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
                                        class="col-xs-10 col-sm-10 required " 
                                        name="purpose"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Dinas
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama kegiatan" readonly id="jenis"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="jenis"/>
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
        </ul>
        <div  class="tab-content">
                @include('finance.travelexpenses.partials.employee')
                @include('finance.travelexpenses.partials.transport')
                @include('finance.travelexpenses.partials.ticket')
                @include('finance.travelexpenses.partials.inn')
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

                  centanguang+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.peg[i].name+
                            '<input type="hidden" name="outstation_id[]" class="outid" value='+response.peg[i].users_id+'>'+
                        '</td>'+
                        '<td> <input type="text" readonly name="transport[]"/> </td>'+
                        '<td><input type="text" readonly name="transport[]"/></td>'+
                        '<td><input type="text" readonl name="transport[]" /></td>'+               
                        '<td><input type="text" readonly name="transport[]"/></td>'+                
                        '<td><input type="text" readonly name="transport[]"/></td>'+
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
                            '<input type="hidden" name="outstation_id[]" class="outid" value='+response.peg[i].users_id+'>'+
                        '</td>'+
                        '<td><input type="text" name="innname_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0"name="long_stay_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0"name="klaim_1[]" required/></td>'+
                        '<td><input type="text" name="innname_2[]" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_2" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="long_stay_2" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="klaim_2" required/></td>'+   
                    '</tr>';
                }
                $("#nginap").html(nginap);

                 // ------uang tiket pesawat--------------//
                 var nginap="";
                for (let i = 0; i < response.peg.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  nginap+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.peg[i].name+
                            '<input type="hidden" name="outstation_id[]" class="outid" value='+response.peg[i].users_id+'>'+
                        '</td>'+
                        '<td><input type="text" name="innname_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0"name="long_stay_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0"name="klaim_1[]" required/></td>'+
                        '<td><input type="text" name="innname_2[]" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_2" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="long_stay_2" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="klaim_2" required/></td>'+   
                    '</tr>';
                }
                $("#nginap").html(nginap);

                 // ------uang transport--------------//
                 var nginap="";
                for (let i = 0; i < response.peg.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  nginap+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.peg[i].name+
                            '<input type="hidden" name="outstation_id[]" class="outid" value='+response.peg[i].users_id+'>'+
                        '</td>'+
                        '<td><input type="text" name="innname_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0"name="long_stay_1[]" required/></td>'+
                        '<td><input type="number" min="0" value="0"name="klaim_1[]" required/></td>'+
                        '<td><input type="text" name="innname_2[]" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="inn_fee_2" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="long_stay_2" required/></td>'+
                        '<td><input type="number" min="0" value="0" name="klaim_2" required/></td>'+   
                    '</tr>';
                }
                $("#nginap").html(nginap);
            }
        );
       }
   </script>
@endsection