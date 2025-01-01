<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>SPPD Depan</title>
</head>
<style>
    @page {
        size:8.5in 13in;
        /* size: 8.5in 14in ; */
        /* size: legal; */
        margin-top: 30px;
        margin-bottom: 10px;
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
        line-height: 1;
        
    }

    .tabbor{
        padding: 10px 5px 10px 5px; /* top right bottom left */
        border: 0.5px solid black;
        border-collapse: collapse;
        line-height: 0.8;
    }
    

    .tabno{
        padding-top: 10px;
        border: 0.5px solid black;
        border-collapse: collapse;
    }

    .eng{
        font-size: 7;
    }
        

</style>
@php
    $no=1;
@endphp

@foreach ($isian as $item)
<body>
    <table>
        <tr>
            <td style="width: 45%;text-align:center; vertical-align:bottom;" >
                <img src="{{asset('images/bbpom.jpg')}}" style="height:80px"> <br>
               <b>BALAI BESAR PENGAWAS OBAT DAN MAKANAN<br>
                DI BANJARMASIN <br>
                </b>
                Jl. Bina Praja Utara, Banjarbaru 70371<br>
            </td>
            <td style="padding-left: 80px; font-size: 7;">
               <p>
                PERATURAN DIREKTORAT JENDRAL PERBENDAHARAAN NOMOR PER 22/PB/2013 TENTANG KETENTUAN LEBIH LANJUT PELAKSANAAN PERJALANAN DINAS LUAR NEGERI BAGI PEJABAT NEGARA, PEGAWAI NEGERI, DAN PEGAWAI TIDAK TETAP. 
               </p>
                <table>
                    <tr>
                        <td><i><u>Lembar Ke</u><br>
                                Sheet No
                            </i>
                        </td>
                        <td>: 
                            <i class="eng">{{$no++}}</i>
                        </td>
                    </tr>
                    <tr>
                        <td><i><u>Kode No</u><br>
                            Code No
                            </i>
                        </td>
                        <td>:
                            <i>
                                <?php
                                    $kode = substr($item->no_sppd,5);
                                    echo $kode;
                                ?>
                            </i>
                        </td>
                    </tr>
                    <tr>
                        <td><i><u>Nomor</u><br>
                            Number
                            </i>
                        </td>
                        <td>:
                            <i>
                                <?php
                                    $kode = substr($item->no_sppd,0,4);
                                    echo $kode;
                                ?>
                            </i>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"style="text-align:center; padding-top:30px;">
                <b style="font-size: 12;"><u>SURAT PERJALANAN DINAS</u><br></b>
                <b style="font-size: 11;"><i>LETTER OF OFFICIAL TRAVEL</i></b>
            </td>
        </tr>
    </table>
    <br>
    <table class="tabbor">
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">1.</td>
            <td class="tabbor" colspan="2">
                <u>Pejabat Pembuat Komitmen</u> <br>
                <i class="eng">Authorizing Officer</i>
            </td>
            <td colspan="2" class="tabbor">
                @if ($data->ppk_id != 0)
                    {{$data->ppk->user->name}}
                @else
                    &nbsp;
                @endif 
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">2.</td>
            <td class="tabbor" colspan="2">
                <u>Nama/NIP Pegawai yang melaksanakan perjalanan dinas</u><br>
                <i class="eng">Name/Employee Register Number of the assigned officer</i>
            </td>
            <td colspan="2" class="tabbor">
                {{$item->pegawai->name}} /
                @if ($item->pegawai->golongan_id != null)
                   {{$item->pegawai->no_pegawai}}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">3.</td>
            <td class="tabbor" colspan="2">
                a. <u>Pangkat dan Golongan</u><br>
                &nbsp; &nbsp; <i class="eng">Official rank</i><br>
                b. <u>Jabatan</u> <br>
                &nbsp; &nbsp; <i class="eng">Position/Institution</i><br>
                c. <u> Tingkat Biaya Perjalanan Dinas</u> <br>
                &nbsp; &nbsp; <i class="eng">Level of official Travel Expense</i><br>
                
            </td>
            <td colspan="2" class="tabbor">
                @if ($item->pegawai->golongan_id != null)
                    {{$item->pegawai->gol->jenis}} / {{$item->pegawai->gol->golongan}} {{$item->pegawai->gol->ruang}}
                @else
                    {{' - '}}
                @endif    
                <br><br>
                @if ($item->pegawai->jabasn_id != null)
                    {{$item->pegawai->jabasn->nama}}
                @else
                    {{$item->pegawai->deskjob}} 
                @endif  
                <br><br>
                B
            </td>
        </tr>
        <tr>
            <td style="text-align: center;" class="tabno">4.</td>
            <td class="tabbor" colspan="2">
                <u>Maksud Perjalanan Dinas</u><br>
                <i class="eng">Purpose of Travel</i>
            </td>
            <td colspan="2" class="tabbor">
                {{$data->purpose}} 
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">5.</td>
            <td class="tabbor" colspan="2">
                <u>Alat Angkutan yang Dipergunakan</u><br>
                <i class="eng">Mode of transportation</i>
            </td>
            <td colspan="2" class="tabbor">
               {{$data->transport}} <br>
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">6.</td>
            <td class="tabbor" colspan="2">
                a. <u>Tempat Berangkat</u> <br>
                &nbsp; &nbsp; <i class="eng">Point of Departure</i> <br>
                b. <u>Tempat Tujuan</u> <br>
                &nbsp; &nbsp; <i class="eng">Point of Destionation</i> <br>
            </td>
            <td colspan="2" class="tabbor">
                {{$data->cityfrom->capital}} 
                <br><br>
                @if (count($data->outst_destiny) == 1)
                     @foreach ($data->outst_destiny as $key=>$item)
                         @if ($loop->first)
                             {{$item->destiny->capital}} 
                         @endif
                         
                     @endforeach

                 @elseif (count($data->outst_destiny) == 2)
                     @foreach ($data->outst_destiny as $key=>$item)
                         {{$item->destiny->capital}}
                         @if ($data->outst_destiny->count()-1 != $key)
                             {{' dan '}}
                         @endif
                     @endforeach

                 @else
                     @foreach ($data->outst_destiny as $key=>$item)
                         @if ($loop->last-1)
                             {{$item->destiny->capital}}{{','}} 
                         @endif
                         @if ($loop->last)
                             {{' dan '}} {{$item->destiny->capital}}
                         @endif
                         
                     @endforeach
                 @endif
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">7.</td>
            <td class="tabbor" colspan="2">
                a. <u>Lamanya Perjalanan Dinas</u> <br>
                    &nbsp; &nbsp; <i class="eng">Duration of Official Travel</i><br>
                b. <u>Tanggal Berangkat</u> <br>
                    &nbsp; &nbsp; <i class="eng">Date of Departure</i><br>
                c. <u>Tanggal harus kembali</u> <br>
                    &nbsp; &nbsp; <i class="eng">End of assignment Date</i>
            </td>
            <td colspan="2" class="tabbor">
                <u>{{$lama->hitung}} ({{terbilang($lama->hitung)}}) Hari  </u> <br>
                <i class="eng">{{$lama->hitung}}
                    <?php
                        function numToWords($number) {
                            $units = array('', 'one', 'two', 'three', 'four',
                                        'five', 'six', 'seven', 'eight', 'nine');

                            $tens = array('', 'ten', 'twenty', 'thirty', 'forty',
                                        'fifty', 'sixty', 'seventy', 'eighty', 
                                        'ninety');

                            $special = array('eleven', 'twelve', 'thirteen',
                                            'fourteen', 'fifteen', 'sixteen',
                                            'seventeen', 'eighteen', 'nineteen');

                            $words = '';
                            if ($number < 10) {
                                $words .= $units[$number];
                            } elseif ($number < 20) {
                                $words .= $special[$number - 11];
                            } else {
                                $words .= $tens[(int)($number / 10)] . ' '
                                        . $units[$number % 10];
                            }

                            return $words;
                        }

                        // Example usage:
                        $number = $lama->hitung;
                        echo "(".numToWords($number).") Days";

                    ?>
                </i>
                <br>
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->first)
                             <u>{{tgl_indo($item->go_date)}}</u> <br>
                             <i class="eng">
                                @php
                                    $timestamp = strtotime($item->go_date);
                                    $new_format = date('d F Y', $timestamp);
                                    echo $new_format;
                                @endphp
                            </i>
                        @endif
                    @endforeach
                <br>
                    @foreach ($data->outst_destiny as $key=>$item)
                        @if ($loop->last)
                            <u>{{tgl_indo($item->return_date)}}</u> <br>
                            <i class="eng">
                                @php
                                    $timestamp = strtotime($item->return_date);
                                    $new_format = date('d F Y', $timestamp);
                                    echo $new_format;
                                @endphp
                            </i> <br>
                        @endif
                    @endforeach
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;width: 3%" class="tabno" rowspan="2">8.</td>
            <td class="tabbor"style="vertical-align:top; width:12%;border-right: none;">
                <u>Pengikut:</u> <br>
                <i class="eng">Companion</i>
            </td>
            <td class="tabbor" style="text-align: center;border-left: none;width:25%;">
                <u>Nama</u><br>
                <i class="eng">Name</i>
            </td>
            <td class="tabbor" style="text-align: center;">
                <u>Tanggal Lahir</u> <br>
                <i class="eng">Date of Birth</i>
            </td>
            <td class="tabbor" style="text-align: center;">
                <u>Keterangan</u><br>
                <i class="eng">Note</i>
            </td>
        </tr>
        <tr class="tabbor">
            <td class="tabbor" colspan="2" style="vertical-align:top;">
                1. <br>
                2. <br>
                3. <br>
                4. <br>
                5.
            </td>
            <td class="tabbor" style="text-align: center;"></td>
            <td class="tabbor" style="text-align: center;"></td>
        </tr>
        <tr class="tabbor" style="border-bottom: none; padding-bottom:0;">
            <td style="text-align: center;" rowspan="2" class="tabno">9.</td>
            <td class="tabbor" colspan="2" style="border-bottom: none;  padding-bottom:0;">
                <u>Pembebanan anggaran</u> <br>
                <i class="eng">Budget Allocation</i> <br>
                a. <u>Instansi</u><br>
                &nbsp; &nbsp; <i class="eng">Institution</i>
            </td>
            <td class="tabbor" colspan="2" colspan="2" style="border-bottom: none;  padding-bottom:0;">
                <br><br>
                @if ($data->budget_id == 3)
                    {{$data->budget->name}}
                @else
                    {{$data->budget->name}} Tahun Anggaran {{$data->budget->tahun}}
                    @if ($data->budget->nomor != null && $data->budget->tanggal == null)
                    ,
                        Nomor {{$data->budget->nomor}} 
                    @elseif ($data->budget->tanggal != null && $data->budget->nomor == null)
                        ,
                        tanggal {{tgl_indo($data->budget->tanggal)}}
                    @elseif ($data->budget->tanggal != null && $data->budget->nomor != null)
                        ,
                        No. {{$data->budget->nomor}}
                    @else
                        Non Anggaran
                    @endif
                @endif
            </td>
        </tr>
        <tr class="tabbor" style="border-top: none; padding-top:0;">
            <td class="tabbor" colspan="2" style="border-top: none; padding-top:0;">
                b. <u>Akun</u> <br>
                &nbsp; &nbsp; <i class="eng">Code of Account</i>
            </td>
            <td class="tabbor" colspan="2" style="border-top: none; padding-top:0;">
                @if ($data->activitycode_id != null)
                    {{$data->act->lengkap}}/{{$data->sub->kodeall}}/{{$data->akun->code}}
                @else
                    @if ($data->pok_detail_id == 0)
                        &nbsp;
                    @elseif ($data->pok_detail_id == 1)
                        {{' - '}}
                    @else
                        {{$data->pok->pok->act->prog->unit->klcode->code}}.{{$data->pok->pok->act->prog->unit->code}}.
                        {{$data->pok->pok->act->prog->code}}.{{$data->pok->pok->act->code}}.
                        {{$data->pok->sub->komponen->det->unit->code}}.{{$data->pok->sub->komponen->det->code}}.
                        {{$data->pok->sub->komponen->code}}.{{$data->pok->sub->code}}.{{$data->pok->akun->code}}

                    @endif
                @endif
                
            </td>
        </tr>
        <tr class="tabbor">
            <td style="text-align: center;" class="tabno">10.</td>
            <td class="tabbor" colspan="2">
                <u>Keterangan lain - lain</u><br>
                <i class="eng">Additional Note</i>
            </td>
            <td class="tabbor" colspan="2" colspan="2">
              SPD Tanggal 
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->first)
                        {{tgl_indo($item->go_date)}}
                    @endif
                @endforeach s/d 
                @foreach ($data->outst_destiny as $key=>$item)
                    @if ($loop->last)
                        {{tgl_indo($item->return_date)}}
                    @endif
                @endforeach
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style="width: 55%"></td>
            <td>
                <table>
                    <tr>
                        <td style="line-height: 0.8;">
                            <u>Dikeluarkan di</u><br>
                            <i class="eng">Place of Issuance</i>
                        </td>
                        <td>: 
                            @if ($data->external !="Y")
                                {{$data->cityfrom->capital}}
                            @else
                                @foreach ($data->outst_destiny as $key=>$item)
                                    @if ($loop->first)
                                        {{$item->destiny->capital}} 
                                    @endif
                                @endforeach
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <td style="line-height: 0.8;">
                            <u>Pada tanggal</u><br>
                            <i class="eng">Date of Issuance</i>
                        </td>
                        <td>: 
                            @php
                                $timestamp = strtotime($data->st_date);
                                $new_format = date('d F Y', $timestamp);
                                echo $new_format;
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="line-height: 0.8;">
                            <br>
                               <b><u> Pejabat Pembuat Komitmen</u></b><br>
                               <i class="eng">Authorizing Officer</i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                                <br><br><br>
                                @if ($data->ppk_id != 0)
                                   <u> {{$data->ppk->user->name}}</u>
                                @else
                                    &nbsp;
                                @endif <br>
                                @if ($data->ppk_id != 0)
                                NIP.    {{$data->ppk->user->no_pegawai}}
                                @else
                                <br>
                                    ----------------------------------
                                @endif 
                            
                        </td>
                    </tr>
                </table>
                <br>
            </td>
        </tr>
    </table>
</body>
@endforeach
</html>