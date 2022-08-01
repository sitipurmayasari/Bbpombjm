@inject('injectQuery', 'App\InjectQuery')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Kartu stok {{$data->nama_barang}}</title>
    <style>
         @page {
            size: A4;
            font-family: Arial;
            font-size: 12px;
        }

        table,tr,td,th {
                border: 1px solid black;
                border-collapse: collapse;
                font-size: 12px;
            }

        header{
            margin-top: -60px;
        }

    </style>
</head>


<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div class="col-sm-12" style="text-align: center;font-size: 18px;">
                <b>Kartu Stok Laboratorium Obat dan Nappza</b><br>
            </div><br>
            <div class="col-sm-12" style="text-align: left">
                <table style="border: none;">
                    <tr style="border: none;">
                        <td style="border: none;">Kode Barang</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">{{$data->kode_barang}}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Nama Barang</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">{{$data->nama_barang}}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">No. Katalog</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">{{$data->no_seri}}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Satuan</td>
                        <td style="border: none;">:</td>
                        <td style="border: none;">{{$data->satuan->satuan}}</td>
                    </tr>
                </table>
            </div><br>
            <div class="col-sm-12;" id="lala">
                <table style=" width: 100%" class="table table-striped" >
                   <thead>
                        <tr>
                                <th style="text-align: center; vertical-align:middle;" width="20px">No</th>
                                <th style="text-align: center; vertical-align:middle;">Tanggal</th>      
                                <th style="text-align: center; vertical-align:middle;">Masuk</th>
                                <th style="text-align: center; vertical-align:middle;">Keluar</th>
                                <th style="text-align: center; vertical-align:middle;">Sisa</th>
                                <th style="text-align: center; vertical-align:middle;">Keterangan</th>
                        </tr>
                   </thead>
                   <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($stock as $item)
                        <tr>
                        <td style="text-align: center">{{$no}}</td>
                        <td>{{tgl_indo($item->entry_date)}}</td>
                        <td style="text-align: center">{{$item->stockawal}} {{$item->barang->satuan->satuan}}</td>
                        <td style="text-align: center">{{$item->keluar}}  {{$item->barang->satuan->satuan}}</td>
                        <td style="text-align: center">{{$item->stock}}  {{$item->barang->satuan->satuan}}</td>
                        <td>{{$item->keterangan}}</td>
                        </tr>
                        @php
                            $no++
                        @endphp
                    @endforeach 
                   </tbody>
                    
                </table>
            </div><br><br>
        </div>
    </main>
</body>
</html>