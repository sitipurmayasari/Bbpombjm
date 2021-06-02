<div class="card col-sm-12">
    <div class="card-header card-header-warning">
      <h4 class="card-title">Pengumuman</h4>
    </div>
    <div style=" margin-left: 10%; margin-right: 10%;">
      @if ($data != null)
        <div style="text-align: center" >
          <h1>{{$data->judul}}</h1><br>
        </div>
        <div style="font-size: 30;">
          {!! $data->isi !!}
        </div>
      @else
        <h1>Tidak ada Pengumuman</h1>
      @endif
    </div>
</div>