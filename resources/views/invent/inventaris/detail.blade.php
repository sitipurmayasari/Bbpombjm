<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            text-align: justify;
        }
    </style>
</head>
<body>
   <header>
        <h1>Detail Inventaris</h1>
   </header>
   <main>
       <table>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td style="width: 40%">{{$data->kode_barang}}</td>
                <td rowspan="9"> <img src="{{$data->getFoto()}}"  style="height:250px;width:250px"></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td>{{$data->nama_barang}}</td>
            </tr>
            <tr>
                <td>Merk / Type</td>
                <td>:</td>
                <td>{{$data->merk}}</td>
            </tr>
            <tr>
                <td>Jenis Barang</td>
                <td>:</td>
                <td>{{$data->jenis->nama}}</td>
            </tr>
            <tr>
                <td>Spesifikasi</td>
                <td>:</td>
                <td>{{$data->spesifikasi}}</td>
            </tr>
            <tr>
                <td>User Manual</td>
                <td>:</td>
                <td><a href="{{$data->getFIleUserManual()}}" target="_blank" >{{$data->file_user_manual}}</a></td>
            </tr>
            <tr>
                <td>Troubleshouting</td>
                <td>:</td>
                <td><a href="{{$data->getFIleTrouble()}}" target="_blank" >{{$data->file_trouble}}</a></td>
            </tr>
            <tr>
                <td>IKA</td>
                <td>:</td>
                <td><a href="{{$data->getFIleIka()}}" target="_blank" >{{$data->file_ika}}</a></td>
            </tr>
       </table>
   </main>
</body>
</html>