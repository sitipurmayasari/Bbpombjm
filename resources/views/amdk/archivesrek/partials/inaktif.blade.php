@inject('injectQuery', 'App\InjectQuery')
<div class="tab-pane" id="tab-inaktif">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            @foreach ($klas as $item)
                                <li><a href="#inisi-{{$item->id}}" data-toggle="tab">{{$item->alias}}</a></li>
                            @endforeach
                            
                        </ul>    
                        <div class="tab-content">
                            @foreach ($klas as $item)
                            <div class="tab-pane" id="inisi-{{$item->id}}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @php
                                            $isi = $injectQuery->groupberkas($item->id);
                                        @endphp
                                        <ul class="nav nav-tabs">      
                                            @foreach ($isi as $item)
                                                <li><a href="#insub-{{$item->id}}" data-toggle="tab">{{$item->alias}}</a></li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($isi as $item)
                                            <div class="tab-pane" id="insub-{{$item->id}}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <ul class="nav nav-tabs">
                                                            @php
                                                                $sub = $injectQuery->subberkas($item->id);
                                                            @endphp
                                                            @foreach ($sub as $item)
                                                                <li><a href="#indet-{{$item->id}}" data-toggle="tab">{{$item->alias}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="tab-content">
                                                            @foreach ($isi as $item)
                                                            <div class="tab-pane" id="indet-{{$item->id}}">
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
                                                                                <thead>
                                                                                <tbody>
                                                                                    @php
                                                                                        $daftar = $injectQuery->berkasin($item->id);
                                                                                        $no = 1;
                                                                                    @endphp  
                                                                                    @foreach ($daftar as $row)
                                                                                    <tr>
                                                                                        <td>{{$no}}</td>
                                                                                        <td>{{$row->klas->alias}}</td>
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