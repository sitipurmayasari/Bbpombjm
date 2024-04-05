@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li> Setup </li>
    <li>Hak Akses</li>
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
    <form class="form-horizontal validate-form" role="form" 
        method="post" 
        action="{{Route('akses.store')}}" 
        id="nix">
    {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title"> Daftar Hak Akses Pegawai</h4>
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
                                <select id="user_id" name="user_id" class="col-xs-10 col-sm-10 select2" onchange="getpeg();getMenuUserAkses()">
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
                        <li class="active"><a href="#amdk" data-toggle="tab">AMDK</a></li>
                        <li><a href="#inventaris" data-toggle="tab">Inventaris</a></li>
                        <li><a href="#finance" data-toggle="tab">Keuangan</a></li>
                        <li><a href="#dinas" data-toggle="tab">Surat Dinas</a></li>
                        <li><a href="#plan" data-toggle="tab">e-Planning</a></li>
                        <li><a href="#forma" data-toggle="tab">e-Performance</a></li>
                        <li><a href="#kuli" data-toggle="tab">Kulihanku</a></li>
                        <li><a href="#aluh" data-toggle="tab">Aluh</a></li>
                        <li><a href="#arsip" data-toggle="tab">Arsiparis</a></li>
                        <li><a href="#qms" data-toggle="tab">QMS</a></li>
                        <li><a href="#nappza" data-toggle="tab">NAPPZA</a></li>
                        <li><a href="#mikro" data-toggle="tab">TOMIKU</a></li>
                        <li><a href="#ppnpn" data-toggle="tab">PPNPN</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="amdk">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">AMDK</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="amdkCheckAll" id="amdkCheckAll" >

                                                    </th>
                                                </thead>
                                                <tbody id="isi_amdk">
                                                    {{-- @php $no=1;  @endphp
                                                    @foreach($amdk as $key=>$row)
                                                        <tr>
                                                            <td style="text-align: center;">{{$no++}}</td>
                                                            <td>{{$row->nama}}</td>
                                                            <td style="text-align: center;">
                                                                <input type="checkbox" class="menu" name="akses[]" value="{{$row->id}}">
                                                            </td>
                                                        </tr>
                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="inventaris">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">INVENTARIS</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;"> 
                                                       <input type="checkbox" name="invCheckAll" id="invCheckAll" ></th>
                                                </thead>
                                                <tbody id="isi_inv">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="finance">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">FINANCE</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="financeCheckAll" id="financeCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_fin">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="arsip">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">ARSIP</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="arsipCheckAll" id="arsipCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_arsip">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="dinas">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">SURAT TUGAS</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="dinasCheckAll" id="dinasCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_dinas">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="plan">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">e-PLANNING</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="planCheckAll" id="planCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_plan">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="forma">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">e-PERFORMANCE</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="formaCheckAll" id="formaCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_forma">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kuli">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">KULIHANKU</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="kuliCheckAll" id="kuliCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_kuli">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="aluh">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">ALUH</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="aluhCheckAll" id="aluhCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_aluh">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="qms">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">QMS</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="qmsCheckAll" id="qmsCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_qms">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="nappza">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">NAPPZA</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="nappzaCheckAll" id="nappzaCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_nappza">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="mikro">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">TOMIKU</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="mikroCheckAll" id="mikroCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_mikro">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="ppnpn">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">PPNPN</h3>
                                        </div>
                        
                                        <div class="panel-body">
                                            <table id="simple-table" class="table  table-bordered table-hover" >
                                                <thead >
                                                    <th width="5%" style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Menu</th>
                                                    <th width="20%" style="text-align: center;">
                                                        <input type="checkbox" name="ppnpnCheckAll" id="ppnpnCheckAll" >
                                                    </th>
                                                </thead>
                                                <tbody id="isi_ppnpn">
                                                   
                                                </tbody>
                                            </table>
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
    $(function() {
        $('#financeCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekFin').prop('checked', true);
            } else {
                $('.cekFin').prop('checked', false);
            }
        });
        
        $('#invCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekInv').prop('checked', true);
            } else {
                $('.cekInv').prop('checked', false);
            }
        });
        
        $('#amdkCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekAmdk').prop('checked', true);
            } else {
                $('.cekAmdk').prop('checked', false);
            }
        });

        $('#arsipCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekArsip').prop('checked', true);
            } else {
                $('.cekArsip').prop('checked', false);
            }
        });

        $('#dinasCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekDinas').prop('checked', true);
            } else {
                $('.cekDinas').prop('checked', false);
            }
        });

        $('#planCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekPlan').prop('checked', true);
            } else {
                $('.cekPlan').prop('checked', false);
            }
        });

        $('#formaCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekForma').prop('checked', true);
            } else {
                $('.cekForma').prop('checked', false);
            }
        });

        $('#kuliCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekkuli').prop('checked', true);
            } else {
                $('.cekkuli').prop('checked', false);
            }
        });

        // $('#aluhCheckAll').click(function() {
        //     if ($(this).prop('checked')) {
        //         $('.cekaluh').prop('checked', true);
        //     } else {
        //         $('.cekaluh').prop('checked', false);
        //     }
        // });

        $('#qmsCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekqms').prop('checked', true);
            } else {
                $('.cekqms').prop('checked', false);
            }
        });

        $('#nappzaCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.ceknappza').prop('checked', true);
            } else {
                $('.ceknappza').prop('checked', false);
            }
        });

        $('#mikroCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekmikro').prop('checked', true);
            } else {
                $('.cekmikro').prop('checked', false);
            }
        });
        $('#ppnpnCheckAll').click(function() {
            if ($(this).prop('checked')) {
                $('.cekppnpn').prop('checked', true);
            } else {
                $('.cekppnpn').prop('checked', false);
            }
        });
    });
     function getpeg(){
        var user_id = $("#user_id").val();
    }

    function getMenuUserAkses(){
        var user_id = $("#user_id").val();
        $.get(
            "{{route('akses.getMenu') }}",
            {
                user_id: user_id
            },
            function(response) {
              var isi_amdk = "";
              var isi_inv = "";
              for (let i = 0; i < response.amdk.length; i++) {
                  var is_check = '';
                  var no = i+1;

                  if (response.amdk[i].checked){
                      is_check = 'checked';
                  }
                  isi_amdk+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.amdk[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekAmdk" name="akses_amdk[]" '+is_check
                            +' value="'+response.amdk[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.inventaris.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.inventaris[i].checked){
                      is_check = 'checked';
                  }
                  isi_inv+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.inventaris[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekInv" name="akses_inv[]" '+is_check
                            +' value="'+response.inventaris[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.finance.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.finance[i].checked){
                      is_check = 'checked';
                  }
                  isi_fin+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.finance[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekFin" name="akses_fin[]" '+is_check
                            +' value="'+response.finance[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.arsip.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.arsip[i].checked){
                      is_check = 'checked';
                  }
                  isi_arsip+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.arsip[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekArsip" name="akses_arsip[]" '+is_check
                            +' value="'+response.arsip[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.dinas.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.dinas[i].checked){
                      is_check = 'checked';
                  }
                  isi_dinas+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.dinas[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekDinas" name="akses_dinas[]" '+is_check
                            +' value="'+response.dinas[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.plan.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.plan[i].checked){
                      is_check = 'checked';
                  }
                  isi_plan+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.plan[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekPlan" name="akses_plan[]" '+is_check
                            +' value="'+response.plan[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.forma.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.forma[i].checked){
                      is_check = 'checked';
                  }
                  isi_forma+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.forma[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekForma" name="akses_forma[]" '+is_check
                            +' value="'+response.forma[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.kuli.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.kuli[i].checked){
                      is_check = 'checked';
                  }
                  isi_kuli+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.kuli[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekkuli" name="akses_kuli[]" '+is_check
                            +' value="'+response.kuli[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.aluh.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.aluh[i].checked){
                      is_check = 'checked';
                  }
                  isi_aluh+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.aluh[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekaluh" name="akses_aluh[]" '+is_check
                            +' value="'+response.aluh[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.qms.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.qms[i].checked){
                      is_check = 'checked';
                  }
                  isi_qms+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.qms[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekqms" name="akses_qms[]" '+is_check
                            +' value="'+response.qms[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.nappza.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.nappza[i].checked){
                      is_check = 'checked';
                  }
                  isi_nappza+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.nappza[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu ceknappza" name="akses_nappza[]" '+is_check
                            +' value="'+response.nappza[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.mikro.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.mikro[i].checked){
                      is_check = 'checked';
                  }
                  isi_mikro+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.mikro[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekmikro" name="akses_mikro[]" '+is_check
                            +' value="'+response.mikro[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              for (let i = 0; i < response.ppnpn.length; i++) {
                  var is_check = '';
                  var no = i+1;
                  if (response.ppnpn[i].checked){
                      is_check = 'checked';
                  }
                  isi_ppnpn+='<tr>'+
                        '<td style="text-align: center;">'+no+'</td>'+
                        '<td>'+response.ppnpn[i].nama+'</td>'+
                        '<td style="text-align: center;">'+
                            '<input type="checkbox" class="menu cekppnpn" name="akses_ppnpn[]" '+is_check
                            +' value="'+response.ppnpn[i].id+'">'+
                        '</td>'+
                    '</tr>';
              }

              $("#isi_amdk").html(isi_amdk);
              $("#isi_inv").html(isi_inv);
              $("#isi_fin").html(isi_fin);
              $("#isi_arsip").html(isi_arsip);
              $("#isi_dinas").html(isi_dinas);
              $("#isi_plan").html(isi_plan);
              $("#isi_forma").html(isi_forma);
              $("#isi_kuli").html(isi_kuli);
              $("#isi_aluh").html(isi_aluh);
              $("#isi_qms").html(isi_qms);
              $("#isi_nappza").html(isi_nappza);
              $("#isi_mikro").html(isi_mikro);
              $("#isi_ppnpn").html(isi_ppnpn);

            }
        );
    }

</script>
@endsection  