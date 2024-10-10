@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pelatihan"> Kompetensi Pegawai</a></li>
    <li>Evaluasi Hasil Pelatihan</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/pelatihan/updverif/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Evaluasi Hasil Pelatihan</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <br>
            <div class="widget-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Kegiatan
                        </label>
                        <div class="col-sm-10">
                            <input type="hidden" name="users_id" value="{{$data->users_id}}">
                            <input type="text"  placeholder="Nama kegiatan" class="col-xs-10 col-sm-10 required " readonly
                                    name="nama" required value="{{$data->nama}}"/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penyelenggara
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="nama penyelenggara" class="col-xs-10 col-sm-10 required " 
                                    name="penyelenggara" required value="{{$data->penyelenggara}}" readonly/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Mulai
                        </label>
                        <div class="col-sm-10">
                            <input type="date"  class="col-xs-2 col-sm-2 required " readonly
                                    name="dari" required value="{{$data->dari}}"/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Selesai
                        </label>
                        <div class="col-sm-10">
                            <input type="date"  class="col-xs-2 col-sm-2 required " readonly
                            name="sampai" required value="{{$data->sampai}}"/>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Lama Pelatihan
                        </label>
                        <div class="col-sm-10">
                            <input type="number"  placeholder="0" class="col-xs-1 col-sm-1 required " readonly
                                    name="lama" required min="0" value="{{$data->lama}}"/>&nbsp;
                                    <label class="control-label" 
                                    for="form-field-1"> Jam
                                    </label>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Evaluator
                        </label>
                        <div class="col-sm-10">
                            <input type="radio" value="N" name="ketua" onclick="respe();" id="kepala"> &nbsp; <b>Kepala Balai</b> &nbsp;
                            <input type="radio" value="Y" name="ketua" onclick="respe();" id="reset"/> &nbsp; <b>Ketua Tim</b> &nbsp;
                            <div id="ketua">
                                <select name="evaluator_id"  class="col-xs-10 col-sm-10 select2" onchange="getjab();" id="katim">
                                    <option value="">Pilih Pejabat</option>
                                    @foreach ($tim as $item)
                                        <option value="{{$item->peg->id}}">{{$item->peg->name}} ({{$item->detail}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="jabasn_id" value="" id="jabatan">
                            {{-- <input type="hidden" name="admin" value="false"> --}}
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
    </div><!-- /.col -->
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>
    
@endsection

@section('footer')
   <script>
        $().ready( function () {
            $("#ketua").hide();
        } );

       function respe(){
        if (document.getElementById('reset').checked) 
            {
                $("#ketua").show();
            }
        if (document.getElementById('kepala').checked) 
            {
                $("#ketua").hide();
            }
        }


        function getjab(){
            var users_id = $("#katim").val();

            $.get(
            "{{route('pelatihan.getjabatan') }}",
            {
                users_id: users_id
            },
            function(response) {
                $("#jabatan").val(response.data.jabasn_id);
            });
        }

   </script>
@endsection