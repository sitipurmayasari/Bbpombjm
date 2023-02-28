@inject('InjectNew', 'App\InjectNew')
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
                <td style="width: 20%">Akun</td>
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
                        $total = $InjectNew->totalHarga($item->id)
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
            <td style="width: 20%">
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
                @if ($item->pegawai->golongan_id != null)
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
            <td>
                @if ($item->out->ppk_id != 0)
                    {{$item->out->ppk->jabatan}} 
                @else
                    pejabat Pembuat Komitmen
                @endif
                <br><br><br><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td style="line-height: 1.3;">
                <u>{{$petugas->user->name}}</u> <br>
                NIP. {{$petugas->user->no_pegawai}}
            </td>
            <td style="line-height: 1.3;">
                @if ($item->out->ppk_id != 0)
                    <u>{{$item->out->ppk->user->name}}</u> <br>
                    NIP. {{$item->out->ppk->user->no_pegawai}}
                @endif
               
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
        @php
            $SubTotal       = 0;
            $jumlahSub      = 0; 
            $datapesawat    = $InjectNew->BiayaPesawat($item->id);
            $dataUH         = $InjectNew->BiayaUHAR($item->id);
            $dataTR         = $InjectNew->BiayaTr($item->id);
            $dataInn        = $InjectNew->BiayaInn($item->id);
        @endphp
        {{----------- Transport -----------}}
        <tr>
            <td class="isi" style="text-align: center; width: 5%">1</td>
            <td class="isi">
               <i>Biaya Transport</i>
               <table style="width: 100%">
                @if ($datapesawat != null)
                    @foreach ($datapesawat as $tiket)
                    <tr>
                        <td  style="width: 20%"><i> Tiket {{$tiket->planetype}}</i></td>
                        <td style="width: 20%">
                           <i> {{$tiket->plane->name}}</i>
                        </td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;"></td>
                        <td style="text-align: center; width: 15;"></td>
                        <td style="text-align: right; width: 15%;"></td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($tiket->ticketfee)}}
                            </i> &nbsp; 
                        </td>
                    </tr>
                    @endforeach
                @endif
                @if ($dataTR != null)
                    @foreach ($dataTR as $trans)
                    <tr>
                        <td  style="width: 20%">
                            <i>{{$trans->taxitype}}</i>
                        </td>
                        <td style="width: 20%"></td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            <i>{{$trans->taxicount}}</i>
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>{{number_format($trans->taxifee)}}</i>
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($trans->taxisum)}}
                            </i> &nbsp; 
                        </td>
                    </tr>
                    @endforeach
                @endif
               </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 10%">
                @php
                    $TotTR      = $InjectNew->SumTR($item->id);
                    $SubTotal   = $TotTR; 
                    $jumlahSub  += $SubTotal;   
                @endphp
                <table>
                    <tr>
                        <td style="text-align: right; width:10%"><i>Rp.</i></td>
                        <td style="text-align: right;"><i>
                            @if ($TotTR != 0)
                                {{number_format($TotTR)}},-
                            @else
                                -
                            @endif
                        </i> &nbsp;&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 15%"></td>
        </tr>
        {{----------- Uang Harian -----------}}
        <tr>
            <td class="isi" style="text-align: center" style="width: 5%">2</td>
            <td class="isi">
                <i>Uang Harian di Kota 
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
                <table style="width: 100%">
                    @if ($data->st->type=="LK")
                        <tr>
                            <td style="width: 20%">
                            <i>
                                @if (count($item->out->outst_destiny) == 1)
                                    @foreach ($tujuan as $key=>$kota)
                                        @if ($loop->first)
                                            - Uang Harian
                                        @endif
                                    @endforeach

                                @elseif (count($item->out->outst_destiny) == 2)
                                    {{-- @foreach ($tujuan as $key=>$kota) --}}
                                        - Uang Harian <br>
                                        - Uang Harian
                                    {{-- @endforeach --}}

                                @else
                                    {{-- @foreach ($tujuan as $key=>$kota) --}}
                                        - Uang Harian <br>
                                        - Uang Harian <br>
                                        - Uang Harian
                                    {{-- @endforeach --}}
                                @endif 
                            </i>
                            </td>
                            <td style="width: 20%">
                                <i>@if (count($item->out->outst_destiny) == 1)
                                    @foreach ($tujuan as $key=>$kota)
                                        @if ($loop->first)
                                            {{$kota->destiny->capital}} 
                                        @endif
                                    @endforeach

                                @elseif (count($item->out->outst_destiny) == 2)
                                    @foreach ($tujuan as $key=>$kota)
                                        {{$kota->destiny->capital}}
                                        @if ($tujuan->count()-1 != $key)
                                            <br>
                                        @endif
                                    @endforeach

                                @else
                                    @foreach ($tujuan as $key=>$kota)
                                        @if ($loop->last-1)
                                            {{$kota->destiny->capital}} <br>
                                        @endif
                                        @if ($loop->last)
                                            <br>{{$kota->destiny->capital}}
                                        @endif
                                        
                                    @endforeach
                                @endif </i>
                            </td>
                            <td style="text-align: center; width:5%;"><i>:</i> </td>
                            <td style="text-align: center; width: 5%;">
                                <i>
                                    @if (count($item->out->outst_destiny) == 1)
                                        @foreach ($tujuan as $key=>$kota)
                                            @if ($loop->first)
                                                {{$dataUH->uhar1kali}}
                                            @endif
                                        @endforeach

                                    @elseif (count($item->out->outst_destiny) == 2)
                                            {{$dataUH->uhar1kali}} <br>
                                            {{$dataUH->uhar2kali}}

                                    @else
                                            {{$dataUH->uhar1kali}} <br>
                                            {{$dataUH->uhar2kali}} <br>
                                            {{$dataUH->uhar3kali}}
                                    @endif 
                                </i>
                            </td>
                            <td style="text-align: center; width: 15;"><i>
                                @if (count($item->out->outst_destiny) == 1)
                                    &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. 

                                    @elseif (count($item->out->outst_destiny) == 2)
                                        &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. <br>
                                        &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. 

                                    @else
                                        &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. <br>
                                        &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. <br>
                                        &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp.
                                    @endif 
                                
                                </i></td>
                            <td style="text-align: right; width: 15%;"> 
                                <i>
                                    @if (count($item->out->outst_destiny) == 1)
                                        @foreach ($tujuan as $key=>$kota)
                                            @if ($loop->first)
                                                {{number_format($dataUH->uhar1cost)}}
                                            @endif
                                        @endforeach

                                    @elseif (count($item->out->outst_destiny) == 2)
                                        {{number_format($dataUH->uhar1cost)}} <br>
                                        &nbsp;{{number_format($dataUH->uhar2cost)}}
                                    @else
                                            {{number_format($dataUH->uhar1cost)}} <br>
                                            &nbsp;{{number_format($dataUH->uhar2cost)}} <br>
                                            &nbsp;{{number_format($dataUH->uhar3cost)}}
                                    @endif 
                                </i>
                                &nbsp;
                            </td>
                            <td style="text-align: center; width: 5%;"><i>
                                @if (count($item->out->outst_destiny) == 1)
                                . Rp.

                            @elseif (count($item->out->outst_destiny) == 2)
                                . Rp. <br>
                                . Rp.

                            @else
                                . Rp. <br>
                                . Rp. <br>
                                . Rp.
                            @endif 

                                
                            </i></td>
                            <td style="text-align: right; width: 15%;"> 
                                <i>
                                    @if (count($item->out->outst_destiny) == 1)
                                        @foreach ($tujuan as $key=>$kota)
                                            @if ($loop->first)
                                                {{number_format($dataUH->uhar1sum)}}
                                            @endif
                                        @endforeach

                                    @elseif (count($item->out->outst_destiny) == 2)
                                        {{-- @foreach ($tujuan as $key=>$kota) --}}
                                            {{number_format($dataUH->uhar1sum)}} <br>
                                            {{number_format($dataUH->uhar2sum)}}
                                        {{-- @endforeach --}}

                                    @else
                                        {{-- @foreach ($tujuan as $key=>$kota) --}}
                                            {{number_format($dataUH->uhar1sum)}} <br>
                                            {{number_format($dataUH->uhar2sum)}} <br>
                                            {{number_format($dataUH->uhar2sum)}}
                                        {{-- @endforeach --}}
                                    @endif 
                                </i> &nbsp; 
                            </td>
                        </tr>
                    @elseif ($data->st->type=="DL8")
                        <tr>
                            <td style="width: 40%">
                                <i>- Uang Harian DK > 8 Jam</i>
                            </td>
                            <td style="text-align: center; width:5%;"><i>:</i> </td>
                            <td style="text-align: center; width: 5%;">
                                <i>
                                    {{$dataUH->tlokalkali}}
                                </i>
                            </td>
                            <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                            <td style="text-align: right; width: 15%;"> 
                                <i>
                                    {{number_format($dataUH->tlokalcost)}}
                                </i>
                                &nbsp;
                            </td>
                            <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                            <td style="text-align: right; width: 15%;"> 
                                <i>
                                    {{number_format($dataUH->tlokalsum)}}
                                </i> 
                                </i> &nbsp; 
                            </td>
                        </tr>
                    @endif
                    @if ($dataUH->diklatsum != 0)<tr>
                        <td style="width: 40%">
                            <i>- Uang Saku Diklat</i>
                        </td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            <i>
                                {{$dataUH->diklatkali}}
                            </i>
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->diklatcost)}}
                            </i>
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->diklatsum)}}
                            </i> 
                            </i> &nbsp; 
                        </td>
                    </tr>
                    @endif
                    @if ($dataUH->fulldaysum != 0)<tr>
                        <td style="width: 40%">
                            <i>- Uang Saku  Half/Fullday</i>
                        </td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            <i>
                                {{$dataUH->fulldaykali}}
                            </i>
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->fulldaycost)}}
                            </i>
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->fulldaysum)}}
                            </i> 
                            </i> &nbsp; 
                        </td>
                    </tr>
                    @endif
                    @if ($dataUH->fullboardsum != 0)<tr>
                        <td style="width: 40%">
                            <i>- Uang Saku Fullboard</i>
                        </td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            <i>
                                {{$dataUH->fullboardkali}}
                            </i>
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->fullboardcost)}}
                            </i>
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->fullboardsum)}}
                            </i> 
                            </i> &nbsp; 
                        </td>
                    </tr>
                    @endif
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 10%">
                @php
                    $TotUH      = $InjectNew->SumUH($item->id);
                    $SubTotal   = $TotUH; 
                    $jumlahSub      += $SubTotal;   
                @endphp
                <table>
                    <tr>
                        <td style="text-align: right; width:10%"><i>Rp.</i></td>
                        <td style="text-align: right;"><i>
                            @if ($TotUH != 0)
                            {{number_format($TotUH)}},-
                            @else
                                -
                            @endif
                        </i> &nbsp;&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 15%"></td>
        </tr>
        {{----------- Pertemuan -----------}}
        <tr>
            <td class="isi" style="text-align: center" style="width: 5%">3</td>
            <td class="isi">
                <i>Biaya Pertemuan di Kota 
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
                <table style="width: 100%">
                    @if ($dataUH->halfsum != 0)<tr>
                        <td style="width: 20%">
                            <i>- Paket Halfday</i>
                        </td>
                        <td style="width: 20%"></td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            <i>
                                {{$dataUH->halflong}}
                            </i>
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->halfcost)}}
                            </i>
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->halfsum)}}
                            </i> 
                            </i> &nbsp; 
                        </td>
                    </tr>
                    @endif
                    @if ($dataUH->fullsum != 0)<tr>
                        <td style="width: 20%">
                            <i>- Paket Fullday</i>
                        </td>
                        <td style="width: 20%"></td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            <i>
                                {{$dataUH->fulllong}}
                            </i>
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->fullcost)}}
                            </i>
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->fullsum)}}
                            </i> 
                            </i> &nbsp; 
                        </td>
                    </tr>
                    @endif
                    @if ($dataUH->fbsum != 0)<tr>
                        <td style="width: 20%">
                            <i>- Paket Fullboard</i>
                        </td>
                        <td style="width: 20%"></td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            <i>
                                {{$dataUH->fblong}}
                            </i>
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->fbcost)}}
                            </i>
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                {{number_format($dataUH->fbsum)}}
                            </i> 
                            </i> &nbsp; 
                        </td>
                    </tr>
                    @endif
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 10%">
                @php
                    $TotMeet    = $InjectNew->SumMeet($item->id);
                    $SubTotal   = $TotMeet; 
                    $jumlahSub  += $SubTotal;   
                @endphp
                <table>
                    <tr>
                        <td style="text-align: right; width:10%"><i>Rp.</i></td>
                        <td style="text-align: right;"><i>
                            @if ($TotMeet != 0)
                            {{number_format($TotMeet)}},-
                            @else
                                -
                            @endif
                        </i> &nbsp;&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 15%"></td>
        </tr>
        {{----------- Penginapan -----------}}
        <tr>
            <td class="isi" style="text-align: center" style="width: 5%">4</td>
            <td class="isi">
                <i>Biaya Penginapan di Kota 
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
                <table style="width: 100%">
                    @if ($dataInn != null)
                        @foreach ($dataInn as $hotel)
                        <tr>
                            <td  style="width: 20%">
                                <i>{{$hotel->hotelname}}</i>
                            </td>
                            <td style="width: 20%"></td>
                            <td style="text-align: center; width:5%;"><i>:</i> </td>
                            <td style="text-align: center; width: 5%;">
                                <i>{{$hotel->hotellong}}</i>
                            </td>
                            <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                            <td style="text-align: right; width: 15%;"> 
                                <i>
                                    @php
                                        $fee = $hotel->hotelfee;
                                        $long = $hotel->person;
                                        $jum = $fee/$long;
                                    @endphp
                                    {{number_format($jum)}}
                                </i>
                                &nbsp;
                            </td>
                            <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                            <td style="text-align: right; width: 15%;"> 
                                <i>
                                    {{number_format($hotel->hotelsum)}}
                                </i> &nbsp; 
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 10%">
                @php
                    $TotInn    = $InjectNew->SumInn($item->id);
                    $SubTotal   = $TotInn; 
                    $jumlahSub += $SubTotal;   
                @endphp
                <table>
                    <tr>
                        <td style="text-align: right; width:10%"><i>Rp.</i></td>
                        <td style="text-align: right;"><i>
                            @if ($TotInn != 0)
                            {{number_format($TotInn)}},-
                            @else
                                -
                            @endif
                        </i> &nbsp;&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 15%">
                @if ($dataInn != null)
                    <br>
                    <table style="width: 100%">
                        @foreach ($dataInn as $kethotel)
                        <tr>
                            <td>
                                1 kamar {{$kethotel ->person}} orang 
                            </td>
                        </tr>
                        @endforeach
                    </table>
                @endif
            </td>
        </tr>
        {{----------- Representatif -----------}}
        <tr>
            <td class="isi" style="text-align: center" style="width: 5%">5</td>
            <td class="isi">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 40%">
                            <i>Uang Representatif Eselon II</i>
                        </td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            <i>
                                @if ($dataUH->repssum != 0)
                                    {{$dataUH->repskali}}
                                @else
                                    -
                                @endif
                            </i>
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                @if ($dataUH->repssum != 0)
                                    {{number_format($dataUH->repscost)}}
                                @else
                                    -
                                @endif
                            </i>
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 15%;"> 
                            <i>
                                @if ($dataUH->repssum != 0)
                                    {{number_format($dataUH->repssum)}}
                                @else
                                    -
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                   
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 10%">
                @php
                    if ($dataUH->repssum != 0) {
                        $TotReps = $dataUH->repssum;
                    } else {
                        $TotReps = 0;
                    }
                    $SubTotal   = $TotReps; 
                    $jumlahSub      += $SubTotal;   
                @endphp
                <table>
                    <tr>
                        <td style="text-align: right; width:10%"><i>Rp.</i></td>
                        <td style="text-align: right;"><i>
                            @if ($TotReps != 0)
                            {{number_format($TotReps)}},-
                            @else
                                -
                            @endif
                        </i> &nbsp;&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 15%"></td>
        </tr>
        {{----------- FOOTER -----------}}
        <tr>
            <td class="isi" style="text-align: center" style="width: 5%"></td>
            <td class="isi">
                <i><b>Jumlah Biaya Perjalanan</b></i>
            </td>
            <td class="isi" style="text-align: center" style="width: 10%">
                <table>
                    <tr>
                        <td style="text-align: right; width:10%"><i>Rp.</i></td>
                        <td style="text-align: right;"><i>
                            {{number_format($jumlahSub)}},-
                        </i> &nbsp;&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td class="isi" style="text-align: center" style="width: 15%"></td>
        </tr>
        <tr>
            <td class="isi" style="text-align: center" style="width: 5%"></td>
            <td class="isi" colspan="3" style="text-transform: capitalize;">
                <i>Terbilang : <b>{{terbilang($jumlahSub)}} Rupiah</b></i>
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
            @if ($item->pegawai->golongan_id != null)
                NIP. {{$item->pegawai->no_pegawai}}
            @endif
        </td>
    </tr>
   </table>
    <hr style="border:0.5px solid black; margin: 7px;">
   <p style="font-size: 10; text-align:center;"><b>PERHITUNGAN SPD RAMPUNG</b></p>
   <div style="page-break-after: always;">
    <table style="width: 100%;" class="kepala">
        <tr>
            <td style="width: 20%"></td>
            <td style="width: 23%">Ditetapkan sejumlah</td>
            <td  style="width: 3%"><b>Rp. </b></td>
            <td class="isi" style="text-align: right">{{number_format($total)}}</td>
            <td style="text-align: center; width:40%">
                @if ($item->out->ppk_id != 0)
                    {{$item->out->ppk->jabatan}}
                @else
                    Pejabat Pembuat Komitmen
                @endif
            </td>
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
                @if ($item->out->ppk_id != 0)
                    <u>{{$item->out->ppk->user->name}}</u> <br>
                    NIP. {{$item->out->ppk->user->no_pegawai}}
                @endif
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