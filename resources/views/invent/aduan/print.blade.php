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
         @page {
            size: A4;
            font-family: Arial;
            font-size: 12pt;
            line-height: 1;
        }

        table, td, th {
            border: 1px solid black;
            text-align: center;
            font-family: Arial;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12pt;
            font-family: Arial;
        }

        .lara{ 
            border: 1px solid black;
            padding: 15px;
            text-align: center;
            height: 85%;
            font-family: Arial;

            }
        .kiri1{
            border:none; font-size: 10pt; padding-left: 5px; text-align:left;width: 15%;font-family: Arial;
        }
        .kiri2{
            border: none; font-size: 10pt; text-align:left;width: 20%;font-family: Arial;
        }

        .rapi{
            border:none;
            border-collapse: collapse;
            text-align: left;font-family: Arial;
        }

        .ttd{
            border:none;
            border-collapse: collapse;
            text-align: center;font-family: Arial;
        }

        .aduan{
            border: 1px solid black;
            height: 35px;
            padding: 5px 5px 5px 5px;font-family: Arial;
        }
        

        </style>

</head>
<body>
    <div id="kepala">
        <table>
            <tr>
                <td rowspan="5" style="width: 20%;"> <img src="{{asset('images/BBRI.jpg')}}" style="height:80px"></td>
                <td rowspan="2" style="width: 30%; font-size: 12pt;">BALAI BESAR POM DI BANJARMASIN</td>
                <td class="kiri1">No. Bagian</td>
                <td class="kiri2">: A 19</td>
            </tr>
            <tr>
                <td class="kiri1">Terbitan/Tgl</td>
                <td class="kiri2">: 2/30 Des 2009</td>
            </tr>
            <tr>
                <td rowspan="2" style="width: 85%; font-size: 12pt;"><b>FORMAT - FORMAT</b></td>
                <td class="kiri1">Revisi/Tgl</td>
                <td class="kiri2">: 1/12 Apr 2013</td>
            </tr>
            <tr>
                <td class="kiri1">Halaman</td>
                <td class="kiri2">: 1 dari 1</td>
            </tr>
            <tr>
                <td colspan="3" style="width: 30%; font-size: 14pt;">
                    <b>SURAT PERBAIKAN INVENTARIS</b>
                </td>           
            </tr>
        </table>
    </div>  
    <div class="lara">
        <p style="text-align: center; font-size: 12pt;">
            <u><b>Surat Permintaan Perbaikan</b></u> <br>
            No. {{$data->no_aduan}}
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
            </table>
        <br>
        <table style="width: 100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA BARANG</th>
                    <th>TEMPAT</th>
                    <th>KETERANGAN</th>
                    <th>TINDAK LANJUT*</th>
                    <th>HASIL*</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
               @foreach ($isi as $item)
                <tr>
                    <td style="height: 100px;">
                        {{$no}}
                    </td>
                    <td style="width: 25%">{{$item->barang->nama_barang}} {{$item->barang->merk}}</td>
                    <td>{{$item->barang->location->nama}}</td>
                    <td>{{$item->keterangan}}</td>
                    <td></td>
                    <td></td>
                </tr>
                @php
                    $no++;
                @endphp
               @endforeach
            </tbody>
        </table>
       <p style="font-size: 12pt;text-align:left;"> *Diisi Oleh Petugas</p>
        <div id="ttd">
            <table class="ttd">
                <tr class="ttd">
                    <td class="ttd">Menyetujui,</td>
                    <td class="ttd">Mengetahui,</td>
                    <td class="ttd" style="width: 34%">Yang Meminta,</td>
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
                            Silahkan Cek Setup Pejabat
                        @endif
                    </td>
                    <td class="ttd">
                                {{-- @if ($mengetahui!= null)
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
                                    Silahkan Cek Setup Pejabat
                                @endif --}}
                    </td>
                    <td class="ttd"></td>
                </tr>
                <tr class="ttd">
                    <td style="height: 10%" class="ttd"></td>
                    <td class="ttd"></td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">
                        <u>
                            @if ($menyetujui !=null)
                                {{$menyetujui->user->name}}
                            @else
                                Silahkan Cek Setup Pejabat
                            @endif   
                        </u>
                    </td>
                    <td class="ttd"><u>
                        @if ($mengetahui !=null)
                        {{$mengetahui->user->name}}
                        @else
                        Silahkan Cek Setup Pejabat
                        @endif
                    </u>
                    </td>
                    <td class="ttd"><u>{{$data->lapor->name}}</u></td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">
                        @if ($menyetujui !=null)
                        NIP. {{$menyetujui->user->no_pegawai}}
                        @else
                        Silahkan Cek Setup Pejabat
                        @endif
                    </td>
                    <td class="ttd">
                        @if ($mengetahui !=null)
                        NIP.  {{$mengetahui->user->no_pegawai}}
                        @else
                        Silahkan Cek Setup Pejabat
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
        <br>
        <div style="font-size: 12pt; text-align:left;">
            <b>Selesai Diperbaiki tanggal : </b>
        </div>
        <br>
        <div class="col-sm-12">
            <table class="ttd">
                <tr class="ttd">
                    <td class="ttd">Petugas Perlengkapan,</td>
                    <td class="ttd" style="width: 50%">Yang Menerima,</td>
                </tr>
                <tr class="ttd">
                    <td style="height: 20%" class="ttd"></td>
                    <td class="ttd"></td>
                </tr>
                <tr class="ttd">
                  <td class="ttd"><u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</u></td>
                    <td class="ttd"> <u>{{$data->lapor->name}}</u>
                    </td>
                </tr>
                <tr class="ttd">
                    <td class="ttd">NIP. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                    <td class="ttd">
                        @if ($data->lapor->jabasn_id != null)
                            NIP. {{$data->lapor->no_pegawai}}
                        @endif
                    </td>
                </tr>
            </table>
        </div><br>
    </div>
</body>
</html>