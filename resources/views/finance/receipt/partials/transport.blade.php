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
                                <span id="row-new"></span>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9">
                                        <button type="button" class="form-control btn-default" onclick="addBarisTaxi()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        <input type="hidden" id="countRow3" value="0">
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>
                   </div>
    
                </div>
        </div>
    </div>
</div>

