@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Arsiparis</li>
    <li><a href="/arsip/archives/bidang/{{$div->id}}">Arsip {{$div->nama}}</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/arsip/archives/update/{{$div->id}}/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Form Ubah Arsip</h4>
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
                            <input type="date" required value="{{$data->date}}"
                                    class="col-xs-3 col-sm-3 required " 
                                    name="date"/>
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
                                    @if ($isi->id == $data->mailclasification_id)
                                        <option value="{{$isi->id}}" selected>{{$isi->alias}} - {{$isi->names}}</option>
                                    @else
                                        <option value="{{$isi->id}}">{{$isi->alias}} - {{$isi->names}}</option>
                                    @endif
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
                                    @if ($isi->id == $data->naskah_id)
                                        <option value="{{$isi->id}}" selected>{{$isi->bentuk}}</option>
                                    @else
                                        <option value="{{$isi->id}}">{{$isi->bentuk}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nomor Surat
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor" class="col-xs-10 col-sm-10 required"  required value="{{$data->nomor}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tingkat Keaslian
                        </label>
                        <div class="col-sm-10">
                            @if ($data->tingkat=="asli")
                                <input type="radio" required value="asli" checked 
                                name="tingkat" id="L"/> &nbsp; Asli  &nbsp;
                                <input type="radio" required value="copy"
                                name="tingkat" id="P"/> &nbsp; Copy &nbsp;
                                <input type="radio" required value="soft copy"
                                name="tingkat" id="P"/> &nbsp; Soft Copy
                            @elseif ($data->tingkat=="soft copy")
                                <input type="radio" required value="asli"  
                                name="tingkat" id="L"/> &nbsp; Asli  &nbsp;
                                <input type="radio" required value="copy"
                                name="tingkat" id="P"/> &nbsp; Copy &nbsp;
                                <input type="radio" required value="soft copy" checked
                                name="tingkat" id="P"/> &nbsp; Soft Copy
                            @else
                                <input type="radio" required value="asli"  
                                name="tingkat" id="L"/> &nbsp; Asli  &nbsp;
                                <input type="radio" required value="copy" checked
                                name="tingkat" id="P"/> &nbsp; Copy &nbsp;
                                <input type="radio" required value="soft copy"
                                name="tingkat" id="P"/> &nbsp; Soft Copy
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Uraian Berkas
                        </label>
                        <div class="col-sm-10">
                            <textarea name="uraian_berkas" id="" cols="95%" rows="5" required
                            placeholder="ex : Perihal" >{{$data->uraian_berkas}}</textarea>

                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Uraian Isi Informasi
                        </label>
                        <div class="col-sm-10">
                            <textarea name="uraian" id="" cols="95%" rows="5" required
                            placeholder="ex : Surat Kepala Badan nomor xxx tentang xxx">{{$data->uraian}}</textarea>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jumlah (lembar)
                        </label>
                        <div class="col-sm-10">
                            <input type="number"  class="col-xs-1 col-sm-1" value="{{$data->jumlah}}"
                                name="jumlah"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Lokasi Penyimpanan
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="bantex dengan nama x" class="col-xs-10 col-sm-10 "
                                    name="lokasi"  value="{{$data->lokasi}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1">  Upload File
                        </label>
                        <div class="col-sm-9">
                            <input type="file" name="file" class="btn btn-default btn-sm" id="" value="Upload File">      
                            <label><a href="{{$data->getFIlearsip()}}" target="_blank" >{{$data->file}}</a></label>
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
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($detail as $item)
                        <tr id="cell-{{$no}}">
                            <td>{{$no}}</td>       
                            <td>
                                <input type="hidden" name="outemp_id[]" value="{{$item->id}}">
                                <input type="text" name="attachfile[]" class="form-control" required value="{{$item->attachfile}}">
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger delete"
                                r-name="{{$item->attachfile}}" 
                                r-id="{{$item->id}}">
                                <i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                        @endforeach
                        <span id="row-new"></span>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                    <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                <input type="hidden" id="countRow" value="{{$no}}">
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
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>
</div>
    
@endsection
@section('footer')
   <script>
    $().ready( function () {
        $(".delete").click(function() {
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
                    window.location = "/arsip/archives/deletelist/"+id;
                }
            });
        });
    } );

        function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi ='<tr id="cell-'+new_baris+'">'+
                '<td>'+new_baris+'</td>'+
                '<td>'+
                    '<input type="hidden" name="outemp_id[]">'+           
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