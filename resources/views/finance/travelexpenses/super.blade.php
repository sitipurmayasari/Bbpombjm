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
            font-size: 11;
            line-height: 1;

        }

        </style>

</head>
@foreach ($pegawai as $item)
    
<body>
    <table style="width: 100%">
        <tr>
            <td colspan="3">Yang Bertanda tangan di bawah ini</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$item->pegawai->name}}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>
                @if ($item->pegawai->status=='PNS')
                    {{$item->pegawai->no_pegawai}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>Pangkat / Gol.</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>

                <br>
            </td>
        </tr>
        <tr>
            <td>Berdasarkan Surat Tugas Nomor</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Maksud</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Di Kota (Tujuan)</td>
            <td>:</td>
            <td></td>
        </tr>
    </table>
    <p>Dengan ini menyatakan bahwa saya telah melaksanakan Perjalanan Dinas, dengan keterangan sebagai berikut :</p>
    <table>
        <thead>
            <th></th>
            <th>Maskapai</th>
            <th>No. Tiket</th>
            <th>Tanggal</th>
            <th>Harga</th>
        </thead>
        <tbody>
            <tr>
                <td>Tujuan</td>
                <td colspan="4">(Kota Tujuan 1)</td>
            </tr>
            <tr>
                <td>Berangkat</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Tujuan</td>
                <td colspan="4">(Kota Tujuan 2</td>
            </tr>
            <tr>
                <td>Berangkat</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <th>Nama Hotel</th>
            <th>Lama</th>
            <th>Rate (Rp.)</th>
            <th>Klaim (Rp.</th>
            <th>Keterangan</th>
        </thead>
        <tbody>
            <tr>
                <td colspan="5">Tujuan 1: ...............</td>
            </tr>
            <tr>
                <td>(NAma Hotel 1)</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5">Tujuan 1: ...............</td>
            </tr>
            <tr>
                <td>(NAma Hotel 1)</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <p>
        Dengan ini menyatakan bahwa bukti pertanggungjawaban yang saya sampaikan adalah benar. 
        Apabila di kemudian hari terdapat ketidaksesuaian, syaa bersedia mempertanggungjawabkan dan mengembalikan ke kas Negara.
        <br>
        Demikian surat pernyataan ini saya buat untuk dapat dipergunakan sebgaimana mestinya. 
    </p>
    <table style="float: left">
        <tr>
            <td>(kota asal), (tgl kuitansi)</td>
        </tr>
        <tr>
            <td>Yang membuat pernyataan, <br><br><br><br><br></td>
        </tr>
        <tr>
            <td><u>{{$item->pegawai->name}}</u></td>
        </tr>
        <tr>
            <td>
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