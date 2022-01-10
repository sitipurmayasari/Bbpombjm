<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DALAM KOTA</title>
    <style>
         @page {
            size: A4 landscape;
            font-family: Arial;
            -moz-transform:rotate(-90deg) scale(.58,.58);
            -moz-transform:rotate(-90deg) scale(.58,.58);

        }
          #kepala {
            font-size: 6;
            font-style: italic; font-weight: normal;
            border-collapse: collapse;
            border: none;
            line-height: 1;
            float: right;
          }  
          
          .detail{
            font-family: "Bookman Old Style";
            border: 1px solid black;
            font-size: 11;
            text-align: left;
            vertical-align: top;
            border-collapse: collapse;
            line-height: 2;
        }

        th{
            text-align: center;
            font-weight: bold;
            border: 1px solid black;
        }
        

        
    </style>
</head>
@foreach ($destinys as $item)
<body>
    <div id="kepala">
        <table >
            <tr>
                <td style="width: 11%">Program/kegiatan</td>
                <td style="width: 18%">:
                    @if ($data->pok_detail_id == 0)
                        {{' Non Anggaran '}}
                    @else
                        {{$data->pok->pok->act->prog->unit->klcode->code}}.{{$data->pok->pok->act->prog->unit->code}}.
                        {{$data->pok->pok->act->prog->code}} / {{$data->pok->pok->act->code}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>KRO/RO/komponen</td>
                <td>:
                    @if ($data->pok_detail_id == 0)
                        {{' Non Anggaran '}}
                    @else
                        {{$data->pok->sub->komponen->det->unit->code}} / {{$data->pok->sub->komponen->det->code}} / {{$data->pok->sub->komponen->code}}
                    @endif
                </td>
               
            </tr>
            <tr>
                <td>Sub Komponen/Akun</td>
                <td>:
                    @if ($data->pok_detail_id == 0)
                        {{' Non Anggaran '}}
                    @else
                        {{$data->pok->sub->code}} / {{$data->pok->akun->code}}
                    @endif
                    
                </td>
            </tr>
            <tr>
                <td>No. Surat Tugas</td>
                <td>:
                    {{$data->number}}
                </td>
                
            </tr>
        </table>
    </div>
       <br>
       <br>
       <br>
       <h5 style="text-align: center">BUKTI KEHADIRAN PELAKSANAAN PERJALANAN DINAS JABATAN DALAM KOTA LEBIH DARI 8 (DELAPAN) JAM</h5>
       <table style="width:100%" class="detail">
            <thead>
                <tr>
                    <th rowspan=2>NO</th>
                    <th rowspan=2>PELAKSANAAN SPD</th>
                    <th rowspan=2>HARI</th>
                    <th rowspan=2>TANGGAL</th>
                    <th colspan="3">PEJABAT/PETUGAS YANG MENGESAHKAN</th>
                </tr>
                <tr>
                    <th>NAMA</th>
                    <th>JABATAN</th>
                    <th>TANDA TANGAN</th>
                </tr>
                <tr>
                    <th style="font-style: italic; font-weight: normal;">(1)</th>
                    <th style="font-style: italic; font-weight: normal;">(2)</th>
                    <th style="font-style: italic; font-weight: normal;">(3)</th>
                    <th style="font-style: italic; font-weight: normal;">(4)</th>
                    <th style="font-style: italic; font-weight: normal;">(5)</th>
                    <th style="font-style: italic; font-weight: normal;">(6)</th>
                    <th style="font-style: italic; font-weight: normal;">(7)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="detail" style="text-align: center; height">
                        @php
                            $no= 1;
                        @endphp
                        @foreach ($isian as $key=>$row)
                            {{$no++}} <br>
                        @endforeach
                    </td>
                    <td class="detail">
                        @foreach ($isian as $key=>$row)
                            {{$row->pegawai->name}} <br>
                        @endforeach
                    </td>
                    <td class="detail" style="text-align:center;">
                        @php
                        $a = strtotime($item->go_date);
                        $c = date('D', $a);

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

                        echo $days; 
                    @endphp
                    </td class="detail">
                    <td class="detail" style="height:60%; text-align:center;" >{{tgl_indo($item->go_date)}}
                    </td>
                    <td class="detail"></td>
                    <td class="detail"></td>
                    <td class="detail"></td>
                </tr>
            </tbody>
       </table>
</body>
@endforeach
</html>