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
            size:8.5in 13in;
            font-family: 'Times New Roman';
            /* margin-top: 30px;
            margin-bottom: 15px; */
            line-height: 1;
            page-break-after: always;
            page-break-before: always;
            font-size: 10;
        }
        body{
            page-break-after: always;
            page-break-before: always;
        }
        table{
            width: 100%;
        }
        th{
            text-align: center;
            letter-spacing: 2px;
            border: 1px solid black;
        }

        .isi{
            font-family: 'Times New Roman';
            /* border: 1px solid black; */
            vertical-align : top;
            line-height: 1;

        }

        </style>

</head>
@php
    $no=1;
@endphp
@foreach ($pegawai as $item)
<body>
    <div style="page-break-before: always;">
        <table>
            <tr>
                <td style="width: 50%;text-align:center; vertical-align:bottom; padding-right:10%;" >
                    <img src="{{asset('images/bbpom.jpg')}}" style="height:100px"> <br>
                   <b style="line-height: 1;">BALAI BESAR PENGAWAS OBAT DAN MAKANAN<br>
                    DI BANJARMASIN <br>
                    </b>
                    Jl. Brigjend H.Hasan Basri No.40 Banjarmasin<br>
                </td>
                <td style="width:50%; padding-left: 7%; line-height: 1; font-size: 7;">
                    LAMPIRAN II <br>
                    PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA <br>
                    NOMOR 113/PMK.05/2012 <br>
                    TENTANG <br>
                    PERJALANAN DINAS JABATAN DALAM NEGERI BAGI PEJABAT<br>
                    NEGARA, PEGAWAI NEGERI DAN PEGAWAI TIDAK TETAP <br>
                    <table style="font-size: 7; line-height: 1;">
                        <tr>
                            <td>
                                <br>
                                Bukti Kas <br>
                                Tahun Anggaran <br>
                                Program/Kegiatan <br>
                                KRO/RO/Komponen <br>
                                Sub Komponen/Akun
                            </td>
                            <td>
                                : ............................ <br>
                                : {{$item->out->pok->pok->year}} <br>
                                : {{$item->out->pok->pok->act->prog->unit->klcode->code}}.{{$item->out->pok->pok->act->prog->unit->code}}.
                                    {{$item->out->pok->pok->act->prog->code}} / {{$item->out->pok->pok->act->code}}<br>
                                : {{$item->out->pok->sub->komponen->det->unit->code}} / {{$item->out->pok->sub->komponen->det->code}} / 
                                    {{$item->out->pok->sub->komponen->code}} <br>
                                : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2"style="text-align:center; padding-top:30px;line-height:1.5">
                    <b style="font-size: 12;"><u>RINCIAN BIAYA PERJALANAN DINAS</u><br> &nbsp;</b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="line-height: 1;">
                        <tr>
                            <td style="width: 20%">Berdasarkan Surat Tugas</td>
                            <td>:
                                {{$item->out->number}}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%">Lampiran SPD Nomor</td>
                            <td>:
                                {{$item->no_sppd}}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:
                                {{tgl_indo($item->out->st_date)}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table class="isi" style="border: 1px solid black;">
            <thead>
                <tr style="border: 1px solid black;">
                    <th class="isi" style="width: 5%">No.</th>
                    <th class="isi">Daftar Perincian</th>
                    <th class="isi" style="width: 12%">Jumlah</th>
                    <th class="isi" style="width: 15%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nomor          = 0; 
                    $SubTotal       = 0;
                    $jumlahSub      = 0; 
                    $datapesawat    = $InjectNew->BiayaPesawat($item->id);
                    $dataUH         = $InjectNew->BiayaUHAR($item->id);
                    $dataTR         = $InjectNew->BiayaTr($item->id);
                    $dataInn        = $InjectNew->BiayaInn($item->id);
                @endphp

                {{----------- Transport -----------}}
                <tr>
                    <td class="isi" style="text-align: center; width: 5%; border-right: 1px solid black;">
                        @php
                            $nomor++;
                        @endphp
                        {{$nomor}}
                    </td>
                    <td class="isi" style="border-right: 1px solid black;">
                        <i>Biaya Transport</i>
                        <table style="width: 100%">
                            @if ($datapesawat != null)
                                @foreach ($datapesawat as $tiket)
                                <tr>
                                    <td  style="width: 20%;"><i> Tiket {{$tiket->planetype}}</i></td>
                                    <td style="width: 20%;">
                                       <i> {{$tiket->plane->name}}</i>
                                    </td>
                                    <td style="text-align: center; width:5%;"><i>:</i> </td>
                                    <td style="text-align: center; width: 5%;"></td>
                                    <td style="text-align: center; width: 15%;"></td>
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
                                    <td style="width: 20%">&nbsp;</td>
                                    <td style="text-align: center; width:5%;"><i>:</i> </td>
                                    <td style="text-align: center; width: 5%;">
                                        <i>{{$trans->taxicount}}</i>
                                    </td>
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. </i></td>
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
                    <td class="isi" style="text-align: center; width: 10%; border-right: 1px solid black;">
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
                    <td class="isi" style="text-align: center" style="width: 15%; border-right: 1px solid black;"></td>
                </tr>

                @if ($data->st->type!="DL")

                    {{----------- UH -----------------}}
                    <tr>
                        <td class="isi" style="text-align: center; width: 5%; border-right: 1px solid black;">
                            @php
                                $nomor++;
                            @endphp
                            {{$nomor}}
                        </td>
                        <td class="isi" style="border-right: 1px solid black;">
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
                                @if ($data->st->type=="LK" && $dataUH->uhar1kali != 0)
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
                                            @endif
                                        </i>
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
                                    <td style="text-align: center; width: 15%;">
                                        <i>
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
                                        </i>
                                    </td>
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
                                    <td style="text-align: center; width: 5%;">
                                        <i>
                                            @if (count($item->out->outst_destiny) == 1)
                                                . Rp.
                                            @elseif (count($item->out->outst_destiny) == 2)
                                                . Rp.<br>
                                                . Rp.
                                            @else
                                                . Rp.<br>
                                                . Rp.<br>
                                                . Rp.
                                            @endif
                                        </i>
                                    </td>
                                    <td style="text-align: right; width: 15%;"> 
                                        <i>
                                            @if (count($item->out->outst_destiny) == 1)
                                                @foreach ($tujuan as $key=>$kota)
                                                    @if ($loop->first)
                                                        {{number_format($dataUH->uhar1sum)}}&nbsp;
                                                    @endif
                                                @endforeach
                        
                                            @elseif (count($item->out->outst_destiny) == 2)
                                                {{-- @foreach ($tujuan as $key=>$kota) --}}
                                                    {{number_format($dataUH->uhar1sum)}}&nbsp;<br>
                                                    {{number_format($dataUH->uhar2sum)}}&nbsp;
                                                {{-- @endforeach --}}
                        
                                            @else
                                                {{-- @foreach ($tujuan as $key=>$kota) --}}
                                                    {{number_format($dataUH->uhar1sum)}}<br>
                                                    {{number_format($dataUH->uhar2sum)}}<br>
                                                    {{number_format($dataUH->uhar2sum)}}
                                                {{-- @endforeach --}}
                                            @endif 
                                        </i> &nbsp; 
                                    </td>
                                </tr>

                                @elseif ($data->st->type=="DL8")
                                <tr>
                                    <td style="width: 30%">
                                        <i>- Uang Harian DK > 8 Jam</i>
                                    </td>
                                    <td style="width: 10%">
                                        <i>&nbsp;</i>
                                    </td>
                                    <td style="text-align: center; width:5%;"><i>:</i> </td>
                                    <td style="text-align: center; width: 5%;">
                                        <i>
                                            {{$dataUH->tlokalkali}}
                                        </i>
                                    </td>
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                                        </i> &nbsp; 
                                    </td>
                                </tr>
                                @endif

                                @if ($dataUH->diklatsum != 0)
                                <tr>
                                    <td style="width: 20%">
                                        <i>- Uang Saku Diklat</i>
                                    </td>
                                    <td style="width: 20%">
                                        <i>&nbsp;</i>
                                    </td>
                                    <td style="text-align: center; width:5%;"><i>:</i> </td>
                                    <td style="text-align: center; width: 5%;">
                                        <i>
                                            {{$dataUH->diklatkali}}
                                        </i>
                                    </td>
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                                        </i> &nbsp; 
                                    </td>
                                </tr>
                                @endif

                                @if ($dataUH->fulldaysum != 0)
                                <tr>
                                    <td style="width: 20%">
                                        <i>- Uang Saku Fullday</i>
                                    </td>
                                    <td style="width: 20%">
                                        <i>&nbsp;</i>
                                    </td>
                                    <td style="text-align: center; width:5%;"><i>:</i> </td>
                                    <td style="text-align: center; width: 5%;">
                                        <i>
                                            {{$dataUH->fulldaykali}}
                                        </i>
                                    </td>
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                                        </i> &nbsp; 
                                    </td>
                                </tr>
                                @endif

                                @if ($dataUH->fullboardsum != 0)
                                <tr>
                                    <td colspan="2">
                                        <i>- Uang Saku Fullboard</i>
                                    </td>
                                    <td style="text-align: center; width:5%;"><i>:</i> </td>
                                    <td style="text-align: center; width: 5%;">
                                        <i>
                                            {{$dataUH->fullboardkali}}
                                        </i>
                                    </td>
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                                        </i> &nbsp; 
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </td>
                        <td class="isi" style="text-align: center; width: 10%; border-right: 1px solid black;">
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
                        <td class="isi" style="text-align: center" style="width: 15%; border-right: 1px solid black;"></td>
                    </tr>

                    {{----------- Pertemuan --------------}}
                    @if ($dataUH->halfsum != 0 || $dataUH->fullsum != 0 || $dataUH->fbsum != 0)
                    <tr>
                        <td class="isi" style="text-align: center; width: 5%; border-right: 1px solid black;">
                            @php
                                $nomor++;
                            @endphp
                            {{$nomor}}

                        </td>
                        <td class="isi" style="border-right: 1px solid black;">
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
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                        <td class="isi" style="text-align: center; width: 10%; border-right: 1px solid black;">
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
                        <td class="isi" style="text-align: center" style="width: 15%; border-right: 1px solid black;"></td>
                    </tr>
                    @endif
                    {{----------- Penginapan -----------}}
                    @if ($dataInn != null)
                    <tr>
                        <td class="isi" style="text-align: center; width: 5%; border-right: 1px solid black;">
                            @php
                                $nomor++;
                            @endphp
                            {{$nomor}}

                        </td>
                        <td class="isi" style="border-right: 1px solid black;">
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
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                            </table>
                        </td>
                        <td class="isi" style="text-align: center; width: 10%; border-right: 1px solid black;">
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
                        <td class="isi" style="text-align: center" style="width: 15%; border-right: 1px solid black;">
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
                    @else
                    <tr>
                        <td style="border-right: 1px solid black;"><br><br><br><br><br></td>
                        <td style="border-right: 1px solid black;"></td>
                        <td style="border-right: 1px solid black;"></td>
                        <td style="border-right: 1px solid black;"></td>
                    </tr>
                    @endif

                    {{----------- Representatif -----------------}}
                    @if ($dataUH->repssum != 0)
                    <tr>
                        <td class="isi" style="text-align: center; width: 5%; border-right: 1px solid black;">
                            @php
                                $nomor++;
                            @endphp
                            {{$nomor}}
                        </td>
                        <td class="isi" style="border-right: 1px solid black;">
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
                                    <td style="text-align: center; width: 15%;"><i> &nbsp; hari &nbsp;&nbsp;x&nbsp;&nbsp;Rp. </i></td>
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
                        <td class="isi" style="text-align: center; width: 10%; border-right: 1px solid black;">
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
                        <td class="isi" style="text-align: center" style="width: 15%; border-right: 1px solid black;"></td>
                    </tr>
                    @else
                    <tr>
                        <td style="border-right: 1px solid black;"><br><br></td>
                        <td style="border-right: 1px solid black;"></td>
                        <td style="border-right: 1px solid black;"></td>
                        <td style="border-right: 1px solid black;"></td>
                    </tr>
                    @endif

                @else
                    <tr>
                        <td style="border-right: 1px solid black;"><br>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                        <td style="border-right: 1px solid black;"></td>
                        <td style="border-right: 1px solid black;"></td>
                        <td style="border-right: 1px solid black;"></td>
                    </tr>
                @endif

                {{----------- FOOTER -----------}}
                <tr style="border: 1px solid black;">
                    <td class="isi" style="text-align: center;width: 5%;border-right: 1px solid black;"></td>
                    <td class="isi" style="border-right: 1px solid black;">
                        <i><b>Jumlah Biaya Perjalanan</b></i>
                    </td>
                    <td class="isi" style="text-align: center;width: 10%; border-right: 1px solid black;">
                        <table>
                            <tr>
                                <td style="text-align: right; width:10%"><i>Rp.</i></td>
                                <td style="text-align: right;"><i>
                                    {{number_format($jumlahSub)}},-
                                </i> &nbsp;&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td class="isi" style="text-align: center;width: 15%;border-right: 1px solid black;"></td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td class="isi" style="text-align: center" style="width: 5%"></td>
                    <td class="isi" colspan="3" style="text-transform: capitalize;">
                        <i>Terbilang : <b>{{terbilang($jumlahSub)}} Rupiah</b></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table>
            <tr>
                <td style="width: 50%; padding-left:15%">
                    <br>
                    Telah di bayar sejumlah <br>
                    @php
                        $total = $InjectNew->totalHarga($item->id)
                    @endphp
                    <b>Rp. {{number_format($total)}},-</b> <br> &nbsp;
                </td>
                <td style="padding-left:10%">
                    Banjarmasin, {{tgl_indo($data->date)}} <br>
                    Telah menerima jumlah uang sebesar <br>
                    <b>Rp. {{number_format($total)}},- </b> <br> &nbsp;
                </td>
            </tr>
            <tr>
                <td style="padding-left:15%;">
                    Bendahara Pengeluaran, <br><br><br><br>
    
                </td>
                <td style="padding-left:10%">
                    Yang menerima<br><br><br><br>
                </td>
            </tr>
            <tr>
                <td style="padding-left:15%;line-height: 1.3;">
                    <u>{{$petugas->user->name}}</u> <br>
                    NIP. {{$petugas->user->no_pegawai}}
                </td>
                <td style="line-height: 1.3;padding-left:10%;">
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
            <table>
                <tr>
                    <td style="width: 50%; padding-left:15%;"> Ditetapkan Sejumlah
                    </td>
                    <td style="width: 50%;font-weight:bold;">
                        : Rp. {{number_format($total)}}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:15%;">Yang telah dibayar semula</td>
                    <td style="font-weight:bold;">
                        : Rp. {{number_format($total)}}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:15%;">Sisa kurang/lebih</td>
                    <td style="font-weight:bold;">:
                        Nihil
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <br><br>
                        Pejabat Pembuat Komitmen
                        <br><br><br><br>
                        @if ($item->out->ppk_id != 0)
                            <u>{{$item->out->ppk->user->name}}</u> <br>
                            NIP. {{$item->out->ppk->user->no_pegawai}}
                        @endif
                    </td>
                </tr>
            </table>
            <br><br>
            <table>
                <tr>
                    <td style="text-align:center; letter-spacing: 2px; ">BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        Jl. Brigjend H. Hasan Basri No. 40 Banjarmasin - 70247 Telp (0511) 3304286, 3305115 ; Fax (0511) 3302162
                    </td>
                </tr>
            </table>
        </div>
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