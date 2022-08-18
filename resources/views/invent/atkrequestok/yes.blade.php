@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.app')
@section('breadcrumb')
    <li>Persetujuan</li>
    <li><a href="/invent/atkrequestok"> DPB Lab</a></li>
    <li>persetujuan Persediaan LAB</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
    method="post" action="/invent/atkrequestok/update/{{$data->id}}">
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Pengaju</label><br>
                            <input type="text" value="{{$data->pegawai->name}}" readonly
                                class="col-xs-9 col-sm-9 required " />
                            
                        </div>
                        <div class="col-md-12">
                            <label>Status</label><br>
                            <select name="stat_aduan" class="col-xs-9 col-sm-9" required>
                                @if ($data->stat_aduan == "B")
                                    <option value="B" selected>Belum Diproses</option>
                                    <option value="S">Telah Diproses</option>
                                @endif
                            </select>  
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
                            <input type="text"readonly  name="entry_date"
                                class="col-xs-9 col-sm-9 required" value="{{tgl_indo($data->tanggal)}}">
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
                        <th class="text-center col-md-3">Nama Barang</th>
                        <th class="text-center col-md-2">Satuan</th>
                        <th class="text-center col-md-1">Stok</th>
                        <th class="text-center col-md-1">Jumlah</th>
                        <th class="text-center col-md-3">Keterangan</th>
                        <th class="text-center col-md-2">Aksi</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                           
                        @endphp
                        @foreach ($ajuan as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>
                                    <input type="text" value="{{$item->barang->nama_barang}}" class="form-control" readonly>
                                    <input type="hidden" value="{{$item->inventaris_id}}" name="inventaris_id[]">
                                </td>
                                <td>
                                    <input type=hidden name="satuan_id[]" value="{{$item->satuan_id}}">
                                    <input type="text" name="satuan[]" class="form-control" readonly value="{{$item->satuan->satuan}}">
                                </td>
                                <td>
                                    @php
                                         $stok = $injectQuery->getSTokBarang($item->inventaris_id)
                                    @endphp
                                    <input type="number" name="stok[]" class="form-control" readonly value="{{$stok->stock}}" id="stok-{{$no}}">
                                </td>
                                <td>
                                    <input type="number"  min="1"  name="jumlah[]" class="form-control" value={{$item->jumlah}} id="minta-{{$no}}">
                                    <input type="hidden" name="stock[]" class="form-control" value="0" id="sisa-{{$no}}">
                                </td>
                                <td>
                                    <input type="text" name="ket[]" class="form-control" value="{{$item->ket}}" readonly>
                                </td>
                                <td>
                                    <select name="status[]" class="form-control" id="status-{{$no}}" onchange="hitung({{$no}})" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Y"> Disetujui</option>
                                        <option value="N"> Ditolak</option>
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
    function hitung(i) {
        var x = $("#status-"+i).val();
        var a = $("#stok-"+i).val();
        var b = $("#minta-"+i).val();

        if (x == "Y"){
            var c = a - b;
            $("#sisa-"+i).val(c);
        }else{
            $("#sisa-"+i).val(a);
        }    
    }
</script>
@endsection
