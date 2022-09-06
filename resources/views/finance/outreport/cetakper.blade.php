@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.din')
@section('breadcrumb')
    <div>
        <button type="button" class="btn btn-primary no-border btn-sm noPrint" 
            id="PrintPage" onclick="window.print();">
            <i class="ace-icon fa fa-print icon-on-right bigger-110"></i> &nbsp; cetak
        </button>
    </div>
    <style>
        .ttd{
                border:none;
                border-collapse: collapse;
                text-align: center;
            }
    
    </style>
@endsection
@section('content')
    <div>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </div>
    <div class="col-sm-12 isi" style="text-align: center">
        <div style="align=center font-size: 20px">
            <b>Rekapitulasi Surat Tugas</b>
        </div>
        <br>
     </div>
     <div class="isi" style="font-size: 12px">
        <table class="judul">
            <tr class="judul">
                <td class="judul"> Nama</td>
                <td class="judul"> : {{$pegawai->name}}</td>
            </tr>
            <tr class="judul">
                <td class="judul"> NIP</td>
                <td class="judul"> : 
                    @if ($pegawai->status=='PNS')
                        {{$pegawai->no_pegawai}}
                    @else
                        {{ '-' }}
                    @endif
                </td>
            </tr>
            <tr class="judul">
                <td class="judul">Periode</td>
                <td class="judul">:
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
                    @if ($request->tahun!="1")
                        {{$request->daftartahun}}
                    @endif
                </td>
            </tr>
        </table>
        <br>
    </div>
    <div class="table-responsive isi">
        <table id="simple-table" class="table  table-bordered table-hover " style="font-size: 11px;" >
            <thead style="text-align: center">
                     <tr>
                        <th width="5%" style="vertical-align: middle;">No</th>
                        <th style="vertical-align: middle;">Nomor Surat Tugas</th>
                        <th style="vertical-align: middle;">Nama Kegiatan</th>
                        <th style="vertical-align: middle;">Destinasi</th>
                        <th style="vertical-align: middle;">Tanggal Kegiatan</th>
                     </tr>
                 <thead>
                 <tbody>   	
                    @php $no=1;  @endphp
                    @foreach($data as $key=>$row)
                    <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>{{$row->out->number}}</td>
                        <td>{{$row->out->purpose}}</td>
                        <td>
                            @if (count($row->out->outst_destiny) == 1)
                                @foreach ($row->out->outst_destiny as $key=>$item)
                                    @if ($loop->first)
                                        {{$item->destiny->capital}} 
                                    @endif
                                    
                                @endforeach

                            @elseif (count($row->out->outst_destiny) == 2)
                                @foreach ($row->out->outst_destiny as $key=>$item)
                                    {{$item->destiny->capital}}
                                    @if ($row->out->outst_destiny->count()-1 != $key)
                                        {{' dan '}}
                                    @endif
                                @endforeach

                            @else
                                @foreach ($row->out->outst_destiny as $key=>$item)
                                    @if ($loop->last-1)
                                        {{$item->destiny->capital}}{{','}} 
                                    @endif
                                    @if ($loop->last)
                                        {{' dan '}} {{$item->destiny->capital}}
                                    @endif
                                    
                                @endforeach
                            @endif
                        </td>
                        <td style="text-align: center">
                            @foreach ($row->out->outst_destiny as $key=>$item)
                                @if ($loop->first)
                                    {{tgl_indo($item->go_date)}} 
                                @endif
                            @endforeach
                            <br> s/d <br> 
                            @foreach ($row->out->outst_destiny as $key=>$item)
                            @if ($loop->last)
                                {{tgl_indo($item->return_date)}} 
                            @endif
                        @endforeach

                        </td>    
                    </tr>
                    @endforeach
                 <tbody>
             </table>
         </div>
    </div>
@endsection