@extends('layouts.mon')
@section('breadcrumb')
    <li>Setup</li>
    <li><a href="/finance/activitycode">Kode Kementrian Lembaga</a></li>
    <li>Edit</li>
@endsection
@section('content')
@include('layouts.validasi')

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/finance/activitycode/update/{{$data->id}}">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Input Kode Kegiatan</h4>
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
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode Program Lembaga
                            </label>
                            <div class="col-sm-8">
                                <select name="programcode_id" class="col-xs-10 col-sm-10 required " required 
                                onchange="getProgram()" id="programcode_id">
                                    <option value="">Pilih Kode</option>
                                    @foreach ($program as $peg)
                                        @if ($data->programcode_id==$peg->id)
                                            <option value="{{$peg->id}}" selected>{{$peg->unit->klcode->code}} - {{$peg->unit->code}} - {{$peg->code}}</option>
                                        @else
                                            <option value="{{$peg->id}}">{{$peg->unit->klcode->code}} - {{$peg->unit->code}} - {{$peg->code}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Kode
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="kode kegiatan" value="{{$data->code}}"
                                        class="col-xs-10 col-sm-10 required " 
                                        name="code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" 
                            for="form-field-1"> Nama
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  placeholder="Nama kegiatan"  value="{{$data->name}}"
                                        class="col-xs-10 col-sm-10 required "
                                        name="name" />
                                <input type="hidden" name="lengkap" id="lengkap" value="{{$data->lengkap}}">
                            </div>
                        </div>
                        </fieldset>        
                   
               </div>
           </div>
        </div>
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

@endsection
@section('footer')
    <script>
        function getProgram(){
            var programcode_id = $("#programcode_id").val();

            $.get(
                "{{route('activitycode.getprogLengkap') }}",
                {
                    programcode_id:programcode_id,
                },
                function(response) {
                var data = response.data.kl + '/'+ response.data.unit +'/'+ response.data.prog;
                $("#lengkap").val(data);
                }
            );
        }
    </script>
@endsection