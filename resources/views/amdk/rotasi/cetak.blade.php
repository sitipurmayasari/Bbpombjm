<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Evaluasi</title>
</head>
<style>
    table{
        width: 100%;
        margin-left: 10px;
    }
    .garis{
        border: solid 1px black;
        border-collapse: collapse;  
        padding: 5px; 
    }
    .ttdini{
            font-size: 12;
            font-weight: normal;
            font-style: normal;;
            width: 100%;
        }
</style>
<body>
    <div>
        <h3 style="text-align: center"><b>
            FORMULIR EVALUASI PEGAWAI <br>
            BALAI BESAR POM DI BANJARMASIN
        </b></h3>
        <br>
        <b>A. Informasi Umum</b>
        <table>
            <table>
                <tr>
                    <td style="width: 20%">Jenis Kegiatan</td>
                    <td>&nbsp;:
                       <b>
                        @if ($data->status=='R')
                            Rotasi/Mutasi Pegawai
                        @elseif ($data->status=='M')
                            Penempatan Pegawai Pindahan
                        @elseif ($data->status=='N')
                            Penempatan Pegawai Baru
                        @else
                            Penempatan PPNPN
                        @endif
                       </b>
                    </td>
                </tr>
                <tr>
                    <td>Nama Pegawai</td>
                    <td>&nbsp;:
                       <b> {{$data->pegawai->name}}</b>
                    </td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>&nbsp;:
                        <b>{{$data->pegawai->no_pegawai}}</b>
                    </td>
                </tr>
                <tr>
                    <td>Pangkat/Golongan</td>
                    <td>&nbsp;:
                        <b>
                            @if ($data->pegawai->golongan_id != null)
                                {{$data->pegawai->gol->jenis}} / {{$data->pegawai->gol->golongan}}/{{$data->pegawai->gol->ruang}}
                            @else
                                -
                            @endif
                        </b>
                    </td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>&nbsp;:
                       <b>
                            @if ($data->pegawai->jabasn_id != null)
                                {{$data->pegawai->jabasn->nama}}
                            @else
                                {{$data->pegawai->deskjob}}
                            @endif
                       </b>
                    </td>
                </tr>
                <tr>
                    <td>Penempatan Lama</td>
                    <td>&nbsp;:
                       <b> {{$data->old}}</b>
                    </td>
                </tr>
                <tr>
                    <td>Penempatan Baru</td>
                    <td>&nbsp;:
                        <b>{{$data->new}}</b>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Penempatan</td>
                    <td>&nbsp;:
                        <b>{{tgl_indo($data->placementDate)}}</b>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Evaluasi</td>
                    <td>&nbsp;:
                        <b>{{tgl_indo($data->dates)}}</b>
                    </td>
                </tr>
            </table>
        </table>
        <br><br>
        <b>B. Penilaian</b> <br>
        <table class="garis">
            <thead class="garis">
                <th class="garis" style="width: 5%">No</th>
                <th class="garis">Pernyataan</th>
                <th class="garis" style="width: 20%;">Nilai</th>
            </thead>
            <tbody class="garis">
                @php
                    $no = 1;
                    $rata = 0;
                @endphp
                @foreach ($detail as $item)
                <tr class="garis">
                    <td class="garis" style="text-align: center; vertical-align:top;">{{$no}}</td>
                    <td class="garis" style="text-align: left;">
                        {{$item->statement}}
                    </td>
                    <td class="garis"  style="text-align: center; vertical-align:top;">
                        {{$item->values}}
                    </td>
               </tr>   
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
            <tfoot class="garis">
                <tr class="garis">
                    <td class="garis" colspan="2"><b>Rata - Rata</b></td>
                    <td class="garis" style="text-align: center;">
                       {{$result->avg}}
                    </td>
                </tr>
                <tr class="garis">
                    <td class="garis" colspan="2"><b>Kesimpulan</b></td>
                    <td class="garis" style="text-align:center;">
                        @if ($result->avg > $data->min)
                            Sesuai
                        @else
                            Tidak Sesuai
                        @endif
                    </td>
                </tr>
                <tr class="garis">
                    <td class="garis" colspan="3"><b>Informasi lain yang penting untuk disampaikan:</b> <br>
                        {{$data->information}}
                    </td>
                </tr>
            </tfoot>
        </table>
        <br><br>
        <div>
            <table class="ttdini" style="width: 100%" >
                <tr>
                    <td></td>
                    <td style="width: 40%;">
                        Ketua Tim
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        @if ($data->penilai->ttd != null)
                            <img src="{{$data->penilai->ttd->getFoto()}}"  style="height:90px;">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <u>{{$data->penilai->name}}</u> <br>
                        NIP. {{$data->penilai->no_pegawai}}
                        
                    </td>
                </tr>
        </div>
    </div>
</body>
</html>