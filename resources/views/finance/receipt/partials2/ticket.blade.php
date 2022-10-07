<div class="tab-pane" id="tab-ticket">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table id="myTable" class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NO</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Jenis</th>
                                    <th class="text-center">Nama Maskapai</th>
                                    <th class="text-center">KKP</th>   
                                    <th class="text-center">Nomor Tiket</th>
                                    <th class="text-center">Harga Tiket (Rp)</th>
                                    <th class="text-center">Tgl Pergi</th>
                                    <th class="text-center">Kode Booking</th>
                                    <th class="text-center">No. Perjalanan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($uangplane as $item3)
                                <tr id="{{$no}}">
                                    <td>{{$no}}</td>
                                    <td>
                                        <select name="outst_employee_id_P[]" class="form-control select2"  style="width: 180px;">
                                            <option value="">Pilih nama Pegawai</option>
                                            @foreach ($peg as $item)
                                                @if ($item->id == $item3->outst_employee_id)
                                                    <option value="{{$item->id}}" selected>{{$item->pegawai->name}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->pegawai->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="barisP[]" value="{{$no}}">
                                    </td>
                                    <td>
                                        <select name="planetype[]">
                                            @if ($item3->planetype == "Pesawat")
                                                <option value="Pesawat" selected>Pesawat</option>
                                                <option value="Kereta">Kereta</option>
                                                <option value="Bus">Bus</option>
                                                <option value="Kapal/Feri">Kapal/Feri</option>
                                            @elseif ($item3->planetype == "Kereta")
                                                <option value="Pesawat">Pesawat</option>
                                                <option value="Kereta" selected>Kereta</option>
                                                <option value="Bus">Bus</option>
                                                <option value="Kapal/Feri">Kapal/Feri</option>
                                            @elseif ($item3->planetype == "Bus")
                                                <option value="Pesawat">Pesawat</option>
                                                <option value="Kereta">Kereta</option>
                                                <option value="Bus" selected>Bus</option>
                                                <option value="Kapal/Feri">Kapal/Feri</option>
                                            @else
                                                <option value="Pesawat">Pesawat</option>
                                                <option value="Kereta">Kereta</option>
                                                <option value="Bus">Bus</option>
                                                <option value="Kapal/Feri" selected>Kapal/Feri</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <select name="plane_id[]" class="form-control select2" style="width: 150px;">
                                        @foreach ($plane as $item)
                                            @if ($item->id == $item3->plane_id)
                                                <option value="{{$item->id}}" selected>{{$item->code}} - {{$item->name}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </td>
                                    <td style="text-align: center">
                                        @if ($item3->planekkp == 'Y')
                                            <input type="checkbox" name="planekkp_{{$no}}" value="Y" checked>
                                        @else
                                            <input type="checkbox" name="planekkp_{{$no}}" value="Y">
                                        @endif
                                    </td>
                                    <td><input type="text" class="form-control" name="ticketnumber[]" style="width: 130px;" value="{{$item3->ticketnumber}}"></td>
                                    <td><input type="number" class="form-control" name="ticketfee[]" style="width: 130px;" value="{{$item3->ticketfee}}" min="0"></td>
                                    <td><input type="date"  class="form-control" name="ticketdate[]" value="{{$item3->ticketdate}}"/></td>
                                    <td><input type="text" class="form-control" name="bookingcode[]" style="width: 130px;" value="{{$item3->bookingcode}}"></td>
                                    <td><input type="text" class="form-control" name="flightnumber[]" style="width: 130px;" value="{{$item3->flightnumber}}"></td>
                                    <td>
                                        <a href="#" class="btn btn-danger deleteplane"
                                            r-name="{{$item3->planetype}}" 
                                            r-id="{{$item3->id}}">
                                            <i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                @php $no++; @endphp
                                @endforeach
                                <span id="row-new"></span>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <button type="button" class="form-control btn-default" onclick="addBarisPlane()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        <input type="hidden" id="countRow" value="{{$no}}">
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