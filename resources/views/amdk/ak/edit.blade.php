@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/amdk/ak"> Angka Kredit</a></li>
    <li>Ubah Data</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/ak/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Setup Angka Kredit</h4>
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
                        for="form-field-1"> Unsur
                        </label>
                        <div class="col-sm-10">
                            <select name="unsur" id="unsur" class="col-xs-10 col-sm-10 required select2" required onchange="getunsur()" >
                                @if ($data->unsur ="Perencanaan")
                                    <option value="Perencanaan" selected>Perencanaan</option>
                                    <option value="Pengembangan Profesi">Pengembangan Profesi</option>
                                    <option value="Penunjang Kegiatan Perencanaan Pembangunan" >Penunjang Kegiatan Perencanaan Pembangunan</option>
                                @elseif($data->unsur ="Pengembangan Profesi")   
                                    <option value="Perencanaan">Perencanaan</option>
                                    <option value="Pengembangan Profesi" selected>Pengembangan Profesi</option>
                                    <option value="Penunjang Kegiatan Perencanaan Pembangunan" selected>Penunjang Kegiatan Perencanaan Pembangunan</option>
                                @else
                                    <option value="Perencanaan">Perencanaan</option>
                                    <option value="Pengembangan Profesi">Pengembangan Profesi</option>
                                    <option value="Penunjang Kegiatan Perencanaan Pembangunan" selected>Penunjang Kegiatan Perencanaan Pembangunan</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Sub Unsur
                        </label>
                        <div class="col-sm-10">
                            <select name="sub_unsur" id="subunsur" class="col-xs-10 col-sm-10 select2" required>
                                @foreach ($sub as $item)
                                    @if ($item->sub_unsur == $data->sub_unsur)
                                        <option value="{{$item->sub_unsur}}" selected>{{$item->sub_unsur}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Kode Angka Kredit
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="contoh : II.E.4.a." class="col-xs-10 col-sm-10 required " 
                                    name="kode_ak" required value="{{$data->kode_ak}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Uraian
                        </label>
                        <div class="col-sm-10">
                            <textarea name="uraian" cols="95" rows="2">{{$data->uraian}}</textarea>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Hasil
                        </label>
                        <div class="col-sm-10">
                            <input type="text"  placeholder="hasil" class="col-xs-10 col-sm-10 required " 
                                    name="hasil" required value="{{$data->hasil}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Ketentuan Angka Kredit
                        </label>
                        <div class="col-sm-10" >
                            <input type="number" step="0.001" min="0" class="col-xs-1 col-sm-1 required "  placeholder="0" 
                            name="kak" value="{{$data->kak}}"/>&nbsp;
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Angka Kredit
                        </label>
                        <div class="col-sm-10" >
                            <input type="number" step="0.001" min="0" class="col-xs-1 col-sm-1 required "  placeholder="0"
                            name="ak" value="{{$data->ak}}" />&nbsp;
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Bobot :</h4>
                    <table id="simple-table" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                                <th style="text-align: center">Pelaksana</th>
                                <th style="text-align: center">Pertama</th>
                                <th style="text-align: center">Muda</th>
                                <th style="text-align: center">Madya</th>
                                <th style="text-align: center">Utama</th>
                           </tr>
                        <thead>
                        <tbody>   	
                           <tr>
                                <td>
                                    <select name="pelaksana" class="form-control">
                                        @if ($data->pelaksana="Semua jenjang")
                                            <option value="Semua jenjang" selected>Semua jenjang</option>
                                            <option value="Ahli Pertama">Ahli Pertama</option>
                                            <option value="Ahli Muda">Ahli Muda</option>
                                            <option value="Ahli Madya">Ahli Madya</option>
                                            <option value="Ahli Utama">Ahli Utama</option>
                                        @elseif ($data->pelaksana="Ahli Pertama")
                                            <option value="Semua jenjang">Semua jenjang</option>
                                            <option value="Ahli Pertama" selected>Ahli Pertama</option>
                                            <option value="Ahli Muda">Ahli Muda</option>
                                            <option value="Ahli Madya">Ahli Madya</option>
                                            <option value="Ahli Utama">Ahli Utama</option>
                                        @elseif ($data->pelaksana="Ahli Muda")
                                            <option value="Semua jenjang">Semua jenjang</option>
                                            <option value="Ahli Pertama">Ahli Pertama</option>
                                            <option value="Ahli Muda" selected>Ahli Muda</option>
                                            <option value="Ahli Madya">Ahli Madya</option>
                                            <option value="Ahli Utama">Ahli Utama</option>
                                        @elseif ($data->pelaksana="Ahli Madya")
                                            <option value="Semua jenjang">Semua jenjang</option>
                                            <option value="Ahli Pertama">Ahli Pertama</option>
                                            <option value="Ahli Muda">Ahli Muda</option>
                                            <option value="Ahli Madya" selected>Ahli Madya</option>
                                            <option value="Ahli Utama">Ahli Utama</option>
                                        @else
                                            <option value="Semua jenjang">Semua jenjang</option>
                                            <option value="Ahli Pertama">Ahli Pertama</option>
                                            <option value="Ahli Muda">Ahli Muda</option>
                                            <option value="Ahli Madya">Ahli Madya</option>
                                            <option value="Ahli Utama" selected>Ahli Utama</option>
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <input name="pertama" type="number" step="0.01" min="0" value="{{$data->pertama}}"
                                    class="form-control"  placeholder="0" >
                                </td>
                                <td>
                                    <input name="muda" type="number" step="0.01" min="0" value="{{$data->muda}}"
                                    class="form-control"  placeholder="0" >
                                </td>
                                <td>
                                    <input name="madya" type="number" step="0.01" min="0" value="{{$data->madya}}"
                                    class="form-control"  placeholder="0" >
                                </td>
                                <td>
                                    <input name="utama" type="number" step="0.01" min="0" value="{{$data->utama}}"
                                    class="form-control"  placeholder="0" >
                                </td>
                           </tr>
                        <tbody>
                    </table>
                </fieldset> 
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
    function getunsur(){
         var unsur = $("#unsur").val();
        $.get(
            "{{route('ak.getunsur') }}",
            {
                unsur: unsur
            },
            function(response) {
               var data = response.data;
               var string ="<option value=''>Pilih Sub Unsur</option>";
                $.each(data, function(index, value) {
                    string = string + `<option value="` + value.sub_unsur + `">` + value.sub_unsur + `</option>`;
                })
               $("#subunsur").html(string);
            }
        );
    }
</script>
@endsection