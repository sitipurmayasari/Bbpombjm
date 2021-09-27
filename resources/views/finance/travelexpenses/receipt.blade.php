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
            <td style="width: 25%">: {{$item->out->sub->komponen->code}} / {{$item->out->akun->code}} )</td>
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
            <td>: 2021</td>
        </tr>
        <tr>
            <td style="width: 20%" >Sudah Terima dari</td>
            <td colspan="3">: Pejabat Pembuat komitmen Balai Besar Pengawas Obat dan Makanan di Banjarmasin</td>
        </tr>
        <tr>
            <td>Uang Sebesar</td>
            <td colspan="3">: <b>Rp.  &nbsp;&nbsp;&nbsp; (Nominal)</b></td>
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
            <td>: <b>(TERBILANG)</b></td>
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
                : {{$item->out->act->prog->unit->klcode->code}}.{{$item->out->act->prog->unit->code}}.
                    {{$item->out->act->prog->code}} / {{$item->out->act->code}}<br>
                : {{$item->out->sub->komponen->det->unit->code}} / {{$item->out->sub->komponen->det->code}} / 
                    {{$item->out->sub->komponen->code}} <br>
                : {{$item->out->sub->code}} / {{$item->out->akun->code}} <br>
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
                            <td>- Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="3"> Kembali</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                        </tr>
                        <tr>
                            <td colspan="8">Taxi Kota</td>
                        </tr>
                        <tr>
                            <td colspan="2">- Asal </td>
                            <td>:</td>
                            <td style="text-align: right; width:5%;">
                                (kali)
                            </td>
                            <td>kali x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                        <tr>
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
                                (kali)
                            </td>
                            <td>kali x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                        <tr>
                            <td colspan="2">- kembali </td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (kali)
                            </td>
                            <td>kali x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
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
                <td class="isi" style="text-align: center">2</td>
                <td class="isi">
                    <table style="width: 100%;" class="kepala">
                        <tr>
                            <td colspan="7">Uang Harian di Kota (Kota Tujuan) (Provinsi Kota Tujuan)</td>
                        </tr>
                        <tr>
                            <td>- Penuh</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (hari)
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                        <tr>
                            <td>- Diklat</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (hari)
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                        <tr>
                            <td>- Paket Halfday / Fullday</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (hari)
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                        <tr>
                            <td>- Paket Fullboard</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (hari)
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                    </table>
                </td>
                <td class="isi">Rp. &nbsp;&nbsp; 

                </td>
                <td class="isi"></td>
            </tr>
            <tr>
                <td class="isi" style="text-align: center">3</td>
                <td class="isi">
                    <table style="width: 100%;" class="kepala">
                        <tr>
                            <td colspan="7">Biaya Pertemuan di Kota (Kota Tujuan) (Provinsi Kota Tujuan)</td>
                        </tr>
                        <tr>
                            <td>- Paket Halfday / Fullday</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (hari)
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                        <tr>
                            <td>- Paket Fullboard</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (hari)
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
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
                            <td colspan="7">Biaya Penginapan di Kota (Kota Tujuan) (Provinsi Kota Tujuan)</td>
                        </tr>
                        <tr>
                            <td>- (Nama Penginapan)</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (hari)
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                    </table>
                </td>
                <td class="isi">Rp. &nbsp;&nbsp;

                </td>
                <td class="isi">
                    1 Kamar 2 orang
                </td>
            </tr>
            <tr>
                <td class="isi" style="text-align: center">5</td>
                <td class="isi">
                    <table style="width: 100%;" class="kepala">
                        <tr>
                            <td>Uang Representatif Eselon II</td>
                            <td>:</td>
                            <td style="text-align: right;">
                                (hari)
                            </td>
                            <td>hari x Rp.</td>
                            <td style="text-align: right;">(nominal)</td>
                            <td>- Rp.</td>
                            <td style="text-align: right;">(Total)</td>
                        </tr>
                    </table>
                </td>
                <td class="isi">Rp. &nbsp;&nbsp;

                </td>
                <td class="isi"></td>
            </tr>
            <tr>
                <td class="isi"></td>
                <td class="isi"><b>Jumlah Biaya Perjalanan :</b>
                </td>
                <td class="isi">Rp. &nbsp;&nbsp;

                </td>
                <td class="isi"> </td>
            </tr>
            <tr>
                <td class="isi"></td>
                <td class="isi" colspan="3">
                    Terblang : <b>(Terbilang)</b>
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
        <td>Telah di bayar sejumlah : Rp. (NOMINAL)</td>
        <td>Telah menerima jumlah uang sebesar : Rp. (NOMINAL)</td>
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
            <td class="isi" style="text-align: right">(total all)</td>
            <td style="text-align: center; width:40%">{{$item->out->ppk->jabatan}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Yang telah dibayar semula</td>
            <td><b>Rp. </b></td>
            <td class="isi" style="text-align: right">(total all)</td>
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