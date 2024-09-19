<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Daftar Penggunaan Alat Lab Per Laboratorium</title>

    <style>
         @page {
            size: A4 landscape;
            font-family: 'Times New Roman';
            font-size: 11;
        }

        table{
            width: 100%;
            margin-left: 10px;
        }
        .garis{
            border: solid 1px black;
            border-collapse: collapse;  
            padding: 5px; 
        }
        th{
            text-align: center;
            font-weight: bold;
            color: aliceblue;
            background: gray;
        }
        td{
            vertical-align: top;
        }
    </style>

</head>
<body>
    <h3 style="text-align: center;">Daftar Penggunaan Alat Lab</h3>
    <br>
    <table>
        <tr>
            <td style="width: 8%">Asal Lab</td>
            <td>:
                {{$lab->name}}
            </td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:
                @if ($request->bulan!="1")
                    @php
                        $bln = $request->daftarbulan;

                            if ($bln==1) {
                            $blnindo = "Januari";
                            } else  if ($bln==2){
                                $blnindo = "Februari";
                            } else  if ($bln==3){
                                $blnindo = "Maret";
                            } else  if ($bln==4){
                                $blnindo = "April";
                            } else  if ($bln==5){
                                $blnindo = "Mei";
                            } else  if ($bln==6){
                                $blnindo = "Juni";
                            } else  if ($bln==7){
                                $blnindo = "Juli";
                            } else  if ($bln==8){
                                $blnindo = "Agustus";
                            } else  if ($bln==9){
                                $blnindo = "September";
                            } else  if ($bln==10){
                                $blnindo = "Oktober";
                            } else  if ($bln==11){
                                $blnindo = "November";
                            } else {
                                $blnindo = "Desember";
                            }
                    @endphp
                    {{$blnindo}}
                @endif 
                
                {{$request->daftartahun}}
            </td>
        </tr>
    </table>
    <br>
    <table class="garis">
        <thead>
            <th class="garis">NO</th>
            <th class="garis">NAMA PEGAWAI</th>
            <th class="garis">NAMA ALAT</th>
            <th class="garis">TANGGAL</th>
            <th class="garis">WAKTU</th>
            <th class="garis">NAMA KEGIATAN</th>
            <th class="garis">KETERANGAN</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $item)
            <tr class="garis">
                <td class="garis" style="text-align: center;">{{$no}}</td>
                <td class="garis">{{$item->user->name}} <br> {{$item->user->no_pegawai}}</td>}
                <td class="garis">{{$item->barang->nama_barang}}</td>
                <td class="garis">{{tgl_indo($item->dates)}}</td>
                <td class="garis" style="text-align: center;">{{$item->time_start}} <br> s/d <br>
                    {{$item->time_end}}
                </td>
                <td class="garis">{{$item->activity}}</td>
                <td class="garis">{{$item->description}}</td>
            </tr>
            @php
                $no++;
            @endphp
            @endforeach
        </tbody>
    </table>
</body>
</html>