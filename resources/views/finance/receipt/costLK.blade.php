@inject('InjectNew', 'App\InjectNew')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Kuitansi</title>

    <style>
        @page {
            size: A4;
            font-family: 'Times New Roman';
            font-size: 7;
            font-style: italic;
            margin-top: 30px;
            margin-bottom: 15px;
            line-height: 1;
            page-break-after: always;
            page-break-before: always;
        }

        .kepala {
            text-align: left;
            font-style: italic;
            font-size: 7;
            border-collapse: collapse;
            border: none;
            line-height: 1;

        }
        .isi{
            font-size: 7;
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
            font-size: 11;
            padding-top: 0;
            padding-bottom: 0; 
        }

        th{
            text-align: center;
            letter-spacing: 2px;
        }
        p{
            font-size: 9; 
            text-align:center;
            line-height: 1;
        }
        
        body{
            page-break-after: always;
            page-break-before: always;
        }


        </style>

</head>
@php
    $no=1;
@endphp
@foreach ($pegawai as $item)
    
<body>

    <div style="page-break-before: always;">
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
                        $total = $InjectNew->totalHarga($item->id)
                    @endphp
                    {{number_format($total)}} 
                </b></td>
            </tr>
            <tr>
                <td>Untuk Pembayaran</td>
                <td colspan="3">: <b>{{$data->st->purpose}}</b></td>
            </tr>
       </table>
    </div>
   <br>
   <table style="width: 100%; padding" class="kepala">
        <tr>
            <td style="width: 20%">Berdasarkan Surat Tugas </td>
            <td colspan="2">: {{$item->out->number}}</td>
            <td colspan="2">Tanggal : {{tgl_indo($item->out->st_date)}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 20%">: di Kota
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
                {{terbilang($total)}} Rupiah
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
                @if ($item->pegawai->golongan_id != null)
                NIP. {{$item->pegawai->no_pegawai}}
            @endif
            <td></td>
            <td >Petugas <br><br><br></td>
            <td>: {{$no++}} <br><br><br></td>
        </tr>
   </table>
    <hr style="border:0.5px solid black; margin: 7px;">
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
      <hr style="border:0.5px solid black; margin: 7px;">
   <p style="font-size: 10; text-align:center;"><b>RINCIAN BIAYA PERJALANAN DINAS</b></p>
   <table class="isi" style="width: 100%">
    <thead>
        <tr>
            <th class="isi" style="width: 5%">No.</th>
            <th class="isi">Daftar Perincian</th>
            <th class="isi" style="width: 12%">Jumlah</th>
            <th class="isi" style="width: 15%">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="isi" style="text-align: center">1</td>
            <td>
               <table style="width: 100%;">
                    @php
                        $datapesawat    = $InjectNew->BiayaPesawat($item->id);
                        $dataUH         = $InjectNew->BiayaUHAR($item->id);
                        $dataTAsal      = $InjectNew->BiayaTrAsal($item->id);
                        $dataTTujuan    = $InjectNew->BiayaTrTujuan($item->id);
                        $dataTBBM       = $InjectNew->BiayaTrBBM($item->id);
                    @endphp
                    <tr>
                        <td colspan="8"><i>Biaya Transport</i></td>
                    </tr>
                    <tr>
                        <td><i> Tiket Pesawat / Kereta</i></td>
                        <td></td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td colspan="3">
                            @if ($datapesawat != null)
                                @foreach ($datapesawat as $pln)
                                    <i>{{$pln->plane->name}}</i>
                                @endforeach
                            @else
                                <i> - </i>
                            @endif
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 10%;"> 
                            <i>
                                @if ($datapesawat != null)
                                    @foreach ($datapesawat as $plfee)
                                        {{number_format($plfee->ticketfee)}}
                                    @endforeach
                                @else
                                   -
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td><i> Transport Lokal</i></td>
                        <td></td>
                        <td style="text-align: center; width:5%;"><i>:</i> </td>
                        <td style="text-align: center; width: 5%;">
                            @if ($dataUH->tlokalsum != 0)
                                {{$dataUH->tlokalkali}} 
                            @else
                                - 
                            @endif
                        </td>
                        <td style="text-align: center; width: 15;"><i> &nbsp; kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. </i></td>
                        <td style="text-align: center; width: 12%;"> 
                            <i>
                                @if ($dataUH->tlokalsum != 0)
                                    {{number_format($dataUH->tlokalcost)}}
                                @else
                                    - 
                                @endif
                            </i> 
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right; width: 12%;"> 
                            <i>
                                @if ($dataUH->tlokalsum != 0)
                                    {{number_format($dataUH->tlokalsum)}}
                                @else
                                    - 
                                @endif
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8"><i> Taxi Kota</i></td>
                    </tr>
                    <tr>
                        <td><i> - Asal</i></td>
                        <td> 
                            <i>{{$item->out->cityfrom->capital}}</i>
                        </td>
                        <td style="text-align: center;"><i>:</i></td>
                        <td style="text-align: center;">
                            <i>
                                @if ($dataTAsal != null)
                                    @foreach ($dataTAsal as $txc)
                                        {{$txc->taxicount}} 
                                    @endforeach
                                @else
                                   -
                                @endif                               
                            </i>
                        </td>
                        <td><i> &nbsp; kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. </i></td>
                        <td  style="text-align: right">
                            <i>
                                @if ($dataTAsal != null)
                                    @foreach ($dataTAsal as $txf)
                                    {{number_format($txf->taxifee)}}
                                    @endforeach
                                @else
                                   -
                                @endif 
                            </i> 
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right;"> 
                            <i>
                                @if ($dataTAsal != null)
                                    @foreach ($dataTAsal as $txs)
                                        {{number_format($txs->taxisum)}} 
                                    @endforeach
                                @else
                                   -
                                @endif 
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td><i> - Tujuan</i></td>
                        <td> 
                            <i>
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
                            </i>
                        </td>
                        <td style="text-align: center;"><i>:</i></td>
                        <td style="text-align: center;">
                            <i>
                                @if ($dataTTujuan != null)
                                    @foreach ($dataTTujuan as $txtjc)
                                        {{$txtjc->taxicount}} 
                                    @endforeach
                                @else
                                   -
                                @endif                               
                            </i>
                        </td>
                        <td><i> &nbsp; kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. </i></td>
                        <td  style="text-align: right">
                            <i>
                                @if ($dataTTujuan != null)
                                    @foreach ($dataTTujuan as $txtjf)
                                    {{number_format($txtjf->taxifee)}}
                                    @endforeach
                                @else
                                   -
                                @endif 
                            </i> 
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right;"> 
                            <i>
                                @if ($dataTTujuan != null)
                                    @foreach ($dataTTujuan as $txtjs)
                                        {{number_format($txtjs->taxisum)}} 
                                    @endforeach
                                @else
                                   -
                                @endif 
                            </i> &nbsp; 
                        </td>
                    </tr>
                    <tr>
                        <td><i> - BBM</i></td>
                        <td></td>
                        <td style="text-align: center;"><i>:</i></td>
                        <td style="text-align: center;">
                            <i>
                                @if ($dataTBBM != null)
                                    @foreach ($dataTBBM as $txtbc)
                                        {{$txtbc->taxicount}} 
                                    @endforeach
                                @else
                                   -
                                @endif                               
                            </i>
                        </td>
                        <td><i> &nbsp; kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. </i></td>
                        <td  style="text-align: right">
                            <i>
                                @if ($dataTBBM != null)
                                    @foreach ($dataTBBM as $txtbf)
                                    {{number_format($txtbf->taxifee)}}
                                    @endforeach
                                @else
                                   -
                                @endif 
                            </i> 
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right;"> 
                            <i>
                                @if ($dataTBBM != null)
                                    @foreach ($dataTBBM as $txtbs)
                                        {{number_format($txtbs->taxisum)}} 
                                    @endforeach
                                @else
                                   -
                                @endif 
                            </i> &nbsp; 
                        </td>
                    </tr>
                </table>
            </td>
            <td class="isi">
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                <i>
                    nilai
                </i>
                &nbsp;
            </td>
            <td class="isi">
                <i>{{$item->out->transport}}</i>
            </td>
        </tr>
        <tr>
            <td class="isi" style="text-align: center">2</td>
            <td class="isi">
                <table style="width: 100%;">
                    <tr>
                        <td colspan="8">
                            <i> Uang Harian di Kota 
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

                            Provinsi 
                            @foreach ($tujuan as $key=>$kota)
                                    @if ($loop->first)
                                        {{$kota->destiny->province}} 
                                    @endif        
                            @endforeach
                            </i>
                        </i></td>
                    </tr>
                    <tr>
                        <td><i> - BBM</i></td>
                        <td></td>
                        <td style="text-align: center;"><i>:</i></td>
                        <td style="text-align: center;">
                            <i>
                                @if ($dataTBBM != null)
                                    @foreach ($dataTBBM as $txtbc)
                                        {{$txtbc->taxicount}} 
                                    @endforeach
                                @else
                                   -
                                @endif                               
                            </i>
                        </td>
                        <td><i> &nbsp; kali &nbsp;&nbsp;&nbsp; x &nbsp;&nbsp;&nbsp;Rp. </i></td>
                        <td  style="text-align: right">
                            <i>
                                @if ($dataTBBM != null)
                                    @foreach ($dataTBBM as $txtbf)
                                    {{number_format($txtbf->taxifee)}}
                                    @endforeach
                                @else
                                   -
                                @endif 
                            </i> 
                            &nbsp;
                        </td>
                        <td style="text-align: center; width: 5%;"><i>. Rp.</i></td>
                        <td style="text-align: right;"> 
                            <i>
                                @if ($dataTBBM != null)
                                    @foreach ($dataTBBM as $txtbs)
                                        {{number_format($txtbs->taxisum)}} 
                                    @endforeach
                                @else
                                   -
                                @endif 
                            </i> &nbsp; 
                        </td>
                    </tr>
                </table>
            </td>
            <td class="isi">
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                <i>
                    nilai
                </i>
                &nbsp;
            </td>
            <td class="isi">
                <i>{{$item->out->transport}}</i>
            </td>
        </tr>
        <tr>
            <td class="isi"></td>
            <td class="isi"><i><b>Jumlah Biaya Perjalanan :</b></i></td>
            <td class="isi">
                
                Rp. &nbsp;&nbsp;&nbsp;&nbsp;
                <i>
                    nilai
                </i>
                &nbsp;
            </td>
            <td class="isi"></td>
        </tr>
        <tr>
            <td class="isi"></td>
            <td class="isi" colspan="3" style="text-transform: capitalize;">
                <i>Terbilang : <b>
                    nilai 
                    Rupiah</b></i>
            </td>
        </tr>
    </tbody>
   </table>
   <table style="width: 100%;" class="kepala">
    <tr>
        <td style="width: 30%"></td>
        <td style="width: 30%"></td>
        <td style="width: 40%"><br> Banjarmasin, {{tgl_indo($data->date)}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Telah di bayar sejumlah : Rp. {{number_format($total)}}</td>
        <td>Telah menerima jumlah uang sebesar : Rp. {{number_format($total)}} </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center">Bendahara Pengeluaran, <br><br><br><br></td>
        <td style="text-align: center"><b>Yang menerima :</b><br><br><br><br></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center;line-height: 1.3;">
            <u>{{$petugas->user->name}}</u> <br>
            NIP. {{$petugas->user->no_pegawai}}
        </td>
        <td style="text-align: center; ">
            <u>{{$item->pegawai->name}}</u> <br>
            @if ($item->pegawai->golongan_id != null)
                NIP. {{$item->pegawai->no_pegawai}}
            @endif
        </td>
    </tr>
   </table>
    <hr style="border:0.5px solid black; margin: 7px;">
   <p style="font-size: 10; text-align:center;"><b>PERHITUNGAN SPPD RAMPUNG</b></p>
   <div style="page-break-after: always;">
    <table style="width: 100%;" class="kepala">
        <tr>
            <td style="width: 20%"></td>
            <td style="width: 23%">Ditetapkan sejumlah</td>
            <td  style="width: 3%"><b>Rp. </b></td>
            <td class="isi" style="text-align: right">{{number_format($total)}}</td>
            <td style="text-align: center; width:40%">{{$item->out->ppk->jabatan}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Yang telah dibayar semula</td>
            <td><b>Rp. </b></td>
            <td class="isi" style="text-align: right">{{number_format($total)}}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Sisa kurang / lebih</td>
            <td><b>Rp. </b></td>
            <td class="isi" style="text-align: right">Nihil</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center; line-height: 1.3;">
                <u>{{$item->out->ppk->user->name}}</u> <br>
                NIP. {{$item->out->ppk->user->no_pegawai}}
            </td>
        </tr>
        <tr>
            <br>
            <td colspan="5" style="text-align:center; letter-spacing: 2px; ">BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI BANJARMASIN</td>
        </tr>
        <tr>
            <td colspan ="5" style="text-align:center;">
                Jl. Brigjend H. Hasan Basri No. 40 Banjarmasin - 70247 Telp (0511) 3304286, 3305115 ; Fax (0511) 3302162
            </td>
        </tr>
   </table>
   </div>
</body>

@endforeach

@section('footer')

<script>
   
    var total = document.getElementById("total_terbilang").value;
    document.getElementById("uangSebesar").innerHTML = total;
</script>
@endsection

</html>