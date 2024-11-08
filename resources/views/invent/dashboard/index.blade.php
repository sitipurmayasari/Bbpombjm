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
  <div class="col-sm-12" style="text-align: center">
    <div class="card">
        <div class="card-header card-header-warning">
          <h4 class="card-title">TEMPLATE FORM "MANUAL"</h4>
        </div>
        <div class="card-body">
          <table class="table table-hover" style="font-size: 12px;">
            <tr>
              <td>
                <a href="https://docs.google.com/spreadsheets/d/1Wi7OGvVl1Mvvk3n6CdzKsqZftiyw-4Jm/edit?usp=share_link&ouid=116416378023964599190&rtpof=true&sd=true" target="_blank">LINK TEMPLATE</a>
              </td>
              <td></td>
              <td style="text-align: left;">SBBK</td>
            </tr>
            <tr>
              <td>
                <a href="https://docs.google.com/spreadsheets/d/1-hTJGYCXd-r6tJjm-vVZ3hI5smCsXWDm/edit?usp=share_link&ouid=116416378023964599190&rtpof=true&sd=true" target="_blank">LINK TEMPLATE</a>
              </td>
              <td></td>
              <td style="text-align: left;">Permintaan Sampel</td>
            </tr>
            <tr>
              <td>
                <a href="https://docs.google.com/document/d/1B5YOb4dqVQuqZ1rx-FGdwg3sgWl7LO4S/edit?usp=sharing&ouid=116416378023964599190&rtpof=true&sd=true" target="_blank">LINK TEMPLATE</a>
              </td>
              <td></td>
              <td style="text-align: left;">Perbaikan Kerusakan (Non TIK/BMN)</td>
            </tr>
            {{-- <tr>
              <td>
                <a href="https://docs.google.com/document/d/1i4GOYX_VKY6l6SwzgePqCmZ3holLLaon/edit?usp=drive_link&ouid=116416378023964599190&rtpof=true&sd=true" target="_blank">LINK TEMPLATE</a>
              </td>
              <td></td>
              <td style="text-align: left;">Permintaan Barang Baru</td>
            </tr> --}}
            <tr>
              <td>
                <a href="https://docs.google.com/spreadsheets/d/1H5oYTunhF8A3MYNvUivl6pb3HaDHc-do/edit?usp=drive_link&ouid=116416378023964599190&rtpof=true&sd=true" target="_blank">LINK TEMPLATE</a>
              </td>
              <td></td>
              <td style="text-align: left;">Kartu Stock</td>
            </tr>

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
  </div>
</div>
<div class="col-sm-6" style="text-align: center">
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
                 @php
                          $ed =  $injectQuery->hitdataed($row->inventaris_id);
                          $last = $injectQuery->hitdatalast($row->inventaris_id);
                          $total = $injectQuery->hitsisaexp($row->inventaris_id, $row->exp_date);
                          $ins = $row->stockawal;
                          $outs = $total->keluar;
                          $sisanya = $ins - $outs;
                  @endphp

                  @if ($sisanya > 0)
                  <tr>
                    <td>
                        {{$sisanya}}
                    </td>
                    <td>
                      {{$ed->exp_date}}
                    </td>
                    <td>
                      {{$row->barang->no_seri}}
                    </td>
                    <td style="text-align: left">
                      {{$row->barang->nama_barang}}
                    </td>
                    <td>{{$no}}</td>
                  </tr>
                  @endif
              @php $no++; @endphp
              @endforeach
          </tbody> 
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-12" style="text-align: center">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Barang Kimia Yang Akan Kadaluarsa</h4>
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
              @foreach($kimia as $row)
                 @php
                          $ed =  $injectQuery->hitdataed($row->inventaris_id);
                          $last = $injectQuery->hitdatalast2($row->inventaris_id);
                          $total = $injectQuery->hitsisaexp2($row->inventaris_id, $row->exp_date);
                          $ins = $row->stockawal;
                          $outs = $total->keluar;
                          $sisanya = $ins - $outs;
                  @endphp
    
                  @if ($sisanya > 0)
                  <tr>
                    <td>
                        {{$sisanya}}
                    </td>
                    <td>
                      {{$ed->exp_date}}
                    </td>
                    <td>
                      {{$row->barang->no_seri}}
                    </td>
                    <td style="text-align: left">
                      {{$row->barang->nama_barang}}
                    </td>
                    <td>{{$no}}</td>
                  </tr>
                  @endif
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