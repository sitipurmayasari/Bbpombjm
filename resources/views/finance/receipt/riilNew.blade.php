@inject('InjectNew', 'App\InjectNew')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Riil</title>

    <style>
        @page {
            size:8.5in 13in;
            font-family: 'Times New Roman';
            font-size: 10;
            font-style: italic;
            margin-top: 20px;
            margin-bottom: 20px;
            line-height: 1;
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
            font-size: 10;
            font-family: 'Times New Roman';
            border: 1px solid black;
            vertical-align : top;
            line-height: 1.5;
        }

        .dalem {
            text-align: left;
            font-style: italic;
            font-size: 10;
            border-collapse: collapse;
            border: none;
            line-height: 1;

        }
        td{
            line-height:1;
        }

        .kanan{
            border-right: 1px solid black;
        }
       


        </style>

</head>

@php
    $no=1;
@endphp
@foreach ($pegawai as $item)
<body>
   <div>
        <table>
            <tr>
                <td style="width: 50%;text-align:center; vertical-align:bottom; padding-right:10%;" >
                    <img src="{{asset('images/bbpom.jpg')}}" style="height:100px"> <br>
                <b style="line-height: 1;">BALAI BESAR PENGAWAS OBAT DAN MAKANAN<br>
                    DI BANJARMASIN <br>
                    </b>
                    Jl. Brigjend H.Hasan Basri No.40 Banjarmasin<br>
                </td>
                <td style="width:50%; padding-left: 7%; line-height: 1;font-size: 8;">
                    LAMPIRAN II <br>
                    PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA <br>
                    NOMOR 113/PMK.05/2012 <br>
                    TENTANG <br>
                    PERJALANAN DINAS JABATAN DALAM NEGERI BAGI PEJABAT<br>
                    NEGARA, PEGAWAI NEGERI DAN PEGAWAI TIDAK TETAP <br>
                    <table style="font-size: 8; line-height: 1;">
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
                    <b style="font-size: 12;">DAFTAR PENGELUARAN RIIL<br> &nbsp;</b>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="2">
                    Yang bertandatangan di bawah ini :
                </td>
            </tr>
            <tr>
                <td style="padding-left: 15%; width:20%">
                    Nama
                </td>
                <td style="width: 80%">: 
                    {{$item->pegawai->name}}
                </td>
            </tr>
            <tr>
                <td style="padding-left: 15%">
                    NIP
                </td>
                <td>:
                    @if ($item->pegawai->golongan_id != null)
                        {{$item->pegawai->no_pegawai}}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding-left: 15%">
                    Jabatan
                </td>
                <td>:
                    @if ($item->pegawai->golongan_id != null)
                        {{$item->pegawai->jabasn->nama}}
                    @else
                        {{$item->pegawai->deskjob}}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style=" text-align: justify;">
                    <br>
                    berdasarkan Surat Perjalanan Dinas (SPD) Nomor 
                        @if ($data->st->type=="LK")
                            {{$item->no_sppd}}
                        @endif
                    tanggal {{tgl_indo($item->out->st_date)}}
                    , dengan ini menyatakan dengan sesungguhnya bahwa : <br> &nbsp;
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 5%; vertical-align:top;">1.</td>
                <td style="width: 95%;  text-align: justify;">
                Biaya transport pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti - bukti pengeluarannya , meliputi :
                <br>&nbsp;
                <table style="width: 90%" class="isi">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align:center;" class="isi">No.</th>
                            <th style="width: 40%; letter-spacing: 2px; text-align:center; " class="isi">Uraian</th>
                            <th style="width: 15%; letter-spacing: 2px; text-align:center;" class="isi">Jumlah</th>
                            <th style="width: 20%; letter-spacing: 2px; text-align:center;" class="isi">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sumtrans = 0;
                            $suminap = 0;
                            $total = 0;
                            $trans = $InjectNew->RiilTransport($item->id);
                            $inap = $InjectNew->RiilHotel($item->id);
                        @endphp
                        @if (count($trans) != 0)
                            <tr>
                                <td style="text-align: center; vertical-align:top;" class="kanan">1.</td>
                                <td class="kanan">
                                    <table>
                                        <tr>
                                            <td colspan="3"> Biaya Transport :</td>
                                        </tr>
                                        @foreach ($trans as $itemT)
                                            <tr>
                                                <td style="width: 40%;"><i><b>{{$itemT->taxitype}}</b></i></td>
                                                <td style="width: 20%;">
                                                    <i> : {{$itemT->taxicount}} kali</i>
                                                </td>
                                                <td>
                                                    <i> x &nbsp; &nbsp; &nbsp; Rp {{number_format($itemT->taxifee)}}</i>
                                                </td>
                                            </tr>
                                            @php
                                                $nilai = $itemT->taxisum;
                                                $sumtrans +=$nilai;
                                            @endphp
                                        @endforeach
                                    </table> 
                                </td>
                                <td class="kanan"> Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    @if ($sumtrans != 0)
                                        {{number_format($sumtrans)}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="kanan">
                                    {{$item->out->transport}}
                                </td>
                            </tr>
                        @endif
                        @if (count($inap) != 0)
                            <tr>
                               @if (count($trans) != 0 )
                                    <td style="text-align: center; vertical-align:top;" class="kanan">2.</td>
                               @else
                                    <td style="text-align: center; vertical-align:top;" class="kanan">1.</td>
                               @endif
                                <td class="kanan">
                                    <table>
                                        <tr>
                                            <td colspan="3"> Biaya Penginapan :</td>
                                        </tr>
                                        @foreach ($inap as $itemI)
                                            <tr>
                                                <td style="width: 40%;"><i><b>{{$itemI->hotelname}}</b></i></td>
                                                <td style="width: 20%;">
                                                    <i> : {{$itemI->hotellong}} hari</i>
                                                </td>
                                                <td>
                                                    @php
                                                        $orang = $itemI->person;
                                                        $biaya = $itemI->hotelfee;
                                                        $klaim = $biaya/$orang;
                                                    @endphp
                                                    <i> x &nbsp; &nbsp; &nbsp; Rp {{number_format($klaim)}}</i>
                                                </td>
                                            </tr>
                                            @php
                                                $nilai2 = $itemI->hotelsum;
                                                $suminap +=$nilai2;
                                            @endphp
                                        @endforeach
                                    </table> 
                                </td>
                                <td class="kanan"> Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    @if ($suminap != 0)
                                        {{number_format($suminap)}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="kanan">
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="kanan"><br><br></td>
                            <td class="kanan"></td>
                            <td class="kanan"></td>
                            <td class="kanan"></td>
                        </tr>
                        <tr>
                            <td class="isi"></td>
                            <td class="isi"><i><b>Jumlah Pengeluaran Riil</b></i></td>
                            <td class="isi">
                                @php
                                    $total = $sumtrans+$suminap;
                                @endphp
                                Rp. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                @if ($total != 0)
                                    {{number_format($total)}}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="isi"></td>
                        </tr>
                        <tr>
                            <td class="isi"></td>
                            <td colspan="3" class="isi" style="text-transform: capitalize;"><i> Terbilang :
                                {{terbilang($total)}}
                                Rupiah</i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br> &nbsp;
            </td>
            </tr>
            <tr>
                <td style="vertical-align:top;">2.</td>
                <td style=" text-align: justify;">Jumlah uang tersebut pada angka 1 di atas benar - benar dikeluarkan untuk pelaksanaan Perjalanan Dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, kami besedia untuk menyetorkan kelebihan tersebut ke Kas Negara.</td>
            </tr>
            <tr>
                <td colspan="2" style=" text-align: justify;">
                    <br>
                    Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya. 
                </td>
            </tr>
        </table>
        <br><br>
        <table style="width: 100%" class="dalem">
            <tr>
                <td></td>
                <td></td>
                <td style="text-align:center;">Banjarmasin, {{tgl_indo($data->date)}}</td>
            </tr>
            <tr>
                <td style="text-align:center;">Mengetahui/Menyetujui :</td>
                <td></td>
                <td style="text-align:center;"></td>
            </tr>
            <tr>
                <td style="text-align:center;">
                    Pejabat pembuat Komitmen,
                </td>
                <td></td>
                <td style="text-align:center;">Pelaksana SPD,</td>
            </tr>
            <tr>
                <td style="height: 80px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="line-height: 1; text-align:center;">
                    @if ($item->out->ppk_id != 0)
                        <u>{{$item->out->ppk->user->name}}</u> <br>
                        NIP. {{$item->out->ppk->user->no_pegawai}}
                    @endif
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
                    <td colspan="3" style="text-align:center; letter-spacing: 2px; line-height: 1; "><br><br><br>
                        <hr style="border:0.5px solid black; margin: 7px;">
                        BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</td>
                </tr>
                <tr>
                    <td colspan ="3" style="text-align:center; font-size:5; line-height: 1; ">
                        Jl. Brigjend H.Hasan Basri No.40 Banjarmasin - 70247 Telp (0511) 3304286, 3305115 ; Fax (0511) 3302162
                    </td>
                </tr>
            </tr>
        </table>
   </div>
</body>
@php
    $no++;
@endphp
@endforeach
</html>