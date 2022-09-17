@inject('injectQuery', 'App\InjectQuery')
<div class="tab-pane" id="tab-musnah">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            @foreach ($klas as $item)
                                <li><a href="#isidel-{{$item->id}}" data-toggle="tab">{{$item->alias}}</a></li>
                            @endforeach
                            
                        </ul>    
                        <div class="tab-content">
                            @foreach ($klas as $item)
                            <div class="tab-pane" id="isidel-{{$item->id}}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @php
                                            $isi = $injectQuery->groupberkas($item->id);
                                        @endphp
                                        <ul class="nav nav-tabs">      
                                            @foreach ($isi as $subgroup)
                                                <li><a href="#subdel-{{$subgroup->id}}" data-toggle="tab">{{$subgroup->alias}}</a></li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($isi as $subgroup)
                                            <div class="tab-pane" id="subdel-{{$subgroup->id}}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <ul class="nav nav-tabs">
                                                            @php
                                                                $sub = $injectQuery->subberkas($subgroup->id);
                                                            @endphp
                                                            @foreach ($sub as $detail)
                                                                <li><a href="#detdel-{{$detail->id}}" data-toggle="tab">{{$detail->alias}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                            <div class="tab-content">
                                                                @foreach ($sub as $detail)
                                                                <div class="tab-pane" id="detdel-{{$detail->id}}">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="table-responsive">
                                                                                <table id="simple-table" class="table  table-bordered table-hover">
                                                                                    <thead>
                                                                                        <th width="40px">No</th>
                                                                                        <th>Klasifikasi {{$detail->alias}}</th>
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
                                                                                            $daftar = $injectQuery->berkasper($detail->id);
                                                                                            $no = 1;
                                                                                        @endphp  
                                                                                        @foreach ($daftar as $row)
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
                                                                            </div>
                                                                        </div>    
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </ul>
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