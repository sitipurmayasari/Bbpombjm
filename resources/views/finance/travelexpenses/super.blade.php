@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Surat Pernyataan</title>

    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 8;
        }

        .isi{
            border: 1px solid black;
            line-height: 2.5;
            vertical-align: middle;
        }

        </style>

</head>
@foreach ($pegawai as $item)
    
<body>
    <br>
    <table style="width: 100%">
        <tr>
            <td colspan="3">Yang Bertanda tangan di bawah ini</td>
        </tr>
        <tr>
            <td style="width: 25%">Nama</td>
            <td colspan="2"> : {{$item->pegawai->name}}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td colspan="2"> : 
                @if ($item->pegawai->status=='PNS')
                    {{$item->pegawai->no_pegawai}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>Pangkat / Gol.</td>
            <td colspan="2"> : 
                @if ($item->pegawai->status=="PNS")
                    {{$item->pegawai->gol->jenis}} / 
                    {{$item->pegawai->gol->golongan}} {{$item->pegawai->gol->ruang}}
                @endif
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td colspan="2"> : 
                {{$item->pegawai->deskjob}}
                <br>
            </td>
        </tr>
        <tr>
            <td>Berdasarkan Surat Tugas Nomor</td>
            <td> : 
                {{$item->out->number}}
            </td>
            <td>tanggal : {{tgl_indo($item->out->st_date)}}</td>
        </tr>
        <tr>
            <td>Maksud</td>
            <td> : 
                {{$item->out->purpose}}
            </td>
        </tr>
        <tr>
            <td>Di Kota (Tujuan)</td>
            <td> :
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
        </tr>
    </table>
    <br>
    <p>Dengan ini menyatakan bahwa saya telah melaksanakan Perjalanan Dinas, dengan keterangan sebagai berikut :</p>
    <br>
    <table style="width: 100%" class="isi">
        <thead>
            <tr>
                <th  class="isi" style="width: 10%"></th>
                <th  class="isi" style="text-align: center;">Maskapai</th>
                <th  class="isi" style="text-align: center;">No. Tiket</th>
                <th  class="isi" style="text-align: center;">Tanggal</th>
                <th  class="isi" style="text-align: center;">Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td  class="isi"><b>Tujuan</b></td>
                <td colspan="4"  class="isi">
                    @foreach ($tujuan as $key=>$kota)
                        @if ($loop->first)
                            {{$kota->destiny->capital}} 
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                @php
                    $berangkat1 = $injectQuery->getPesawat($item->id);
                @endphp
                <td  class="isi">  &nbsp; Berangkat</td>
                <td  class="isi">  &nbsp;
                    @if ($berangkat1->maskapai1 != null)
                        {{$berangkat1->maskapai1}}
                    @else
                        {{ " " }}
                    @endif
                </td>
                <td  class="isi">  &nbsp;
                    @if ($berangkat1->maskapai1 != null)
                        {{$berangkat1->planenumber1}}
                    @else
                        {{ " " }}
                    @endif
                </td>
                <td  class="isi">  &nbsp;
                    @if ($berangkat1->maskapai1 != null)
                        {{tgl_indo($berangkat1->godate1)}}
                    @else
                        {{ " " }}
                    @endif
                </td>
                <td  class="isi"> &nbsp;
                    @if ($berangkat1->maskapai1 != null)
                      Rp. {{number_format($berangkat1->planefee1)}} ,-
                    @else
                      {{ " " }}
                    @endif
                </td>
            </tr>
            <tr>
                <td  class="isi"><b>Tujuan</b></td>
                <td colspan="4"  class="isi">
                    @if (count($item->out->outst_destiny) == 2)
                        @foreach ($tujuan as $key=>$kota)
                            @if ($loop->last)
                                {{$kota->destiny->capital}} 
                            @endif
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                @php
                    $berangkat2 = $injectQuery->getPesawat($item->id);
                @endphp
               <td  class="isi"> &nbsp; Berangkat</td>
               <td  class="isi"> &nbsp;
                    @if ($berangkat2->maskapai2 != null)
                        {{$berangkat2->maskapai2}}
                    @else
                        {{ " " }}
                    @endif
               </td>
               <td  class="isi"> &nbsp;
                    @if ($berangkat2->maskapai2 != null)
                        {{$berangkat2->planenumber2}}
                    @else
                        {{ " " }}
                    @endif
               </td>
               <td  class="isi"> &nbsp;
                    @if ($berangkat2->maskapai2 != null)
                        {{tgl_indo($berangkat2->godate2)}}
                    @endif
               </td>
               <td  class="isi"> &nbsp;
                    @if ($berangkat2->maskapai2 != null)
                        Rp. {{number_format($berangkat2->planefee2)}} ,-
                    @endif
               </td>
            </tr>
            <tr>
                @php
                    $bulik = $injectQuery->getPesawat($item->id);
                @endphp
                <td  class="isi"><b> &nbsp; Kembali</b></td>
                <td  class="isi"> &nbsp;
                    @if ($bulik->maskapaipulang != null)
                        {{$bulik->maskapaipulang}}
                    @endif
                </td>
                <td  class="isi"> &nbsp;
                    @if ($bulik->maskapaipulang != null)
                        {{$bulik->planenumberreturn}}
                    @endif
                </td>
                <td  class="isi"> &nbsp;
                    @if ($bulik->maskapaipulang != null)
                        {{tgl_indo($bulik->returndate)}}
                    @endif
                </td>
                <td  class="isi"> &nbsp;
                    @if ($bulik->maskapaipulang != null)
                        Rp. {{number_format($bulik->planereturnfee)}} ,-
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%" class="isi">
        <thead>
            <tr>
                <th class="isi" style="text-align: center">Nama Hotel</th>
                <th class="isi" style="text-align: center">Lama</th>
                <th class="isi" style="text-align: center">Rate (Rp.)</th>
                <th class="isi" style="text-align: center">Klaim (Rp.)</th>
                <th class="isi" style="text-align: center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5" class="isi">Tujuan : 
                    @foreach ($tujuan as $key=>$kota)
                        @if ($loop->first)
                            {{$kota->destiny->capital}} 
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                @php
                    $total1 = 0;
                    $lama = 0;
                    $harga = 0;
                    $hotel = $injectQuery->getDetail($item->id);
                @endphp
                <td class="isi">
                    @if ($hotel->innname_1 != null)
                        Hotel {{$hotel->innname_1}}
                    @endif
                    &nbsp;
                </td>
                <td class="isi" style="text-align: center">
                    @if ($hotel->innname_1 != null)
                        {{$hotel->long_stay_1}} Hari
                    @endif
                    &nbsp;
                </td>
                <td class="isi" style="text-align: center">
                    @if ($hotel->innname_1 != null)
                        {{number_format($hotel->inn_fee_1)}}
                    @endif
                    &nbsp;
                </td>
                <td class="isi" style="text-align: center">
                    @if ($hotel->innname_1 !='0')
                        {{number_format($hotel->klaim_1)}}
                    @endif
                    &nbsp;
                </td>
                <td class="isi" style="text-align: center">
                    @if ($hotel->innname_1 != null)
                        1 kamar {{$hotel->isi_1}} orang
                    @endif
                    &nbsp;
                </td>
            </tr>
            {{-- hotel ke dua --}}
            <tr>
                <td colspan="5" class="isi">Tujuan : 
                    @if (count($item->out->outst_destiny) == 2)
                        @foreach ($tujuan as $key=>$kota)
                            @if ($loop->last)
                                {{$kota->destiny->capital}} 
                            @endif
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                @php
                    $lamadua = 0;
                    $hargadua = 0;
                    $total2 = 0;
                    $hot = $injectQuery->getDetail($item->id);
                @endphp
                <td class="isi">
                    @if ($hot->inn_fee_2 != 0)
                        Hotel {{$hot->innname_2}}
                    @endif
                    &nbsp;
                </td>
                <td class="isi" style="text-align: center">
                    @if ($hot->inn_fee_2 != 0)
                        {{$hot->long_stay_2}} Hari
                    @endif
                    &nbsp;
                </td>
                <td class="isi" style="text-align: center">
                    @if ($hot->inn_fee_2 != 0)
                        {{number_format($hot->inn_fee_2)}}
                    @endif
                    &nbsp;
                </td>
                <td class="isi" style="text-align: center">
                    @if ($hot->inn_fee_2 != 0)
                        {{number_format($hot->klaim_2)}}
                    @endif
                    &nbsp;
                </td>
                <td class="isi" style="text-align: center">
                    @if ($hot->inn_fee_2 != 0)
                        1 kamar {{$hot->isi_2}} orang
                    @endif
                    &nbsp;
                </td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <p>
        Dengan ini menyatakan bahwa bukti pertanggungjawaban yang saya sampaikan adalah benar. <br>
        Apabila di kemudian hari terdapat ketidaksesuaian, saya bersedia mempertanggungjawabkan dan mengembalikan ke kas Negara.
        <br>
        Demikian surat pernyataan ini saya buat untuk dapat dipergunakan sebgaimana mestinya. 
    </p>
    <table style="width: 100%">
        <tr>
            <td style="width: 60%"></td>
            <td style="text-align: center;">{{$item->out->cityfrom->capital}}, {{tgl_indo($data->date)}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: center;">Yang membuat pernyataan, <br><br><br><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: center;"><u>{{$item->pegawai->name}}</u></td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: center;">
                @if ($item->pegawai->status=="PNS")
                    NIP. {{$item->pegawai->no_pegawai}}
                @else
                    NIP. -
                @endif
            </td>
        </tr>
    </table>
</body>

@endforeach

</html>