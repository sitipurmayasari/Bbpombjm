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
                                        @php $no=1; @endphp
                                        @foreach ($peg as $item)
                                            <tr>
                                                @php
                                                    $DataPeg = $InjectNew->GetDataPeg($item->id);
                                                @endphp
                                                <td>{{$no}}</td>
                                                <td style="width: 180px;">{{$item->pegawai->name}}
                                                    <input type="hidden" value="{{$item->id}}" name="outst_employee_id[]">
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        @php
                                                            foreach ($tujuan as $key=>$kota) {
                                                                if ($loop->first) {
                                                                    $kota1 = $kota->destiny->id;
                                                                }
                                                            }

                                                            $uhar1 = $InjectNew->GetUH($kota1);

                                                            if ($DataPeg->deskjob !='Sopir') {
                                                                if ($DataPeg->jabatan_id == 6) { //kabalai
                                                                    $DK = $uhar1->dailywageDK1;
                                                                } else if ($DataPeg->jabatan_id == 11) { //kabag
                                                                    $DK = $uhar1->dailywageDK2;
                                                                } else if ($DataPeg->jabatan_id == 7) { //koor
                                                                    $DK = $uhar1->dailywageDK3;
                                                                } else if ($DataPeg->jabatan_id == 5) { //subkoor
                                                                    $DK = $uhar1->dailywageDK4;
                                                                } else {
                                                                    $DK = $uhar1->dailywageDK5;
                                                                }    
                                                                
                                                            } else {
                                                                    $DK = $uhar1->DKDriver;
                                                            }
                                                            
                                                        @endphp
                                                        <input type="number" style="width: 100px;" value="{{$DK}}" min="0" name="tlokalcost[]" id="tlokalcost-{{$item->id}}" onclick="Hittlokal({{$item->id}})" onkeyup="Hittlokal({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="0" min="0" name="tlokalkali[]" id="tlokalkali-{{$item->id}}" onclick="Hittlokal({{$item->id}})" onkeyup="Hittlokal({{$item->id}})">
                                                        <input type="number" class="form-control" value="0" min="0" name="tlokalsum[]" id="tlokalsum-{{$item->id}}" readonly>
                                                    </div>
                                                    
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        @php
                                                            foreach ($tujuan as $key=>$kota) {
                                                                if ($loop->first) {
                                                                    $kota1 = $kota->destiny->id;
                                                                }
                                                            }

                                                            $uhar1 = $InjectNew->GetUH($kota1);

                                                            if ($DataPeg->deskjob !='Sopir') {
                                                                if ($DataPeg->jabatan_id == 6) {
                                                                        $UH1 = $uhar1->dailywageLK1;
                                                                    } else if ($DataPeg->jabatan_id == 11) {
                                                                        $UH1 = $uhar1->dailywageLK2;
                                                                    } else if ($DataPeg->jabatan_id == 7) {
                                                                        $UH1 = $uhar1->dailywageLK3;
                                                                    } else if ($DataPeg->jabatan_id == 5) {
                                                                        $UH1 = $uhar1->dailywageLK4;
                                                                    } else {
                                                                        $UH1 = $uhar1->dailywageLK5;
                                                                }
                                                                    
                                                             
                                                            } else {
                                                                    $UH1 = $uhar1->LKDriver;
                                                            }
                                                        @endphp
                                                        <input type="number" style="width: 100px;" value="{{$UH1}}" min="0" name="uhar1cost[]" id="uhar1cost-{{$item->id}}" onclick="Hituhar1({{$item->id}})" onkeyup="Hituhar1({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="0" min="0" name="uhar1kali[]" id="uhar1kali-{{$item->id}}" onclick="Hituhar1({{$item->id}})" onkeyup="Hituhar1({{$item->id}})">
                                                        <input type="number" class="form-control" value="0" min="0" name="uhar1sum[]" id="uhar1sum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        @php
                                                            $UH2 = 0; 
                                                            if (count($tujuan) > 1) {
                                                                foreach ($tujuan as $key=>$kota) {
                                                                    if ($loop->first+1) {
                                                                        $kota2 = $kota->destiny->id;
                                                                    }
                                                                }
                                                                $uhar2 = $InjectNew->GetUH($kota2);

                                                                if ($DataPeg->deskjob !='Sopir') {
                                                                    if ($DataPeg->jabatan_id == 6) {
                                                                            $UH2 = $uhar2->dailywageLK1;
                                                                        } else if ($DataPeg->jabatan_id == 11) {
                                                                            $UH2 = $uhar2->dailywageLK2;
                                                                        } else if ($DataPeg->jabatan_id == 7) {
                                                                            $UH2 = $uhar2->dailywageLK3;
                                                                        } else if ($DataPeg->jabatan_id == 5) {
                                                                            $UH2 = $uhar2->dailywageLK4;
                                                                        } else {
                                                                            $UH2 = $uhar2->dailywageLK5;
                                                                        }
                                                                } else {
                                                                        $UH2 = $uhar2->LKDriver;
                                                                }
                                                            }

                                                            
                                                        @endphp
                                                        <input type="number" style="width: 100px;" value="{{$UH2}}" min="0" name="uhar2cost[]" id="uhar2cost-{{$item->id}}" onclick="Hituhar2({{$item->id}})" onkeyup="Hituhar2({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="0" min="0" name="uhar2kali[]" id="uhar2kali-{{$item->id}}" onclick="Hituhar2({{$item->id}})" onkeyup="Hituhar2({{$item->id}})">
                                                        <input type="number" class="form-control" value="0" min="0" name="uhar2sum[]" id="uhar2sum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        @php
                                                            $UH3 = 0; 
                                                            if (count($tujuan) > 1) {
                                                                foreach ($tujuan as $key=>$kota) {
                                                                    if ($loop->first+1) {
                                                                        $kota3 = $kota->destiny->id;
                                                                    }
                                                                }
                                                                $uhar3 = $InjectNew->GetUH($kota3);

                                                                if ($DataPeg->deskjob !='Sopir') {
                                                                    if ($DataPeg->jabatan_id == 6) {
                                                                            $UH3 = $uhar3->dailywageLK1;
                                                                        } else if ($DataPeg->jabatan_id == 11) {
                                                                            $UH3 = $uhar3->dailywageLK2;
                                                                        } else if ($DataPeg->jabatan_id == 7) {
                                                                            $UH3 = $uhar3->dailywageLK3;
                                                                        } else if ($DataPeg->jabatan_id == 5) {
                                                                            $UH3 = $uhar3->dailywageLK4;
                                                                        } else {
                                                                            $UH3 = $uhar3->dailywageLK5;
                                                                        }
                                                                } else {
                                                                        $UH3 = $uhar3->LKDriver;
                                                                }
                                                            }

                                                            
                                                        @endphp
                                                        <input type="number" style="width: 100px;" value="{{$UH3}}" min="0" name="uhar3cost[]" id="uhar3cost-{{$item->id}}" onclick="Hituhar3({{$item->id}})" onkeyup="Hituhar3({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="0" min="0" name="uhar3kali[]" id="uhar3kali-{{$item->id}}" onclick="Hituhar3({{$item->id}})" onkeyup="Hituhar3({{$item->id}})">
                                                        <input type="number" class="form-control" value="0" min="0" name="uhar3sum[]" id="uhar3sum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
                                                            if ($DataPeg->jabatan_id == 6) { //kabalai
                                                                $diklat = $uhar1->diklat1;
                                                                $fullboard = $uhar1->FBDK1;
                                                                $fullday = $uhar1->FBFD1;
                                                            } else if ($DataPeg->jabatan_id == 11) { //kabag
                                                                $diklat = $uhar1->diklat2;
                                                                $fullboard = $uhar1->FBDK2;
                                                                $fullday = $uhar1->FBFD2;
                                                            } else if ($DataPeg->jabatan_id == 7) { //koor
                                                                $diklat = $uhar1->diklat3;
                                                                $fullboard = $uhar1->FBDK3;
                                                                $fullday = $uhar1->FBFD3;
                                                            } else if ($DataPeg->jabatan_id == 5) { //subkoor
                                                                $diklat = $uhar1->diklat4;
                                                                $fullboard = $uhar1->FBDK4;
                                                                $fullday = $uhar1->FBFD4;
                                                            } else if ($DataPeg->jabatan_id == 8) { //staff
                                                                $diklat = $uhar1->diklat5;
                                                                $fullboard = $uhar1->FBDK5;
                                                                $fullday = $uhar1->FBFD5;
                                                            } else {
                                                                $diklat = 0;
                                                                $fullboard = 0;
                                                                $fullday = 0;
                                                            }     

                                                        if ($DataPeg->jabatan_id == 6) {
                                                            $representatif = $uhar1->representatif;
                                                        } else {
                                                            $representatif = 0;
                                                        }
                                                        
                                                    @endphp

                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$diklat}}" min="0" name="diklatcost[]" id="diklatcost-{{$item->id}}" onclick="Hitdiklat({{$item->id}})" onkeyup="Hitdiklat({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="0" min="0" name="diklatkali[]" id="diklatkali-{{$item->id}}" onclick="Hitdiklat({{$item->id}})" onkeyup="Hitdiklat({{$item->id}})">
                                                        <input type="number" class="form-control" value="0" min="0" name="diklatsum[]" id="diklatsum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$fullboard}}" min="0" name="fullboardcost[]" id="fullboardcost-{{$item->id}}" onclick="Hitfullboard({{$item->id}})" onkeyup="Hitfullboard({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="0" min="0" name="fullboardkali[]" id="fullboardkali-{{$item->id}}" onclick="Hitfullboard({{$item->id}})" onkeyup="Hitfullboard({{$item->id}})">
                                                        <input type="number" class="form-control" value="0" min="0" name="fullboardsum[]" id="fullboardsum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$fullday}}" min="0" name="fulldaycost[]" id="fulldaycost-{{$item->id}}" onclick="Hitfullday({{$item->id}})" onkeyup="Hitfullday({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="0" min="0" name="fulldaykali[]" id="fulldaykali-{{$item->id}}" onclick="Hitfullday({{$item->id}})" onkeyup="Hitfullday({{$item->id}})">
                                                        <input type="number" class="form-control" value="0" min="0" name="fulldaysum[]" id="fulldaysum-{{$item->id}}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 165px;">
                                                        <input type="number" style="width: 100px;" value="{{$representatif}}" min="0" name="repscost[]" id="repscost-{{$item->id}}" onclick="Hitreps({{$item->id}})" onkeyup="Hitreps({{$item->id}})"> X 
                                                        <input type="number" style="width: 50px;" value="0" min="0" name="repskali[]" id="repskali-{{$item->id}}" onclick="Hitreps({{$item->id}})" onkeyup="Hitreps({{$item->id}})">
                                                        <input type="number" class="form-control" value="0" min="0" name="repssum[]" id="repssum-{{$item->id}}" readonly>
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


