
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Catatan Uji</title>
</head>
<style>
    @page {
        size: 21.59cm 33cm ;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9pt;
    }
    table{
        width: 100%;
        /* border: 2px solid black; */
    }
    tr,td{
        text-align: left;
    }
    #ttd{
        padding-left: 2cm;
        position:absolute;
        bottom:0;
        width: 100%;
    }
    .detail{
            border: 1px solid black;
    }

</style>

<body>
    <div>
        <div>
            <img src="{{$data->getFoto()}}" alt="" style="width: 100%">
        </div>
       <div id="ttd">
         <table>
            <tr>
               <td style="width: 21%">Tanda Tangan Penguji</td>
               <td style="width: 1%;">:</td>
               <td style="width: 23%">
                <img src="{{$data->pegawai->ttd->getFoto()}}"  style="height:50px;width:50px;">
               </td>
               <td style="width: 14%">Diperiksa Oleh</td>
               <td style="width: 1%;">:</td>
               <td></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{tgl_indo($data->date)}}
                </td>
                <td>Tanggal</td>
                <td>:</td>
                <td></td>
             </tr>
       </div>
        </table>
    </div>
</body>
</html>
