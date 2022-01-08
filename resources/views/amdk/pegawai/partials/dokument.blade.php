<div class="tab-pane" id="tab-dokument">
    <div class="row">
     
        <div class="col-md-12" id="daftar-dokument">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Data Dokumen Pendukung</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <th class="text-left col-md-1">No</th>
                                <th class="text-center col-md-2">Jenis</th>
                                <th class="text-center col-md-2">Nomor Dokumen</th>
                                <th class="text-center col-md-2">Tanggal Dokumen</th>
                                <th class="text-center col-md-3">Upload File</th>
                                <th class="text-center col-md-2">Aksi</th>
                            </thead>
                            <tbody id="isiDokument"  style="text-align: center;">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <button type="button" class="form-control btn-default"  id="AddataDokument">
                                        <i class="glyphicon glyphicon-plus"></i>TAMBAH DOKUMEN PENDUKUNG</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-12" id="tambah-dokument">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Tambah Dokumen Pendukung</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal validate-form" role="form" 
                    method="post" action="{{route('dokumen.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                    <fieldset>
                        <input type="text" name="users_id" class="jenjuser" hidden/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Dokumen
                            </label>
                            <div class="col-sm-8">
                                <select name="jendok_id" class="col-xs-10 col-sm-10 required" >
                                    <option value="">Pilih jenis Dokumen</option>
                                    @foreach ($jenis as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
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
                            <button class="btn btn-success btn-sm kembaliDokument" type="button">
                                <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-12" id="edit-dokument">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Ubah Dokumen Pendukung</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal validate-form" role="form" id="formubah-dokument"
                    method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                    <fieldset>
                        <input type="text" name="users_id" class="jenjuser" hidden value="{{$data->id}}"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenis Dokumen
                            </label>
                            <div class="col-sm-8">
                                <select name="jendok_id" class="col-xs-10 col-sm-10 required" 
                                id="editjen">
                                    <option value="">Pilih jenis Dokumen</option>
                                    @foreach ($jenis as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nomor Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="text" id="editno"  placeholder="nomor dokumen" class="col-xs-10 col-sm-10 required " required
                                name="nomor" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tanggal Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="date" id="edittgl" class="col-xs-10 col-sm-10 required " required
                                name="tanggal" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Upload Dokumen
                            </label>
                            <div class="col-sm-8">
                                <input type="file" name="upload" class="btn btn-default btn-sm" id="editupt" value="Upload Foto Dokumen" required>      
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
                            <button class="btn btn-success btn-sm kembaliDokument" type="button">
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