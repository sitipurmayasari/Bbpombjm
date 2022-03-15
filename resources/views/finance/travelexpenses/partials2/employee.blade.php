<div class="tab-pane active" id="tab-employee">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <fieldset>
                            <table class="table table-bordered table-hover scrollit">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">NO</th>
                                        <th style="text-align: center;" class="col-md-2">Nama</th>
                                        <th style="text-align: center;" >Harian (Kota 1)</th>
                                        <th style="text-align: center;" >Harian (Kota 2)</th>
                                        <th style="text-align: center;" >Harian (Kota 3)</th>
                                        <th style="text-align: center;" >Diklat</th>
                                        <th style="text-align: center;" >Fullboard</th>
                                        <th style="text-align: center;" >Fullday/ Halfday</th>
                                        <th style="text-align: center;" >Representatif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nomor=1;
                                    @endphp
                                   @foreach ($harian as $item)
                                   <tr id="cellb-{{$nomor}}">
                                        <td style="text-align: center;"> {{$nomor}}</td>
                                        <td>{{$item->peg->pegawai->name}}
                                           <input type="hidden" name="outst_employee_id[]" value="{{$item->outst_employee_id}}">
                                        </td>
                                        <td>
                                            @if ($item->dailywage1=='Y')
                                                <input type="checkbox" name="dailywage1[]" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="dailywage1[]" value="Y" >&nbsp;
                                            @endif
                                            <input type="number" name="hitdaily1[]"  min="0" value="{{$item->hitdaily1}}" style="width: 75px;"   id="hitdaily-{{$nomor}}"> X
                                            <input type="number" name="jumdaily1[]"  min="0" value="{{$item->jumdaily1}}" style="width: 35px;" id="jumdaily-{{$nomor}}" onkeyup="totdaily({{$nomor}})" onclick="totdaily({{$nomor}})"> <br>
                                            <input type="number" name="totdaily1[]"  min="0" value="{{$item->totdaily1}}" readonly style="width: 150px;" id="totdaily-{{$nomor}}">
                                        </td>
                                        <td>
                                            @if ($item->dailywage2=='Y')
                                                <input type="checkbox" name="dailywage2[]" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="dailywage2[]" value="Y" >&nbsp;
                                            @endif
                                            <input type="number" name="hitdaily2[]"  min="0" value="{{$item->hitdaily2}}" style="width: 75px"   id="hitdaily2-{{$nomor}}"> X
                                            <input type="number" name="jumdaily2[]"  min="0" value="{{$item->jumdaily2}}" style="width: 35px"  id="jumdaily2-{{$nomor}}" onkeyup="totdaily2({{$nomor}})" onclick="totdaily2({{$nomor}})"> <br>
                                            <input type="text" name="totdaily2[]"  min="0" value="{{$item->totdaily2}}" readonly style="width: 150px" id="totdaily2-{{$nomor}}">
                                        </td>
                                        <td>
                                            @if ($item->dailywage3=='Y')
                                                <input type="checkbox" name="dailywage3[]" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="dailywage3[]" value="Y" >&nbsp;
                                            @endif
                                            <input type="number" name="hitdaily3[]"  min="0" value="{{$item->hitdaily3}}" style="width: 75px"   id="hitdaily3-{{$nomor}}"> X
                                            <input type="number" name="jumdaily3[]"  min="0" value="{{$item->jumdaily3}}" style="width: 35px"  id="jumdaily3-{{$nomor}}" onkeyup="totdaily3({{$nomor}})" onclick="totdaily3({{$nomor}})"> <br>
                                            <input type="text" name="totdaily3[]"  min="0" value="{{$item->totdaily3}}" readonly style="width: 150px" id="totdaily3-{{$nomor}}">
                                        </td>
                                        <td>
                                            @if ($item->diklat=='Y')
                                                <input type="checkbox" name="diklat[]" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="diklat[]" value="Y" >&nbsp;
                                            @endif
                                            <input type="number" name="hitdiklat[]"  min="0" value="{{$item->hitdiklat}}" style="width: 75px"   id="hitdiklat-{{$nomor}}"> X
                                            <input type="number" name="jumdiklat[]"  min="0" value="{{$item->jumdiklat}}" style="width: 35px"  id="jumdiklat-{{$nomor}}" onkeyup="totdiklat({{$nomor}})" onclick="totdiklat({{$nomor}})"> <br>
                                            <input type="text" name="totdiklat[]"  min="0" value="{{$item->totdiklat}}" readonly style="width: 150px" id="totdiklat-{{$nomor}}">
                                        </td>
                                        <td>
                                            @if ($item->fullboard=='Y')
                                                <input type="checkbox" name="fullboard[]" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="fullboard[]" value="Y" >&nbsp;
                                            @endif
                                            <input type="number" name="hitfullb[]"  min="0" value="{{$item->hitfullb}}" style="width: 75px"   id="hitfullb-{{$nomor}}"> X
                                            <input type="number" name="jumfullb[]"  min="0" value="{{$item->jumfullb}}" style="width: 35px"  id="jumfullb-{{$nomor}}" onkeyup="totfullb({{$nomor}})"   onclick="totfullb({{$nomor}})"> <br>
                                            <input type="text" name="totfullb[]"  min="0" value="{{$item->totfullb}}" readonly style="width: 150px" id="totfullb-{{$nomor}}">
                                        </td>
                                        <td>
                                            @if ($item->fullday=='Y')
                                                <input type="checkbox" name="fullday[]" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="fullday[]" value="Y" >&nbsp;
                                            @endif
                                            <input type="number" name="hithalf[]"  min="0" value="{{$item->hithalf}}" style="width: 75px"   id="hithalf-{{$nomor}}"> X
                                            <input type="number" name="jumhalf[]"  min="0" value="{{$item->jumhalf}}" style="width: 35px"  id="jumhalf-{{$nomor}}" onkeyup="tothalf({{$nomor}})"   onclick="tothalf({{$nomor}})"> <br>
                                            <input type="text" name="tothalf[]"  min="0" value="{{$item->tothalf}}" readonly style="width: 150px" id="tothalf-{{$nomor}}">
                                        </td>
                                        <td>
                                            @if ($item->representatif=='Y')
                                                <input type="checkbox" name="representatif[]" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="representatif[]" value="Y" >&nbsp;
                                            @endif
                                            <input type="number" name="hitrep[]"  min="0" value="{{$item->hitrep}}" style="width: 75px"   id="hitrep-{{$nomor}}"> X
                                            <input type="number" name="jumrep[]"  min="0" value="{{$item->jumrep}}" style="width: 35px"  id="jumrep-{{$nomor}}" onkeyup="totrep({{$nomor}})"   onclick="totrep({{$nomor}})"> <br>
                                            <input type="text" name="totrep[]"  min="0" value="{{$item->totrep}}" readonly style="width: 150px" id="totrep-{{$nomor}}">
                                        </td>
                                        
                                   </tr>
                                   @php
                                       $nomor++;
                                   @endphp
                               @endforeach
                                </tbody>
                            </table>
                        </fieldset>
                   </div>
    
                </div>
        </div>
    </div>
</div>


