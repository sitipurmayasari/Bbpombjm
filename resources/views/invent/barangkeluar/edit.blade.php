@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
    <li><a href="/invent/barangkeluar"> Barang keluar</a></li>
    <li>Data Barang Keluar</li>
@endsection
@section('content')
@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="/invent/barangkeluar/update/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>UNIT KERJA</label><br>
                            <label><b>Balai besar Pengawas Obat dan Makanan di Banjarmasin</b></label>
                        </div>
                        <div class="col-md-12">
                            <label>NO. SPB*</label><br>
                            <input type="text" id="nomor" readonly 
                            class="col-xs-9 col-sm-9  " name="nomor" value="{{$data->nomor}}"
                            />
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="col-md-12">
                            <label>TANGGAL KELUAR *</label><br>
                            <input type="text" name="tanggal" readonly 
                                class="col-xs-9 col-sm-9 " value="{{tgl_indo($data->tanggal)}}">
                        </div>
                        <div class="col-md-12">
                            <label> Penerima *</label><br>
                            <input type="text" name="penerima" readonly 
                                class="col-xs-9 col-sm-9" value="{{$data->pegawai->name}}">
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
                        <th class="text-center col-md-1">Jumlah</th>
                        <th class="text-center col-md-4">Keterangan</th>
                        <th class="text-center" >Status</th>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->barang->nama_barang}} ({{$item->barang->merk}})</td>
                                <td>{{$item->satuan->satuan}} ({{$item->satuan->satuan}})</td>
                                <td>{{$item->jumlah}}</td>
                                <td>{{$item->ket}}</td>
                                <td>
                                    @if ($item->status != 'Y')
                                        Ditolak
                                    @else
                                        Disetujui
                                    @endif
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
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Upload file</h3></div>
            <div class="panel-body">
                <div class="col-sm-8">
                    <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                    <label><i>ex:Lorem_ipsum.pdf</i></label>
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
