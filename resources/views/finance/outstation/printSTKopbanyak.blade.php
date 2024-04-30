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
        size: 21.59cm 33cm ;
        margin-left: 3cm;
        margin-right: 2cm;
        margin-bottom: 2cm;
        /* margin: 160px 0px 100px 0px; */
    }

    @font-face {
            font-family: "Bookman Old Style";
            src: url('{{ storage_path('fonts\Bookman-old-style.ttf') }}') format("truetype");
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
        }
        
    html, table{
            font-family: "Bookman Old Style";
            font-size: 12;
        }

        html, body {
            height: 100%;
            margin: 0;
        }

        #kop{
            margin-top: 160px;
            font-family: "Bookman Old Style";
            margin-left: 10%;
            margin-right: 10%;
            line-height: 1;
            text-align: center;
            font-size: 12;
        }

        .isi{
            font-family: "Bookman Old Style";
            font-size: 12;
            margin-left: 3cm;
            margin-right: 2cm;
            line-height: 1;
            text-align: justify;
        }

        table, td, tr {
            font-family: "Bookman Old Style";
            text-align: justify;
            vertical-align: top;
            line-height: 1;
            font-size: 12;
            border-collapse: collapse;
        }

        .ttdini{
            font-family: "Bookman Old Style";
            font-size: 12;
            width: 100%;
        }

        .detail{
            font-family: "Bookman Old Style";
            border: 1px solid black;
            font-size: 10;
            text-align: left;
            line-height: 1;
            vertical-align: top
        }
        th{
            font-family: "Bookman Old Style";
            border: 1px solid black;
            font-weight: normal;
            font-size: 10; 
            vertical-align: middle;
            text-align: center;
            line-height: 1;
        }

        #gratis{
            font-family: "Bookman Old Style";
            font-size: 12;
            color: black;
            line-height: 1;
            text-align: center;
            border: 2px solid black;
            width: 100%;
            /* padding-top: 5px;
            padding-bottom: 5px; */
        }

        #bgimg {
            margin: 0px 0px -100px 0px;
            background-image: url('{{asset('images/KOPNEW_F4.png')}}');
            background-size: cover;
            min-height: 100%; 
            width: 100%;
            height: 100%;
        }

</style>
<body>
<div id="bgimg">
    <div class="col-sm-12" style="text-align: center">
        <div id="kop">
            SURAT TUGAS <br>
           NOMOR : {{$data->number}}
           <br>
        </div>
    </div>
    <br>
     <div class="isi">
       <table>
           <tr>
               <td>Menimbang</td>
               <td>:</td>
               <td>
                    <table>
                        <tr>
                            <td> a.</td>
                            <td>{{$data->menimbang}} ;
                            </td>
                        </tr>
                        <tr>
                            <td> b.</td>
                            <td>Bahwa petugas yang ditugaskan dianggap mampu untuk melaksanakan tugas tersebut.
                            </td>
                        </tr>
                    </table>
               </td>
           </tr>
           <tr>
                <td>Dasar</td>
                <td>:</td>
                <td>
                    <table>
                        <tr>
                            <td> 1.</td>
                            <td>Peraturan Badan pengawas Obat dan Makanan Nomor 19 Tahun 2023 Tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis pada Badan Pengawas Obat dan Makanan ;
                            </td>
                        </tr>
                        @if ($data->dasar != null)
                        <tr>
                            <td> 2.</td>
                            <td>{{$data->dasar}} ;
                            <br></td>
                        </tr>
                    @endif
                    </table>
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; padding-bottom:8px;">Memberi perintah 
                </td>
            </tr>
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td> Daftar Terlampir
                    <br>
                </td>
            </tr>
            <tr>
                <td>Untuk</td>
                <td>:</td>
                <td>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>
                                    {{$data->purpose}} 
                                    di 
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
                                    ;
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>
                                    Melaksanakan tugas tersebut dengan seksama dan penuh tanggung jawab serta melaporkan hasil kegiatan kepada Kepala Balai Besar Pengawas Obat dan Makanan di Banjarmasin ;
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>
                                    Biaya yang dikeluarkan atas kegiatan ini 
                                    @if ($data->budget_id == 3)
                                        merupakan "Non Anggaran" ;
                                    @else
                                        dibebankan pada anggaran
                                        {{$data->budget->name}}  {{$data->budget->nomor}} 
                                        MAK : 
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
                                        Tahun Anggaran {{$data->budget->tahun}} ;
                                    @endif 
                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>
                                    Surat tugas ini berlaku pada tanggal 
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
                        </tbody>
                    </table>
                <td>
            </tr>
       </table>
        <br>
        &nbsp;Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.
        <br>&nbsp;<br>
        <table class="ttdini" style="width: 100%" >
            <tr>
                <td></td>
                <td style="width: 65%;">Banjarbaru, 
                    @php
                        $a = $data->st_date;
                        echo tgl_indo($a); 
                    @endphp
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    @if ($menyetujui != null)
                        @if ($menyetujui->pjs !=null)
                            {{$menyetujui->pjs}}
                        @endif
                    @endif     
                </td>
                <td>
                    @if ($menyetujui != null)
                            {{-- Kepala {{$menyetujui->divisi->nama}}, --}}
                            Kepala Balai Besar Pengawas Obat dan Makanan <br>
                            Di Banjarmasin,
                    @else
                        <b>Pejabat Belum Ditentukan</b>
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td>${ttd_pengirim}</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    @if ($menyetujui != null)
                        @if ($menyetujui->pjs !=null)
                            {{$menyetujui->user->name}}<br>
                            {{-- NIP: {{$menyetujui->user->no_pegawai}} --}}
                        @else
                            {{$menyetujui->user->name}}
                        @endif
                    @else
                        <b>Silahkan Cek Setup Pejabat</b>
                    @endif
                    
                </td>
            </tr>
        </table>
        <br>
        <div id="gratis">
            "Petugas Tidak diperkenankan menerima gratifikasi dalam bentuk apapun"
        </div>
    </div>
