@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Kuitansi</title>

    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 7;
            font-style: italic;
            margin-top: 30px;
            margin-bottom: 15px;
            line-height: 1;
            page-break-after: always;
            page-break-before: always;
        }

        .kepala {
            text-align: left;
            font-style: italic;
            font-size: 7;
            border-collapse: collapse;
            border: none;
            line-height: 1;

        }
        .isi{
            font-size: 7;
            font-family: 'Times New Roman';
            border: 1px solid black;
            vertical-align : top;
            line-height: 1;

        }

      
        #border{
            border: 1px solid;
            text-align: center;
            margin-left: 120px;
            margin-right: 120px;
            font-size: 11;
            padding-top: 0;
            padding-bottom: 0; 
        }

        th{
            text-align: center;
            letter-spacing: 2px;
        }
        p{
            font-size: 9; 
            text-align:center;
            line-height: 1;
        }
        
        body{
            page-break-after: always;
            page-break-before: always;
        }


        </style>

</head>
@php
    $no=1;
@endphp
@foreach ($pegawai as $item)
    
<body>

    <div style="page-break-before: always;">
        <table style="width: 100%; padding" class="kepala">
            <tr>
                <td style="vertical-align: bottom; text-align: center;"  colspan="2">
                    <img src="{{asset('images/BBRI.jpg')}}" style="height:50px">
                </td>
                <td colspan="2" style=" font-size: 6;">
                    Lampiran VI (4 dari 4) <br>
                    Peraturan Menteri Keuangan tentang Perjalanan Dinas <br>
                    Dalam Negeri bagi Pejabat Negara Pegawai Negeri Sipil <br>
                    Dan Pegawai Tidak Tetap <br>
                    Nomor 113/PMK.05/2012 &nbsp;&nbsp;&nbsp; Tgl. 23 Juli 2012
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;  font-size: 10; font-style: normal;">BALAI BESAR PENGAWAS OBAT DAN MAKANAN</td>
                <td style="width: 18%">Akun</td>
                <td style="width: 25%">: {{$item->out->pok->sub->komponen->code}} / {{$item->out->pok->akun->code}} )</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;  font-size: 10;" > Di Banjarmasin</td>
                <td>Bukti Kas</td>
                <td>: ............................</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="border">
                        KWITANSI
                    </div>
                </td>
                <td>Tahun Anggaran</td>
                <td>: {{$item->out->pok->pok->year}}</td>
            </tr>
            <tr>
                <td style="width: 20%" >Sudah Terima dari</td>
                <td colspan="3">: Pejabat Pembuat komitmen Balai Besar Pengawas Obat dan Makanan di Banjarmasin</td>
            </tr>
            <tr>
                <td>Uang Sebesar</td>
                <td colspan="3">: <b>Rp.  &nbsp;&nbsp;&nbsp; 
                    @php
                        $total = $injectQuery->totalHarga($item->id)
                    @endphp
                    {{number_format($total)}} 
                </b></td>
            </tr>
            <tr>
                <td>Untuk Pembayaran</td>
                <td colspan="3">: <b>{{$data->st->purpose}}</b></td>
            </tr>
       </table>
    </div>
   <br>
   <table style="width: 100%; padding" class="kepala">
        <tr>
            <td style="width: 20%">Berdasarkan Surat Tugas </td>
            <td colspan="2">: {{$item->out->number}}</td>
            <td colspan="2">Tanggal : {{tgl_indo($item->out->st_date)}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 20%">: di Kota
                @if (count($item->out->outst_destiny) == 1)
                     @foreach ($tujuan as $key=>$kota)
                         @if ($loop->first)
                             {{$kota->destiny->capital}} 
                         @endif
                         
                     @endforeach

                 @elseif (count($item->out->outst_destiny) == 2)
                     @foreach ($tujuan as $key=>$kota)
                         {{$kota->destiny->capital}}
                         @if ($tujuan->count()-1 != $key)
                             {{' dan '}}
                         @endif
                     @endforeach

                 @else
                     @foreach ($tujuan as $key=>$kota)
                         @if ($loop->last-1)
                             {{$kota->destiny->capital}}{{','}} 
                         @endif
                         @if ($loop->last)
                             {{' dan '}} {{$kota->destiny->capital}}
                         @endif
                         
                     @endforeach
                 @endif
        </tr>
        <tr>
            <td>Terbilang</td>
            <td style="text-transform: capitalize;">: <b>
                {{terbilang($total)}} Rupiah
            </b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;" > Yang Menerima : <br><br><br></td>
            <td></td>
            <td style="width: 18%">
                Program/Kegiatan <br>
                KRO/RO/Komponen <br>
                Sub Komponen/Akun 
            </td>
            <td style="width: 25%">
                : {{$item->out->pok->pok->act->prog->unit->klcode->code}}.{{$item->out->pok->pok->act->prog->unit->code}}.
                    {{$item->out->pok->pok->act->prog->code}} / {{$item->out->pok->pok->act->code}}<br>
                : {{$item->out->pok->sub->komponen->det->unit->code}} / {{$item->out->pok->sub->komponen->det->code}} / 
                    {{$item->out->pok->sub->komponen->code}} <br>
                : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;" > 
                <u>{{$item->pegawai->name}}</u> <br>
                @if ($item->pegawai->status=="PNS")
                NIP. {{$item->pegawai->no_pegawai}}
            @endif
            <td></td>
            <td >Petugas <br><br><br></td>
            <td>: {{$no++}} <br><br><br></td>
        </tr>
   </table>
    <hr style="border:0.5px solid black; margin: 7px;">
   <table style="width: 100%; text-align:center;" class="kepala">
        <tr>
            <td style="width:38%"></td>
            <td style="width: 31%">
                Lunas dibayar
            </td>
            <td style="width: 31%"></td>
        </tr>
        <tr>
            <td></td>
            <td>Pada tanggal ..................................</td>
            <td>Setuju dibayar</td>
        </tr>
        <tr>
            <td></td>
            <td>Bendahara Pengeluaran, <br><br><br><br><br></td>
            <td>{{$item->out->ppk->jabatan}} <br><br><br><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td style="line-height: 1.3;">
                <u>{{$petugas->user->name}}</u> <br>
                NIP. {{$petugas->user->no_pegawai}}
            </td>
            <td style="line-height: 1.3;">
                <u>{{$item->out->ppk->user->name}}</u> <br>
                NIP. {{$item->out->ppk->user->no_pegawai}}
            </td>
        </tr>
   </table>
      <hr style="border:0.5px solid black; margin: 7px;">
   <p style="font-size: 10; text-align:center;"><b>RINCIAN BIAYA PERJALANAN DINAS</b></p>
   <table class="isi" style="width: 100%">
    <thead>
        <tr>
            <th class="isi" style="width: 5%">No.</th>
            <th class="isi">Daftar Perincian</th>
            <th class="isi" style="width: 12%">Jumlah</th>
            <th class="isi" style="width: 15%">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @php
                $fee1=0;
                $fee2=0;
                $fee3=0;
                $nilai = $injectQuery->getDetail($item->id)
            @endphp
            <td class="isi" style="text-align: center">1</td>
            <td>
               <table style="width: 100%;">
                    <tr>
                        <td colspan="7"><i>Biaya Transport</i></td>
                        @php
                            $jum=0;
                            $bbm=0;
                            $subtrans = 0;
                            $subTotal1 = 0;
                        @endphp
                    </tr>
                    <tr>
                        <td colspan="2"> <i>Tiket Pesawat / Kereta</i></td>
                        <td style="width: 5%"></td>
                        <td style="width: 18%"> <i>Pergi</i></td>
                        <td style="width: 13%"></td>
                        <td style="text-align: center; width:10%;"> <i>. Rp.</i></td>
                        <td style="text-align: right; width:13%;"> 
                            <i>
                                @if ($nilai->planefee1 != '0')
                                    @php
                                        $fee1 = $nilai->planefee1;
                                        $fee2 = $nilai->planefee2;
                                        $fee3 = $nilai->planefee3;
                                        $subtrans = $fee1+$fee2+$fee3;
                                        $subTotal1 += $subtrans;
                                    @endphp
                                    {{number_format($subtrans)}}
                                @else
                                   {{ '-' }}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> <i>Kembali</i></td>
                        <td></td>
                        <td style="text-align: center;"><i>. Rp.</i></td>
                        <td style="text-align: right"> 
                            <i>
                                @if ($nilai->planereturnfee != '0')
                                    @php
                                        $subtrans =$nilai->planereturnfee;
                                        $subTotal1 += $subtrans;
                                    @endphp
                                    {{number_format($subtrans)}} 
        
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        @php
                            $jumloc=0;
                            $harloc=0;
                            $daily = $injectQuery->getTr($item->id)
                        @endphp
                        <td><i> Transport Lokal</i></td>
                        <td>
                        </td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="width: 18%"> <i>
                            @if ($daily->tlokal == 'Y')
                                 {{number_format($daily->jumtlokal)}} 
                            @else
                                {{ '-' }} 
                            @endif
                            &nbsp;
                            kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                            </i>
                        </td>
                        <td style="text-align: right"> 
                            <i>
                                @if ($daily->tlokal == 'Y')
                                    {{number_format($daily->hittlokal)}} 
                                @else
                                    {{ '-' }}
                                @endif
                            </i> 
                            &nbsp;
                        </td>
                        <td style="text-align: center; width:10%;"><i>. Rp.</i></td>
                        <td style="text-align: right;  width:10%;"> 
                            <i>
                                @php
                                    $subtrans = $daily->tottlokal;  
                                    $subTotal1 += $subtrans;  
                                @endphp
                                @if ($subtrans !='0')
                                    {{number_format($subtrans)}}
                                @else
                                    {{'-'}}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td> <i>Taxi Kota</i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        @php
                            $jumtaxi=0;
                            $hartaxi=0;
                        @endphp
                        <td><i> - Asal</i></td>
                        <td> <i>
                                {{$item->out->cityfrom->capital}}
                            </i>
                        </td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="width: 18%"> <i>
                                @if ($nilai->taxy_count_from != '0')
                                    @php
                                        $jumtaxi =$nilai->taxy_count_from;
                                    @endphp
                                    {{number_format($jumtaxi)}} 
                                @else
                                    {{ '-' }}
                                @endif
                                &nbsp;
                                kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                            </i>
                        </td>
                        <td style="text-align: right"> 
                            <i>
                                @if ($nilai->taxy_count_from != '0')
                                    @php
                                        $hartaxi =$nilai->taxy_fee_from;
                                    @endphp
                                    {{number_format($hartaxi)}} 
                                @else
                                    {{ '-' }}
                                @endif
                            </i> 
                            &nbsp;
                        </td>
                        <td style="text-align: center; width:10%;"><i>. Rp.</i></td>
                        <td style="text-align: right;  width:10%;"> 
                            <i>
                                @php
                                    $subtrans = $jumtaxi*$hartaxi;  
                                    $subTotal1 += $subtrans;  
                                @endphp
                                @if ($subtrans !='0')
                                    {{$subtrans}}
                                    
                                @else
                                    {{'-'}}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        @php
                           
                        @endphp
                        <td><i> - Tujuan</i></td>
                        <td> 
                            <i>
                                @if (count($item->out->outst_destiny) == 1)
                                    @foreach ($tujuan as $key=>$kota)
                                        @if ($loop->first)
                                            {{$kota->destiny->capital}} 
                                        @endif
                                        
                                    @endforeach
        
                                @elseif (count($item->out->outst_destiny) == 2)
                                    @foreach ($tujuan as $key=>$kota)
                                        {{$kota->destiny->capital}}
                                        @if ($tujuan->count()-1 != $key)
                                            {{' dan '}}
                                        @endif
                                    @endforeach
        
                                @else
                                    @foreach ($tujuan as $key=>$kota)
                                        @if ($loop->last-1)
                                            {{$kota->destiny->capital}}{{','}} 
                                        @endif
                                        @if ($loop->last)
                                            {{' dan '}} {{$kota->destiny->capital}}
                                        @endif
                                        
                                    @endforeach
                                @endif
                            </i>
                        </td>
                        <td style="text-align: center;"><i>:</i> </td>
                        <td> 
                            <i>
                                @if ($nilai->bbm != '0' && $nilai->taxy_fee_to == '0')
                                    @php
                                        $jum = 1;
                                    @endphp
                                    {{$jum}}
                                @elseif($nilai->taxy_fee_to != '0' && $nilai->bbm == '0')
                                    @php
                                        $jum = $nilai->taxy_count_to;
                                    @endphp
                                    {{$jum}}
                                @elseif($nilai->taxy_fee_to != '0' && $nilai->bbm != '0')
                                    @php
                                        $jum = $nilai->taxy_count_to;
                                    @endphp
                                    {{$jum}}
                                @else
                                    {{ '-' }}
                                @endif
                                &nbsp;
                                kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. 
                            </i>
                        </td>
                        <td style="text-align: right;"> 
                            <i>
                                @if ($nilai->bbm != '0' && $nilai->taxy_fee_to == 0)
                                    @php
                                        $bbm = $nilai->bbm;
                                    @endphp
                                    {{number_format($bbm)}}
        
                                @elseif($nilai->taxy_fee_to != 0 && $nilai->bbm == '0')
                                    @php
                                        $bbm = $nilai->taxy_fee_to;
                                    @endphp
                                    {{number_format($bbm)}}
                                @elseif($nilai->taxy_fee_to != 0 && $nilai->bbm != '0')
                                    @php
                                        $a = $nilai->taxy_fee_to;
                                        $b = $nilai->bbm;
                                        $bbm = $a+$b;
                                    @endphp
                                    {{number_format($bbm)}}
                                @else
                                    {{ '-' }}
                                @endif
                            </i>
                            &nbsp; 
                        </td>
                        <td style="text-align: center;"><i>. Rp.</i></td>
                        <td style="text-align: right"> 
                            <i>
                                @php
                                    $subtrans = $jum*$bbm; 
                                    $subTotal1 += $subtrans;   
                                @endphp
                                @if ($subtrans !='0')
                                    {{$subtrans}}
                                @else
                                    {{'-'}}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td><i> - Kembali</i></td>
                        <td></td>
                        <td style="text-align: center;"><i>:</i> </td>
                        <td> 
                            <i>
                                - &nbsp; kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                            </i>
                        </td>
                        <td style="text-align: right;"> <i>- &nbsp;</i> &nbsp;</td>
                        <td style="text-align: center;"><i>. Rp.</i></td>
                        <td style="text-align: right"> 
                            <i>-</i> &nbsp; &nbsp; 
                        </td>
                    </tr>
               </table>
            </td>
            <td class="isi">
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                @if ($subTotal1=='0')
                    {{'-'}}
                @else
                    {{number_format($subTotal1)}}
                @endif
            </td>
            <td class="isi">
                {{$item->out->transport}}
            </td>
        </tr>
        <tr>
            <td class="isi" style="text-align: center">2</td>
            <td class="isi">
                <table style="width: 100%;">
                    <tr>
                        <td colspan="6"> 
                            <i> Uang Harian di Kota 
                                @if (count($item->out->outst_destiny) == 1)
                                @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->first)
                                        {{$kota->destiny->capital}} 
                                    @endif
                                @endforeach

                            @elseif (count($item->out->outst_destiny) == 2)
                                @foreach ($tujuan as $key=>$kota)
                                    {{$kota->destiny->capital}}
                                    @if ($tujuan->count()-1 != $key)
                                        {{' dan '}}
                                    @endif
                                @endforeach

                            @else
                                @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->last-1)
                                        {{$kota->destiny->capital}}{{','}} 
                                    @endif
                                    @if ($loop->last)
                                        {{' dan '}} {{$kota->destiny->capital}}
                                    @endif
                                    
                                @endforeach
                            @endif 

                            Provinsi 
                            @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->first)
                                        {{$kota->destiny->province}} 
                                    @endif        
                            @endforeach
                            </i>
                        </td>
                    </tr>
                    <tr>
                        @php
                            $subTotalHarian = 0;
                            $subTotal2 = 0;
                            $dailyfee = $injectQuery->getUH($item->id)
                        @endphp
                        <td><i> - Penuh</i></td>
                        <td style="text-align: center; width:5%"><i>:</i> </td>
                        <td style="width:18%"> 
                            <i>
                                @if ($dailyfee->dailywage1 == 'Y')
                                    {{number_format($dailyfee->jumdaily1)}} 
                                @else
                                    {{ '-' }} 
                                @endif
                                hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                            </i>
                        </td>
                        <td style="text-align: right; width:13%"> 
                            <i>
                                @if ($dailyfee->dailywage1 == 'Y')
                                    {{number_format($dailyfee->hitdaily1)}} 
                                @else
                                    {{ '-' }} 
                                @endif
                            </i> &nbsp;
                        </td>
                        <td style="text-align: center; width:10%"><i>. Rp.</i></td>
                        <td style="text-align: right; width:13%"> 
                            <i>
                                @php
                                    $subTotalHarian = $dailyfee->totdaily1;
                                    $subTotal2 +=  $subTotalHarian;
                                @endphp
                                @if ($subTotalHarian != 0)
                                    {{number_format($subTotalHarian)}} 
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        @php
                            $daily = $injectQuery->getTr($item->id)
                        @endphp
                        <td><i> - Diklat</i></td>
                        <td style="text-align: center;"><i>:</i> </td>
                        <td> 
                            <i>
                                @if ($daily->diklat == 'Y')
                                    {{$daily->jumdiklat}} 
                                @else
                                    {{ '-' }} 
                                @endif
                                hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                            </i>
                        </td>
                        <td style="text-align: right;"> 
                            <i>
                                @if ($daily->diklat == 'Y')
                                    {{number_format($daily->hitdiklat)}} 
                                @else
                                    {{ '-' }} 
                                @endif
                            </i> &nbsp;</td>
                        <td style="text-align: center;"><i>. Rp.</i></td>
                        <td style="text-align: right"> 
                            <i>
                                @php
                                    $subTotalHarian = $daily->totdiklat;
                                    $subTotal2 +=  $subTotalHarian;
                                @endphp
                                @if ($subTotalHarian != 0)
                                    {{number_format($subTotalHarian)}}
                                @else
                                    {{ '-' }} 
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td><i> - Paket Halfday / Fullday</i></td>
                        <td style="text-align: center;"><i>:</i> </td>
                        <td> 
                            <i>
                                @if ($daily->fullday == 'Y')
                                    {{$daily->jumhalf}} 
                                @else
                                    {{ '-' }} 
                                @endif
                                hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. 
                            </i>
                        </td>
                        <td style="text-align: right;"> 
                            <i>
                                @if ($daily->fullday == 'Y')
                                    {{number_format($daily->hithalf)}} 
                                @else
                                    {{ '-' }} 
                                @endif
                            </i> &nbsp;</td>
                        <td style="text-align: center;"><i>. Rp.</i></td>
                        <td style="text-align: right"> 
                            <i>
                                @php
                                    $subTotalHarian = $daily->tothalf;
                                    $subTotal2 +=  $subTotalHarian;
                                @endphp
                                @if ($subTotalHarian != 0)
                                    {{number_format($subTotalHarian)}} 
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td><i> - Paket Fullboard</i></td>
                        <td style="text-align: center;"><i>:</i> </td>
                        <td> 
                            <i>
                                @if ($daily->fullboard == 'Y')
                                    {{$daily->jumfullb}} 
                                @else
                                    {{ '-' }}
                                @endif
                                hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                            </i>
                        </td>
                        <td style="text-align: right;"> 
                            <i>
                                @if ($daily->fullboard == 'Y')
                                    {{number_format($daily->hitfullb)}} 
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp;</td>
                        <td style="text-align: center;"><i>. Rp.</i></td>
                        <td style="text-align: right"> 
                            <i>
                                @php
                                    $subTotalHarian = $daily->totfullb;
                                    $subTotal2 +=  $subTotalHarian;
                                @endphp
                                @if ($subTotalHarian != 0)
                                    {{number_format($subTotalHarian)}} 
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                </table>
            </td>
            <td class="isi">
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                <i>
                    @if ($subTotal2 =='0')
                        {{'-'}}
                    @else
                        {{number_format($subTotal2)}}
                    @endif
                    &nbsp;
                </i>
                &nbsp;
            </td>
            <td class="isi"></td>
        </tr>
        <tr>
            <td class="isi" style="text-align: center">3</td>
            <td class="isi">
                <table style="width: 100%">
                    <tr>
                        <td colspan="6"> 
                            <i> Biaya Pertemuan di Kota 
                                @if (count($item->out->outst_destiny) == 1)
                                @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->first)
                                        {{$kota->destiny->capital}} 
                                    @endif
                                @endforeach

                            @elseif (count($item->out->outst_destiny) == 2)
                                @foreach ($tujuan as $key=>$kota)
                                    {{$kota->destiny->capital}}
                                    @if ($tujuan->count()-1 != $key)
                                        {{' dan '}}
                                    @endif
                                @endforeach

                            @else
                                @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->last-1)
                                        {{$kota->destiny->capital}}{{','}} 
                                    @endif
                                    @if ($loop->last)
                                        {{' dan '}} {{$kota->destiny->capital}}
                                    @endif
                                    
                                @endforeach
                            @endif 

                            Provinsi 
                            @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->first)
                                        {{$kota->destiny->province}} 
                                    @endif        
                            @endforeach
                            </i>
                        </td>
                    </tr>
                    <tr>
                        @php
                            $subTotal3 = 0;
                            $subBiaya = 0;
                        @endphp
                        <td><i> - Paket Halfday / Fullday</i></td>
                        <td style="text-align: center; width: 5%;"><i>:</i> </td>
                        <td style="width: 18%;"> 
                            <i>
                                @if ($daily->dayshalf != '0')
                                    {{$daily->dayshalf}}
                                @else
                                    {{ '-' }} 
                                @endif
                                hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. 
                            </i>
                        </td>
                        <td style="text-align: right; width:13%"> 
                            <i>
                                @if ($daily->dayshalf != '0')
                                    {{number_format($daily->feehalf)}} 
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp;</td>
                        <td style="text-align: center; width:10%"><i>. Rp.</i></td>
                        <td style="text-align: right; width:13%"> 
                            <i>
                                @php
                                    $subBiaya = $daily->totdayshalf;
                                    $subTotal3 += $subBiaya;
                                @endphp

                                @if ($subBiaya != '0')
                                    {{number_format($subBiaya)}}
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td><i> - Paket Fullboard</i></td>
                        <td style="text-align: center; width:5%"><i>:</i> </td>
                        <td style="width: 18%;"> 
                            <i>
                                @if ($daily->daysfull != '0')
                                    {{$daily->daysfull}}
                                @else
                                    {{ '-' }}
                                @endif
                                hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                            </i>
                        </td>
                        <td style="text-align: right; width:10%;"> 
                            <i>
                                @if ($daily->daysfull != '0')
                                    {{number_format($daily->feefull)}} &nbsp;
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp;</td>
                        <td style="text-align: center; width:10%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width:10%;"> 
                            <i>
                                @php
                                    $subBiaya = $daily->totdaysfull;
                                    $subTotal3 += $subBiaya;
                                @endphp

                                @if ($subBiaya != '0')
                                    {{number_format($subBiaya)}}
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                </table>
            </td>
            <td class="isi">
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                <i>
                    @if ($subTotal3!= '0')
                        {{number_format($subTotal3)}}
                    @else 
                        {{'-'}}
                    @endif
                </i>
                &nbsp;
            </td>
            <td class="isi"></td>
        </tr>
        <tr>
            <td class="isi" style="text-align: center">4</td>
            <td class="isi">
                <table style="width: 100%">
                    <tr>
                        <td colspan="6"> 
                            <i> Biaya Penginapan di Kota
                                @if (count($item->out->outst_destiny) == 1)
                                @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->first)
                                        {{$kota->destiny->capital}} 
                                    @endif
                                @endforeach

                            @elseif (count($item->out->outst_destiny) == 2)
                                @foreach ($tujuan as $key=>$kota)
                                    {{$kota->destiny->capital}}
                                    @if ($tujuan->count()-1 != $key)
                                        {{' dan '}}
                                    @endif
                                @endforeach

                            @else
                                @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->last-1)
                                        {{$kota->destiny->capital}}{{','}} 
                                    @endif
                                    @if ($loop->last)
                                        {{' dan '}} {{$kota->destiny->capital}}
                                    @endif
                                    
                                @endforeach
                            @endif 

                            Provinsi 
                            @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->first)
                                        {{$kota->destiny->province}} 
                                    @endif        
                            @endforeach
                            </i>
                        </td>
                    </tr>
                    <tr>
                        @php
                            $jum1 =0;
                            $jum2 = 0;
                            $subTotal4 = 0;
                        
                            $inap1 = $nilai->innname_1;
                            $inap2 = $nilai->innname_2;
                        @endphp
                        <td><i>
                            @if ($inap2 != null)
                                - {{$inap1}} &nbsp; <br>
                                - {{$inap2}}
                            @elseif($inap1 != null && $inap2 == null)
                                - {{$inap1}} &nbsp; 
                            @else
                                - &nbsp; <br>
                            @endif
                            </i></td>
                        <td style="text-align: center; width:5%"><i>:</i> </td>
                        <td style="width: 18%;"> 
                            <i>
                                @php
                                    $long1 = $nilai->long_stay_1;
                                    $long2 = $nilai->long_stay_2;
                                @endphp
                                @if ($nilai->innname_2 != null)
                                    {{$long1}} hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.  <br>
                                    {{$long2}} hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. 
                                @elseif($nilai->innname_2 == null && $nilai->innname_1 != null)
                                    {{$long1}} hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                                @else
                                - &nbsp; <br>
                                @endif
                            </i>
                        </td>
                        <td style="text-align: right; width:13%"> 
                            <i>
                                
                                @if ($nilai->innname_2 != null)
                                    @php
                                        $feehotel1 = $nilai->inn_fee_1 / $nilai->isi_1;
                                        $feehotel2 = $nilai->inn_fee_2 / $nilai->isi_2;
                                    @endphp
                                    {{number_format($feehotel1)}} &nbsp; <br>
                                    {{number_format($feehotel2)}}
                                @elseif($nilai->innname_2 == null && $nilai->innname_1 != null)
                                    @php
                                        $feehotel1 = $nilai->inn_fee_1 / $nilai->isi_1;
                                    @endphp
                                    {{number_format($feehotel1)}} &nbsp;
                                @else
                                    - &nbsp; <br>
                                    
                                @endif
                            </i> &nbsp;</td>
                        <td style="text-align: center; width:10%">
                            <i>
                                . Rp. <br>
                                @if ($nilai->innname_2 != null)
                                . Rp.   
                                @endif
                            </i>
                        </td>
                        <td style="text-align: right; width:13%"> 
                            <i>
                                @php
                                    $jum1 = $nilai->klaim_1; 
                                    $jum2 = $nilai->klaim_2;
                                    $subTotal4 = $jum1 + $jum2;
                                @endphp
                                @if ($jum2 != '0' && $jum1 != '0')
                                    {{number_format($jum1)}} &nbsp; <br>
                                    {{number_format($jum2)}} &nbsp;
                                @elseif($jum2 =='0' && $jum1 != '0')
                                    {{number_format($jum1)}} &nbsp; <br>
                                @else
                                    - &nbsp; <br>
                                @endif
                            </i>  
                        </td>
                    </tr>
                    
                </table>
            </td>
            <td class="isi">
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                <i>
                    @if ($subTotal4!='0')
                        {{number_format($subTotal4)}}
                    @else
                        {{'-'}}
                    @endif
                </i>
                &nbsp;
            </td>
            <td class="isi">
                @if ($nilai->isi_1 != 0)
                        1 kamar untuk {{$nilai->isi_1}} orang
                @elseif($nilai->isi_2 != 0)
                        1 kamar untuk {{$nilai->isi_1}} orang <br>
                        1 kamar untuk {{$nilai->isi_2}} orang
                @endif
            </td>
        </tr>
        <tr>
            <td class="isi" style="text-align: center">5</td>
            <td class="isi">
                <table style="width: 100%">
                    <tr>
                        @php
                            $subTotal5 = 0;
                            $eselonMoney = 0;
                        @endphp
                        <td><i>
                            Uang Representatif Eselon II
                            </i></td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="width: 18%"> 
                            <i>
                                @if ($daily->representatif == 'Y')
                                    {{$daily->jumrep}}
                                @else
                                    {{ '-' }}
                                @endif 
                                hari &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp.
                            </i> &nbsp;
                        </td>
                        <td style="text-align: right; width:10%"> 
                            <i>
                                @if ($daily->representatif == 'Y')
                                    {{number_format($daily->hitrep)}}
                                @else
                                    {{ '-' }}
                                @endif
                            </i> &nbsp;</td>
                        <td style="text-align: center; width:10%">
                            <i>. Rp.</i>
                        </td>
                        <td style="text-align: right; width:10%"> 
                            <i>
                                @php
                                    $subTotalHarian = $daily->totrep;  
                                    $subTotal5 += $subTotalHarian;  
                                @endphp
                                @if ($subTotalHarian != '0')
                                    {{number_format($subTotalHarian)}}
                                @else
                                    {{ '-' }}
                                @endif
                            </i>  
                        </td>
                    </tr>
                    
                </table>
            </td>
            <td class="isi">
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                <i>
                    {{-- @php
                        $subTotal5 += $subTotalHarian;
                    @endphp --}}
                    @if ($subTotal5 != '0')
                        {{number_format($subTotal5)}}
                    @else
                        {{ '-' }}
                    @endif
                </i>
                &nbsp;
            </td>
            <td class="isi">
                <i>

                </i>
            </td>
        </tr>
        <tr>
            <td class="isi"></td>
            <td class="isi"><i><b>Jumlah Biaya Perjalanan :</b></i></td>
            <td class="isi">
                
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                <i>
                    @php
                        $totalPerjalanan = $subTotal1+$subTotal2+$subTotal3+$subTotal4+$subTotal5;
                    @endphp
                    <b>
                        {{number_format($totalPerjalanan)}}
                    </b>
                </i>
                &nbsp;
            </td>
            <td class="isi"></td>
        </tr>
        <tr>
            <td class="isi"></td>
            <td class="isi" colspan="3" style="text-transform: capitalize;">
                <i>Terbilang : <b>{{terbilang($total)}} Rupiah</b></i>
            </td>
        </tr>
    </tbody>
   </table>
   <table style="width: 100%;" class="kepala">
    <tr>
        <td style="width: 30%"></td>
        <td style="width: 30%"></td>
        <td style="width: 40%"><br> Banjarmasin, {{tgl_indo($data->date)}}</td>
    </tr>
    <tr>
        @php
            $total = $injectQuery->totalHarga($item->id)
        @endphp
        <td></td>
        <td>Telah di bayar sejumlah : Rp. {{number_format($total)}}</td>
        <td>Telah menerima jumlah uang sebesar : Rp. {{number_format($total)}} </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center">Bendahara Pengeluaran, <br><br><br><br></td>
        <td style="text-align: center"><b>Yang menerima :</b><br><br><br><br></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center;line-height: 1.3;">
            <u>{{$petugas->user->name}}</u> <br>
            NIP. {{$petugas->user->no_pegawai}}
        </td>
        <td style="text-align: center; ">
            <u>{{$item->pegawai->name}}</u> <br>
            @if ($item->pegawai->status=="PNS")
                NIP. {{$item->pegawai->no_pegawai}}
            @endif
        </td>
    </tr>
   </table>
    <hr style="border:0.5px solid black; margin: 7px;">
   <p style="font-size: 10; text-align:center;"><b>PERHITUNGAN SPPD RAMPUNG</b></p>
   <div style="page-break-after: always;">
    <table style="width: 100%;" class="kepala">
        <tr>
            <td style="width: 20%"></td>
            <td style="width: 23%">Ditetapkan sejumlah</td>
            <td  style="width: 3%"><b>Rp. </b></td>
            <td class="isi" style="text-align: right">{{number_format($total)}}</td>
            <td style="text-align: center; width:40%">{{$item->out->ppk->jabatan}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Yang telah dibayar semula</td>
            <td><b>Rp. </b></td>
            <td class="isi" style="text-align: right">{{number_format($total)}}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Sisa kurang / lebih</td>
            <td><b>Rp. </b></td>
            <td class="isi" style="text-align: right">Nihil</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center; line-height: 1.3;">
                <u>{{$item->out->ppk->user->name}}</u> <br>
                NIP. {{$item->out->ppk->user->no_pegawai}}
            </td>
        </tr>
        <tr>
            <br>
            <td colspan="5" style="text-align:center; letter-spacing: 2px; ">BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</td>
        </tr>
        <tr>
            <td colspan ="5" style="text-align:center;">
                Jl. Brigjend H. Hasan Basri No. 40 Banjarmasin - 70247 Telp (0511) 3304286, 3305115 ; Fax (0511) 3302162
            </td>
        </tr>
   </table>
   </div>
</body>

@endforeach

@section('footer')

<script>
   
    var total = document.getElementById("total_terbilang").value;
    document.getElementById("uangSebesar").innerHTML = total;
</script>
@endsection

</html>