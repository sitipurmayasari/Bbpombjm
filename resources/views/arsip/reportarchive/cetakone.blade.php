{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
    <title>Document</title>
</head> --}}

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Daftar-Arsip-Aktif-Tahunan.xls");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Arsip Aktif Tahun {{$request->tahun}}</title>
 
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
            <b>DAFTAR ARSIP AKTIF TAHUN {{$request->tahun}}</b>
        </div>
        <br>
        <div style="text-align: left">
            <table class="atas">
                <tr class="atas">
                    <td class="atas">Pencipta Arsip</td>
                    <td class="atas">:</td>
                    <td class="atas"> Balai Besar POM di Banjarmasin</td>
                </tr>
                <tr class="atas">
                    <td class="atas">Unit Kerja / Unit Pengolah</td>
                    <td class="atas">:</td>
                    <td class="atas"> {{$div->nama}}</td>
                </tr>
                <tr class="atas">
                    <td class="atas">Nama Pemimpin unit kerja / unit pengolah</td>
                    <td class="atas">:</td>
                    <td class="atas"></td>
                </tr>
                <tr class="atas">
                    <td class="atas">Jabatan Pimpinan Unit Kerja / Unit Pengolah</td>
                    <td class="atas">:</td>
                    <td class="atas"></td>
                </tr>
                <tr class="atas">
                    <td class="atas">Alamat Unit Kerja/ Unit Pengolah</td>
                    <td class="atas">:</td>
                    <td class="atas"> Jl. Brigjend. H. Hasan Basri No. 40 - Banjarmasin</td>
                </tr>    
            </table>
        </div>
     </div>
     <br><br>
     <div class="table-responsive isi">
        <table  style="font-size: 11px;" >
            <thead style="font-size: 12px;">
                <tr>
                    <th colspan="4">Daftar Berkas</th>
                    <th colspan="11">Daftar ISi Berkas</th>
                </tr>
                <tr>
                    <th width="10px" rowspan="2">No Berkas</th>
                    <th rowspan="2">Kode Klasifikasi</th>
                    <th rowspan="2">Uraian Berkas</th>
                    <th rowspan="2">Tahun</th>
                    <th rowspan="2">Nomor Item</th>
                    <th rowspan="2">Uraian Isi Informasi</th>
                    <th rowspan="2">Jumlah</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Tingkat Perkembangan</th>
                    <th rowspan="2">Lokasi</th>
                    <th colspan="4">Jenis Arsip</th>
                    <th rowspan="2">keterangan</th>
                </tr>
                <tr>
                    <th>Biasa</th>
                    <th>Terbatas</th>
                    <th>Rahasia</th>
                    <th>Sangat Rahasia</th>
                </tr>
               
            </thead>
            <tbody>
                @php $no=1;  @endphp
                @foreach($data as $key=>$row)
                    <tr>
                        <td></td>
                        <td>{{$row->klas->alias}}</td>
                        <td>{{$row->klas->names}}</td>
                        <td>{{$request->tahun}}</td>
                        <td style="text-align: center">{{$no}}</td>
                        <td>{{$row->uraian}}</td>
                        <td style="text-align: center">{{$row->jumlah}}</td>
                        <td>{{tgl_indo($row->date)}}</td>
                        <td>{{$row->tingkat}}</td>
                        <td>{{$row->lokasi}}</td>
                        <td style="text-align: center">
                            @if ($row->klas->securitiesklas == 'B')
                                v
                            @endif
                        </td>
                        <td style="text-align: center">
                            @if ($row->klas->securitiesklas == 'T')
                                v
                            @endif
                        </td>
                        <td style="text-align: center">
                            @if ($row->klas->securitiesklas == 'R')
                                v
                            @endif
                        </td>
                        <td style="text-align: center">
                            @if ($row->klas->securitiesklas == 'S')
                                v
                            @endif
                        </td>
                        <td></td>
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