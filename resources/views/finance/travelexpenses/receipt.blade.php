@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>

    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 8;
            font-style: italic;
            margin-top: 30px;
            margin-bottom: 15px;
            line-height: 1;

        }

        /* table, tr, td, th {
            padding-top: 3px;
            padding-bottom: 3px;
        } */

        .kepala {
            text-align: left;
            font-style: italic;
            font-size: 8;
            border-collapse: collapse;
            border: none;
            line-height: 1;

        }
        .isi{
            font-size: 8;
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
            font-size: 12;
            padding-top: 0;
            padding-bottom: 0; 
        }

        th{
            text-align: center;
            letter-spacing: 2px;
        }
        p{
            font-size: 10; 
            text-align:center;
            line-height: 1;
        }


        </style>

</head>
@php
    $no=1;
@endphp
@foreach ($pegawai as $item)
    
<body>

    @php
        $totalPerjalanan = 0;
    @endphp

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
            <td colspan="3">: <b>Rp.  &nbsp;&nbsp;&nbsp; {{number_format($totalPerjalanan)}}</b></td>
        </tr>
        <tr>
            <td>Untuk Pembayaran</td>
            <td colspan="3">: <b>{{$data->st->purpose}}</b></td>
        </tr>
   </table>
   <br>
   <table style="width: 100%; padding" class="kepala">
        <tr>
            <td style="width: 20%">Berdasarkan SPPD Nomor </td>
            <td colspan="2">: {{$item->no_sppd}}</td>
            <td colspan="2">Tanggal SPPD : {{tgl_indo($item->out->st_date)}}</td>
        </tr>
        <tr>
            <td>Untuk Perjalanan Dinas</td>
            <td style="width: 20%">: dari &nbsp; <b>{{$item->out->cityfrom->capital}}</b></td>
            <td colspan="3">ke <b>
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
            
                </b></td>
        </tr>
        <tr>
            <td>Terbilang</td>
            <td>: <b>{{terbilang($totalPerjalanan)}}</b></td>
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
                Sub Komponen/Akun <br>
                No. Surat Tugas
            </td>
            <td style="width: 25%">
                : {{$item->out->pok->pok->act->prog->unit->klcode->code}}.{{$item->out->pok->pok->act->prog->unit->code}}.
                    {{$item->out->pok->pok->act->prog->code}} / {{$item->out->pok->pok->act->code}}<br>
                : {{$item->out->pok->sub->komponen->det->unit->code}} / {{$item->out->pok->sub->komponen->det->code}} / 
                    {{$item->out->pok->sub->komponen->code}} <br>
                : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
                : {{$item->out->number}}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;" > <u>{{$item->pegawai->name}}</u>
            <td></td>
            <td >Petugas</td>
            <td>: {{$no++}} </td>
        </tr>
   </table>
   <hr style="border:1px solid black;">
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
            <td>Bendahara Pengeluaran, <br><br><br><br></td>
            <td>{{$item->out->ppk->jabatan}} <br><br><br><br></td>
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
   <hr style="border:1px solid black;">
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
                <td class="isi" style="text-align: center">1</td>
                <td class="isi">
                    <table style="width: 100%;" class="kepala">
                        <tr>
                            <td colspan="8">Biaya Transport</td>
                        </tr>
                        <tr>
                            <td colspan="3">Tiket Pesawat / Kereta</td>
                            <td colspan="3"> Pergi</td>
                            <td>. Rp. (disum dari 3 kota)</td>
                            <td style="text-align: right;">
                            &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="3"> Kembali</td>
                            <td>. Rp.</td>
                            <td style="text-align: right;">
                                @foreach ($lain as $nom)
                                    @if ($nom->planereturnfee != null)
                                        @php
                                            $subtrans = $nom->planereturnfee;
                                        @endphp
                                        {{number_format($subtrans)}} 
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8">Taxi Kota</td>
                        </tr>
                        <tr>
                            @php
                                $jum=0;
                                $nilai=0;
                            @endphp
                            <td colspan="2">- Asal </td>
                            <td>:</td>
                            <td style="text-align: right; width:5%;">
                                @foreach ($lain as $nom)
                                    @if ($nom->taxy_count_from != null)
                                        @php
                                            $jum = $nom->taxy_count_from;
                                        @endphp
                                        {{$jum}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                            <td>kali &nbsp; x &nbsp; Rp.</td>
                            <td style="text-align: right;">
                                @foreach ($lain as $nom)
                                    @if ($nom->taxy_count_from != null)
                                        @php
                                            $nilai = $nom->taxy_fee_from;
                                        @endphp
                                        {{number_format($nilai)}} 
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                            <td style="text-align: right;">
                                @php
                                    $subtrans = $jum*$nilai;    
                                @endphp
                                @foreach ($lain as $nom)
                                    @if ($nom->taxy_count_from != null)
                                        {{number_format($subtrans)}} 
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                            &nbsp;
                            </td>
                        </tr>
                        <tr>
                            @php
                                $jum=0;
                                $bbm=0;
                            @endphp
                            <td style="width: 15%">- Tujuan </td>
                            <td style="width: 20%;">
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
                            </td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($lain as $nom)
                                    @if ($nom->bbm != null)
                                        @php
                                            $jum = 1;
                                        @endphp
                                        {{$jum}}
                                    @elseif($nom->taxy_count_to != null)
                                        @php
                                            $jum = $nom->taxy_count_to;
                                        @endphp
                                        {{$jum}}
                                    @else
                                        -
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                            <td>kali x Rp.</td>
                            <td style="text-align: right;">
                                @foreach ($lain as $nom)
                                    @if ($nom->bbm != null)
                                        @php
                                            $bbm = $nom->bbm;
                                        @endphp
                                         {{number_format($bbm)}} 
                                    @elseif($nom->taxy_count_to != null)
                                        @php
                                            $bbm = $nom->taxy_fee_to;
                                        @endphp
                                         {{number_format($bbm)}} 
                                    @else
                                        -
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                            <td style="text-align: right;">
                                @php
                                    $subtrans = $jum*$bbm;    
                                @endphp
                                @foreach ($lain as $nom)
                                    @if ($nom->bbm != null)
                                        {{number_format($subtrans)}} 
                                    @elseif($nom->taxy_count_to != null)
                                        {{number_format($subtrans)}} 
                                    @else
                                        -
                                    @endif
                                @endforeach
                            &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">- kembali </td>
                            <td>:</td>
                            <td style="text-align: right;">
                                - &nbsp;
                            </td>
                            <td>kali x Rp.</td>
                            <td style="text-align: right;">- &nbsp;</td>
                            <td>. Rp.</td>
                            <td style="text-align: right;">- &nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Transport Lokal 
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
                            </td>
                            <td colspan="6">:</td>
                        </tr>
                    </table>
                </td>
                <td class="isi">Rp. &nbsp;&nbsp;
                </td>
                <td class="isi">{{$item->out->transport}}</td>
            </tr>
            <tr>
                @php
                    $hari=0;
                    $subTotal = 0;
                @endphp
                @foreach ($tujuan as $key=>$hr)
                    @php
                        $hari += $hr->longday;
                    @endphp
                @endforeach
                <td class="isi" style="text-align: center">2</td>
                <td class="isi">
                    <table style="width: 100%;" class="kepala">
                      
                        <tr>
                            <td colspan="7">Uang Harian di Kota
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

                            </td>
                        </tr>
                        <tr>
                            <td>- Penuh</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->dailywage=='Y')
                                        {{$hari}}
                                    @else
                                        {{ "-" }}
                                    @endif
                                @endforeach
                            </td>
                            <td>hari &nbsp; x &nbsp;Rp.</td>
                            <td style="text-align: right;">
                                @php
                                    $destinMoney = $isi->hitdaily;
                                @endphp

                                @foreach ($tr as $isi)
                                    @if ($isi->dailywage=='Y')
                                        {{number_format($destinMoney)}} 
                                    @else
                                        {{ "-" }}
                                    @endif
                                @endforeach
                                
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                             @php
                                 $subTotalHarian = $hari*$destinMoney;    
                             @endphp
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->dailywage=='Y')
                                        {{number_format($subTotalHarian)}} 
                                    @else
                                        {{ "-" }}
                                    @endif
                                @endforeach
                               &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>- Diklat</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->diklat=='Y')
                                        {{$hari}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                            </td>
                            <td>hari &nbsp; x &nbsp;Rp.</td>
                            <td style="text-align: right;">
                                @php
                                    $diklatMoney = $isi->hitdiklat;
                                @endphp

                                @foreach ($tr as $isi)
                                    @if ($isi->diklat=='Y')
                                        {{number_format($diklatMoney)}} 
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                               
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                                @php
                                    $subTotalHarian = $hari*$diklatMoney;    
                                @endphp
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->diklat=='Y')
                                        {{number_format($subTotalHarian)}} 
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>- Paket Halfday / Fullday</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->fullday=='Y')
                                        {{$hari}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                            </td>
                            <td>hari &nbsp; x &nbsp;Rp.</td>
                            <td style="text-align: right;">
                                @php
                                    $halfdayMoney = $isi->hithalf;
                                @endphp
                                
                                @foreach ($tr as $isi)
                                    @if ($isi->fullday=='Y')
                                        {{number_format($halfdayMoney)}}
                                    @else
                                        {{ '-' }}
                                    @endif  
                                @endforeach
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                            @php
                                 $subTotalHarian = $hari*$halfdayMoney;    
                             @endphp
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->fullday=='Y')
                                        {{number_format($subTotalHarian)}}
                                    @else
                                        {{ '-' }}
                                    @endif  
                                @endforeach
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>- Paket Fullboard</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->fullboard=='Y')
                                        {{$hari}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                            </td>
                            <td>hari &nbsp; x &nbsp;Rp.</td>
                            <td style="text-align: right;">
                                @php
                                    $fullboardMoney = $isi->hitfullb;
                                @endphp
                                @if ($isi->fullboard=='Y')
                                    {{number_format($fullboardMoney)}}
                                @else
                                    {{ '-' }}
                                @endif
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                            @php
                                 $subTotalHarian = $hari*$fullboardMoney;    
                             @endphp
                            <td style="text-align: right;">
                               @foreach ($tr as $isi)
                                    @if ($isi->fullboard=='Y')
                                        {{number_format($subTotalHarian)}}
                                    @else
                                        {{ '-' }}
                                    @endif
                               @endforeach
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </td>
                @php
                    $subTotal += $subTotalHarian;
                @endphp
                <td class="isi">Rp. 
                    {{number_format($subTotal)}}&nbsp;&nbsp;
                </td>
                <td class="isi"></td>
            </tr>
            <tr>
                <td class="isi" style="text-align: center">3</td>
                <td class="isi">
                    <table style="width: 100%;" class="kepala">
                        <tr>
                            <td colspan="7">Biaya Pertemuan di Kota
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
                            </td>
                        </tr>
                        <tr>
                            <td>- Paket Halfday / Fullday</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->dayshalf!=null)
                                        {{$hari}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                            <td>hari . Rp.</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->dayshalf!=null)
                                        @php
                                            $biaya = $isi->feehalf;
                                        @endphp
                                        {{$biaya}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->dayshalf!=null)
                                        {{$biaya}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>- Paket Fullboard</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->daysfull!=null)
                                        {{$hari}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->daysfull!=null)
                                        @php
                                            $biaya = $isi->feefull;
                                        @endphp
                                        {{$biaya}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isi)
                                    @if ($isi->daysfull!=null)
                                        {{$biaya}}
                                    @else
                                        {{ '-' }}
                                    @endif
                                @endforeach
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="isi">Rp. &nbsp;&nbsp;

                </td>
                <td class="isi"></td>
            </tr>
            <tr>
                <td class="isi" style="text-align: center">4</td>
                <td class="isi">
                    <table style="width: 100%;" class="kepala">
                        <tr>
                            <td colspan="7">Biaya Penginapan di kota
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
                            </td>
                        </tr>
                        <tr>
                            @php
                                $subTotal = 0;
                            @endphp


                            <td>
                                @foreach ($lain as $nom)
                                    @if ($nom->innname_1 != null)
                                        - {{$nom->innname_1}} &nbsp;
                                    @elseif($nom->innname_2 != null)
                                        - {{$nom->innname_1}} &nbsp;<br>
                                        - {{$nom->innname_2}} &nbsp;
                                    @else
                                        - &nbsp;
                                    @endif
                                @endforeach
                            </td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($lain as $nom)
                                    @if ($nom->innname_1 != null)
                                        @php
                                            $long1 = $nom->long_stay_1;
                                            $long2 = $nom->long_stay_2;
                                            $fee1 = $nom->inn_fee_1;
                                            $fee2 = $nom->inn_fee_2;
                                        @endphp
                                        
                                        - {{$long1}} &nbsp;
                                    @elseif($nom->innname_2 != null)
                                        - {{$long1}} &nbsp; <br>
                                        - {{$long2}} &nbsp;
                                    @else
                                        - &nbsp;
                                    @endif
                                @endforeach
                            </td>
                            <td>hari x Rp. <br> hari x Rp. </td>
                            <td style="text-align: right;">
                                @foreach ($lain as $nom)
                                    @if ($nom->innname_1 != null)
                                        - {{$fee1}} &nbsp;
                                    @elseif($nom->innname_2 != null)
                                        - {{$fee1}} &nbsp; <br>
                                        - {{$fee2}} &nbsp;
                                    @else
                                        - &nbsp;
                                    @endif
                                @endforeach
                            </td>
                            <td>. Rp. <br> Rp.  </td>
                            <td style="text-align: right;">
                                @php
                                    $jum1 = $long1*$fee1;
                                    $jum2 = $long2*$fee2;
                                @endphp
                                @foreach ($lain as $nom)
                                    @if ($nom->innname_1 != null)
                                        {{number_format($jum1)}} &nbsp;
                                    @elseif($nom->innname_2 != null)
                                        {{number_format($jum1)}} &nbsp; <br>
                                        {{number_format($jum2)}}  &nbsp;
                                    @else
                                        - &nbsp;
                                    @endif
                            @endforeach  
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="isi">Rp. &nbsp;&nbsp;
                    @php
                        $subTotal = $jum1+$jum2;
                    @endphp
                        {{number_format($subTotal)}}
                </td>
                <td class="isi">
                    @foreach ($lain as $nom)
                        @if ($nom->innname_1 != null)
                           1 Kamar {{$nom->isi_1}} orang
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td class="isi" style="text-align: center">5</td>
                <td class="isi">
                    <table style="width: 100%;" class="kepala">
                        <tr>
                            @php
                                $subTotal = 0;
                            @endphp
                            @foreach ($tujuan as $key=>$hr)
                                @php
                                    $hari += $hr->longday;
                                    $destinId = $hr->destination_id;
                                @endphp
                            @endforeach
                            <td>Uang Representatif Eselon II</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                @foreach ($tr as $isian)
                                        @if ($isian->representatif=='Y')
                                            {{$hari}}
                                        @else
                                            {{ '-' }}
                                        @endif
                                @endforeach
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">
                                @php
                                    $eselonMoney = $isi->hitrep;
                                @endphp
                                @if ($isian->representatif=='Y')
                                    {{number_format($eselonMoney)}}
                                @else
                                    {{ '-' }}
                                @endif
                                &nbsp;
                            </td>
                            <td>. Rp.</td>
                            @php
                                 $subTotalHarian = $hari*$eselonMoney;    
                             @endphp
                            <td style="text-align: right;">
                                @if ($isian->representatif=='Y')
                                    {{number_format($subTotalHarian)}}
                                @else
                                    {{ '-' }}
                                @endif
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="isi">Rp. &nbsp;&nbsp;
                    @php
                        $subTotal += $subTotalHarian;
                    @endphp
                    @if ($isian->representatif=='Y')
                        {{number_format($subTotal)}}
                    @else
                        {{ '-' }}
                    @endif
                    &nbsp;
                    
                </td>
                <td class="isi"></td>
            </tr>
            <tr>
                <td class="isi"></td>
                <td class="isi"><b><i>Jumlah Biaya Perjalanan :</i></b>
                </td>
                    @php
                        $totalPerjalanan += $subTotal;
                    @endphp
                <td class="isi">Rp. 
                    {{number_format($totalPerjalanan)}}
                </td>
                <td class="isi"> </td>
            </tr>
            <tr>
                <td class="isi"></td>
                <td class="isi" colspan="3" style = "text-transform:capitalize";>
                   <i> Terblang : <b>{{terbilang($totalPerjalanan)}} Rupiah</b></i>
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
        <td></td>
        <td>Telah di bayar sejumlah : Rp. {{number_format($totalPerjalanan)}}</td>
        <td>Telah menerima jumlah uang sebesar : Rp. {{number_format($totalPerjalanan)}}</td>
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
        </td>
    </tr>
   </table>
   <hr style="border:1px solid black;">
   <p style="font-size: 10; text-align:center;"><b>PERHITUNGAN SPPD RAMPUNG</b></p>
   <table style="width: 100%;" class="kepala">
        <tr>
            <td style="width: 20%"></td>
            <td style="width: 23%">Ditetapkan sejumlah</td>
            <td  style="width: 3%"><b>Rp. </b></td>
            <td class="isi" style="text-align: right">{{number_format($totalPerjalanan)}}</td>
            <td style="text-align: center; width:40%">{{$item->out->ppk->jabatan}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Yang telah dibayar semula</td>
            <td><b>Rp. </b></td>
            <td class="isi" style="text-align: right">{{number_format($totalPerjalanan)}}</td>
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
            <td colspan ="5" style="text-align:center;">almagfghfghfgh</td>
        </tr>
   </table>
</body>

@endforeach

</html>