<div class="tab-pane" id="tab-dupak">
    <div class="row">
        <div class="col-md-12" id="daftar-pengalaman">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Angka Kredit</h3></div>
                <div class="panel-body">
                   <div class="col-md-12">
                    <table id="myTable" class="table table-bordered table-hover sidebar">
                        <thead>
                            <tr>
                                @foreach($thndupak as $row)
                                    <th colspan="2" style="text-align: center; width:60%">{{$row->tahun}}</th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($dupak as $row)
                                    <th class="text-left col-md-4"  style="text-align: center; width:30%">
                                        @if ($row->bulan == '6')
                                            SMT 1
                                        @else
                                            SMT 2
                                        @endif
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($dupak as $row)
                                    <td style="text-align: center">{{$row->jumlah}}</td>
                                @endforeach
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>