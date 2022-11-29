<div class="tab-pane" id="tab-inn">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table id="TableHotel" class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NO</th>
                                    <th class="text-center">Nama Pegawai</th>
                                    <th class="text-center">KKP</th>
                                    <th class="text-center">Riil</th>
                                    <th class="text-center">Nama Penginapan</th>
                                    <th class="text-center">Alamat Penginapan</th>
                                    <th class="text-center">No. Telp Penginapan</th>
                                    <th class="text-center">No. Kamar (Room)</th>
                                    <th class="text-center">Tgl CheckIn</th>
                                    <th class="text-center">Tgl CheckOut</th>
                                    <th class="text-center">Biaya/Hari</th>
                                    <th class="text-center">Jenis Klaim</th>
                                    <th class="text-center">Klaim/Hari</th>
                                    <th class="text-center">Lama (hari)</th>
                                    <th class="text-center">isi/kamar</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">No. Invoice Hotel</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($uanginn as $item4)
                                <tr id="cell-{{$no}}">
                                    <td>{{$no}}</td>
                                    <td>
                                        <select name="outst_employee_id_I[]" class="form-control select2"  style="width: 180px;">
                                            <option value="">Pilih nama Pegawai</option>
                                            @foreach ($peg as $item)
                                                @if ($item->id == $item4->outst_employee_id)
                                                    <option value="{{$item->id}}" selected>{{$item->pegawai->name}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->pegawai->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="barisI[]" value="{{$no}}">
                                    </td>
                                    <td style="text-align: center">
                                        @if ($item4->hotelkkp=="Y")
                                            <input type="checkbox" name="hotelkkp_{{$no}}" value="Y" checked>
                                        @else
                                            <input type="checkbox" name="hotelkkp_{{$no}}" value="Y">
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if ($item4->rillhotel=="Y")
                                            <input type="checkbox" name="rillhotel_{{$no}}" value="Y" checked>
                                        @else
                                            <input type="checkbox" name="rillhotel_{{$no}}" value="Y">
                                        @endif
                                    </td>
                                    <td><input type="text" class="form-control" name="hotelname[]" style="width: 150px;" value="{{$item4->hotelname}}"></td>
                                    <td><input type="text" class="form-control" name="hoteladdr[]" style="width: 150px;" value="{{$item4->hoteladdr}}"></td>
                                    <td><input type="text" class="form-control" name="hoteltelp[]" style="width: 150px;" value="{{$item4->hoteltelp}}"> </td>
                                    <td><input type="text" class="form-control" name="hotelroom[]" style="width: 100px;" value="{{$item4->hotelroom}}"></td>
                                    <td><input type="date"  class="form-control" name="hotelin[]" value="{{$item4->hotelin}}"/></td>
                                    <td><input type="date"  class="form-control" name="hotelout[]"  value="{{$item4->hotelout}}"/></td>   
                                    <td><input type="number" class="form-control" name="hotelmax[]" value="{{$item4->hotelmax}}" style="width: 130px;" min="0" id="hotelmax-{{$no}}" onkeyup="HitNilaihotel({{$no}})"></td>
                                    <td>  
                                       @if ($item4->hotelpersen == 'Y')
                                       <input type="checkbox" name="hotelpersen_{{$no}}" value="Y" onclick="Hithotel2({{$no}})" id="full-{{$no}}" checked> &nbsp; 30%  
                                       @else
                                       <input type="checkbox" name="hotelpersen_{{$no}}" value="Y" onclick="Hithotel2({{$no}})" id="full-{{$no}}"> &nbsp; 30%  
                                       @endif           
                                    </td>
                                    <td><input type="number" class="form-control" name="hotelfee[]" style="width: 130px;" value="{{$item4->hotelfee}}"  readonly id="hotelfee-{{$no}}"></td>
                                    <td><input type="number" class="form-control" name="hotellong[]" style="width: 50px;" value="{{$item4->hotellong}}"  min="0" id="hotellong-{{$no}}" onclick="HitSumHotel2({{$no}})" onkeyup="HitSumHotel2({{$no}})"></td>
                                    <td><input type="number" class="form-control" name="person[]" style="width: 50px;" value="{{$item4->person}}"  min="0" id="person-{{$no}}" onclick="HitSumHotel2({{$no}})" onkeyup="HitSumHotel2({{$no}})"></td>
                                    <td><input type="number" class="form-control" name="hotelsum[]" style="width: 130px;" value="{{$item4->hotelsum}}" readonly id="hotelsum-{{$no}}"></td>
                                    <td><input type="text" class="form-control" name="hotelinfo[]" style="width: 150px;"  value="{{$item4->hotelinfo}}"></td>
                                    <td>
                                        <a href="#" class="btn btn-danger deleteinn"
                                        r-name="{{$item4->hotelname}}" 
                                        r-id="{{$item4->id}}">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                @php $no++;@endphp
                                @endforeach
                                <span id="row-new"></span>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="18">
                                        <button type="button" class="form-control btn-default" onclick="addBarisInn()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        <input type="hidden" id="countRow2" value="{{$no}}">
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>
                        *Centang KKP jika menggunakan Kartu Kredit Pemerintah
                   </div>
    
                </div>
        </div>
    </div>
</div>

