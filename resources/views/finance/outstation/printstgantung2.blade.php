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
        size: 21cm 33cm ;
        margin: 175px 0px 5px 0px;
    }

    @font-face {
        font-family: "Bookman Old Style";
        /* src: url('{{asset('assets/font/Bookman-old-style.ttf')}}') format('truetype'); */
        src: url('{{ storage_path('fonts\Bookman-old-style.ttf') }}') format("truetype");
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
    }
    
    html, table{
        font-family: "Bookman Old Style";
        font-size: 12;
    }

        #kop{
            font-family: "Bookman Old Style";
            margin-left: 10%;
            margin-right: 10%;
            line-height: 1;
        }

        .isi{
            font-family: "Bookman Old Style"; 
            font-size: 12;
            font-weight: normal;
            font-style: normal;;
            margin-left: 8%;
            margin-right: 8%;
            line-height: 1;
            text-align: justify;
        }

        table, td, tr {
            font-family: "Bookman Old Style"; 
            text-align: justify;
            vertical-align: top;
            line-height: 1;
            font-size: 12;
            font-weight: normal;
            font-style: normal;;
            border-collapse: collapse;
        }

        .ttdini{
            font-family: "Bookman Old Style";
            /* margin-right: 10%; */
            font-size: 12;
            font-weight: normal;
            font-style: normal;;
            width: 100%;
        }

        .detail{
            font-family: "Bookman Old Style";  
            border: 1px solid black;
            font-size: 11;
            text-align: left;
            line-height: 1;
            vertical-align: top
        }
        th{
            font-family: "Bookman Old Style"; 
            border: 1px solid black;
            font-weight: bold;
            font-size: 10; 
            vertical-align: middle;
            text-align: center;
            line-height: 1;
        }

        #gratis{
            font-family: "Bookman Old Style";  
            font-size: 11;
            font-weight: normal;
            font-style: normal;;
            color: brown;
            line-height: 1;
            text-align: center;
            border: 2px solid brown;
            width: 100%;
            /* padding-top: 5px;
            padding-bottom: 5px; */
        }
        

</style>
<body>
    <div class="col-sm-12" style="text-align: center">
        <div style="align=center;" id="kop">
            <u><b style="font-size: 14">SURAT TUGAS</b></u><br>
            <p style="font-size: 12">NOMOR : {{$data->number}}</p>
        </div>
    </div>
     <div class="isi">
       <table>
           <tr>
               <td>Menimbang</td>
               <td>:</td>
               <td>
                    <table>
                        <tr>
                            <td> a.</td>
                            <td>{{$data->menimbang}}
                                
                            </td>
                        </tr>
                        <tr>
                            <td> b.</td>
                            <td>Bahwa petugas yang ditugaskan dianggap mampu untuk melaksanakan tugas tersebut.
                            </td>
                        </tr>
                    </table>
                    <br>
               </td>
           </tr>
           <tr>
                <td>Dasar</td>
                <td>:</td>
                <td>
                    <table>
                        <tr>
                            <td> 1.</td>
                            <td>Peraturan Kepala Badan POM RI Nomor 22 Tahun 2020 tentang Organisasi dan Tata Laksana Unit 
                                Pelaksana Teknis di lingkungan Badan Pengawas Obat dan Makanan
                            </td>
                        </tr>
                        <tr>
                            <td> 2.</td>
                            <td>
                                @if ($data->budget_id == 3)
                                    {{$data->budget->name}}
                                    {{-- {{$now->name}} Tahun Anggaran {{$now->tahun}}, <br>
                                    Nomor {{$now->nomor}} tanggal {{tgl_indo($now->tanggal)}} --}}
                                @else
                                    {{$data->budget->name}} Tahun Anggaran {{$data->budget->tahun}}
                                    @if ($data->budget->nomor != null && $data->budget->tanggal == null)
                                       , <br>
                                        Nomor {{$data->budget->nomor}} 
                                    @elseif ($data->budget->tanggal != null && $data->budget->nomor == null)
                                        , <br>
                                        tanggal {{tgl_indo($data->budget->tanggal)}}
                                    @elseif ($data->budget->tanggal != null && $data->budget->nomor != null)
                                        , <br>
                                        Nomor {{$data->budget->nomor}}  tanggal {{tgl_indo($data->budget->tanggal)}}
                                    @else
                                        ;
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @if ($data->dasar != null)
                            <tr>
                                <td> 3.</td>
                                <td>{{$data->dasar}} ;
                                <br></td>
                            </tr>
                        @endif
                    </table>
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center">Memberi Perintah 
                    <br>
                </td>
            </tr>
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td>
                    <table style="width:100%" class="detail">
                        <thead>
                            <tr >
                                <th style="width: 5%">NO</th>
                                <th style="width: 25%">NAMA</th>
                                <th style="width: 20%">NIP</th>
                                <th >PANGKAT / GOLONGAN</th>
                                <th style="width: 35%">JABATAN</th>
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
                    <br>
                </td>
            </tr>
            </table>
    </div>
    <div  style="page-break-before: always; " class="isi">
        <table>
            <tr>
                <td>Untuk</td>
                <td>:</td>
                <td>
                    <table style="width: 100%">
                        <tr>
                            <td colspan="3">
                                {{$data->purpose}}
                            </td>
                        </tr>
                        <tr>
                            <td>Tujuan&nbsp;</td>
                            <td>:</td>
                            <td style="width: 85%"> 
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
                            <td>Waktu&nbsp;</td>
                            <td>:</td>
                            <td>
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
                            <td style="font-size:11">
                                @if ($data->budget_id == 3)
                                    {{-- {{$now->name}} Tahun Anggaran {{$now->tahun}} --}}
                                    {{$data->budget->name}}
                                @else
                                    {{$data->budget->name}} Tahun Anggaran {{$data->budget->tahun}}
                                @endif <br>
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
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
       </table>
        <br>
        Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.
        <br><br>
        <table class="ttdini" style="width: 100%" >
            <tr>
                <td></td>
                <td style="width: 55%;">Banjarmasin, 
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
                        Kepala {{$menyetujui->divisi->nama}}
                   @else
                        <b>Pejabat Belum Ditentukan</b>
                   @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="height: 8%"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    @if ($menyetujui != null)
                        @if ($menyetujui->pjs !=null)
                            {{$menyetujui->user->name}}<br>
                            NIP: {{$menyetujui->user->no_pegawai}}
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
            Petugas Tidak diperkenankan menerima gratifikasi dalam bentuk apapun. <br>        
            Pengaduan Gratifikasi/KKN ditujukan kepada <br>
            Kepala Balai Besar POM di Banjarmasin melalui Hp : 082149000821
        </div>
    </div>
</body>
</html>