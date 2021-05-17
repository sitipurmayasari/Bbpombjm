<div class="tab-pane" id="tab-riwayat-pendidikan">
    <div class="row">
      
        <div class="col-md-12" id="daftar">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Daftar Riwayat Pendidikan</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <th class="text-left col-md-1">NO</th>
                                <th class="text-center col-md-2">Pendidikan</th>
                                <th class="text-center col-md-2">Jurusan</th>
                                <th class="text-center col-md-3">Nama Sekolah</th>
                                <th class="text-center col-md-3">Alamat Sekolah</th>
                                <th class="text-center col-md-1">Tahun Lulus</th>
                                <th class="text-center col-md-2">Aksi</th>
                            </thead>
                            <tbody id="isi"  style="text-align: center;">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <button type="button" class="form-control btn-default" onclick="Addata()" id="Addata">
                                        <i class="glyphicon glyphicon-plus"></i>TAMBAH DATA PENDIDIKAN</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-12" id="tambah">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Tambah Riwayat Pendidikan</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal validate-form" role="form" 
                    method="post" action="{{route('riwayatpend.store')}}">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                    <fieldset>
                        <input type="text" name="users_id" class="jenjuser" value="{{$data->id}}" hidden/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenjang Pendidikan
                            </label>
                            <div class="col-sm-8">
                                <select name="pendidikan_id" class="col-xs-10 col-sm-10 required" 
                                id="jenj" onchange="pend()">
                                    <option value="">Pilih Jenjang Pendidikan</option>
                                    @foreach ($jenjang as $item)
                                        <option value="{{$item->id}}">{{$item->jenjang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jurusan
                            </label>
                            <div class="col-sm-8">
                                <select name="jurusan_id" class="col-xs-10 col-sm-10 required">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($pend as $item)
                                        <option value="{{$item->id}}"> {{$item->jurusan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Sekolah
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                name="nama_sekolah" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Alamat Sekolah
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                    name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tahun Lulus
                            </label>
                            <div class="col-sm-8">
                                <select name="thn_lulus" class="col-xs-10 col-sm-10">
                                    <option value="">Pilih Tahun Kelulusan</option>
                                    <?php
                                        $now=date('Y');
                                        for ($a=1970;$a<=$now;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-actions right">
                            <button class="btn btn-success btn-sm " type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                            </button>
                            <button class="btn btn-success btn-sm kembali" type="button">
                                <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-12" id="edit">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Ubah Riwayat Pendidikan</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal validate-form" role="form" id="formubah"
                    method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                    <fieldset>
                        <input type="text" name="users_id" class="jenjuser" hidden/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jenjang Pendidikan
                            </label>
                            <div class="col-sm-8">
                                <select name="pendidikan_id" class="col-xs-10 col-sm-10 required" 
                                id="editjenj" onchange="pend()">
                                    <option value="">Pilih Jenjang Pendidikan</option>
                                    @foreach ($jenjang as $item)
                                        <option value="{{$item->id}}">{{$item->jenjang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Jurusan
                            </label>
                            <div class="col-sm-8">
                                <select name="jurusan_id" class="col-xs-10 col-sm-10 required" id="editjur">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($pend as $item)
                                        <option value="{{$item->id}}"> {{$item->jurusan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Sekolah
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " id="editns" 
                                name="nama_sekolah" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right"  
                            for="form-field-1"> Alamat Sekolah
                            </label>
                            <div class="col-sm-8">
                                <textarea  placeholder="" class="col-xs-10 col-sm-10" id="editalt" 
                                    name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Tahun Lulus
                            </label>
                            <div class="col-sm-8">
                                <select name="thn_lulus" class="col-xs-10 col-sm-10" id="editthnlul">
                                    <option value="">Pilih Tahun Kelulusan</option>
                                    <?php
                                        $now=date('Y');
                                        for ($a=1970;$a<=$now;$a++)
                                        {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-actions right">
                            <button class="btn btn-success btn-sm " type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>Update
                            </button>
                            <button class="btn btn-success btn-sm kembali" type="button">
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