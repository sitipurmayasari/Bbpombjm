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

            th{
                vertical-align: middle;
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
        Periode : 
                {{tgl_indo($request->awal)}}
        <br>
        <br>
    </div>
         <div class="table-responsive isi">
             <table id="simple-table" class="table  table-bordered table-hover" style="font-size: 11px;" >
                 <thead>
                     <tr>
                        <th style="width: 20px;">No</th>
                        <th>Nama</th>
                        <th>Bagian</th>
                        <th>Nomor Surat Tugas</th>
                        <th>Nama Kegiatan</th>
                        <th>Destinasi</th>
                        <th>Tanggal Kegiatan</th>
                     </tr>
                 <thead>
                 <tbody>   	
                    @php $no=1;  @endphp
                    @foreach($data as $key=>$row)
                    <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>{{$row->pegawai->name}} 
                            @if ($row->out->external == 'Y')
                                (Petugas External) 
                            @endif
                        </td>
                        <td>{{$row->pegawai->divisi->nama}}</td>
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
                                    {{$item->go_date}} 
                                @endif
                            @endforeach
                            <br> s/d <br> 
                            @foreach ($row->out->outst_destiny as $key=>$item)
                            @if ($loop->last)
                                {{$item->return_date}} 
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