@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pelatihan"> Kompetensi Pegawai</a></li>
    <li>Cetak Rekapitulasi</li>
@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('pelatihan.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Cetak Rekapitulasi Kompetensi Pegawai</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body col-sm-8">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-9" >
                            <input type="hidden" name="peg" value="2" id="per">
                            <input type="hidden" name="user" value="{{auth()->user()->id}}">
                        </div>
                    </div>
                    <div class="form-group"  id="a">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal Mulai
                        </label>
                        <div class="col-sm-9">
                            <input type="date" name="awal" class="col-xs-5 col-sm-5" required/>
                        </div>
                    </div>
                    <div class="form-group"  id="b">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal Mulai
                        </label>
                        <div class="col-sm-9">
                            <input type="date" name="akhir" class="col-xs-5 col-sm-5" required/>
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-warning btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>CETAK
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
<script>
    $(document).ready(function(){
    });
</script>
@endsection