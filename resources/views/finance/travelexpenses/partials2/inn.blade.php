<div class="tab-pane" id="tab-inn">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" rowspan="2">NO</th>
                                    <th class="text-center col-md-3" rowspan="2">Nama Pegawai</th>
                                    <th class="text-center" colspan="11">Penginapan 1</th>
                                    <th class="text-center" colspan="11">Penginapan 2</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Nama Penginapan</th>
                                    <th class="text-center">Alamat Penginapan</th>
                                    <th class="text-center">No. Telp Penginapan</th>
                                    <th class="text-center">No. Kamar (Room)</th>
                                    <th class="text-center">Tgl CheckIn</th>
                                    <th class="text-center">Tgl CheckOut</th>
                                    <th class="text-center">Non Penginapan*</th>
                                    <th class="text-center">Tarif Max* </th>
                                    <th class="text-center">Tarif</th>
                                    <th class="text-center">Lama (hari)</th>
                                    <th class="text-center">isi/kamar</th>
                                    <th class="text-center">Klaim</th>
                                    <th class="text-center">No. Invoice Hotel</th>
                                    <th class="text-center">Nama Penginapan</th>
                                    <th class="text-center">Alamat Penginapan</th>
                                    <th class="text-center">No. Telp Penginapan</th>
                                    <th class="text-center">No. Kamar (Room)</th>
                                    <th class="text-center">Tgl CheckIn</th>
                                    <th class="text-center">Tgl CheckOut</th>
                                    <th class="text-center">Non Penginapan*</th>
                                    <th class="text-center">Tarif Max* </th>
                                    <th class="text-center">Tarif</th>
                                    <th class="text-center">Lama (hari)</th>
                                    <th class="text-center">isi/kamar</th>
                                    <th class="text-center">Klaim</th>
                                    <th class="text-center">No. Invoice Hotel</th>
                                </tr>
                            </thead>
                            <tbody id="nginap">
                                @php
                                    $nomor=1;
                                @endphp
                                @foreach ($pesawat as $item)
                                   <tr id="cellb-{{$nomor}}">
                                        <td style="text-align: center;">{{$nomor}} </td>
                                        <td> {{$item->peg->pegawai->name}}</td>
                                        <td><input type="text" name="innname_1[]" value="{{$item->innname_1}}"/></td>
                                        <td><input type="text" name="inn_loc1[]" value="{{$item->inn_loc1}}"/></td>
                                        <td><input type="number" name="inn_telp1[]" value="{{$item->inn_telp1}}"/></td>
                                        <td><input type="text" name="inn_room1[]" value="{{$item->inn_room1}}"/></td>
                                        <td><input type="date" name="checkin1[]" value="{{$item->checkin1}}"/></td>
                                        <td><input type="date" name="checkout1[]" value="{{$item->checkout1}}"/></td>
                                        <td>
                                            @if ($item->inap1=='Y')
                                                <input type="checkbox" name="inap1[]" value="Y" checked> Ya
                                            @else
                                                <input type="checkbox" name="inap1[]" value="Y" >
                                            @endif
                                        </td>
                                        <td><input type="number" min="0" value="0" name="hotelmax1[]" value="{{$item->hotelmax1}}"/></td>
                                        <td><input type="number" min="0" value="{{$item->inn_fee_1}}" name="inn_fee_1[]" id="innfee1-{{$nomor}}"/></td>
                                        <td><input type="number" min="0" value="{{$item->long_stay_1}}" name="long_stay_1[]" id="longstay1-{{$nomor}}" style="width: 50px"/></td>
                                        <td><input type="number" min="0" value="{{$item->isi_1}}" name="isi_1[]" style="width: 50px"  id="isi1-{{$nomor}}" onkeyup="longstay1({{$nomor}})"/>org</td>
                                        <td><input type="number" min="0" value="{{$item->klaim_1}}" name="klaim_1[]"  id="klaim1-{{$nomor}}"/></td>
                                        <td><input type="text" name="innvoice1[]" value="{{$item->innvoice1}}"/></td>
                                        <td><input type="text" name="innname_2[]" value="{{$item->innname_2}}"/></td>
                                        <td><input type="text" name="inn_loc2[]" value="{{$item->inn_loc2}}"/></td>
                                        <td><input type="number" name="inn_telp2[]" value="{{$item->inn_telp2}}"/></td>
                                        <td><input type="text" name="inn_room2[]" value="{{$item->inn_room2}}"/></td>
                                        <td><input type="date" name="checkin2[]" value="{{$item->checkin2}}"/></td>
                                        <td><input type="date" name="checkout2[]" value="{{$item->checkout2}}"/></td>
                                        <td>
                                            @if ($item->inap2=='Y')
                                                <input type="checkbox" name="inap2[]" value="Y" checked> Ya
                                            @else
                                                <input type="checkbox" name="inap2[]" value="Y" >
                                            @endif
                                        </td>
                                        <td><input type="number" min="0" value="0" name="hotelmax2[]" value="{{$item->hotelmax2}}"/></td>
                                        <td><input type="number" min="0" value="{{$item->inn_fee_2}}" name="inn_fee_2[]" id="innfee2-{{$nomor}}"/></td>
                                        <td><input type="number" min="0" value="{{$item->long_stay_2}}" name="long_stay_2[]" id="longstay2-{{$nomor}}" style="width: 50px"/></td>
                                        <td><input type="number" min="0" value="{{$item->isi_2}}" name="isi_2[]" style="width: 50px" id="isi2-{{$nomor}}" onkeyup="longstay2({{$nomor}})"/>org </td> 
                                        <td><input type="number" min="0" value="{{$item->klaim_2}}" name="klaim_2[]" id="klaim2-{{$nomor}}"/></td>
                                        <td><input type="text" name="innvoice2[]" value="{{$item->innvoice2}}"/></td>
                                   </tr>
                                   @php
                                       $nomor++;
                                   @endphp
                               @endforeach
                            </tbody>
                        </table>
                        *Jika tidak menggunakan penginapan / menggunakan rumah pribadi atau saudara
                   </div>
    
                </div>
        </div>
    </div>
</div>


