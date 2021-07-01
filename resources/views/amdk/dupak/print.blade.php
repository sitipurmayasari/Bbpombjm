<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/no_header.css')}}" rel="stylesheet">
    <title>Document</title>
    <style>
        .tbl{
            border: 1px solid black;
            width: 100%;
        }

        .tnt{
            border: 1px solid black;
            border-right: none;
            border-left: none; 
        }
        tr{
            line-height: 15px;
        }

        th, td {
            padding-left: 5px;
        }

    </style>
</head>
<body>
    <div class="col-sm-12 isi" style="text-align: center" >
        PENETAPAN ANGKA KREDIT <br>
        JABATAN FUNGSIONAL PENGAWAS FARMASI DAN MAKANAN <br>
        NOMOR &nbsp;{{$data->nomor_kp}}
    </div>
    <div class="col-sm-12 isi" style="text-align: left">
       <table>
           <tr>
               <td>Masa Penilaian Tanggal</td>
               <td >: {{$data->dari}}  s/d {{$data->sampai}} </td>
           </tr>
           <tr>
            <td>Unit Kerja</td>
            <td>: Balai Besar Pengawas Obat dan Makanan di Banjarmasin</td>
        </tr>
       </table>
    </div>
    <br>
    <div class="col-sm-12 isi">
        <table class="tbl">
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;"><b>A</b></td>
                <td class="tbl" colspan="9"><b>KETERANGAN PERORANGAN</b></td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;" >1</td>
                <td class="tnt" colspan="4">Nama</td>
                <td class="tnt" style="width: 10%;" colspan="5">:  {{$data->pegawai->name}}</td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;">2</td>
                <td class="tnt" colspan="4">NIP</td>
                <td class="tnt" style="width: 10%;" colspan="5">:  {{$data->pegawai->no_pegawai}}</td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;">3</td>
                <td class="tnt" colspan="4">Nomor Seri karpeg</td>
                <td class="tnt" style="width: 10%;" colspan="5">:  {{$data->seri_karpeg}}</td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;">4</td>
                <td class="tnt" colspan="4">Jenis Kelamin</td>
                <td class="tnt" style="width: 10%;" colspan="5">:  
                    @if ($data->pegawai->jkel=='P')
                        Perempuan
                    @else
                        Laki - Laki
                    @endif
                </td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;">5</td>
                <td class="tnt" colspan="4">Pendidikan yang telah diperhitungkan angka kreditnya</td>
                <td class="tnt" style="width: 10%;" colspan="5">:  {{$data->ripend->jur->jurusan}}</td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;">6</td>
                <td class="tnt" colspan="4">Pangkat / Gol. Ruang / TMT</td>
                <td class="tnt" style="width: 10%;" colspan="5">:  {{$data->pegawai->gol->golongan}} / {{$data->pegawai->gol->ruang}} ({{$data->tmt}})</td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;">7</td>
                <td class="tnt" colspan="4">Jabatan Fungsional</td>
                <td class="tnt" style="width: 10%;" colspan="5">:  {{$data->pegawai->jabasn->nama}}</td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;" rowspan="2">8</td>
                <td class="tbl"  colspan="3" rowspan="2">Masa Kerja Golongan</td>
                <td class="tnt" style="width: 10%;" >&nbsp; Lama</td>
                <td class="tnt"  style="width: 20%;"> :&nbsp;&nbsp;&nbsp; {{$data->masa_lama_thn}} Tahun</td>
                <td class="tnt" style="width: 10%;" >{{$data->masa_lama_bln}} Bulan</td></td>
                <td class="tnt" style="width: 10%; text-align:center;" > 
                <td class="tnt" style="width: 10%; text-align:center;" ></td>
                <td class="tnt" style="width: 10%; text-align:center;" ></td>
            </tr>
            <tr>
                <td class="tnt" style="width: 10%;" >&nbsp; Baru</td>
                <td class="tnt"  style="width: 20%;"> :&nbsp;&nbsp;&nbsp; {{$data->masa_baru_thn}} Tahun</td>
                <td class="tnt" style="width: 10%;" >{{$data->masa_baru_bln}} Bulan</td></td>
                <td class="tnt" style="width: 10%; text-align:center;" > 
                <td class="tnt" style="width: 10%; text-align:center;" ></td>
                <td class="tnt" style="width: 10%; text-align:center;" ></td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;">9</td>
                <td class="tnt" colspan="4">Unit Kerja</td>
                <td class="tnt" style="width: 10%;" colspan="5">: Balai Besar Pengawas Obat dan Makanan di Banjarmasin</td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;"><b>B</b></td>
                <td class="tbl" colspan="9"><b>PENETAPAN ANGKA KREDIT</b></td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center; vertical-align: top;" rowspan="7" >1.</td>
                <td class="tbl" colspan="6"><b>UNSUR UTAMA</b></td>
                <td class="tbl" style="width: 10%; text-align : center;" >LAMA</td>
                <td class="tbl" style="width: 10%; text-align : center;" >BARU</td>
                <td class="tbl" style="width: 10%; text-align : center;" >JUMLAH</td>
            </tr>
            <tr>
                {{-- <td class="tbl" style="width: 5%; text-align: center;"></td> --}}
                <td class="tnt"style="width: 2%;" > a.</td>
                <td class="tnt" colspan="5" >Pendidikan <br></td>
                <td class="tbl" style="width: 10%; text-align:center;" rowspan="2"> - </td>
                <td class="tbl" style="width: 10%; text-align:center;" rowspan="2">
                    @if ($data->sa1=='0')
                        -
                    @else
                    {{$data->sa1}}
                    @endif
                </td>
                <td class="tbl" style="width: 10%; text-align:center;" rowspan="2"> 
                    @if ($data->sa1=='0')
                        -
                    @else
                    {{$data->sa1}}
                    @endif
                </td>
            </tr>
            <tr>
                {{-- <td class="tbl" style="width: 5%; text-align: center;"></td> --}}
                <td class="tnt"style="width: 2%;" ></td>
                <td class="tnt" style="width: 2%;" > 1.</td>
                <td class="tnt" style="width: 25%;" colspan="4">Pendidikan sekolah dan memperoleh ijasah / gelar</td>
            </tr>
             <tr>
                {{-- <td class="tbl" style="width: 5%; text-align: center;"></td> --}}
                <td class="tnt"style="width: 2%;" ></td>
                <td class="tnt" style="width: 2%; vertical-align: top;" > 2.</td>
                <td class="tnt" style="width: 25%;" colspan="4">Pendidikan dan pelatihan fungsional di bidang Pengawas Farmasi dan
                Makanan dan mendapatkan Surat Tanda Tamat Pendidikan dan Pelatihan (STTPL)</td>
                <td class="tbl" style="width: 10%; text-align:center;" > - </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->sa2=='0')
                        -
                    @else
                        {{$data->sa2}}
                    @endif
                </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->sa1=='0')
                        -
                    @else
                        {{$data->sa1}}
                    @endif
                </td>
            </tr>
            <tr>
                {{-- <td class="tbl" style="width: 5%; text-align: center;"></td> --}}
                <td class="tnt"style="width: 2%;" > b.</td>
                <td class="tnt" colspan="5" >Pengawas Farmasi dan Makanan</td>
                <td class="tbl" style="width: 10%; text-align:center;" > - </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->sb=='0')
                        -
                    @else
                        {{$data->sb}}
                    @endif
                </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->sb=='0')
                        -
                    @else
                        {{$data->sb}}
                    @endif
                </td>
            </tr>
            <tr>
                {{-- <td class="tbl" style="width: 5%; text-align: center;"></td> --}}
                <td class="tnt"style="width: 2%;" > c.</td>
                <td class="tnt" colspan="5" >Pengembang Profesi</td>
                <td class="tbl" style="width: 10%; text-align:center;" > - </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->sc=='0')
                    -
                    @else
                        {{$data->sc}}
                    @endif
                </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->sc=='0')
                        -
                    @else
                        {{$data->sc}}
                    @endif
                </td>
            </tr>
            <tr>
                {{-- <td class="tbl" style="width: 5%; text-align: center;"></td> --}}
                <td class="tnt"style="width: 2%;" ></td>
                <td class="tnt" colspan="5" style="text-align: right;">JUMLAH &nbsp; &nbsp;</td>
                <td class="tbl" style="width: 10%; text-align:center;" > - </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->jum1=='0')
                        -
                    @else
                        {{$data->jum1}}
                    @endif
                </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->jum1=='0')
                        -
                    @else
                        {{$data->jum1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;">2.</td>
                <td class="tbl" colspan="6"><b>UNSUR PENUNJANG</b></td>
                <td class="tbl" style="width: 10%; text-align : center;" > </td>
                <td class="tbl" style="width: 10%; text-align : center;" > </td>
                <td class="tbl" style="width: 10%; text-align : center;" > </td>
            </tr>
            <tr>
                <td class="tbl" style="width: 5%; text-align: center;"></td>
                <td class="tnt" colspan="5" >Penunjang Tugas PFM</td>
                <td class="tnt" style="width: 10%; text-align: right;" >JUMLAH &nbsp; &nbsp;</td>
                <td class="tbl" style="width: 10%; text-align:center;" > - </td>
                <td class="tbl" style="width: 10%; text-align:center;" >
                    @if ($data->da=='0')
                        -
                    @else
                        {{$data->da}}
                    @endif
                </td>
                <td class="tbl" style="width: 10%; text-align:center;" > 
                    @if ($data->da=='0')
                        -
                    @else
                        {{$data->da}}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="tbl" colspan="7" style="text-align: center;"><b>JUMLAH UNSUR UTAMA DAN UNSUR PENUNJANG</b></td>
                <td class="tbl" style="width: 10%; text-align:center;" > {{$data->jumlama}} </td>
                <td class="tbl" style="width: 10%; text-align:center;" > {{$data->jumlah}}</td>
                <td class="tbl" style="width: 10%; text-align:center;" > {{$data->total}}</td>
            </tr>
                <tr>&nbsp; 
                    <td colspan="10">&nbsp;
                        @if ($data->promoted=='P')
                             {{-- golongan baru, tmt baru, jabatan lama, tmt jabatan lama --}}
                            Pegawai tersebut bisa diusulkan kenaikan pangkat ke {{$data->gol->golongan}}/{{$data->gol->ruang}}
                            (TMT. {{$data->tmtusul}}) <br>
                            &nbsp; Jabatan : {{$data->pegawai->jabasn->nama}} 
                            (TMT. {{$data->tmtlama}})

                        @elseif ($data->promoted=='J')
                            {{-- golongan lama, tmt lama, jabatan baru, tmt jabatan baru --}}
                            Pegawai tersebut menduduki {{$data->pegawai->gol->golongan}}/{{$data->pegawai->gol->ruang}}
                            (TMT. {{$data->tmt}}) <br>
                            &nbsp; Pegawai tersebut diusulkan Jabatan : {{$data->jabasn->nama}} 
                            (TMT. {{$data->tmtjabbaru}})

                        @elseif ($data->promoted=='A')
                            {{-- golongan baru, tmt baru, jabatan baru, tmt jabatan baru --}}
                            Pegawai tersebut bisa diusulkan kenaikan pangkat ke {{$data->gol->golongan}}/{{$data->gol->ruang}}
                            (TMT. {{$data->tmtusul}}) <br>
                            &nbsp; Pegawai tersebut diusulkan Jabatan : {{$data->jabasn->nama}} 
                            (TMT. {{$data->tmtjabbaru}})

                        @else
                           {{-- golongan lama, tmt lama, jabatan lama, tmt jabatan lama --}}
                            Pegawai tersebut menduduki {{$data->pegawai->gol->golongan}}/{{$data->pegawai->gol->ruang}}
                            (TMT. {{$data->tmt}}) <br>
                            &nbsp; Jabatan : {{$data->pegawai->jabasn->nama}} 
                            (TMT. {{$data->tmtlama}})

                        @endif
                        
                    </td>
                </tr>
        </table>
    </div>
    <br><br>
    <div id="ttd" class="isi">
        <table class="ttd">
            <tr>
                <td class="ttd" style="text-align: left">Asli disampaikan dengan hormat kepada :</td>
                <td class="ttd">Ditetapkan di Banjarmasin</td>
            </tr>
            <tr>
                <td class="ttd" style="text-align: left">Kepala BKN di Jakarta</td>
                <td class="ttd">Pada tanggal 
                    @php
                        $a = $data->tanggal;

                        function tgl_indo($tanggal){
                            $bulan = array (
                                1 =>   'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                        }

                        echo tgl_indo($a); 
                    @endphp
                   </td>
            </tr>
            <tr>
                <td></td>
                <td class="ttd">
                              @if ($mengetahui != null)
                                @if ($mengetahui->pjs != null)
                                {{$mengetahui->pjs}}
                                {{$mengetahui->jabatan->jabatan}} 
                                {{$mengetahui->divisi->nama}}
                                @else 
                                {{$mengetahui->jabatan->jabatan}} 
                                {{$mengetahui->divisi->nama}}
                                @endif
                              @else
                                SILAHKAN CEK SETUP PEJABAT
                              @endif
                </td>
            </tr>
            <tr >
                <td style="height: 15%" class="ttd"></td>
                <td style="height: 15%" class="ttd"></td>
            </tr>
            <tr>
                <td></td>
                <td><u>
                        @if ($mengetahui !=null)
                        {{$mengetahui->user->name}}
                        @else
                        SILAHKAN CEK SETUP PEJABAT
                        @endif
                    </u>
                </td>
            </tr>
            <tr>
               <td></td>
                <td class="ttd">
                    @if ($mengetahui !=null)
                    NIP.  {{$mengetahui->user->no_pegawai}}
                    @else
                    SILAHKAN CEK SETUP PEJABAT
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left"><u>Tembusan :</u><br> 
                    1. Yth. Kepala Biro SDM Badan POM <br>
                    2. Yth. Pejabat yang berwenangn menetapkan Angka kredit <br>
                    3. Yth. Ketua Tim Penilai Angka Kredit Balai Besar POM di Banjarmasin
                </td>
            </tr>
        </table>

    </div><br><br>
</body>
</html>