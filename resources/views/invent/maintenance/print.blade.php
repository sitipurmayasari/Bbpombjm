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
            font-size: 12;
            margin: 150px 0px 100px 0px;
        }

        html,table{
            font-family: Arial;
            font-size: 11;
        }

        table, td, th {
            border: 1px solid black;
            text-align: left;
            border-collapse: collapse;
            border:none;
        }

        #isi{
            font-family: Arial;
            font-size: 11;
            margin-left: 10%;
            margin-right: 10%;
            /* line-height: 2; */
        }

        #kop{
            text-align: center;
            font-size: 16px;
        }

        .atas{
            border: solid 1px;
        }

        #isiatas{
            border: solid 1px;
            padding-left: 5px;
            width: 40%;
        }

        th{
            text-align: center
        }

        .ttd{
            text-align: center;
        }

        </style>

</head>
<body>
    <div id="kop">
        <b>
            BERITA ACARA SERAH DISTRIBUSI BARANG MILIK NEGARA (BMN) <br>
            BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN<br>
            NOMOR : {{$data->nomor}}
        </b> 
    </div>
    <br><br>
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

        Pada hari ini {{$days}} tanggal {{$b}} bulan {{$mon}} tahun {{$e}},
        yang bertanda tangan di bawah ini :
        <table style="width: 100%">
            <tr>
                <td style="text-align: center; width:5%"> I. </td>
                <td style="width: 10%"> Nama</td>
                <td style="width: 1%">:</td>
                <td> {{$data->pegawai->name}}</td>
            </tr>
            <tr>
                <td></td>
                <td> NIP</td>
                <td>:</td>
                <td> 
                    @if ($data->pegawai->golongan_id != null)
                        {{$data->pegawai->no_pegawai}}
                    @else
                        {{ '-' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td> Jabatan</td>
                <td>:</td>
                <td> {{$data->pegawai->jabatan->jabatan}}
                    {{$data->pegawai->divisi->nama}}
                    @if ($data->pegawai->subdivisi_id != null)
                        {{$data->pegawai->subdivisi->nama}}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td> Alamat</td>
                <td>:</td>
                <td> {{$data->pegawai->alamat}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3"> Yang selanjutnya disebut sebagai <b>PIHAK PERTAMA</b></td>
            </tr>
            <tr>
                <td style="text-align: center"> II. </td>
                <td> Nama</td>
                <td>:</td>
                <td> 
                    {{$petugas->user->name}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td> NIP</td>
                <td>:</td>
                <td> 
                    {{$petugas->user->no_pegawai}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td> Jabatan</td>
                <td>:</td>
                <td> 
                    {{$petugas->jenis}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td> Alamat</td>
                <td>:</td>
                <td> {{$data->pegawai->alamat}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3"> Yang selanjutnya disebut sebagai <b>PIHAK KEDUA</b></td>
            </tr>
        </table>
        <br>
       <b>PIHAK PERTAMA</b> menyerahkan dan <b>PIHAK KEDUA</b> meneriama penyerahan Barang Milik Negara (BMN) Dengan
       spesifikasi sebagai berikut :
        <br><br>
        <table style="width: 100%" class="atas">
            <thead class="atas">
                <tr class="atas">
                    <th class="atas" style="width: 5%;"> NO</th>
                    <th class="atas"> NAMA BARANG</th>
                    <th class="atas"> KODE BARANG</th>
                    <th class="atas"> NUP</th>
                    <th class="atas"> LOKASI</th>
                    <th class="atas"> STATUS</th>
                </tr>
            </thead>
            <tbody class="atas">
                @php
                    $no = 1;
                @endphp
                @foreach ($detail as $item)
                    <tr class="atas">
                        <td class="atas" style="text-align: center; height: 40px;"> {{$no++}}</td>
                        <td id="isiatas"> {{$item->barang->nama_barang}} {{$item->barang->merk}}</td>                       
                        <td class="atas">&nbsp; {{$item->barang->kode_barang}}</td>
                        <td class="atas" style="text-align: center;"> {{$item->barang->no_seri}}</td>
                        <td class="atas">&nbsp; {{$item->barang->location->nama}}</td>
                        <td class="atas">&nbsp; {{$item->ket}}</td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <br>
        <b>PIHAK KEDUA</b> bertanggung jawab segala sesuatu atas barang barang tersebut. 
        Apabila terjadi kehilangan menjadi tanggung jawab petugas yang diserahkan barang. <br>
        Demikian Berita Acara ini dibuat dengan benar untuk dipergunakan sebagaimana mestinya.
    </div>
    <br><br>
    <div>
        <table style="width: 100%" class="ttd">
            <tr class="ttd">
                <td class="ttd" style="width: 50%">PIHAK PERTAMA</td>
                <td class="ttd" tyle="width: 50%">PIHAK KEDUA</td>
            </tr>
            <tr class="ttd">
                <td class="ttd">Yang Menyerahkan,</td>
                <td class="ttd">Yang Menerima,</td>
            </tr>
            <tr class="ttd">
                <td style="height: 50px" class="ttd"></td>
                <td class="ttd"></td>
            </tr>
            <tr class="ttd">
                <td class="ttd">{{$data->pegawai->name}}</td>
                <td class="ttd">
                    {{$petugas->user->name}}
                </td>
            </tr>
        </table>
        <br>
        <table style="width: 100%" class="ttd">
            <tr class="ttd">
                <td class="ttd">Mengetahui,</td>
            </tr>
            <tr class="ttd">
                <td class="ttd">KEPALA BAGIAN TATA USAHA</td>
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