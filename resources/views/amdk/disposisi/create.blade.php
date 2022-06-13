@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/pengumuman"> Pengumuman</a></li>
    <li>Buat Pengumuman</li>
@endsection
@section('content')

<style>

</style>


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('pengumuman.store')}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Buat Pengumuman</h4>
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
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Judul
                        </label>
                        <div class="col-sm-9" >
                            <input type="text" name="judul" class="col-xs-10 col-sm-10" 
                             placeholder="masukkan judul">
                             <input type="text" name="users_id" value="{{auth()->user()->id}}" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Dari
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="dari" readonly class="col-xs-10 col-sm-10" 
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Sampai
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="sampai" readonly class="col-xs-10 col-sm-10" 
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal">
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>


        </div>
        <div class="form-group col-sm-12" style="text-align:center;">
            <h3>Isi Pengumuman</h3>
              <form method="post">
                <textarea class="col-xs-12 col-sm-12" name="isi"></textarea>
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

@section('footer')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js " referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: "textarea"
    });
</script>
@endsection