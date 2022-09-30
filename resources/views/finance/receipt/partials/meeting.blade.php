<div class="tab-pane" id="tab-meeting">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <fieldset>
                            <div class="table-responsive">
                                <table id="simple-table" class="table  table-bordered table-hover scrollit">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" rowspan="2">NO</th>
                                            <th style="text-align: center; width: 180px;" rowspan="2">Nama Pegawai</th>
                                            <th style="text-align: center;" colspan="3">Paket Halfday / Fullday</th>
                                            <th style="text-align: center;" colspan="3">Paket FullBoard</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center;">Lama (hari) </th>
                                            <th style="text-align: center;">Biaya</th>
                                            <th style="text-align: center;">Total</th>
                                            <th style="text-align: center;">Lama (hari)</th>
                                            <th style="text-align: center;">Biaya</th>
                                            <th style="text-align: center;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($peg as $item)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$item->pegawai->name}}
                                                </td>
                                                <td><input type="number" class="form-control" value="0" min="0" name="halflong[]" id="halflong-{{$item->id}}" onclick="HitSumHalfday({{$item->id}})" onkeyup="HitSumHalfday({{$item->id}})"></td>
                                                <td><input type="number" class="form-control" value="0" min="0" name="halfcost[]" id="halfcost-{{$item->id}}" onclick="HitSumHalfday({{$item->id}})" onkeyup="HitSumHalfday({{$item->id}})"></td>
                                                <td><input type="number" class="form-control" value="0" min="0" name="halfsum[]" id="halfsum-{{$item->id}}" readonly></td>
                                                <td><input type="number" class="form-control" value="0" min="0" name="fulllong[]" id="fulllong-{{$item->id}}" onclick="HitSumFullboard({{$item->id}})" onkeyup="HitSumFullboard({{$item->id}})"></td>
                                                <td><input type="number" class="form-control" value="0" min="0" name="fullcost[]" id="fullcost-{{$item->id}}" onclick="HitSumFullboard({{$item->id}})" onkeyup="HitSumFullboard({{$item->id}})"></td>
                                                <td><input type="number" class="form-control" value="0" min="0" name="fullsum[]" id="fullsum-{{$item->id}}" readonly></td>
                                            </tr>
                                            @php $no++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                   </div>
    
                </div>
        </div>
    </div>
</div>


