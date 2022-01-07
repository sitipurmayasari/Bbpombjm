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
                <b> DAFTAR PENGELUARAN RIIL</b> 
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
                : {{$no++}}
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
                :   @if ($item->pegawai->status=='PNS')
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
                @if ($item->pegawai->status=='PNS')
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
                @php
                    $hari=0;
                @endphp
                @foreach ($tujuan as $key=>$hr)
                    @php
                        $hari += $hr->longday;
                    @endphp
                @endforeach
                {{$hari}}
                hari, dengan ini menyatakan dengan sesungguhnya bahwa : 
            </td>
        </tr>
        <tr>
            <td colspan="3" style="line-height:1;">
                1. Biaya transport pegawai dan atau biaya penginapan di bawah ini yang tidak dapat diperoleh 
                bukti - bukti pengeluarannya, meliputi :
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
            <tr>
                @php
                     $nilai = $injectQuery->getDetail($item->id)
                @endphp
                <td style="text-align: center;" class="isi">1</td>
                <td class="isi">
                    Biaya Transport : <br>
                    <b>{{$item->out->cityfrom->capital}}</b> 
                    <b> -
                        &nbsp;&nbsp;&nbsp;
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
                </td>
                <td class="isi">
                    Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    @php
                        $bbm = 0;
                    @endphp
                    @if ($nilai->bbm != '0')
                        @php
                            $bbm = $nilai->bbm;
                        @endphp
                        {{number_format($bbm)}}
                    @else
                        {{'-'}} 
                    @endif
                </td>
                <td style="text-align: center" class="isi">
                    {{$item->out->transport}}
                </td>
            </tr>
            <tr>
                @php
                    $jum1 = 0;
                    $jum2 = 0;
                @endphp
                <td style="text-align: center;" class="isi">2</td>
                <td class="isi">
                    Biaya Penginapan : 
                    @if ($nilai->innname_1 != null)
                        {{$nilai->long_stay_1}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($nilai->inn_fee_1)}}
                    @elseif ($nilai->innname_2 != null)
                        {{$nilai->long_stay_1}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($nilai->inn_fee_1)}} <br>
                        {{$nilai->long_stay_2}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($nilai->inn_fee_2)}}
                    @else
                        {{'-'}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{'-'}}
                    @endif
                </td>
                <td class="isi">
                    Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    @if ($nilai->innname_1 != null)
                        @php
                            $jum1 = $nilai->klaim_1;
                        @endphp
                        {{number_format($jum1)}}
                    @elseif ($nilai->innname_2 != null)
                        @php
                            $jum1 = $nilai->klaim_1;
                            $jum1 = $nilai->klaim_2;
                        @endphp
                        {{number_format($jum1)}} <br>
                        {{number_format($jum2)}}
                    @else
                        {{'-'}}
                    @endif
                </td>
                <td style="text-align: center" class="isi">
                    @if ($nilai->isi_1 != '0')
                            1 kamar untuk {{$nilai->isi_1}} orang
                    @elseif($nilai->isi_2 != '0')
                            1 kamar untuk {{$nilai->isi_1}} orang <br>
                            1 kamar untuk {{$nilai->isi_2}} orang
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
                <td class="isi"><b>Jumlah pengeluaran riil :</b></td>
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
            <td style="vertical-align: top;">2.</td>
            <td style="line-height:1;">
                Jumlah uang tersebut pada angka 1 di atas benar - benar di keluarkan untuk pelaksanaan perjalanan dinas dimaksud
                dan apabila di kemudian
                hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut
                ke Kas Negara.
            </td>
        </tr>
        <tr>
            <td colspan="2" style="line-height:1;">
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
                @if ($item->pegawai->status=='PNS')
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
                <td style="text-align: right; line-height: 1; " > Page 1 of 1</td>
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
                <b> DAFTAR PENGELUARAN RIIL</b> 
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
                : {{$no++}}
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
                :   @if ($item->pegawai->status=='PNS')
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
                @if ($item->pegawai->status=='PNS')
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
                @php
                    $hari=0;
                @endphp
                @foreach ($tujuan as $key=>$hr)
                    @php
                        $hari += $hr->longday;
                    @endphp
                @endforeach
                {{$hari}}
                hari, dengan ini menyatakan dengan sesungguhnya bahwa : 
            </td>
        </tr>
        <tr>
            <td colspan="3" style="line-height:1;">
                1. Biaya transport pegawai dan atau biaya penginapan di bawah ini yang tidak dapat diperoleh 
                bukti - bukti pengeluarannya, meliputi :
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
            <tr>
                @php
                    $nilai = $injectQuery->getDetail($item->id)
                @endphp
                <td style="text-align: center;" class="isi">1</td>
                <td class="isi">
                    Biaya Transport : <br>
                    <b>{{$item->out->cityfrom->capital}}</b> 
                    <b> -
                        &nbsp;&nbsp;&nbsp;
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
                </td>
                <td class="isi">
                    Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    @php
                        $bbm = 0;
                    @endphp
                    @if ($nilai->bbm != '0')
                        @php
                            $bbm = $nilai->bbm;
                        @endphp
                        {{number_format($bbm)}}
                    @else
                        {{'-'}} 
                    @endif
                </td>
                <td style="text-align: center" class="isi">
                    {{$item->out->transport}}
                </td>
            </tr>
            <tr>
                @php
                    $jum1 = 0;
                    $jum2 = 0;
                @endphp
                <td style="text-align: center;" class="isi">2</td>
                <td class="isi">
                    Biaya Penginapan : 
                    @if ($nilai->innname_1 != null)
                        {{$nilai->long_stay_1}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($nilai->inn_fee_1)}}
                    @elseif ($nilai->innname_2 != null)
                        {{$nilai->long_stay_1}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($nilai->inn_fee_1)}} <br>
                        {{$nilai->long_stay_2}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{number_format($nilai->inn_fee_2)}}
                    @else
                        {{'-'}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{'-'}}
                    @endif
                </td>
                <td class="isi">
                    Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    @if ($nilai->innname_1 != null)
                        @php
                            $jum1 = $nilai->klaim_1;
                        @endphp
                        {{number_format($jum1)}}
                    @elseif ($nilai->innname_2 != null)
                        @php
                            $jum1 = $nilai->klaim_1;
                            $jum1 = $nilai->klaim_2;
                        @endphp
                        {{number_format($jum1)}} <br>
                        {{number_format($jum2)}}
                    @else
                        {{'-'}} hari &nbsp; x &nbsp; Rp. &nbsp; &nbsp; &nbsp; &nbsp; {{'-'}}
                    @endif
                </td>
                <td style="text-align: center" class="isi">
                    @if ($nilai->isi_1 != '0')
                            1 kamar untuk {{$nilai->isi_1}} orang
                    @elseif($nilai->isi_2 != '0')
                            1 kamar untuk {{$nilai->isi_1}} orang <br>
                            1 kamar untuk {{$nilai->isi_2}} orang
                    @endif
                </td>
            </tr>
            <tr>
                @php
                    $hasil = 0;
                @endphp
                <td class="isi"></td>
                <td class="isi"><b>Jumlah pengeluaran riil :</b></td>
                <td class="isi">
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
            <td style="vertical-align: top;">2.</td>
            <td style="line-height:1;">
                Jumlah uang tersebut pada angka 1 di atas benar - benar di keluarkan untuk pelaksanaan perjalanan dinas dimaksud
                dan apabila di kemudian
                hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut
                ke Kas Negara.
            </td>
        </tr>
        <tr>
            <td colspan="2" style="line-height:1;">
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
                @if ($item->pegawai->status=='PNS')
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
                <td style="text-align: right; line-height: 1; " > Page 1 of 1</td>
            </tr>
        </tr>
    </table>
</body>
@endforeach
</html>