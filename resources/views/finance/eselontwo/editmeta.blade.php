@extends('layouts.ren')
@section('breadcrumb')
    <li>Perjanjian Kinerja</li>
    <li><a href="/finance/eselontwo">PK Eselon II</a></li>
    <li>UBAH METADATA</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
method="post" action="/finance/eselontwo/updatemeta/{{$data->id}}">
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Ubah MetaData PK Eselon II</h3></div>
       <div class="panel-body">
           <div class="col-md-12">
               <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1">Tanggal
                    </label>
                    <div class="col-sm-8">
                        <input type="date" id="dates" value="{{$data->dates}}"
                                class="col-xs-3 col-sm-3 " 
                                name="dates"/>
                    </div>
                </div>
               <div class="form-group">
                   <label class="col-sm-2 control-label no-padding-right" 
                   for="form-field-1"> Dasar Renstra
                   </label>
                   <div class="col-sm-8">
                    <input type="hidden" name="renstrakal_id" value="{{$data->renstrakal_id}}">
                    <input type="text" class="col-xs-10 col-sm-10" value="{{$data->renstrakal->filename}} ({{$data->renstrakal->yearfrom}}-{{$data->renstrakal->yearto}})" readonly>
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
                                $a=2020;
                                $pus = $a+20;
                                for ($a=2020;$a<=$pus;$a++)
                                {
                                   if ($a==$data->years) {
                                        echo "<option value='$a' selected>$a</option>";
                                   } else {
                                        echo "<option value='$a'>$a</option>";
                                   }
                                   
                                }
                            ?>
                        </select>
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
                                 @if ($item->id==$data->users_id)
                                 <option value="{{$item->id}}" selected>{{$item->name}} ({{$item->no_pegawai}})</option>
                                 @else
                                 <option value="{{$item->id}}">{{$item->name}} ({{$item->no_pegawai}})</option>
                                 @endif
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
                                @if ($item->id == $data->kapom_id)
                                <option value="{{$item->id}}" selected>{{$item->name}} ({{$item->no_pegawai}})</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}} ({{$item->no_pegawai}})</option>
                                @endif
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
            <i class="ace-icon fa fa-check bigger-110"></i>UPDATE
        </button>
    </form>
        <a href="/finance/eselontwo/edit/{{$data->id}}" class="btn btn-sm">
            <i class="glyphicon glyphicon-arrow-right"> UPDATE DATA PER TAHUN</i>
        </a>
    </div>
</div>


@endsection