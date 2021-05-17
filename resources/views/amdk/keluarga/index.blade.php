@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li>Data Keluarga</li>
@endsection
@section('content')
@include('layouts.validasi')

<style>
    .menu{ 
        border: 1px solid black;
        padding: 20px;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Data keluarga</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="col-sm-12">
                    <div class="widget-main no-padding">
                        <fieldset>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" 
                            for="form-field-1"> Nama Pegawai
                            </label>
                            <div class="col-sm-8">
                                <select id="user_id" name="user_id" class="col-xs-10 col-sm-10 select2" onchange="getpeg();getKeluarga()">
                                        <option value="">Pilih Nama Pegawai</option>
                                    @foreach ($user as $peg)
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        </fieldset>        
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#OrangTua" data-toggle="tab">OrangTua</a></li>
                        <li><a href="#Pasangan" data-toggle="tab">Pasangan</a></li>
                        <li><a href="#Mertua" data-toggle="tab">Mertua</a></li>
                        <li class="aa"><a href="#Anak" data-toggle="tab">Anak</a></li>
                        <li class="ta"><a href="#TambahAnak" data-toggle="tab">Anak</a></li>
                        <li class="as"><a href="#Saudara" data-toggle="tab">Saudara</a></li>
                        <li class="ts"><a href="#TambahSaudara" data-toggle="tab">Saudara</a></li>
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
                                                        <option value="null">Pilih Pendidikan</option>
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
                            </div>
                        </div>
                        <div class="tab-pane" id="Mertua">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Data Ayah Mertua</h3>
                                        </div>
                                        <div class="panel-body">
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
                            </div>
                        </div>
                        <div class="tab-pane" id="Anak">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
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
                                    <div class="panel panel-success">
                                        <div class="panel-body">
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
                                                        <option value="null">Pilih Jurusan</option>
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
                            </div>
                        </div>
                        <div class="tab-pane" id="Saudara">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
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
                                                    <th class="text-center ">Kode Pos</th>
                                                    <th class="text-center">Aksi</th>
                                                </thead>
                                                <tbody id="isisaudara">
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
                                        <div class="panel-body">
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
                            </div>
                        </div>
                    </div>
               </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
     $().ready( function () {

        $(".ta").hide();
        $(".ts").hide();
        $("#jur").hide();
        $("#jenj").on("change", function(){
            var v = $(this).val();
            if(v==1 || v==2 || v==3){
                $("#jur").hide();
            }else{
                $("#jur").show();
            } 
        });
        
        $('#addfam').click(function () {
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
            $(".as").hide();
            $(".ts").show();
        });

        $('#addanak').click(function () {
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
            $(".aa").hide();
            $(".ta").show();
        });

      

        $(".deletesau").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/amdk/keluarga/deletesaudara/"+id;
                }
            });
        });

    } );


    function getpeg(){
        var user_id = $("#user_id").val();
    }

    function getKeluarga(){
        var user_id = $("#user_id").val();
        $(".jenjuser").val(user_id);

        $.get(
            "{{route('keluarga.getKeluarga') }}",
            {
                user_id: user_id
            },
            function(response) {
                // -----------------------ORANG TUA------------------------------------------
                document.getElementsByName("nama_ayah")[0].value = response.ortu.nama_ayah ;
                document.getElementsByName("nama_ibu")[0].value = response.ortu.nama_ibu ;
                document.getElementsByName("t_lhr_ayah")[0].value = response.ortu.t_lhr_ayah ;
                document.getElementsByName("t_lhr_ibu")[0].value = response.ortu.t_lhr_ibu ;
                document.getElementsByName("tgl_lhr_ayah")[0].value = response.ortu.tgl_lhr_ayah ;
                document.getElementsByName("tgl_lhr_ibu")[0].value = response.ortu.tgl_lhr_ibu ;
                document.getElementsByName("pekerjaan_ayah")[0].value = response.ortu.pekerjaan_ayah ;
                document.getElementsByName("pekerjaan_ibu")[0].value = response.ortu.pekerjaan_ibu ;
                document.getElementsByName("telp_ayah")[0].value = response.ortu.telp_ayah ;
                document.getElementsByName("telp_ibu")[0].value = response.ortu.telp_ibu ;
                document.getElementsByName("alamat_ayah")[0].value = response.ortu.alamat_ayah ;
                document.getElementsByName("alamat_ibu")[0].value = response.ortu.alamat_ibu ;


                 // -----------------------ANAK------------------------------------------

                var isianak="";
                for (let i = 0; i < response.anak.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isianak+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.anak[i].nama_anak+'</td>'+
                        '<td>'+response.anak[i].tempat_lhr_anak+'</td>'+
                        '<td>'+response.anak[i].tgl_lhr_anak+'</td>'+
                        '<td>'+response.anak[i].jkel_anak+'</td>'+
                        '<td>'+response.anak[i].status_anak+'</td>'+
                        '<td>'+response.anak[i].jenjang+'</td>'+
                        '<td>'+response.anak[i].pekerjaan_anak+'</td>'+
                        '<td>'+response.anak[i].tunjangan_anak+'</td>'+
                        '<td><button type="button"  class="btn btn-danger" onclick="deleteanak('+response.anak[i].itu+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                        
                    '</tr>';
                }
                $("#isianak").html(isianak);

                function deleteanak(id) {
                    var name = $(this).attr('r-name');
                    Swal.fire({
                        title: 'Ingin Menghapus?',
                        text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, hapus !'
                    }).then((result) => {
                        console.log(result);
                        if (result.value) {
                            window.location = "/amdk/keluarga/deleteanak/"+id;
                        }
                    });
                };

                 // -----------------------PASANGAN------------------------------------------
                 document.getElementsByName("nama_psg")[0].value = response.istri.nama_psg ;
                 document.getElementsByName("tempat_lhr_psg")[0].value = response.istri.tempat_lhr_psg ;
                 document.getElementsByName("tgl_lhr_psg")[0].value = response.istri.tgl_lhr_psg ;
                 document.getElementsByName("jurusan_id_psg")[0].value = response.istri.jurusan_id_psg ;
                
                 document.getElementsByName("tgl_nikah_psg")[0].value = response.istri.tgl_nikah_psg ;
                 document.getElementsByName("no_buku_nikah_psg")[0].value = response.istri.no_buku_nikah_psg ;
                 document.getElementsByName("PNS_psg")[0].value = response.istri.PNS_psg ;
                 document.getElementsByName("tunjangan_psg")[0].value = response.istri.tunjangan_psg ;
                 document.getElementsByName("pekerjaan_psg")[0].value = response.istri.pekerjaan_psg ;
                 document.getElementsByName("telp_psg")[0].value = response.istri.telp_psg ;
              

                 // -----------------------MERTUA------------------------------------------
                document.getElementsByName("nama_ayah_m")[0].value = response.mertua.nama_ayah_m ;
                document.getElementsByName("nama_ibu_m")[0].value = response.mertua.nama_ibu_m ;
                document.getElementsByName("t_lhr_ayah_m")[0].value = response.mertua.t_lhr_ayah_m ;
                document.getElementsByName("t_lhr_ibu_m")[0].value = response.mertua.t_lhr_ibu_m ;
                document.getElementsByName("tgl_lhr_ayah_m")[0].value = response.mertua.tgl_lhr_ayah_m ;
                document.getElementsByName("tgl_lhr_ibu_m")[0].value = response.mertua.tgl_lhr_ibu_m ;
                document.getElementsByName("pekerjaan_ayah_m")[0].value = response.mertua.pekerjaan_ayah_m ;
                document.getElementsByName("pekerjaan_ibu_m")[0].value = response.mertua.pekerjaan_ibu_m ;
                document.getElementsByName("telp_ayah_m")[0].value = response.mertua.telp_ayah_m ;
                document.getElementsByName("telp_ibu_m")[0].value = response.mertua.telp_ibu_m ;
                document.getElementsByName("alamat_ayah_m")[0].value = response.mertua.alamat_ayah_m ;
                document.getElementsByName("alamat_ibu_m")[0].value = response.mertua.alamat_ibu_m ;

                 // -----------------------SAUDARA------------------------------------------

                 var isisaudara="";
                for (let i = 0; i < response.anak.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  isisaudara+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.saudara[i].nama_saudara+'</td>'+
                        '<td>'+response.saudara[i].tempat_lhr_saudara+'</td>'+
                        '<td>'+response.saudara[i].tgl_lhr_saudara+'</td>'+
                        '<td>'+response.saudara[i].jkel_saudara+'</td>'+
                        '<td>'+response.saudara[i].pekerjaan_saudara+'</td>'+
                        '<td>'+response.saudara[i].alamat_saudara+'</td>'+
                        '<td>'+response.saudara[i].telp_saudara+'</td>'+
                        '<td><button type="button"  class="btn btn-danger" onclick="deleteanak('+response.saudara[i].itu+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                    '</tr>';
                }
                $("#isisaudara").html(isisaudara);

                function deleteanak(id) {
                    var name = $(this).attr('r-name');
                    Swal.fire({
                        title: 'Ingin Menghapus?',
                        text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, hapus !'
                    }).then((result) => {
                        console.log(result);
                        if (result.value) {
                            window.location = "/amdk/keluarga/deleteanak/"+id;
                        }
                    });
                };
            }
        );
    }

</script>
@endsection  