<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/no_header.css')}}" rel="stylesheet"> --}}
    <title>SKP {{$data->dates}}</title>
    <style>
        @page {
            size: A4;
            font-size: 10px;
            /* margin: 150px 0px 100px 0px; */
        }
        html, table{
            font-family: Arial;
        }
        /* #isi{
            /* font-family: Arial; */
            /* font-size: 11; */
            /* margin-left: 8%;
            margin-right: 10%;
            line-height: 2; */
        } */
        
        table, tr, td{
            border: solid 1px;
            vertical-align: top;
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

    </style>
</head>
<body>
    <div class="col-sm-12" style="text-align: center">
       <div style="align=center font-size: 18px">
           <h3><b>SASARAN KERJA PEGAWAI</b></h3>
       </div>
       <br>
    </div>
    <div id="isi">
        <table style="width: 100%">
            <tr>
                <td style="width: 5%; text-align:center">NO</td>
                <td colspan="2">I. PEJABAT PENILAI</td>
                <td style="width: 5%; text-align:center">NO</td>
                <td colspan="2">II. PNS YANG DINILAI</td>
            </tr>
            <tr>
                <td style="text-align:center">1</td>
                <td style="width: 15%;">Nama</td>
                <td>{{$data->pejabat->user->name}}</td>
                <td style="text-align:center">1</td>
                <td style="width: 15%;">Nama</td>
                <td>{{$data->peg->name}}</td>            
            </tr>
            <tr>
                <td style="text-align:center">2</td>
                <td style="width: 15%;">NIP</td>
                <td>{{$data->pejabat->user->no_pegawai}}</td>
                <td style="text-align:center">2</td>
                <td style="width: 15%;">NIP</td>
                <td>{{$data->peg->no_pegawai}}</td>            
            </tr>
            <tr>
                <td style="text-align:center">3</td>
                <td style="width: 15%;">Pangkat/Gol.Ruang</td>
                <td>{{$data->pejabat->user->gol->jenis}},{{$data->pejabat->user->gol->golongan}}/{{$data->pejabat->user->gol->ruang}}</td>
                <td style="text-align:center">3</td>
                <td style="width: 15%;">Pangkat/Gol.Ruang</td>
                <td>{{$data->peg->gol->jenis}},{{$data->peg->gol->golongan}}/{{$data->peg->gol->ruang}}</td>            
            </tr>
            <tr>
                <td style="text-align:center">4</td>
                <td style="width: 15%;">Jabatan</td>
                <td>
                    {{$data->pejabat->user->jabatan->jabatan}}
                    @if ($data->pejabat->user->subdivisi_id != null)
                        {{$data->pejabat->user->subdivisi->nama_subdiv}}
                    @else
                        {{$data->pejabat->user->divisi->nama}}
                    @endif
                </td>
                <td style="text-align:center">4</td>
                <td style="width: 15%;">Jabatan</td>
                <td>
                    {{$data->peg->jabatan->jabatan}}
                    @if ($data->peg->subdivisi_id != null)
                        {{$data->peg->subdivisi->nama_subdiv}}
                    @else
                        {{$data->peg->divisi->nama}}
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
        </table>
        <table style="width: 100%">
            <thead>
                <tr>
                    <td rowspan="2" style="width:3%;vertical-align:middle;text-align: center">NO</td>
                    <td rowspan="2" style="width:30%;vertical-align:middle;">III. KEGIATAN TUGAS JABATAN</td>
                    <td rowspan="2" style="text-align:center;width:5%;vertical-align:middle;" >AK</td>
                    <td rowspan="2" style="text-align:center;width:5%;vertical-align:middle;" >TOTAL AK</td>
                    <td colspan="4" style="text-align:center; width:5%;vertical-align:middle;" >TARGET</td>
                </tr>
                <tr>
                    <td style="text-align:center;width:5%">KUAN/ OUTPUT</td>
                    <td style="text-align:center;width:5%" >KUAL/ MUTU</td>
                    <td style="text-align:center;width:5%; vertical-align:middle;" >WAKTU</td>
                    <td style="text-align:center;width:5%" >BIAYA (RP.)</td>
                </tr>
            </thead>
           <tbody>
                @php
                    $no= 1;
                @endphp
                @foreach ($isian as $item)
                <tr>
                    <td style="text-align: center">{{$no}}</td>
                    <td>{{$item->activity}}</td>
                    <td style="text-align: center">{{$item->n_ak}}</td>
                    <td style="text-align: center">{{$item->tot_ak}}</td>
                    <td style="text-align: center">{{$item->quan}} {{$item->jen}}</td>
                    <td style="text-align: center">{{$item->kual}}</td>
                    <td style="text-align: center">{{$item->time}} bulan</td>
                    <td style="text-align: center">{{$item->cost}}</td>
                </tr>
                @php
                    $no++
                @endphp
                @endforeach
           </tbody>
           <tfoot>
               <tr>
                   @php
                       $a = number_format((float)$hit->n_ak, 2, '.', '');
                       $b = number_format((float)$hit->tot_ak, 2, '.', '');
                   @endphp          
                    <td colspan="2" style="text-align: center">Total</td>
                    <td style="text-align: center">{{$a}}</td>
                    <td style="text-align: center">{{$b}}</td>
                    <td colspan="4"></td>
               </tr>
           </tfoot>

        </table>
    </div>
    <br>
    <div class="ttdini">
        <table style="width: 100%" class="tab-ttd">
            <tr class="tab-ttd">
                <td class="tab-ttd"></td>
                <td class="tab-ttd" style="text-align: center;">Banjarmasin, {{tgl_indo($data->dates)}} </td>
            </tr>
            <tr class="tab-ttd">
                <td class="tab-ttd"  style="text-align: center;">Pejabat Penilai,</td>
                <td class="tab-ttd" style="text-align: center;">PNS Yang Dinilai,</td>
            </tr>
            <tr class="tab-ttd">
                <td class="tab-ttd" style="height: 10%%"></td>
                <td class="tab-ttd" style="height: 10%"></td>
            </tr>
            <tr class="tab-ttd">
                <td class="tab-ttd" style="text-align: center;">
                   <b> <u>{{$data->pejabat->user->name}}</u></b><br>
                    NIP. {{$data->pejabat->user->no_pegawai}}
                </td>
                <td class="tab-ttd" style="text-align: center;">
                   <b> <u>{{$data->peg->name}}</u></b><br>
                    NIP. {{$data->peg->no_pegawai}}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>