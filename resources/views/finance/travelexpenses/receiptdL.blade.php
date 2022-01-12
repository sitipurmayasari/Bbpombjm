@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>

    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 8;
            font-style: italic;
            margin-top: 30px;
            margin-bottom: 15px;
            line-height: 1;

        }

        /* table, tr, td, th {
            padding-top: 3px;
            padding-bottom: 3px;
        } */

        .kepala {
            text-align: left;
            font-style: italic;
            font-size: 8;
            border-collapse: collapse;
            border: none;
            line-height: 1;

        }
        .isi{
            font-size: 8;
            font-family: 'Times New Roman';
            border: 1px solid black;
            vertical-align : top;
            line-height: 1;

        }

      
        #border{
            border: 1px solid;
            text-align: center;
            margin-left: 120px;
            margin-right: 120px;
            font-size: 12;
            padding-top: 0;
            padding-bottom: 0; 
        }

        th{
            text-align: center;
            letter-spacing: 2px;
        }
        p{
            font-size: 10; 
            text-align:center;
            line-height: 1;
        }


        </style>

</head>
@php
    $no=1;
@endphp
@foreach ($pegawai as $item)
    
<body>

    <table style="width: 100%; padding" class="kepala">
        <tr>
            <td style="vertical-align: bottom; text-align: center;"  colspan="2">
                <img src="{{asset('images/BBRI.jpg')}}" style="height:50px">
            </td>
            <td colspan="2" style=" font-size: 6;">
                Lampiran VI (4 dari 4) <br>
                Peraturan Menteri Keuangan tentang Perjalanan Dinas <br>
                Dalam Negeri bagi Pejabat Negara Pegawai Negeri Sipil <br>
                Dan Pegawai Tidak Tetap <br>
                Nomor 113/PMK.05/2012 &nbsp;&nbsp;&nbsp; Tgl. 23 Juli 2012
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;  font-size: 10; font-style: normal;">BALAI BESAR PENGAWAS OBAT DAN MAKANAN</td>
            <td style="width: 18%">Akun</td>
            <td style="width: 25%">: {{$item->out->pok->sub->komponen->code}} / {{$item->out->pok->akun->code}} )</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;  font-size: 10;" > Di Banjarmasin</td>
            <td>Bukti Kas</td>
            <td>: ............................</td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="border">
                    KWITANSI
                </div>
            </td>
            <td>Tahun Anggaran</td>
            <td>: {{$item->out->pok->pok->year}}</td>
        </tr>
        <tr>
            <td style="width: 20%" >Sudah Terima dari</td>
            <td colspan="3">: Pejabat Pembuat komitmen Balai Besar Pengawas Obat dan Makanan di Banjarmasin</td>
        </tr>
        <tr>
            <td>Uang Sebesar</td>
            <td colspan="3">: <b>Rp.  &nbsp;&nbsp;&nbsp; 
                @php
                        $nilai = $injectQuery->getDetail($item->id)
                @endphp
                 @if ($nilai->bbm != '0')
                    @php
                        $bbm = $nilai->bbm;
                    @endphp
                    {{number_format($bbm)}}
                @else
                    {{'-'}} 
                @endif
                
            </b></td>
        </tr>
        <tr>
            <td>Untuk Pembayaran</td>
            <td colspan="3">: <b>{{$data->st->purpose}}</b></td>
        </tr>
   </table>
   <br>
   <table style="width: 100%; padding" class="kepala">
        <tr>
            <td style="width: 20%">Berdasarkan Surat Tugas </td>
            <td colspan="2">: {{$item->out->number}}</td>
            <td colspan="2">Tanggal : {{tgl_indo($item->out->st_date)}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 30%">: di Kota
                @if (count($item->out->outst_destiny) == 1)
                     @foreach ($tujuan as $key=>$kota)
                         @if ($loop->first)
                             {{$kota->destiny->capital}} 
                         @endif
                         
                     @endforeach

                 @elseif (count($item->out->outst_destiny) == 2)
                     @foreach ($tujuan as $key=>$kota)
                         {{$kota->destiny->capital}}
                         @if ($tujuan->count()-1 != $key)
                             {{' dan '}}
                         @endif
                     @endforeach

                 @else
                     @foreach ($tujuan as $key=>$kota)
                         @if ($loop->last-1)
                             {{$kota->destiny->capital}}{{','}} 
                         @endif
                         @if ($loop->last)
                             {{' dan '}} {{$kota->destiny->capital}}
                         @endif
                         
                     @endforeach
                 @endif
        </tr>
        <tr>
            <td>Terbilang</td>
            <td style="text-transform: capitalize;">: <b>
                {{terbilang($bbm)}} Rupiah    
            </b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;" > Yang Menerima : <br><br><br></td>
            <td></td>
            <td style="width: 18%">
                Program/Kegiatan <br>
                KRO/RO/Komponen <br>
                Sub Komponen/Akun 
            </td>
            <td style="width: 25%">
                : {{$item->out->pok->pok->act->prog->unit->klcode->code}}.{{$item->out->pok->pok->act->prog->unit->code}}.
                    {{$item->out->pok->pok->act->prog->code}} / {{$item->out->pok->pok->act->code}}<br>
                : {{$item->out->pok->sub->komponen->det->unit->code}} / {{$item->out->pok->sub->komponen->det->code}} / 
                    {{$item->out->pok->sub->komponen->code}} <br>
                : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;" > 
                <u>{{$item->pegawai->name}}</u> <br>
                @if ($item->pegawai->status=="PNS")
                    NIP. {{$item->pegawai->no_pegawai}}
                @endif
            <td></td>
            <td >Petugas <br><br><br></td>
            <td>: {{$no}} <br><br><br></td>
        </tr>
   </table>
   <hr style="border:1px solid black;">
   <table style="width: 100%; text-align:center;" class="kepala">
        <tr>
            <td style="width:38%"></td>
            <td style="width: 31%">
                Lunas dibayar
            </td>
            <td style="width: 31%"></td>
        </tr>
        <tr>
            <td></td>
            <td>Pada tanggal ..................................</td>
            <td>Setuju dibayar</td>
        </tr>
        <tr>
            <td></td>
            <td>Bendahara Pengeluaran, <br><br><br><br><br></td>
            <td>{{$item->out->ppk->jabatan}} <br><br><br><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td style="line-height: 1.3;">
                <u>{{$petugas->user->name}}</u> <br>
                NIP. {{$petugas->user->no_pegawai}}
            </td>
            <td style="line-height: 1.3;">
                <u>{{$item->out->ppk->user->name}}</u> <br>
                NIP. {{$item->out->ppk->user->no_pegawai}}
            </td>
        </tr>
   </table> <br><br><br>
   <hr style="border:1px solid black;">
   <br><br><br>
   
{{-- bagian kedua --}}
<table style="width: 100%; padding" class="kepala">
    <tr>
        <td style="vertical-align: bottom; text-align: center;"  colspan="2">
            <img src="{{asset('images/BBRI.jpg')}}" style="height:50px">
        </td>
        <td colspan="2" style=" font-size: 6;">
            Lampiran VI (4 dari 4) <br>
            Peraturan Menteri Keuangan tentang Perjalanan Dinas <br>
            Dalam Negeri bagi Pejabat Negara Pegawai Negeri Sipil <br>
            Dan Pegawai Tidak Tetap <br>
            Nomor 113/PMK.05/2012 &nbsp;&nbsp;&nbsp; Tgl. 23 Juli 2012
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;  font-size: 10; font-style: normal;">BALAI BESAR PENGAWAS OBAT DAN MAKANAN</td>
        <td style="width: 18%">Akun</td>
        <td style="width: 25%">: {{$item->out->pok->sub->komponen->code}} / {{$item->out->pok->akun->code}} )</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;  font-size: 10;" > Di Banjarmasin</td>
        <td>Bukti Kas</td>
        <td>: ............................</td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="border">
                KWITANSI
            </div>
        </td>
        <td>Tahun Anggaran</td>
        <td>: {{$item->out->pok->pok->year}}</td>
    </tr>
    <tr>
        <td style="width: 20%" >Sudah Terima dari</td>
        <td colspan="3">: Pejabat Pembuat komitmen Balai Besar Pengawas Obat dan Makanan di Banjarmasin</td>
    </tr>
    <tr>
        <td>Uang Sebesar</td>
        <td colspan="3">: <b>Rp.  &nbsp;&nbsp;&nbsp; 
            @php
                $nilai = $injectQuery->getDetail($item->id)
            @endphp
            @if ($nilai->bbm != '0')
                @php
                    $bbm = $nilai->bbm;
                @endphp
                {{number_format($bbm)}}
            @else
                {{'-'}} 
            @endif
            
        </b></td>
    </tr>
    <tr>
        <td>Untuk Pembayaran</td>
        <td colspan="3">: <b>{{$data->st->purpose}}</b></td>
    </tr>
