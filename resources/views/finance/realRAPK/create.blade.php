@extends('layouts.mon')
@section('breadcrumb')
    <li>RAPK</li>
    <li><a href="/finance/realRAPK">Realisasi Capaian</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
method="post" action="{{route('realRAPK.generate')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Tambah Realisasi Capaian</h3></div>
       <div class="panel-body">
           <div class="col-md-12">
               <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1">Tanggal
                    </label>
                    <div class="col-sm-8">
                        <input type="date" id="dates" value="{{date('Y-m-d')}}"
                                class="col-xs-3 col-sm-3 " 
                                name="dates"/>
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Periode Tahun
                    </label>
                    <div class="col-sm-8">
                        <select name="years" class="col-xs-10 col-sm-10 select2">
                            <option value="">Pilih Tahun</option>
                            <?php
                                $a=date('Y');
                                $pus = $a+4;
                                for ($a=date('Y');$a<=$pus;$a++)
                                {
                                    echo "<option value='$a'>$a</option>";
                                }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Periode Triwulan
                    </label>
                    <div class="col-sm-8">
                        <select name="triwulan" class="col-xs-10 col-sm-10 select2">
                            <option value="TWI">Triwulan I</option>
                            <option value="TWII">Triwulan II</option>
                            <option value="TWIII">Triwulan III</option>
                            <option value="TWIV">Triwulan IV</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Nama Dokumen
                    </label>
                    <div class="col-sm-8">
                        <input type="text" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="filename" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Pejabat
                    </label>
                    <div class="col-sm-8">
                        <select name="users_id" class="col-xs-10 col-sm-10 required select2" required >
                             <option value="">Pilih Pejabat</option>
                             @foreach ($user as $item)
                                 <option value="{{$item->id}}">{{$item->name}} ({{$item->no_pegawai}})</option>
                             @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Kepala POM
                    </label>
                    <div class="col-sm-8">
                        <select name="kapom_id" class="col-xs-10 col-sm-10 required select2" required >
                             <option value="">Pilih Pejabat</option>
                             @foreach ($kapom as $item)
                                 <option value="{{$item->id}}">{{$item->name}} ({{$item->no_pegawai}})</option>
                             @endforeach
                        </select>
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