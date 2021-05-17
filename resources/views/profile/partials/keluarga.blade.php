<div class="tab-pane active" id="tab-keluarga">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <input type="hidden" id="user_id" value="{{$data->id}}">
    
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#OrangTua" data-toggle="tab">OrangTua</a></li>
                            <li><a href="#Pasangan" data-toggle="tab">Pasangan</a></li>
                            <li class="mer"><a href="#Mertua" data-toggle="tab">Mertua</a></li>
                            <li class="aa tabanak"><a href="#Anak" data-toggle="tab">Anak</a></li>
                            <li class="ta tabanak"><a href="#TambahAnak" data-toggle="tab">Anak</a></li>
                            <li class="ua tabanak"><a href="#UbahAnak" data-toggle="tab">Anak</a></li>
                            <li class="af"><a href="#Family" data-toggle="tab">Saudara</a></li>
                            <li class="tf"><a href="#TambahSaudara" data-toggle="tab">Saudara</a></li>
                            <li class="uf"><a href="#UbahSaudara" data-toggle="tab">Saudara</a></li>
                        </ul>
    
                        <div class="tab-content">
                            <div class="tab-pane active" id="OrangTua">
                                <div class="row">
                                    <form class="form-horizontal validate-form" role="form" method="post" 
                                    action="{{Route('keluarga.storeortu')}}">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Data Ayah</h3>
                                            </div>
                                            <div class="panel-body">
                                                <input type="hidden" name="profile" value="true">
                                                <input type="text" name="users_id" class="jenjuser" hidden/>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        name="nama_ayah" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="t_lhr_ayah" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="tgl_lhr_ayah" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_ayah" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Alamat
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                                        name="alamat_ayah"></textarea>
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> No. telp
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  placeholder="telp" class="col-xs-10 col-sm-10 required " 
                                                        name="telp_ayah" />
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Data Ibu</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        name="nama_ibu" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="t_lhr_ibu" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="tgl_lhr_ibu" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_ibu" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Alamat
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                                        name="alamat_ibu"></textarea>
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> No. telp
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  placeholder="telp" class="col-xs-10 col-sm-10 required " 
                                                        name="telp_ibu" />
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-actions right">
                                            <button class="btn btn-success btn-sm " type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="Pasangan">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-body">
                                                <form class="form-horizontal validate-form" role="form" method="post" 
                                                action="{{Route('keluarga.storeistri')}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="profile" value="true">
                                                <input type="text" name="users_id" class="jenjuser" hidden/>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        name="nama_psg" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="tempat_lhr_psg" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="tgl_lhr_psg" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal menikah
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="tgl_nikah_psg" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> No. Buku Nikah
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="no. nikah" class="col-xs-10 col-sm-10 required" 
                                                        name="no_buku_nikah_psg" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Pendidikan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select name="jurusan_id_psg" class="col-xs-10 col-sm-10 required">
                                                            <option value="">Pilih Pendidikan</option>
                                                            @foreach ($pend as $item)
                                                                <option value="{{$item->id}}">{{$item->jenjang->jenjang}} || {{$item->jurusan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
            
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> PNS
                                                    </label>
                                                    <div class="col-sm-1">
                                                        <input type="checkbox" class="col-xs-10 col-sm-10 required"  
                                                        name="PNS_psg" value="Y">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tunjangan
                                                    </label>
                                                    <div class="col-sm-1">
                                                        <input type="checkbox" class="col-xs-10 col-sm-10 required"  
                                                        name="tunjangan_psg" value="Y">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_psg" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> No. telp
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="number"  placeholder="telp" class="col-xs-10 col-sm-10 required " 
                                                        name="telp_psg" />
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-actions right">
                                            <button class="btn btn-success btn-sm " type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="Mertua">
                                <div class="row">
                                    <form class="form-horizontal validate-form" role="form" method="post" 
                                                action="{{Route('keluarga.storemertua')}}">
                                                {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Data Ayah Mertua</h3>
                                            </div>    
                                            <div class="panel-body">
                                                <input type="hidden" name="profile" value="true">
                                                <input type="text" name="users_id" class="jenjuser" hidden/>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        name="nama_ayah_m" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="tempat_lhr_ayah_m" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="tgl_lhr_ayah_m" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_ayah_m" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Alamat
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                                        name="alamat_ayah_m"></textarea>
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> No. telp
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="number"  placeholder="telp" class="col-xs-10 col-sm-10 required " 
                                                        name="telp_ayah_m" />
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Data Ibu Mertua</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        name="nama_ibu_m" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="tempat_lhr_ibu_m" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="tgl_lhr_ibu_m" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_ibu_m" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> Alamat
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                                        name="alamat_ibu_m"></textarea>
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" 
                                                    for="form-field-1"> No. telp
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="number"  placeholder="telp" class="col-xs-10 col-sm-10 required " 
                                                        name="telp_ibu_m" />
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-actions right">
                                            <button class="btn btn-success btn-sm " type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="Anak">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Data Anak</h3>
                                            </div>
                                            <div class="panel-body">
                                                <table id="myTable" class="table table-bordered table-hover text-center">
                                                    <thead>
                                                        <th class="text-center ">NO</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center ">Tempat Lahir</th>
                                                        <th class="text-center ">tanggal Lahir</th>
                                                        <th class="text-center col-md-1">L/P</th>
                                                        <th class="text-center ">Status</th>
                                                        <th class="text-center ">Pendidikan</th>
                                                        <th class="text-center ">Pekerjaan</th>
                                                        <th class="text-center ">Tunjangan</th>
                                                        <th class="text-center col-md-1">Aksi</th>
                                                    </thead>
                                                    <tbody id="isianak">
                                                       
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="10">
                                                                <button type="button" class="form-control btn-default" 
                                                                onclick="addAnak()" id="addanak">
                                                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH ANAK</button>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="TambahAnak">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal validate-form" role="form" method="post" 
                                                action="{{Route('keluarga.storeanak')}}">
                                                {{ csrf_field() }}
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Tambah Data Anak</h3>
                                            </div>
                                            <div class="panel-body">
                                                <input type="hidden" name="profile" value="true">
                                                <input type="text" name="users_id" class="jenjuser" hidden/>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        name="nama_anak" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="tempat_lhr_anak" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="tgl_lhr_anak" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Jenis Kelamin
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="radio" name="jkel_anak" value="L">
                                                        <label for="L">Laki - Laki</label><br>
                                                        <input type="radio" name="jkel_anak" value="P">
                                                        <label for="P">perempuan</label><br>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Status Anak
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select name="status_anak">
                                                            <option value="Anak Kandung">Anak Kandung</option>
                                                            <option value="Anak Tiri">Anak Tiri</option>
                                                            <option value="Anak Angkat">Anak Angkat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tunjangan
                                                    </label>
                                                    <div class="col-sm-1">
                                                        <input type="checkbox" class="col-xs-10 col-sm-10 required"  
                                                        name="tunjangan_anak" value="Y">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Jenjang Pendidikan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select name="pendidikan_id_anak" class="col-xs-10 col-sm-10 required" 
                                                        id="jenj" onchange="myFunction()">
                                                            @foreach ($jenjang as $item)
                                                                <option value="{{$item->id}}">{{$item->jenjang}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="jur">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Jurusan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select name="jurusan_id_anak" class="col-xs-10 col-sm-10 required">
                                                            <option value="">Pilih Jurusan</option>
                                                            @foreach ($pend as $item)
                                                                <option value="{{$item->id}}">{{$item->jenjang->jenjang}} || {{$item->jurusan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_anak" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-actions right">
                                            <button class="btn btn-success btn-sm " type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                                            </button>
                                            <button class="btn btn-success btn-sm kembaliAnak" type="button">
                                                <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="UbahAnak">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal validate-form" role="form" id="formubah-anak"
                                        method="post" action="" >
                                        {{ csrf_field() }}
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Ubah Data Anak</h3>
                                            </div>
                                            <div class="panel-body">
                                                <input type="hidden" name="profile" value="true">
                                                <input type="text" name="users_id" class="jenjuser" hidden/>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        name="nama_anak" id="UbahNamaAnak"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="tempat_lhr_anak" id="UbahTLahirAnak"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="tgl_lhr_anak" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker" id="UbahTglLhrAnak">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Jenis Kelamin
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="radio" name="jkel_anak" value="L" id="anakL">
                                                        <label for="L">Laki - Laki</label><br>
                                                        <input type="radio" name="jkel_anak" value="P" id="anakP">
                                                        <label for="P">perempuan</label><br>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Status Anak
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select name="status_anak" id="UbahStatusAnak">
                                                            <option value="Anak Kandung">Anak Kandung</option>
                                                            <option value="Anak Tiri">Anak Tiri</option>
                                                            <option value="Anak Angkat">Anak Angkat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tunjangan
                                                    </label>
                                                    <div class="col-sm-1">
                                                        <input type="checkbox" class="col-xs-10 col-sm-10 required"  
                                                        name="tunjangan_anak" value="Y" id="UbahTunjAnak">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Jenjang Pendidikan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select name="pendidikan_id_anak" class="col-xs-10 col-sm-10 required" 
                                                        id="UbahJenjAnak" onchange="myFunction()">
                                                            @foreach ($jenjang as $item)
                                                                <option value="{{$item->id}}">{{$item->jenjang}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="jur">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Jurusan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select name="jurusan_id_anak" class="col-xs-10 col-sm-10 required" id="UbahJurAnak">
                                                            <option value="">Pilih Jurusan</option>
                                                            @foreach ($pend as $item)
                                                                <option value="{{$item->id}}">{{$item->jenjang->jenjang}} || {{$item->jurusan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_anak" id="UbahKerAnak" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-actions right">
                                            <button class="btn btn-success btn-sm " type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>Update
                                                </button>
                                                <button class="btn btn-success btn-sm kembaliAnak" type="button">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                                                </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="Family">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Data Saudara</h3>
                                            </div>
                                            <div class="panel-body">
                                                <table  id="myTable" class="table table-bordered table-hover text-center ">
                                                    <thead>
                                                        <th class="text-center ">No</th>
                                                        <th class="text-center ">Nama</th>
                                                        <th class="text-center ">Tempat Lahir</th>
                                                        <th class="text-center ">Tanggal Lahir</th>
                                                        <th class="text-center ">L/P</th>
                                                        <th class="text-center ">Alamat</th>
                                                        <th class="text-center ">Pekerjaan</th>
                                                        <th class="text-center ">No. Telp</th>
                                                        <th class="text-center">Aksi</th>
                                                    </thead>
                                                    <tbody id="isifam">
                                                       
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="10">
                                                                <button type="button" class="form-control btn-default" 
                                                                onclick="AddFam()" id="addfam">
                                                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH SAUDARA</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="TambahSaudara">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Tambah Data Saudara</h3>
                                            </div>
                                            <form class="form-horizontal validate-form" role="form" method="post" 
                                            action="{{Route('keluarga.storesaudara')}}">
                                            {{ csrf_field() }}
                                            <div class="panel-body">
                                                <input type="hidden" name="profile" value="true">
                                                <input type="text" name="users_id" class="jenjuser" hidden/>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        name="nama_saudara" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="tempat_lhr_saudara" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="tgl_lhr_saudara" readonly class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Jenis Kelamin
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="radio" name="jkel_saudara" value="L">
                                                        <label for="L">Laki - Laki</label><br>
                                                        <input type="radio"  name="jkel_saudara" value="P">
                                                        <label for="P">perempuan</label><br>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_saudara" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Alamat
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <textarea  placeholder="" class="col-xs-10 col-sm-10"  
                                                        name="alamat_saudara"></textarea>
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> No. telp
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  placeholder="telp" class="col-xs-10 col-sm-10 required " 
                                                        name="telp_saudara" />
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-actions right">
                                            <button class="btn btn-success btn-sm " type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                                            </button>
                                            <button class="btn btn-success btn-sm kembaliFam" type="button">
                                                <i class="ace-icon fa fa-undo bigger-110"></i>Kembali
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="UbahSaudara">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Ubah Data Saudara</h3>
                                            </div>
                                            <form class="form-horizontal validate-form" role="form" id="formubah-saudara"
                                            method="post" action="" >
                                            {{ csrf_field() }}
                                            <div class="panel-body">
                                                <input type="hidden" name="profile" value="true">
                                                <input type="text" name="users_id" class="jenjuser" hidden/>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Nama
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="nama" class="col-xs-10 col-sm-10 required " 
                                                        id="namasau" name="nama_saudara" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tempat Lahir
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="tempat kelahiran" class="col-xs-10 col-sm-10 
                                                        required " name="tempat_lhr_saudara" id="tlsau" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Tanggal Lahir
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="tgl_lhr_saudara" class="col-xs-10 col-sm-10 required" 
                                                         data-date-format="yyyy-mm-dd" data-provide="datepicker" id="tgllhrsau">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Jenis Kelamin
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="radio" name="jkel_saudara" value="L" id="jkelsauL">
                                                        <label for="L">Laki - Laki</label><br>
                                                        <input type="radio"  name="jkel_saudara" value="P" id="jkelsauP">
                                                        <label for="P">perempuan</label><br>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Pekerjaan
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  placeholder="Pekerjaan" class="col-xs-10 col-sm-10 required " 
                                                        name="pekerjaan_saudara" id="kersau"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> Alamat
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <textarea  placeholder="" class="col-xs-10 col-sm-10"  id="alasau"
                                                        name="alamat_saudara"></textarea>
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" 
                                                    for="form-field-1"> No. telp
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  placeholder="telp" class="col-xs-10 col-sm-10 required " 
                                                        name="telp_saudara" id="telpsau"/>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-actions right">
                                            <button class="btn btn-success btn-sm " type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>Update
                                            </button>
                                            <button class="btn btn-success btn-sm kembaliFam" type="button">
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
        </div>
    </div>
</div>


