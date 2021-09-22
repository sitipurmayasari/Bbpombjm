@extends('layouts.app')
@section('breadcrumb')
    <li><i class="fa fa-tachometer"> Dashboard</i></li>
@endsection
@section('content')
<link href="{{asset('assets/css/dashboard_me.css')}}" rel="stylesheet">  
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<style>
</style>   

<div class="col-sm-6" style="text-align: center">
  <div class="col-md-12">
    <div class="card card-chart">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Jumlah Aduan Kerusakan Per Bulan</h4>
      </div>
      <div class="card-header card-header-danger">
        <div class="ct-chart" id="completedTasksChart"></div>
      </div>
      <div class="card-body">
        <h5 class="card-title">Tahun @php echo date('Y');@endphp</h5>
      </div>
      <div class="card-footer">
      </div>
    </div>
    <div class="col-sm-12" style="text-align: center">
      <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Jadwal Maintenance Inventaris Bulan ini</h4>
          </div>
          <div class="card-body">
          
            <table class="table table-hover" style="font-size: 12px;">
              <thead>
                  <th>Penanggung Jawab</th>
                  <th>Merk</th>
                  <th>Nama Barang</th>
                  <th>tanggal</th>
                  <th>No</th>
              </thead>
              <tbody>
                  @foreach($jadwal as $key=>$row)
                  <tr>
                    @if ($row != null)
                      <td>{{$row->barang->penanggung->name}}</td>
                      <td>{{$row->barang->merk}}</td>
                      <td>{{$row->barang->nama_barang}}</td>
                      <td>{{$row->tanggal}}</td>
                      <td>{{$jadwal->firstItem() + $key}}</td>
                    @else
                      <td colspan="5">TIDAK ADA JADWAL MAINTENACE</td>
                    @endif
                  </tr>
                  @endforeach
              </tbody> 
            </table>
          
          </div>
        </div>
  </div>
  <div class="col-sm-12" style="text-align: center">
    <div class="card">
        <div class="card-header card-header-warning">
          <h4 class="card-title">Perpanjang Pajak Kendaraan Dinas Bulan ini</h4>
        </div>
        <div class="card-body">
          <table class="table table-hover" style="font-size: 12px;">
            <thead>
                <th>Tanggal Pajak</th>
                <th>Tanggal Plat</th>
                <th>Nomor Polisi</th>
                <th>Merk / Type</th>
                <th>No</th>
            </thead>
            <tbody>
                @foreach($car as $key=>$row)
                <tr>
                  @if ($row != null)
                    <td>{{$row->police_number_date}}</td>
                    <td>{{$row->tax_date}}</td>
                    <td>{{$row->police_number}}</td>
                    <td>{{$row->merk}} / {{$row->type}}</td>
                    <td>{{$car->firstItem() + $key}}</td>
                  @else
                    <td colspan="5">TIDAK ADA JADWAL MAINTENACE</td>
                  @endif
                </tr>
                @endforeach
            </tbody> 
          </table>
        
        </div>
      </div>
  </div>
</div>
</div>

<div class="col-sm-6" style="text-align: center">
  <div class="col-sm-6" style="text-align: center">
    <div class="card">
        <div class="card-header card-header-warning">
          <i class="material-icons">commute</i> 
          <h4 class="card-title">Pengajuan Peminjaman Kendaraan Dinas</h4>
        </div>
        <div class="card-body">
          Tanggal {{$dinas->date_from}} s/d {{$dinas->date_to}}
          <h1 class="card-title">
            @if ($dinas->status==null)
                Menunggu
            @elseif($dinas->status=='Y')
                Disetujui
            @else
                Ditolak
            @endif
          </h1>
        </div>
      </div>
  </div>
  <div class="col-sm-6" style="text-align: center">
    <div class="card">
        <div class="card-header card-header-warning">
          <i class="material-icons">pending_actions</i> 
          <h4 class="card-title">Pengajuan Barang baru</h4>
        </div>
        <div class="card-body">
          <h5>Pengajuan :
            @php
              $a = $tglaju->tgl_ajuan;
              echo tgl_indo($a); 
            @endphp
          </h5>
          <table class="table table-hover" style="font-size: 12px;">
            <thead>
                <th>Status</th>
                <th>Nama Barang</th>
            </thead>
            <tbody>
                @foreach($aju as $key=>$row)
                <tr>
                  @if ($row != null)
                    <td>
                      @if ($row->status==1)
                        Disetujui
                      @elseif($row->status==2)   
                        Ditolak 
                      @else
                          Menunggu
                      @endif
                    </td>
                    <td>{{$row->nama_barang}}</td>
                  @else
                    <td colspan="5">TIDAK ADA PENGAJUAN</td>
                  @endif
                </tr>
                @endforeach
            </tbody> 
          </table>
        </div>
      </div>
  </div>
</div>

@endsection


@section('footer')
<script>
 
  /* ----------==========    Chart initialization    ==========---------- */

  dataCompletedTasksChart = {
    labels: [
      @foreach($aduan as $key=>$row)
          {{$row->bulan}},
        @endforeach
      ],
    series: [
      [
        @foreach($aduan as $key=>$row)
          {{$row->jumlah}},
        @endforeach
      ]
    ]
  };

  optionsCompletedTasksChart = {
    lineSmooth: Chartist.Interpolation.cardinal({
      tension: 0
    }),
    low: 0,
    high: 20,
    chartPadding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    }
  }

  var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

  // start animation for the Completed Tasks Chart - Line Chart
  md.startAnimationForLineChart(completedTasksChart); 

</script>
@endsection