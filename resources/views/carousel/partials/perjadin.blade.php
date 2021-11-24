@inject('injectQuery', 'App\InjectQuery')
<div class="card col-sm-12">
  <div class="card-header card-header-warning">
    <h4 class="card-title">PERJALANAN DINAS</h4>
  </div>
  <div style=" margin-left: 3%; margin-right: 3%; ">
      <table style="width: 100%; font-size: 20px;text-align: center;">
          <thead>
              <tr >
                  <th width="40px" style="text-align: center">No</th>
                  <th  style="text-align: center">No. ST</th>
                  <th  style="text-align: center">Nama kegiatan</th>
                  <th  style="text-align: center">Tujuan</th>
                  <th  style="text-align: center">Petugas</th>
              </tr>
          </thead>
          <tbody>
              @php
                  $no=1;
              @endphp
              @foreach($perjadin as $key=>$row)
                 <tr>
                      <td>{{$no++}}</td>
                      <td>
                         {{$row->number}}
                      </td>
                      <td>
                        {{$row->purpose}}
                     </td>
                     <td>
                      @php
                        $tujuan = $injectQuery->getTujuan($row->id);
                      @endphp
                      @foreach ($tujuan as $item)
                          - {{$item->capital}}
                      @endforeach
                     </td>
                     <td>
                      @php
                        $petugas = $injectQuery->getPetugas($row->id);
                      @endphp
                      @foreach ($petugas as $item)
                          - {{$item->name}} 
                      @endforeach
                     </td>
                 </tr>
             @endforeach
          </tbody>
      </table>
  </div>
</div>