<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPPD</title>
    <style>
        @page {
            size:8.5in 13in;
            font-family: Arial;
            margin: 10px 15px 10px 15px;

        }

        #kepala {
            text-align: left;
            font-size: 6;
            font-style: italic;
            border-collapse: collapse;
            border: none;
            line-height: 0.5;
        }
        
        #kop{
            text-align: center;
            line-height: 1.5;
        }

        .isi{
            font-size: 8;
            padding-left: 5px; 
            border: 1px solid black;
            vertical-align : top;
            border-collapse: collapse;
        }

        .didalam td{
            border:none;
        }
        </style>
</head>

@php
    $no=1;
@endphp

@foreach ($isian as $item)
<body>
    <table style="width: 100%;" id="kepala">
        <tr>
            <td style="width: 11%">Program/kegiatan</td>
            <td style="width: 18%">:
                @if ($data->pok_detail_id == 0)
                    {{' Non Anggaran '}}
                @else
                    {{$data->pok->pok->act->prog->unit->klcode->code}}.{{$data->pok->pok->act->prog->unit->code}}.
                    {{$data->pok->pok->act->prog->code}}
                    / {{$data->pok->pok->act->code}}
                @endif
            </td>
            <td rowspan="5" style="vertical-align: bottom; text-align: center;" ><img src="{{asset('images/BBRI.jpg')}}" style="height:80px"></td>
            <td style="width: 28%">Lampiran VI (4 dari 4)</td>
        </tr>
        <tr>
            <td>KRO/RO/komponen</td>
            <td>:
                @if ($data->pok_detail_id == 0)
                    {{' Non Anggaran '}}
                @else
                    {{$data->pok->sub->komponen->det->unit->code}}
                    / {{$data->pok->sub->komponen->det->code}}
                    / {{$data->pok->sub->komponen->code}}
                @endif
            </td>
            <td>Peraturan Menteri Keuangan tentang Perjalanan Dinas</td>
        </tr>
        <tr>
            <td>Sub Komponen/Akun</td>
            <td>:
                @if ($data->pok_detail_id == 0)
                    {{' Non Anggaran '}}
                @else
                    {{$data->pok->sub->code}} / {{$data->pok->akun->code}}
                @endif
            </td>
            <td>Dalam Negeri bagi Pejabat Negara Pegawai Negeri Sipil</td>
        </tr>
        <tr>
            <td>No. Surat Tugas</td>
            <td>:
                {{$data->number}}
            </td>
            <td>Dan Pegawai Tidak Tetap</td>
        </tr>
        <tr>
            <td>Petugas</td>
            <td>: 
                {{$no++}}
            </td>
            <td>Nomor : 113/PMK.05/2012 &nbsp;&nbsp;&nbsp;&nbsp; Tgl. : 23 Juli 2012</td>
        </tr>
    </table>
    <div id="kop">
        <b style="font-size: 12;"><u>SURAT PERINTAH PERJALANAN DINAS</u></b>
        <p style="font-size: 10;">Nomor : {{$item->no_sppd}}</p>
   </div>
   <table class="isi" style="width: 100%;">
    <tr> 
        <td style="width:42%" class="isi">1. Pejabat yang berwenang memberi perintah</td>
        <td class="isi">Kuasa Pengguna Anggaran Balai Besar Pengawas Obat dan Makanan di Banjarmasin</td>
    </tr>
    <tr>
        <td class="isi">2.Nama Pegawai yang diperintah / NIP</td>
        <td class="isi">
             {{$item->pegawai->name}} / {{$item->pegawai->no_pegawai}}
        </td>
    </tr>
    <tr>
        <td class="isi">
            3. a. Pangkat / Golongan <br>
            &nbsp; &nbsp; b. Jabatan <br>
            &nbsp; &nbsp; c. Tingkat menurut peraturan perjalanan dinas
        </td>
        <td class="isi">
             @if ($item->pegawai->jabasn_id != null)
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
        <td class="isi">4. Maksud Perjalanan Dinas</td>
        <td class="isi">
         {{$data->purpose}}
         <br><br><br>
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
        </td>
    </tr>
    <tr>
        <td class="isi">
            5. Alat Angkutan yang dipergunakan <br>
            6. a. Tempat Berangkat <br>
            &nbsp; &nbsp; b. Tempat Tujuan
        </td>
        <td class="isi">
             {{$data->transport}} <br>
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
    <tr>
        <td class="isi">
            7. a. Lama perjalanan dinas <br>
            &nbsp; &nbsp; b. Tanggal berangkat <br>
            &nbsp; &nbsp; c. Tanggal harus kembali / tiba di tempat baru
            
        </td>
        <td class="isi"> 
             {{-- {{$lama->hitung}} ( {{terbilang($lama->hitung)}} ) Hari --}}
             {{$lama->hitung}} Hari
            <br>
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        @php
                            $go = $item->go_date;
                            echo tgl_indo($go); 
                        @endphp 
                    @endif
                @endforeach
            <br>
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->last)
                        @php
                            $ret = $item->return_date;
                            echo tgl_indo($ret); 
                        @endphp 
                    @endif
                @endforeach
        </td>
        <tr>
            <td class="isi">     8. Pembebanan Anggaran <br>
                &nbsp; &nbsp; a. Instansi <br>
                &nbsp; &nbsp; b. Mata Anggaran
            </td>
            <td class="isi">     Hanya instansi yang dikuasainya <br>
                 {{$data->budget->name}} <br>
                 @if ($data->pok_detail_id == 0)
                    {{' Non Anggaran '}}
                @else
                    {{$data->pok->sub->komponen->code}} / {{$data->pok->akun->code}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="isi">     
                9. Keterangan lain-lain <br>
                <table class="didalam">
                 <tr>
                     <td>Dikeluarkan di</td>
                     <td> :{{$data->cityfrom->capital}}</td>
                 </tr>
                 <tr>
                    <td>Pada tanggal </td>
                    <td> : 
                        @php
                            $st = $data->st_date;
                            echo tgl_indo($st); 
                        @endphp
                    </td>
                 </tr>
                 <tr>
                     <td colspan="2"> {{$data->ppk->jabatan}}</td>
                 </tr>
                 <tr>
                     <td  style="height: 5%"></td>
                 </tr>
                 <tr>
                     <td  colspan="2">
                         <u><b> {{$data->ppk->user->name}} </b></u>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="2">{{$data->ppk->user->no_pegawai}}</td>
                 </tr>
                </table>
            </td>
            <td class="isi">     
                <table class="didalam">
                 <tr>
                     <td >Surat Tugas Nomor</td>
                     <td > :{{$data->number}}</td>
                     <td style="text-align: right;">Tgl. </td>
                     <td >
                        @php
                            $st = $data->st_date;
                            echo tgl_indo($st); 
                        @endphp 
                    </td>
                 </tr>
                 <tr>
                    <td >Berangkat dari</td>
                    <td > : {{$data->cityfrom->capital}}</td>
                    <td >Pada tanggal </td>
                    <td > :
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->first)
                                {{$item->go_date}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td  colspan="2" style="text-align: center;">(Tempat kedudukan)</td>
                    <td >Tujuan </td>
                    <td > :
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->first)
                                {{$item->destiny->capital}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;">Kepala Bagian Tata Usaha</td>
                </tr>
                <tr>
                    <td style="height: 5%" colspan="4" style="text-align: left;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;">
                        <u><b> {{$menyetujui->user->name}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;">
                        NIP. {{$menyetujui->user->no_pegawai}}
                    </td>
                </tr>
             
                </table>
            </td>
    </tr>
    <tr>
        <td class="isi">
            <table class="didalam">
                <tr>
                    <td>Tiba di</td>
                    <td>:
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->first)
                                {{$item->destiny->capital}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->first)
                                {{$item->go_date}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="4" style="text-align: center;">{{$data->jab_petugas}}</td>
                </tr>
                <tr>
                    <td style="height: 5%" colspan="4" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <u><b> {{$data->nama_petugas}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        @if ($data->nip_petugas != null)
                            NIP. {{$data->nip_petugas}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td class="isi">
            <table class="didalam" style="width: 100%">
                <tr>
                    <td style="width: 20%">Berangkat dari</td>
                    <td style="width: 40%">: 
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->first)
                                {{$item->destiny->capital}} 
                            @endif
                        @endforeach
                    </td>
                    <td style="width: 5%">Ke</td>
                    <td>:
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->index == 1)
                                    {{$item->destiny->capital}}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->first)
                                {{$item->return_date}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="4" style="text-align: center;">{{$data->jab_petugas}}</td>
                </tr>
                <tr>
                    <td style="height: 4%" colspan="4" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <u><b> {{$data->nama_petugas}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        @if ($data->nip_petugas != null)
                            NIP. {{$data->nip_petugas}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="isi">
            <table class="didalam">
                <tr>
                    <td>Tiba di</td>
                    <td>:
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->index == 1)
                                {{$item->destiny->capital}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->index == 1)
                                {{$item->go_date}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="4" style="text-align: center;">{{$data->jab_petugas2}}</td>
                </tr>
                <tr>
                    <td style="height: 4%" colspan="4" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <u><b> {{$data->nama_petugas2}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        @if ($data->nip_petugas2 != null)
                            NIP. {{$data->nip_petugas2}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td class="isi">
            <table class="didalam" style="width: 100%">
                <tr>
                    <td style="width: 20%">Berangkat dari</td>
                    <td style="width: 40%">:
                            @foreach ($data->outst_destiny as $key=>$item)
                                @if ($loop->index == 1)
                                    {{$item->destiny->capital}}
                                @endif
                            @endforeach 
                    </td>
                    <td style="width: 5%">Ke</td>
                    <td>: 
                            @foreach ($data->outst_destiny as $key=>$item)
                                @if ($loop->last)
                                    {{$item->destiny->capital}}
                                @endif
                            @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->index == 1)
                                {{$item->go_date}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="4" style="text-align: center;">{{$data->jab_petugas2}}</td>
                </tr>
                <tr>
                    <td style="height: 4%" colspan="4" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <u><b> {{$data->nama_petugas2}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        @if ($data->nip_petugas2 != null)
                            NIP. {{$data->nip_petugas2}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="isi">
            <table class="didalam">
                <tr>
                    <td>Tiba di</td>
                    <td>:
                        @if (count($data->outst_destiny) == 3)
                            @foreach ($data->outst_destiny as $key=>$item)
                                @if ($loop->last)
                                    {{$item->destiny->capital}} 
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:
                        @if (count($data->outst_destiny) == 3)
                            @foreach ($data->outst_destiny as $key=>$item)
                                @if ($loop->last)
                                    {{$item->go_date}} 
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="4" style="text-align: center;">{{$data->jab_petugas3}}</td>
                </tr>
                <tr>
                    <td style="height: 4%" colspan="4" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <u><b> {{$data->nama_petugas3}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        @if ($data->nip_petugas3 != null)
                            NIP. {{$data->nip_petugas3}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td class="isi">
            <table class="didalam" style="width: 100%">
                <tr>
                    <td style="width: 20%">Berangkat dari</td>
                    <td style="width: 40%">:
                        @if (count($data->outst_destiny) == 3)
                            @foreach ($data->outst_destiny as $key=>$item)
                                @if ($loop->last)
                                    {{$item->destiny->capital}} 
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td style="width: 5%">Ke</td>
                    <td>: 
                        @if (count($data->outst_destiny) == 3)
                            {{$data->cityfrom->capital}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:
                        @if (count($data->outst_destiny) == 3)
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->last)
                                {{$item->go_date}} 
                            @endif
                        @endforeach
                        @endif
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="4" style="text-align: center;">{{$data->jab_petugas3}}</td>
                </tr>
                <tr>
                    <td style="height: 5%" colspan="4" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <u><b> {{$data->nama_petugas3}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        @if ($data->nip_petugas3 != null)
                            NIP. {{$data->nip_petugas3}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="isi">
            <table class="didalam">
                <tr>
                    <td>Tiba kembali di</td>
                    <td>: {{$data->cityfrom->capital}}</td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:
                        @foreach ($data->outst_destiny as $key=>$item)
                            @if ($loop->last)
                                {{$item->return_date}} 
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> {{$data->ppk->jabatan}}</td>
                </tr>
                <tr>
                    <td  style="height: 5%"></td>
                </tr>
                <tr>
                    <td  colspan="2">
                        <u><b> {{$data->ppk->user->name}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">{{$data->ppk->user->no_pegawai}}</td>
                </tr>
            </table>
        </td>
        <td class="isi">
            Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata - mata untuk kepentingan jabatan
            dalam waktu yang sesingkat-singkatnya. 
            <br>
            <table>
                <tr>
                    <td> {{$data->ppk->jabatan}}</td>
                </tr>
                <tr>
                    <td  style="height: 5%"></td>
                </tr>
                <tr>
                    <td>
                        <u><b> {{$data->ppk->user->name}} </b></u>
                    </td>
                </tr>
                <tr>
                    <td>{{$data->ppk->user->no_pegawai}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <b>CATATAN LAIN - LAIN</b>  
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="didalam">
                <tr>
                    <td><b>PERHATIAN :</b></td>
                    <td>
                        Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalanan dinas, para pejabat yang
                        mengesahkan tanggal berangkat / tiba, serta bendaharawan bertanggung jawab berdasarkan peraturan-peraturan 
                        keuangan negara apabila negara menderita rugi akibat kesalahan, kelalaian dan kealpaannya.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
   </table>
</body>
@endforeach
</html>