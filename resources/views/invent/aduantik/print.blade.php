<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>

    <style>
        table, td, th {
            border: 1px solid black;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 11px;
        }

        .lara{ 
            border: 1px solid black;
            padding: 15px;
            text-align: center;
            height: 85%;

            }
        .kiri1{
            border:none; font-size: 10px; padding-left: 5px; text-align:left;width: 15%;
        }
        .kiri2{
            border: none; font-size: 10px; text-align:left;width: 20%;
        }

        .rapi{
            border:none;
            border-collapse: collapse;
            text-align: left;
        }

        .ttd{
            border:none;
            border-collapse: collapse;
            text-align: center;
        }

        .aduan{
            border: 1px solid black;
            height: 35px;
            padding: 5px 5px 5px 5px;
        }

        </style>

</head>
<body>
    <div id="kepala">
        <table>
            <tr>
                <td rowspan="5" style="width: 20%;"> <img src="{{asset('images/BBRI.jpg')}}" style="height:80px"></td>
                <td rowspan="2" style="width: 30%; font-size: 14px;">BALAI BESAR POM DI BANJARMASIN</td>
                <td class="kiri1">No. Bagian</td>
                <td class="kiri2">: A 19</td>
            </tr>
            <tr>
                <td class="kiri1">Terbitan/Tgl</td>
                <td class="kiri2">: 2/30 Des 2009</td>
            </tr>
            <tr>
                <td rowspan="2" style="width: 85%; font-size: 14px;"><b>FORMAT - FORMAT</b></td>
                <td class="kiri1">Revisi/Tgl</td>
                <td class="kiri2">: 1/12 Apr 2013</td>
            </tr>
            <tr>
                <td class="kiri1">Halaman</td>
                <td class="kiri2">: 1 dari 1</td>
            </tr>
            <tr>
                <td colspan="3" style="width: 30%; font-size: 16px;">
                    <b>SURAT PERBAIKAN INVENTARIS</b>
                </td>           
            </tr>
        </table>
    </div>  
    <div class="lara">
        <p style="text-align: center; font-size: 12px;">
            <u><b>Surat Permintaan Perbaikan Inventaris TIK</b></u> <br>
            NO. {{$data->no_aduan}}
        </p>
        <div >
            <table class="rapi">
                <tr>
                    <td class="rapi" style="width: 20%; ">Bag / Bid / Lab</td>
                    <td  class="rapi"style="width: 2%;">:</td>
                    <td class="rapi">
                        @if ($data->lapor->subdivisi_id !=null)
                            {{$data->lapor->subdivisi->nama_subdiv}} ( {{$data->lapor->divisi->nama}} )
                        @else
                            {{$data->lapor->divisi->nama}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td  class="rapi"style="width: 20%;">Tanggal Permintaan</td>
                    <td  class="rapi"style="width: 2%; ">:</td>
                    <td class="rapi">{{$data->tanggal}}</td>
                </tr>
                <tr>
                    <td class="rapi" style="width: 20%; ">Nama Barang</td>
                    <td  class="rapi"style="width: 2%;">:</td>
                    <td class="rapi"><b>{{$data->barang->nama_barang}} - {{$data->barang->merk}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="rapi" style="width: 20%; ">Lokasi</td>
                    <td  class="rapi"style="width: 2%;">:</td>
                    <td class="rapi">{{$data->barang->location->nama}}
                    </td>
                </tr>
                <tr>
                    <td class="rapi" colspan="3" ><b>ADUAN KERUSAKAN</b></td>
                </tr>
                <tr>
                    <td class="rapi" colspan="3" >
                        <div class="aduan">
                            {{$data->problem}}
                        </div>
                    </td>
                </tr>
            </table>
        <br>
        <div id="ttd">
            <table class="ttd">
                <tr class="ttd">
                    <td class="ttd">Mengetahui,</td>
                    <td class="ttd" style="width: 50%">Yang Meminta,</td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">
                                @if ($mengetahui!= null)
                                    @if ($mengetahui->pjs != null)
                                        {{$mengetahui->pjs}}
                                        {{$mengetahui->jabatan->jabatan}} 
                                    @else
                                        {{$mengetahui->jabatan->jabatan}} 
                                    @endif
                                    @if ($mengetahui->jabatan_id == 5 )
                                        {{$mengetahui->subdivisi->nama_subdiv}}
                                    @elseif ($mengetahui->jabatan_id == 7 or $mengetahui->jabatan_id==11)
                                        {{$mengetahui->divisi->nama}}
                                    @else
                                        Kepala Balai Besar POM di Banjarmasin
                                    @endif
                                @else
                                    SILAHKAN CEK SETUP PEJABAT
                                @endif
                    </td>
                    <td class="ttd"></td>
                </tr>
                <tr class="ttd">
                    <td style="height: 5%" class="ttd"></td>
                    <td class="ttd"></td>
                </tr>
                <tr class="ttd">
                    <td class="ttd"><u>
                        @if ($mengetahui !=null)
                        {{$mengetahui->user->name}}
                        @else
                        SILAHKAN CEK SETUP PEJABAT
                        @endif
                    </u>
                    </td>
                    <td class="ttd"><u>{{$data->lapor->name}}</u></td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">
                        @if ($mengetahui !=null)
                        NIP.  {{$mengetahui->user->no_pegawai}}
                        @else
                        SILAHKAN CEK SETUP PEJABAT
                        @endif
                    </td>
                    <td class="ttd">
                        @if ($data->lapor->jabasn_id != null)
                            NIP. {{$data->lapor->no_pegawai}}
                        @endif
                    </td>
                </tr>
            </table>
        </div><br>
        <div style="font-size: 11px; text-align:left;">
            <b>ANALISA PEMERIKSA</b><br>
            Tanggal Analisa : 
            <div class="aduan">
            </div>
            <br>
            <b>TINDAK LANJUT</b>
            <div class="aduan">
            </div>
        </div>
        <br>
        <div class="col-sm-12">
            <table class="ttd">
                <tr class="ttd">
                    <td class="ttd">Menyetujui,</td>
                    <td class="ttd" style="width: 50%">Pemeriksa,</td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">
                        @if ($menyetujui != null)
                            @if ($menyetujui->pjs != null)
                                {{$menyetujui->pjs}}
                                {{$menyetujui->jabatan->jabatan}} 
                                {{$menyetujui->divisi->nama}}
                             @else 
                                {{$menyetujui->jabatan->jabatan}} 
                                {{$menyetujui->divisi->nama}}
                            @endif
                        @else
                            SILAHKAN CEK SETUP PEJABAT
                        @endif
                    </td>
                    <td class="ttd">Petugas TIK</td>
                </tr>
                <tr class="ttd">
                    <td style="height: 7%" class="ttd"></td>
                    <td class="ttd"></td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">
                        <u>
                            @if ($menyetujui !=null)
                                {{$menyetujui->user->name}}
                            @else
                                SILAHKAN CEK SETUP PEJABAT
                            @endif   
                        </u>
                    </td>
                    <td class="ttd"><u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</u></td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">
                        @if ($menyetujui !=null)
                        NIP. {{$menyetujui->user->no_pegawai}}
                        @else
                        SILAHKAN CEK SETUP PEJABAT
                        @endif
                    </td>
                    <td class="ttd">NIP. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                </tr>
            </table>
        </div><br>
        <div style="font-size: 11px; text-align:left;">
            <b>Selesai Diperbaiki tanggal : <br>
                HASIL
            </b>
            <div class="aduan">
            </div>
        </div>
        <br>
        <div class="col-sm-12">
            <table class="ttd">
                <tr class="ttd">
                    <td class="ttd">Petugas TIK,</td>
                    <td class="ttd">Petugas Perlengkapan,</td>
                    <td class="ttd" style="width: 35%">Yang Menerima,</td>
                </tr>
                <tr class="ttd">
                    <td style="height: 25%" class="ttd"></td>
                    <td class="ttd"></td>
                    <td class="ttd"></td>
                </tr>
                <tr class="ttd">
                    <td class="ttd"><u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</u></td>
                    <td class="ttd"><u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</u></td>
                    <td class="ttd"> <u>{{$data->lapor->name}}</u>
                    </td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">NIP. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                    <td class="ttd">NIP. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                    <td class="ttd">
                        @if ($data->lapor->jabasn_id != null)
                            NIP. {{$data->lapor->no_pegawai}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>