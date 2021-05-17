<div class="tab-pane" id="tab-dokpeg">
    <div class="row">
     
        <div class="col-md-12" id="daftar-dokpeg">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Data Dokumen Kepegawaian</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <th class="text-left col-md-1">No</th>
                                <th class="text-center col-md-1">Jenis</th>
                                <th class="text-center col-md-2">Nomor Dokumen</th>
                                <th class="text-center col-md-2">Tanggal Dokumen</th>
                                <th class="text-center col-md-2">Keterangan</th>
                                <th class="text-center col-md-1">TMT</th>
                                <th class="text-center col-md-3">Upload File</th>
                                <th class="text-center col-md-2">Aksi</th>
                            </thead>
                            <tbody id="isidokpeg"  style="text-align: center;">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <button type="button" class="form-control btn-default"  id="AddataDokpeg">
                                        <i class="glyphicon glyphicon-plus"></i>TAMBAH DOKUMEN KEPEGAWAIAN</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-12" id="tambah-dokpeg">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Tambah Dokumen Kepegawaian</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal validate-form" role="form" 
                    method="post" action="{{route('dokpeg.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                    <fieldset>
                        <input type="hidden" name="profile" value="true">
                        <input type="text" name="users_id" class="jenjuser" hidden/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Dokumen
                            </label>
                            <div class="col-sm-8">
                                <select name="jendok_id" class="col-xs-10 col-sm-10 required optionjendok">
                                    <option value="">Pilih jenis Dokumen</option>
                                    <option value="1">SK CPNS</option>
                                    <option value="2">SK PNS</option>
                                    <option value="3">SK KENAIKAN JABATAN</option>
                                    <option value="4">SK KENAIKAN PANGKAT & GOLONGAN</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nomor dokumen" class="col-xs-10 col-sm-10 required " 
                                name="nomor" id="nomor"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="date" class="col-xs-10 col-sm-10 required " 
                                name="tanggal" />
                            </div>
                        </div>
                        <div class="form-group namapangkat">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Pangkat / Jabatan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="col-xs-10 col-sm-10 required " 
                                name="keterangan" />
                            </div>
                        </div>
                        <div class="form-group namatmt">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> TMT
                            </label>
                            <div class="col-sm-8">
                                <input type="date" class="col-xs-10 col-sm-10 required " 
                                name="tmt" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Upload Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="file" name="upload" class="btn btn-default btn-sm" id="" value="Upload Foto Dokumen">      
                                <label><i>ex:Lorem_ipsum.jpg/png/jpeg</i></label>
                            </div>
                        </div>
                        
                    </fieldset>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-actions right">
                            <button class="btn btn-success btn-sm " type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                            </button>
                            <button class="btn btn-success btn-sm kembaliDokpeg" type="button">
                                <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-12" id="edit-dokpeg">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Ubah Dokumen Kepegawaian</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal validate-form" role="form" id="formubah-dokpeg"
                    method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                    <fieldset>
                        <input type="hidden" name="profile" value="true">
                        <input type="text" name="users_id" class="jenjuser" hidden value="{{$data->id}}"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Dokumen
                            </label>
                            <div class="col-sm-8">
                                <select name="jendok_id" class="col-xs-10 col-sm-10 required optionjendok" id="jendokpeg">
                                    <option value="">Pilih jenis Dokumen</option>
                                    <option value="1">SK CPNS</option>
                                    <option value="2">SK PNS</option>
                                    <option value="3">SK KENAIKAN JABATAN</option>
                                    <option value="4">SK KENAIKAN PANGKAT & GOLONGAN</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nomor dokumen" class="col-xs-10 col-sm-10 required " 
                                name="nomor" id="nodokpeg"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="date" class="col-xs-10 col-sm-10 required " id="tgldokpeg"
                                name="tanggal" />
                            </div>
                        </div>
                        <div class="form-group namapangkat">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Pangkat / Jabatan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="col-xs-10 col-sm-10 required " id="naikpeg"
                                name="keterangan" />
                            </div>
                        </div>
                        <div class="form-group namatmt">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> TMT
                            </label>
                            <div class="col-sm-8">
                                <input type="date" class="col-xs-10 col-sm-10 required " id="tmtpeg"
                                name="tmt" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Upload Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="file" name="upload" class="btn btn-default btn-sm" id="edituptdok" value="Upload Foto Dokumen" required>      
                                <label><i>ex:Lorem_ipsum.jpg/png/jpeg</i></label>
                            </div>
                        </div>
                    </fieldset>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-actions right">
                            <button class="btn btn-success btn-sm " type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>Update
                            </button>
                            <button class="btn btn-success btn-sm kembaliDokpeg" type="button">
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