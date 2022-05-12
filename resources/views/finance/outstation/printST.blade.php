<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/no_header.css')}}" rel="stylesheet"> --}}
    <title>Surat Tugas</title>
</head>
<style>
    @page {
        size:8.5in 13in ;
        margin: 155px 0px 100px 0px;
    }
    html, table{
            font-family: "Bookman Old Style";
            font-size: 12;
        }

        #kop{
            font-family: "Bookman Old Style";
            margin-left: 10%;
            margin-right: 10%;
            line-height: 1.5;
        }

        #isi{
            font-family: "Bookman Old Style";
            font-size: 12;
            margin-left: 10%;
            margin-right: 10%;
            line-height: 1;
            text-align: justify;
        }

        table, td, tr {
            text-align: justify;
            vertical-align: top;
            line-height: 1;
            font-size: 12;
        }

        .ttdini{
            float: right;
            margin-right: 10%;
            font-size: 12;
        }

        .detail{
            font-family: "Bookman Old Style";
            border: 1px solid black;
            font-size: 11;
            text-align: left;
            line-height: 1.5;
            vertical-align: top
        }
        th{
            border: 1px solid black;
            font-weight: bold;
            font-size: 10; 
            vertical-align: middle;
            text-align: center;
            line-height: 1;
        }

        #gratis{
            font-family: "Bookman Old Style";
            font-size: 12;
            color: brown;
            line-height: 1;
            text-align: center;
            border: 2px solid brown;
            margin: auto;
            margin-right: 20%;
            /* width: 70%; */
            padding-bottom: 13px;
            padding-top: 13px;
        }
        

</style>
<body>
    <br>
    <div class="col-sm-12" style="text-align: center">
        <div style="align=center;" id="kop">
            <u><b style="font-size: 14">SURAT TUGAS</b></u><br>
            <p style="font-size: 12">NOMOR : {{$data->number}}</p>
        </div>
        <br>
     </div>
     <div id="isi">
        <p>Yang bertanda-tangan di bawah ini Kepala Balai Besar Pengawas Obat dan Makanan di Banjarmasin,
            memerintahkan kepada nama - nama yang tersebut di bawah ini:</p>
        <br>
        
        <table style="width:100%" class="detail">
            <thead>
                <tr >
                    <th style="width: 5%">NO</th>
                    <th style="width: 30%">NAMA</th>
                    <th style="width: 20%">NIP</th>
                    <th style="width: 22%">PANGKAT / GOLONGAN</th>
                    <th style="width: 33%">JABATAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no= 1;
                @endphp
                @foreach($isian as $key=>$row)
                <tr>
                    <td class="detail" style="text-align: center;">
                        {{$no++}}
                    </td>
                    <td class="detail">
                        {{$row->pegawai->name}}
                    </td>
                    <td class="detail" style="text-align: center;">
                        @if ($row->pegawai->golongan_id != null)
                            {{$row->pegawai->no_pegawai}}
                        @else
                            {{' - '}}
                        @endif
                    </td>
                    <td class="detail" style="text-align: center;">
                       @if ($row->pegawai->golongan_id != null)
                        {{$row->pegawai->gol->jenis}} /  <br>
                        {{$row->pegawai->gol->golongan}} {{$row->pegawai->gol->ruang}}
                       @else
                           {{' - '}}
                       @endif
                    </td>
                    <td class="detail">
                        @if ($row->pegawai->jabasn_id != null)
                            {{$row->pegawai->jabasn->nama}}
                        @else
                            {{$row->pegawai->deskjob}}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
        <table style="width: 100%">
            <tr >
                <td style="width: 25%;">Tugas yang di berikan &nbsp;</td>
                <td>:</td>
                <td colspan="2">
                    {{$data->purpose}}
                </td>
            </tr>
            <tr>
                <td>Tujuan&nbsp;</td>
                <td>:</td>
                <td colspan="2"> 
                    @if (count($data->outst_destiny) == 1)
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->first)
                                {{$item->destiny->capital}} 
                            @endif
                            
                        @endforeach

                    @elseif (count($data->outst_destiny) == 2)
                        @foreach ($data->outst_destiny as $key=>$item)
                            {{$item->destiny->capital}}
                            @if ($data->outst_destiny->count()-1 != $key)
                                {{' dan '}}
                            @endif
                        @endforeach

                    @else
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->last-1)
                                {{$item->destiny->capital}}{{','}} 
                            @endif
                            @if ($loop->last)
                                {{' dan '}} {{$item->destiny->capital}}
                            @endif
                            
                        @endforeach
                    @endif    
                </td>
            </tr>
            <tr>
                <td>Kendaraan</td>
                <td>:</td>
                <td colspan="2">
                    {{$data->transport}}
                </td>
            </tr>
            <tr>
                <td>Waktu&nbsp;</td>
                <td>:</td>
                <td colspan="2">
                    @if (count($data->outst_destiny) == 1)
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($item->go_date ==  $item->return_date)
                                {{tgl_indo($item->go_date)}} 
                            @else
                                {{tgl_indo($item->go_date)}} s/d {{tgl_indo($item->return_date)}}
                            @endif
                        @endforeach
                    @else
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->first)
                                {{tgl_indo($item->go_date)}}
                                s/d
                            @endif
                            @if ($loop->last)
                            {{tgl_indo($item->return_date)}}
                            @endif
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td>Biaya&nbsp;</td>
                <td>:</td>
                <td > Anggaran</td>
                <td style="width: 65%">: 
                        {{$data->budget->name}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td> MAK</td>
                <td>: 
                    @if ($data->pok_detail_id == 0)
                        {{' Non Anggaran '}}
                    @else
                        {{$data->pok->pok->act->prog->unit->klcode->code}}.{{$data->pok->pok->act->prog->unit->code}}.
                        {{$data->pok->pok->act->prog->code}}.{{$data->pok->pok->act->code}}.
                        {{$data->pok->sub->komponen->det->unit->code}}.{{$data->pok->sub->komponen->det->code}}.
                        {{$data->pok->sub->komponen->code}}.{{$data->pok->sub->code}}.{{$data->pok->akun->code}}

                    @endif
                </td>
            </tr>
        </table>
        <br><br>
        &nbsp;Agar melaksanakan tugas sebaik - baiknya dan setelah bertugas <b>segera membuat laporan.</b>
        <br><br><br>
        <table class="ttdini">
            <tr>
                <td></td>
                <td style="width: 38%;">Banjarmasin, 
                    @php
                        $a = $data->st_date;
                        echo tgl_indo($a); 
                    @endphp
                    
                </td>
            </tr>
            <tr>
                <td rowspan="3" >
                   <div id="gratis">
                    <b>Tidak Menerima Gratifikasi/KKN</b> <br>
                    Pengaduan Gratifikasi/KKN ditujukan kepada Kepala BBPOM di <br>
                    Banjarmasin Hp : 082149000821
                   </div>
                </td>
                <td><b>
                   @if ($menyetujui != null)
                        @if ($menyetujui->pjs !=null)
                            {{$menyetujui->pjs}} Kepala,
                        @else
                            Kepala,
                        @endif
                   @else
                        <b>Pejabat Belum Ditentukan</b>
                   @endif
                    </b></td>
            </tr>
            <tr>
                <td style="height: 10%"></td>
            </tr>
            <tr>
                <td>
                    @if ($menyetujui != null)
                        <b>{{$menyetujui->user->name}}</b>
                    @else
                        <b>Silahkan Cek Setup Pejabat</b>
                    @endif
                    
                </td>
            </tr>
        </table>
    </div>
</body>
</html>