<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataTagingAnggaran.xls");
?>
@inject('injectQuery', 'App\InjectQuery')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tagging Anggaran</title>
    
<style>
    @page {
            size: landscape;
            font-family: 'Times New Roman';
            font-size: 11px;      
    }

    table{
        width: 100%;
    }

    table, th, td, tr{
        border: 1px solid black;
    }

    th{
        text-align: center;
    }

    .tbl{
        border-collapse: collapse;
        border: none;
    }
    td{
        padding-left: 3px;
        border-bottom: 0;
        border-top: 0;
        vertical-align: top;
    }

   
    
</style>

</head>
<body>
    
<div class="row">
    <br>
    <div class="header"  style="text-align: center">
        <h3>TAGGING ANGGARAN</h3>
        <h5>Update : {{tgl_indo($pagu->tgl_pagu)}}
        </h5>
    </div>
    <table id="isi">
        <thead>
            <tr>
                <th style="width: 25%">Indikator</th>
                <th style="width: 13%">Subkomponen</th>
                <th>Detail</th>
                <th>Pagu (Rp)</th>
                <th>Realisasi  (Rp)</th>
                <th>Persentage</th>
                <th>IKU Pagu  (Rp)</th>
                <th>IKU Realisasi  (Rp)</th>
            </tr>
        </thead>
        <tbody class="tbl">
            @php
                $indi="";
            @endphp
            @foreach ($data as $item)
            <tr>
                @if ($indi!=$item->indicator_id)
                    @php
                        $hitung = $injectQuery->getIndi($item->pagu_id, $item->indicator_id);
                        $cell = $hitung->jum;
                    @endphp
                    <td rowspan="{{$cell}}" style="border-bottom:solid ; border-bottom-color: black;">
                        {{$item->indi->indicator}}
                    </td>
                @endif
                
                <td style="border-bottom:solid ; border-bottom-color: black;">
                    {{$item->sub->kodeall}}
                </td>
                <td style="border-bottom:solid ; border-bottom-color: black;">  &nbsp;
                    {{$item->sub->name}}
                </td>
                <td style="text-align: right; border-bottom:solid ; border-bottom-color: black;">
                    {{number_format($item->pagusub)}} &nbsp;
                </td>
                <td style="text-align: right; border-bottom:solid ; border-bottom-color: black;">
                    {{number_format($item->realisasisub)}} &nbsp;
                </td>    
                
                <td style=" text-align: center; border-bottom:solid ; border-bottom-color: black;">
                    {{$item->ikupersen}} %
                </td>
                <td style="text-align: right; border-bottom:solid ; border-bottom-color: black;">
                    {{number_format($item->paguiku)}} &nbsp;
                </td>
                <td style="text-align: right; border-bottom:solid ; border-bottom-color: black;">
                    {{number_format($item->realisasiiku)}} &nbsp;
                </td>
            </tr>
                @php
                    $indi = $item->indicator_id;
                @endphp
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>