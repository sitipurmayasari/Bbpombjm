@extends('layouts.ren')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/teamwork"> Tim Kerja</a></li>
@endsection
@section('content')


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('teamwork.store')}}">
         {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Tambah Ketua Tim</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Ketua Tim
                        </label>

                        <div class="col-sm-10">
                            <select id="users_id" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="null">Pilih Nama Ketua Tim</option>
                                @foreach ($user as $peg)
                                    <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Keterangan
                        </label>

                        <div class="col-sm-10">
                            <input type="text"  placeholder="keterangan" 
                                    class="col-xs-10 col-sm-10 required " 
                                    name="detail" required />
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
    </div><!-- /.col -->
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>

    <hr><br><br>
    <form method="get" action="{{ url()->current() }}">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="row">
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
                    <th>Ketua Tim</th>
                    <th>Keterangan</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                <thead>
                <tbody>   	
                    @foreach($data as $key=>$row)
                    <tr>
                        <td style="text-align: center;">{{$data->firstItem() + $key}}</td>
                        <td>{{$row->peg->name}} (NIP.{{$row->peg->no_pegawai}} )</td>
                        <td>{{$row->detail}}</td>
                        <td>{{$row->aktif}}</td>
                        <td>
                            <a href="/finance/teamwork/edit/{{$row->id}}" class="btn btn-warning">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                  
                    @endforeach
                <tbody>
            </table>
        </div>
    {{$data->appends(Request::all())->links()}}
@endsection