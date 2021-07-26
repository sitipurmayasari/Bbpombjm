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
                <b>Rekapitulasi Realisasi Anggaran Per Triwulan</b>
            </div>
            <br>
            <div>
                <label for="form-field-1" style="font-size: 14px;">Periode : Triwulan ke- {{$request->triwulan}} 
                    {{$request->tahun}} )
                </label><br>
                <label for="form-field-1" style="font-size: 14px;"></label>
            </div>
         </div>
             <div class="table-responsive isi">
                 <table id="simple-table" class="table  table-bordered table-hover " style="font-size: 11px;" >
                     <thead style="text-align: center">
                         <tr>
                            <th width="20px">No</th>
                            <th>Asal POK</th>
                            <th>Kode Akun</th>
                            <th>Lokasi</th>
                            <th>Penarikan</th>
                         </tr>
                    <thead>
                    <tbody>   	
                        @php $no=1;  @endphp
                        @foreach($data as $key=>$row)
                        <tr>
                             <td style="text-align: center">{{$no++}}</td>
                             <td>
                                @if ($row->asal_pok == 'AWAL(0)')
                                    AWAL
                                @else
                                    {{$row->asal_pok}} - {{$row->asal}}({{$row->kode_asal}})
                                @endif
                                 </td>
                             <td>{{$row->kodeall}}/{{$row->code}} </td>
                             <td>{{$row->lokasi}}</td>
                             <td>
                                @php
                                    $angka = $row->biaya ;
                                    echo "Rp. " . number_format($angka, 2, ".", ",");
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                    <tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total Penarikan</td>
                            <td>
                                @php
                                    $angka = $total->total ;
                                    echo "Rp. " . number_format($angka, 2, ".", ",");
                                @endphp
                            </td>
                        </tr>
                    </tfoot>
                 </table>
             </div>
    </main>
</body>
</html>