@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Surat Pernyataan 30% Penginapan</title>

    <style>
        @page {
            size: A4;
            font-family: 'Arial';
            font-size: 10;
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
    <div>
        <h5 style="text-align: center"><b>SURAT IZIN PEMBAYARAN 30% BIAYA PENGINAPAN</b></h5>
    </div>
    <br>
    <table style="width: 100%">
        <tr>
            <td colspan="4">Yang Bertanda Tangan di Bawah ini : </td>
        </tr>
        <tr>
            <td style="width: 30%">Nama</td>
            <td  style="width: 1%">:</td>
            <td colspan="2"><b>{{$petugas->user->name}}</b></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td colspan="2"> {{$petugas->user->no_pegawai}}</td>
        </tr>
        <tr>
            <td>Pangkat / Gol.</td>
            <td>:</td>
            <td colspan="2"> {{$petugas->user->gol->jenis}} / {{$petugas->user->gol->golongan}} {{$petugas->user->gol->ruang}}</td>
        </tr>
        <tr>
            <td style="vertical-align: top">Jabatan</td>
            <td style="vertical-align: top">:</td>
            <td colspan="2"> {{$petugas->jenis}} <br></td>
        </tr>
        <tr>
            <td>Berdasarkan Surat Tugas Nomor</td>
            <td>:</td>
            <td> 
                <b>{{$item->out->number}}</b>
            </td>
            <td>tanggal : {{tgl_indo($item->out->st_date)}}</td>
        </tr>
        <tr>
            <td style="vertical-align: top">Maksud</td>
            <td style="vertical-align: top">:</td>
            <td colspan="2"> 
                {{$item->out->purpose}}
            </td>
        </tr>
        <tr>
            <td>Di Kota (Tujuan)</td>
            <td>:</td>
            <td colspan="2">
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
        <tr>
            <td colspan="4">
                <br><br>
                Dengan ini memberikan Izin Kepada : 
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td colspan="2"><b>{{$item->pegawai->name}}</b></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td colspan="2"> 
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->no_pegawai}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>Pangkat / Gol.</td>
            <td>:</td>
            <td colspan="2"> 
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->gol->jenis}} / 
                    {{$item->pegawai->gol->golongan}} {{$item->pegawai->gol->ruang}}
                @endif
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td colspan="2"> 
                {{$item->pegawai->deskjob}}
                <br>
            </td>
        </tr>
       
    </table>
    <br><br><br>
    <p>Untuk :</p>
    <table>
        @php
            $detail = $injectQuery->getDetail($item->id);
            $nilai = $injectQuery->getkkp($item->id);
        @endphp
        <tr>
            <td style="vertical-align: top">1.</td>
            <td>Tidak menginap di Hotel/Tempat Penginapan Umum dan menginap di {{$detail->innname_1}}</td>
        </tr>
        <tr>
            @php
                $a = $nilai->hotelmax1;
                $b = $nilai->hotelmax2;

                if ($b != null) {
                    $hotelmax = $nilai->hotelmax2;
                } else {
                    $hotelmax = $nilai->hotelmax1;
                }
                
                $terima30 = $hotelmax*(30/100);
            @endphp
            <td style="vertical-align: top">2.</td>
            <td>Dibayarkan 30% biaya penginapan dari SBM Biaya Penginapan daerah tujuan tersebut, <br>
                yaitu : 30% x Rp. {{number_format($hotelmax)}} = Rp. {{number_format($terima30)}}
            </td>
        </tr>
    </table>
    <br>
    <p>
        Demikian surat pernyataan ini saya buat untuk dapat dipergunakan sebgaimana mestinya, 
    </p> <br><br>
    <table style="width: 100%">
        <tr>
            <td style="width: 60%"></td>
            <td style="text-align: center;">{{$item->out->cityfrom->capital}}, {{tgl_indo($data->date)}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: center;">Kuasa Pengguna Anggaran <br>
                , <br><br><br><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: center;"><u><b>{{$petugas->user->name}}</b></u></td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: center;">
                @if ($petugas->user->golongan_id != null)
                    NIP. {{$petugas->user->no_pegawai}}
                @else
                    NIP. -
                @endif
            </td>
        </tr>
    </table>
</body>
@endforeach
</html>