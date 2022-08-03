@extends('layouts.lab')
@section('breadcrumb')
    <li>Persediaan Lab</li>
    <li><a href="/calibration/glasskuan">Alat Gelas Kuantitatif</a></li>
    <li>Update Stock</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Data Barang</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Barang
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="col-xs-9 col-sm-9 required " name="kode_barang" readonly 
                                value="{{$data->kode_barang}}"/>
                                <input type="text" name="inventaris_id" hidden value="{{$data->id}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Barang
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->nama_barang}}"
                                class="col-xs-9 col-sm-9 required " readonly name="nama_barang" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Sinonim
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->sinonim}}"
                                class="col-xs-9 col-sm-9 required " readonly name="sinonim" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> No. Katalog
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->no_seri}}"
                                class="col-xs-9 col-sm-9 required " readonly name="no_seri" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Merk/Type
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->merk}}"
                                class="col-xs-9 col-sm-9 required " readonly name="merk" />
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                        
                        
                    </div>
               </div>          
           </div>
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Daftar Stock</h3></div>
        <div class="panel-body">
           <div class="col-md-12">
            <table id="myTable" class="table table-bordered table-hover text-center">
                <thead>
                    <th width="40px">No</th>
                    <th>Tangal</th>
                    <th>Barang Masuk</th>
                    <th>Barang keluar</th>
                    <th>Sisa</th>
                    <th>Keterangan</th>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($stok as $key=>$row)
                    <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>{{$row->entry_date}}</td>
                        <td>{{$row->stockawal}}</td>
                        <td>{{$row->keluar}}</td>
                        <td>{{$row->stock}}</td>
                        <td>{{$row->keterangan}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           </div>
        </div>
    </div>
</div>
@endsection