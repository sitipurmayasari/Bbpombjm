<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Surat Tugas</title>
</head>
<style>
    @page {
        /* size: 21cm 33cm ; */
        size: 8.5in 14in ;
        /* size: legal; */
        margin-top: 30px;
        font-size: 9;
    }

    @font-face {
        font-family: "Bookman Old Style";
        /* src: url('{{asset('assets/font/Bookman-old-style.ttf')}}') format('truetype'); */
        src: url('{{ storage_path('fonts\Bookman-old-style.ttf') }}') format("truetype");
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
    }

    b{
        font-family: "Bookman Old Style";
    }
    
    html, table{
        font-family: "Bookman Old Style";
    }
    table{
            width: 100%;
    }
    table, td, tr {
        font-family: "Bookman Old Style"; 
        text-align: justify;
        vertical-align: top;
        font-weight: normal;
        font-style: normal;;
        border-collapse: collapse;
        vertical-align: top;
        line-height: 1;
        
    }

    .tabbor{
        padding: 10px 5px 10px 5px; /* top right bottom left */
        border: 0.5px solid black;
        border-collapse: collapse;
        line-height: normal;
    }

    .tabno{
        padding-top: 10px;
        border: 0.5px solid black;
        border-collapse: collapse;
        line-height: normal;
    }
        

