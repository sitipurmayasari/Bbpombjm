@inject('InjectNew', 'App\InjectNew')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>SP Extend</title>

    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 11;
        }

        .isi{
            border: 1px solid black;
            line-height: 2.5;
            vertical-align: middle;
        }

        th{
            vertical-align: middle;
        }

        p{ text-align: justify;}

        </style>

</head>
@foreach ($pegawai as $item)
    
<body>
    <br>
    <div style="text-align: center">
        <h5><b>SURAT PERNYATAAN <br> PERJALANAN DINAS DENGAN PERPANJANGAN WAKTU (EXTEND)</b></h5>
    </div>
    <br>
    <table style="width: 100%">
        <tr>
            <td colspan="2">Yang Bertanda tangan di bawah ini</td>
        </tr>
        <tr>
            <td style="width: 30%">Nama</td>
            <td> : {{$item->pegawai->name}}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td> : 
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->no_pegawai}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>Pangkat / Gol.</td>
            <td> : 
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->gol->jenis}} / 
                    {{$item->pegawai->gol->golongan}} {{$item->pegawai->gol->ruang}}
                @endif
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td> : 
                {{$item->pegawai->deskjob}}
                <br>
            </td>
        </tr>
        <tr>
            <td>No dan Tanggal Surat Tugas</td>
            <td> : 
                {{$item->out->number}}, tanggal : {{tgl_indo($item->out->st_date)}}</td>
        </tr>
        <tr>
            <td>Tanggal Pelaksanaan Kegiatan</td>
            <td> : 
                @if (count($item->out->outst_destiny) == 1)
                    @foreach ($item->out->outst_destiny as $key=>$dates)
                        @if ($dates->go_date ==  $dates->return_date)
                            {{tgl_indo($dates->go_date)}} 
                        @else
                            {{tgl_indo($dates->go_date)}} s/d {{tgl_indo($dates->return_date)}}
                        @endif
                    @endforeach
                @else
                    @foreach ($item->out->outst_destiny as $key=>$dates)
                        @if ($loop->first)
                            {{tgl_indo($dates->go_date)}}
                            s/d
                        @endif
                        @if ($loop->last)
                        {{tgl_indo($dates->return_date)}}
                        @endif
                    @endforeach
                @endif
            </td>
        </tr>
    </table>
    <br>
    <p>
        Bersama dengan ini saya menyatakan bahwa berdasarkan waktu pelaksanaan surat tugas diatas, saya telah melakukan perjalanan dinas dengan perpanjangan waktu (extend). Selanjutnya terhadap hal tersebut maka saya menyatakan terhadap segala hal yang terjadi pada perjalanan dinas diluar waktu yang tercantum dalam surat tugas diatas menjadi tanggung jawab saya selaku pelaksana tugas. 
    </p>
    <p>
        Demikian surat pernyataan ini saya buat dengan penuh kesadaran dan rasa tanggung jawab, untuk dapat dipergunakan sebagaimana mestinya.
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