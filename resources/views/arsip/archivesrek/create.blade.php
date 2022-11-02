@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Arsiparis</li>
    <li><a href="/arsip/archivesrek">Rekapitulasi Arsip</a></li>
    <li>Tambah Baru</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="{{route('archivesrek.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form input Arsip</h4>
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Tanggal Surat
                        </label>
                        <div class="col-sm-8">
                            <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            <input type="date" required value="{{date('Y-m-d')}}"
                                    class="col-xs-3 col-sm-3 required " 
                                    name="date"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Status
                        </label>
                        <div class="col-sm-10">
                            <input type="radio" required value="aktif" checked 
                                name="status" > &nbsp; Aktif  &nbsp;
                            <input type="radio" required value="inaktif"
                                name="status" /> &nbsp; Inaktif &nbsp;
                            <input type="radio" required value="permanen"
                                name="status" /> &nbsp; Permanen &nbsp;
                            <input type="radio" required value="akanmusnah"
                                name="status" /> &nbsp; Perlu Dimusnahkan
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">Bagian
                        </label>
                        <div class="col-sm-8">
                            <select name="divisi_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Bagian</option>
                                @foreach ($div as $isi)
                                    <option value="{{$isi->id}}">{{$isi->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Klasifikasi Surat
                        </label>
                        <div class="col-sm-10">
                            <select name="mailclasification_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih Klasifikasi</option>
                                @foreach ($masa as $isi)
                                    <option value="{{$isi->id}}">{{$isi->alias}} - {{$isi->names}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Bentuk Naskah
                        </label>
                        <div class="col-sm-10">
                            <select name="naskah_id" class="col-xs-10 col-sm-10 required select2" required>
                                <option value="">Pilih bentuk naskah</option>
                                @foreach ($naskah as $isi)
                                    <option value="{{$isi->id}}">{{$isi->bentuk}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Surat
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor" class="col-xs-10 col-sm-10 required"  required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tingkat Keaslian
                        </label>
                        <div class="col-sm-10">
                            <input type="radio" required value="asli" checked 
                                name="tingkat" id="L"/> &nbsp; Asli  &nbsp;
                            <input type="radio" required value="copy"
                                name="tingkat" id="P"/> &nbsp; Copy &nbsp;
                            <input type="radio" required value="soft copy"
                                name="tingkat" id="P"/> &nbsp; Soft Copy
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Uraian Berkas
                        </label>
                        <div class="col-sm-10">
                            <textarea name="uraian_berkas" id="" cols="95%" rows="5" required
                            placeholder="ex : Perihal"
                            ></textarea>

                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Uraian Isi Informasi
                        </label>
                        <div class="col-sm-10">
                            <textarea name="uraian" id="" cols="95%" rows="5" required
                            placeholder="ex : Surat Kepala Badan nomor xxx tentang xxx"
                            ></textarea>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jumlah (lembar)
                        </label>
                        <div class="col-sm-10">
                            <input type="number"  placeholder="0" class="col-xs-1 col-sm-1 " value="0"
                                    name="jumlah"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Lokasi Penyimpanan
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="bantex dengan nama x" class="col-xs-10 col-sm-10"
                                    name="lokasi"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Upload File*
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><i>Tidak wajib, max : 2Mb</i></label>
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Uraian Isi Informasi</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover text-center">
                    <thead>
                        <th class="text-center col-md-1">No</th>
                        <th class="text-center col-md-10">Uraian & Lampiran</th>
                        <th class="text-center col-md-1">Aksi</th>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td>
                                1
                            </td>       
                            <td>
                                <input type="text" name="attachfile[]" class="form-control" required>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <span id="row-new"></span>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                <input type="hidden" id="countRow" value="1">
                            </td>
                        </tr>
                        
                    </tfoot>
                </table>
               </div>
            </div>
        </div>
    </div><!-- /.col -->
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>
    
@endsection
@section('footer')
   <script>
        function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi ='<tr id="cell-'+new_baris+'">'+
                '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<input type="text" name="attachfile[]" class="form-control" required>'+
                    '</td>'+
                        '<td><button type="button" class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                    '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();

       }

    
       function deleteRow(cell) {
            $("#cell-"+cell).remove();
            this.hitungTotal();

        }
    
   </script>
@endsection