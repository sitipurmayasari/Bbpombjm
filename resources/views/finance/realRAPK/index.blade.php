@extends('layouts.forma')
@section('breadcrumb')
    <li>RAPK</li>
    <li>Realisasi Capaian</li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('realRAPK.create')}}"  class="btn btn-primary">Tambah Data</a>   
                        </div>
                        <div class="form-group col-xs-12 col-sm-5" style="float: right">
                            <div class="input-group">
                                <input type="text" class="form-control gp-search" name="keyword" placeholder="Cari " value="{{request('keyword')}}" autocomplete="off">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                                    <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <div class="table-responsive">
        <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
                <th width="40px">No</th>
                <th>Tanggal</th>
                <th>Periode</th>
                <th>Bidang</th>
                <th>Nama Petugas</th>
                <th>Status</th>
                <th  class="col-md-1">Aksi</th>
            </thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{tgl_indo($row->dates)}}</td>
                    <td>
                        @php
                            if($row->periodebln == 2){
                                $bln = "Februari";
                            }elseif($row->periodebln == 3){
                                $bln = "Maret";
                            }elseif($row->periodebln == 4){
                                $bln = "April";
                            }elseif($row->periodebln == 5){
                                $bln = "Mei";
                            }elseif($row->periodebln == 6){
                                $bln = "Juni";
                            }elseif($row->periodebln == 7){
                                $bln = "Juli";
                            }elseif($row->periodebln == 8){
                                $bln = "Agustus";
                            }elseif($row->periodebln == 9){
                                $bln = "September";
                            }elseif($row->periodebln == 10){
                                $bln = "Oktober";
                            }elseif($row->periodebln == 11){
                                $bln = "November";
                            }elseif($row->periodebln == 12){
                                $bln = "Januari";
                            }else{
                                $bln = "Januari";
                            };
                        @endphp
                        {{$bln}} {{$row->eselon->years}}
                    </td>
                    <td>
                        {{$row->div->nama}}
                    </td>
                    <td>
                        {{$row->peg->name}}
                    </td>
                    <td>
                        @if ($row->verif == 'Y')
                            <span id="selesai" class="badge badge-pill badge-success">Terverifikasi</span>
                        @else
                            <span id="selesai" class="badge badge-pill badge-danger">Berlum Diverifikasi</span>
                        @endif
                    </td>
                    <td>
                        <a href="/finance/realRAPK/editnew/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                    </td>
                </tr>
              
                @endforeach
            </tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection