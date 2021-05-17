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
        .kop{
            padding-top: 0%;
            height: 15%;
            top: 0%;
            margin-left: 5%;
            margin-right: 5%;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            margin: 0%;
            
        }
        @page {
            size: A4;
             margin: 0;
        }

            .ttd{
            border:none;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .isi{
            margin-left: 8%;
            margin-right: 8%;
        }

    </style>
</head>
<body>
    <div class="kop">
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%">
    </div>
    <div style="text-align:'center'" class="isi">
       <div style="text-align:center; font-size: 18px">
           <b>Laporan Pemeliharaan</b>
       </div>
       <br>
       <div>
           {{-- @if ($divisi!="")
           <label for="form-field-1" style="font-size: 14px;">lokasi : {{$divisi}}</label><br>
       @endif --}}
       @if ($request->tahun!="1")
           <label for="form-field-1" style="font-size: 14px;">tahun : {{$request->daftartahun}}</label>
       @endif
       </div>
    </div>
        <div class="isi">
           <table style="text-align: left; font-size: 12px;">
                <tr>
                    <td>Nama Alat</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{$inv->nama_barang}}</td>
                </tr>
                <tr>
                    <td>Merk / Type</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{$inv->merk}}</td>
                </tr>
                <tr>
                    <td>Nomor Seri</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{$inv->no_seri}}</td>
                </tr>
                <tr>
                    <td>Tgl Diterima</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{$inv->tanggal_diterima}}</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{$inv->location->nama}}</td>
                </tr>
                <tr>
                    <td>Penanggung Jawab</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{$inv->penanggung->name}} ({{$inv->penanggung->no_pegawai}})</td>
                </tr>
               
           </table>
          
        </div>
        <br>
        <div class="table-responsive isi">
            <table id="simple-table" class="table  table-bordered table-hover " style="font-size: 11px;" >
                <thead style="text-align: center">
                    <th width="20px">No</th>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>Pelaksana</th>
                    <th>Hasil</th>
                    <th>Paraf</th>
                <thead>
                <tbody>   	
                    <tr>
                        @php $no=1;  @endphp
                        @foreach($data as $key=>$row)
                        <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>{{$row->tgl_pelihara}}</td>
                        <td>{{$row->kegiatan}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->hasil}}</td>
                        <td></td>
                    </tr>
                  
                    @endforeach
                <tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="col-sm-4 isi" style="float: right">
        <table class="ttd">
            <tr>
                <td class="ttd">
                    Banjarmasin, @php echo date("d F Y"); @endphp <br>
                    {{$petugas->jenis}}

                </td>
            </tr>
            <tr >
                <td style="height: 10%" class="ttd"></td>
                
            </tr>
            <tr>
                <td class="ttd"><u>{{$petugas->user->name}}</u></td>
                
            </tr>
            <tr>
                <td class="ttd">NIP. {{$petugas->user->no_pegawai}}</td>
            </tr>
        </table>

    </div><br>

    <div class="footer">
        <img src="{{asset('images/kopsurat2.jpg')}}" style="width: 100%">
    </div>
</body>
</html>