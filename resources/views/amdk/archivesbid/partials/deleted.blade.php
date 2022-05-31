<div class="tab-pane" id="tab-deleted">
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
                    <th>File</th>
                    <th></th>
                <thead>
                <tbody>   	
                    @foreach($datadel as $key=>$row)
                    <tr>
                        <td>{{$data->firstItem() + $key}}</td>
                        <td>{{$row->klas->alias}}</td>
                        <td>{{$row->uraian}}</td>
                        <td>{{$row->date}}</td>
                        <td><a href="{{$row->getFIlearsip()}}" target="_blank" >{{$row->file}}</a></td>
                        <td>
                            <a href="#" class="btn btn-danger delete"
                                r-name="{{$row->uraian}}" 
                                r-id="{{$row->id}}">
                                <i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                  
                    @endforeach
                <tbody>
            </table>
        </div>
    {{$datadel->appends(Request::all())->links()}}
</div>