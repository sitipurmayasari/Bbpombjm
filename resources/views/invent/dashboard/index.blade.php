@inject('injectQuery', 'App\InjectQuery')
@extends('layouts.app')
@section('breadcrumb')
    <li><i class="fa fa-tachometer"> Dashboard</i></li>
@endsection
@section('content')
<link href="{{asset('assets/css/dashboard_me.css')}}" rel="stylesheet">  
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<style>
  th{
    text-align: center;
    font-weight: bold;
  }
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
          <h4 class="card-title">Peminjaman Kendaraan Dinas</h4>
        </div>
        <div class="card-body">
          @if ($dinas!= null)
            Tanggal {{$dinas->date_from}} s/d {{$dinas->date_to}}
            
              @if ($dinas->status==null)
                <h1 class="card-title">Menunggu</h1>
              @elseif($dinas->status=='Y')
                <h1 class="card-title">Disetujui</h1><br>
                <h5>Kendaraan : {{$dinas->car->merk}} ( {{$dinas->car->police_number}}</h5>
                @if ($dinas->driver_id != null)
                  <h5>Supir : {{$dinas->supir->name}}</h5>
                @endif
              @else
                <h1 class="card-title">Ditolak</h1>
              @endif
            
          @else
              <h1 class="card-title">Belum Ada Pengajuan </h1>
          @endif
          
          
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
         
           @if ($tglaju != null)
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
                    </tr>
                    @endforeach
                </tbody> 
              </table>
           @else
              <h1>Belum Ada Pengajuan</h1>
           @endif
       
        </div>
      </div>
  </div>
  <div class="col-sm-12" style="text-align: center">
    <div class="card">
        <div class="card-header card-header-warning">
          <h4 class="card-title">Media Mikrobiologi Yang Akan Kadaluarsa</h4>
        </div>
        <div class="card-body">
        
          <table class="table table-hover" style="font-size: 12px;">
            <thead>
                <th>Sisa</th>
                <th>Tgl. Kadaluarsa</th>
                <th>No. Katalog</th>
                <th>Nama Barang</th>
                <th>No</th>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($mikro as $row)
                <tr>
                  @if ($row != null)
                    <td>
                      {{-- @php
                          $kadaluarsa = $injectQuery->getkada($row->barang->id);
                      @endphp --}}
                    </td>
                    <td>

                    </td>
                    <td>{{$row->barang->no_seri}}</td>
                    <td style="text-align: left">{{$row->barang->nama_barang}}</td>
                    <td>{{$no}}</td>
                  @else
                    <td colspan="5">TIDAK ADA STOK KADALUARSA</td>
                  @endif
                </tr>
                @php $no++; @endphp
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