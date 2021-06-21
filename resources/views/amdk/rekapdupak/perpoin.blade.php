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
    <header>
       <div style="text-align: center">
            <u><h3>Rekapitulasi Angka Kredit</h3></u>
       </div>
    </header>
    <main>
        <div class="isi">
            <table id="myTable" class="table table-bordered table-hover sidebar">
                <thead>
                        <tr>
                            <th rowspan="2" style="width: 20%;  vertical-align: center;">Nama</th>
                            <th rowspan="2" style="width:10%;  vertical-align: center;">NIP</th>
                            @php
                                $thn="";
                            @endphp
                            @foreach ($thndupak as $item)
                                <th colspan="2">
                                        {{$item->tahun}}
                                </th>
                                @php
                                    $thn = $item->tahun;
                                @endphp
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($blndupak as $item)
                            <th>
                                   @if ($item->bulan==1)
                                        SMT 1
                                   @else
                                        SMT 2
                                   @endif
                            </th>
                            @endforeach
                        </tr>
                </thead>
                <tbody>
                    @foreach($peg as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->no_pegawai}}</td>
                            @foreach ($blndupak as $item)
                            <td>
                                @php
                                    $q = $bQuery->outdupak($row->id,$item->tahun,$item->bulan);
                                    echo $q;
                                @endphp
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </main>
</body>
</html>