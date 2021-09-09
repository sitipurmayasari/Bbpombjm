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
            margin: 10px 15px 10px 15px;

        }

        #kepala {
            text-align: left;
            font-size: 6;
            font-style: italic;
            border-collapse: collapse;
            border: none;
        }
        
        #kop{
            text-align: center;
            line-height: 1.5;
        }

        .isi td{
            font-size: 8;
            padding-left: 5px; 
            border: 1px solid black;
            vertical-align : top;
        }

        .didalam td{
            border:none;
        }


        </style>

</head>
<body>
   <table style="width: 100%; padding" id="kepala">
    <tr>
        <td style="width: 11%">Program/kegiatan</td>
        <td style="width: 15%">:</td>
        <td rowspan="5" style="vertical-align: bottom; text-align: center;" ><img src="{{asset('images/BBRI.jpg')}}" style="height:80px"></td>
        <td style="width: 28%">Lampiran VI (4 dari 4)</td>
    </tr>
    <tr>
        <td>KRO/RO/komponen</td>
        <td>:</td>
        <td>Peraturan Menteri Keuangan tentang Perjalanan Dinas</td>
    </tr>
    <tr>
        <td>Sub Komponen/Akun</td>
        <td>:</td>
        <td>Dalam Negeri bagi Pejabat Negara Pegawai Negeri Sipil</td>
    </tr>
    <tr>
        <td>No. Surat Tugas</td>
        <td>:</td>
        <td>Dan Pegawai Tidak Tetap</td>
    </tr>
    <tr>
        <td>Petugas</td>
        <td>:</td>
        <td>Nomor : 113/PMK.05/2012 &nbsp;&nbsp;&nbsp;&nbsp; Tgl. : 23 Juli 2012</td>
    </tr>
   </table>
   <div id="kop">
        <b style="font-size: 12;"><u>SURAT PERINTAH PERJALANAN DINAS</u></b>
        <p style="font-size: 10;">Nomor : </p>
   </div>
   <table class="isi" style="width: 100%;">
       <tr> 
           <td style="width:42%">1. Pejabat yang berwenang memberi perintah</td>
           <td>Kuasa Pengguna Anggaran Balai Besar Pengawas Obat dan Makanan di Banjarmasin</td>
       </tr>
       <tr>
           <td>2.Nama Pegawai yang diperintah / NIP</td>
           <td>
                (nama / NIP.)
           </td>
       </tr>
       <tr>
           <td>
               3. a. Pangkat / Golongan <br>
               &nbsp; &nbsp; b. Jabatan <br>
               &nbsp; &nbsp; c. Tingkat menurut peraturan perjalanan dinas
           </td>
           <td>
                (pangol) <br>
                (jafung) <br>
                -
           </td>
       </tr>
       <tr>
           <td>4. Maksud Perjalanan Dinas</td>
           <td>
            (alasan)
            <br><br>
            di (tujuan 1 dan tujuan 2)
           </td>
       </tr>
       <tr>
           <td>
               5. Alat Angkutan yang dipergunakan <br>
               6. a. Tempat Berangkat <br>
               &nbsp; &nbsp; b. Tempat Tujuan
           </td>
           <td>
                (jenis transportasi) <br>
                (asal) <br>
                (tujuan 1 dan tujuan 2)
           </td>
       </tr>
       <tr>
           <td>
               7. a. Lama perjalanan dinas <br>
               &nbsp; &nbsp; b. Tanggal berangkat <br>
               c. Tanggal harus kembali / tiba di tempat baru
           </td>
           <td>
               (jumlah hari) <br>
               (tanggal pergi) <br>
               (tanggal pulang kapung)
           </td>
       </tr>
       <tr>
           <td>
               8. Pembebanan Anggaran <br>
               &nbsp; &nbsp; a. Instansi <br>
               &nbsp; &nbsp; b. Mata Anggaran
           </td>
           <td>
                Hanya instansi yang dikuasainya <br>
                (Kode Anggaran Dinas) <br>
                (komponen / akun)
           </td>
       </tr>
       <tr>
           <td>
               9. Keterangan lain-lain <br>
               <table class="didalam">
                <tr>
                    <td>Dikeluarkan di</td>
                    <td>: (Kota Asal)</td>
                </tr>
                <tr>
                    <td>Pada tangal</td>
                    <td>: (Tanggal ST)</td>
                </tr>
                <tr>
                    <td colspan="2">(Jabatan PPK)</td>
                </tr>
                <tr>
                    <td style="height: 5%"></td>
                </tr>
                <tr>
                    <td>
                        <u><b> (Nama PPK) </b></u>
                    </td>
                </tr>
                <tr>
                    <td>(no pegawai ppk)</td>
                </tr>
               </table>
           </td>
           <td>
            <table class="didalam">
                <tr>
                    <td>Surat Tugas Nomor</td>
                    <td>: (No. ST)</td>
                    <td style="text-align: right;">Tgl. </td>
                    <td> &nbsp; (tgl ST)</td>
                </tr>
                <tr>
                    <td>Berangkat dari</td>
                    <td>: (Tanggal ST)</td>
                    <td>Pada tanggal</td>
                    <td>: (tgl pergi)</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">(Tempat kedudukan)</td>
                    <td>Tujuan</td>
                    <td>(Kota Tujuan)</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;">Kepala bagian Tata Usaha</td>
                </tr>
                <tr>
                    <td style="height: 5%" colspan="4" style="text-align: left;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;">
                        <u><b> (Nama kepala TU) </b></u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left;">
                        (no pegawai)
                    </td>
                </tr>
               </table>
           </td>
       </tr>
       <tr>
           <td></td>
       </tr>
   </table>
</body>
</html>