<div class="tab-pane active" id="tab-employee">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <fieldset>
                            <div class="table-responsive">
                                <table id="simple-table" class="table  table-bordered table-hover scrollit">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">NO</th>
                                            <th style="text-align: center;">Nama</th>
                                            <th style="text-align: center;" >Dalam Kota > 8 Jam</th>
                                            <th style="text-align: center;" >Uang Harian 
                                                @foreach ($tujuan as $key=>$kota)
                                                    @if ($loop->first)
                                                        {{$kota->destiny->capital}} 
                                                    @endif
                                                @endforeach
                                            </th>
                                            <th style="text-align: center;" >Uang Harian 
                                                @if (count($tujuan) > 1)
                                                    @foreach ($tujuan as $key=>$kota)
                                                        @if ($loop->first+1)
                                                            {{$kota->destiny->capital}} 
                                                        @endif
                                                    @endforeach
                                                @else
                                                    "Kota 2"
                                                @endif
                                            </th>
                                            <th style="text-align: center;" >Uang Harian 
                                                @if (count($tujuan) == 3)
                                                    @foreach ($tujuan as $key=>$kota)
                                                        @if ($loop->last)
                                                            {{$kota->destiny->capital}} 
                                                        @endif
                                                    @endforeach
                                                @else
                                                    "Kota 3"
                                                @endif
                                            </th>
                                            <th style="text-align: center;" >Diklat</th>
                                            <th style="text-align: center;" >Fullboard</th>
                                            <th style="text-align: center;" >Fullday/ Halfday</th>
                                            <th style="text-align: center;" >Representatif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($uangharian as $item)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td style="width: 180px;">{{$item->peg->pegawai->name}}
                                                    <input type="hidden" value="{{$item->outst_employee_id}}" name="outst_employee_id[]">
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$item->tlokalcost}}" min="0" name="tlokalcost[]" id="tlokalcost-{{$item->id}}" onclick="Hittlokal({{$item->id}})" onkeyup="Hittlokal({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="{{$item->tlokalkali}}" min="0" name="tlokalkali[]" id="tlokalkali-{{$item->id}}" onclick="Hittlokal({{$item->id}})" onkeyup="Hittlokal({{$item->id}})">
                                                        <input type="number" class="form-control" value="{{$item->tlokalsum}}" min="0" name="tlokalsum[]" id="tlokalsum-{{$item->id}}" readonly>
                                                    </div>
                                                    
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$item->uhar1cost}}" min="0" name="uhar1cost[]" id="uhar1cost-{{$item->id}}" onclick="Hituhar1({{$item->id}})" onkeyup="Hituhar1({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="{{$item->uhar1kali}}" min="0" name="uhar1kali[]" id="uhar1kali-{{$item->id}}" onclick="Hituhar1({{$item->id}})" onkeyup="Hituhar1({{$item->id}})">
                                                        <input type="number" class="form-control" value="{{$item->uhar1sum}}" min="0" name="uhar1sum[]" id="uhar1sum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$item->uhar2cost}}" min="0" name="uhar2cost[]" id="uhar2cost-{{$item->id}}" onclick="Hituhar2({{$item->id}})" onkeyup="Hituhar2({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="{{$item->uhar2kali}}" min="0" name="uhar2kali[]" id="uhar2kali-{{$item->id}}" onclick="Hituhar2({{$item->id}})" onkeyup="Hituhar2({{$item->id}})">
                                                        <input type="number" class="form-control" value="{{$item->uhar2sum}}" min="0" name="uhar2sum[]" id="uhar2sum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$item->uhar3cost}}" min="0" name="uhar3cost[]" id="uhar3cost-{{$item->id}}" onclick="Hituhar3({{$item->id}})" onkeyup="Hituhar3({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="{{$item->uhar3kali}}" min="0" name="uhar3kali[]" id="uhar3kali-{{$item->id}}" onclick="Hituhar3({{$item->id}})" onkeyup="Hituhar3({{$item->id}})">
                                                        <input type="number" class="form-control" value="{{$item->uhar3sum}}" min="0" name="uhar3sum[]" id="uhar3sum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$item->diklatcost}}" min="0" name="diklatcost[]" id="diklatcost-{{$item->id}}" onclick="Hitdiklat({{$item->id}})" onkeyup="Hitdiklat({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="{{$item->diklatkali}}" min="0" name="diklatkali[]" id="diklatkali-{{$item->id}}" onclick="Hitdiklat({{$item->id}})" onkeyup="Hitdiklat({{$item->id}})">
                                                        <input type="number" class="form-control" value="{{$item->diklatsum}}" min="0" name="diklatsum[]" id="diklatsum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$item->fullboardcost}}" min="0" name="fullboardcost[]" id="fullboardcost-{{$item->id}}" onclick="Hitfullboard({{$item->id}})" onkeyup="Hitfullboard({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="{{$item->fullboardkali}}" min="0" name="fullboardkali[]" id="fullboardkali-{{$item->id}}" onclick="Hitfullboard({{$item->id}})" onkeyup="Hitfullboard({{$item->id}})">
                                                        <input type="number" class="form-control" value="{{$item->fullboardsum}}" min="0" name="fullboardsum[]" id="fullboardsum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$item->fulldaycost}}" min="0" name="fulldaycost[]" id="fulldaycost-{{$item->id}}" onclick="Hitfullday({{$item->id}})" onkeyup="Hitfullday({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="{{$item->fulldaykali}}" min="0" name="fulldaykali[]" id="fulldaykali-{{$item->id}}" onclick="Hitfullday({{$item->id}})" onkeyup="Hitfullday({{$item->id}})">
                                                        <input type="number" class="form-control" value="{{$item->fulldaysum}}" min="0" name="fulldaysum[]" id="fulldaysum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$item->repscost}}" min="0" name="repscost[]" id="repscost-{{$item->id}}" onclick="Hitreps({{$item->id}})" onkeyup="Hitreps({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="{{$item->repskali}}" min="0" name="repskali[]" id="repskali-{{$item->id}}" onclick="Hitreps({{$item->id}})" onkeyup="Hitreps({{$item->id}})">
                                                        <input type="number" class="form-control" value="{{$item->repssum}}" min="0" name="repssum[]" id="repssum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
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


