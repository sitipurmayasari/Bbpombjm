<div class="tab-pane active" id="tab-aktif">
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
                    <th>Klasifikasi</th>
                    <th>Nama Dokumen</th>
                    <th>Tanggal</th>
                    <th>aktif</th>
                    <th>inaktif</th>
                    <th>status</th>
                    <th>File</th>
                    <th>Aksi</th>
                <thead>
                <tbody>   	
                    @foreach($data as $key=>$row)
                    <tr>
                        <td>{{$data->firstItem() + $key}}</td>
                        <td>{{$row->alias}}</td>
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
                        <td><a href="{{$row->getFIlearsip()}}" target="_blank" >{{$row->file}}</a></td>
                        <td>
                            <a href="/arsip/archivesbid/edit/{{$row->id}}" class="btn btn-warning">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger delete"
                                r-name="{{$row->nama}}" 
                                r-id="{{$row->id}}">
                                <i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                  
                    @endforeach
                <tbody>
            </table>
        </div>
    {{$data->appends(Request::all())->links()}}
</div>