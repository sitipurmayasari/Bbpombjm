@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Rekapitulasi</li>
    <li>Rekap Absensi Pramubakti</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                         <div class="form-group col-xs-12 col-sm-2" style="float: left">
                            <a href="{{Route('rekpermit.create')}}"  class="btn btn-primary">Upload Absensi</a>   
                         </div>
                         <div class="form-group col-xs-12 col-sm-2" style="float: left">
                            <a href="{{Route('rekpermit.rekap')}}"  class="btn btn-primary">Rekap Absensi</a>   
                         </div>
                        <div class="form-group col-xs-12 col-sm-4" style="float: right">
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
<h3>Rekap Absensi Periode : {{$bulan}}{{$thn}}</h3>
    <div class="table-responsive">
        <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Poin</th>
                    <th>Pelanggaran (menit)</th>
                    <th>Aksi</th>
                </tr>
             </thead>
             <tbody>
                 @php
                     $no = 1;
                 @endphp
                 @foreach ($data as $item)
                 <tr>
                     <td>{{$no}}</td>
                     <td style="text-align: left">{{$item->peg->name}}</td>
                     <td>{{$item->poin}}</td>
                     <td>
                         @php
                             $a = $item->lambat;
                             $b = $item->cepat;
                             $c = $a+$b;
                         @endphp
                         {{$c}} menit
                     </td>
                     <td>
                        <a href="/amdk/rekpermit/daftar/{{$item->users_id}}/{{$bulan}}/{{$thn}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                    </td>
                 </tr>
                 @php
                      $no++;
                 @endphp
                 @endforeach
             </tbody>
        </table>
    </div>
{{$data->appends(Request::all())->links()}}
@endsection
