<div class="tab-pane" id="tab-ticket">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="text-align: center;">NO</th>
                                    <th rowspan="2" class="text-center">Nama</th>
                                    <th colspan="7" > Tiket Pergi Kota 1</th>
                                    <th colspan="7"> Tiket Pergi Kota 2</th>
                                    <th colspan="7"> Tiket Pergi Kota 3</th>
                                    <th colspan="7"> Tiket Pulang</th>
                                </tr>
                                <tr>
                                    {{-- ----------kota 1------------ --}}
                                    <th>KKP</th>
                                    <th>Maskapai Pergi</th>
                                    <th>Nomor Tiket</th>
                                    <th>Harga Tiket (Rp)</th>
                                    <th>Tgl Pergi</th>
                                    <th>Kode Booking</th>
                                    <th>No. Penerbangan</th>
                                    {{-- ----------kota 2------------ --}}
                                    <th>KKP</th>
                                    <th>Maskapai Pergi</th>
                                    <th>Nomor Tiket</th>
                                    <th>Harga Tiket (Rp)</th>
                                    <th>Tgl Pergi</th>
                                    <th>Kode Booking</th>
                                    <th>No. Penerbangan</th>
                                    {{-- ----------kota 3----------- --}}
                                    <th>KKP</th>
                                    <th>Maskapai Pergi</th>
                                    <th>Nomor Tiket</th>
                                    <th>Harga Tiket (Rp)</th>
                                    <th>Tgl Pergi</th>
                                    <th>Kode Booking</th>
                                    <th>No. Penerbangan</th>
                                    {{-- ----------Pulang----------- --}}
                                    <th>KKP</th>
                                    <th>Maskapai Pulang</th>
                                    <th>Nomor Tiket</th>
                                    <th>Harga Tiket Rp.</th>
                                    <th>Tgl Pulang</th>  
                                    <th>Kode Booking</th>
                                    <th>No. Penerbangan</th>
                                </tr>
                            </thead>
                            <tbody id="pesawat">
                                @php
                                    $nomor=1;
                                @endphp
                                @foreach ($pesawat as $item)
                                    <tr id="cellb-{{$nomor}}">
                                        <td style="text-align: center;">{{$nomor}}</td>
                                        <td> {{$item->peg->pegawai->name}}</td>
                                        <td>
                                            @if ($item->planekkp1=='Y')
                                                <input type="checkbox" name="planekkp1_{{$item->outst_employee_id}}" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="planekkp1_{{$item->outst_employee_id}}" value="Y" >&nbsp;
                                            @endif
                                        </td>
                                        <td>
                                            <select name="plane_id1[]" class="select2 col-md-12">
                                                <option value="">Pilih Maskapai</option>
                                                @foreach ($plane as $maska)
                                                    @if ($maska->id == $item->plane_id1)
                                                        <option value="{{$maska->id}}" selected>{{$maska->code}} - {{$maska->name}}</option>
                                                    @else
                                                        <option value="{{$maska->id}}">{{$maska->code}} - {{$maska->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" placeholder="nomor tiket" name="planenumber1[]" value="{{$item->planenumber1}}"/></td>
                                        <td><input type="number" min="0" name="planefee1[]" value="{{$item->planefee1}}"/></td>
                                        <td><input type="date" name="godate1[]" value="{{$item->godate1}}"/></td>
                                        <td><input type="text" name="plane_book1[]" value="{{$item->plane_book1}}"/></td>
                                        <td><input type="text" name="plane_flight1[]" value="{{$item->plane_flight1}}"/></td>
                                        <td>
                                            @if ($item->planekkp2=='Y')
                                                <input type="checkbox" name="planekkp2_{{$item->outst_employee_id}}" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="planekkp2_{{$item->outst_employee_id}}" value="Y" >&nbsp;
                                            @endif
                                        </td>
                                        <td>
                                            <select name="plane_id2[]" class="select2 col-md-12">
                                                <option value="">Pilih Maskapai</option>
                                                @foreach ($plane as $maska)
                                                    @if ($item->plane_id2==$maska->id)
                                                        <option value="{{$maska->id}}" selected>{{$maska->code}} - {{$maska->name}}</option>
                                                    @else
                                                        <option value="{{$maska->id}}">{{$maska->code}} - {{$maska->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" placeholder="nomor tiket" name="planenumber2[]" value="{{$item->planenumber2}}"/></td>
                                        <td><input type="number" min="0"  name="planefee2[]" value="{{$item->planefee2}}"/></td>
                                        <td><input type="date" name="godate2[]" value="{{$item->godate2}}"/></td>
                                        <td><input type="text" name="plane_book2[]" value="{{$item->plane_book2}}"/></td>
                                        <td><input type="text" name="plane_flight2[]" value="{{$item->plane_flight2}}"/></td>
                                        <td>
                                            @if ($item->planekkp3=='Y')
                                                <input type="checkbox" name="planekkp3_{{$item->outst_employee_id}}" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="planekkp3_{{$item->outst_employee_id}}" value="Y" >&nbsp;
                                            @endif
                                        </td>
                                        <td>
                                            <select name="plane_id3[]" class="select2 col-md-12">
                                                <option value="">Pilih Maskapai</option>
                                                @foreach ($plane as $maska)
                                                    @if ($item->plane_id3==$maska->id)
                                                        <option value="{{$maska->id}}" selected>{{$maska->code}} - {{$maska->name}}</option>
                                                    @else
                                                        <option value="{{$maska->id}}">{{$maska->code}} - {{$maska->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" placeholder="nomor tiket" name="planenumber3[]" value="{{$item->planenumber3}}"/></td>
                                        <td><input type="number" min="0" name="planefee3[]" value="{{$item->planefee3}}"/></td>
                                        <td><input type="date" name="godate3[]" value="{{$item->godate3}}"/></td>
                                        <td><input type="text" name="plane_book3[]" value="{{$item->plane_book3}}"/></td>
                                        <td><input type="text" name="plane_flight3[]" value="{{$item->plane_flight3}}"/></td>
                                        <td>
                                            @if ($item->planekkpreturn=='Y')
                                                <input type="checkbox" name="planekkpreturn_{{$item->outst_employee_id}}" value="Y" checked>&nbsp;
                                            @else
                                                <input type="checkbox" name="planekkpreturn_{{$item->outst_employee_id}}" value="Y" >&nbsp;
                                            @endif
                                        </td>
                                        <td>
                                            <select name="plane_idreturn[]" class="select2 col-md-12">
                                                <option value="">Pilih Maskapai</option>
                                                @foreach ($plane as $maska)
                                                    @if ($item->plane_idreturn==$maska->id)
                                                        <option value="{{$maska->id}}" selected>{{$maska->code}} - {{$maska->name}}</option>
                                                    @else
                                                        <option value="{{$maska->id}}">{{$maska->code}} - {{$maska->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" placeholder="nomor tiket" name="planenumberreturn[]" value="{{$item->planenumberreturn}}"/></td>
                                        <td><input type="number" min="0" name="planereturnfee[]" value="{{$item->planereturnfee}}"/> </td>
                                        <td><input type="date" name="returndate[]"value="{{$item->returndate}}" /> </td>
                                        <td><input type="text" name="plane_bookreturn[]" value="{{$item->plane_bookreturn}}"/></td>
                                        <td><input type="text" name="plane_flightreturn[]" value="{{$item->plane_flightreturn}}"/></td>
                                    </tr>
                                    @php
                                        $nomor++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        *Centang KKP jika menggunakan Kartu Kredit Pemerintah
                   </div>
    
                </div>
        </div>
    </div>
</div>


