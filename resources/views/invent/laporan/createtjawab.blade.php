<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
</head>
    <title>Document</title>
</head>
<body>
  <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%">
  </header>
  <main>
    <div class="col-sm-12 isi" style="text-align: center">
        <div style="align=center font-size: 18px">
            <b>Laporan Personel Penunjukan Alat</b>
        </div>
        <br>
        <div>
            @if ($lokasi="")
            <label for="form-field-1" style="font-size: 14px;">lokasi : {{$lokasi}}</label><br>
        @endif
        @if ($request->tahun!="1")
            <label for="form-field-1" style="font-size: 14px;">tahun : {{$request->daftartahun}}</label>
        @endif
        </div>
        
        <div>
            <table class="table  table-bordered" style="font-size: 11px;">>
                <thead style="text-align: center">
                  <tr>
                    <th width="20px">No</th>
                    <th>Nama Alat</th>
                    <th>Penanggung Jawab</th>
                    <th>Tempat</th>
                  </tr>
                <thead>
                <tbody>
                    @php $no=1;  @endphp
                    @foreach($data as $key=>$row)
                    <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>{{$row->nama_barang}}</td>
                        <td>{{$row->penanggung->name}} ({{$row->penanggung->no_pegawai}} )</td>
                        <td>{{$row->location->nama}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </main>
  {{-- <footer>
    <img src="{{asset('images/kopsurat2.jpg')}}" style="width: 100%">
</footer>   --}}
</body>
</html>