</style>
@php
$no=1;
@endphp
@foreach ($isian as $item)
<body>
    <table>
        <tr>
            <td style="width: 45%;text-align:center; vertical-align:bottom;" >
                <img src="{{asset('images/bbpom.jpg')}}" style="height:100px"> <br>
               <b>BALAI BESAR PENGAWAS OBAT DAN MAKANAN<br>
                DI BANJARMASIN <br>
                </b>
                Jl. Brigjend H.Hasan Basri No.40 Banjarmasin<br>
            </td>
            <td style="padding-left: 80px; font-size: 7;">
               <p>
                PERATURAN DIREKTORAT JENDRAL PERBENDAHARAAN NOMOR  PER 22/PB/2013 TENTANG KETENTUAN LEBIH LANJUT PELAKSANAAN PERJALANAN DINAS DALAM NEGERI BAGI PEJABAT NEGARA, PEGAWAI NEGERI, DAN PEGAWAI TIDAK TETAP. 
               </p>
                <br>
                <table>
                    <tr>
                        <td style="width: 30%"><i>Program/kegiatan</i></td>
                        <td style="width: 70%">:
                            <i>
                                @if ($data->pok_detail_id == 0)
                                    {{' Non Anggaran '}}
                                @elseif ($data->pok_detail_id == 1)
                                    {{' - '}}
                                @else
                                    {{$data->pok->pok->act->prog->unit->klcode->code}}.{{$data->pok->pok->act->prog->unit->code}}.
                                    {{$data->pok->pok->act->prog->code}}
                                    / {{$data->pok->pok->act->code}}
                                @endif
                            </i>
                        </td>
                    </tr>
                    <tr>
                        <td><i>KRO/RO/komponen</i></td>
                        <td>:
                            <i>
                                @if ($data->pok_detail_id == 0)
                                    {{' Non Anggaran '}}
                                @elseif ($data->pok_detail_id == 1)
                                    {{' - '}}
                                @else
                                    {{$data->pok->sub->komponen->det->unit->code}}
                                    / {{$data->pok->sub->komponen->det->code}}
                                    / {{$data->pok->sub->komponen->code}}
                                @endif
                            </i>
                        </td>
                    </tr>
                    <tr>
                        <td><i>Sub Komponen/Akun</i></td>
                        <td>:
                           <i>
                            @if ($data->pok_detail_id == 0)
                                {{' Non Anggaran '}}
                            @elseif ($data->pok_detail_id == 1)
                                {{' - '}}
                            @else
                                {{$data->pok->sub->code}} / {{$data->pok->akun->code}}
                            @endif
                           </i>
                        </td>
                    </tr>
                    <tr>
                        <td><i>No. Surat Tugas</i></td>
                        <td>:
                            <i>{{$data->number}}</i>
                        </td>
                    </tr>
                    <tr>
                        <td><i>Petugas</i></td>
                        <td>: 
                            <i>{{$no++}}</i>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"style="text-align:center; padding-top:30px;line-height:1.5">
                <b style="font-size: 12;"><u>SURAT PERJALANAN DINAS</u><br></b>
                Nomor : {{$item->no_sppd}}
            </td>
        </tr>
    </table>
    <br>
    <table class="tabbor">
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">1.</td>
            <td class="tabbor" colspan="2">
                Pejabat Pembuat Komitmen
            </td>
            <td colspan="2" class="tabbor">
                @if ($data->ppk_id != 0)
                    {{$data->ppk->user->name}}
                @else
                    Pejabat Pembuat Komitmen
                @endif 
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">2.</td>
            <td class="tabbor" colspan="2">
                Nama/NIP Pegawai yang melaksanakan
                perjalanan dinas</td>
            <td colspan="2" class="tabbor">
                {{$item->pegawai->name}} /
                @if ($item->pegawai->golongan_id != null)
                   {{$item->pegawai->no_pegawai}}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">3.</td>
            <td class="tabbor" colspan="2">
                a. Pangkat dan Golongan<br>
                b. Jabatan <br>
                c. Tingkat Biaya Perjalanan Dinas 
                
            </td>
            <td colspan="2" class="tabbor">
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->gol->jenis}} / {{$item->pegawai->gol->golongan}} {{$item->pegawai->gol->ruang}}
                @else
                    {{' - '}}
                @endif    
                <br>
                @if ($item->pegawai->jabasn_id != null)
                    {{$item->pegawai->jabasn->nama}}
                @else
                    {{$item->pegawai->deskjob}} 
                @endif  
                <br>
                - 
            </td>
        </tr>
        <tr>
            <td style="text-align: center;" class="tabno">4.</td>
            <td class="tabbor" colspan="2">
                Maksud Perjalanan Dinas
            </td>
            <td colspan="2" class="tabbor">
                {{$data->purpose}} 
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">5.</td>
            <td class="tabbor" colspan="2">
                Alat Angkutan yang Dipergunakan
            </td>
            <td colspan="2" class="tabbor">
               {{$data->transport}} <br>
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">6.</td>
            <td class="tabbor" colspan="2">
                a. Tempat Berangkat <br>
                b. Tempat Tujuan <br>
            </td>
            <td colspan="2" class="tabbor">
                {{$data->cityfrom->capital}} <br>
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
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">7.</td>
            <td class="tabbor" colspan="2">
                a. Lamanya Perjalanan Dinas <br>
                b. Tanggal Berangkat <br>
                c. Tanggal harus kembali<br>
                
            </td>
            <td colspan="2" class="tabbor">
                {{$lama->hitung}} ({{terbilang($lama->hitung)}}) Hari  
                <br>
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->first)
                             {{tgl_indo($item->go_date)}}
                        @endif
                    @endforeach
                <br>
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{tgl_indo($item->return_date)}}
                        @endif
                    @endforeach
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;width: 3%" class="tabno" rowspan="2">8.</td>
            <td class="tabbor"style="vertical-align:top; width:12%;border-right: none;">
                Pengikut:
            </td>
            <td class="tabbor" style="text-align: center;border-left: none;width:25%;">
                Nama
            </td>
            <td class="tabbor" style="text-align: center;">
                Tanggal Lahir / NIP
            </td>
            <td class="tabbor" style="text-align: center;">
                Keterangan
            </td>
        </tr>
        <tr class="tabbor">
            <td class="tabbor" colspan="2" style="vertical-align:top;">
                1. <br>
                2. <br>
                3. <br>
                4. <br>
                5.
            </td>
            <td class="tabbor" style="text-align: center;"></td>
            <td class="tabbor" style="text-align: center;"></td>
        </tr>
        <tr class="tabbor" style="border-bottom: none; padding-bottom:0;">
            <td style="text-align: center;" rowspan="2" class="tabno">9.</td>
            <td class="tabbor" colspan="2" style="border-bottom: none;  padding-bottom:0;">
                Pembebanan anggaran <br>
                a. Instansi
            </td>
            <td class="tabbor" colspan="2" colspan="2" style="border-bottom: none;  padding-bottom:0;">
                <br>
                @if ($data->budget_id == 3)
                    {{$data->budget->name}}
                @else
                    {{$data->budget->name}} Tahun Anggaran {{$data->budget->tahun}}
                    @if ($data->budget->nomor != null && $data->budget->tanggal == null)
                    ,
                        Nomor {{$data->budget->nomor}} 
                    @elseif ($data->budget->tanggal != null && $data->budget->nomor == null)
                        ,
                        tanggal {{tgl_indo($data->budget->tanggal)}}
                    @elseif ($data->budget->tanggal != null && $data->budget->nomor != null)
                        ,
                        No. {{$data->budget->nomor}}
                    @else
                        Non Anggaran
                    @endif
                @endif
            </td>
        </tr>
        <tr class="tabbor" style="border-top: none; padding-top:0;">
            <td class="tabbor" colspan="2" style="border-top: none; padding-top:0;">
                b. Akun
            </td>
            <td class="tabbor" colspan="2" style="border-top: none; padding-top:0;">
                @if ($data->pok_detail_id == 0)
                                    {{' Non Anggaran '}}
                                @elseif ($data->pok_detail_id == 1)
                                    {{' - '}}
                                @else
                                    {{$data->pok->pok->act->prog->unit->klcode->code}}.{{$data->pok->pok->act->prog->unit->code}}.
                                    {{$data->pok->pok->act->prog->code}}.{{$data->pok->pok->act->code}}.
                                    {{$data->pok->sub->komponen->det->unit->code}}.{{$data->pok->sub->komponen->det->code}}.
                                    {{$data->pok->sub->komponen->code}}.{{$data->pok->sub->code}}.{{$data->pok->akun->code}}
            
                                @endif
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">10.</td>
            <td class="tabbor" colspan="2">Keterangan lain - lain</td>
            <td class="tabbor" colspan="2" colspan="2">
              SPD Tanggal 
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        {{tgl_indo($item->go_date)}}
                    @endif
                @endforeach s/d 
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->last)
                        {{tgl_indo($item->return_date)}}
                    @endif
                @endforeach
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style="width: 55%"></td>
            <td>
                <table>
                    <tr>
                        <td>Dikeluarkan di</td>
                        <td>:  {{$data->cityfrom->capital}}
                        </td>
                    </tr>
                    <tr>
                        <td>Pada tanggal</td>
                        <td>: {{tgl_indo($data->st_date)}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight:bold;">
                            <br>
                                Pejabat Pembuat Komitmen
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                                <br><br><br><br>
                                @if ($data->ppk_id != 0)
                                   <u> {{$data->ppk->user->name}}</u>
                                @else
                                   <u> Pejabat Pembuat Komitmen</u>
                                @endif <br>
                                NIP.  
                                @if ($data->ppk_id != 0)
                                    {{$data->ppk->user->no_pegawai}}
                                @else
                                    Pejabat Pembuat Komitmen
                                @endif 
                            
                        </td>
                    </tr>
                </table>
                <br>
            </td>
        </tr>
    </table>
</body>
@endforeach
</html>