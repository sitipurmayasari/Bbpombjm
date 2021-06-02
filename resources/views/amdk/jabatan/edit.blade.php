@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/jabatan"> Jabatan</a></li>
    <li>Edit</li>
@endsection
@section('content')

@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="/amdk/jabatan/update/{{$data->id}}">
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
                                @if ($data->jabatan_id===6)
                                        <option value="">pilih Jabatan</option>
                                        <option value="6" selected>Kepala Badan</option>
                                        <option value="11">Kepala Bagian</option>
                                        <option value="7">Koordinator</option>
                                        <option value="5">Sub Koordinator</option>
                                    @elseif ($data->jabatan_id===11)
                                        <option value="">pilih Jabatan</option>
                                        <option value="6">Kepala Badan</option>
                                        <option value="11" selected>Kepala Bagian</option>
                                        <option value="7">Koordinator</option>
                                        <option value="5">Sub Koordinator</option>  
                                    @elseif ($data->jabatan_id===5)
                                        <option value="">pilih Jabatan</option>
                                        <option value="6">Kepala Badan</option>
                                        <option value="11">Kepala Bagian</option>
                                        <option value="7" selected>Koordinator</option>
                                        <option value="5">Sub Koordinator</option>
                                    @elseif ($data->jabatan_id===7)
                                        <option value="">pilih Jabatan</option>
                                        <option value="6">Kepala Badan</option>
                                        <option value="11">Kepala Bagian</option>
                                        <option value="7">Koordinator</option>
                                        <option value="5" selected>Sub Koordinator</option>
                                    @else
                                        <option value="">pilih Jabatan</option>
                                        <option value="6">Kepala Badan</option>
                                        <option value="11">Kepala Bagian</option>
                                        <option value="7">Koordinator</option>
                                        <option value="5">Sub Koordinator</option>
                                    @endif

                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="div">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Kelompok
                        </label>
                        <div class="col-sm-9" >
                            <select  name="divisi_id" id="divisi_id" onchange="getSubdivisiId()" class="col-xs-10 col-sm-10">
                                <option value="">Pilih kelompok</option>
                                    @foreach ($divisi as $div)
                                        @if ($data->divisi_id==$div->id)
                                            <option value="{{$div->id}}" selected>{{$div->nama}}</option>
                                        @else
                                            <option value="{{$div->id}}">{{$div->nama}}</option>
                                        @endif
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
                                    @foreach ($subdivisi as $sub)
                                        @if ($data->subdivisi_id==$sub->id)
                                            <option value="{{$sub->id}}" selected>{{$sub->nama_subdiv}}</option>
                                        @else
                                            <option value="{{$sub->id}}">{{$sub->nama_subdiv}}</option>
                                        @endif
                                    @endforeach
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
                                    @foreach ($user as $peg)
                                        @if ($data->users_id==$peg->id)
                                            <option value="{{$peg->id}}" selected>{{$peg->no_pegawai}} || {{$peg->name}}</option> 
                                        @else
                                        <option value="{{$peg->id}}">{{$peg->no_pegawai}} || {{$peg->name}}</option>
                                        @endif
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
                            <input type="text" name="dari" readonly class="col-xs-10 col-sm-10" value="{{$data->dari}}"
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Sampai
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="sampai" readonly class="col-xs-10 col-sm-10" value="{{$data->sampai}}"
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
                                @if ($data->pjs=='Plt.')
                                    <input type="radio" name="pjs" value="">
                                    <label class="control-label no-padding-right"> Asli</label> 
                                    &nbsp;&nbsp;
                                    <input type="radio" name="pjs" value="Plt." checked>
                                    <label class="control-label no-padding-right"> PLT</label> 
                                    &nbsp;&nbsp;
                                    <input type="radio" name="pjs" value="Plh.">
                                    <label class="control-label no-padding-right"> PLH</label>
                                @elseif($data->pjs=='Plh.')
                                    <input type="radio" name="pjs" value="">
                                    <label class="control-label no-padding-right"> Asli</label> 
                                    &nbsp;&nbsp;
                                    <input type="radio" name="pjs" value="Plt.">
                                    <label class="control-label no-padding-right"> PLT</label> 
                                    &nbsp;&nbsp;
                                    <input type="radio" name="pjs" value="Plh." checked>
                                    <label class="control-label no-padding-right"> PLH</label>
                                @else
                                    <input type="radio" name="pjs" value="" checked>
                                    <label class="control-label no-padding-right"> Asli</label> 
                                    &nbsp;&nbsp;
                                    <input type="radio" name="pjs" value="Plt.">
                                    <label class="control-label no-padding-right"> PLT</label> 
                                    &nbsp;&nbsp;
                                    <input type="radio" name="pjs" value="Plh.">
                                    <label class="control-label no-padding-right"> PLH</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    </fieldset>        
                </div>
                <div class="col-sm-12">
                    <div class="form-actions right">
                        <button class="btn btn-success btn-sm " type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>Update
                        </button>
                    </div>
                </div>
                </form>
            </div>
           
           


        </div>
    </div><!-- /.col -->
</div>

{{-- {{$data->appends(Request::all())->links()}} --}}
@endsection

@section('footer')
<script>
    $().ready( function () {
        $("#subdiv").hide();
        $("#jab").on("change", function(){
            var v = $(this).val();
            if(v=="5"){
                $("#subdiv").show();
            }else{
                $("#subdiv").hide();
            } 
        });

    } );

    // function getSubdivisiId(){
    //      var divisi_id = $("#divisi_id").val();
    //     $.get(
    //         "{{route('divisi.getDivisi') }}",
    //         {
    //             divisi_id: divisi_id
    //         },
    //         function(response) {
    //            var data = response.data;
    //            var string ="<option value=''>Tanpa Sub Kelompok</option>";
    //             $.each(data, function(index, value) {
    //                 string = string + `<option value="` + value.id + `">` + value.nama_subdiv + `</option>`;
    //             })
    //            $("#subdivisi_id").html(string);
    //         }
    //     );
    }
</script>
@endsection