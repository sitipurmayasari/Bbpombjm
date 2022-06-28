@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/disposable"> Inventaris Aset Sekali Pakai</a></li>
    <li>Update Stock</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="{{route('disposable.storestock')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Input Stock</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                    <div class="col-md-6">
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
                            for="form-field-1"> Merk/Type
                            </label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$data->merk}}"
                                class="col-xs-9 col-sm-9 required " readonly name="merk" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Input
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="entry_date" readonly class="col-xs-5 col-sm-5"  value="{{date('Y-m-d')}}"
                                data-date-format="yyyy-mm-dd"  data-provide="datepicker" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Expired 
                            </label>
                            <div class="col-sm-8">
                                <input type="date" name="exp_date" readonly class="col-xs-5 col-sm-5" 
                                data-date-format="yyyy-mm-dd"  data-provide="datepicker" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Harga Satuan
                            </label>
                            <div class="col-sm-8">
                                <input type="number" value="0"
                                class="col-xs-9 col-sm-9 required " min="0" name="harga" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" 
                            for="form-field-1">Stok Akhir
                            </label>
                            <div class="col-sm-8">
                                @php
                                    if ($sisa != null) {
                                        $isi = $sisa->stock;
                                    } else {
                                       $isi = 0;
                                    }
                                @endphp
                                <input type="text" class="col-xs-2 col-sm-2" id="sisa" value="{{$isi}}" readonly> &nbsp;&nbsp;
                                <label>{{$data->satuan->satuan}}</label> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" 
                            for="form-field-1"> Barang Masuk
                            </label>
                            <div class="col-sm-8">
                                <input type="number" name="stockawal" class="col-xs-2 col-sm-2" required value="0"  id="stok"  onkeyup="hitung()" onclick="hitung()">&nbsp;&nbsp;
                                <label>{{$data->satuan->satuan}}</label> 
                                <input type="hidden" name="keluar" class="col-xs-2 col-sm-2" 
                                required value="0"  id="keluar"  onkeyup="hitung()" onclick="hitung()">&nbsp;&nbsp;
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" 
                            for="form-field-1"> Sisa Stok
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="stock" class="col-xs-2 col-sm-2" id="awal" readonly>&nbsp;&nbsp;
                                <label>{{$data->satuan->satuan}}</label> 
                            </div>
                        </div>
                        
                    </div>
               </div>          
           </div>
        </div>
    </div>
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Simpan
        </button>
    </div>
    </form>
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
                    <th>Exp Date</th>
                    <th>Harga Satuan</th>
                    <th>Aksi</th>
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
                        <td>{{$row->exp_date}}</td>
                        <td>{{$row->harga}}</td>
                        <td><a href="/invent/disposable/ubahstok/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script>
         function hitung() {
            var a = $("#stok").val();
            var b = $("#sisa").val();
            var c = parseFloat(a) +  parseFloat(b);
            $("#awal").val(c);
        }
    </script>
@endsection