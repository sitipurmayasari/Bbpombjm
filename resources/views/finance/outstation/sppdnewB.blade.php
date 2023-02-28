<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Surat Tugas</title>
</head>
<style>
    @page {
        size: 22cm 36cm ;
        /* size: legal; */
        margin-top: 30px;
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
<body>
    @php
    $no=1;
@endphp
@foreach ($isian as $item)
    <table>
        <tr>
            <td style="border-right: none;border-bottom: none; width:3%"></td>
            <td style="border-left: none;border-right:none;border-bottom: none; width:20%">
            </td>
            <td style="border-left: none;border-bottom: none; width:27%"></td>
            <td style="border-right: none;border-bottom: none; width: 20%;">
                Berangkat dari<br>
                (Tempat Kedudukan) <br>
                Ke<br>
                Pada Tanggal
            </td>
            <td style="border-left: none;border-bottom: none;">
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
        <tr>
            <td colspan="3" style="border-top: none;"></td>
            <td colspan="2"  style="border-top: none; text-align:center;">
                Pejabat Pembuat Komitmen <br><br><br><br><br><br>
                <u><b> 
                    @if ($data->ppk_id != 0)
                        {{$data->ppk->user->name}}
                    @endif
                </b></u><br>
                NIP.
                    @if ($data->ppk_id != 0)
                        {{$data->ppk->user->no_pegawai}}
                    @endif
            </td>
        </tr>
        <tr>
            <td style="border-right: none;">II.</td> 
            <td style="border-left: none;border-right:none;">
                Tiba di<br> 
                Pada Tanggal
            </td>
            <td style="border-left: none;">
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
            <td style="border-right: none;">
                Berangkat dari<br>
                Ke<br> 
                Pada Tanggal <br>
                <br><br><br><br><br><br><br><br>
            </td>
            <td style="border-left: none;">
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
        <tr>
            <td style="border-right: none;">III.</td>
            <td style="border-left: none;border-right:none;">
                Tiba di<br>
                Pada Tanggal
            </td>
            <td style="border-left: none;">
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
            <td style="border-right: none;">
                Berangkat dari<br>
                Ke<br>
                Pada Tanggal <br>
                <br><br><br><br><br><br><br><br>
            </td>
            <td style="border-left: none;">
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
            <td style="border-right: none;">IV.</td>
            <td style="border-left: none;border-right:none;">
                Tiba di<br>
                Pada Tanggal
            </td>
            <td style="border-left: none;">
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
            <td style="border-right: none;">
                Berangkat dari<br>
                Ke<br>
                Pada Tanggal <br>
                <br><br><br><br><br><br><br><br>
            </td>
            <td style="border-left: none;">
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
        <tr>
            <td style="border-right: none;border-bottom: none;">V.</td>
            <td style="border-left: none;border-right:none;border-bottom: none;">
                Tiba di<br>
                Pada Tanggal
            </td>
            <td style="border-left: none;border-bottom: none;">
                : {{$data->cityfrom->capital}} <br>
                : 
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->last)
                        {{tgl_indo($item->return_date)}} 
                    @endif
                @endforeach
            </td>
            <td style="border-bottom: none;" colspan="2">
                Telah diperiksa dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata - mata untuk kepentingan jabatan dalam waktu
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border-top: none; text-align:center;">
                Pejabat Pembuat Komitmen <br><br><br><br><br><br>
                <u><b> 
                    @if ($data->ppk_id != 0)
                        {{$data->ppk->user->name}}
                    @endif
                </b></u><br>
                NIP.
                    @if ($data->ppk_id != 0)
                        {{$data->ppk->user->no_pegawai}}
                    @endif
            </td>
            <td colspan="2"  style="border-top: none; text-align:center;">
                Pejabat Pembuat Komitmen <br><br><br><br><br><br>
                <u><b> 
                    @if ($data->ppk_id != 0)
                        {{$data->ppk->user->name}}
                    @endif
                </b></u><br>
                NIP.
                    @if ($data->ppk_id != 0)
                        {{$data->ppk->user->no_pegawai}}
                    @endif
            </td>
        </tr>
        <tr>
            <td style="border-right: none;">VI.</td>
            <td colspan="2" style="border-left: none;">Catatan Lain - Lain</td>
            <td colspan="2"><br><br></td>
        </tr>
        <tr>
            <td colspan="5">VII. &nbsp;PERHATIAN : <br>
                Pejabat Pembuat Komitmen yang menerbitkan SPD, Pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan Keuangan Negara apabila negara menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
            </td>
        </tr>
    </table>
@endforeach
</body>
</html>