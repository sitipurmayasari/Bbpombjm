@inject('bQuery', 'App\Bquery')

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
            size: A4;
            margin: 100px 0px 100px 0px;
            font-family: 'Times New Roman';
            font-size: 11px;
            page-break-after: always;
        }

        header {
                position:fixed;
                padding-top: 0%;
                top: 0%;
                margin-left: 5%;
                margin-right: 5%;
                margin-top: -50px;
        }
        
        .isi{
            margin-left: 8%;
            margin-right: 8%;
        }

        table, th, td, tr{
            border: 1px solid black;
            text-align: center;
            vertical-align: top;
        }

        table{
            width: 100%;
        }
        
        .kepala{
            border: none;
            text-align: left;
        }

    </style>
</head>
<body>
    <header>
        <div style="text-align: center">
             <u><h3>Rekapitulasi Angka Kredit Pegawai</h3></u>
        </div>
     </header>
     <main>
         <div class="isi">
             <table class="kepala">
                 <tr class="kepala">
                     <td class="kepala" style="width: 20%">Nama</td>
                     <td class="kepala" style="width: 2%">:</td>
                     <td class="kepala">{{$data->name}}</td>
                 </tr>
                 <tr class="kepala">
                     <td class="kepala">NIP</td>
                     <td class="kepala">:</td>
                     <td class="kepala">{{$data->no_pegawai}}</td>
                 </tr class="kepala">
                 <tr>
                     <td class="kepala">Jabatan Fungsional</td>
                     <td class="kepala">:</td>
                     <td class="kepala">{{$data->jabasn->nama}}</td>
                 </tr>
             </table>
         </div>
         <br><br>
         <div class="isi">
             <table>
                 <thead>
                     <tr>
                         <th style="width: 40px">No</th>
                         <th>Tanggal Penilaian</th>
                         <th>Tahun / Semester</th>
                         <th>Angka Kredit</th>
                     </tr>
                 </thead>
                 <tbody>
                     @php $no=1;  @endphp
                     @foreach($dupak as $key=>$row)
                     <tr>
                         <td style="text-align: center">{{$no++}}</td>
                         <td>{{$row->dari}} s/d {{$row->sampai}}</td>
                         <td>
                             @if ($row->bulan==6)
                                 {{$row->tahun}}  / SMT 1
                             @else
                                 {{$row->tahun}}  / SMT 2
                             @endif
                         </td>
                         <td>{{$row->total}}</td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </main>    
</body>
</html>