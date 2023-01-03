@inject('InjectNew', 'App\InjectNew')
@extends('layouts.din')
@section('breadcrumb')
    <li>Kuitansi</li>
    <li><a href="/finance/receipt">Biaya Perjalanan Dinas</a></li>
    <li>Ubah Detail Biaya</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/receipt/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Detail Biaya Perjalanan Dinas</h4>
                <div class="widget-toolbar">
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Kuitansi
                            </label>
                            <div class="col-sm-8">
                                <input type="date" required id="date" value="{{$data->date}}"
                                        class="col-xs-3 col-sm-3 required " 
                                        name="date"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor  Surat Tugas
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="col-xs-10 col-sm-10 " readonly value="{{$data->st->number}}"/>
                                <input type="hidden" name="expenses_id" value="{{$data->id}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Lama Perjalanan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="col-xs-1 col-sm-1 " readonly value="{{$lama->lamahari}}"/> 
                                <label class="control-label">&nbsp; hari</label>
                            </div>
                        </div>
                        
                       
                    </fieldset>        
               </div>
           </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Detail Biaya </h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                <fieldset>
                    <div class="clearfix"></div>
                    <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-employee" data-toggle="tab">Uang Harian</a></li>
                            <li><a href="#tab-transport" data-toggle="tab">Biaya Transport</a></li>
                            <li><a href="#tab-ticket" data-toggle="tab">Tiket</a></li>
                            <li><a href="#tab-inn" data-toggle="tab">Penginapan</a></li>
                            <li><a href="#tab-meeting" data-toggle="tab">Pertemuan</a></li>
                    </ul>
                    <div  class="tab-content" style="overflow: scroll">
                            @include('finance.receipt.partials2.employee')
                            @include('finance.receipt.partials2.transport')
                            @include('finance.receipt.partials2.ticket')
                            @include('finance.receipt.partials2.inn')
                            @include('finance.receipt.partials2.meeting')
                    </div>
                </fieldset>    
               </div>
           </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit" id="simpan">
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>

