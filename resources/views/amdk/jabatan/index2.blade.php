@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/jabatan"> Pejabat</a></li>
@endsection
@section('content')


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('jabatan.store')}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Tambah Data Pejabat</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body col-sm-6">
                <div class="widget-main no-padding">
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Nama Jabatan
                        </label>
                        <div class="col-sm-9" >
                            <select name="jabatan_id" id="jab" class="col-xs-10 col-sm-10 required" onchange="myFunction()">
                                <option value="">pilih Jabatan</option>
                                <option value="6">Kepala Badan</option>
                                <option value="11">Kepala Bagian</option>
                                <option value="5">Koordinator</option>
                                <option value="7">Sub Koordinator</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="div">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Kelompok
                        </label>
                        <div class="col-sm-9" >
                            <select  name="divisi_id" id="divisi_id" onchange="getSubdivisiId()" class="col-xs-10 col-sm-10">
                                <option value="">Pilih Kelompok</option>
                                @foreach ($divisi as $div)
                                    <option value="{{$div->id}}">{{$div->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="subdiv">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> SubKelompok
                        </label>
                        <div class="col-sm-9" >
                            <select name="subdivisi_id" id="subdivisi_id" class="col-xs-10 col-sm-10">
                                <option value="">Tanpa Sub Kelompok</option>
                                {{-- @foreach ($subdivisi as $sub)
                                    <option value="{{$sub->id}}">{{$sub->nama_subdiv}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Pejabat
                            </label>
                            <div class="col-sm-9">
                                <select id="status" name="users_id" class="ccol-xs-10 col-sm-10 select2">
                                    <option value="">Pilih Pejabat</option>
                                    @foreach ($user as $peg)
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Dari
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="dari" readonly class="col-xs-10 col-sm-10" 
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Sampai
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="sampai" readonly class="col-xs-10 col-sm-10" 
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal">
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> 
                            </label>
                            <div class="col-sm-9">
                                &nbsp;&nbsp;
                                <input type="checkbox"name="pjs" value="Pjs.">
                                &nbsp; PJS 
                            </div>
                        </div>
                    </div>
                    </fieldset>        
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
           
            <div class="col-sm-6">
                <br>
                <div class="table-responsive">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                            <th width="40px">No</th>
                            <th>Jabatan</th>
                            <th>Dari</th>
                            <th>sampai</th>
                            <th>Aksi</th>
                        <thead>
                        <tbody>
                            @foreach($data as $key=>$row)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>
                                    @if ($row->subdivisi_id==null)
                                        @if ($row->pjs==null)
                                            {{$row->jabatan->jabatan}} {{$row->divisi->nama}}
                                        @else
                                            {{$row->pjs}} {{$row->jabatan->jabatan}} {{$row->divisi->nama}}
                                        @endif
                                    @else
                                        @if ($row->pjs==null)
                                            {{$row->jabatan->jabatan}} {{$row->subdivisi->nama_subdiv}}
                                        @else
                                            {{$row->pjs}} {{$row->jabatan->jabatan}} {{$row->subdivisi->nama_subdiv}}
                                        @endif
                                    @endiF 
                                </td>
                                <td>
                                    {{$row->dari}}
                                </td>
                                <td>
                                    {{$row->sampai}}
                                </td>
                                <td>
                                    <a href="/jabatan/edit/{{$row->id}}" class="btn btn-warning">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger delete"
                                        r-id="{{$row->id}}">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                          
                            @endforeach
                        <tbody>
                    </table>
                </div>
            </div>


        </div>
    </div><!-- /.col -->
</div>

{{-- {{$data->appends(Request::all())->links()}} --}}
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
                    window.location = "/jabatan/delete/"+id;
                }
            });
        });

        $("#subdiv").hide();
        $("#jab").on("change", function(){
            var v = $(this).val();
            if(v=="7"){
                $("#subdiv").show();
            }else{
                $("#subdiv").hide();
            } 
        });

    } );

    function getSubdivisiId(){
         var divisi_id = $("#divisi_id").val();
        $.get(
            "{{route('divisi.getDivisi') }}",
            {
                divisi_id: divisi_id
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Tanpa Sub Kelompok</option>";
                $.each(data, function(index, value) {
                    string = string + `<option value="` + value.id + `">` + value.nama_subdiv + `</option>`;
                })
               $("#subdivisi_id").html(string);
            }
        );
    }
</script>
@endsection