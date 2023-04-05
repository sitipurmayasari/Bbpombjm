<div class="tab-pane" id="tab-blnini">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group col-xs-12 col-sm-5" style="float: right">
                <form method="get" action="{{ url()->current() }}">
                {{-- <div class="input-group">
                    <input type="text" class="form-control gp-search" name="keyword" placeholder="Cari " value="{{request('keyword')}}" autocomplete="off">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                        <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                        </button>
                    </div>
                </div> --}}
                </form>
            </div>
            <div class="widget-body">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <th width="40px" style="text-align: center">No</th>
                                <th style="text-align: center">Periode</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Jam Masuk</th>
                                <th style="text-align: center">Jam Pulang</th>
                                <th style="text-align: center">terlambat</th>
                                <th style="text-align: center">Pulang Cepat</th>
                                <th style="text-align: center">poin</th>
                                <th>Daduk Absensi</th>
                                <th style="text-align: center">Daduk Absen</th>
                            <thead>
                            <tbody> 
                                @foreach ($data as $key=>$row)
                                <tr>
                                    <td>{{$data->firstItem() + $key}}</td>
                                    <td>{{tgl_indo($row->tanggal)}}</td>
                                    <td>{{$row->status->ket}}</td>
                                    <td>
                                        @if ($row->scan_masuk != null)
                                            {{$row->scan_masuk}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->scan_pulang != null)
                                            {{$row->scan_pulang}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->terlambat != null)
                                            {{$row->terlambat}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->pulang_cepat != null)
                                            {{$row->pulang_cepat}}
                                        @endif
                                    </td>
                                    <td>{{$row->poin}}</td>
                                    <td>
                                        <a href="{{$row->getFile()}}" target="_blank" >{{$row->file}}</a>
                                    </td>
                                    <td>
                                        @if ($row->poin != 0)
                                            <a href="/amdk/permit/edit/{{$row->id}}" class="btn btn-warning">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                        </table>
                        {{$data->appends(Request::all())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>