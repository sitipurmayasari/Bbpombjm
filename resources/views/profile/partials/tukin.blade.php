<div class="tab-pane" id="tab-tukin">
    <div class="row">
        <div class="col-md-12" id="daftar-pengalaman">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Tunjangan Kinerja</h3></div>
                <div class="panel-body">
                   <div class="col-md-12">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <th class="text-left col-md-1">No</th>
                            <th class="text-center col-md-2">No. Tunjangan</th>
                            <th class="text-center col-md-3">Bulan / Tahun</th>
                            <th class="text-center col-md-3">Potongan (Rp)</th>
                            <th class="text-center col-md-2">Terima (Rp)</th>
                            </thead>
                            <tbody>
                                @foreach($tukin as $key=>$row)
                                <tr>
                                    <td>{{$tukin->firstItem() + $key}}</td>
                                    <td>{{$row->nomor}}</td>
                                    <td>
                                        @php
                                        $a = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                         "September", "Oktober", "November", "Desember","Tunjangan Hari Raya","Gaji Ke-13");

                                        echo $a[$row->bulan]."&nbsp; ".$row->tahun;
                                        
                                        @endphp                                    
                                    </td>
                                    <td>{{$row->potonganRp}}</td>
                                    <td>{{$row->terima}}</td>
                                </tr>
                              
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>