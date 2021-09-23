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
            font-family: 'Times New Roman';
            font-size: 8;
            font-style: italic;
            margin-top: 25px;
            margin-bottom: 15px;
            line-height: 1;

        }

        /* table, tr, td, th {
            padding-top: 3px;
            padding-bottom: 3px;
        } */

        .kepala {
            text-align: left;
            font-style: italic;
            font-size: 8;
            border-collapse: collapse;
            border: none;
            line-height: 1.3;

        }

        .dalem {
            text-align: left;
            font-style: italic;
            font-size: 8;
            border-collapse: collapse;
            border: none;
            line-height: 1;

        }

        .isi{
            font-size: 8;
            font-family: 'Times New Roman';
            border: 1px solid black;
            vertical-align : top;
            line-height: 1;

        }

      
        #border{
            text-align: center;
            font-size: 10;
            line-height: 1;
        }

        th{
            text-align: center;
            letter-spacing: 2px;
        }
        p{
            font-size: 10; 
            text-align:center;
        }


        </style>

</head>
<body>
    <table style="width: 100%;" class="kepala">
        <tr>
            <td style="vertical-align: bottom; text-align: center;"  colspan="3">
                <img src="{{asset('images/BBRI.jpg')}}" style="height:50px">
            </td>
            <td colspan="2" style=" font-size: 6; line-height: 1;">
                Lampiran<br>
                Peraturan Direktur Jenderal Perbendaharaan Nomor Per 37/PB/2007<br>
                tentang Petunjuk Pelaksanaan Perjalanan Dinas Jabatan Dalam Negeri <br>
                Bagi Pejabat Negara Pegawai Negeri Sipil dan pejabatn Tidak Tetap <br>
                Nomor 113/PMK.05/2012 &nbsp;&nbsp;&nbsp; Tgl. 23 Juli 2012
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;  font-size: 10; font-style: normal; line-height: 1;">
                BALAI BESAR PENGAWAS OBAT DAN MAKANAN</td>
            <td style="width: 20%">Beban MAK</td>
            <td style="width: 20%">
                 : (subakun / akun )
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;  font-size: 10; line-height: 1;" > Di Banjarmasin</td>
            <td>Tahun Anggaran</td>
            <td> : TA</td>
        </tr>
        <tr>
            <td colspan="3">
                <div id="border">
                   <b> DAFTAR PENGELUARAN RIIL</b><br>
                </div>
            </td>
            <td style="vertical-align: top;" >Bukti Kas</td>
            <td> : ...............................</td>
        </tr>
        <tr>
            <td colspan="3">Yang bertanda tangan di bawah ini :</td>
            <td>Program / Kegiatan</td>
            <td> : (063.01.WA.6384)</td>
        </tr>
        <tr>
            <td style="width: 8%" >Nama</td>
            <td colspan="2"> : (Nama)</td>
            <td>KRO/RO/Komponen</td>
            <td> : (EAA/004/002)</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td colspan="2"> : (no_pegawai)</td>
            <td>Sub Komponen / Akun</td>
            <td> : (sub / akun)</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td colspan="2"> : (deskjob) </td>
            <td>No. Surat Tugas</td>
            <td> : (NOST)</td>
        </tr>
        <tr>
            <td colspan="2"> <br>   Berdasarkan SPPD Nomor</td>
            <td  style="width: 40%"> <br> : (NOSPPD)</td>
            <td colspan="2"> <br> Tanggal SPPD : (TGL)</td>
        </tr>
        <tr>
            <td colspan="2">Untuk Perjalanan Dinas</td>
            <td colspan="3">
                : dari <b>(ASAL)</b> ke <b>(TUJUAN)</b> selama (hari) hari, dengan ini menyatakan dengan sesungguhnya bahwa : 
            </td>
        </tr>
        <tr>
            <td colspan="5">
                1. Biaya transport pegawai dan atau biaya penginapan di bawah ini yang tidak dapat diperoleh 
                bukti - bukti pengeluarannya, meliputi :
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <table style="width: 100%" class="isi">
                    <thead>
                        <tr>
                            <th class="isi">No.</th>
                            <th class="isi">Uraian</th>
                            <th class="isi">Jumlah</th>
                            <th class="isi">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center" class="isi">1</td>
                            <td class="isi" style="line-height: 1;">Biaya Transport : <br>
                                <b>(ASAL)
                                    &nbsp;&nbsp;&nbsp;
                                    (TUJUAN)
                                </b>

                            </td>
                            <td class="isi" >Rp. </td>
                            <td class="isi" style="text-align: center">(jenis transpoprtasi</td>
                        </tr>
                        <tr>
                            <td style="text-align: center" class="isi">2</td>
                            <td class="isi">Biaya Penginapan : 
                                (jumhari) hari &nbsp;&nbsp; x Rp. nominal 
                            </td>
                            <td class="isi">Rp. </td>
                            <td class="isi"></td>
                        </tr>
                        <tr>
                            <td class="isi"></td>
                            <td class="isi"><b>Jumlah pengeluaran riil :</b></td>
                            <td class="isi">Rp. </td>
                            <td class="isi"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                2. Jumlah uang tersebut pada angka 1 di atas benar - benar di keluarkan untuk pelaksanaan perjalanan dinas dimaksud
                dan apabila di kemudian <br> &nbsp;&nbsp;&nbsp;
                hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut
                ke Kas Negara.
            </td>
        </tr>     
   </table>
   <table style="width: 100%;" class="dalem">
        <tr>
            <td colspan="3">
                
                Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaaimana mestinya
                <br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align:center;">Banjarmasin, (tgl Kuitansi)</td>
        </tr>
        <tr>
            <td style="text-align:center;">Setuju dibayar</td>
            <td></td>
            <td style="text-align:center;">Pejabat Negara / Pegawai Negeri</td>
        </tr>
        <tr>
            <td style="text-align:center;">(JAbatan PPK)</td>
            <td></td>
            <td style="text-align:center;">yang melakukan perjalanan dinas :</td>
        </tr>
        <tr>
            <td style="height: 3%"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="line-height: 1; text-align:center;">
                <u>(nama pejabat)</u> <br>
                NIP. (no_pegawai)
            </td>
            <td></td>
            <td style="line-height: 1; text-align:center;">
                <u>Nama pegawai</u> <br>
                NIP> (no_pegawai)
            </td>
            <tr>
                <td colspan="3" style="text-align:center; letter-spacing: 2px; line-height: 1; "><br>
                    BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</td>
            </tr>
            <tr>
                <td colspan ="3" style="text-align:center; font-size:6; line-height: 1; ">almagfghfghfgh</td>
            </tr>
            <tr>
                <td style="text-align: left; font-size:6; line-height: 1; "> hari, tanggal kuitansi</td>
                <td></td>
                <td style="text-align: right; line-height: 1; " > Page 1 of 1</td>
            </tr>
        </tr>
   </table>

    <br>
    <br>
    <br>
    <table style="width: 100%;" class="kepala">
        <tr>
            <td style="vertical-align: bottom; text-align: center;"  colspan="3">
                <img src="{{asset('images/BBRI.jpg')}}" style="height:50px">
            </td>
            <td colspan="2" style=" font-size: 6;">
                Lampiran<br>
                Peraturan Direktur Jenderal Perbendaharaan Nomor Per 37/PB/2007<br>
                tentang Petunjuk Pelaksanaan Perjalanan Dinas Jabatan Dalam Negeri <br>
                Bagi Pejabat Negara Pegawai Negeri Sipil dan pejabatn Tidak Tetap <br>
                Nomor 113/PMK.05/2012 &nbsp;&nbsp;&nbsp; Tgl. 23 Juli 2012
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;  font-size: 10; font-style: normal; line-height: 1;">
                BALAI BESAR PENGAWAS OBAT DAN MAKANAN</td>
            <td style="width: 20%">Beban MAK</td>
            <td style="width: 20%">
                 : (subakun / akun )
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;  font-size: 10; line-height: 1;" > Di Banjarmasin</td>
            <td>Tahun Anggaran</td>
            <td> : TA</td>
        </tr>
        <tr>
            <td colspan="3">
                <div id="border">
                   <b> DAFTAR PENGELUARAN RIIL</b><br>
                </div>
            </td>
            <td style="vertical-align: top;" >Bukti Kas</td>
            <td> : ...............................</td>
        </tr>
        <tr>
            <td colspan="3">Yang bertanda tangan di bawah ini :</td>
            <td>Program / Kegiatan</td>
            <td> : (063.01.WA.6384)</td>
        </tr>
        <tr>
            <td style="width: 8%">Nama</td>
            <td colspan="2"> : (Nama)</td>
            <td>KRO/RO/Komponen</td>
            <td> : (EAA/004/002)</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td colspan="2"> : (no_pegawai)</td>
            <td>Sub Komponen / Akun</td>
            <td> : (sub / akun)</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td colspan="2"> : (deskjob) </td>
            <td>No. Surat Tugas</td>
            <td> : (NOST)</td>
        </tr>
        <tr>
            <td colspan="2"> <br>   Berdasarkan SPPD Nomor</td>
            <td  style="width: 40%"> <br> : (NOSPPD)</td>
            <td colspan="2"> <br> Tanggal SPPD : (TGL)</td>
        </tr>
        <tr>
            <td colspan="2">Untuk Perjalanan Dinas</td>
            <td colspan="3">
                : dari <b>(ASAL)</b> ke <b>(TUJUAN)</b> selama (hari) hari, dengan ini menyatakan dengan sesungguhnya bahwa : 
            </td>
        </tr>
        <tr>
            <td colspan="5">
                1. Biaya transport pegawai dan atau biaya penginapan di bawah ini yang tidak dapat diperoleh 
                bukti - bukti pengeluarannya, meliputi :
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <table style="width: 100%" class="isi">
                    <thead>
                        <tr>
                            <th class="isi">No.</th>
                            <th class="isi">Uraian</th>
                            <th class="isi">Jumlah</th>
                            <th class="isi">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center" class="isi">1</td>
                            <td class="isi" style="line-height: 1;">Biaya Transport : <br>
                                <b>(ASAL)
                                    &nbsp;&nbsp;&nbsp;
                                    (TUJUAN)
                                </b>

                            </td>
                            <td class="isi" >Rp. </td>
                            <td class="isi" style="text-align: center">(jenis transpoprtasi</td>
                        </tr>
                        <tr>
                            <td style="text-align: center" class="isi">2</td>
                            <td class="isi">Biaya Penginapan : 
                                (jumhari) hari &nbsp;&nbsp; x Rp. nominal 
                            </td>
                            <td class="isi">Rp. </td>
                            <td class="isi"></td>
                        </tr>
                        <tr>
                            <td class="isi"></td>
                            <td class="isi"><b>Jumlah pengeluaran riil :</b></td>
                            <td class="isi">Rp. </td>
                            <td class="isi"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                2. Jumlah uang tersebut pada angka 1 di atas benar - benar di keluarkan untuk pelaksanaan perjalanan dinas dimaksud
                dan apabila di kemudian <br> &nbsp;&nbsp;&nbsp;
                hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut
                ke Kas Negara.
            </td>
        </tr>     
   </table>
   <table style="width: 100%;" class="kepala">
        <tr>
            <td colspan="3">
                
                Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaaimana mestinya
                <br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align:center;">Banjarmasin, (tgl Kuitansi)</td>
        </tr>
        <tr>
            <td style="text-align:center;">Setuju dibayar</td>
            <td></td>
            <td style="text-align:center;">Pejabat Negara / Pegawai Negeri</td>
        </tr>
        <tr>
            <td style="text-align:center;">(JAbatan PPK)</td>
            <td></td>
            <td style="text-align:center;">yang melakukan perjalanan dinas :</td>
        </tr>
        <tr>
            <td style="height: 3%"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="line-height: 1; text-align:center;">
                <u>(nama pejabat)</u> <br>
                NIP. (no_pegawai)
            </td>
            <td></td>
            <td style="line-height: 1; text-align:center;">
                <u>Nama pegawai</u> <br>
                NIP> (no_pegawai)
            </td>
            <tr>
                <td colspan="3" style="text-align:center; letter-spacing: 2px; line-height: 1; "><br>
                    BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</td>
            </tr>
            <tr>
                <td colspan ="3" style="text-align:center; font-size:6; line-height: 1; ">almagfghfghfgh</td>
            </tr>
            <tr>
                <td style="text-align: left; font-size:6; line-height: 1; "> hari, tanggal kuitansi</td>
                <td></td>
                <td style="text-align: right; line-height: 1; "> Page 1 of 1</td>
            </tr>
        </tr>
   </table>
</body>
</html>