<div class="tab-pane" id="tab-pengalaman-kerja">
    <div class="row">
        <div class="col-md-12" id="daftar-pengalaman">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Pengalaman Kerja</h3></div>
                <div class="panel-body">
                   <div class="col-md-12">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <th class="text-left col-md-1">NO</th>
                            <th class="text-center col-md-2">Tanggal Kerja</th>
                            <th class="text-center col-md-3">Instansi</th>
                            <th class="text-center col-md-2">Jabatan</th>
                            <th class="text-center col-md-2">Masa Kerja (thn)</th>
                            <th class="text-center col-md-2">Aksi</th>
                            </thead>
                            <tbody id="isi-pengalaman"  style="text-align: center;">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <button type="button" class="form-control btn-default"  id="Addata-pengalaman">
                                        <i class="glyphicon glyphicon-plus"></i>TAMBAH PENGALAMAN KERJA</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-12" id="tambah-pengalaman">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Tambah Pengalaman Kerja</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal validate-form" role="form" 
                    method="post" action="{{route('pengalaman.store')}}">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                    <fieldset>
                        <input type="text" name="users_id" class="jenjuser" hidden value="{{$data->id}}"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Instansi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nama Instansi" class="col-xs-10 col-sm-10 required " 
                                name="instansi"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Mulai Kerja
                            </label>
                            <div class="col-sm-8">
                                <input type="date"  placeholder="nama" class="col-xs-3 col-sm-3 required " 
                                name="tgl_mulai"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Akhir Kerja
                            </label>
                            <div class="col-sm-8">
                                <input type="date"  placeholder="nama" class="col-xs-3 col-sm-3 required " 
                                name="tgl_selesai"/>
                            </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jabatan Terakhir
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nama jabatan" class="col-xs-10 col-sm-10 required " 
                                name="jabatan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Masa Kerja (THN)
                            </label>
                            <div class="col-sm-8">
                                <input type="number"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                name="lama_thn" />
                            </div>
                        </div>
                       
                    </fieldset>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-actions right">
                            <button class="btn btn-success btn-sm " type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                            </button>
                            <button class="btn btn-success btn-sm kembaliPengalaman" type="button">
                                <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-12" id="edit-pengalaman">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Ubah Pengalaman Kerja</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal validate-form" role="form" id="formubah-pengalaman"
                    method="post" action="" >
                    {{ csrf_field() }}
                    <div class="col-md-12">
                    <fieldset>
                        <input type="text" name="users_id" class="jenjuser" hidden value="{{$data->id}}"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Instansi
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nama Instansi" class="col-xs-10 col-sm-10 required " 
                                id="editins"     name="instansi"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Mulai Kerja
                            </label>
                            <div class="col-sm-8">
                                <input type="date"  placeholder="nama" class="col-xs-10 col-sm-10 required " id="edittmk"
                                name="tgl_mulai"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Akhir Kerja
                            </label>
                            <div class="col-sm-8">
                                <input type="date"  placeholder="nama" class="col-xs-10 col-sm-10 required " id="edittsk"
                                name="tgl_selesai"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jabatan Terakhir
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nama jabatan" class="col-xs-10 col-sm-10 required "  id="editjab"
                                name="jabatan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Masa Kerja (THN)
                            </label>
                            <div class="col-sm-8">
                                <input type="number"  placeholder="nama" class="col-xs-10 col-sm-10 required " id="edittahun"
                                name="lama_thn" />
                            </div>
                        </div>
                    </fieldset>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-actions right">
                            <button class="btn btn-success btn-sm " type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>Update
                            </button>
                            <button class="btn btn-success btn-sm kembaliPengalaman" type="button">
                                <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>