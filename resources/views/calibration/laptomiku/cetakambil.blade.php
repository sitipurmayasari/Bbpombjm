<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekapitulasi Pengambilan Mikroba Baku</title>
    <style>
        @page {
            size:A4;
            font-family: Arial;
            font-size: 12;
        }

        table,tr,td, th{
            padding-left: 5px; 
            border: 1px solid black;
            vertical-align : top;
            border-collapse: collapse;
        }

        th{
            text-align: center;
        }
        
    </style>
</head>
<body>
    <div class="col-sm-12 isi" style="text-align: center">
        <div style="align=center font-size: 16">
            <b>Rekapitulasi Pengambilan Mikroba Baku</b>
        </div>
        <br>
     </div>
     <div class="isi">
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
    </div>
         <div class="table-responsive isi">
             <table style="width:100%; font-size: 11;" >
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
         </div>
    </div>
</body>
</html>