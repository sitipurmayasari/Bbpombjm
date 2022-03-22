@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pengumumann"> Pengumuman</a></li>
    <li>Buat Pengumuman</li>
@endsection
@section('content')
@include('layouts.validasi')

<style>

</style>


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/agenda/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Buat Agenda</h4>
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
                        for="form-field-1"> Judul
                        </label>
                        <div class="col-sm-9" >
                            <input type="text" name="titles" class="col-xs-10 col-sm-10" value="{{$data->titles}}"
                             placeholder="masukkan judul">
                             <input type="text" name="users_id" value="{{auth()->user()->id}}" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kategori
                        </label>
                        <div class="col-sm-9" >
                            <select name="agenda_kategori_id" class="col-xs-10 col-sm-10"  >
                                @foreach ($kategori as $item)
                                   @if ($item->id == $data->agenda_kategori_id)
                                        <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                   @else
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                   @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Dari
                        </label>
                        <div class="col-sm-9">
                            <input type="date" required  value="{{$data->date_from}}"
                            class="col-xs-3 col-sm-3 required "
                            name="date_from"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Sampai
                        </label>
                        <div class="col-sm-9">
                            <input type="date" required  value="{{$data->date_to}}"
                            class="col-xs-3 col-sm-3 required "
                            name="date_to"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan
                        </label>
                        <div class="col-sm-9" >
                            <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                            name="detail">{{$data->detail}}</textarea>
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
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js " referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: "textarea"
    });
</script>
@endsection