@endsection
@section('footer')
   <script>
    $().ready( function () {
    // ----------------------------------------------HAPUS TRANSPORT---------------------------------------------------------------
        $(".deletetr").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/finance/receipt/deletetr/"+id;
                }
            });
        });

        $(".deleteplane").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/finance/receipt/deleteplane/"+id;
                }
            });
        });

        $(".deleteinn").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/finance/receipt/deleteinn/"+id;
                }
            });
        });

    } );
    // ----------------------------------------------UANG HARIAN---------------------------------------------------------------
        function Hittlokal(i){
            var cost = $("#tlokalcost-"+i).val();
            var kali = $("#tlokalkali-"+i).val();

            var sum = (cost*kali);
            $("#tlokalsum-"+i).val(sum);
        }

        function Hituhar1(i){
            var cost = $("#uhar1cost-"+i).val();
            var kali = $("#uhar1kali-"+i).val();

            var sum = (cost*kali);
            $("#uhar1sum-"+i).val(sum);
        }

        function Hituhar2(i){
            var cost = $("#uhar2cost-"+i).val();
            var kali = $("#uhar2kali-"+i).val();

            var sum = (cost*kali);
            $("#uhar2sum-"+i).val(sum);
        }

        function Hituhar3(i){
            var cost = $("#uhar3cost-"+i).val();
            var kali = $("#uhar3kali-"+i).val();

            var sum = (cost*kali);
            $("#uhar3sum-"+i).val(sum);
        }

        function Hitdiklat(i){
            var cost = $("#diklatcost-"+i).val();
            var kali = $("#diklatkali-"+i).val();

            var sum = (cost*kali);
            $("#diklatsum-"+i).val(sum);
        }

        function Hitfullboard(i){
            var cost = $("#fullboardcost-"+i).val();
            var kali = $("#fullboardkali-"+i).val();

            var sum = (cost*kali);
            $("#fullboardsum-"+i).val(sum);
        }

        function Hitfullday(i){
            var cost = $("#fulldaycost-"+i).val();
            var kali = $("#fulldaykali-"+i).val();

            var sum = (cost*kali);
            $("#fulldaysum-"+i).val(sum);
        }

        function Hitreps(i){
            var cost = $("#repscost-"+i).val();
            var kali = $("#repskali-"+i).val();

            var sum = (cost*kali);
            $("#repssum-"+i).val(sum);
        }

    // ----------------------------------------------PESAWAT-------------------------------------------------------------
        function addBarisPlane(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris);
            $isi ='<tr id="cell-'+new_baris+'">'+
                    '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<select name="outst_employee_id_P[]" class="form-control select2"  style="width: 180px;">'+
                            '<option value="">Pilih nama Pegawai</option>'+
                            '@foreach ($peg as $item)'+
                                '<option value="{{$item->id}}">{{$item->pegawai->name}}</option>'+
                            '@endforeach'+
                        '</select>'+
                        '<input type="hidden" name="barisP[]" value="'+new_baris+'">'+
                    '</td>'+
                    '<td>'+
                        '<select name="planetype[]">'+
                            '<option value="Pesawat">Pesawat</option>'+
                            '<option value="Kereta">Kereta</option>'+
                            '<option value="Bus">Bus</option>'+
                            '<option value="Kapal/Feri">Kapal/Feri</option>'+
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<select name="plane_id[]" class="form-control select2" style="width: 150px;">'+
                        '<option value="">Pilih Maskapai</option>'+
                        '@foreach ($plane as $item)'+
                            '<option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>'+
                        '@endforeach'+
                        '</select>'+
                    '</td>'+
                    '<td style="text-align: center"><input type="checkbox" name="planekkp_'+new_baris+'" value="Y"></td>'+
                    '<td><input type="text" class="form-control" name="ticketnumber[]" style="width: 130px;"></td>'+
                    '<td><input type="number" class="form-control" name="ticketfee[]" style="width: 130px;" value="0" min="0"></td>'+
                    '<td><input type="date"  class="form-control" name="ticketdate[]"  value="{{date('Y-m-d')}}"/></td>'+
                    '<td><input type="text" class="form-control" name="bookingcode[]" style="width: 130px;"></td>'+
                    '<td><input type="text" class="form-control" name="flightnumber[]" style="width: 130px;"></td>'+
                    '<td><button type="button" class="btn btn-danger" onclick="deleteRowP('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                '</tr>';
            $("#myTable").find('tbody').append($isi);
            $("#countRow").val(new_baris);
            $('.select2').select2();
        }

        function deleteRowP(cell) {
            $("#cell-"+cell).remove();
        }

    // ----------------------------------------------HOTEL---------------------------------------------------------------

        function addBarisInn(){
        var last_baris = $("#countRow2").val();
        var new_baris = parseInt(last_baris)+1;
            $isihotel ='<tr id="cell-'+new_baris+'">'+
                    '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<select name="outst_employee_id_I[]" class="form-control select2"  style="width: 180px;">'+
                            '<option value="">Pilih nama Pegawai</option>'+
                            '@foreach ($peg as $item)'+
                                '<option value="{{$item->id}}">{{$item->pegawai->name}}</option>'+
                            '@endforeach'+
                        '</select>'+
                        '<input type="hidden" name="barisI[]" value="'+new_baris+'">'+
                    '</td>'+
                    '<td style="text-align: center"><input type="checkbox" name="hotelkkp_'+new_baris+'" value="Y"></td>'+
                    '<td style="text-align: center"><input type="checkbox" name="rillhotel_'+new_baris+'" value="Y"></td>'+
                    '<td><input type="text" class="form-control" name="hotelname[]" style="width: 150px;"></td>'+
                    '<td><input type="text" class="form-control" name="hoteladdr[]" style="width: 150px;"></td>'+
                    '<td><input type="text" class="form-control" name="hoteltelp[]" style="width: 150px;"></td>'+
                    '<td><input type="text" class="form-control" name="hotelroom[]" style="width: 100px;"></td>'+
                    '<td><input type="date"  class="form-control" name="hotelin[]"  value="{{date('Y-m-d')}}"/></td>'+
                    '<td><input type="date"  class="form-control" name="hotelout[]"  value="{{date('Y-m-d')}}"/></td>'+   
                    '<td><input type="number" class="form-control" name="hotelmax[]" style="width: 130px;" value="0" min="0" id="hotelmax-'+new_baris+'" onkeyup="HitNilaihotel('+new_baris+')"></td>'+
                    '<td>'+  
                        '<input type="checkbox" name="hotelpersen_'+new_baris+'" value="Y" onclick="Hithotel2('+new_baris+')" id="full-'+new_baris+'" "/> &nbsp; 30%'+             
                    '</td>'+
                    '<td><input type="number" class="form-control" name="hotelfee[]" style="width: 130px;" value="0" readonly id="hotelfee-'+new_baris+'"></td>'+
                    '<td><input type="number" class="form-control" name="hotellong[]" style="width: 50px;" value="0" min="0" id="hotellong-'+new_baris+'" onclick="HitSumHotel2('+new_baris+')" onkeyup="HitSumHotel2('+new_baris+')"></td>'+
                    '<td><input type="number" class="form-control" name="person[]" style="width: 50px;" value="0" min="0" id="person-'+new_baris+'" onclick="HitSumHotel2('+new_baris+')" onkeyup="HitSumHotel2('+new_baris+')"></td>'+
                    '<td><input type="number" class="form-control" name="hotelsum[]" style="width: 130px;" value="0"readonly id="hotelsum-'+new_baris+'"></td>'+
                    '<td><input type="text" class="form-control" name="hotelinfo[]" style="width: 150px;"></td>'+
                    '<td><button type="button" class="btn btn-danger" onclick="deleteRowH('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                '</tr>';
            $("#TableHotel").find('tbody').append($isihotel);
            $("#countRow2").val(new_baris);
            $('.select2').select2();
        }

        function deleteRowH(cell) {
            $("#cell-"+cell).remove();
        }

        function HitNilaihotel(i){
            var max = $("#hotelmax-"+i).val();
            $("#hotelfee-"+i).val(max);
        }

        function Hithotel2(i){
            var max = $("#hotelmax-"+i).val();

            if (document.getElementById('full-'+i).checked) {
                var sum = (max*30)/100;
                $("#hotelfee-"+i).val(sum);
            }else{
                var sum = max;
                $("#hotelfee-"+i).val(sum);
            }

            HitSumHotel2(i);
        }
        
        function HitSumHotel2(i) {
            var fee     = $("#hotelfee-"+i).val();
            var long    = $("#hotellong-"+i).val(); 
            var person  = $("#person-"+i).val();

            var sum = (fee/person)*long;
            $("#hotelsum-"+i).val(sum);
        }
    
        // ----------------------------------------------TAXI---------------------------------------------------------------
        function addBarisTaxi(){
        var last_baris = $("#countRow3").val();
        var new_baris = parseInt(last_baris);
            $isitaxi ='<tr id="cell-'+new_baris+'">'+
                    '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<select name="outst_employee_id_T[]" class="form-control select2"  style="width: 180px;">'+
                            '<option value="">Pilih nama Pegawai</option>'+
                            '@foreach ($peg as $item)'+
                                '<option value="{{$item->id}}">{{$item->pegawai->name}}</option>'+
                            '@endforeach'+
                        '</select>'+
                    '</td>'+
                    '<td style="text-align: center">'+
                        '<input type="checkbox" name="rilltaxi_'+new_baris+'" value="Y">'+
                        '<input type="hidden" name="barisT[]" value="'+new_baris+'">'+
                    '</td> '+  
                    '<td>'+
                        '<select name="taxitype[]">'+
                            '<option value="Taksi,Toll">Taxi+Toll</option>'+
                            '<option value="Uang Transport">Uang Transport</option>'+
                            '<option value="Transport Lokal">Transport Lokal</option>'+
                            '<option value="Pembelian BBM">Pembelian BBM</option>'+
                        '</select>'+
                    '</td>'+
                    '<td><input type="text" class="form-control" name="taxiname[]" style="width: 150px;"></td>'+
                    '<td><input type="number" class="form-control" name="taxifee[]"  value="0" min="0" id="taxifee-'+new_baris+'" onclick="HitSumTaxi2('+new_baris+')" onkeyup="HitSumTaxi2('+new_baris+')"></td>'+
                    '<td><input type="number" class="form-control" name="taxicount[]" value="0" min="0" id="taxicount-'+new_baris+'" onclick="HitSumTaxi2('+new_baris+')" onkeyup="HitSumTaxi2('+new_baris+')"></td>'+
                    '<td><input type="number" class="form-control" name="taxisum[]" value="0" min="0" id="taxisum-'+new_baris+'" readonly></td>'+
                    '<td><button type="button" class="btn btn-danger" onclick="deleteRowT('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                '</tr>';
            $("#TableTaxi").find('tbody').append($isitaxi);
            $("#countRow3").val(new_baris);
            $('.select2').select2();
        }

        function deleteRowT(cell) {
            $("#cell-"+cell).remove();
        }

        function HitSumTaxi2(i) {
            var fee    = $("#taxifee-"+i).val();
            var jum    = $("#taxicount-"+i).val(); 

            var sum = (fee*jum);
            $("#taxisum-"+i).val(sum);
        }

        // ----------------------------------------------MEETING---------------------------------------------------------------

        function HitSumHalfday(i) {
            var fee = $("#halflong-"+i).val();
            var jum = $("#halfcost-"+i).val(); 

            var sum = (fee*jum);
            $("#halfsum-"+i).val(sum);
        }

        function HitSumFullday(i) {
            var fee = $("#fulllong-"+i).val();
            var jum = $("#fullcost-"+i).val(); 

            var sum = (fee*jum);
            $("#fullsum-"+i).val(sum);
        }

        function HitSumFullboard(i) {
            var fee = $("#fblong-"+i).val();
            var jum = $("#fbcost-"+i).val(); 

            var sum = (fee*jum);
            $("#fbsum-"+i).val(sum);
        }

   </script>
@endsection