@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Rekapitulasi</li>
    <li>Laporan Arsip</li>
@endsection
@section('content')

<div class="row">
    <form method="post" action="{{Route('reportarchive.cetak')}}">

    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Laporan Arsip</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-6">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Jenis Laporan
                            </label>
                            <div class="col-sm-8">
                                <select name="jenis" id="jenis" class="col-xs-10 col-sm-10 select2">
                                    <option value="1">Daftar Arsip</option>
                                    <option value="2">Daftar Infomasi Arsip</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="tampilbulan">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Status
                            </label>
                            <div class="col-sm-8">
                                <input type="radio" name="status" value="aktif" checked id="aktif">
                                <label class="control-label no-padding-right" for="form-field-1"> Aktif</label> 
                                &nbsp;&nbsp;
                                <input type="radio" name="status" value="inaktif" id="inaktif">
                                <label class="control-label no-padding-right" for="form-field-1"> Inaktif</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="bidang">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1">Bidang
                            </label>
                            <div class="col-sm-8">
                                <select name="divisi" class="col-xs-10 col-sm-10 select2">
                                    <option value="">Semua Bidang</option>
                                    @foreach ($divisi as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tahun
                            </label>
                            <div class="col-sm-8" >
                                <select name="tahun" class="col-xs-10 col-sm-10">
                                    <?php
                                        $now=date('Y');
                                        for ($a=2022;$a<=$now;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        </fieldset>        
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right" id="tjawab">
            <div class="form-group col-xs-12 col-sm-3" style="float: left">
                <input type="submit" value="LIHAT" class="btn btn-primary">
            </div>
        </div>

    </div>
    </form>
</div>
@endsection

@section('footer')
@endsection
