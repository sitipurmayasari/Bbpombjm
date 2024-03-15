<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>BA PERPINDAHAN BMN</title>

    <style>
        @page {
            size: A4;
            font-family: Arial;
            font-size: 12pt;
            margin: 130px 0px 0px 0px;
            line-height: 1;
        }

        html,table{
            font-family: Arial;
            font-size: 12pt;
        }
        
        .pad{
            padding-top: 10px;
            font-size: 12pt;
        }

        table, td, th {
            border: 1px solid black;
            text-align: left;
            border-collapse: collapse;
            border:none;
        }

        #isi{
            font-family: Arial;
            font-size: 12pt;
            margin-left: 10%;
            margin-right: 10%;
        }

        #kop{
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
        }

        .atas{
            border: solid 1px;
        }

        #isiatas{
            border: solid 1px;
            padding-left: 5px;
        }

        th{
            text-align: center;
            border: solid 1px;
            font-weight: bold;
            line-height: 1;
        }

        .ttd{
            text-align: center;
            font-size: 12pt;
        }
        p{
            font-size: 12pt;
        }

        </style>

</head>
<body>
    <div id="kop">
        <b>BERITA ACARA DISTRIBUSI BARANG MILIK NEGARA (BMN) <br>
            BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN <br>
            NOMOR : {{$data->nomor}}
        </b>
    </div>
    <br>
    <div id="isi">
        @php
        $a = strtotime($data->tanggal);
        $b = date('d', $a);
        $c = date('D', $a);
        $d = date('m', $a);
        $e = date('Y', $a);

        if ($c=='sun') {
            $days='Minggu';
        }else if ($c=='Mon') {
            $days='Senin';
        }else if ($c=='Tue') {
            $days='Selasa';
        }else if ($c=='Wed') {
            $days='Rabu';
        }else if ($c=='Thu') {
            $days='Kamis';
        }else if ($c=='Fri') {
            $days='Jumat';
        }else{
            $days='Sabtu';
        };

        if ($d=='01') {
            $mon='Januari';
        }else if ($d=='02') {
            $mon='Februari';
        }else if ($d=='03') {
            $mon='Maret';
        }else if ($d=='04') {
            $mon='April';
        }else if ($d=='05') {
            $mon='Mei';
        }else if ($d=='06') {
            $mon='Juni';
        }else if ($d=='07') {
            $mon='Juli';
        }else if ($d=='08') {
            $mon='Agustus';
        }else if ($d=='09') {
            $mon='September';
        }else if ($d=='10') {
            $mon='Oktober';
        }else if ($d=='11') {
            $mon='November';
        }else{
            $mon='Desember';
        };

    @endphp

        <p>Pada hari {{$days}} tanggal {{$b}} bulan {{$mon}} tahun {{$e}} yang bertanda tangan di bawah ini :</p>
        <table style="width: 100%">
            <tr>
                <td style="text-align: center; width:5%"> I. </td>
                <td style="width: 10%"> Nama</td>
                <td style="width: 1%">:</td>
                <td> {{$data->lama->name}}</td>
            </tr>
            <tr>
                <td></td>
                <td> NIP</td>
                <td>:</td>
                <td> 
                    @if ($data->lama->golongan_id != null)
                        {{$data->lama->no_pegawai}}
                    @else
                        {{ '-' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td> Jabatan</td>
                <td>:</td>
                <td> {{$data->lama->jabatan->jabatan}}
                    {{$data->lama->divisi->nama}}
                    @if ($data->lama->subdivisi_id != null)
                        {{$data->lama->subdivisi->nama}}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td> Alamat</td>
                <td>:</td>
                <td> {{$data->alamat_lama}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" class="pad">Yang selanjutnya disebut sebagai <b>PIHAK PERTAMA</b> <br> &nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center"> II. </td>
                <td> Nama</td>
                <td>:</td>
                <td> 
                    {{$data->baru->name}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td> NIP</td>
                <td>:</td>
                <td> 
                    {{$data->baru->no_pegawai}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td> Jabatan</td>
                <td>:</td>
                <td> 
                    {{$data->baru->jabatan->jabatan}}
                    {{$data->baru->divisi->nama}}
                    @if ($data->baru->subdivisi_id != null)
                        {{$data->baru->subdivisi->nama}}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td> Alamat</td>
                <td>:</td>
                <td> {{$data->alamat_baru}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3"  class="pad">Selanjutnya disebut sebagai <b>PIHAK KEDUA</b></td>
            </tr>
        </table>
        <br>
        <p><b>PIHAK PERTAMA</b> menyerahkan dan <b>PIHAK KEDUA</b> menerima penyerahan Barang Milik Negara (BMN) dengan spesifikasi sebagai berikut :</p>
        <table style="width: 100%" class="atas">
            <thead>
                <tr>
                    <th style="width: 5%">No.</th>
                    <th style="width: 25%">Nama Barang</th>
                    <th  style="width: 8%">NUP</th>
                    <th style="width: 25%">Merk/Type</th>
                    <th style="width: 10%">Jumlah<br>(Unit)</th>
                    <th style="width: 12%">Tahun<br>
                        Perolehan
                    </th>
                    <th >Ket</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="atas" style="text-align: center; height: 40px;"> 1</td>
                    <td id="isiatas"> {{$data->barang->nama_barang}}</td>                       
                    <td class="atas" style="text-align: center;"> {{$data->barang->no_seri}}</td>
                    <td id="isiatas">{{$data->barang->merk}}</td>   
                    <td id="isiatas" style="text-align: center"> 1 Unit</td>
                    <td class="atas" style="text-align: center">&nbsp; 
                        @php
                            $year = date('Y', strtotime($data->barang->tanggal_diterima));
                        @endphp
                        {{$year}}
                    </td>
                    <td class="atas">&nbsp; {{$data->ket}}</td>
                </tr>    
            </tbody>
        </table>
        <br>
        <p><b>PIHAK KEDUA</b> bertanggung jawab segala sesuatu atas barang - barang tersebut. Apabila terjadi kehilangan menjadi tanggung jawab petugas yang diserahkan barang. <br>
        Demikian Berita Acara ini dibuat dengan benar untuk dipergunakan sebagaimana mestinya.</p>
    </div>
    <div>
        <table style="width: 100%" class="ttd">
            <tr class="ttd">
                <td class="ttd" style="width: 50%">PIHAK PERTAMA</td>
                <td class="ttd" tyle="width: 50%">PIHAK KEDUA</td>
            </tr>
            <tr class="ttd">
                <td style="height: 50px" class="ttd"></td>
                <td class="ttd"></td>
            </tr>
            <tr class="ttd">
                <td class="ttd">{{$data->lama->name}}</td>
                <td class="ttd">
                    {{$data->baru->name}}
                </td>
            </tr>
        </table>
        <table style="width: 100%" class="ttd">
            <tr class="ttd">
                <td class="ttd">Mengetahui,</td>
            </tr>
            <tr class="ttd">
                <td class="ttd">KUASA PENGGUNA BARANG</td>
            </tr>
            <tr class="ttd">
                <td style="height: 50px" class="ttd"></td>
            </tr>
            <tr class="ttd">
                <td class="ttd">{{$mengetahui->user->name}}</td>
            </tr>
        </table>
    </div>
</body>
</html>