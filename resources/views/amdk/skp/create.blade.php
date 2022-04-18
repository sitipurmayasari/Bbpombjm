@extends('layouts.app')
@section('breadcrumb')
    <li>skp</li>
    <li><a href="/amdk/skp"> Input skp</a></li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('skp.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Nama*</label><br>
                            <input type="text" readonly required class="col-xs-9 col-sm-9 required " 
                            name="users_name" value="{{auth()->user()->name}}"/>
                            <input type="hidden" name="users_id" value="{{auth()->user()->id}}"/>
                        </div>
                        <div class="col-md-12">
                            <label> Kelompok Barang *</label><br>
                            <select id="peg" name="jenis_barang_id" class="col-xs-9 col-sm-9 select2" required>
                                    {{-- @foreach ($kelompok as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach --}}
                            </select>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Tanggal *</label><br>
                            <input type="text" name="dates" readonly 
                                        class="col-xs-9 col-sm-9 " value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-md-12">
                            <label> Pejabat Penilai *</label><br>
                            <select id="peg" name="pejabat_id" class="col-xs-9 col-sm-9 select2" required>
                                <option value="">pilih nama Pejabat</option>
                                @foreach ($tahu as $lok)
                                    <option value="{{$lok->id}}">{{$lok->user->name}} ({{$lok->jabatan->jabatan}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
               </div>          
           </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Barang yang di Ajukan</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover text-center">
                    <thead>
                        <th class="text-center col-md-1">No</th>
                        <th class="text-center col-md-4">Nama Barang</th>
                        <th class="text-center col-md-3">Spesifikasi</th>
                        <th class="text-center col-md-2">Satuan</th>
                        <th class="text-center col-md-1">Jumlah</th>
                        <th class="text-center col-md-3">Keperluan</th>
                        <th class="text-center col-md-1">Aksi</th>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td class=>
                                1
                            </td>       
                            <td>
                                <input type="text" name="nama_barang[]" class="form-control">
                            </td>
                            <td>
                                <textarea name="spek[]" class="form-control"></textarea>
                            </td>
                            <td>
                                <select name="satuan_id[]" class="col-xs-9 col-sm-9 select2" required>
                                    {{-- @foreach ($satuan as $brg)
                                        <option value="{{$brg->id}}">{{$brg->satuan}}</option>
                                    @endforeach --}}
                                </select>
                            </td>
                            <td>
                                <input type="number" name="jumlah[]" class="form-control" value="0">
                            </td>
                            <td>
                                <input type="text" name="keperluan[]" class="form-control" style="width:200px;">
                            </td>
                            <td>
                            </td>
                        </tr>
                        <span id="row-new"></span>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                <input type="hidden" id="countRow" value="1">
                            </td>
                        </tr>
                        
                    </tfoot>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>Simpan
        </button>
    </div>
</div>
</form>

@endsection
@section('footer')
   <script>
    

   </script>
@endsection
