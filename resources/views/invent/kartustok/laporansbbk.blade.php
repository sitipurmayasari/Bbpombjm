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
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Laporan Barang Keluar</b><br>
            </div><br>
            <div class="col-sm-12" style="text-align: left">
                Periode :
                    @php
                        if ($request->bulan=='1') {
                            $request->bulan = "Januari";
                        } else if($request->bulan=='2') {
                            $bulan = "Februari";
                        } else if($request->bulan=='3') {
                            $bulan = "Maret";
                        } else if($request->bulan=='4') {
                            $bulan = "April";
                        } else if($request->bulan=='5') {
                            $bulan = "Mei";
                        } else if($request->bulan=='6') {
                            $bulan = "Juni";
                        } else if($request->bulan=='7') {
                            $bulan = "Juli";
                        } else if($request->bulan=='8') {
                            $bulan = "Agustus";
                        } else if($request->bulan=='9') {
                            $bulan = "September";
                        } else if($request->bulan=='10') {
                            $bulan = "Oktober";
                        } else if($request->bulan=='11') {
                            $bulan = "November";
                        } else {
                            $bulan = "Desember";
                        }
                    @endphp
                   {{$bulan}}
                {{$request->years}}
            </div><br>
            <div class="col-sm-12 table-responsive row" style="text-align: left">
                <table id="simple-table" class="table  table-bordered" style="font-size: 11px;" >
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align:middle;" width="20px">No</th>
                            <th style="text-align: center; vertical-align:middle;">nomor</th>      
                            <th style="text-align: center; vertical-align:middle;">Tanggal Pengajuan</th>      
                            <th style="text-align: center; vertical-align:middle;">Nama Pengaju</th>
                            <th style="text-align: center; vertical-align:middle;">Bagian</th>
                            <th style="text-align: center; vertical-align:middle;">Daftar Barang</th>
                            <th style="text-align: center; vertical-align:middle;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                               <td style="text-align: center">{{$no}}</td>
                               <td>{{$item->nomor}}</td>
                               <td>{{$item->tanggal}}</td>
                               <td>{{$item->pegawai->name}}</td>
                               <td>{{$item->pegawai->divisi->nama}}</td>
                               <td>
                                    @foreach ($item->isi as $list)
                                        <li>{{$list->barang->nama_barang}}
                                            ({{$list->jumlah}} {{$list->barang->satuan->satuan}})
                                        </li>
                                    @endforeach
                               </td>
                               <td>
                                    @if ($item->labory_id != null)
                                        {{$item->labory->name}}
                                    @endif
                                </td>
                            </tr>
                            @php
                                $no++
                            @endphp
                        @endforeach 
                    </tbody>
                </table>
            </div><br><br>
        </div>
        @endsection