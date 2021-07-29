@inject('PoaQuery', 'App\PoaQuery')

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
            size: A4 landscape;
            margin: 100px 0px 100px 0px;
            font-family: 'Times New Roman';
            font-size: 11px;
            page-break-after: always;
      
        }

        .isi{
            margin-left: 8%;
            margin-right: 8%;
        }

        header {
                position:fixed;
                padding-top: 0%;
                /* height: 15%; */
                top: 0%;
                margin-left: 5%;
                margin-right: 5%;
                margin-top: -50px;
        }

        table, th, td, tr{
            border: 1px solid black;
            text-align: center;
            vertical-align: top;
        }

        table{
            width: 100%;
        }
        

    </style>
</head>
<body>
    <main>
        <div class="col-sm-12 isi" style="text-align: center">
            <div style="align=center font-size: 18px">
                <b>Rekapitulasi Realisasi Anggaran Triwulan</b>
            </div>
            <br>
            <div>
                <label for="form-field-1" style="font-size: 14px;">
                    Periode :{{$request->tahun}}
                </label><br>
                <label for="form-field-1" style="font-size: 14px;"></label>
            </div>
         </div>
             <div class="table-responsive isi">
                 <table id="simple-table" class="table  table-bordered table-hover " style="font-size: 11px;" >
                     <thead style="text-align: center">
                         <tr>
                            <th width="10px">No</th>
                            <th>Asal POK</th>
                            <th>Kode Akun</th>
                            <th>Lokasi</th>
                            <th>Triwulan 1</th>
                            <th>Triwulan 2</th>
                            <th>Triwulan 3</th>
                            <th>Triwulan 4</th>
                        </tr>
                        </thead>
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
                                  @for ($i = 0; $i < 4; $i++)
                                  <td>
                                      @if ($i==0)
                                          @php
                                            $triwulan1 = [1,2,3];
                                            $q = $PoaQuery->nilaitriwulan($request->tahun,$triwulan1);
                                          @endphp
                                          {{$q}}
                                      @elseif ($i==1)
                                      @php
                                        $triwulan2 = [4,5,6];
                                        $q = $PoaQuery->nilaitriwulan($request->tahun,$triwulan2);   
                                      @endphp
                                      {{$q}}
                                      @elseif ($i==2)
                                      @php
                                         $triwulan3 = [7,8,9];
                                         $q = $PoaQuery->nilaitriwulan($request->tahun,$triwulan3);
                                       @endphp
                                        {{$q}}

                                      @elseif ($i==3)
                                      @php
                                          $triwulan4 = [10,11,12];
                                          $q = $PoaQuery->nilaitriwulan($request->tahun,$triwulan4);
                                         
                                      @endphp
                                       {{$q}}
                                      @endif
                                  </td>
                                  @endfor
                           
                        </tr>
                        @endforeach
                    <tbody>
                 </table>
             </div>
    </main>
</body>
</html>