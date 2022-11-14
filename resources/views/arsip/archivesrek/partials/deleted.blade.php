@inject('injectQuery', 'App\InjectQuery')
<div class="tab-pane" id="tab-musnah">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group col-xs-12 col-sm-5" style="float: right">
                <form method="get" action="{{ url()->current() }}">
                <div class="input-group">
                    <input type="text" class="form-control gp-search" name="keyword" placeholder="Cari " value="{{request('keyword')}}" autocomplete="off">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                        <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
            <div class="widget-body">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <th width="40px">No</th>
                                <th>Klasifikasi</th>
                                <th>Uraian Berkas</th>
                                <th>Uraian Informasi</th>
                                <th>Tanggal</th>
                                <th>aktif</th>
                                <th>inaktif</th>
                                <th>status</th>
                                <th>Dibuat Oleh</th>
                                <th>File</th>
                            <thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp  
                                @foreach ($datadel as $row)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$row->klas->alias}}</td>
                                    <td>{{$row->uraian_berkas}}</td>
                                    <td>{{$row->uraian}}</td>
                                    <td>{{$row->date}}</td>
                                    <td>{{$row->klas->actived}} tahun 
                                        @if ($row->klas->ketactive != null)
                                            {{$row->klas->ketactive}}
                                        @endif
                                    </td>
                                    <td>{{$row->klas->innactive}} tahun 
                                        @if ($row->klas->ketinactive != null)
                                            {{$row->klas->ketinactive}}
                                        @endif
                                    </td>
                                    <td>{{$row->klas->thelast}}</td>
                                    <td>{{$row->user->name}}</td>
                                    <td><a href="{{$row->getFIlearsip()}}" target="_blank" >{{$row->file}}</a></td>
                                </tr>
                                @php
                                    $no++;
                                @endphp 
                                @endforeach
                            <tbody>
                        </table>
                        {{$datadel->appends(Request::all())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>