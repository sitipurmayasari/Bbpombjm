@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.app')
@section('breadcrumb')
    <li>Persediaan</li>
    <li><a href="/invent/barangkeluar"> Barang keluar</a></li>
    <li>Data Barang Keluar</li>
@endsection
@section('content')
@include('layouts.validasi')
<style>
    th{
        text-align: center;
        vertical-align: middle;
    }
</style>
<form class="form-horizontal validate-form" role="form" 
         method="post" action="/invent/barangkeluar/update/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Persetujuan Permintaan Barang di Gudang
                    @if ($data->jenis == 'A')
                        ATK
                    @else
                        REAGEN
                    @endif
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Mengetahui</label><br>
                            <input type="text" value="{{$data->mengetahui->user->name}}" readonly class="col-xs-9 col-sm-9">
                            <input type="hidden" name="stat_aduan" value="S">
                        </div>
                        <div class="col-md-12">
                            <label>Pengaju</label><br>
                            <input type="text" value="{{$data->pegawai->name}}" readonly
                                class="col-xs-9 col-sm-9 required " />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>NO. SPB*</label><br>
                            <input type="text" id="nomor" readonly required
                            class="col-xs-9 col-sm-9 required " 
                            value="{{$data->nomor}}"
                            />
                        </div>
                        <div class="col-md-12">
                            <label>TANGGAL PENGAJUAN *</label><br>
                            <input type="text"  readonly name="entry_date"
                                class="col-xs-9 col-sm-9 required" value="{{$data->tanggal}}">
                            <input type="hidden"  name="today" id="" value="{{date('Y-m-d')}}">
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
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th rowspan="2" >No</th>
                                    <th colspan="2">Data Barang</th>
                                    <th colspan="3">Jumlah</th>
                                    <th rowspan="2" class="col-md-2">Keterangan</th>
                                    <th rowspan="2"  class="col-md-2">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="col-md-3">Nama Barang</th>
                                    <th  class=" col-md-1">Satuan</th>
                                    <th class=" col-md-1">Stok</th>
                                    <th class=" col-md-1">Pengajuan</th>
                                    <th class=" col-md-1">Disetujui</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($detail as $item)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>
                                        <input type="text" value="{{$item->barang->nama_barang}}" class="form-control" readonly>
                                        <input type="hidden" value="{{$item->inventaris_id}}" name="inventaris_id[]">
                                        <input type="hidden" name="stuff_id[]" value="{{$item->id}}">
                                    </td>
                                    <td>
                                        <input type=hidden name="satuan_id[]" class="form-control" id="satuan_id-{{$no}}" value="{{$item->satuan_id}}">
                                        <input type="text" class="form-control" readonly id="satuan-{{$no}}" value="{{$item->satuan->satuan}}">
                                    </td>
                                    <td>
                                        @php
                                            $stok = $injectQuery->getSTokBarang($item->inventaris_id)
                                        @endphp
                                        <input type="number" class="form-control" readonly value="{{$stok->stock}}" id="stok-{{$no}}">
                                    </td>
                                    <td>
                                        <input type="number" readonly name="jumlah_aju[]" id="jum_aju-{{$no}}" class="form-control" value="{{$item->jumlah_aju}}" >
                                    </td>
                                    <td>
                                        <input type="number"  min="0" max="{{$stok->stock}}" name="jumlah[]" class="form-control" value="{{$item->jumlah}}" id="jum-{{$no}}">
                                        @php
                                            $a = $stok->stock;
                                            $b = $item->jumlah_aju;
                                            $c = $a-$b;
                                        @endphp
                                        <input type="hidden" name="sisa[]" id="sisa-{{$no}}" value="{{$c}}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="ket[]" class="form-control" value="{{$item->ket}}" readonly>
                                    </td>
                                    <td>
                                        <select name="status[]" class="form-control" id="status-{{$no}}" onchange="hitung2({{$no}})" required>
                                            @if ($item->status=='Y')
                                                <option value="">Pilih Status</option>
                                                <option value="Y" selected> Disetujui</option>
                                                <option value="N"> Ditolak</option>
                                            @elseif($item->status=='N') 
                                                <option value="">Pilih Status</option>
                                                <option value="Y"> Disetujui</option>
                                                <option value="N" selected> Ditolak</option>
                                            @else
                                                <option value="">Pilih Status</option>
                                                <option value="Y"> Disetujui</option>
                                                <option value="N"> Ditolak</option>
                                            @endif
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
        {{-- <col> --}}
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
    function hitung2(i) {
        var x = $("#status-"+i).val();
        var a = $("#stok-"+i).val();
        var b = $("#jum_aju-"+i).val();

        if (x == "Y"){
            var c = a - b;
            $("#sisa-"+i).val(c);
            $("#jum-"+i).val(b);
        }else{
            $("#sisa-"+i).val(a);
            $("#jum-"+i).val(0);
        }   
    }
</script>
@endsection