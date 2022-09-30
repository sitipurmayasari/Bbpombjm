@extends('layouts.din')
@section('breadcrumb')
    <li>Kuitansi</li>
    <li><a href="/finance/receipt">Biaya Perjalanan Dinas</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('receipt.generate')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Biaya Perjalanan Dinas</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">    
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1">Tanggal Kuitansi
                            </label>
                            <div class="col-sm-8">
                                <input type="date" required id="date" value="{{date('Y-m-d')}}"
                                        class="col-xs-3 col-sm-3 required " 
                                        name="date"/>
                                <input type="hidden" name="jenis" value="B">
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
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Generate
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
   <script>
        function getMaksud(i){
            var id = $("#outstation_id").val();

            $.get(
                "{{route('receipt.getMaksud') }}",
            {
                id:id
            },
            function(response) {
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
            }
        );
        }
   </script>
@endsection