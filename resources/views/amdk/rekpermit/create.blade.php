@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/permit"> Surat Izin</a></li>
    <li>Buat Surat Izin</li>
@endsection
@section('content')

<style>

</style>


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('agenda.store')}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Buat Surat Izin</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body col-sm-10">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama
                        </label>
                        <div class="col-sm-9" >
                            <input type="text" value="{{auth()->user()->name}}" readonly
                                class="col-xs-10 col-sm-10 required " 
                                name="users_name"/>  
                             <input type="text" name="users_id" value="{{auth()->user()->id}}" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kategori
                        </label>
                        <div class="col-sm-9" >
                            <select name="agenda_kategori_id" class="col-xs-10 col-sm-10"  >
                                <option value="S">Sakit</option>
                                <option value="I">Izin</option>
                                <option value="M">Menikah</option>
                                <option value="L">Melahirkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Dari
                        </label>
                        <div class="col-sm-9">
                            <input type="date" required  value="{{date('Y-m-d')}}"
                            class="col-xs-3 col-sm-3 required "
                            name="date_from"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Sampai
                        </label>
                        <div class="col-sm-9">
                            <input type="date" required  value="{{date('Y-m-d')}}"
                            class="col-xs-3 col-sm-3 required "
                            name="date_to"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan
                        </label>
                        <div class="col-sm-9" >
                            <textarea  placeholder="" class="col-xs-10 col-sm-10 required" required  
                            name="detail"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Upload Bukti*
                        </label>
                        <div class="col-sm-8">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><i>*Jika ada</i></label>
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
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>

@endsection