<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/css/cetakan.css')}}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="kop">
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%">
    </div><br>
    <div style="text-align:center" class="isi">
        <div style="text-align: center;line-height: 20%;">
            <h4>{{$request->kegiatan}}</h4>
            <br>
            {{$request->tanggal}}
        </div>
    </div>
    <div class="isi">
        <div class="table-responsive">
            <br><br>
            <table id="simple-table" class="table table-bordered" style="font-size: 11px;" >
                <thead style="text-align: center">
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">NIP / NIK</th>
                        <th width="25%">Nama Pegawai</th>
                        <th width="10%">Paraf</th>
                    </tr>
                </thead>
                <tbody>   	
                        @php $no=1;  $a=1; @endphp
                        @foreach($data as $key=>$row)
                        <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>{{$row->no_pegawai}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$a++}}.<br><br>
                            &nbsp;&nbsp;&nbsp;................................
                        </td>
                    </tr>
                  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>