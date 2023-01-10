@extends('ppnpn/layouts.app')
@section('breadcrumb')
    <li>Absensi Pramubakti</li>
@endsection
@section('content')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/permit/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah Keterangan Absensi</h4>
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
                            <input type="text" name="name" class="col-xs-10 col-sm-10" value="{{$data->peg->name}}"
                             readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal
                        </label>
                        <div class="col-sm-9" >
                            <input type="text" class="col-xs-10 col-sm-10" value="{{tgl_indo($data->tanggal)}}"
                             readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Status
                        </label>
                        <div class="col-sm-9" >
                            <select name="ket_absen_id" class="col-xs-10 col-sm-10 select2" id="ket" onchange="getnilai()">
                                @foreach ($kets as $sub)
                                        @if ($data->ket_absen_id==$sub->id)
                                            <option value="{{$sub->id}}" selected>{{$sub->ket}}</option>
                                        @else
                                            <option value="{{$sub->id}}">{{$sub->ket}}</option>
                                        @endif
                                @endforeach
                            </select>
                            <input type="hidden" id="poin" value="{{$data->poin}}">
                            <input type="hidden" name="poin" id="poinbaru">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan
                        </label>
                        <div class="col-sm-9" >
                            <textarea name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Upload file
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="max 2KB" required>   
                            @if ($data->file != null)
                                <a href="{{$data->getFile()}}" target="_blank" >{{$data->file}}</a>
                            @else
                                *Max 2KB
                            @endif
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

    function getnilai(){
        var jenis = $("#ket").val();
        var poinlama = $("#poin").val();

        if (jenis == 2 || jenis == 3 || jenis == 3 || jenis == 13 || jenis == 14) {
            $("#poinbaru").val(0);  
        }else{
            $("#poinbaru").val(poinlama); 
        }

    }

</script>
@endsection