<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/no_header.css')}}" rel="stylesheet"> --}}
    <title>Perencana Kegiatan</title>
    <style>
        @page {
            size: A4 landscape;
            font-size: 10px;
            /* margin: 150px 0px 100px 0px; */
        }
        html, table{
            font-family: Arial;
        }
        
        table, tr, td, th{
            border: solid 1px;
            vertical-align: top;
            border-collapse: collapse;
        }

        .ttdini{
            /* float: right; */
            margin-right: 10%;
            margin-left: 10%;
            font-size: 10;
        }

        .tab-ttd{
            border: none;
        }
        
        thead,th,tfoot{
            font-weight: bold;
            background-color:#DCDCDC;
        }

    </style>
</head>
<body>
    <div class="col-sm-12" style="text-align: center">
       <div style="align=center font-size: 18px">
           <h3><b>PENILAIAN KEGIATAN PERENCANAAN PEMBANGUNAN</b></h3>
       </div>
       <br>
    </div>
    <div id="isi">
        <table style="width: 100%">
           <thead>
                <tr>
                    <th style="width: 5%; text-align:center">NO</th>
                    <th colspan="2">I. PEJABAT PENILAI</th>
                    <th style="width: 5%; text-align:center">NO</th>
                    <th colspan="2">II. PNS YANG DINILAI</th>
                </tr>
           </thead>
            <tbody>
                <tr>
                    <td style="text-align:center">1</td>
                    <td style="width: 15%;">Nama</td>
                    <td>{{$data->skp->pejabat->user->name}}</td>
                    <td style="text-align:center">1</td>
                    <td style="width: 15%;">Nama</td>
                    <td>{{$data->skp->peg->name}}</td>            
                </tr>
                <tr>
                    <td style="text-align:center">2</td>
                    <td style="width: 15%;">NIP</td>
                    <td>{{$data->skp->pejabat->user->no_pegawai}}</td>
                    <td style="text-align:center">2</td>
                    <td style="width: 15%;">NIP</td>
                    <td>{{$data->skp->peg->no_pegawai}}</td>            
                </tr>
                <tr>
                    <td style="text-align:center">3</td>
                    <td style="width: 15%;">Pangkat/Gol.Ruang</td>
                    <td>{{$data->skp->pejabat->user->gol->jenis}},{{$data->skp->pejabat->user->gol->golongan}}/{{$data->skp->pejabat->user->gol->ruang}}</td>
                    <td style="text-align:center">3</td>
                    <td style="width: 15%;">Pangkat/Gol.Ruang</td>
                    <td>{{$data->skp->peg->gol->jenis}},{{$data->skp->peg->gol->golongan}}/{{$data->skp->peg->gol->ruang}}</td>            
                </tr>
                <tr>
                    <td style="text-align:center">4</td>
                    <td style="width: 15%;">Jabatan</td>
                    <td>
                        {{$data->skp->pejabat->user->jabatan->jabatan}}
                        @if ($data->skp->pejabat->user->subdivisi_id != null)
                            {{$data->skp->pejabat->user->subdivisi->nama_subdiv}}
                        @else
                            {{$data->skp->pejabat->user->divisi->nama}}
                        @endif
                    </td>
                    <td style="text-align:center">4</td>
                    <td style="width: 15%;">Jabatan</td>
                    <td>
                        {{$data->skp->peg->jabatan->jabatan}}
                        @if ($data->skp->peg->subdivisi_id != null)
                            {{$data->skp->peg->subdivisi->nama_subdiv}}
                        @else
                            {{$data->skp->peg->divisi->nama}}
                        @endif
                    </td>            
                </tr>
                <tr>
                    <td style="text-align:center">5</td>
                    <td style="width: 15%;">Unit kerja</td>
                    <td>Balai Besar POM di Banjarmasin</td>
                    <td style="text-align:center">5</td>
                    <td style="width: 15%;">Unit kerja</td>
                    <td>Balai Besar POM di Banjarmasin</td>            
                </tr>
            </tbody>
        </table>
        <table style="width: 100%">
            <thead>
                <tr>
                    <td style="text-align: center">NO</td>
                    <td style="text-align: center">TANGGAL</td>
                    <td style="text-align: center">RENCANA UTAMA</td>
                    <td style="text-align: center">BUTIR KEGIATAN</td>
                    <td style="text-align: center">KODE BUTIR</td>
                    <td style="text-align: center">KELUARAN</td>
                    <td style="text-align: center">PELAKSANA</td>
                    <td style="text-align: center">AK</td>
                    <td style="text-align: center">SEKERTARIAT TIM PENILAI</td>
                    <td style="text-align: center">TIM PENILAI I</td>
                    <td style="text-align: center">TIM PENILAI II</td>
                </tr>
                <tr>
                    <td style="text-align: center">(1)</td>
                    <td style="text-align: center">(2)</td>
                    <td style="text-align: center">(3)</td>
                    <td style="text-align: center">(4)</td>
                    <td style="text-align: center">(5)</td>
                    <td style="text-align: center">(6)</td>
                    <td style="text-align: center">(7)</td>
                    <td style="text-align: center">(8)</td>
                    <td style="text-align: center">(9)</td>
                    <td style="text-align: center">(10)</td>
                    <td style="text-align: center">(11)</td>
                </tr>
            </thead>
           <tbody>
                @php
                    $no= 1;
                @endphp
                @foreach ($isian as $item)
                <tr>
                    <td style="text-align: center">{{$no}}</td>
                   <td>{{tgl_indo($item->kin_date)}}</td>
                   <td>{{$item->detail->activity}}</td>
                   <td>{{$item->set->uraian}}</td>
                   <td>{{$item->set->kode_ak}}</td>
                   <td>{{$item->set->hasil}}</td>
                   <td>{{$item->set->pelaksana}}</td>
                   <td style="text-align: center">
                    {{$item->nilai_ak}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @php
                    $no++
                @endphp
                @endforeach
           </tbody>
           <tfoot>
               <tr>
                   @php
                       $a = number_format((float)$hit->nilai_ak, 2, '.', '');
                   @endphp          
                    <td colspan="7" style="text-align: center">Total AK</td>
                    <td style="text-align: center">{{$a}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
               </tr>
           </tfoot>

        </table>
    </div>
    <br>
    <div class="ttdini">
        <table style="width: 100%" class="tab-ttd">
            <tr class="tab-ttd">
                <td class="tab-ttd"></td>
                <td class="tab-ttd" style="text-align: center;">Banjarmasin, {{tgl_indo($data->plan_date)}} </td>
            </tr>
            <tr class="tab-ttd">
                <td class="tab-ttd"  style="text-align: center;">Pegawai Yang Menilai,</td>
                <td class="tab-ttd" style="text-align: center;">Pegawai Yang Dinilai,</td>
            </tr>
            <tr class="tab-ttd">
                <td class="tab-ttd" style="height: 10%%"></td>
                <td class="tab-ttd" style="height: 10%"></td>
            </tr>
            <tr class="tab-ttd">
                <td class="tab-ttd" style="text-align: center;">
                   <b> <u>{{$data->skp->pejabat->user->name}}</u></b><br>
                    NIP. {{$data->skp->pejabat->user->no_pegawai}}
                </td>
                <td class="tab-ttd" style="text-align: center;">
                   <b> <u>{{$data->skp->peg->name}}</u></b><br>
                    NIP. {{$data->skp->peg->no_pegawai}}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>