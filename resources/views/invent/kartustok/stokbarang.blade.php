@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Stok Barang {{$data->nama_barang}}</title>
</head>
<style>
    @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 11;
            page-break-after: always;
        }

    table{
        width: 100%;
    }

    .isi{
        border:1px solid black;
        border-collapse: collapse;
    }

</style>
<body>
    <header>
        <div id="kop">
            <table>
                <tr>
                    <td>
                        <img src="{{asset('images/bbpom.jpg')}}" style="height:100px">
                    </td>
                    <td style="text-align: center; font-weight:bold;">
                        BADAN POM REPUBLIK INDONESIA <br>
                        BALAI BESAR PENGAWAS OBAT DAN MAKANAN <br>
                        DI BANJARMASIN <br>
                        KARTU STOCK
                    </td>
                    <td></td>
                </tr>
            </table>
            <hr>
            <table>
                <tr>
                    <td style="width: 25%">KODE BARANG</td>
                    <td style="width: 1%">:</td>
                    <td>{{$data->kode_barang}}</td>
                </tr>
                <tr>
                    <td>NAMA BARANG</td>
                    <td>:</td>
                    <td>{{$data->nama_barang}}</td>
                </tr>
                <tr>
                    <td>NO. KATALOG / MERK</td>
                    <td>:</td>
                    <td>{{$data->no_seri}} / {{$data->merk}}</td>
                </tr>
                <tr>
                    <td>LOKASI</td>
                    <td>:</td>
                    <td>{{$data->location->nama}}</td>
                </tr>
            </table>
        </div>
    </header>
    <main>
        <table class="isi">
            <thead class="isi">
                <tr class="isi">
                    <th class="isi" style="width=20px;" >No</th>
                    <th class="isi">Tanggal</th>      
                    <th class="isi">Masuk</th>
                    <th class="isi">Keluar</th>
                    <th class="isi">Sisa</th>
                    <th class="isi">Keterangan</th>
                </tr>
            </thead>
            <tbody class="isi">
                @php
                    $no = 1;
                @endphp
                @foreach ($stock as $item)
                    <tr class="isi">
                        <td class="isi" style="text-align: center">{{$no}}</td>
                        <td class="isi">{{tgl_indo($item->entry_date)}}</td>
                        <td class="isi" style="text-align: center">
                            @if ($item->stockawal != null)
                                {{$item->stockawal}} {{$item->barang->satuan->satuan}}
                            @endif                               
                        </td>
                        <td class="isi" style="text-align: center">
                            @if ($item->keluar != null)
                                {{$item->keluar}}  {{$item->barang->satuan->satuan}}
                            @endif 
                        </td>
                        <td class="isi" style="text-align: center">{{$item->stock}}  {{$item->barang->satuan->satuan}}</td>
                        <td class="isi">
                            @if ($item->keterangan != null)
                                {{$item->keterangan}}
                            @endif
                            @if ($item->barang->kind == 'L' && $item->exp_date != null)
                                Exp. Date : {{$item->exp_date}}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @php
                        $no++
                    @endphp
                @endforeach 
            </tbody>
        </table>
    </main>
</body>
</html>