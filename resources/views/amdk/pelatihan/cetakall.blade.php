<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/print.css')}}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%">
    </header>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div style="align=center font-size: 18px">
                <b>Rekapitulasi Akumulasi Waktu Kompetensi Pegawai</b>
            </div>
            <br>
            <div>
                <label for="form-field-1" style="font-size: 14px;">Tahun : {{$request->daftartahun}}</label>
            </div>
         </div>
             <div class="table-responsive isi">
                 <table id="simple-table" class="table  table-bordered table-hover " style="font-size: 11px;" >
                     <thead style="text-align: center">
                         <th width="20px">No</th>
                         <th>Nama Pegawai</th>
                         <th>NIP</th>
                         <th>Total Jam</th>
                     <thead>
                     <tbody>   	
                         <tr>
                             @php $no=1;  @endphp
                             @foreach($data as $key=>$row)
                             <tr>
                             <td style="text-align: center">{{$no++}}</td>
                             <td>{{$row->user->name}}</td>
                             <td>{{$row->user->no_pegawai}}</td>
                             <td>{{$row->poin}}</td>
                         </tr>
                         @endforeach
                     <tbody>
                 </table>
             </div>
    </main>
    {{-- <footer>
        {{-- <img src="{{asset('images/kopsurat2.jpg')}}" style="width: 100%" alt="background"> --}}
    </footer> --}}
</body>
</html>