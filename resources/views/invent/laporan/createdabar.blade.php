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
    <div class="col-sm-12 isi" style="text-align: center">
       <div style="align=center font-size: 18px">
           <b>Laporan Daftar Inventaris</b>
       </div>
       <br>
       <div>
           @if ($lokasi!="")
           <label for="form-field-1" style="font-size: 14px;">lokasi : {{$lokasi}}</label><br>
       @endif
       @if ($request->tahun!="1")
           <label for="form-field-1" style="font-size: 14px;">tahun : {{$request->daftartahun}}</label>
       @endif
       </div>
    </div>
        <div class="table-responsive isi">
            <table id="simple-table" class="table  table-bordered table-hover " style="font-size: 11px;" >
                <thead style="text-align: center">
                    <th width="20px">No</th>
                    <th>Nama Barang</th>
                    <th>Merk / Type</th>
                    <th>No. Seri</th>
                    <th>Tanggal diterima</th>
                    <th>Lokasi</th>
                    <th>Penanggung Jawab</th>
                    <th>Jumlah</th>
                <thead>
                <tbody>   	
                    <tr>
                        @php $no=1;  @endphp
                        @foreach($data as $key=>$row)
                        <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>{{$row->nama_barang}}</td>
                        <td>{{$row->merk}}</td>
                        <td>{{$row->no_seri}}</td>
                        <td>{{$row->tanggal_diterima}}</td>
                        <td>{{$row->location->nama}}</td>
                        <td>{{$row->penanggung->no_pegawai}}<br>{{$row->penanggung->name}}</td>
                        <td style="text-align: center">{{$row->jumlah_barang}}</td>
                    </tr>
                  
                    @endforeach
                <tbody>
            </table>
        </div>
    
        <div class="footer">
            <img src="{{asset('images/kopsurat2.jpg')}}" style="width: 100%">
        </div>
</body>
</html>