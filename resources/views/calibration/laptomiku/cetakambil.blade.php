@extends('layouts.tomi')
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
                <b>Rekapitulasi Pengambilan Mikroba Baku</b>
            </div><br>
            <div class="col-sm-12 table-responsive row" style="text-align: left">
                Periode :
                @if ($request->bulan!="1")
                @php
                    $bln = $request->daftarbulan;

                        if ($bln==1) {
                        $blnindo = "Januari";
                        } else  if ($bln==2){
                            $blnindo = "Februari";
                        } else  if ($bln==3){
                            $blnindo = "Maret";
                        } else  if ($bln==4){
                            $blnindo = "April";
                        } else  if ($bln==5){
                            $blnindo = "Mei";
                        } else  if ($bln==6){
                            $blnindo = "Juni";
                        } else  if ($bln==7){
                            $blnindo = "Juli";
                        } else  if ($bln==8){
                            $blnindo = "Agustus";
                        } else  if ($bln==9){
                            $blnindo = "September";
                        } else  if ($bln==10){
                            $blnindo = "Oktober";
                        } else  if ($bln==11){
                            $blnindo = "November";
                        } else {
                            $blnindo = "Desember";
                        }
                @endphp
                {{$blnindo}}
                @endif 
                    {{$request->daftartahun}}
                <br>
                <br>
                <table id="simple-table" class="table  table-bordered" style="font-size: 11px;" >
                    <thead style="text-align: center">
                        <tr>
                           <th width="20px" style="vertical-align: middle;">No</th>
                           <th style="vertical-align: middle;">Tanggal</th>
                           <th style="vertical-align: middle;">Nama Petugas</th>
                           <th style="vertical-align: middle;">Bakteri</th>
                        </tr>
                    <thead>
                    <tbody>   	
                       @php $no=1;  @endphp
                       @foreach($data as $key=>$row)
                       <tr>
                           <td style="text-align: center">{{$no++}}</td>
                           <td>{{tgl_indo($row->dates)}}</td>
                           <td>{{$row->peg->name}}</td>
                           <td>{{$row->baku->name}}</td>   
                       </tr>
                       @endforeach
                    <tbody>
                </table>
            </div><br><br>
        </div>
        <br>
        
@endsection