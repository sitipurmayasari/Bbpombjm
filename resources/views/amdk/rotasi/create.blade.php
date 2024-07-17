@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/rotasi/assignment">Mutasi/Rotasi</a></li>
    <li>Tambah Pegawai</li>
@endsection
@section('content')


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('rotasi.store')}}"  enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Tambah Pegawai</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body col-sm-10">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nama Pegawai
                        </label>
                        <div class="col-sm-10" >
                            <select id="users_id" name="users_id" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">Pilih Pegawai</option>
                                @foreach ($user as $peg)
                                    <option value="{{$peg->id}}">NIP. {{$peg->no_pegawai}} || {{$peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Jenis
                        </label>
                        <div class="col-sm-10" >
                            <select id="status" name="status" class="col-xs-10 col-sm-10 select2" required>
                                <option value="R">Rotasi/Mutasi Pegawai</option>
                                <option value="M">Penempatan Pegawai Pindahan</option>
                                <option value="N">Penempatan Pegawai Baru</option>
                                <option value="P">Evaluasi PPNPN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Tanggal Penempatan
                        </label>
                        <div class="col-sm-10" >
                            <input type="date" name="placementDate" readonly class="col-xs-2 col-sm-2 required" 
                                data-date-format="yyyy-mm-dd" data-provide="datepicker" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penempatan Lama
                        </label>
                        <div class="col-sm-10" >
                            <input type="text" class="col-xs-10 col-sm-10 " 
                            name="old" value=""/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Penempatan Baru
                        </label>
                        <div class="col-sm-10" >
                            <input type="text" class="col-xs-10 col-sm-10 " 
                            name="new" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Evaluator
                        </label>
                        <div class="col-sm-10" >
                            <select id="evaluator" name="evaluator" class="col-xs-10 col-sm-10 select2" required>
                                <option value="">Pilih Ketua Tim</option>
                                @foreach ($katim as $katim)
                                    <option value="{{$katim->users_id}}">{{$katim->peg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Nilai Minimal
                        </label>
                        <div class="col-sm-10" >
                            <input type="number" class="col-xs-1 col-sm-1 " 
                            name="min" value="70"/>
                        </div>
                    </div>
                    </fieldset>        
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Barang yang di Ajukan</h3></div>
            <div class="panel-body">
               <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover text-center">
                    <thead>
                        <th class="text-center col-md-1">No</th>
                        <th class="text-center col-md-3">Pernyataan</th>
                        <th class="text-center col-md-1">Aksi</th>
                    </thead>
                    <tbody>
                        <tr id="cell-1">
                            <td>
                                1
                            </td>       
                            <td>
                                <textarea name="statement[]" cols="100%" rows="2">Penempatan pegawai sudah sesuai Kompetensi yang dimiliki</textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr id="cell-1">
                            <td>
                                2
                            </td>       
                            <td>
                                <textarea name="statement[]" cols="100%" rows="2">Penempatan pegawai memberikan efesiensi dan efektifitas kinerja unit</textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr id="cell-1">
                            <td>
                                3
                            </td>       
                            <td>
                                <textarea name="statement[]" cols="100%" rows="2">Pegawai dengan cepat beradaptasi dengan sistem yang telah berjalan pada unit</textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr id="cell-1">
                            <td>
                                4
                            </td>       
                            <td>
                                <textarea name="statement[]" cols="100%" rows="2">Pegawai turut berkontribusi dalam perbaikan sistem yang berjalan pada unit</textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr id="cell-1">
                            <td>
                                5
                            </td>       
                            <td>
                                <textarea name="statement[]" cols="100%" rows="2">Pegawai dapat melaksanakan tugas dan kewajiban yang dibebankan kepadanya dengan penuh tanggung jawab</textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <span id="row-new"></span>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
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

@endsection
@section('footer')
   <script>
        function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi ='<tr id="cell-'+new_baris+'">'+
                '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<textarea name="statement[]" cols="100%" rows="2"></textarea>'+            
                    '</td>'+
                    '<td><button type="button" class="btn btn-danger" onclick="deleteRow('+new_baris+')"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                '</tr>';
        $("#myTable").find('tbody').append($isi);
        $("#countRow").val(new_baris);
        $('.select2').select2();
        getkelompoknext(new_baris);

       }

    
       function deleteRow(cell) {
            $("#cell-"+cell).remove();
            this.hitungTotal();

        }
   </script>
@endsection