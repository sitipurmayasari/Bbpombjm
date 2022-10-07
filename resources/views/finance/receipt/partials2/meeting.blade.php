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
                                            <th style="text-align: center;" colspan="3">Paket Halfday</th>
                                            <th style="text-align: center;" colspan="3">Paket Fullday</th>
                                            <th style="text-align: center;" colspan="3">Paket FullBoard</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center;">Lama (hari) </th>
                                            <th style="text-align: center;">Biaya</th>
                                            <th style="text-align: center;">Total</th>
                                            <th style="text-align: center;">Lama (hari)</th>
                                            <th style="text-align: center;">Biaya</th>
                                            <th style="text-align: center;">Total</th>
                                            <th style="text-align: center;">Lama (hari)</th>
                                            <th style="text-align: center;">Biaya</th>
                                            <th style="text-align: center;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($uangharian as $item5)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$item5->peg->pegawai->name}}
                                                </td>
                                                <td><input type="number" class="form-control" style="width: 50px;" value="{{$item5->halflong}}" min="0" name="halflong[]" id="halflong-{{$item5->id}}" onclick="HitSumHalfday({{$item5->id}})" onkeyup="HitSumHalfday({{$item5->id}})"></td>
                                                <td><input type="number" class="form-control" style="width: 100px;" value="{{$item5->halfcost}}" min="0" name="halfcost[]" id="halfcost-{{$item5->id}}" onclick="HitSumHalfday({{$item5->id}})" onkeyup="HitSumHalfday({{$item5->id}})"></td>
                                                <td><input type="number" class="form-control" style="width: 100px;" value="{{$item5->halfsum}}" min="0" name="halfsum[]" id="halfsum-{{$item5->id}}" readonly></td>
                                                <td><input type="number" class="form-control" style="width: 50px;" value="{{$item5->fulllong}}" min="0" name="fulllong[]" id="fulllong-{{$item5->id}}" onclick="HitSumFullday({{$item5->id}})" onkeyup="HitSumFullday({{$item5->id}})"></td>
                                                <td><input type="number" class="form-control" style="width: 100px;" value="{{$item5->fullcost}}" min="0" name="fullcost[]" id="fullcost-{{$item5->id}}" onclick="HitSumFullday({{$item5->id}})" onkeyup="HitSumFullday({{$item5->id}})"></td>
                                                <td><input type="number" class="form-control" style="width: 100px;" value="{{$item5->fullsum}}" min="0" name="fullsum[]" id="fullsum-{{$item5->id}}" readonly></td>
                                                <td><input type="number" class="form-control" style="width: 50px;" value="{{$item5->fblong}}" min="0" name="fblong[]" id="fblong-{{$item5->id}}" onclick="HitSumFullboard({{$item5->id}})" onkeyup="HitSumFullboard({{$item5->id}})"></td>
                                                <td><input type="number" class="form-control" style="width: 100px;" value="{{$item5->fbcost}}" min="0" name="fbcost[]" id="fbcost-{{$item5->id}}" onclick="HitSumFullboard({{$item5->id}})" onkeyup="HitSumFullboard({{$item5->id}})"></td>
                                                <td><input type="number" class="form-control" style="width: 100px;" value="{{$item5->fbsum}}" min="0" name="fbsum[]" id="fbsum-{{$item5->id}}" readonly></td>
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


