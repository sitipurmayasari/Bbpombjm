<div class="tab-pane" id="tab-transport">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table id="TableTaxi" class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NO</th>
                                    <th class="text-center">Nama Pegawai</th>
                                    <th class="text-center">Riil</th>
                                    <th class="text-center">Jenis</th>
                                    <th class="text-center">Nama Perusahaan</th>
                                    <th class="text-center">Biaya</th>
                                    <th class="text-center">Kali</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1
                                @endphp
                                @foreach ($uangtransport as $item2)
                                <tr id="{{$no}}">
                                    <td>{{$no}}</td>
                                    <td>
                                        <select name="outst_employee_id_T[]" class="form-control select2"  style="width: 180px;">
                                           @foreach ($peg as $item)
                                                @if ($item->id == $item2->outst_employee_id)
                                                    <option value="{{$item->id}}" selected>{{$item->pegawai->name}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->pegawai->name}}</option>
                                                @endif
                                           @endforeach
                                        </select>
                                    </td>
                                    <td style="text-align: center">
                                        @if ($item2->rilltaxi=='Y')
                                                <input type="checkbox" name="rilltaxi_{{$no}}" value="Y" checked>
                                            @else
                                                <input type="checkbox" name="rilltaxi_{{$no}}" value="Y">
                                            @endif
                                        <input type="hidden" name="barisT[]" value="{{$no}}">
                                    </td>
                                    <td>
                                        <select name="taxitype[]">
                                            @if ($item2->taxitype == "Taksi,Toll")
                                                <option value="Taksi,Toll" selected>Taxi+Toll</option>
                                                <option value="Uang Transport">Uang Transport</option>
                                                <option value="Transport Lokal">Transport Lokal</option>
                                                {{-- <option value="Pembelian BBM" >Pembelian BBM</option> --}}
                                            @elseif ($item2->taxitype == "Uang Transport")
                                                <option value="Taksi,Toll" >Taxi+Toll</option>
                                                <option value="Uang Transport" selected>Uang Transport</option>
                                                <option value="Transport Lokal">Transport Lokal</option>
                                                {{-- <option value="Pembelian BBM" >Pembelian BBM</option> --}}
                                            @elseif ($item2->taxitype == "Transport Lokal")
                                                <option value="Taksi,Toll" >Taxi+Toll</option>
                                                <option value="Uang Transport">Uang Transport</option>
                                                <option value="Transport Lokal" selected>Transport Lokal</option>
                                                {{-- <option value="Pembelian BBM" >Pembelian BBM</option> --}}
                                            {{-- @else
                                                <option value="Taksi,Toll">Taxi+Toll</option>
                                                <option value="Uang Transport">Uang Transport</option>
                                                <option value="Transport Lokal">Transport Lokal</option>
                                                <option value="Pembelian BBM" selected>Pembelian BBM</option> --}}
                                            @endif
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="taxiname[]" style="width: 150px;" value="{{$item2->taxiname}}"></td>
                                    <td><input type="number" class="form-control" name="taxifee[]"  value="{{$item2->taxifee}}" min="0" id="taxifee-{{$no}}" onclick="HitSumTaxi2({{$no}})" onkeyup="HitSumTaxi2({{$no}})"></td>
                                    <td><input type="number" class="form-control" name="taxicount[]" value="{{$item2->taxicount}}" min="0" id="taxicount-{{$no}}" onclick="HitSumTaxi2({{$no}})" onkeyup="HitSumTaxi2({{$no}})"></td>
                                    <td><input type="number" class="form-control" name="taxisum[]" value="{{$item2->taxisum}}" min="0" id="taxisum-{{$no}}" readonly></td>
                                    <td>
                                        <a href="#" class="btn btn-danger deletetr"
                                            r-name="{{$item2->taxitype}}" 
                                            r-id="{{$item2->id}}">
                                            <i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                    @php $no++;  @endphp
                                @endforeach
                                <span id="row-new"></span>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9">
                                        <button type="button" class="form-control btn-default" onclick="addBarisTaxi()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        <input type="hidden" id="countRow3" value="{{$no}}">
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>
                   </div>
    
                </div>
        </div>
    </div>
</div>

