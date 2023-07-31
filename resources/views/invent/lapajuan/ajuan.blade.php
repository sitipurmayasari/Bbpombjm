@inject('injectQuery', 'App\InjectQuery')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
    <title>Pengajuan Barang Baru</title>
</head>
<style>
     @page {
        size: A4 ;
        font-family: "Arial";
        font-size: 11;
        margin-top: 10px;
        margin-left: 10px;
        margin-right: 10px;
    }
    .isi{
        padding-top: 120px;
    }

    table,tr,td{
        border-collapse: collapse;
    }
</style>

<body>
    <div style="height:50px;">
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> 
    </div> <br>

    <div class="isi">
        <div class="col-sm-12" style="text-align: center;font-size: 18px;">
            <b>Laporan Daftar Pengajuan Barang</b>
        </div><br>
        <div class="col-sm-12" style="text-align: left">
            @if ($request->tahun!="1")
                <label for="form-field-1" style="font-size: 14px;">tahun : {{$request->daftartahun}}</label>
            @endif
            </div><br>
        <div class="table">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th>Nomor Ajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Nama Pengaju</th>
                        {{-- <th>Kelompok Barang</th> --}}
                        <th>Daftar Barang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td style="text-align: center;">{{$no}}</td>
                            <td>{{$item->no_ajuan}}</td>
                            <td>{{$item->tgl_ajuan}}</td>
                            <td>{{$item->lapor->name}}</td>
                            {{-- <td>{{$item->kel->nama}}</td> --}}
                            <td>
                                @php
                                    $daftarajuan = $injectQuery->getDaftarBrgAjuan($item->id)
                                @endphp
                                    @foreach ($daftarajuan as $key=>$isi)
                                        - {{$isi->nama_barang}}  ({{$isi->jumlah}} {{$isi->satuan->satuan}})  
                                        @if ($isi->inventaris_id != null)
                                            (Merk : {{$isi->barang->merk}})
                                        @else
                                            (Merk : -)
                                        @endif
                                        
                                        <br>
                                    @endforeach 
                            </td>
                            <td>
                                @if ($item->status=='0')
                                    Menunggu
                                @else
                                    Selesai
                                @endif
                            </td>
                        </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>