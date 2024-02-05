<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>SPPD Belakang</title>
</head>
<style>
    @page {
        size:8.5in 13in;
        /* size: legal; */
        margin: 10px 15px 10px 15px;
        font-size: 9;
    }

    @font-face {
        font-family: "Bookman Old Style";
        /* src: url('{{asset('assets/font/Bookman-old-style.ttf')}}') format('truetype'); */
        src: url('{{ storage_path('fonts\Bookman-old-style.ttf') }}') format("truetype");
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
    }

    b{
        font-family: "Bookman Old Style";
    }
    
    html, table{
        font-family: "Bookman Old Style";
    }
    table{
            width: 100%;
    }
    table, td, tr {
        font-family: "Bookman Old Style"; 
        text-align: justify;
        vertical-align: top;
        font-weight: normal;
        font-style: normal;;
        border-collapse: collapse;
        vertical-align: top;
        line-height: normal;
        border: 0.5px solid black;
        padding: 10px 5px 10px 5px; 
    }
        

</style>
@php
$no=1;
@endphp
@foreach ($isian as $item)
<body>
    <table>
        <tr style="border-bottom: none;">
            <td style="border-bottom: none; border-right: 0;  width:3%;"></td>
            <td style="border-bottom: none; border-left: 0; border-right:0;  width:20%;"></td>
            <td style=" border-bottom: none; border-left: 0;  width:27%;"></td>
            <td style=" border-bottom: none; border-right: 0;  width: 20%;">
                Berangkat dari<br>
                (Tempat Kedudukan) <br>
                Ke<br>
                Pada Tanggal
            </td>
            <td style="border-left: 0; border-bottom: none;">
                : {{$data->cityfrom->capital}} <br><br>
                : 
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        {{$item->destiny->capital}} 
                    @endif
                @endforeach 
                <br>
                :
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        {{tgl_indo($item->go_date)}} 
                    @endif
                @endforeach
            </td>
        </tr>
        <tr style="border-top: none;">
            <td colspan="3" style="border-top: 0;"></td>
            <td colspan="2"  style="border-top: 0; text-align:center;">
                @if ($data->external =="N")
                    Kepala Bagian Tata Usaha <br><br><br><br><br>
                    {{-- <u><b>{{$menyetujui->user->name}} 
                    </b></u><br>
                    NIP.{{$menyetujui->user->no_pegawai}} --}}
                @else
                    <br><br><br><br><br>&nbsp;
                @endif
            </td>
        </tr>
        <tr style=" border-bottom: none;"> 
            <td style="border-right: 0; width:3%;  border-bottom: none;" >II.</td> 
            <td style="border-left: 0; border-right:0; width:20%;  border-bottom: none;">
                Tiba di<br> 
                Pada Tanggal <br><br>
            </td>
            <td style="border-left: 0; width:27%;  border-bottom: none;" >
                : {{-- tujuan pertama --}} 
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        {{$item->destiny->capital}} 
                    @endif
                @endforeach
                <br>
                :
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        {{tgl_indo($item->go_date)}} 
                    @endif
                @endforeach
            </td>
            <td style="border-right: 0;  width: 20%;  border-bottom: none;">
                Berangkat dari<br>
                Ke<br> 
                Pada Tanggal <br>
            </td>
            <td style="border-left: 0;  border-bottom: none;">
                :  {{--tujuan pertama--}}
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        {{$item->destiny->capital}} 
                    @endif
                @endforeach
                <br>
                : 
                @if (count($data->outst_destiny) == 1) {{--kota asal--}}
                    {{$data->cityfrom->capital}}
                @elseif (count($data->outst_destiny) == 2) {{--tujuan kedua--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{$item->destiny->capital}}
                        @endif
                    @endforeach
                @elseif (count($data->outst_destiny) == 3) {{--tujuan kedua--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->index == 1)
                            {{$item->destiny->capital}} 
                        @endif
                    @endforeach
                @endif
                <br>
                : {{--tgl pulang tujuan pertama--}}
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        {{tgl_indo($item->return_date)}} 
                    @endif
                @endforeach
            </td>
        </tr>
        <tr style="border-top: none;">
            <td colspan="3" style="border-top: 0; text-align:center;" >
                @if ($data->external =="Y")
                    Kepala Bagian Tata Usaha <br><br><br><br>
                    {{-- <u><b>{{$menyetujui->user->name}} 
                    </b></u><br>
                    NIP.{{$menyetujui->user->no_pegawai}} --}}
                @else
                    @if ($data->nama_petugas != null)
                        {{$data->jab_petugas}} <br><br><br><br>
                        <u><b>{{$data->nama_petugas}} 
                        </b></u><br>
                        @if ($data->nip_petugas != null)
                            NIP.{{$menyetujui->user->no_pegawai}}
                        @endif
                    @else
                        <br><br><br><br><br>
                    @endif
                @endif
            </td>
            <td colspan="2"  style="border-top: 0; text-align:center;">
                @if ($data->external =="Y")
                    Kepala Bagian Tata Usaha <br><br><br><br>
                    {{-- <u><b>{{$menyetujui->user->name}} 
                    </b></u><br>
                    NIP.{{$menyetujui->user->no_pegawai}} --}}
                @else
                    @if ($data->nama_petugas != null)
                        {{$data->jab_petugas}} <br><br><br><br>
                        <u><b>{{$data->nama_petugas}} 
                        </b></u><br>
                        @if ($data->nip_petugas != null)
                            NIP.{{$menyetujui->user->no_pegawai}}
                        @endif
                    @else
                        <br><br><br><br><br>
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td style="border-right: 0;">III.</td>
            <td style="border-left: 0;border-right:0;">
                Tiba di<br>
                Pada Tanggal
            </td>
            <td style="border-left: 0;">
                :
                @if (count($data->outst_destiny) == 2) {{--tujuan kedua--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{$item->destiny->capital}}
                        @endif
                    @endforeach
                @elseif (count($data->outst_destiny) == 3) {{--tujuan kedua--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->index == 1)
                            {{$item->destiny->capital}} 
                        @endif
                    @endforeach
                @endif
                <br>
                :
                @if (count($data->outst_destiny) == 2) {{--tujuan kedua--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{tgl_indo($item->go_date)}}
                        @endif
                    @endforeach
                @elseif (count($data->outst_destiny) == 3) {{--tujuan kedua--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->index == 1)
                            {{tgl_indo($item->go_date)}}
                        @endif
                    @endforeach
                @endif
            </td>
            <td style="border-right: 0;">
                Berangkat dari<br>
                Ke<br>
                Pada Tanggal <br>
                <br><br><br><br><br><br>
            </td>
            <td style="border-left: 0;">
                : 
                @if (count($data->outst_destiny) == 2) {{--kota asal--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{$item->destiny->capital}}
                        @endif
                    @endforeach
                @elseif (count($data->outst_destiny) == 3) {{--tujuan ketiga--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->index == 1)
                            {{$item->destiny->capital}} 
                        @endif
                    @endforeach
                @endif
                <br>
                : 
                @if (count($data->outst_destiny) == 2) {{--kota asal--}}
                    {{$data->cityfrom->capital}}
                @elseif (count($data->outst_destiny) == 3) {{--tujuan ketiga--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{$item->destiny->capital}} 
                        @endif
                    @endforeach
                @endif
               
                <br>
                :
                @if (count($data->outst_destiny) == 2) {{--tujuan kedua--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{tgl_indo($item->return_date)}}
                        @endif
                    @endforeach
                @elseif (count($data->outst_destiny) == 3) {{--tujuan kedua--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->index == 1)
                            {{tgl_indo($item->return_date)}}
                        @endif
                    @endforeach
                @endif
             
            </td>
        </tr>
        <tr>
            <td style="border-right: 0;">IV.</td>
            <td style="border-left: 0;border-right:0;">
                Tiba di<br>
                Pada Tanggal
            </td>
            <td style="border-left: 0;">
                : 
                @if(count($data->outst_destiny) == 3) {{--tujuan ketiga--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{$item->destiny->capital}} 
                        @endif
                    @endforeach
                @endif
                <br>
                :
                @if(count($data->outst_destiny) == 3) {{--tujuan ketiga--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{tgl_indo($item->go_date)}} 
                        @endif
                    @endforeach
                @endif
              
            </td>
            <td style="border-right: 0;">
                Berangkat dari<br>
                Ke<br>
                Pada Tanggal <br>
                <br><br><br><br><br>
            </td>
            <td style="border-left: 0;">
                : 
                @if(count($data->outst_destiny) == 3) {{--tujuan ketiga--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{$item->destiny->capital}} 
                        @endif
                    @endforeach
                @endif
                <br>
                :
                @if(count($data->outst_destiny) == 3) {{--kota asal--}}
                    {{$data->cityfrom->capital}}
                @endif
                <br>
                :
                @if(count($data->outst_destiny) == 3) {{--tujuan ketiga--}}
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            {{tgl_indo($item->return_date)}} 
                        @endif
                    @endforeach
                @endif
            </td>
        </tr>
        <tr style="border-bottom: none;">
            <td style="border-right: 0;border-bottom: none;">V.</td>
            <td style="border-left: 0;border-right:0;border-bottom: none;">
                Tiba di<br>
                Pada Tanggal
            </td>
            <td style="border-left: 0;border-bottom: none;">
                : {{$data->cityfrom->capital}} <br>
                : 
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->last)
                        {{tgl_indo($item->return_date)}} 
                    @endif
                @endforeach
            </td>
            <td style="border-bottom: none;" colspan="2">
                Telah diperiksa dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata - mata untuk kepentingan jabatan dalam waktu yang sesingkat - singkatnya.
            </td>
        </tr>
        <tr style="border-top: none;">
            <td colspan="3" style="border-top: 0; text-align:center;">
                @if ($data->pok_detail_id == 0 )
                    <br><br><br><br><br><br><br>
                @elseif($data->pok_detail_id == 1 )
                    <br><br><br><br><br><br><br>
                @else
                    @if ($data->external !="Y")
                        Pejabat Pembuat Komitmen<br><br><br><br><br>
                        <u><b> 
                            @if ($data->ppk_id != 0)
                                {{$data->ppk->user->name}}
                            @endif
                        </b></u><br>
                            @if ($data->ppk_id != 0)
                                NIP. {{$data->ppk->user->no_pegawai}}
                            @endif
                    @else
                        <br><br><br><br>&nbsp;
                    @endif
                @endif
            </td>
            <td colspan="2"  style="border-top: 0; text-align:center;">
                @if ($data->pok_detail_id == 0 )
                    <br><br><br><br><br>
                @elseif($data->pok_detail_id == 1 )
                    <br><br><br><br><br>
                @else
                    Pejabat Pembuat Komitmen <br><br><br><br>
                    <u><b> 
                        @if ($data->ppk_id != 0)
                            {{$data->ppk->user->name}}
                        @endif
                    </b></u><br>
                        @if ($data->ppk_id != 0)
                        NIP. {{$data->ppk->user->no_pegawai}}
                        @endif
                @endif
            </td>
        </tr>
        <tr>
            <td style="border-right: 0;">VI.</td>
            <td colspan="2" style="border-left: 0;">Catatan Lain - Lain</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="5">VII. &nbsp;PERHATIAN : <br>
                Pejabat Pembuat Komitmen yang menerbitkan SPD, Pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan Keuangan Negara apabila negara menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
            </td>
        </tr>
    </table>
</body>
@endforeach
</html>