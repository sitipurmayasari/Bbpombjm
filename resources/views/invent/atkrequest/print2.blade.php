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
           margin-top: 15px;

        }

        table, td, th {
            border: 1px solid black;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .borderless{
            border: none;
            border: none;
            letter-spacing: -1.2px;
            line-height: -1;
        }

        .lara{ 
            border: 1px solid black;
            padding: 20px;
            text-align: center;
            height: 75%;

            }

        .rapi{
            border:none;
            border-collapse: collapse;
            text-align: left;
        }

        .ttd{
            border:none;
            border-collapse: collapse;
            text-align: center;
            font-size: 11px;
        }

        hr {
            border-top: 1px dashed gray;
        }

        </style>

</head>
<body>
    <div>
        <table class="borderless" style="width: 100%"> 
            <tr  class="borderless" >
                <td  class="borderless"  style="width: 15%;"> <img src="{{asset('images/BBRI.jpg')}}" style="height:60px"></td>
                <td  class="borderless" >
                    <h6>BALAI BESAR PENGAWASAN OBAT DAN MAKANAN DI BANJARMASIN</h6>
                    <u><h5>SURAT PERMINTAAN BARANG (SPB)</h5></u>
                    <h6>NO. {{$data->nomor}}</h6>
                </td>
                <td  class="borderless"  style="width: 15%;">
                    <img src="{{asset('images/form.png')}}" style="height:20px">
                </td>
            </tr>
        </table>
    </div>  
    <br>  
    <div >
        <table class="rapi">
            <tr>
                <td class="rapi" style="width: 20%; ">Nama Pengaju</td>
                <td  class="rapi"style="width: 2%;">:</td>
                <td class="rapi">
                    {{$data->pegawai->name}}
                </td>
            </tr>
            <tr>
                <td class="rapi" style="width: 20%; ">Bag / Bid / Lab</td>
                <td  class="rapi"style="width: 2%;">:</td>
                <td class="rapi">
                    @if ($data->pegawai->subdivisi_id !=null)
                        {{$data->pegawai->subdivisi->nama_subdiv}} ( {{$data->pegawai->divisi->nama}} )
                    @else
                        {{$data->pegawai->divisi->nama}}
                    @endif
                </td>
            </tr>
            <tr>
                <td  class="rapi"style="width: 20%;">Kelompok Barang</td>
                <td  class="rapi"style="width: 2%; ">:</td>
                <td class="rapi">{{$kel->nama}}</td>
            </tr>
            <tr>
                <td  class="rapi"style="width: 20%;">Tanggal Permintaan</td>
                <td  class="rapi"style="width: 2%; ">:</td>
                <td class="rapi">{{tgl_indo($data->tanggal)}}</td>
            </tr>
        </table>
    </div>
    <br>
    <table >
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA BARANG</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
                <th>KEPERLUAN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no= 1;
            @endphp
            @foreach ($isi as $item)
            <tr>
                <td>{{$no++}}</td>
                <td style="text-align: left;">{{$item->barang->nama_barang}}</td>
                <td>{{$item->satuan->satuan}}</td>
                <td>{{$item->jumlah_aju}}</td>
                <td>{{$item->ket}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div id="ttd">
        <table class="ttd">
            <tr>
                <td class="ttd col-md-3" >Menyetujui,</td>
                <td class="ttd col-md-3"></td>
                <td class="ttd col-md-3"></td>
                <td class="ttd col-md-3">Diserahkan</td>
            </tr>
            <tr>
                <td class="ttd">
                    @if ($menyetujui != null)
                        @if ($menyetujui->pjs != null)
                        {{$menyetujui->pjs}}
                        {{$menyetujui->jabatan->jabatan}} 
                        {{$menyetujui->divisi->nama}}
                        @else
                        {{$menyetujui->jabatan->jabatan}} 
                        {{$menyetujui->divisi->nama}}
                        @endif
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif
                               
                </td>
                <td class="ttd">
                    Mengetahui
                </td>
                <td class="ttd">Yang Meminta</td>
                <td class="ttd">Pengelola Persediaan</td>
            </tr>
            <tr >
                <td class="ttd"></td>
                <td class="ttd">
                   @if ($tahubaru->ttd != null)
                        <img src="{{$tahubaru->ttd->getFoto()}}"  style="height:50px;width:50px;">
                   @endif
                </td>
                <td class="ttd"></td>
                <td class="ttd">
                    @if ($petugas->user->ttd != null)
                        <img src="{{$petugas->user->ttd->getFoto()}}"  style="height:50px;width:50px">
                    @endif
                </td>
            </tr>
            <tr>
                <td class="ttd"><u>
                    @if ($menyetujui != null)
                        {{$menyetujui->user->name}}
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif
                    </u>
                </td>
                <td class="ttd"><u>
                        {{$tahubaru->name}}
                </u>
                </td>
                <td class="ttd"><u>{{$data->pegawai->name}}</u></td>
                <td class="ttd"><u>{{$petugas->user->name}}</u></td>
               
            </tr>
            <tr>
                <td class="ttd">NIP. 
                    @if ($menyetujui != null)
                        {{$menyetujui->user->no_pegawai}}
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif
                    
                </td>
                <td class="ttd">NIP. 
                    {{$tahubaru->no_pegawai}}
                    
                </td>
                <td class="ttd">
                    @if ($data->pegawai->status=="PNS")
                        NIP. {{$data->pegawai->no_pegawai}}
                    @endif
                </td>
                <td class="ttd">
                    @if ($petugas->user->status=="PNS")
                        NIP. {{$petugas->user->no_pegawai}}
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <br>
    <hr>
    {{-- SBBK --}}
    <div>
        <table class="borderless" style="width: 100%"> 
            <tr  class="borderless" >
                <td  class="borderless" colspan="3" style="text-align: right" style="width: 15%; font-family:'Times New Roman', Times, serif"><i>Form</i> POM-1.10 &nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr  class="borderless" >
                <td  class="borderless"  style="width: 15%;"> <img src="{{asset('images/BBRI.jpg')}}" style="height:60px"></td>
                <td  class="borderless" style="vertical-align: bottom">
                    <u><h4>SURAT BUKTI BARANG KELUAR (SBBK)</h4></u>
                </td>
                <td  class="borderless"  style="width: 15%;"></td>
            </tr>
        </table>
    </div>  
    <br>  
    <div >
        <table class="rapi">
            <tr>
                <td class="rapi" style="width: 20%; ">Unit Kerja</td>
                <td  class="rapi"style="width: 2%;">:</td>
                <td class="rapi">
                    <b>BALAI BESAR PENGAWASAN OBAT DAN MAKANAN DI BANJARMASIN</b>
                </td>
            </tr>
            <tr>
                <td class="rapi" style="width: 20%; ">Nomor</td>
                <td  class="rapi"style="width: 2%;">:</td>
                <td class="rapi">
                    <b>{{$data->nomor}}</b>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <table >
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA BARANG</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
                <th>KEPERLUAN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no= 1;
            @endphp
            @foreach ($isi as $item)
            <tr>
                <td>{{$no++}}</td>
                <td style="text-align: left;">{{$item->barang->nama_barang}}</td>
                <td>{{$item->satuan->satuan}}</td>
                <td>{{$item->jumlah}}</td>
                <td>{{$item->ket}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div id="ttd">
        <table class="ttd">
            <tr>
                <td class="ttd"></td>
                <td class="ttd"></td>
                <td class="ttd">Tanggal, {{tgl_indo($data->tgl_terima)}}</td>
            </tr>
            <tr>
                <td class="ttd col-md-4">Yang Menerima,</td>
                <td class="ttd col-md-4">
                    Mengetahui <br>
                    Kepala Bagian Tata Usaha 
                </td>
                <td class="ttd col-md-4">Pengelola Gudang</td>
            </tr>
            <tr >
                <td class="ttd"></td>
                <td class="ttd">
                </td>
                <td class="ttd">
                    @if ($petugas->user->ttd != null)
                        <img src="{{$petugas->user->ttd->getFoto()}}"  style="height:50px;width:50px">
                    @endif
                </td>
            </tr>
            <tr>
                <td class="ttd"><u>{{$data->pegawai->name}}</u></td>
                <td class="ttd"><u>
                    @if ($menyetujui != null)
                        {{$menyetujui->user->name}}
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif
                </u>
                </td>
                <td class="ttd"><u>{{$petugas->user->name}}</u></td>
               
            </tr>
            <tr>
                <td class="ttd">
                    @if ($data->pegawai->status=="PNS")
                        NIP. {{$data->pegawai->no_pegawai}}
                    @endif
                </td>
                <td class="ttd">NIP. 
                    @if ($menyetujui != null)
                        {{$menyetujui->user->no_pegawai}}
                    @else
                        SILAHKAN CEK SETUP PEJABAT
                    @endif 
                </td>
                <td class="ttd">
                    @if ($petugas->user->status=="PNS")
                        NIP. {{$petugas->user->no_pegawai}}
                    @endif
                </td>
            </tr>
        </table>
    </div>
</body>
</html>