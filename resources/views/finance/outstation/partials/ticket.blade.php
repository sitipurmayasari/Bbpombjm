<div class="tab-pane" id="tab-ticket">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table id="myTable" class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="text-align: center;">NO</th>
                                    <th  rowspan="2" class="text-center col-md-4">Nama</th>
                                    <th  rowspan="2" class="text-center">Nama Maskapai</th>
                                    <th colspan="5"  class="text-center"> Tiket Pesawat</th>
                                </tr>
                                <tr>
                                    <th>Tiket Pergi</th>
                                    <th>Tgl Pergi</th>
                                    <th>Tgl Pulang</th>
                                    <th>Tiket Pulang</th>
                                    
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="cell-1">
                                    <td style="text-align: center;">
                                        1
                                    </td>
                                    <td>
                                        <input type="text" readonly id="nama2"
                                        name="nama2" required/>
                                    </td>
                                    <td>
                                        <select name="plane_id" class="col-xs-10 col-sm-10 required select2" required>
                                            <option value="">Pilih Pejabat</option>
                                            @foreach ($plane as $item)
                                                <option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" min="0" value="0"
                                        name="planego" required/>
                                    </td>
                                    <td>
                                        <input type="date"
                                        name="godate" required/>
                                    </td>
                                    <td>
                                        <input type="date" 
                                        name="returndate" required/>
                                    </td>
                                    <td>
                                        <input type="number" min="0" value="0"
                                        name="planereturn" required/>
                                    </td>
                                </tr>
                                <span id="row-new"></span>
                            </tbody>
                        </table>
                   </div>
    
                </div>
        </div>
    </div>
</div>


