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
    <style>
        #simple-table{
           border: solid black;
        }

        .judul{
            border: none;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
    {{-- <header>
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%"> <br>
    </header> --}}
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div style="align=center font-size: 18px">
                <b>Rekapitulasi Akumulasi Waktu Kompetensi Pegawai</b>
            </div>
            <br>
            <div>
                <table style="font-size: 12px;" class="judul" >
                    <tr class="judul">
                        <td class="judul">Nama</td>
                        <td class="judul"> : {{$atas->user->name}}</td>
                    </tr>
                    <tr class="judul">
                        <td class="judul">NIP</td>
                        <td class="judul"> : {{$atas->user->no_pegawai}}</td>
                    </tr>
                    <tr class="judul">
                         <td class="judul">Tahun</td>
                         <td class="judul"> : {{$request->daftartahun}}</td>
                     </tr>
                </table>
            </div>
         </div>
         <br>
             <div class="table-responsive isi">
                 <table id="simple-table" class="table  table-bordered " style="font-size: 11px;" >
                     <thead style="text-align: center; font-size: 12px;">
                         <th width="10px">No</th>
                         <th>Jenis</th>
                         <th>Nama Pelatihan</th>
                         <th>Penyelenggara</th>
                         <th>Tanggal Pelatihan</th>
                         <th>Total Jam</th>
                     </thead>
                     <tbody>
                         <tr>
                             @php $no=1;  @endphp
                             @foreach($data as $key=>$row)
                             <tr>
                             <td style="text-align: center">{{$no++}}</td>
                             <td>{{$row->jenis->name}}</td>
                             <td>{{$row->nama}}</td>
                             <td>{{$row->penyelenggara}}</td>
                             <td>{{$row->dari}} s/d {{$row->sampai}}</td>
                             <td style="text-align: center;">{{$row->lama}}</td>
                         </tr>
                         @endforeach
                     </tbody>
                     <tfoot>
                         <tr>
                             <td colspan="5" style="text-align: right;">Total Jam Pembelajaran</td>
                             <td style="text-align: center;">{{$total->jumlah}}</td>
                         </tr>
                     </tfoot>
                 </table>
             </div>
    </main>
    
        {{-- <div class="footer">
            <img src="{{asset('images/kopsurat2.jpg')}}" style="width: 100%" alt="background">
        </div> --}}
</body>
</html>