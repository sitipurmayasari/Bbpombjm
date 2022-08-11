@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/inventaris"> BMN LAB</a></li>
    <li>Jadwal Maintenance</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
        method="post" action="{{route('inventaris.storejadwal')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Ubah BMN LAB</h4>
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
                            for="form-field-1"> Kode Barang
                            </label>
                            <div class="col-sm-8">
                                <input type="text" 
                                        class="col-xs-10 col-sm-10 required " 
                                        name="kode_barang" readonly 
                                        value="{{$data->kode_barang}}"/>
                                <input type="text" 
                                        name="inventaris_id" hidden 
                                        value="{{$data->id}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama barang
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->nama_barang}}"
                                        class="col-xs-10 col-sm-10 required " readonly
                                        name="nama_barang" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk/Type
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->merk}}" readonly
                                        class="col-xs-10 col-sm-10 required " 
                                        name="merk" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Maintenance
                            </label>
                            <div class="col-sm-8 date">
                                <input type="text" name="tanggal" readonly class="col-xs-10 col-sm-10" 
                                data-date-format="yyyy-mm-dd" data-provide="datepicker">
                            </div>
                        </div>
                        </fieldset>        
                    </div>
               </div>
        
        
        
            </div>
            <div class="col-sm-6">
                <br>
               <div class="table-responsive">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                            <th width="40px">No</th>
                            <th>Jadwal</th>
                            <th>Hapus</th>
                        <thead>
                        <tbody>   	
                            @php $no=1; @endphp
                            @foreach($jadwal as $key=>$row)
                            <tr>
                                <td align="center">{{$no++}}</td>
                                <td>{{$row->tanggal}}</td>
                                <td align="center">
                                    <a href="#" class="btn btn-danger delete"
                                        r-name="{{$row->tanggal}}" 
                                        r-id="{{$row->id}}">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        
                            @endforeach
                        <tbody>
                    </table>
               </div>
            </div>
        </div><!-- /.col -->
    
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