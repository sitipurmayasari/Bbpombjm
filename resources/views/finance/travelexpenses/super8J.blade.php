@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Surat Pernyataan > 8 Jam</title>

    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
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
    <br>
    <div style="text-align: center">
        <h5><b>SURAT PERNYATAAN</b></h5>
    </div>
    <br>
    <table style="width: 100%">
        <tr>
            <td colspan="2">Yang Bertanda tangan di bawah ini</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td > : {{$item->pegawai->name}}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td > : 
                @if ($item->pegawai->status=='PNS')
                    {{$item->pegawai->no_pegawai}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td > : 
                {{$item->pegawai->deskjob}}
                <br>
            </td>
        </tr>
        <tr>
            <td>Maksud</td>
            <td> : 
                {{$item->out->purpose}}
            </td>
        </tr>
    </table>
    <br>
    <p>Menyatakan dengan sesungguhnya bahwa telah melaksanakan perjalanan dinas dalam kota lebih dari 8 (delapan) jam 
        pada tanggal {{tgl_indo($item->out->st_date)}} di Kota
        @foreach ($tujuan as $key=>$kota)
            @if ($loop->first)
                {{$kota->destiny->capital}} 
            @endif
        @endforeach
        .
    </p>
    <p>
        Demikian surat pernyataan ini dibuat dengan sebenarnya dan apabila dikemudian hari ternyata surat pernyataan 
        ini tidak benar, saya bertanggung jawab penuh dan bersedia untuk mengembalikan diproses sesuai dengan ketentuan hukum 
        yang berlaku.
    </p>
    <br>
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