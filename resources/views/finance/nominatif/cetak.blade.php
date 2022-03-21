@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Nominatif Perjalanan Dinas</title>

    <style>
        @page {
            size: A4 landscape;
            font-family: 'Times New Roman';
        }

        table,tr,td, th{
            border:1px solid black;
            font-size: 5;
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

</head>
<body>
<div style="text-align:center" class="isi">
    <div style="align=center font-size:16px">
            <b>DAFTAR NOMINATIF PEJABAT / PEGAWAI YANG MELAKUKAN PERJALANAN DINAS</b>
    </div>
    
    <br>
    <table class="atas">
        <tr class="atas">
            <td  class="atas" style="width: 10%">Surat Tugas Nomor</td>
            <td  class="atas" style="width: 50%">: {{$data->st->number}}

            </td>
            <td  class="atas" style="width: 5%">MAK</td>
            <td  class="atas" style="width: 35%">:
                @if ($data->st->pok_detail_id == 0)
                    {{' Non Anggaran '}}
                @else
                    {{$data->st->pok->pok->act->prog->unit->klcode->code}}.{{$data->st->pok->pok->act->prog->unit->code}}.
                    {{$data->st->pok->pok->act->prog->code}}.{{$data->st->pok->pok->act->code}}.
                    {{$data->st->pok->sub->komponen->det->unit->code}}.{{$data->st->pok->sub->komponen->det->code}}.
                    {{$data->st->pok->sub->komponen->code}}.{{$data->st->pok->sub->code}}.{{$data->st->pok->akun->code}}

                @endif
            </td>
        </tr>
        <tr>
            <td  class="atas">Tanggal</td>
            <td  class="atas">:
                {{$data->st->st_date}}
            </td>
            <td  class="atas">Kegiatan</td>
            <td  class="atas">:
                {{$data->st->purpose}}
            </td>
        </tr>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">NAMA / NIP</th>
                <th rowspan="2">TUJUAN</th>
                <th rowspan="2">TGL BERANGKAT
                    <br>& KEMBALI</th>
                <th rowspan="2">MAKSUD TUGAS</th>
                <th colspan="4">UANG HARIAN</th>
                <th colspan="3">UANG REPRESENTATIF</th>
                <th colspan="4">BIAYA PENGINAPAN</th>
                <th colspan="4">BIAYA TRANSPORT (TIKET/TAKSI/TRANSLOK/BBM)</th>
                <th rowspan="2">TOTAL</th>
            </tr>
            <tr>
                <th>JENIS</th>
                <th>VOL</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
                <th>VOL</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
                <th>JENIS</th>
                <th>VOL</th>
                <th>SATUAN</th>
                <th>KLAIM</th>
                <th>JENIS</th>
                <th>VOL</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1;  @endphp
            @foreach ($pegawai as $item)
                <tr>
                    <td style="text-align: center; vertical-align: top;">{{$no}}</td>
                    <td style="vertical-align: top;">
                        {{$item->pegawai->name}}
                        @if ($item->pegawai->status=='PNS')
                            / <br>
                            NIP. {{$item->pegawai->no_pegawai}} 
                        @endif
                    </td>
                    <td style="vertical-align: top;">
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
                    <td style="vertical-align: top;">
                        @if (count($item->out->outst_destiny) == 1)
                            @foreach ($tujuan as $key=>$kota)
                                @if ($loop->first)
                                    {{tgl_indo($kota->go_date)}} <br>
                                    {{tgl_indo($kota->return_date)}}
                                @endif
                                
                            @endforeach
                        @else
                            @foreach ($tujuan as $key=>$kota)
                                @if ($loop->first)
                                    {{tgl_indo($kota->go_date)}} <br>
                                @endif
                                @if ($loop->last)
                                    {{tgl_indo($kota->return_date)}}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td style="vertical-align: top;">
                        {{$item->out->purpose}}
                    </td>
                    <td style="vertical-align: top;">
                        UH Penuh <br>
                        UH Diklat <br>
                        UH Fullboard <br>
                        UH H/F Day
                    </td>
                    <td style="vertical-align: top; text-align:center;">
                        @if ($item->dailywage1 != 'N')
                            {{$item->jumdaily1}} OH
                        @endif <br>
                        @if ($item->diklat != 'N')
                            {{$item->jumdiklat}} OH
                        @endif <br>
                        @if ($item->fullboard != 'N')
                            {{$item->jumfullb}} OH
                        @endif <br>
                        @if ($item->fullday != 'N')
                            {{$item->jumhalf}} OH
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align:right;">
                        @if ($item->dailywage1 != 'N')
                            {{number_format($item->hitdaily1)}}
                        @endif <br>
                        @if ($item->diklat != 'N')
                            {{number_format($item->hitdiklat)}}
                        @endif <br>
                        @if ($item->fullboard != 'N')
                            {{number_format($item->hitfullb)}}
                        @endif <br>
                        @if ($item->fullday != 'N')
                            {{number_format($item->hithalf)}}
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align:right;">
                        @if ($item->dailywage1 != 'N')
                            {{number_format($item->totdaily1)}}
                        @endif <br>
                        @if ($item->diklat != 'N')
                            {{number_format($item->totdiklat)}}
                        @endif <br>
                        @if ($item->fullboard != 'N')
                            {{number_format($item->totfullb)}}
                        @endif <br>
                        @if ($item->fullday != 'N')
                            {{number_format($item->tothalf)}}
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align:center;">
                        @if ($item->representatif != 'N')
                            {{$item->jumrep}} OH
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align:right;">
                        @if ($item->representatif != 'N')
                            {{number_format($item->hitrep)}}
                        @endif
                    </td>
                    <td style="vertical-align: top;text-align:right;">
                        @if ($item->representatif != 'N')
                            {{number_format($item->totrep)}}
                        @endif
                    </td>
                    <td style="vertical-align: top;">
                        Hotel 1 <br>
                        Hotel 2 <br>
                        Paket Fullboard <br>
                        Paket H/F Day
                    </td>
                    <td style="vertical-align: top;  text-align:center;">
                        @if ($item->klaim_1 != 0)
                            {{$item->long_stay_1}} OH
                        @endif <br>
                        @if ($item->klaim_2 != 0)
                            {{$item->long_stay_2}} OH
                        @endif <br>
                        @if ($item->totdaysfull != 0)
                            {{$item->daysfull}} OH
                        @endif <br>
                        @if ($item->totdayshalf != 0)
                            {{$item->dayshalf}} OH
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align:right;">
                        @if ($item->klaim_1 != 0)
                            @php
                                $fee1 = $item->inn_fee_1 / $item->isi_1;
                            @endphp
                            {{number_format($fee1)}}
                        @endif <br>
                        @if ($item->klaim_2 != 0)
                            @php
                                $fee1 = $item->inn_fee_2 / $item->isi_2;
                            @endphp
                            {{number_format($fee2)}}
                        @endif <br>
                        @if ($item->totdaysfull != 0)
                            {{number_format($item->feefull)}}
                        @endif <br>
                        @if ($item->totdayshalf != 0)
                            {{number_format($item->feehalf)}}
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align:right;">
                        @if ($item->klaim_1 != 0)
                            {{number_format($item->klaim_1)}}
                        @endif <br>
                        @if ($item->klaim_2 != 0)
                            {{number_format($item->klaim_2)}}
                        @endif <br>
                        @if ($item->totdaysfull != 0)
                            {{number_format($item->totdaysfull)}}
                        @endif <br>
                        @if ($item->totdayshalf != 0)
                            {{number_format($item->totdayshalf)}}
                        @endif
                    </td>
                    <td style="vertical-align: top;">
                        Tiket 1 <br>
                        Tiket 2 <br>
                        Tiket 3 <br>
                        Taksi 1 <br>
                        Taksi 2 <br>
                        BBM <br>    
                        Trans Lokal(DK)
                    </td>
                    <td style="vertical-align: top;  text-align:center;">
                        @if ($item->planefee1 != 0)
                            1 OK
                        @endif <br>
                        @if ($item->planefee2 != 0)
                            1 OK
                        @endif <br>
                        @if ($item->planereturnfee != 0)
                            1 OK
                        @endif <br>
                        @if ($item->taxy_fee_from != 0)
                            {{$item->taxy_count_from}} OK
                        @endif <br>
                        @if ($item->taxy_fee_to != 0)
                            {{$item->taxy_count_to}} OK
                        @endif <br>
                        @if ($item->bbm != 0)
                            1 OK
                        @endif <br>
                        @if ($item->tlokal == 'Y')
                           {{$item->hittlokal}} OK
                        @endif 
                    </td>
                    <td style="vertical-align: top; text-align:right;">
                        @if ($item->planefee1 != 0)
                            {{number_format($item->planefee1)}}
                        @endif <br>
                        @if ($item->planefee2 != 0)
                            {{number_format($item->planefee2)}}
                        @endif <br>
                        @if ($item->planereturnfee != 0)
                            {{number_format($item->planereturnfee)}}
                        @endif <br>
                        @if ($item->taxy_fee_from != 0)
                            {{number_format($item->taxy_fee_from)}}
                        @endif <br>
                        @if ($item->taxy_fee_to != 0)
                            {{number_format($item->taxy_fee_to)}}
                        @endif <br>
                        @if ($item->bbm != 0)
                            {{number_format($item->bbm)}}
                        @endif <br>
                        @if ($item->tlokal == 'Y')
                           {{number_format($item->jumtlokal)}}
                        @endif 
                    </td>
                    <td style="vertical-align: top; text-align:right;">
                        @if ($item->planefee1 != 0)
                            {{number_format($item->planefee1)}}
                        @endif <br>
                        @if ($item->planefee2 != 0)
                            {{number_format($item->planefee2)}}
                        @endif <br>
                        @if ($item->planereturnfee != 0)
                            {{number_format($item->planereturnfee)}}
                        @endif <br>
                        @if ($item->taxy_fee_from != 0)
                            @php
                                $a = $item->taxy_count_from;
                                $b = $item->taxy_fee_from;
                                $jumlah = $a*$b;
                            @endphp
                            {{number_format($jumlah)}}
                        @endif <br>
                        @if ($item->taxy_fee_to != 0)
                            @php
                                $c = $item->taxy_count_to;
                                $d = $item->taxy_fee_to;
                                $jumlahb = $c*$d;
                            @endphp
                            {{number_format($jumlahb)}}
                        @endif <br>
                        @if ($item->bbm != 0)
                            {{number_format($item->bbm)}}
                        @endif <br>
                        @if ($item->tlokal == 'Y')
                        {{number_format($item->tottlokal)}}
                     @endif 
                    </td>
                    <td style="vertical-align: top; text-align:right;">
                        @php
                        $total = $injectQuery->totalHarga($item->em_id)
                        @endphp
                        <b>{{number_format($total)}}</b> 
                    </td>
                </tr>
                {{$no++}}
            @endforeach
        </tbody>
    </table>
    <br><br><br>
    <div class="ttd">
        <table class="table2">
            <tr class="table2">
                <td class="table2" style="width: 80%"></td>
                <td class="table2">Banjarmasin, {{tgl_indo($data->st->st_date)}}</td>
            </tr>
            <tr class="table2">
                <td class="table2">{{$data->st->ppk->jabatan}} <br><br><br><br><br></td>
                <td class="table2">
                    @if ($menyetujui->pjs !=null)
                        {{$menyetujui->pjs}}
                        {{$menyetujui->jabatan->jabatan}} {{$menyetujui->divisi->nama}},
                    @else
                        {{$menyetujui->jabatan->jabatan}} {{$menyetujui->divisi->nama}},
                    @endif
                    <br><br><br><br><br>
                </td>
            </tr>
            <tr class="table2">
                <td class="table2">
                    <u>{{$data->st->ppk->user->name}}</u> <br>
                    NIP. {{$data->st->ppk->user->no_pegawai}}
                </td>
                <td class="table2">
                    <u>{{$menyetujui->user->name}}</u> <br>
                    NIP. {{$menyetujui->user->no_pegawai}}
                </td>
            </tr>
        </table>
    </div>
</div>
</body>

</html>