@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        @page {
            size: A4;
            font-family: Arial;
            font-size: 14px;
        }

        table,tr,td,th {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 11px;
        }

        td {
            vertical-align: top;
            text-align: justify;
        }

        th, td {
            padding-left: 5px;
        }

        th{
            text-align: center;
            font-weight: bold;
            
        }

        #head{
           align-content: center;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            }
    </style>
</head>
<body>
    <div id="head" class="col-xs-12">
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width:100%">
    </div>
    <div>
        <table class="table table-striped col-xs-12">
            <tr>
                <td colspan="3" style="text-align: center; background-color: #291670; font-size: 16px; color:white;">
                    <b>Detail Inventaris</b>
                </td>
            </tr>
            <tr>
                <td class="col-xs-2">Kode Barang</td>
                
                <td class="col-xs-7">{{$data->kode_barang}}</td>
                <td>Foto Barang :</td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                
                <td>{{$data->nama_barang}}</td>
                <td rowspan="8" style="text-align: center"><img src="{{$data->getFoto()}}"  style="width:100px"></td>
            </tr>
            <tr>
                <td>Nama Lain / Sinonim</td>
                
                <td>{{$data->sinonim}}</td>
            </tr>
            <tr>
                <td>No. Katalog</td>
                
                <td>{{$data->no_seri}}</td>
            </tr>
            <tr>
                <td>Merk / Type</td>
                
                <td>{{$data->merk}}</td>
            </tr>
            <tr>
                <td>Jenis Barang</td>
                
                <td>{{$data->jenis->nama}}</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                
                <td>{{$data->location->nama}}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                
                <td>{{$data->spesifikasi}}</td>
            </tr>
            <tr>
                <td>Sisa Stok</td>
                
                <td>
                    @php
                            $total = $injectQuery->laststock($data->id)
                        @endphp
                        @if ($total != null)
                            {{$total->stock}}
                        @else
                            {{0}}
                        @endif
                        {{$data->satuan->satuan}}
                </td>
            </tr>
            
        </table>
    </div>
</html>