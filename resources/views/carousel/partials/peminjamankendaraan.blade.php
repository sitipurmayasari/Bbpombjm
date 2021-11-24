<div class="card col-sm-12">
    <div class="card-header card-header-warning">
      <h4 class="card-title">PEMINJAMAN KENDARAAN DINAS</h4>
    </div>
    <div style=" margin-left: 3%; margin-right: 3%; ">
        <table style="width: 100%; font-size: 20px;text-align: center;">
            <thead>
                <tr>
                    <th width="40px" style="text-align: center">No</th>
                    <th style="text-align: center">Nama Peminjam</th>
                    <th style="text-align: center">Tanggal Peminjaman</th>
                    <th style="text-align: center">Tujuan</th>
                    <th style="text-align: center">Kendaraan Dinas</th>
                    <th style="text-align: center">Supir</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach($mobil as $key=>$row)
                   <tr>
                        <td>{{$no++}}</td>
                        <td>
                            {{$row->pegawai->name}} <br>
                            @if ($row->pegawai->subdivisi_id != null)
                                {{$row->pegawai->divisi->nama}} - {{$row->pegawai->subdivisi->nama_subdiv}}
                            @else
                                {{$row->pegawai->divisi->nama}}
                            @endif
                        </td>
                        <td>
                            {{tgl_indo($row->date_from)}} <br> s/d <br> {{tgl_indo($row->date_to)}}
                        </td>
                        <td>
                            {{$row->destination}}
                        </td>
                        <td>
                            {{$row->car->merk}} - {{$row->car->police_number}}
                        </td>
                        <td>
                            @if ($row->driver_id != null)
                                    {{$row->supir->name}}
                            @else
                                -
                            @endif    
                        </td>
                   </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>