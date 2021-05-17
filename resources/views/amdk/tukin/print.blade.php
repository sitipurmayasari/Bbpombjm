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
            padding: 0%;
            
        }
        @page {
            size: A4;
             margin: 0;
            
            }
        html, table{
            font-family: Arial;
        }
        #isi{
            font-family: Arial;
            font-size: 11;
            margin-left: 10%;
            margin-right: 10%;
            line-height: 2;
        }
        table, td, tr {
            text-align: justify;
            vertical-align: top;
            line-height: 2;
            /* border: solid; */
        }

        .ttd{
            float: right;
            margin-right: 15%;
        }

        footer{
            page-break-after: always;
        }

    </style>
</head>
<body>
    <div class="kop">
        <img src="{{asset('images/kopsurat1.jpg')}}" style="width: 100%">
    </div>
    <div class="col-sm-12" style="text-align: center">
       <div style="align=center font-size: 18px">
           <b>SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK</b>
       </div>
       <br>
    </div>
    <div id="isi">
        <table>
            <tr>
                <td colspan="3">Yang bertanda tangan di bawah ini :</td>
            </tr>
            <tr>
                <td colspan="2" >Nama</td>
                <td style="width:85%;">: 
                    {{$item->pegawai->name}} 
                </td>
            </tr>
            <tr>
                <td colspan="2">NIP</td>
                <td >: 
                    {{$item->pegawai->no_pegawai}} 
                </td>
            </tr>
            <tr>
                <td colspan="2">Jabatan</td>
                <td>: {{$item->pegawai->jabatan->jabatan}} {{$item->pegawai->divisi->nama}}</td>
            </tr>
            <tr>
                <td colspan="2">Unit Kerja</td>
                <td>: 
                    @if ($item->pegawai->subdivisi_id != null)
                        {{$item->pegawai->subdivisi->nama_subdiv}}
                    @else
                        {{$item->pegawai->divisi->nama}}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3">Menyatakan dengan sesungguhnya bahwa :</td>
            </tr>
            <tr>
                <td style="width:5%; text-align: center; line-height: 1.5;">1.</td>
                <td colspan="2" style="line-height: 1.5;">Perhitungan jumlah uang yang kami terima sebesar Rp.
                    {{$item->terima}} untuk {{$data->bln}} {{$data->tahun}}
                    telah dihitung dengan benar dan sesuai dengan daftar hadir kami pada Satuan Kerja Balai Besar POM
                    di <i>Banjarmasin.</i>
                </td>
            </tr>
            <tr>
                <td style="width:5%; text-align: center; line-height: 1.5;"">2.</td>
                <td colspan="2" style="line-height: 1.5;">Apabila dikemudian hari terdapat kelebihan atas pembayaran tunjangan kinerja tersebut, kami bersedia
                    untuk menyetor kelebihan tersebut ke Negara.
                </td>
            </tr>
            <tr>
                <td colspan="3">Demikian pernyataan ini kami buat dengan sebenar - benarnya.</td>
            </tr>
        </table>
    </div>
    <br>
    <div class="ttd">
        <table>
            <tr>
                <td style="text-align: center;">Banjarmasin, &nbsp; &nbsp; &nbsp; 
                    {{$data->bln}} {{$data->tahun}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">Yang membuat pernyataan,</td>
            </tr>
            <tr>
                <td style="height: 15%"></td>
            </tr>
            <tr>
                <td style="text-align: center; line-height: 0;">
                    {{$item->pegawai->name}}
                   <hr>
                   {{$item->pegawai->no_pegawai}}
                </td>
            </tr>
        </table>
    </div>
        
    
    <div class="footer">
        <img src="{{asset('images/kopsurat2.jpg')}}" style="width: 100%">
    </div>
</body>
</html>