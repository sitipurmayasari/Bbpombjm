@extends('layouts.ren')
@section('breadcrumb')
<li>Rencana Strategi</a></li>
<li>Laporan</li>

@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('renstrapot.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Laporan Rencana Strategi</h4>
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
                            for="form-field-1"> Renstra
                            </label>
                            <div class="col-sm-10">
                                <input type="radio" required value="N" name="jenis" id="N" checked/> &nbsp; Nasional  &nbsp;
                                <input type="radio" required value="B" name="jenis" id="B"/> &nbsp; Balai
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="nas">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Laporan
                            </label>
                            <div class="col-sm-10">
                                <select id="bulan" name="renstranas_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Laporan Nasional</option>
                                    @foreach ($nas as $item)
                                    <option value="{{$item->id}}">{{$item->filename}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="balai">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Laporan
                            </label>
                            <div class="col-sm-10">
                                <select id="bulan" name="renstrakal_id" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Laporan Balai</option>
                                    @foreach ($balai as $item)
                                        <option value="{{$item->id}}">{{$item->filename}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        </fieldset>        
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <div class="form-group col-xs-12 col-sm-3" style="float: left">
                <input type="submit" value="CETAK" class="btn btn-primary">
            </div>
        </div>

    </div>
    </form>
</div>

@endsection

@section('footer') 
<script>
     $(document).ready(function(){
        $("#balai").hide();

        $("#N").click(function(){
            $("#nas").show();
            $("#balai").hide();
        });

        $("#B").click(function(){
            $("#nas").hide();
            $("#balai").show();
        });
    });
</script>
@endsection