@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Angka Kredit </li>
@endsection
@section('content')

<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <h4><b>{{auth()->user()->name}}</b></h4>
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
                <th>Periode</th>
                <th>No. Keputusan</th>
                <th>Tanggal</th>
                <th>Poin Smt Lalu</th>
                <th>Poin Saat ini</th>
                <th>File Upload</th>
            <thead>
            <tbody>   	
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>
                        @php
                            $bulan = date("m", strtotime($row->sampai));
                            $tahun = date("Y", strtotime($row->sampai));

                            if ($bulan = '12') {
                                $periode = 'II'; 
                            } else {
                                $periode = 'II'; 
                            };
                        @endphp
                        SMT {{$periode}} {{$tahun}}
                    </td>
                    <td>{{$row->nomor_kp}}</td>
                    <td>{{$row->tanggal}}</td>
                    <td style="text-align: center">{{$row->jumlama}}</td>
                    <td style="text-align: center">{{$row->total}}</td>
                    <td><a href="{{$row->getFIleDupak()}}" target="_blank" >{{$row->file}}</a></td>
                </tr>
              
                @endforeach
            <tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection
