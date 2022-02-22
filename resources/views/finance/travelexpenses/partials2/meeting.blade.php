<div class="tab-pane" id="tab-meeting">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" rowspan="2">NO</th>
                                    <th style="text-align: center;width: 100px;" rowspan="2">Nama</th>
                                    <th class="text-center" colspan="3">Paket Halfday / Fullday</th>
                                    <th class="text-center" colspan="3">Paket FullBoard</th>
                                </tr>
                                <tr>
                                    <th class="text-center col-md-2">Lama (hari) </th>
                                    <th>Biaya</th>
                                    <th>Total</th>
                                    <th class="text-center col-md-2">Lama (hari)</th>
                                    <th>Biaya</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="meeting">
                                @php
                                    $nomor=1;
                                @endphp
                                @foreach ($pertemuan as $item)
                                    <tr id="cellb-{{$nomor}}">
                                        <td style="text-align: center;">
                                            {{$nomor}}
                                        </td>
                                        <td>
                                            {{$item->peg->pegawai->name}}
                                        </td>
                                        <td><input type="number" min="0" value="{{$item->dayshalf}}" name="dayshalf[]" style="width:50px;" id="dayshalf-{{$nomor}}"/></td>       
                                        <td><input type="number" min="0" value="{{$item->feehalf}}" name="feehalf[]" id="feehalf-{{$nomor}}" onkeyup="feehalf({{$nomor}})"/></td>    
                                        <td><input type="number" min="0" value="{{$item->totdayshalf}}" name="totdayshalf[]" readonly id="totdayshalf-{{$nomor}}"/></td>                   
                                        <td><input type="number" min="0" value="{{$item->daysfull}}" name="daysfull[]" style="width:50px;" id="daysfull-{{$nomor}}"/></td>  
                                        <td><input type="number" min="0" value="{{$item->feefull}}" name="feefull[]" id="feefull-{{$nomor}}" onkeyup="feefull({{$nomor}})"/></td>   
                                        <td><input type="number" min="0" value="{{$item->totdaysfull}}" name="totdaysfull[]" readonly id="totdaysfull-{{$nomor}}"/></td>  
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


