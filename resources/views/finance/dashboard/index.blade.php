@extends('layouts.mon')
@section('breadcrumb')
    <li><i class="fa fa-tachometer"> Dashboard</i></li>
@endsection
@section('content')
<link href="{{asset('assets/css/dashboard_me.css')}}" rel="stylesheet">  
<div>
  <H1>HELLO WORLD</H1>
</div>
{{-- <div class="col-sm-6" style="text-align: center">
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
</div> --}}

@endsection


@section('footer')
<script>
</script>
@endsection