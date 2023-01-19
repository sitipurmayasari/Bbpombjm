@extends('layouts.ren')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/renta">Rencana Target Tahunan</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
method="post" action="{{route('renta.generate')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Tambah Renstra Balai</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Jenis Renstra
                        </label>
                        <div class="col-sm-8">
                            <select name="renstrakal_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih renstra</option>
                                @foreach ($rens as $item)
                                    <option value="{{$item->id}}">{{$item->filename}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">pilih Tahun
                        </label>
                        <div class="col-sm-8">
                            <select name="years" class="col-xs-10 col-sm-10" required>
                                <?php
                                    $now=date('Y')+5;
                                    for ($a=2023;$a<=$now;$a++)
                                    {
                                        echo "<option value='$a'>$a</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Keterangan
                        </label>
                        <div class="col-sm-8">
                            <input type="text" name="ket" class="col-xs-10 col-sm-10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Generate
        </button>
    </div>
</div>
</form>
@endsection

@section('footer')
    
@endsection