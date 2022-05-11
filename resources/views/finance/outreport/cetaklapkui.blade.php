@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/print.css')}}" rel="stylesheet"> --}}
    <title>Rekapitulasi Biaya Perjalanan Dinas</title>
</head>
<body>
    <style>
        @page {
            size: A4 landscape;
            font-family: 'Times New Roman';
        }

        table,tr,td, th{
            border:1px solid black;
            /* font-size: 5; */
        }
        table{
            width: 100%;
        }

        .atas{
            border: none;
        }

        th, thead{
            text-align: center;

        }

        .ttd{
            margin-left: 8%;
            margin-right: 8%;
        }

        .table2{
            border: none;
            border-collapse: collapse;
        }
        
    </style>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div style="align=center font-size: 20px">
                <b>Rekapitulasi Biaya Perjalanan Dinas</b>
            </div>
            <br>
         </div>
         <div class="isi" style="font-size: 12px">
            <table class="atas">
                <tr  class="atas">
                    <td  class="atas">Kode Anggaran</td>
                    <td  class="atas">
                        : {{$pokdet->pok->act->lengkap}}/{{$pokdet->sub->kodeall}}/
                        {{$pokdet->akun->code}}
                    </td>
                </tr>
                <tr  class="atas">
                    <td  class="atas">Bidang</td>
                    <td  class="atas">: 
                        @if ($request->divisi != null)
                            {{$bidang->nama}} 
                        @else
                            Semua Bidang        
                        @endif
                    </td>
                </tr>
                <tr  class="atas">
                    <td  class="atas">Periode</td>
                    <td  class="atas">:
                        {{$request->daftartahun}} 
                        @if ($request->bulan =="2")
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
                    </td>
                </tr>
            </table>
            <br>
        </div>
             <div class="table-responsive isi">
                 <table class="table  table-bordered table-hover " style="font-size: 11px;" >
                     <thead style="text-align: center">
                         <tr>
                            <th width="20px" style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">Nomor Surat Tugas</th>
                            <th style="vertical-align: middle;">Nama Kegiatan</th>
                            <th style="vertical-align: middle;">Nama Pegawai</th>
                            <th style="vertical-align: middle;">Sub Total</th>
                         </tr>
                     <thead>
                     <tbody>   	
                        @php 
                            $no=1;
                            $akhir = 0;
                        @endphp
                        @foreach($data as $key=>$row)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td>{{$row->peg->out->number}}</td>
                            <td>{{$row->peg->out->purpose}}</td>
                            <td style="vertical-align: top">
                                {{$row->peg->pegawai->name}}
                            </td>
                            <td>
                                @php
                                    $total = $injectQuery->totalHarga($row->outst_employee_id)
                                    $akhir += $total;
                                @endphp
                                <b>{{number_format($total)}}</b> 
                            </td>
                        </tr>
                        @endforeach
                    <tbody>
                    <tfoot>
                        <tr>
                            
                            <td colspan="4"><b>Total Penggunaan Anggaran {{$pokdet->pok->act->lengkap}}/{{$pokdet->sub->kodeall}}/
                                {{$pokdet->akun->code}}</b></td>
                            <td><b>{{number_format($akhir)}}</b> </td>
                        </tr>
                    </tfoot>
                         
                 </table>
             </div>
        </div>
    </main>
</body>
</html>