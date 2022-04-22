@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>skp</li>
    <li><a href="/amdk/skp">SKP</a></li>
    <li>Ubah SKP</li>
@endsection
@section('content')
@include('layouts.validasi')

<form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/skp/update/{{$data->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Input SKP</h3></div>
                <div class="panel-body">
                   <div class="col-md-12">
                       <div class="col-md-6">
                            <div class="col-md-12">
                                <label>Nama*</label><br>
                                <input type="text" readonly class="col-xs-10 col-sm-10 " 
                                name="users_name" value="{{$data->peg->name}}"/>
                                <input type="hidden" name="users_id" value="{{$data->users_id}}"/>
                            </div>
                            <div class="col-md-12">
                                <label> Jabatan</label><br>
                                <input type="text" readonly class="col-xs-10 col-sm-10 " 
                                name="jabatan" value="{{$data->jab->nama}}"/>
                                <input type="hidden" name="jabasn_id"  value="{{$data->jabasn_id}}"/>
                            </div>
                       </div>
                       <div class="col-md-6">
                            <div class="col-md-12">
                                <label>Tanggal *</label><br>
                                <input type="date" required id="dates" value="{{$data->dates}}"
                                class="col-xs-10 col-sm-10 required " name="dates"/>
                            </div>
                            <div class="col-md-12">
                                <label> Pejabat Penilai *</label><br>
                                <select id="peg" name="pejabat_id" class="col-xs-10 col-sm-10 select2" required>
                                    @foreach ($tahu as $lok)
                                        @if ($data->pejabat_id == $lok->id)
                                        <option value="{{$lok->id}}" selected>{{$lok->user->name}} ({{$lok->jabatan->jabatan}} {{$lok->divisi->nama}})</option>
                                        @else
                                        <option value="{{$lok->id}}">{{$lok->user->name}} ({{$lok->jabatan->jabatan}} {{$lok->divisi->nama}})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                   </div>          
               </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Sasaran</h3></div>
                <div class="panel-body">
                   <div class="col-md-12">
                    <table id="myTable" class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center col-md-1" rowspan="2">No</th>
                                <th class="text-center col-md-4" rowspan="2">Kegiatan Tugas Jabatan</th>
                                <th class="text-center col-md-1" rowspan="2">AK</th>
                                <th class="text-center col-md-1" rowspan="2">Total KAK</th>
                                <th class="text-center" colspan="4">Target</th>
                                <th class="text-center col-md-1" rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th class="text-center">KUAN / OUTPUT</th>
                                <th class="text-center">KUAL / MUTU</th>
                                <th class="text-center">time (Bulan)</th>
                                <th class="text-center">cost (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($detail as $item)
                            <tr id="cell-{{$no}}">
                                <td style="text-align: center;">
                                    {{$no}}
                                </td>
                                <td>
                                    <select name="setup_ak_id[]" id="uraian" class="form-control select2" required>
                                        @foreach ($ak as $daftar)
                                           @if ($item->setup_ak_id == $daftar->id)
                                                <option value="{{$daftar->id}}" selected>{{$daftar->uraian}}</option>       
                                           @else
                                            <option value="{{$daftar->id}}">{{$daftar->uraian}}</option>
                                           @endif
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="detail_id[]" value="{{$item->id}}">
                                </td>
                                <td><input type="number" name="n_ak[]" class="form-control" id="ak-1" step="0.01" value="{{$item->n_ak}}"></td>
                                <td><input type="number" name="tot_ak[]" id="tot_ak-{{$no}}" class="form-control" readonly value="{{$item->tot_ak}}" ></td>
                                <td>
                                    <input type="number" name="quan[]" id="kuan-{{$no}}" class="form-control"  value="{{$item->quan}}" min="0" onchange="hitung2({{$no}})" onclick="hitung2({{$no}})">
                                    <select name="jen[]" class="form-control" style="font-size: 9.5px">
                                        @if ($item->jen == "Laporan")
                                            <option value="Laporan" selected>Laporan</option>
                                            <option value="Dokumen">Dokumen</option>
                                            <option value="Jam Pelajaran">Jam Pelajaran</option>
                                        @elseif ($item->jen == "Dokumen")
                                            <option value="Laporan">Laporan</option>
                                            <option value="Dokumen" selected>Dokumen</option>
                                            <option value="Jam Pelajaran">Jam Pelajaran</option>
                                        @else
                                            <option value="Laporan">Laporan</option>
                                            <option value="Dokumen">Dokumen</option>
                                            <option value="Jam Pelajaran" selected>Jam Pelajaran</option>
                                        @endif
                                    </select>
                                </td>
                                <td><input type="number" name="kual[]" class="form-control" value="{{$item->kual}}" min="0"></td>
                                <td><input type="number" name="time[]" class="form-control" value="{{$item->time}}" min="0"></td>
                                <td><input type="number" name="cost[]" class="form-control" value="{{$item->cost}}" min="0"></td>
                                <td>
                                    <a href="#" class="btn btn-danger delete"
                                        r-name="{{$item->keg->uraian}}" 
                                        r-id="{{$item->id}}">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                    {{-- <button type="button" class="btn btn-danger" onclick="deleteRowPeg({{$no}})"><i class="glyphicon glyphicon-trash"></i></button> --}}
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
                                <td colspan="9">
                                    <button type="button" class="form-control btn-default" onclick="addBarisNew()">
                                        <i class="glyphicon glyphicon-plus"></i>TAMBAH BARIS BARU</button>
                                        @php
                                            $nil = $no-1;
                                        @endphp
                                    <input type="hidden" id="countRow" value="{{$nil}}">
                                </td>
                            </tr>
                           
                        </tfoot>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Update
            </button>
        </div>
    </div>
    </form>

    
@endsection
@section('footer')
<script>
    function addBarisNew(){
        var last_baris = $("#countRow").val();
        var new_baris = parseInt(last_baris)+1;
        $isi ='<tr id="cell-'+new_baris+'">'+
                    '<td>'+new_baris+'</td>'+
                    '<td>'+
                        '<select name="setup_ak_id[]" id="uraian" class="form-control select2">'+
                            '@foreach ($ak as $item)'+
                                '<option value="{{$item->id}}">{{$item->uraian}}</option>'+        
                            '@endforeach'+        
                        '</select>'+    
                        '<input type="hidden" name="detail_id[]">'+            
                    '</td>'+
                    '<td><input type="number" name="n_ak[]" class="form-control" id="ak-'+new_baris+'" step="0.01" value="0" ></td>'+        
                    '<td><input type="number" name="tot_ak[]" class="form-control" readonly value="0" id="tot_ak-'+new_baris+'"></td>'+        
                    '<td>'+
                        '<input type="number" name="quan[]" class="form-control" id="kuan-'+new_baris+'"  value="0" min="0" onchange="hitung2('+new_baris+')" onclick="hitung2('+new_baris+')">'+        
                        '<select name="jen[]" class="form-control" style="font-size: 9.5px">'+        
                            '<option value="Laporan">Laporan</option>'+        
                            '<option value="Dokumen">Dokumen</option>'+        
                            '<option value="Jam Pelajaran">Jam Pelajaran</option>'+        
                        '</select>'+        
                    '</td>'+        
                    '<td><input type="number" name="kual[]" class="form-control" value="0" min="0"></td>'+        
                    '<td><input type="number" name="time[]" class="form-control" value="0" min="0"></td>'+        
                    '<td><input type="number" name="cost[]" class="form-control" value="0" min="0"></td>'+        
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

        function hitung2(i) {
            var a = $("#ak-"+i).val();
            var b = $("#kuan-"+i).val();
            var c = a*b;
            $("#tot_ak-"+i).val(c);
        }

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
                   window.location = "/amdk/skp/deletedet/"+id;
                }
            });
        });
    } );

   </script>
@endsection