</table>
<br>
<table style="width: 100%; padding" class="kepala">
    <tr>
        <td style="width: 20%">Berdasarkan Surat Tugas </td>
        <td colspan="2">: {{$item->out->number}}</td>
        <td colspan="2">Tanggal : {{tgl_indo($item->out->st_date)}}</td>
    </tr>
    <tr>
        <td></td>
        <td style="width: 30%">: di Kota
            @if (count($item->out->outst_destiny) == 1)
                 @foreach ($tujuan as $key=>$kota)
                     @if ($loop->first)
                         {{$kota->destiny->capital}} 
                     @endif
                     
                 @endforeach

             @elseif (count($item->out->outst_destiny) == 2)
                 @foreach ($tujuan as $key=>$kota)
                     {{$kota->destiny->capital}}
                     @if ($tujuan->count()-1 != $key)
                         {{' dan '}}
                     @endif
                 @endforeach

             @else
                 @foreach ($tujuan as $key=>$kota)
                     @if ($loop->last-1)
                         {{$kota->destiny->capital}}{{','}} 
                     @endif
                     @if ($loop->last)
                         {{' dan '}} {{$kota->destiny->capital}}
                     @endif
                     
                 @endforeach
             @endif
    </tr>
    <tr>
        <td>Terbilang</td>
        <td style="text-transform: capitalize;">: <b>
            {{terbilang($bbm)}} Rupiah
        </b></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;" > Yang Menerima : <br><br><br></td>
        <td></td>
        <td style="width: 18%">
            Program/Kegiatan <br>
            KRO/RO/Komponen <br>
            Sub Komponen/Akun 
        </td>
        <td style="width: 25%">
            : {{$item->out->pok->pok->act->prog->unit->klcode->code}}.{{$item->out->pok->pok->act->prog->unit->code}}.
                {{$item->out->pok->pok->act->prog->code}} / {{$item->out->pok->pok->act->code}}<br>
            : {{$item->out->pok->sub->komponen->det->unit->code}} / {{$item->out->pok->sub->komponen->det->code}} / 
                {{$item->out->pok->sub->komponen->code}} <br>
            : {{$item->out->pok->sub->code}} / {{$item->out->pok->akun->code}} <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;" >
            <u>{{$item->pegawai->name}}</u> <br>
                @if ($item->pegawai->status=="PNS")
                    NIP. {{$item->pegawai->no_pegawai}}
                @endif
        <td></td>
        <td >Petugas <br><br><br></td>
        <td>: {{$no}} <br><br><br></td>
    </tr>
</table>
<hr style="border:1px solid black;">
<table style="width: 100%; text-align:center;" class="kepala">
    <tr>
        <td style="width:38%"></td>
        <td style="width: 31%">
            Lunas dibayar
        </td>
        <td style="width: 31%"></td>
    </tr>
    <tr>
        <td></td>
        <td>Pada tanggal ..................................</td>
        <td>Setuju dibayar</td>
    </tr>
    <tr>
        <td></td>
        <td>Bendahara Pengeluaran, <br><br><br><br><br></td>
        <td>{{$item->out->ppk->jabatan}} <br><br><br><br><br></td>
    </tr>
    <tr>
        <td></td>
        <td style="line-height: 1.3;">
            <u>{{$petugas->user->name}}</u> <br>
            NIP. {{$petugas->user->no_pegawai}}
        </td>
        <td style="line-height: 1.3;">
            <u>{{$item->out->ppk->user->name}}</u> <br>
            NIP. {{$item->out->ppk->user->no_pegawai}}
        </td>
    </tr>
</table>
</body>
@php
    $no++;
@endphp
@endforeach

</html>