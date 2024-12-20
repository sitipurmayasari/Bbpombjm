@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>KKP</title>

    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 8;
            font-style: italic;
            margin-top: 20px;
            margin-bottom: 20px;
            line-height: 1;
        }
       
        #border{
            text-align: center;
            font-size: 10;
            line-height: 1;
            font-style: italic;
        }

        .isi{
            font-size: 8;
            font-family: 'Times New Roman';
            border: 1px solid black;
            vertical-align : top;
            line-height: 1.5;
        }

        .dalem {
            text-align: left;
            font-style: italic;
            font-size: 8;
            border-collapse: collapse;
            border: none;
            line-height: 1;

        }
        td{
            line-height:1;
        }
       


        </style>

</head>

@php
    $no=1;
@endphp
@foreach ($pegawai as $item)
<body>
    <table style="width: 100%">
        <tr>
            <td colspan="2" style="vertical-align: bottom; text-align: center;">
                <img src="{{asset('images/BBRI.jpg')}}" style="height:50px">
            </td>
            <td colspan="2" style="font-size: 6;">
                Lampiran<br>
                Peraturan Direktur Jenderal Perbendaharaan Nomor Per 37/PB/2007<br>
                tentang Petunjuk Pelaksanaan Perjalanan Dinas Jabatan Dalam Negeri <br>
                Bagi Pejabat Negara Pegawai Negeri Sipil dan pejabatn Tidak Tetap <br>
                Nomor 113/PMK.05/2012 &nbsp;&nbsp;&nbsp; Tgl. 23 Juli 2012
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;  font-size: 10; font-style: normal; line-height: 1;">
                BALAI BESAR PENGAWAS OBAT DAN MAKANAN
            </td>
            <td style="width: 18%;  font-size: 7; vertical-align:top;" rowspan="3">
                Beban MAK <br>
                Tahun Anggaran <br>
                Bukti Kas
            </td>
            <td style="width: 25%  font-size: 7;" rowspan="3">
                : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
                : {{$item->out->pok->pok->year}} <br>
                : ...............................
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; line-height: 1;">Di Banjarmasin</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;  font-size: 10; line-height: 1;"> 
                <b> DAFTAR PENGELUARAN KKP PENGINAPAN</b> 
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; line-height: 1;">Yang bertanda Tangan di Bawah ini :</td>
            <td style="font-size: 7;" rowspan="4">
                Program / Kegiatan <br>
                KRO/RO/Komponen <br>
                Sub Komponen / Akun <br>
                No. Surat Tugas <br>
                Petugas
            </td>
            <td style="font-size: 7;" rowspan="4">
                : {{$item->out->pok->pok->act->prog->unit->klcode->code}}.{{$item->out->pok->pok->act->prog->unit->code}}.
                    {{$item->out->pok->pok->act->prog->code}} / {{$item->out->pok->pok->act->code}} <br>
                : {{$item->out->pok->sub->komponen->det->unit->code}} / {{$item->out->pok->sub->komponen->det->code}} / 
                    {{$item->out->pok->sub->komponen->code}} <br>
                : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
                :  {{$item->out->number}} <br>
                : {{$no}}
            </td>
        </tr>
        <tr>
            <td style="width: 10%; line-height:1;">
                Nama
            </td>
            <td>
                : {{$item->pegawai->name}}
            </td>
        </tr>
        <tr>
            <td style="width: 10%; line-height:1;">
                NIP 
            </td>
            <td>
                :   @if ($item->pegawai->golongan_id != null)
                        {{$item->pegawai->no_pegawai}}
                    @else
                        -
                    @endif
            </td>
        </tr>
        <tr>
            <td style="width: 10%; line-height:1;">
                Jabatan 
            </td>
            <td style="line-height:1;">
                : 
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->jabasn->nama}}
                @else
                    {{$item->pegawai->deskjob}}
                @endif
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="width: 20%">Berdasarkan SPPD Nomor
            </td>
            <td> : 
                {{$item->no_sppd}}
            </td>
            <td style="width: 43%">
                Tanggal SPPD : {{tgl_indo($item->out->st_date)}}
            </td>
        </tr>
        <tr>
            <td>Untuk Perjalanan Dinas</td>
            <td colspan="2"> : dari
                <b>{{$item->out->cityfrom->capital}}</b> 
                ke 
                <b>
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
                </b> 
                selama
                {{$lama->hitung}}
                hari.
            </td>
        </tr>
    </table>
    <table style="width: 100%" class="isi">
        <thead>
            <tr>
                <th style="width: 5%; text-align:center;" class="isi">No.</th>
                <th style="width: 40%; letter-spacing: 2px; text-align:center; " class="isi">Uraian</th>
                <th style="width: 15%; letter-spacing: 2px; text-align:center;" class="isi">Jumlah</th>
                <th style="width: 30%; letter-spacing: 2px; text-align:center;" class="isi">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $bbm = 0;
                $nilai = $injectQuery->getDetail($item->id);
                $nilai2 = $injectQuery->getTr($item->id);
                $kkp = $injectQuery->getkkp($item->id);
            @endphp
            <tr>
                @php
                    $jum1 = 0;
                    $jum2 = 0;

                    if ($nilai->inn_fee_1 != 0 && $kkp->hotelkkp1 == 'Y') {
                       $inap1 = $nilai->inn_fee_1;
                    } else {
                        $inap1 = 0;
                    }

                    if ($nilai->inn_fee_2 != 0 && $kkp->hotelkkp2 == 'Y') {
                       $inap2 = $nilai->inn_fee_2;
                    } else {
                        $inap2 = 0;
                    }
                @endphp

                <td style="text-align: center;" class="isi">1</td>
                <td class="isi"> 
                    Biaya Penginapan : 
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
                    @endif <br>       
                    &nbsp;       
                    @if ($inap1 != 0 && $inap2 == 0)
                        @php
                            $fee1 = $nilai->inn_fee_1 / $nilai->isi_1;
                        @endphp
                        {{$nilai->long_stay_1}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($fee1)}}
                    @elseif ($inap1 != 0 && $inap2 != 0 )
                        @php
                            $fee1 = $nilai->inn_fee_1 / $nilai->isi_1;
                            $fee2 = $nilai->inn_fee_2 / $nilai->isi_2;
                        @endphp
                        {{$nilai->long_stay_1}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($fee1)}} <br>
                        {{$nilai->long_stay_2}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($fee2)}}
                    @else
                         &nbsp;{{'-'}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{'-'}}
                    @endif
                </td>
                <td class="isi">
                    @if ($inap1 != 0 && $inap2 == 0)
                        @php
                            $jum1 = $nilai->klaim_1;
                        @endphp
                        Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($jum1)}}
                    @elseif ($inap1 != 0  && $inap2 != 0)
                        @php
                            $jum1 = $nilai->klaim_1;
                            $jum2 = $nilai->klaim_2;
                        @endphp
                        Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($jum1)}} <br>
                        Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($jum2)}}
                    @else
                        Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{'-'}}
                    @endif
                </td>
                <td style="text-align: center" class="isi">
                    @if ($inap1 != '0' && $inap2 == '0')
                            {{$nilai->innname_1}} 
                    @elseif($inap1 != '0' && $inap2 != '0')
                            {{$nilai->innname_1}}  <br>
                            {{$nilai->innname_2}} 
                    @else 
                        {{'-'}}
                    @endif
                </td>
            </tr>
            <tr>
                @php
                    $hasil = 0;
                @endphp
                <td class="isi"></td>
                <td class="isi"><b>Jumlah pengeluaran kkp :</b></td>
                <td class="isi">
                    Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    @php
                        $hasil = $bbm+$jum1+$jum2;
                    @endphp
                    {{number_format($hasil)}}
                </td>
                <td class="isi"></td>
            </tr>
            <tr>
                <td colspan="4" class="isi" style="text-transform: capitalize;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    Terbilang : {{terbilang($hasil)}} Rupiah
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td colspan="2" style="line-height:1;">
                <br>
                Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%" class="dalem">
        <tr>
            <td></td>
            <td></td>
            <td style="text-align:center;">Banjarmasin, {{tgl_indo($data->date)}}</td>
        </tr>
        <tr>
            <td style="text-align:center;">Setuju dibayar</td>
            <td></td>
            <td style="text-align:center;">Pejabat Negara / Pegawai Negeri</td>
        </tr>
        <tr>
            <td style="text-align:center;">{{$item->out->ppk->jabatan}}</td>
            <td></td>
            <td style="text-align:center;">yang melakukan perjalanan dinas :</td>
        </tr>
        <tr>
            <td style="height: 3%"></td>
            <td style="height: 3%"></td>
            <td style="height: 3%"></td>
        </tr>
        <tr>
            <td style="line-height: 1; text-align:center;">
                <u>{{$item->out->ppk->user->name}}</u> <br>
                NIP. {{$item->out->ppk->user->no_pegawai}}
            </td>
            <td></td>
            <td style="text-align:center;">
                <u>{{$item->pegawai->name}}</u> <br>
                @if ($item->pegawai->golongan_id != null)
                    NIP. {{$item->pegawai->no_pegawai}}
                @else
                    &nbsp;
                @endif
            </td>
            <tr>
                <td colspan="3" style="text-align:center; letter-spacing: 2px; line-height: 1; "><br>
                    BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</td>
            </tr>
            <tr>
                <td colspan ="3" style="text-align:center; font-size:5; line-height: 1; ">
                    Jl. Brigjend H.Hasan Basri No.40 Banjarmasin - 70247 Telp (0511) 3304286, 3305115 ; Fax (0511) 3302162
                </td>
            </tr>
            <tr>
                <td style="text-align: left; font-size:6; line-height: 1; ">
                    @php
                        $a = strtotime($data->date);
                        $c = date('D', $a);

                        if ($c=='sun') {
                        $days='Minggu';
                        }else if ($c=='Mon') {
                            $days='Senin';
                        }else if ($c=='Tue') {
                            $days='Selasa';
                        }else if ($c=='Wed') {
                            $days='Rabu';
                        }else if ($c=='Thu') {
                            $days='Kamis';
                        }else if ($c=='Fri') {
                            $days='Jumat';
                        }else{
                            $days='Sabtu';
                        };

                        echo $days; 
                    @endphp
                   , {{tgl_indo($data->date)}}
                </td>
                <td></td>
                <td style="text-align: right; line-height: 1; font-size:6;" > Page 1 of 1</td>
            </tr>
        </tr>
    </table>

    <br>
{{---------------------------------- baris ke dua -------------------------------------------------------------------}}
    <table style="width: 100%">
        <tr>
            <td colspan="2" style="vertical-align: bottom; text-align: center;">
                <img src="{{asset('images/BBRI.jpg')}}" style="height:50px">
            </td>
            <td colspan="2" style="font-size: 6;">
                Lampiran<br>
                Peraturan Direktur Jenderal Perbendaharaan Nomor Per 37/PB/2007<br>
                tentang Petunjuk Pelaksanaan Perjalanan Dinas Jabatan Dalam Negeri <br>
                Bagi Pejabat Negara Pegawai Negeri Sipil dan pejabatn Tidak Tetap <br>
                Nomor 113/PMK.05/2012 &nbsp;&nbsp;&nbsp; Tgl. 23 Juli 2012
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;  font-size: 10; font-style: normal; line-height: 1;">
                BALAI BESAR PENGAWAS OBAT DAN MAKANAN
            </td>
            <td style="width: 18%;  font-size: 7; vertical-align:top;" rowspan="3">
                Beban MAK <br>
                Tahun Anggaran <br>
                Bukti Kas
            </td>
            <td style="width: 25%  font-size: 7;" rowspan="3">
                : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
                : {{$item->out->pok->pok->year}} <br>
                : ...............................
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; line-height: 1;">Di Banjarmasin</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;  font-size: 10; line-height: 1;"> 
                <b> DAFTAR PENGELUARAN KKP TRANSPORT</b> 
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; line-height: 1;">Yang bertanda Tangan di Bawah ini :</td>
            <td style="font-size: 7;" rowspan="4">
                Program / Kegiatan <br>
                KRO/RO/Komponen <br>
                Sub Komponen / Akun <br>
                No. Surat Tugas <br>
                Petugas
            </td>
            <td style="font-size: 7;" rowspan="4">
                : {{$item->out->pok->pok->act->prog->unit->klcode->code}}.{{$item->out->pok->pok->act->prog->unit->code}}.
                    {{$item->out->pok->pok->act->prog->code}} / {{$item->out->pok->pok->act->code}} <br>
                : {{$item->out->pok->sub->komponen->det->unit->code}} / {{$item->out->pok->sub->komponen->det->code}} / 
                    {{$item->out->pok->sub->komponen->code}} <br>
                : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
                :  {{$item->out->number}} <br>
                : {{$no}}
            </td>
        </tr>
        <tr>
            <td style="width: 10%; line-height:1;">
                Nama
            </td>
            <td>
                : {{$item->pegawai->name}}
            </td>
        </tr>
        <tr>
            <td style="width: 10%; line-height:1;">
                NIP 
            </td>
            <td>
                :   @if ($item->pegawai->golongan_id != null)
                        {{$item->pegawai->no_pegawai}}
                    @else
                        -
                    @endif
            </td>
        </tr>
        <tr>
            <td style="width: 10%; line-height:1;">
                Jabatan 
            </td>
            <td style="line-height:1;">
                : 
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->jabasn->nama}}
                @else
                    {{$item->pegawai->deskjob}}
                @endif
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="width: 20%">Berdasarkan SPPD Nomor
            </td>
            <td> : 
                {{$item->no_sppd}}
            </td>
            <td style="width: 43%">
                Tanggal SPPD : {{tgl_indo($item->out->st_date)}}
            </td>
        </tr>
        <tr>
            <td>Untuk Perjalanan Dinas</td>
            <td colspan="2"> : dari
                <b>{{$item->out->cityfrom->capital}}</b> 
                ke 
                <b>
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
                </b> 
                selama
                {{$lama->hitung}}
                hari
            </td>
        </tr>
    </table>
    <table style="width: 100%" class="isi">
        <thead>
            <tr>
                <th style="width: 5%; text-align:center;" class="isi">No.</th>
                <th style="width: 40%; letter-spacing: 2px; text-align:center; " class="isi">Uraian</th>
                <th style="width: 15%; letter-spacing: 2px; text-align:center;" class="isi">Jumlah</th>
                <th style="width: 30%; letter-spacing: 2px; text-align:center;" class="isi">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $bbm = 0;
                $nilai = $injectQuery->getDetail($item->id);
                $nilai2 = $injectQuery->getTr($item->id);
                $kkp = $injectQuery->getkkp($item->id);
            @endphp
            <tr>
                @php
                    if ($nilai->planefee1 != '0' && $kkp->planekkp1 == 'Y') {
                        $fee1 = $nilai->planefee1;
                    } else {
                        $fee1 = 0;
                    }

                    if ($nilai->planefee2 != '0' && $kkp->planekkp2 == 'Y') {
                        $fee2 = $nilai->planefee2;
                    } else {
                        $fee2 = 0;
                    }

                    if ($nilai->planefee3 != '0' && $kkp->planekkp3 == 'Y') {
                        $fee3 = $nilai->planefee3;
                    } else {
                        $fee3 = 0;
                    }

                    $pergi = $fee1+$fee2+$fee3;

                    if ($nilai->planereturnfee != '0' && $kkp->planekkpreturn == 'Y') {
                        $pulang = $nilai->planereturnfee;
                    } else {
                        $pulang = 0;
                    }

                    $totalkkp = $pulang + $pergi;
                    
                @endphp

                <td style="text-align: center;" class="isi">1</td>
                <td class="isi"> 
                    Biaya Transport : 
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
                    @endif <br>       
                           
                    @if ($pergi != 0 && $pulang != 0 )
                        &nbsp; Pergi &nbsp;: &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{number_format($pergi)}} <br>
                        &nbsp; Pulang : &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{number_format($pulang)}}
                    @elseif ($pergi != 0 && $pulang == 0 )
                        &nbsp; Pergi &nbsp;: &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{number_format($pergi)}} <br>
                        &nbsp; Pulang : &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{ '-' }}
                    @elseif ($pergi == 0 && $pulang != 0 )
                        &nbsp; Pergi &nbsp;: &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{ '-' }} <br>
                        &nbsp; Pulang : &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{number_format($pulang)}}
                    @else
                        &nbsp; Pergi &nbsp;: &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{ '-' }} <br>
                        &nbsp; Pulang : &nbsp; &nbsp; &nbsp; &nbsp; Rp. {{ '-' }}
                    @endif
                </td>
                <td class="isi">
                    @if ($totalkkp != 0)
                        Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($totalkkp)}}
                    @else
                        Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{'-'}}
                    @endif
                </td>
                <td style="text-align: center" class="isi">
                    @if ($fee1 != 0 && $fee2 != 0 && $fee3 != 0)
                        Maskapai Pergi : {{$nilai->plane1->name}}, {{$nilai->plane2->name}} dan {{$nilai->plane3->name}}
                    @elseif ($fee1 != 0 && $fee2 != 0 && $fee3 == 0)
                        Maskapai Pergi : {{$nilai->plane1->name}} dan {{$nilai->plane2->name}}
                    @elseif ($fee1 != 0 && $fee2 == 0 && $fee3 == 0)
                        Maskapai Pergi : {{$nilai->plane1->name}}
                    @else
                        Maskapai Pergi : {{ '-' }}  
                    @endif
                    <br>
                    @if ($pulang != 0 )
                        Maskapai Pulang : {{$nilai->planeret->name}}
                    @else
                        Maskapai Pulang : {{ '-' }}  
                    @endif
                </td>
            </tr>
            <tr>
                <td class="isi"></td>
                <td class="isi"><b>Jumlah pengeluaran kkp :</b></td>
                <td class="isi">
                    Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    {{number_format($totalkkp)}}
                </td>
                <td class="isi"></td>
            </tr>
            <tr>
                <td colspan="4" class="isi" style="text-transform: capitalize;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    Terbilang : {{terbilang($totalkkp)}} Rupiah
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td colspan="2" style="line-height:1;">
                <br>
                Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%" class="dalem">
        <tr>
            <td></td>
            <td></td>
            <td style="text-align:center;">Banjarmasin, {{tgl_indo($data->date)}}</td>
        </tr>
        <tr>
            <td style="text-align:center;">Setuju dibayar</td>
            <td></td>
            <td style="text-align:center;">Pejabat Negara / Pegawai Negeri</td>
        </tr>
        <tr>
            <td style="text-align:center;">{{$item->out->ppk->jabatan}}</td>
            <td></td>
            <td style="text-align:center;">yang melakukan perjalanan dinas :</td>
        </tr>
        <tr>
            <td style="height: 3%"></td>
            <td style="height: 3%"></td>
            <td style="height: 3%"></td>
        </tr>
        <tr>
            <td style="line-height: 1; text-align:center;">
                <u>{{$item->out->ppk->user->name}}</u> <br>
                NIP. {{$item->out->ppk->user->no_pegawai}}
            </td>
            <td></td>
            <td style="text-align:center;">
                <u>{{$item->pegawai->name}}</u> <br>
                @if ($item->pegawai->golongan_id != null)
                    NIP. {{$item->pegawai->no_pegawai}}
                @else
                    &nbsp;
                @endif
            </td>
            <tr>
                <td colspan="3" style="text-align:center; letter-spacing: 2px; line-height: 1; "><br>
                    BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</td>
            </tr>
            <tr>
                <td colspan ="3" style="text-align:center; font-size:5; line-height: 1; ">
                    Jl. Brigjend H.Hasan Basri No.40 Banjarmasin - 70247 Telp (0511) 3304286, 3305115 ; Fax (0511) 3302162
                </td>
            </tr>
            <tr>
                <td style="text-align: left; font-size:6; line-height: 1; ">
                    @php
                        $a = strtotime($data->date);
                        $c = date('D', $a);

                        if ($c=='sun') {
                        $days='Minggu';
                        }else if ($c=='Mon') {
                            $days='Senin';
                        }else if ($c=='Tue') {
                            $days='Selasa';
                        }else if ($c=='Wed') {
                            $days='Rabu';
                        }else if ($c=='Thu') {
                            $days='Kamis';
                        }else if ($c=='Fri') {
                            $days='Jumat';
                        }else{
                            $days='Sabtu';
                        };

                        echo $days; 
                    @endphp
                , {{tgl_indo($data->date)}}
                </td>
                <td></td>
                <td style="text-align: right; line-height: 1; font-size:6;" > Page 1 of 1</td>
            </tr>
        </tr>
    </table>
</body>
@php
    $no++;
@endphp
@endforeach
</html>