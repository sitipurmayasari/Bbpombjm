@inject('injectQuery', 'App\InjectQuery')
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Format-Laporan-Stok-Kelompok-Barang.xls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="{{asset('assets/css/print.css')}}" rel="stylesheet"> --}}
</head>
    <title>Laporan Stok Barang {{$data->nama_barang}}</title>
    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 11;
        }
        table{
            width: 100%;
            font-size: 11;
        }

        table,tr,td, th{
            border: solid black 1px;
            vertical-align: top;
        }

        th{
            text-align: center;
            vertical-align: middle;
        }

        .ttd{
                border:none;
                border-collapse: collapse;
                text-align: center;
            }

    </style>
</head>
<body>
    <div class="col-sm-12 isi" style="text-align: center">
        <div class="col-sm-12" style="text-align: center;font-size: 18px;">
            <b>Laporan Fisik</b><br>
            <b><i>{{$data->nama}}</i></b>
        </div><br>
        <div class="col-sm-12 table-responsive row" style="text-align: left">
            @if ($request->gudang != null)
                Lokasi : {{$gudang->nama}}
            @endif
            <table style="font-size: 11px;" >
                <thead>
                    <tr>
                        <th style="text-align: center; vertical-align:middle;" width="20px">No</th>
                        <th style="text-align: center; vertical-align:middle;">Kode Barang</th>
                        <th style="text-align: center; vertical-align:middle;">Nama Barang</th>
                        <th style="text-align: center; vertical-align:middle;">Lokasi</th>
                        <th style="text-align: center; vertical-align:middle;">Sisa Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($stock as $item)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td>{{$item->kode_barang}}</td>
                            <td>{{$item->nama_barang}} {{$item->merk}} ({{$item->no_seri}})</td>
                            <td>{{$item->location->nama}}</td>
                            <td style="text-align: center">{{$item->stock }}  {{$item->satuan->satuan}}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div><br><br>
    </div>
    <br>
    <div id="ttd">
        <table class="ttd" style="width: 100%">
            <tr class="ttd">
                <td class="ttd col-md-6"></td>
                <td class="ttd col-md-6">Banjarmasin, Tanggal ..................</td>
            </tr>
            <tr class="ttd">
                <td class="ttd">Mengetahui,</td>
                <td class="ttd">Pengelola Gudang</td>
            </tr>
            <tr class="ttd">
                <td class="ttd">
                    @if ($mengetahui != null)
                        @if ($mengetahui->pjs != null)
                        {{$mengetahui->pjs}}
                        {{$mengetahui->jabatan->jabatan}} 
                        {{$mengetahui->divisi->nama}}
                        @else 
                        {{$mengetahui->jabatan->jabatan}} 
                        {{$mengetahui->divisi->nama}}
                        @endif
                  @else
                    SILAHKAN CEK SETUP PEJABAT
                  @endif
                </td>
                <td class="ttd"></td>
                <td class="ttd"></td>
            </tr>
            <tr class="ttd">
                <td style="height: 30%" class="ttd"><br><br><br><br></td>
                <td style="height: 30%" class="ttd"><br><br><br><br></td>
            </tr>
            <tr class="ttd">
                <td class="ttd"><u>
                    @if ($mengetahui !=null)
                        {{$mengetahui->user->name}}
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif
                </u>
                </td>
                <td class="ttd"><u>
                    {{$petugas->user->name}}
                    </u></td>
            </tr>
            <tr class="ttd">
                <td class="ttd">
                    @if ($mengetahui !=null)
                        NIP.  {{$mengetahui->user->no_pegawai}}
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif
                    
                </td>
                <td class="ttd">NIP. 
                    {{$petugas->user->no_pegawai}}
                </td>
            </tr>
        </table>

</body>
</html>