<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
    <title>Daftar Informasi Arsip Aktif</title>
</head>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Daftar-Informasi-Arsip-Aktif-tahunan.xls");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Informasi Arsip Aktif Tahun {{$request->tahun}}</title>
 
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
            <b>DAFTAR INFORMASI ARSIP AKTIF TAHUN {{$request->tahun}}</b>
        </div>
        <br>
        <div style="text-align: left">
            <table class="atas">
                <tr class="atas">
                    <td class="atas" colspan="4">Pencipta Arsip</td>
                    <td class="atas" style="text-align: center">:</td>
                    <td class="atas" colspan="3"> Balai Besar POM di Banjarmasin</td>
                </tr>
                <tr class="atas">
                    <td class="atas" colspan="4">Unit Kerja / Unit Pengolah</td>
                    <td class="atas" style="text-align: center">:</td>
                    <td class="atas" colspan="3"> 
                       <b>
                        @if ($request->divisi != null)
                            {{$div->nama}}
                        @else
                            Semua Unit
                        @endif
                        </b>
                    </td>
                </tr>
                <tr class="atas">
                    <td class="atas" colspan="4">Nama Pemimpin unit kerja / unit pengolah</td>
                    <td class="atas" style="text-align: center">:</td>
                    <td class="atas" colspan="3"></td>
                </tr>
                <tr class="atas">
                    <td class="atas" colspan="4">Jabatan Pimpinan Unit Kerja / Unit Pengolah</td>
                    <td class="atas" style="text-align: center">:</td>
                    <td class="atas" colspan="3"></td>
                </tr>
                <tr class="atas">
                    <td class="atas" colspan="4">Alamat Unit Kerja/ Unit Pengolah</td>
                    <td class="atas" style="text-align: center">:</td>
                    <td class="atas" colspan="3"> Jl. Brigjend. H. Hasan Basri No. 40 - Banjarmasin</td>
                </tr>    
            </table>
        </div>
     </div>
     <br><br>
     <div class="table-responsive isi">
        <table  style="font-size: 11px;" >
            <thead style="font-size: 12px;">
                <tr>
                    <th rowspan="2" width="10px" >No</th>
                    <th rowspan="2">No Berkas</th>
                    <th rowspan="2">No item</th>
                    <th rowspan="2">Kode Klasifikasi</th>
                    <th rowspan="2">Bentuk Naskah</th>
                    <th rowspan="2">Uraian Isi Informasi</th>
                    <th rowspan="2">Tingkat Perkembangan</th>
                    <th rowspan="2">Tanggal</th>
                    <th colspan="3">keterangan</th>
                </tr>
                <tr>
                    <th>Klasifikasi keamanan</th>
                    <th>Internal</th>
                    <th>Eksternal</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1;  @endphp
                @foreach($data as $key=>$row)
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center">{{$no}}</td>
                        <td>{{$row->klas->alias}}</td>
                        <td>{{$row->naskah->bentuk}}</td>
                        <td>{{$row->uraian}}</td>
                        <td>{{$row->tingkat}}</td>
                        <td>{{tgl_indo($row->date)}}</td>
                        <td>
                            @if ($row->klas->securitiesklas == 'B')
                                Biasa/Terbuka 
                            @elseif($row->klas->securitiesklas == 'T')
                                Terbatas
                            @elseif($row->klas->securitiesklas == 'R')
                                Rahasia
                            @else
                                Sangat Rahasia
                            @endif
                        </td>
                        <td>{{$row->klas->internal}}</td>
                        <td>{{$row->klas->eksternal}}</td>
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