<div class="tab-pane" id="tab-transport">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table id="myTable" class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" rowspan="2">NO</th>
                                    <th class="text-center" rowspan="2">Nama Pegawai</th>
                                    <th class="text-center" rowspan="2">BBM</th>
                                    <th class="text-center" colspan="4">Taxi</th>
                                </tr>
                                <tr>
                                    <th class="text-center col-md-2">Taxi Kota Asal</th>
                                    <th>Biaya taxi Kota Asal</th>
                                    <th class="text-center col-md-2">Taxi Kota Tujuan</th>
                                    <th>Biaya Taxi Kota Tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="cell-1">
                                    <td style="text-align: center;">
                                        1
                                    </td>
                                    <td>
                                        <input type="text" readonly id="nama2"
                                        name="nama2" required/>
                                    </td>
                                    <td>
                                        <input type="number" min="0" value="0"
                                        name="bbm" required/>
                                    </td>
                                    <td>
                                        <input type="number" min="0" value="0"
                                        name="bbm" required/>
                                    </td>
                                    <td>
                                        <input type="number" min="0" value="0"
                                        name="taxy_count_from" required/>
                                    </td>
                                    <td>
                                        <input type="number" min="0" value="0"
                                        name="taxy_fee_from" required/>
                                    </td>
                                    <td>
                                        <input type="number" min="0" value="0"
                                        name="taxy_count_to" required/>
                                    </td>
                                    <td>
                                        <input type="number" min="0" value="0"
                                        name="taxy_fee_to" required/>
                                    </td>
                                </tr>
                                <span id="row-new"></span>
                            </tbody>
                        </table>
                   </div>
    
                </div>
        </div>
    </div>
</div>


