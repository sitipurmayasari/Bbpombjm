@inject('InjectNew', 'App\InjectNew')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Nominatif Perjalanan Dinas</title>

    <style>
        @page {
            size:8.5in 13in landscape;
            margin-left: 150px;
            font-family: 'Times New Roman';
        }

        table,tr,td, th{
            border:1px solid black;
            font-size: 5;
        }
        table{
            width: 100%;
        }

        .atas{
            border: none;
            vertical-align: top;
        }

        th, thead{
            text-align: center;

        }

        .ttd{
            margin-left: 8%;
            margin-right: 8%;
        }

        .table2{
            border: none;
            border-collapse: collapse;
        }
    </style>

</head>
<body>
<div style="text-align:center" class="isi">
    <div style="align=center font-size:16px">
            <b>DAFTAR NOMINATIF PEJABAT / PEGAWAI YANG MELAKUKAN PERJALANAN DINAS</b>
    </div>
    
    <br>
    <table class="atas">
        <tr class="atas">
            <td  class="atas" style="width: 10%">Surat Tugas Nomor</td>
            <td  class="atas" style="width: 50%">: {{$data->st->number}}

            </td>
            <td  class="atas" style="width: 5%">MAK</td>
            <td  class="atas" style="width: 35%">:
                @if ($data->st->pok_detail_id == 0)
                    {{' Non Anggaran '}}
                @else
                    {{$data->st->pok->pok->act->prog->unit->klcode->code}}.{{$data->st->pok->pok->act->prog->unit->code}}.
                    {{$data->st->pok->pok->act->prog->code}}.{{$data->st->pok->pok->act->code}}.
                    {{$data->st->pok->sub->komponen->det->unit->code}}.{{$data->st->pok->sub->komponen->det->code}}.
                    {{$data->st->pok->sub->komponen->code}}.{{$data->st->pok->sub->code}}.{{$data->st->pok->akun->code}}

                @endif
            </td>
        </tr>
        <tr class="atas">
            <td  class="atas">Tanggal ST</td>
            <td  class="atas">:
                {{$data->st->st_date}}
            </td>
            <td  class="atas">Nama Kegiatan</td>
            <td  class="atas">:
                {{$data->st->purpose}}
            </td>
        </tr>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">NAMA / NIP</th>
                <th rowspan="2">TUJUAN</th>
                <th rowspan="2">TGL BERANGKAT
                    <br>& KEMBALI</th>
                <th colspan="4">UANG HARIAN</th>
                <th colspan="3">UANG REPRESENTATIF</th>
                <th colspan="4">BIAYA PENGINAPAN</th>
                <th colspan="4">BIAYA TRANSPORT (TIKET/TAKSI/TRANSLOK/BBM)</th>
                <th rowspan="2">TOTAL</th>
            </tr>
            <tr>
                <th>JENIS</th>
                <th>VOL</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
                <th>VOL</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
                <th>JENIS</th>
                <th>VOL</th>
                <th>SATUAN</th>
                <th>KLAIM</th>
                <th>JENIS</th>
                <th>VOL</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach ($harian as $item)
                @php
                    $total = $InjectNew->totalHarga($item->outst_employee_id);
                    $hotel = $InjectNew->BiayaInn($item->outst_employee_id);
                    $plane = $InjectNew->BiayaPesawat($item->outst_employee_id);
                    $trans = $InjectNew->BiayaTr($item->outst_employee_id);
                @endphp

                <tr>
                    <td style="text-align: center; vertical-align: top;">{{$no}}</td>
                    <td style="vertical-align: top;">
                        {{$item->peg->pegawai->name}} 
                        @if ($item->peg->pegawai->golongan_id != null)
                             / <br>{{$item->peg->pegawai->no_pegawai}}
                        @endif
                    </td>
                    <td style="vertical-align: top;">
                        @if (count($data->st->outst_destiny) == 1)
                            @foreach ($tujuan as $key=>$kota)
                                @if ($loop->first)
                                    {{$kota->destiny->capital}} 
                                @endif
                                
                            @endforeach
        
                        @elseif (count($data->st->outst_destiny) == 2)
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
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @if (count($data->st->outst_destiny) == 1)
                            @foreach ($tujuan as $key=>$kota)
                                @if ($loop->first)
                                    {{tgl_indo($kota->go_date)}} 
                                    <br> s/d <br>    
                                    {{tgl_indo($kota->return_date)}}
                                @endif
                                
                            @endforeach
                        @else
                            @foreach ($tujuan as $key=>$kota)
                                @if ($loop->first)
                                    {{tgl_indo($kota->go_date)}} 
                                    <br> s/d <br> 
                                @endif
                                @if ($loop->last)
                                    {{tgl_indo($kota->return_date)}}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td style="vertical-align: top;">
                        @if ($item->uhar1sum != 0)
                            @if (count($data->st->outst_destiny) == 1)
                                    - Uang Harian <br>

                            @elseif (count($data->st->outst_destiny) == 2)
                                    - Uang Harian <br>
                                    - Uang Harian <br>

                            @elseif (count($data->st->outst_destiny) == 3)
                                    - Uang Harian <br>
                                    - Uang Harian <br>
                                    - Uang Harian <br>
                            @endif 
                        @endif
                        @if ($item->tlokalsum != 0)
                            - UH DK > 8 Jam <br>
                        @endif
                        @if ($item->diklatsum != 0)
                            - Diklat <br>
                        @endif
                        @if ($item->fulldaysum != 0)
                            - Uang Saku  Half/Fullday <br>
                        @endif
                        @if ($item->fullboardsum != 0)
                            - Uang Saku Fullboard <br>
                        @endif
                    </td>
                    <td style="vertical-align: top;text_align:center" >
                        @if ($item->uhar1sum != 0)
                            @if (count($data->st->outst_destiny) == 1)
                                    {{$item->uhar1kali}} OH <br>

                            @elseif (count($data->st->outst_destiny) == 2)
                                    {{$item->uhar1kali}} OH <br>
                                    {{$item->uhar2kali}} OH <br>

                            @elseif (count($data->st->outst_destiny) == 3)
                                    {{$item->uhar1kali}} OH <br>
                                    {{$item->uhar2kali}} OH <br>
                                    {{$item->uhar2kali}} OH <br>
                            @endif 
                        @endif
                        @if ($item->tlokalsum != 0)
                            {{$item->tlokalkali}} OH <br>
                        @endif
                        @if ($item->diklatsum != 0)
                            {{$item->diklatkali}} OH<br>
                        @endif
                        @if ($item->fulldaysum != 0)
                            {{$item->fulldaykali}} OH <br>
                        @endif
                        @if ($item->fullboardsum != 0)
                            {{$item->fullboardkali}} OH <br>
                        @endif
                    </td>
                    <td style="vertical-align: top;text_align:center">
                       @if ($item->uhar1sum != 0)
                            @if (count($data->st->outst_destiny) == 1)
                                    {{number_format($item->uhar1cost)}}<br>

                            @elseif (count($data->st->outst_destiny) == 2)
                                    {{number_format($item->uhar1cost)}} <br>
                                    {{number_format($item->uhar2cost)}} <br>

                            @elseif (count($data->st->outst_destiny) == 3)
                                    {{number_format($item->uhar1cost)}} <br>
                                    {{number_format($item->uhar2cost)}} <br>
                                    {{number_format($item->uhar3cost)}} <br>
                            @endif 
                       @endif
                        @if ($item->tlokalsum != 0)
                            {{number_format($item->tlokalcost)}} <br>
                        @endif
                        @if ($item->diklatsum != 0)
                            {{number_format($item->diklatcost)}}<br>
                        @endif
                        @if ($item->fulldaysum != 0)
                            {{number_format($item->fulldaycost)}} <br>
                        @endif
                        @if ($item->fullboardsum != 0)
                            {{number_format($item->fullboardcost)}} <br>
                        @endif
                    </td>
                    <td style="vertical-align: top;text_align:center">
                        @if ($item->uhar1sum != 0)
                            @if (count($data->st->outst_destiny) == 1)
                                    {{number_format($item->uhar1sum)}}<br>

                            @elseif (count($data->st->outst_destiny) == 2)
                                    {{number_format($item->uhar1sum)}} <br>
                                    {{number_format($item->uhar2sum)}} <br>

                            @elseif (count($data->st->outst_destiny) == 3)
                                    {{number_format($item->uhar1sum)}} <br>
                                    {{number_format($item->uhar2sum)}} <br>
                                    {{number_format($item->uhar3sum)}} <br>
                            @endif 
                        @endif
                        @if ($item->tlokalsum != 0)
                            {{number_format($item->tlokalsum)}} <br>
                        @endif
                        @if ($item->diklatsum != 0)
                            {{number_format($item->diklatsum)}}<br>
                        @endif
                        @if ($item->fulldaysum != 0)
                            {{number_format($item->fulldaysum)}} <br>
                        @endif
                        @if ($item->fullboardsum != 0)
                            {{number_format($item->fullboardsum)}} <br>
                        @endif
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @if ($item->repssum != 0)
                            {{$item->repskali}} OH<br>
                        @endif
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @if ($item->repssum != 0)
                            {{number_format($item->repscost)}} <br>
                        @endif
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @if ($item->repssum != 0)
                            {{number_format($item->repssum)}} <br>
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align:left">
                        @foreach ($hotel as $itemhotel)
                            {{$itemhotel->hotelname}} <br>
                        @endforeach
                        @if ($item->halfsum != 0)
                            Paket halfday <br>
                        @endif
                        @if ($item->fullsum != 0)
                            Paket Fullday <br>
                        @endif
                        @if ($item->fbsum != 0)
                            Paket Fullboard <br>
                        @endif
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @foreach ($hotel as $itemhotel)
                            {{number_format($itemhotel->hotellong)}} OH<br>
                        @endforeach
                        @if ($item->halfsum != 0)
                            {{number_format($item->halflong)}} OH<br>
                        @endif
                        @if ($item->fullsum != 0)
                            {{number_format($item->fulllong)}} OH<br>
                        @endif
                        @if ($item->fbsum != 0)
                            {{number_format($item->fblong)}} OH<br>
                        @endif
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @foreach ($hotel as $itemhotel)
                            @php
                                $harga = $itemhotel->hotelfee;
                                $orang = $itemhotel->person;
                                $biaya = $harga / $orang;
                            @endphp

                            {{number_format($biaya)}}<br>
                        @endforeach
                        @if ($item->halfsum != 0)
                            {{number_format($item->halfcost)}}<br>
                        @endif
                        @if ($item->fullsum != 0)
                            {{number_format($item->fullcost)}}<br>
                        @endif
                        @if ($item->fbsum != 0)
                            {{number_format($item->fbcost)}}<br>
                        @endif
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @foreach ($hotel as $itemhotel)
                            {{number_format($itemhotel->hotelsum)}}<br>
                        @endforeach
                        @if ($item->halfsum != 0)
                            {{number_format($item->halfsum)}} <br>
                        @endif
                        @if ($item->fullsum != 0)
                            {{number_format($item->fullsum)}} <br>
                        @endif
                        @if ($item->fbsum != 0)
                            {{number_format($item->fbsum)}} <br>
                        @endif
                    </td>
                    <td style="vertical-align: top;">
                        @foreach ($trans as $itemtrans)
                            {{$itemtrans->taxitype}}<br>
                        @endforeach

                        @foreach ($plane as $itemplane)
                            {{$itemplane->planetype}}<br>
                        @endforeach
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @foreach ($trans as $itemtrans)
                            {{$itemtrans->taxicount}} OK<br>
                        @endforeach

                        @foreach ($plane as $itemplane)
                           1 OK<br>
                        @endforeach
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @foreach ($trans as $itemtrans)
                            {{number_format($itemtrans->taxifee)}}<br>
                        @endforeach

                        @foreach ($plane as $itemplane)
                            {{number_format($itemplane->ticketfee)}}<br>
                        @endforeach
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        @foreach ($trans as $itemtrans)
                            {{number_format($itemtrans->taxisum)}}<br>
                        @endforeach
                        @foreach ($plane as $itemplane)
                            {{number_format($itemplane->ticketfee)}}<br>
                        @endforeach
                    </td>
                    <td style="vertical-align: top; text_align:center">
                        {{number_format($total)}}
                    </td>
                </tr>
                @php  $no++; @endphp
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="ttd">
        <table class="table2">
            <tr class="table2">
                <td class="table2" style="width: 70%"></td>
                <td class="table2">Banjarmasin, {{tgl_indo($data->st->st_date)}}</td>
            </tr>
            <tr class="table2">
                <td class="table2">
                    {{-- @if ($data->st->ppk_id != 0)
                        {{$data->st->ppk->jabatan}}
                    @else
                        Pejabat Pembuat Komitmen
                    @endif --}}
                    Pejabat Pembuat Komitmen
                     <br><br><br><br><br></td>
                <td class="table2">
                    @if ($data->st->teamleader_id != null)
                        {{$data->st->teamleader->detail}}
                    @else
                        {{-- @if ($menyetujui->pjs != null)
                            {{$menyetujui->pjs}}
                            {{$menyetujui->jabatan->jabatan}} {{$menyetujui->divisi->nama}},
                        @else --}}
                            {{$menyetujui->jabatan->jabatan}} {{$menyetujui->divisi->nama}} ,
                        {{-- @endif --}}
                    @endif

                    
                    <br><br><br><br><br>
                </td>
            </tr>
            <tr class="table2">
                <td class="table2">
                    @if ($data->st->ppk_id != 0)
                        <u>{{$data->st->ppk->user->name}}</u> <br>
                        NIP. {{$data->st->ppk->user->no_pegawai}}
                    @endif
                   
                </td>
                <td class="table2">
                    @if ($data->st->teamleader_id != null)
                        <u>{{$data->st->teamleader->peg->name}}</u> <br>
                        NIP. {{$data->st->teamleader->peg->no_pegawai}}
                    @else
                        <u>{{$menyetujui->user->name}}</u> <br>
                        NIP. {{$menyetujui->user->no_pegawai}}
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
</body>

</html>