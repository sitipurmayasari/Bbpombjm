<div class="tab-pane" id="tab-driver">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table id="myTable" class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center; ">NO</th>
                                    <th class="text-center">Kendaraan Dinas</th>
                                    <th  class="text-center">Nomor Polisi</th>
                                    <th class="text-center">Driver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                     <td tyle="text-align: center;" id="cell-4">
                                        1
                                     </td>
                                     <td tyle="text-align: center;">
                                        <select name="car_id" id="car_id" class="form-control">
                                            <option value="">Pilih Kendaraan Dinas</option>
                                            @foreach ($car as $item)
                                                <option value="{{$item->id}}">{{$item->code}} - {{$item->type}} - {{$item->merk}}</option>
                                            @endforeach
                                        </select>
                                     </td>
                                     <td tyle="text-align: center;">
                                        <label for="police_number"></label>
                                     </td>
                                     <td tyle="text-align: center;">
                                        <select name="driver" class="form-control">
                                            <option value="">Pilih Supir</option>
                                            @foreach ($driver as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                     </td>
                                </tr>
                            </tbody>
                        </table>
                   </div>
    
                </div>
        </div>
    </div>
</div>


