@extends('layouts.app')
@section('breadcrumb')
    <li>Persetujuan</li>
    <li><a href="/invent/planlab/daftar">Daftar Perencanaan Pengadaan Laboratorium</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')
<form class="form-horizontal validate-form" role="form" 
    method="post" action="/invent/planlab/update/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Daftar Perencanaan Pengadaan Laboratorium</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <label>NO. PENGAJUAN*</label><br>
                                <input type="text" id="no_adu" readonly class="col-xs-9 col-sm-9 required " 
                                 value="{{$data->no_ajuan}}" />
                            </div>
                            <div class="col-md-12">
                                <label>Asal Lab *</label><br>
                                <input type="text" readonly class="col-xs-9 col-sm-9 required " 
                                value="{{$data->lab->name}}" />
                                <input type="hidden" readonly value="{{$data->labory_id}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12">
                                <label>TANGGAL AJUAN *</label><br>
                                <input type="text" readonly 
                                            class="col-xs-9 col-sm-9 " value="{{$data->tgl_ajuan}}">
                            </div>
                            <div class="col-md-12">
                                <label> Tahun Ajuan *</label><br>
                                <input type="text" readonly 
                                            class="col-xs-9 col-sm-9 " value="{{$data->years}}">
                               <input type="hidden" readonly name="status" value="Y" />
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

                        <table id="myTable" class="table table-bordered table-hover text-center">
                            <thead>
                                <th>No</th>
                                <th class="text-center col-md-3">Nama Barang</th>
                                <th class="text-center col-md-2">No_Katalog</th>
                                <th class="text-center col-md-1">Kemasan</th>
                                <th class="text-center col-md-1">Satuan</th>
                                <th class="text-center col-md-1">Jumlah</th>
                                <th class="text-center col-md-2">Foto Barang</th>
                                <th>Proses</th>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                               @foreach ($detail as $item)
                               <tr id="cell-{{$no}}">
                                    <td>
                                        {{$no}}
                                    </td>       
                                    <td> 
                                        <input type="hidden" name="plandet_id[]" value="{{$item->id}}">
                                        <input type="text" name="names[]" class="form-control required" readonly value="{{$item->names}}">
                                    </td>
                                    <td>
                                        <input type="text" name="katalog[]" class="form-control required" readonly value="{{$item->katalog}}">
                                    </td>
                                    <td>
                                        <input type="text" name="kemasan[]" class="form-control required" readonly value="{{$item->kemasan}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" readonly value="{{ $item->satuan->satuan}}">
                                        <input type="hidden" name="satuan_id[]" value="{{$item->satuan_id}}">
                                    </td>
                                    <td>
                                        <input type="number" name="jumlah[]" min="0" class="form-control" value="{{$item->jumlah}}" required>
                                    </td>
                                    <td>  
                                        <img src="{{$item->getFoto()}}"  style="width:100px">
                                        <br>
                                    </td>
                                    <td>
                                        <select name="setuju[]" class="form-control" required>
                                            <option value="Y">Disetuju</option>
                                            <option value="N">Ditolak</option>
                                        </select>
                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                               @endforeach
                            </tbody>  
                        </table>
                    
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