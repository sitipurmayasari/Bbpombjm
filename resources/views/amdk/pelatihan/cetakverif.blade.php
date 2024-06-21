<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Verifikasi</title>
</head>

<style>
    table{
        width: 100%;
    }
    th{
        text-align: center;
    }
    .garis{
        border: solid 1px black;
        border-collapse: collapse;
    }

    .isi{
        text-align: center;
        width: 40px;
    }

    .ttdini{
            font-size: 12;
            font-weight: normal;
            font-style: normal;;
            width: 100%;
        }
    .tick{
        font-family: DejaVu Sans, sans-serif;
    }
</style>

<body>
    <div style="text-align: center;">
        <b><u>LEMBAR EVALUASI EFEKTIFITAS PELATIHAN</u></b>
    </div>
    <br>
    <div>
        <table>
            <tr>
                <td colspan="3" style="text-align: center;">
                   <b> Identitas Pengisi</b>
                </td>
            </tr>
            <tr>
                <td style="width: 35%;">Nama</td>
                <td style="width:1%; text_align:center;">:</td>
                <td style="width: 64%;">
                    {{$data->evaluator->name}}
                </td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td style="text_align:center;">:</td>
                <td>
                    {{$data->jabasn->nama}}
                </td>
            </tr>
            <tr>
                <td>Instansi/Unit Kerja</td>
                <td style="text_align:center;">:</td>
                <td>
                    Balai Besar POM di Banjarmasin
                </td>
            </tr>
            <tr>
                <td>Hubungan dengan Peserta Pelatihan</td>
                <td style="text_align:center;">:</td>
                <td>
                    @if ($data->ketua =='Y')
                        Ketua Tim
                    @else
                        Kepala Balai Besar POM di Banjarmasin
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;"><br>
                    <b>Identitas Peserta Pelatihan yang di-Evaluasi</b></td>
                <td style="text_align:center;">:</td>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>Nama Peserta Pelatihan</td>
                <td style="text_align:center;">:</td>
                <td>
                    {{$data->user->name}}
                </td>
            </tr>
            <tr>
                <td>Nama Pelatihan yang diikuti</td>
                <td>:</td>
                <td>
                    {{$data->nama}}
                </td>
            </tr>
            <tr>
                <td>Tanggal Pelaksanaan Pelatihan</td>
                <td>:</td>
                <td>
                    @if ($data->dari == $data->sampai)
                        {{tgl_indo($data->dari)}}
                    @else
                        {{tgl_indo($data->dari)}} s/d {{tgl_indo($data->sampai)}}
                    @endif
                </td>
                <tr>
                    <td>Penyelenggara Pelatihan</td>
                    <td>:</td>
                    <td>
                        {{$data->penyelenggara}}
                    </td>
                </tr>
            </tr>
        </table>
        <br>
        <p>
            (Semua data dan informasi dalam evaluasi ini bersifat rahasia dan hanya digunakan untuk keperluan evaluasi pelaksanaan pelatihan)
        </p>
        <p>
            Isilah dengan memberi tanda checklist ( <b class="tick">✔</b> ) pada kotak tanggapan yang tersedia dengan kategori penilaian sebagai berikut: <br>
            5 : Sangat Sesuai <br>
            4 : Sesuai <br>
            3 : Netral <br>
            2 : Tidak Sesuai <br>
            1 : Sangat Tidak Sesuai <br>
        </p>
    </div>
    <div>
        <table class="garis">
            <thead>
                <tr class="garis">
                    <th class="garis isi">No.</th>
                    <th class="garis">Aspek yang dievaluasi</th>
                    <th class="garis isi">1</th>
                    <th class="garis isi">2</th>
                    <th class="garis isi">3</th>
                    <th class="garis isi">4</th>
                    <th class="garis isi">5</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($detail as $key=>$row)
                <tr class="garis">
                    <td class="garis isi" style="vertical-align: top;">
                        {{$no}}
                    </td>
                    <td class="garis">
                        {{$row->aspek_evaluasi}}
                    </td>
                    <td class="garis isi tick">
                        @if ($row->point == 1)
                           ✔
                        @endif
                    </td>
                    <td class="garis isi tick">
                        @if ($row->point == 2)
                           ✔
                        @endif
                    </td>
                    <td class="garis isi tick">
                        @if ($row->point == 3)
                           ✔
                        @endif
                    </td>
                    <td class="garis isi tick">
                        @if ($row->point == 4)
                           ✔
                        @endif
                    </td>
                    <td class="garis isi tick">
                        @if ($row->point == 5)
                           ✔
                        @endif
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
            
        </table>
    </div>
    <br>
    <div>
        <b>Evaluasi penguasaan kompetensi dan perubahan sikap/perilaku peserta pelatihan setelah mengikuti pelatihan</b><br>
        apakah setelah pelatihan peserta diberi penugasan sesuai dengan pelatihan
        yang telah diikuti? Jika iya, jelaskan penugasan yang diberikan : 
        <br>
        {{$evaluasi->coment}}
    </div>
    <br><br>
    <div>
        <table class="ttdini" style="width: 100%" >
            <tr>
                <td></td>
                <td style="width: 40%;">Banjarbaru, 
                    @php
                        $a = $evaluasi->date;
                        echo tgl_indo($a); 
                    @endphp
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    @if ($data->ketua !='Y')
                        @if ($kepala->pjs !=null)
                            {{$kepala->pjs}}
                        @endif
                    @endif     
                </td>
                <td>
                    @if ($data->ketua =='Y')
                        Ketua Tim
                    @else
                        Kepala Balai Besar POM di Banjarmasin
                    @endif
                   
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    @if ($data->evaluator->ttd != null)
                        <img src="{{$data->evaluator->ttd->getFoto()}}"  style="height:90px;">
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <u>{{$data->evaluator->name}}</u> <br>
                    NIP. {{$data->evaluator->no_pegawai}}
                    
                </td>
            </tr>
    </div>
</body>
</html>