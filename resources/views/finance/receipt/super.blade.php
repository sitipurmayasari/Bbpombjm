@inject('InjectNew', 'App\InjectNew')
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

        th{
            vertical-align: middle;
        }

        </style>

</head>
@foreach ($pegawai as $item)
    
<body>
    <br>
    <div style="text-align: center">
        <h5><b>SURAT PERNYATAAN</b></h5>
    </div>
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
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->no_pegawai}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>Pangkat / Gol.</td>
            <td colspan="2"> : 
                @if ($item->pegawai->golongan_id != null)
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
    A. TIKET PERJALANAN
    <table style="width: 100%" class="isi">
        <thead>
            <tr>
                <th  class="isi" style="width: 10%; text-align:center;">No</th>
                <th  class="isi" style="text-align: center;">Maskapai</th>
                <th  class="isi" style="text-align: center;">No. Tiket</th>
                <th  class="isi" style="text-align: center;">Tanggal</th>
                <th  class="isi" style="text-align: center;">Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $data1 = $InjectNew->AllPesawat($item->id);
                $no = 1;
            @endphp
            @if (count($data1) === 0)
                <tr>
                    <td colspan="5" style="text-align:center;  height:5%;"> N  &nbsp;I  &nbsp;H  &nbsp;I  &nbsp;L </td>
                </tr>
            @else
                @foreach ($data1 as $item2)
                <tr>
                    @if ($item2 != null)
                        <td  class="isi" style="text-align: center;  height:5%;"> {{$no}}</td>
                        <td  class="isi"> {{$item2->plane->name}}</td>
                        <td  class="isi" style="text-align: center"> {{$item2->ticketnumber}}</td>
                        <td  class="isi" style="text-align: center"> {{tgl_indo($item2->ticketdate)}}</td>
                        <td  class="isi" style="text-align: center"> Rp. {{number_format($item2->ticketfee)}},-</td>
                    @else
                        
                    @endif
                    
                </tr>
                @php
                    $no++;
                @endphp
             @endforeach
            @endif
        </tbody>
    </table>
    <br>
    B. PENGINAPAN
    <table style="width: 100%" class="isi">
        <thead>
            <tr>
                <th  class="isi" style="width: 10%; text-align:center;">No</th>
                <th class="isi" style="text-align: center">Nama Hotel</th>
                <th class="isi" style="text-align: center">Lama</th>
                <th class="isi" style="text-align: center">Rate (Rp.)</th>
                <th class="isi" style="text-align: center">Klaim (Rp.)</th>
                <th class="isi" style="text-align: center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $data2 = $InjectNew->AllHotel($item->id);
                $no = 1;
            @endphp
            @if (count($data2) === 0)
                <tr>
                    <td colspan="6" style="text-align:center;  height:5%;"> N  &nbsp;I  &nbsp;H  &nbsp;I  &nbsp;L </td>
                </tr>
            @else
                @foreach ($data2 as $item3)
                <tr>
                    @if ($item3 != null) 
                        <td  class="isi" style="text-align: center;  height:5%;"> {{$no}}</td>
                        <td  class="isi"> {{$item3->hotelname}}</td>
                        <td  class="isi" style="text-align: center"> {{$item3->hotellong}} Hari</td>
                        <td  class="isi" style="text-align: center"> Rp. {{number_format($item3->hotelfee)}},-</td>
                        <td  class="isi" style="text-align: center"> Rp. {{number_format($item3->hotelsum)}},-</td>
                        <td  class="isi">  1 kamar untuk {{$item3->person}} orang</td>
                    @else
                        
                    @endif
                    
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
            @endif
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
                @if ($item->pegawai->golongan_id != null)
                    NIP. {{$item->pegawai->no_pegawai}}
                @endif
            </td>
        </tr>
    </table>
</body>

@endforeach

</html>