</div>
<div style="page-break-before: always;" class="isi">
    <br><br>
    <div style="text-align: center;"> - 2 - </div>
    <br><br>
    <div>
        <table style="width: 100%">
            <tr>
                <td style="width: 43%"></td>
                <td colspan="3" >Lampiran <br>Surat Tugas</td>
            </tr>
            <tr>
                <td></td>
                <td style="width: 10%">Nomor</td>
                <td style= "width:3%"> : </td>
                <td > {{$data->number}}</td>
            </tr>
            <tr>
                <td></td>
                <td >Tanggal</td>
                <td > : </td>
                <td> {{tgl_indo($data->st_date)}}</td>
            </tr>
        </table>
    </div>
    <br><br>
    <div style="text-align: center; font-size: 12">
        DAFTAR PEJABAT / PEGAWAI YANG DITUGASKAN <br>
    </div>
    <br>
    <div>
        <table style="width:100%" class="detail">
            <thead>
                <tr >
                    <th style="width: 5%">NO</th>
                    <th style="width: 25%">NAMA</th>
                    <th style="width: 25%">NIP</th>
                    <th style="width: 20%">PANGKAT / GOLONGAN</th>
                    <th style="width: 25%">JABATAN</th>
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
                    <td class="detail" style="text-align: center; vertical-align:top;">
                       @if ($row->pegawai->golongan_id != null)
                        {{$row->pegawai->gol->jenis}} /  
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
    </div>
    <br><br>
    <table class="ttdini" style="width: 100%" >
        <tr>
            <td></td>
            <td style="width: 65%;">Banjarbaru, 
                @php
                    $a = $data->st_date;
                    echo tgl_indo($a); 
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                @if ($menyetujui != null)
                    @if ($menyetujui->pjs !=null)
                        {{$menyetujui->pjs}}
                    @endif
                @endif     
            </td>
            <td>
               @if ($menyetujui != null)
                     {{-- Kepala {{$menyetujui->divisi->nama}}, --}}
                     Kepala Balai Besar Pengawas Obat dan Makanan <br>
                     Di Banjarmasin,
               @else
                    <b>Pejabat Belum Ditentukan</b>
               @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="height: 6.5%"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                @if ($menyetujui != null)
                    @if ($menyetujui->pjs !=null)
                        {{$menyetujui->user->name}}<br>
                        {{-- NIP: {{$menyetujui->user->no_pegawai}} --}}
                    @else
                        {{$menyetujui->user->name}}
                    @endif
                @else
                    <b>Silahkan Cek Setup Pejabat</b>
                @endif
                
            </td>
        </tr>
    </table>
</div>
</body>
</html>