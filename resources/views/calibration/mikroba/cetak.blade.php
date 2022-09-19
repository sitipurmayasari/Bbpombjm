@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catatan Pengujian</title>
    <style>
        @page {
            size:8.5in 13in;
            font-family: Arial;
            margin: 10px 15px 10px 15px;
            font-size: 11;
        }

        table,tr,td, th{
            padding-left: 5px; 
            border: 1px solid black;
            vertical-align : top;
            border-collapse: collapse;
        }

        th{
            font-weight: bold;
            vertical-align: middle;
            text-align: center;
        } 

        .noborder {
            text-align: left;
            border-collapse: collapse;
            border: none;
            
        }
        
        </style>
</head>
<body>
    <h3 style="text-align: center;text-transform: uppercase;">LAMPIRAN CATATAN PENGUJIAN : {{$data->bakteri->name}} </h3>
    <table style="width: 100%">
        <tr>
            <td style="width: 30%">Baku Uji : <br>
                <b>{{$data->bakteri->name}} - {{$data->kode}}</b>
            </td>
            <td style="width: 20%">No. Kode Baku uji : <br>
                <b>{{$data->number}}</b>
            </td>
            <td>
                <table  class="noborder">
                    <tr  class="noborder">
                        <td  class="noborder">Tgl Diuji</td>
                        <td  class="noborder">:</td>
                        <td  class="noborder">{{tgl_indo($data->dates)}} </td>
                    </tr>
                    <tr  class="noborder">
                        <td  class="noborder">Penguji</td>
                        <td  class="noborder">:</td>
                        <td  class="noborder">{{$data->pegawai->name}} </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table style="width:100%">
        <thead>
            <tr>
                <th style="width: 20%">Tanggal</th>
                <th>Kegiatan</th>
                <th style="width: 60%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{tgl_indo($data->media_date)}}<br>
                    {{tgl_indo($data->baku_date)}} <br>
                    {{tgl_indo($data->tumbuh_date)}}
                </td>
                <td>
                    Pembuatan Media <br>
                    Pengambilan baku uji <br>
                    Media Pertumbuhan 
                </td>
                <td>
                    {{$data->media_ket}} <br>
                    {{$data->baku_ket}} Bead <br>
                    {{$data->tumbuh_ket}} mL BHIB
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%">
        <thead>
            <tr>
                <th rowspan="2" style="width: 10%">Tanggal</th>
                <th rowspan="2">Media</th>
                <th colspan="2">Inkubasi</th>
                <th colspan="2">Pengamatan</th>
            </tr>
            <tr>
                <th>Suhu <br> ( °C )</th>
                <th>Waktu <br> ( Jam )</th>
                <th style="width: 28%">Baku Uji</th>
                <th style="width: 28%">Pengamatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $item)
                <tr>
                    <td style="border:none; height:50px;">
                        {{date("d/m/Y", strtotime($item->amati_date))}}
                    </td>
                    <td style="border-top:0px; border-bottom: 0px;">
                        {{$item->media->name}}
                    </td>
                    <td style="text-align: center; border-top:0px; border-bottom: 0px;">
                        {{$item->media->temperature}}
                    </td>
                    <td style="text-align: center; border-top:0px; border-bottom: 0px;">
                        {{$item->media->period}}
                    </td>
                    <td  style="border-top:0px; border-bottom: 0px;">
                        {{$item->kontrol->status}}
                    </td>
                    <td  style="border-top:0px; border-bottom: 0px;">
                        @php
                            $kontrol = $injectQuery->carikontrol($item->media_id);
                        @endphp
                        {{$kontrol->status}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="noborder" style="width:100%">
        <tr class="noborder">
            <td class="noborder" style="width: 8%; height:100px">Pengamatan</td>
            <td class="noborder" style="width: 3%">:</td>
            <td class="noborder">{{$data->hasil}}</td>
            <td class="noborder" style="width: 30%"></td>
        </tr>
        <tr class="noborder">
            <td class="noborder">Pustaka</td>
            <td class="noborder">:</td>
            <td class="noborder">{{$data->bakteri->ket}}</td>
            <td class="noborder" style="width: 30%">Syarat : Positif</td>
        </tr>
    </table>

    <hr>
    <table style="width: 100%">
        <tr>
            <td style="height: 30px">Kesimpulan</td>
            <td colspan="3">{{$data->kesimpulan}}</td>
        </tr>
        <tr>
            <td style="width: 20%;">
                Tanda Tangan Penguji <br><br><br><br>
                Tanggal
            </td>
            <td></td>
            <td style="width: 15%">Diperiksa Oleh<br><br><br><br>
                Tanggal
            </td>
            <td></td>
        </tr>
    </table>
</body>
</html>