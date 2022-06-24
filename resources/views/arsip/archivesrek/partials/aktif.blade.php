@inject('injectQuery', 'App\InjectQuery')
<div class="tab-pane active" id="tab-aktif">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            @foreach ($klas as $item)
                                <li><a href="#isi-{{$item->id}}" data-toggle="tab">{{$item->alias}}</a></li>
                            @endforeach
                            
                        </ul>    
                        <div class="tab-content">
                            @foreach ($klas as $item)
                            <div class="tab-pane" id="isi-{{$item->id}}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @php
                                            $isi = $injectQuery->groupberkas($item->id);
                                        @endphp
                                        <ul class="nav nav-tabs">      
                                            @foreach ($isi as $item)
                                                <li><a href="#sub-{{$item->id}}" data-toggle="tab">{{$item->alias}}</a></li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($isi as $item)
                                            <div class="tab-pane" id="sub-{{$item->id}}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <ul class="nav nav-tabs">
                                                            @php
                                                                $sub = $injectQuery->subberkas($item->id);
                                                            @endphp
                                                            @foreach ($sub as $item)
                                                                <li><a href="#det-{{$item->id}}" data-toggle="tab">{{$item->alias}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="tab-content">
                                                            @foreach ($isi as $item)
                                                            <div class="tab-pane" id="det-{{$item->id}}">
                                                                <div class="row">
                                                                    {{-- <div class="form-group col-xs-12 col-sm-5" style="float: right">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control gp-search" name="keyword" placeholder="Cari " value="{{request('keyword')}}" autocomplete="off">
                                                                            <div class="input-group-btn">
                                                                                <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                                                                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}
                                                                    <div class="col-sm-12">
                                                                        <div class="table-responsive">
                                                                            <table id="simple-table" class="table  table-bordered table-hover">
                                                                                <thead>
                                                                                    <th width="40px">No</th>
                                                                                    <th>Klasifikasi {{$item->alias}}</th>
                                                                                    <th>Nomor</th>
                                                                                    <th>Nama Dokumen</th>
                                                                                    <th>Tanggal</th>
                                                                                    <th>aktif</th>
                                                                                    <th>inaktif</th>
                                                                                    <th>status</th>
                                                                                    <th>File</th>
                                                                                    <th>Dibuat Oleh</th>
                                                                                    <th>Aksi</th>
                                                                                <thead>
                                                                                <tbody>
                                                                                    @php
                                                                                        $daftar = $injectQuery->berkas($item->id);
                                                                                        $no = 1;
                                                                                    @endphp  
                                                                                    @foreach ($daftar as $row)
                                                                                    <tr>
                                                                                        <td>{{$no}}</td>
                                                                                        <td>{{$row->klas->alias}}</td>
                                                                                        <td>{{$row->uraian}}</td>
                                                                                        <td>{{$row->nomor}}</td>
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
                                                                                        <th>{{$row->user->name}}</th>
                                                                                        <td>
                                                                                            <a href="/arsip/archivesrek/edit/{{$row->id}}" class="btn btn-warning">
                                                                                                <i class="glyphicon glyphicon-edit"></i>
                                                                                            </a>
                                                                                            <a href="#" class="btn btn-danger delete"
                                                                                                r-name="{{$row->nama}}" 
                                                                                                r-id="{{$row->id}}">
                                                                                                <i class="glyphicon glyphicon-trash"></i></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @php
                                                                                        $no++;
                                                                                    @endphp 
                                                                                    @endforeach
                                                                                <tbody>
                                                                            </table>
                                                                            {{-- {{$data->appends(Request::all())->links()}} --}}
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>    
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            @endforeach
                        </div>
                   </div>
                </div>
        </div>
    </div>
</div>