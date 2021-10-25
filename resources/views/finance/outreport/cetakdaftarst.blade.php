<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%">
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div style="align=center font-size: 20px">
                <b>Rekapitulasi Surat Tugas</b>
            </div>
            <br>
         </div>
         <div class="isi" style="font-size: 12px">
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
            @if ($request->tahun!="1")
                {{$request->daftartahun}}
            @endif
            <br>
            <br>
        </div>
             <div class="table-responsive isi">
                 <table id="simple-table" class="table  table-bordered table-hover " style="font-size: 11px;" >
                     <thead style="text-align: center">
                         <tr>
                            <th width="20px" style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">Nomor Surat Tugas</th>
                            <th style="vertical-align: middle;">Tanggal Pengajuan</th>
                            <th style="vertical-align: middle;">Bidang</th>
                            <th style="vertical-align: middle;">Nama Kegiatan</th>
                            <th style="vertical-align: middle;">Destinasi</th>
                            <th style="vertical-align: middle;">Petugas</th>
                         </tr>
                     <thead>
                     <tbody>   	
                        @php $no=1;  @endphp
                        @foreach($data as $key=>$row)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td>{{$row->number}}</td>
                            <td>{{tgl_indo($row->st_date)}}</td>
                            <td>{{$row->divisi->nama}}</td>
                            <td>{{$row->purpose}}</td>
                            <td>
                                @if (count($row->outst_destiny) == 1)
                                    @foreach ($row->outst_destiny as $key=>$item)
                                        @if ($loop->first)
                                            {{$item->destiny->capital}} 
                                        @endif
                                        
                                    @endforeach

                                @elseif (count($row->outst_destiny) == 2)
                                    @foreach ($row->outst_destiny as $key=>$item)
                                        {{$item->destiny->capital}}
                                        @if ($row->outst_destiny->count()-1 != $key)
                                            {{' dan '}}
                                        @endif
                                    @endforeach

                                @else
                                    @foreach ($row->outst_destiny as $key=>$item)
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
                                {{count($row->petugas)}} Orang
                            </td>    
                        </tr>
                        @endforeach
                     <tbody>
                 </table>
             </div>
        </div>
    </main>
</body>
</html>