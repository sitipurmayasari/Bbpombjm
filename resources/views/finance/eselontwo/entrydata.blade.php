@extends('layouts.ren')
@inject('injectQuery', 'App\InjectQuery')
@section('breadcrumb')
    <li>Perjanjian Kinerja</li>
    <li><a href="/finance/eselontwo">PK Eselon II</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
method="post" action="{{route('eselontwo.store')}}" enctype="multipart/form-data"   >
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title">Tambah PK Eselon II tahun {{$data->years}}</h3></div>
       <div class="panel-body">
           <table  id="simple-table" class="table  table-bordered table-hover">
               <thead>
                    <tr>
                        <th style="text-align: center" rowspan="2">No</th>
                        <th style="text-align: center" rowspan="2" >Indikator</th>
                        <th style="text-align: center" rowspan="2" >Target</th>
                        <th style="text-align: center" colspan="4" >Target</th>
                    </tr>
                    <tr>
                        <th style="text-align: center" >TWI</th>
                        <th style="text-align: center">TWII</th>
                        <th style="text-align: center">TWIII</th>
                        <th style="text-align: center">TWIV</th>
                    </tr>
               </thead>
               <tbody>
                   @php
                       $no = 1;
                   @endphp
                    @foreach ($indi as $key=>$row)
                        <tr>
                            <td style="text-align: center">{{$no++}}</td>
                            <td>
                                <input type="hidden" name="eselontwo_id[]" value="{{$data->id}}">
                                <input type="hidden" name="indicator_id[]" value="{{$row->id}}">
                                {{$row->indicator}}
                            </td>
                            @php
                                $isi = $injectQuery->getRenstrakal($data->renstrakal_id, $data->years,$row->id);
                            @endphp
                            <td><input type="text" name="target[]" readonly value="{{$isi->persentages}}" class="col-sm-6"></td>
                            <td><input type="number" name="twI[]" value="0" step="0.01" class="col-sm-10"></td>
                            <td><input type="number" name="twII[]" value="0" step="0.01" class="col-sm-10"></td>
                            <td><input type="number" name="twIII[]" value="0" step="0.01" class="col-sm-10"></td>
                            <td><input type="number" name="twIV[]" value="0" step="0.01" class="col-sm-10"></td>
                        </tr>
                    @endforeach
               </tbody>
           </table>
       </div>
   </div>
</div>
</div>
<div class="panel-footer">
    <div class="form-actions right">
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>SIMPAN
        </button>
    </div>
</div>
</form>

@endsection