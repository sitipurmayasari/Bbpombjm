@extends('layouts.mon')
@section('breadcrumb')
    <li>Perjanjian Kinerja</li>
    <li>PK Eselon II</li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('eselontwo.create')}}"  class="btn btn-primary">Tambah Data</a>   
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
                <th width="40px" style="text-align: center">No</th>
                <th class="col-md-1" style="text-align: center">Tahun</th>
                <th style="text-align: center">Dasar</th>
                <th style="text-align: center">Dibuat Tanggal</th>
                <th style="text-align: center">Pejabat Eselon II</th>
                <th>Cetak</th>
                <th  class="col-md-1" style="text-align: center">Aksi</th>
            </thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$row->years}}</td>
                    <td>{{$row->renstrakal->filename}} ({{$row->renstrakal->yearfrom}}-{{$row->renstrakal->yearto}})
                    </td>
                    <td>{{$row->dates}}
                    </td>
                    <td>{{$row->pejabat->name}}</td>
                    <td>
                        <a href="/finance/eselontwo/agree/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-print"> Perjanjian</i>
                        </a>
                        <a href="/finance/eselontwo/detail/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-print"> Lampiran</i>
                        </a>
                    </td>
                    <td>
                        <a href="/finance/eselontwo/editmeta/{{$row->id}}" class="btn btn-warning">
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