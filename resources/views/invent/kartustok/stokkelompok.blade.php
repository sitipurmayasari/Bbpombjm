@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.app')
@section('breadcrumb')
    <div>
        <button type="button" class="btn btn-primary no-border btn-sm noPrint" 
            id="PrintPage" onclick="window.print();">
            <i class="ace-icon fa fa-print icon-on-right bigger-110"></i> &nbsp; cetak
        </button>
    </div>
    
@endsection
@section('content')
    <div>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </div>
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Sisa Stok</b><br>
                <b><i>{{$data->nama}}</i></b>
            </div><br>
            <div class="col-sm-12 table-responsive row" style="text-align: left">
                <table id="simple-table" class="table  table-bordered" style="font-size: 11px;" >
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align:middle;" width="20px">No</th>
                            <th style="text-align: center; vertical-align:middle;">Kode Barang</th>
                            <th style="text-align: center; vertical-align:middle;">Nama Barang</th>
                            <th style="text-align: center; vertical-align:middle;">Lokasi</th>
                            <th style="text-align: center; vertical-align:middle;">Sisa Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($stock as $item)
                            <tr>
                                <td style="text-align: center">{{$no++}}</td>
                                <td>{{$item->kode_barang}}</td>
                                <td>{{$item->nama_barang}} ({{$item->merk}})</td>
                                <td>{{$item->location->nama}}</td>
                                <td style="text-align: center">{{$item->stok}}  {{$item->satuan->satuan}}</td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div><br><br>
        </div>
@endsection