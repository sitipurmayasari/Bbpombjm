@extends('layouts.mon')
@section('breadcrumb')
    <li>RAPK</li>
    <li><a href="/finance/realRAPK">Realisasi Capaian</a></li>
    <li>Ubah MetaData</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
method="post" action="/finance/realRAPK/updatemeta/{{$data->id}}">
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Ubah MetaData Realisasi Capaian</h3></div>
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
                    for="form-field-1"> Perjanjian Kinerja
                    </label>
                    <div class="col-sm-8">
                        <select name="eselontwo_id" class="col-xs-10 col-sm-10 select2">
                           @foreach ($rapk as $item)
                               @if ($data->eselontwo_id==$item->id)
                                    <option value="{{$item->id}}" selected> Tahun {{$item->years}} 
                                        (dasar renstra : {{$item->renstrakal->filename}}-
                                        {{$item->renstrakal->yearfrom}}s/d{{$item->renstrakal->yearto}})</option>
                               @else
                                    <option value="{{$item->id}}"> Tahun {{$item->years}} 
                                        (dasar renstra : {{$item->renstrakal->filename}}-
                                        {{$item->renstrakal->yearfrom}}s/d{{$item->renstrakal->yearto}})</option>
                               @endif
                           @endforeach
                        </select>
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
                    for="form-field-1"> Periode Triwulan
                    </label>
                    <div class="col-sm-8">
                        <select name="triwulan" class="col-xs-10 col-sm-10 select2">
                            @if ($data->triwulan=="TWI")
                                <option value="TWI" selected>Triwulan I</option>
                                <option value="TWII">Triwulan II</option>
                                <option value="TWIII">Triwulan III</option>
                                <option value="TWIV">Triwulan IV</option>
                            @elseif ($data->triwulan=="TWII")
                                <option value="TWI" >Triwulan I</option>
                                <option value="TWII" selected>Triwulan II</option>
                                <option value="TWIII">Triwulan III</option>
                                <option value="TWIV">Triwulan IV</option>
                            @elseif ($data->triwulan=="TWIII")
                                <option value="TWI" >Triwulan I</option>
                                <option value="TWII" >Triwulan II</option>
                                <option value="TWIII" selected>Triwulan III</option>
                                <option value="TWIV">Triwulan IV</option>
                            @elseif ($data->triwulan=="TWIV")
                                <option value="TWI" >Triwulan I</option>
                                <option value="TWII" >Triwulan II</option>
                                <option value="TWIII">Triwulan III</option>
                                <option value="TWIV" selected>Triwulan IV</option>
                            @else
                                <option value="TWI">Triwulan I</option>
                                <option value="TWII">Triwulan II</option>
                                <option value="TWIII">Triwulan III</option>
                                <option value="TWIV">Triwulan IV</option>
                            @endif
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Pilih Pagu
                    </label>
                    <div class="col-sm-8">
                        <select name="pagu_id" class="col-xs-10 col-sm-10 select2">
                            <option value="">Pilih Pagu</option>
                            @foreach ($pagu as $item)
                                @if ($item->id==$data->pagu_id)
                                    <option value="{{$item->id}}" selected>{{$item->name}} ( {{tgl_indo($item->tgl_pagu)}} )</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->name}} ( {{tgl_indo($item->tgl_pagu)}} )</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" 
                    for="form-field-1"> Nama Dokumen
                    </label>
                    <div class="col-sm-8">
                        <input type="text" value="{{$data->filename}}"
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
                                @if ($item->id==$data->kapom_id)
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
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>UPDATE
            </button>
        </form>
            <a href="/finance/realRAPK/edit/{{$data->id}}" class="btn btn-sm">
                <i class="glyphicon glyphicon-arrow-right"> UPDATE PER TW</i>
            </a>
        </div>
    </div>
</div>
</form>

@endsection