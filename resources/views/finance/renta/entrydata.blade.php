@extends('layouts.forma')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>Rencana Strategi</li>
    <li><a href="/finance/renta">Rencana Target Tahunan</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<style>
    th{
        text-align: center;
        font-weight: bold;
    }

    .scrollit{
        overflow: auto;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
@php
if ($data->periodebln==2) {
   $bulannya = "Februari";
} elseif ($data->periodebln==3) {
    $bulannya = "Maret";
} elseif ($data->periodebln==4) {
    $bulannya = "April";
} elseif ($data->periodebln==5) {
    $bulannya = "Mei";
} elseif ($data->periodebln==6) {
    $bulannya = "Juni";
} elseif ($data->periodebln==7) {
    $bulannya = "Juli";
} elseif ($data->periodebln==8) {
    $bulannya = "Agustus";
} elseif ($data->periodebln==9) {
    $bulannya = "September";
} elseif ($data->periodebln==10) {
    $bulannya = "Oktober";
} elseif ($data->periodebln==11) {
    $bulannya = "November";
} elseif ($data->periodebln==12) {
    $bulannya = "Desember";
} else {
    $bulannya = "januari";
}
@endphp

<form class="form-horizontal validate-form" role="form" 
method="post" action="{{route('renta.store')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="row">
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Realisasi target per bulan</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                {{-- <div class="col-sm-12" > --}}
                    <table  class="table table-bordered table-hover scrollit">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Indikator</th>
                                <th class="col-md-1">Target {{$data->eselon->years}} </th>
                                <th class="col-md-1">Target {{$bulannya}}</th>
                                <th class="col-md-1">Capaian {{$bulannya}} </th>
                                <th class="col-md-3">Keterangan</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($detail as $item)
                            <tr>
                                <td style="text-align: center;">{{$no}}
                                    <input type="hidden"  name="renta_id[]" value="{{$data->id}}">
                                </td>
                                <td>{{$item->indi->indicator}}
                                    <input type="hidden"  name="indicator_id[]" value="{{$item->indicator_id}}">
                                </td>
                                <td>
                                    <input type="hidden" name="eselontwo_detail_id[]" value="{{$item->id}}">
                                    <input type="text"  class="form-control" style="text-align:center;"  name="setahun[]" value="{{$item->setahun}}" readonly>
                                </td>
                                <td>
                                    @php
                                        if ($data->periodebln==2) {
                                           $targetnya = $item->feb;
                                        } elseif ($data->periodebln==3) {
                                           $targetnya = $item->mar;
                                        } elseif ($data->periodebln==4) {
                                           $targetnya = $item->apr;
                                        } elseif ($data->periodebln==5) {
                                           $targetnya = $item->mei;
                                        } elseif ($data->periodebln==6) {
                                           $targetnya = $item->jun;
                                        } elseif ($data->periodebln==7) {
                                           $targetnya = $item->jul;
                                        } elseif ($data->periodebln==8) {
                                           $targetnya = $item->aug;
                                        } elseif ($data->periodebln==9) {
                                           $targetnya = $item->sep;
                                        } elseif ($data->periodebln==10) {
                                           $targetnya = $item->oct;
                                        } elseif ($data->periodebln==11) {
                                           $targetnya = $item->nov;
                                        } elseif ($data->periodebln==12) {
                                           $targetnya = $item->dec;
                                        } else {
                                            $targetnya = $item->jan;
                                        }
                                    @endphp
                                    <input type="text" class="form-control" name="sebulan[]" value="{{$targetnya}}" readonly>
                                </td>
                                <td style="vertical-align:top;">
                                    <input type="number" class="form-control" value="0" step="0.1" name="capaian[]" required>
                                </td>
                                <td>
                                    <textarea name="keterangan[]" class="form-control" required></textarea>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
               {{-- </div> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
</div>
</form>



@endsection