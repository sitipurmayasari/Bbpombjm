@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/jabasn"> Jabatan Fungsional</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/jabasn/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Edit Jabatan Fungsional</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jabatan
                        </label> --}}
                        {{-- <div class="col-sm-8">
                            <select name="jabatan"  class="col-xs-10 col-sm-10 required " >
                                @if ($data->jabatan=='Ahli Pertama')
                                    <option value="" >Pilih Jabatan</option>
                                    <option value="Ahli Pertama" selected>Ahli Pertama</option>
                                    <option value="Ahli Muda">Ahli Muda</option>
                                    <option value="Ahli Madya">Ahli Madya</option>
                                    <option value="Ahli Utama">Ahli Utama</option>
                                @elseif ($data->jabatan=='Ahli Muda')
                                    <option value="" >Pilih Jabatan</option>
                                    <option value="Ahli Pertama" >Ahli Pertama</option>
                                    <option value="Ahli Muda" selected>Ahli Muda</option>
                                    <option value="Ahli Madya">Ahli Madya</option>
                                    <option value="Ahli Utama">Ahli Utama</option>
                                @elseif ($data->jabatan=='Ahli Madya')
                                    <option value="" >Pilih Jabatan</option>
                                    <option value="Ahli Pertama" >Ahli Pertama</option>
                                    <option value="Ahli Muda" >Ahli Muda</option>
                                    <option value="Ahli Madya" selected>Ahli Madya</option>
                                    <option value="Ahli Utama">Ahli Utama</option>
                                @elseif ($data->jabatan=='Ahli Utama')
                                    <option value="" >Pilih Jabatan</option>
                                    <option value="Ahli Pertama" >Ahli Pertama</option>
                                    <option value="Ahli Muda" >Ahli Muda</option>
                                    <option value="Ahli Madya" >Ahli Madya</option>
                                    <option value="Ahli Utama" selected>Ahli Utama</option>
                                @else
                                    <option value="" selected>Pilih Jabatan</option>
                                    <option value="Ahli Pertama">Ahli Pertama</option>
                                    <option value="Ahli Muda">Ahli Muda</option>
                                    <option value="Ahli Madya">Ahli Madya</option>
                                    <option value="Ahli Utama">Ahli Utama</option>
                                @endif
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Jabatan
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder=" Masukkan Nama Jabatan" 
                                    class="col-xs-10 col-sm-10 required " value="{{$data->nama}}"
                                    name="nama" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kelompok Jabatan
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder=" Masukkan Nama Kelompok" 
                                    class="col-xs-10 col-sm-10 required " value="{{$data->kelompok}}"
                                    name="kelompok" required />
                        </div>
                    </div>

                    </fieldset>        
                </div>
            </div>
        </div>
    </div><!-- /.col -->
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>
    
@endsection