@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/rotasi">Rotasi/Mutasi</a></li>
    <li>Evaluasi</li>
@endsection
@section('content')
<style>
    textarea
    {
    width:100%;
    }
</style>
@include('layouts.validasi')
    <form class="form-horizontal validate-form" role="form" 
    method="post" action="/amdk/rotasi/update/{{$data->id}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3 class="panel-title">A. INFORMASI UMUM</h3></div>
                    <div class="panel-body">
                       <div class="col-md-12">
                        <table>
                            <tr>
                                <td>Nama Pegawai</td>
                                <td>&nbsp;:
                                    {{$data->pegawai->name}}</td>
                            </tr>
                            <tr>
                                <td>NIP</td>
                                <td>&nbsp;:
                                    {{$data->pegawai->no_pegawai}}</td>
                            </tr>
                            <tr>
                                <td>Pangkat/Golongan</td>
                                <td>&nbsp;:
                                    @if ($data->pegawai->golongan_id != null)
                                        {{$data->pegawai->gol->jenis}} / {{$data->pegawai->gol->golongan}}/{{$data->pegawai->gol->ruang}}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>&nbsp;:
                                    @if ($data->pegawai->jabasn_id != null)
                                        {{$data->pegawai->jabasn->nama}}
                                    @else
                                        {{$data->pegawai->deskjob}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Penempatan Lama</td>
                                <td>&nbsp;:
                                    {{$data->old}}</td>
                            </tr>
                            <tr>
                                <td>Penempatan Baru</td>
                                <td>&nbsp;:
                                    {{$data->new}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Penempatan</td>
                                <td>&nbsp;:
                                    {{tgl_indo($data->placementDate)}}</td>
                            </tr>
                            <tr>
                                <td>Tanaggal Evaluasi</td>
                                <td>&nbsp;:
                                    @php
                                        $today = $now->toDateString();
                                    @endphp
                                    {{tgl_indo($today)}}
                                    <input type="hidden" name="dates" value="{{$today}}">
                                </td>
                            </tr>
                        </table>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Penilian</h3></div>
                    <div class="panel-body">
                       <div class="col-md-12">
                        *range penilaian 0-100
                        <table id="myTable" class="table table-bordered table-hover text-center">
                            <thead>
                                <th style="width: 5%;">No</th>
                                <th style="width: 85%">Pernyataan</th>
                                <th style="width: 10%">Nilai</th>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($detail as $item)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td style="text-align: left;">
                                        {{$item->statement}}
                                        <input type="hidden" name="statement[]" value="{{$item->statement}}">
                                        <input type="hidden" name="nilai_id[]" value="{{$item->id}}"  onkeyup="hitung({{$no}})">
                                    </td>
                                    <td><input type="number" name="values[]" id="nilai-{{$no}}" value="0" style="width: 100%"></td>
                               </tr>   
                                @php
                                    $no++;
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <td colspan="2">Rata - Rata</td>
                                <td><input type="number" readonly name="avg" id="avg"></td>
                            </tfoot>
                        </table>
                        <br>
                        <div>
                            <b>Informasi lain yang penting untuk disampaikan:</b><br>
                            <textarea name="information" cols="2" rows="5" placeholder="ketik disini"></textarea>
                       </div>
                       <input type="hidden" name="stats" value="Y">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-actions right">
                <button class="btn btn-success btn-sm " type="submit">
                    <i class="ace-icon fa fa-check bigger-110"></i>Submit
                </button>
            </div>
        </div>
    </form>
@endsection
@section('footer')
    <script>
        function hitung(i) {
            var a = $("#nilai-"+i).val();
            let sum = 0;
            for (let i = 0; i < a.length; i++) {
                sum += a[i];
            }

            $("#avg").val(sum);
            }
    </script>
@endsection
