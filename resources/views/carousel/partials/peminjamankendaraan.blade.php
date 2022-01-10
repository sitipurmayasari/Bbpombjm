@inject('injectQuery', 'App\InjectQuery')
<div class="card col-sm-12">
    <div class="card-header card-header-warning">
      <h4 class="card-title">PEMINJAMAN KENDARAAN DINAS</h4>
    </div>
    <div style=" margin-left: 3%; margin-right: 3%; ">
        <table style="width: 100%; font-size: 20px;text-align: center;">
            <thead>
                <tr>
                    <th width="40px" style="text-align: center">No</th>
                    <th style="text-align: center">Kendaraan Dinas</th>
                    <th style="text-align: center">Status</th>
                    <th style="text-align: center">Tanggal Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach($car as $key=>$row)
                   <tr>
                        <td>{{$no++}}</td>
                        <td>
                            {{$row->merk}} - {{$row->police_number}}
                        </td>
                            @php
                                $tgl_awal = 
                                $isi = $injectQuery->getPinjamMobil($row->id);
                            @endphp
                        <td>
                            @if ($isi != null)
                                @if ($isi->status=='Y')
                                    {{ 'Telah Dipinjam' }}
                                @endif
                            @else
                                {{ 'Tersedia' }}
                            @endif
                        </td>
                        <td>
                            @if ($isi != null)
                                @if ($isi->status=='Y')
                                    {{tgl_indo($isi->date_from)}} s/d {{tgl_indo($isi->date_to)}}
                                @endif
                            @endif
                        </td>
                   </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>