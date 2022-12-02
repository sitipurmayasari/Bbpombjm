@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Rekapitulasi</li>
    <li><a href="/amdk/rekpermit">Rekap Absensi Pramubakti</a></li>
    <li>Daftar Absensi (Nama) Periode (Periode)</li>
@endsection
@section('content')
    <div class="table-responsive">
        <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
                <th width="40px" style="text-align: center">No</th>
                <th style="text-align: center">Nama</th>
                <th style="text-align: center">Periode</th>
                <th style="text-align: center">tipe</th>
                <th style="text-align: center">Jam Masuk</th>
                <th style="text-align: center">Jam Pulang</th>
                <th style="text-align: center">terlambat</th>
                <th style="text-align: center">Pulang Cepat</th>
                <th style="text-align: center">keterangan</th>
                <th style="text-align: center">poin</th>
                <th style="text-align: center">Edit</th>
            <thead>
            <tbody>   	
                @php
                    $no = 1;
                @endphp
                @foreach($data as $key=>$row)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$row->peg->name}}</td>
                    <td>{{tgl_indo($row->tanggal)}}</td>
                    <td>{{$row->tipe}}</td>
                    <td>
                        @if ($row->scan_masuk != null)
                            {{$row->scan_masuk}}
                        @endif
                    </td>
                    <td>
                        @if ($row->scan_pulang != null)
                            {{$row->scan_pulang}}
                        @endif
                    </td>
                    <td>
                        @if ($row->terlambat != null)
                            {{$row->terlambat}}
                        @endif
                    </td>
                    <td>
                        @if ($row->pulang_cepat != null)
                            {{$row->pulang_cepat}}
                        @endif
                    </td>
                    <td>
                        {{$row->status->ket}}
                    </td>
                    <td>{{$row->poin}}</td>
                    <td>
                        <a href="/amdk/rekpermit/edit/{{$row->id}}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                    </td>
                </tr>
                  @php
                      $no++;
                  @endphp
                @endforeach
            <tbody>
        </table>
    </div>
@endsection
