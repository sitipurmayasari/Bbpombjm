@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
<li>Pegawai</li>
<li>Absen Tanda Tangan</li>

@endsection
@section('content')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('ttdabsen.store')}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Absen Tanda Tangan</h4>
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
                        for="form-field-1"> Jenis TTD
                            </label>
                            <div class="col-sm-8">
                                <select name="jenis" id="jenis" class="col-xs-10 col-sm-10 select2" onchange="myFunction()">
                                    <option value="1">Semua</option>
                                    <option value="3">Per Substansi</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Pilih Status
                        </label>
                        <div class="col-sm-8">
                            <select name="status" id="status" class="col-xs-10 col-sm-10 select2" >
                                <option value="1">Semua</option>
                                <option value="PNS">Hanya PNS</option>
                                <option value="PPNPN">Hanya PPNPN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="substansi">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Substansi
                            </label>
                            <div class="col-sm-8">
                                <select name="divisi" class="col-xs-10 col-sm-10 required select2">
                                    <option value="">Pilih Substansi</option>
                                    @foreach ($divisi as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Kegiatan
                        </label>

                        <div class="col-sm-8">
                            <input type="text"  placeholder="Nama Kegiatan" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="kegiatan" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Kegiatan
                        </label>
                        <div class="col-sm-2">
                            <input type="date"  
                                    class="col-xs-10 col-sm-10 required " 
                                    name="tanggal" required />
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
                <i class="ace-icon fa fa-check bigger-110"></i>PROSES
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
<script>
     $(document).ready(function(){
        $("#substansi").hide();
    });

    function myFunction() {
        var v = $("#jenis").val();
        if (v=="3") {
            $("#substansi").show();
        }else{
            $("#substansi").hide();
        }
      
    }
</script>
@endsection