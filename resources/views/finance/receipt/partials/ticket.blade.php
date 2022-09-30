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
                                <span id="row-new"></span>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <button type="button" class="form-control btn-default" onclick="addBarisPlane()">
                                            <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        <input type="hidden" id="countRow" value="0">
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