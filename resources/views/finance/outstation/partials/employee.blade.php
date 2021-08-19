<div class="tab-pane active" id="tab-employee">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table id="myTable" class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NO</th>
                                    <th class="text-center col-md-4">Nama</th>
                                    <th> Uang Harian</th>
                                    <th> Uang Diklat</th>
                                    <th> Upah Harian FB</th>
                                    <th> Upah Harian FBHD</th>
                                    <th> Upah Harian FBFD </th>
                                    <th>Uang Representatif</th>
                                    <th class="text-center col-md-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="cell-1">
                                    <td style="text-align: center;">
                                        1
                                    </td>
                                    <td>
                                        <select name="users_id[]" class="form-control select2" required>
                                            <option value="">-Pilih-</option>
                                            @foreach ($user as $item)
                                                <option value="{{$item->id}}">{{$item->name}} | {{$item->no_pegawai}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="dailywage" value="Y">
                                        <label> Ya</label><br>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="dailywageDKLT" value="Y">
                                        <label> Ya</label><br>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="dailymeal" value="Y">
                                        <label> Ya</label><br>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="taxi" value="Y">
                                        <label> Ya</label><br>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="taxi" value="Y">
                                        <label> Ya</label><br>
                                    </td>
                                    <td>
                                        <input type="number" min="0" name="representatif" value="0"/>
                                    </td>
                                    <td>
                                        {{-- <button type="button"  class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button> --}}
                                    </td>
                                </tr>
                                <span id="row-new"></span>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        <input type="hidden" id="countRow" value="1">
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>
                   </div>
    
                </div>
        </div>
    </div>
</div>


