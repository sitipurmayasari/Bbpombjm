<<<<<<< HEAD
=======
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-StokOpname-PersediaanNapza-$jenis->nama.xls");
?>
@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Stok Opname Persediaan Lab Obat dan Nappza</title>
 
    <style>
        @page {
                size: landscape;
                font-family: 'Times New Roman';
                font-size: 11px;      
        }
         
        .atas{
            border: none;
        }

        table, th, td, tr{
            border: 1px solid black;
            border-collapse: collapse;
        }
    
        th{
            text-align: center;
            vertical-align: middle;
        }
        td{
            vertical-align: top;
        }
    
       
        
    </style>
</head>
<body>
    <div class="col-sm-12 isi" style="text-align: center">
        <div style="align=center font-size: 18px">
            <b>LAPORAN STOK OPNAME PERSEDIAAAN ALAT GELAS {{strtoupper($jenis->nama)}}</b> <br>
            <b>LABORATORIUM OBAT DAN NAPPZA</b>
        </div>
     <br><br>
     <div>
        Tanggal Stok Opname : {{$data->dates}}
     </div>
     <div class="table-responsive isi">
        <table  style="font-size: 11px;" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>KODE BARANG</th>
                    <th>NAMA ALAT</th>
                    <th>NAMA LAIN / SINONIM</th>
                    <th>NO. KATALOG</th>
                    <th>STOK KARTU</th>
                    <th>STOK FISIK</th>
                    <th>SELISIH</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($detail as $item)
                    <tr>
                        <td style="text-align: center">{{$no}}</td>
                        <td>{{$item->barang->kode_barang}}</td>
                        <td>{{$item->barang->nama_barang}}</td>
                        <td>{{$item->barang->sinonim}}</td>
                        <td>{{$item->barang->no_seri}}</td>
                        <td style="text-align: center">{{$item->stok_kartu}}</td>
                        <td style="text-align: center">{{$item->stok_fisik}}</td>
                        <td style="text-align: center">{{$item->selisih}}</td>
                        <td>{{$item->keterangan}}</td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
        
</body>
</html>
>>>>>>> ee4ea469b37aaecb372dbb64bfd922284df3bfbd
