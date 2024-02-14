@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/teamlead"> Ketua Tim</a></li>
    <li>Tambah Ketua Tim</li>
@endsection
@section('content')


<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('teamlead.store')}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Tambah Data Ketua Tim</h4>
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
                    {{-- <div class="form-group" id="div">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1">Bidang/Kelompok
                        </label>
                        <div class="col-sm-9" >
                            <select  name="divisi_id" id="divisi_id" class="col-xs-10 col-sm-10">
                                <option value="">Pilih kelompok</option>
                                    @foreach ($divisi as $div)
                                        <option value="{{$div->id}}">{{$div->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama Pejabat
                            </label>
                            <div class="col-sm-9">
                                <select id="status" name="users_id" class="ccol-xs-10 col-sm-10 select2" required>
                                    <option value="">Pilih Nama Ketua Tim</option>
                                    @foreach ($user as $peg)
                                        <option value="{{$peg->id}}">{{$peg->name}} (NIP: {{$peg->no_pegawai}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Nama Jabatan
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="detail" class="col-xs-10 col-sm-10" value=""
                            placeholder="Ketua Tim Infokom" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Dari
                        </label>
                        <div class="col-sm-9">
                            <input type="date" name="datefrom" readonly class="col-xs-10 col-sm-10" value=""
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" 
                        for="form-field-1"> Sampai
                        </label>
                        <div class="col-sm-9">
                            <input type="date" name="dateto" readonly class="col-xs-10 col-sm-10" value=""
                            data-date-format="yyyy-mm-dd" data-provide="datepicker" placeholder="klik untuk menampilkan tanggal" required>
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
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
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
                    window.location = "/teamlead/delete/"+id;
                }
            });
        });

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