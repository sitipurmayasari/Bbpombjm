@extends('layouts.app')
@section('breadcrumb')
    <li>Kendaraan</li>
    <li><a href="/invent/carrent">Peminjaman Kendaraan Dinas</a></li>
    <li>Ajukan Peminjaman</li>
@endsection
@section('content')
@include('layouts.validasi')

<style>

    /* The Modal (background) */
    .cobamodal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    
    /* Modal Content */
    .cobamodal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 15px;
      border: 1px solid #888;
      width: 40%;
      height: 30%;
    }
    
    /* The Close Button */
    .close {
      color: #332e2e;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }


    .fa-exclamation-triangle {
  color: red;
}
</style>



<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('carrent.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input peminjaman Kendaraan Dinas</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-12">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Ajuan
                            </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$kode}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="code"/>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Pengaju
                            </label>
                            <div class="col-sm-9">
                                <input type="text" value="{{auth()->user()->name}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="users_name"/>  
                                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Peminjaman
                            </label>
                            <div class="col-sm-2">
                                <input type="date" value="{{date('Y-m-d')}}"  onchange="getCar()"
                                class="col-xs-10 col-sm-10 required " 
                                name="date_from" required id="date_from" />  
                                <label class="col-sm-2 control-label no-padding-right" 
                                    for="form-field-1"> s/d
                                </label>
                            </div>
                            <div class="col-sm-2">
                                <input type="date"  onchange="getLong()"
                                class="col-xs-10 col-sm-10 required " id="date_to"
                                name="date_to" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tujuan
                            </label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Tujuan"
                                class="col-xs-10 col-sm-10 required " 
                                name="destination"/>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Upload File Pendukung *
                            </label>
                           
                            <div class="col-sm-9">
                                <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">       
                                <label><i>ex:Lorem_ipsum.pdf (*tidak wajib)</i></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.col -->

    <div id="Modalku" class="cobamodal">
        <!-- Modal content -->
        <div class="cobamodal-content">
            <span class="close">&times;</span>
            <br><br>
            <div class="col-sm-1" style="font-size: 35px;">
                <i class="fa fa-exclamation-triangle fa-10x"  aria-hidden="true"></i>
            </div>
            <div class="col-sm-9" style="text-align: center; font-size:18px"> 
                <p>Anda hanya bisa mengajukan peminjaman kendaraan
                paling cepat 5 hari sebelum tanggal keberangkatan</p>
            </div>
        </div>
    </div>

    <div id="Modalkedua" class="cobamodal">
        <!-- Modal content -->
        <div class="cobamodal-content">
            <span class="close">&times;</span>
            <br><br>
            <div class="col-sm-1" style="font-size: 35px;">
                <i class="fa fa-exclamation-triangle fa-10x"  aria-hidden="true"></i>
            </div>
            <div class="col-sm-9" style="text-align: center; font-size:20px"> 
                <p>Tanggal Pulang tidak boleh kurang dari Tanggal Berangkat</p>
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
    var modalsatu = document.getElementById("Modalku");
    var modaldua    = document.getElementById("Modalkedua");
    var spans = document.getElementsByClassName("close")[0];
   

    function getCar(){
        var dates = $("#date_from").val();
        var today = new Date();   
        today.setHours(0,0,0,0);
        today.setDate(today.getDate() + 5);

        var batas = today.toISOString().substring(0, 10);

        if (dates > batas) { 
            modalsatu.style.display = "block";
            document.getElementById("simpan").disabled = true;      
        }else{
            document.getElementById("simpan").disabled = false;
        }
    }
        // When the user clicks anywhere outside of the cobamodal, close it
    window.onclick = function(event) {
            if (event.target == modalsatu) {
                modalsatu.style.display = "none";
            }

            if (event.target == modaldua) {
                modaldua.style.display = "none";
            }
    }

    //    When the user clicks on <span> (x), close the cobamodal
    spans.onclick = function() {
            modalsatu.style.display = "none";
            modaldua.style.display = "none";

            // if (event.target == modalsatu) {
            //     modalsatu.style.display = "none";
            // }

            // if (event.target == modaldua) {
            //     modaldua.style.display = "none";
            // }
    }

    function getLong(){
        var datedari    = $("#date_from").val();
        var datesampai   = $("#date_to").val();

        if(datedari > datesampai){
            modaldua.style.display = "block";
            document.getElementById("simpan").disabled = true;      
        }else{
            document.getElementById("simpan").disabled = false;  
        }
    }
</script>
@endsection