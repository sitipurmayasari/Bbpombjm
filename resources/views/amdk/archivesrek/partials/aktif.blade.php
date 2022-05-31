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
                                                                    <div class="col-sm-12">
                                                                        <div class="table-responsive">
                                                                            <table id="simple-table" class="table  table-bordered table-hover">
                                                                                <thead>
                                                                                    <th width="40px">No</th>
                                                                                    <th>Klasifikasi {{$item->alias}}</th>
                                                                                    <th>Nama Dokumen</th>
                                                                                    <th>Tanggal</th>
                                                                                    <th>aktif</th>
                                                                                    <th>inaktif</th>
                                                                                    <th>status</th>
                                                                                    <th>File</th>
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
                                                                                        <td>{{$row->date}}</td>
                                                                                        <td>{{$row->klas->actived}} tahun 
                                                                                            @if ($row->klas->ceking=="Y")
                                                                                                Setelah Pengecekkan
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>{{$row->klas->innactive}} tahun 
                                                                                        </td>
                                                                                        <td>{{$row->klas->thelast}}</td>
                                                                                        <td><a href="{{$row->getFIlearsip()}}" target="_blank" >{{$row->file}}</a></td>
                                                                                        <td>
                                                                                            <a href="/amdk/archivesrek/edit/{{$row->id}}" class="btn btn-warning">
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