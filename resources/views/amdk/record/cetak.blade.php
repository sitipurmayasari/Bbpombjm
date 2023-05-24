<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekam-personil-ppnpn.xls");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Rekaman Personel PNS</title>
    <style>
        @page {
            size: A4 landscape;
            font-family: 'Times New Roman';
            font-size: 11px;
            page-break-after: always;
        }
        #simple-table{
           border: solid black;
        }

        .judul{
            border: none;
            border-collapse: collapse;
            font-weight: bold;
            text-align: left;
        }


        table, th, td{
            border: 1px solid black;
            
        }

        th{
            text-align: center;
        }
        td{
            padding-left: 3px;
            border-bottom: 0;
            border-top: 0;
            vertical-align: top;
        }

        .tbl{
            border-collapse: collapse;
            border: none;
        }

        .isi{
            height: 35px;
        }

        .cell-breakWord {
            word-wrap: break-word;
            max-width: 200px;
        }
        

    </style>
</head>
<body>
        <div class="col-sm-12" style="text-align: center">
            <div style="align=center font-size: 18px">
               <h1><u><b>Rekaman Personil</b></u></h1>
               <h3 style="text-transform: uppercase;">Bidang/Subbagian : 
                   @if ($data->subdivisi_id != null)
                    {{$data->subdivisi->nama_subdiv}} 
                   @else
                    {{$data->divisi->nama}}
                   @endif
               </h3>
            </div>
            <br>
            <div>
                <table style="font-size: 12px;" class="judul">
                    <tr>
                        <td class="judul" style="width: 20%;">Nama</td>
                        <td class="judul">: {{$data->name}}</td>
                    </tr>
                    <tr class="judul">
                        <td class="judul">Tempat/Tanggal Lahir</td>
                        <td class="judul"> : {{$data->tempat_lhr}} / {{tgl_indo($data->tgl_lhr)}}</td>
                    </tr>
                    <tr class="judul">
                        <td class="judul">Pendidikan Terakhir</td>
                        <td class="judul"> : 
                            @if ($pend != null)
                                {{$pend->jur->jurusan}}
                            @else
                                (Data Belum Terecord)
                            @endif
                        </td>
                    </tr>
                    <tr class="judul">
                        <td class="judul">NIP</td>
                        <td class="judul"> : {{$data->no_pegawai}}</td>
                    </tr>
                    <tr class="judul">
                         <td class="judul">TMT Capeg</td>
                         <td class="judul"> : 
                             @if ($data->TMT_Capeg != null)
                                {{tgl_indo($data->TMT_Capeg)}}
                             @else
                                 (Data Belum terecord)
                             @endif
                         </td>
                     </tr>
                </table>
            </div>
         </div>
         <br>
        <div>
            <table style="font-size: 11px; width:100%"; >
                <thead style="font-size: 12px;">
                   <tr>
                       <th colspan="3">Pengalaman Kerja</th>
                       <th colspan="3">Pendidikan Formal Tambahan</th>
                       <th colspan="4">Pelatihan</th>
                       <th rowspan="2" style="vertical-align: middle;">Ket</th>
                   </tr>
                   <tr>
                       <th>No</th>
                       <th>Jabatan</th>
                       <th>Tahun</th>
                       <th>No</th>
                       <th>Jenis Pendidikan / Tempat</th>
                       <th>Tahun Lulus</th>
                       <th>No</th>
                       <th>Jenis dan Tempat</th>
                       <th>Waktu</th>
                       <th>Sertifikat</th>
                   </tr>
                </thead>
                <tbody class="tbl">
                   <tr>
                        @if ($pengalaman != null)
                           <td style="text-align: center;">
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pengalaman as $item)
                                    <div class="isi">
                                        {{$no++}} 
                                    </div ><br>
                                @endforeach
                           </td>
                           <td>
                                @foreach ($pengalaman as $item)
                                    <div  class="isi">
                                        {{$item->jabatan}} - {{$item->instansi}} 
                                    </div><br>
                                @endforeach
                               
                           </td>
                           <td>
                                @foreach ($pengalaman as $item)
                                   <div  class="isi">
                                        {{tgl_indo($item->tgl_mulai)}} s/d 

                                        @if ($item->tgl_selesai != null)
                                            {{tgl_indo($item->tgl_selesai)}}
                                        @else
                                            Sekarang
                                        @endif
                                   </div> <br>
                                @endforeach
                           </td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                        @if ($pendidikan != null)
                           <td style="text-align: center;">
                                @php
                                    $noa = 1;
                                @endphp
                               @foreach ($pendidikan as $item)
                                    <div class="isi">
                                        {{$noa++}} 
                                    </div><br>
                               @endforeach
                           </td>
                           <td>
                               @foreach ($pendidikan as $item)
                                <div class="isi">
                                    {{$item->jur->jurusan}} {{$item->nama_sekolah}} 
                                </div><br>
                               @endforeach
                           </td>
                           <td style="text-align: center">
                               @foreach ($pendidikan as $item)
                                <div class="isi">
                                    {{$item->thn_lulus}}
                                </div> <br>
                               @endforeach
                           </td>
                       @else
                           <td></td>
                           <td></td>
                           <td></td>
                       @endif
                       @if ($pelatihan != null)
                           <td style="text-align: center">
                                @php
                                    $nob = 1;
                                @endphp
                               @foreach ($pelatihan as $item)
                                <div class="isi">
                                    {{$nob++}} 
                                </div><br>
                               @endforeach
                           </td>
                           <td class="cell-breakWord">
                               @foreach ($pelatihan as $item)
                                <div class="isi">
                                    {{$item->nama}}
                                </div><br>
                               @endforeach
                           </td>
                           <td>
                               @foreach ($pelatihan as $item)
                                <div class="isi">
                                    {{tgl_indo($item->dari)}} s/d {{tgl_indo($item->sampai)}} 
                                </div><br>
                               @endforeach
                           </td>
                           <td>
                               @foreach ($pelatihan as $item)
                               <div class="isi">
                                    @if ($item->terekam == 'Y')
                                        Ada
                                    @else
                                        Tidak Ada
                                    @endif
                               </div><br>
                               @endforeach
                           </td>
                       @else
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                       @endif
                       <td></td>
                   </tr>
                </tbody>
            </table>
        </div>
</body>
</html>