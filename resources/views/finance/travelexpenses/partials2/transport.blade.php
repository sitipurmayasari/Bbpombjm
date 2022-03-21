<div class="tab-pane" id="tab-transport">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" rowspan="2" >NO</th>
                                    <th class="text-center col-md-3" rowspan="2">Nama Pegawai</th>
                                    <th class="text-center" rowspan="2">Transport Lokal</th>
                                    <th class="text-center" rowspan="2">BBM</th>
                                    <th class="text-center" colspan="4">Taxi</th>
                                </tr>
                                <tr>
                                    <th class="text-center col-md-2">Taxi Kota Asal (trip)</th>
                                    <th>Biaya taxi Kota Asal</th>
                                    <th class="text-center col-md-2">Taxi Kota Tujuan (trip)</th>
                                    <th>Biaya Taxi Kota Tujuan</th>
                                </tr>
                            </thead>
                            <tbody id="transport">
                                @php
                                    $nomor=1;
                                @endphp
                                @foreach ($transport as $item)
                                    <tr id="cellb-{{$nomor}}">
                                        <td style="text-align: center;">{{$nomor}}</td>
                                        <td> {{$item->peg->pegawai->name}}</td>
                                        <td>
                                            @if ($item->tlokal=='Y')
                                                <input type="checkbox" name="tlokal_{{$item->outst_employee_id}}" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="tlokal_{{$item->outst_employee_id}}" value="Y" >&nbsp;
                                            @endif
                                            <input type="number" name="hittlokal[]"  min="0" value="{{$item->hittlokal}}" style="width: 75px;"  id="hittlokal-{{$nomor}}"> X
                                            <input type="number" name="jumtlokal[]"  min="0" value="{{$item->jumtlokal}}" style="width: 35px;"  id="jumtlokal-{{$nomor}}" onkeyup="jumtlokal({{$nomor}})"  onclick="jumtlokal({{$nomor}})">
                                            <input type="text" name="tottlokal[]"  min="0" value="{{$item->tottlokal}}" readonly style="width: 150px;" id="tottlokal-{{$nomor}}">
                                        </td>
                                        <td><input type="number" min="0" value="{{$item->bbm}}" name="bbm[]" /></td>
                                        <td><input type="number" style="width: 35px;" min="0" value="{{$item->taxy_count_from}}" name="taxy_count_from[]" />kali</td>          
                                        <td><input type="number" min="0" value="{{$item->taxy_fee_from}}" name="taxy_fee_from[]" /></td>          
                                        <td><input type="number" style=" width: 35px" min="0" value="{{$item->taxy_count_to}}" name="taxy_count_to[]" />kali</td>          
                                        <td><input type="number" min="0" value="{{$item->taxy_fee_to}}" name="taxy_fee_to[]" /></td>           
                                    </tr>
                                    @php
                                        $nomor++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                   </div>
    
                </div>
        </div>
    </div>
</div>


