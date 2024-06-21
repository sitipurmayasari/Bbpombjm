@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><a href="/amdk/evaluasi">Evaluasi Pelatihan</a>
        <li>PENILAIAN</li>
    </li>
@endsection
@section('content')
<style>
    table{
        width: 100%;
    }
    th{
        text-align: center;
    }
</style>

@include('layouts.validasi')
 <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('evaluasi.store')}}" enctype="multipart/form-data"   >
    {{ csrf_field() }}
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">DATA PESERTA</h3></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <input type="hidden" name="pelatihan_id" value="{{$data->id}}">
                    <input type="hidden" name="date" value="{{date('Y-m-d')}}">
                    <table>
                        <tr>
                            <td style="width: 20%;">Nama Peserta Pelatihan</td>
                            <td style="text_align:center; width:1%;">:</td>
                            <td>
                                {{$data->user->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pelatihan yang diikuti</td>
                            <td>:</td>
                            <td>
                                {{$data->nama}}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Pelaksanaan Pelatihan</td>
                            <td>:</td>
                            <td>
                                @if ($data->dari == $data->sampai)
                                    {{tgl_indo($data->dari)}}
                                @else
                                    {{tgl_indo($data->dari)}} s/d {{tgl_indo($data->sampai)}}
                                @endif
                            </td>
                            <tr>
                                <td>Penyelenggara Pelatihan</td>
                                <td>:</td>
                                <td>
                                    {{$data->penyelenggara}}
                                </td>
                            </tr>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">PENILAIAN</h3></div>
            <div class="panel-body">
                <table id="myTable" class="table table-bordered table-hover text-center">
                    <p>
                        Keterangan penilaian : <br>
                        5 : Sangat Sesuai <br>
                        4 : Sesuai <br>
                        3 : Netral <br>
                        2 : Tidak Sesuai <br>
                        1 : Sangat Tidak Sesuai

                    </p>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Aspek yang dievaluasi</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($aspek as $key=>$row)
                        <tr>
                            <td style="vertical-align: top;">
                                {{$no}}
                            </td>
                            <td style="text-align: left; width:70%;">
                                {{$row->aspek}}
                                <input type="hidden" value="{{$row->aspek}}" name="aspek_evaluasi[]">
                            </td>
                           <td>
                            <input type="radio" value="1" name="point[][{{$no}}]"/> &nbsp; <b>1</b> &nbsp;
                            <input type="radio" value="2" name="point[][{{$no}}]"/> &nbsp; <b>2</b> &nbsp;
                            <input type="radio" value="3" name="point[][{{$no}}]"/> &nbsp; <b>3</b> &nbsp;
                            <input type="radio" value="4" name="point[][{{$no}}]"/> &nbsp; <b>4</b> &nbsp;
                            <input type="radio" value="5" name="point[][{{$no}}]"/> &nbsp; <b>5</b> &nbsp;
                           </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"> penguasaan kompetensi dan perubahan sikap/perilaku</h3></div>
            <div class="panel-body">
                <p>
                    apakah setelah pelatihan peserta diberi penugasan sesuai dengan pelatihan yang telah diikuti? Jika iya, jelaskan penugasan yang diberikan :
                </p>
                <textarea name="coment" class="col-md-12" rows="5" placeholder="Isi Penjelasan" required></textarea>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-actions right">
                <button class="btn btn-success btn-sm " type="submit">
                    <i class="ace-icon fa fa-check bigger-110"></i>Simpan
                </button>
            </div>
        </div>
    </div>
 </form>
@endsection
