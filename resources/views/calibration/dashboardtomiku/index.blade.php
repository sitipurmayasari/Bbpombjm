@extends('layouts.tomi')
@section('breadcrumb')
    <li><i class="fa fa-tachometer"> Dashboard</i></li>
@endsection
@section('content')
<link href="{{asset('assets/css/material.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" /> 
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

<div class="row">
  <div class="col-md-4">
    <div class="card card-chart">
      <div class="card-header card-header-success">
        <div class="ct-chart" id="dailySalesChart"></div>
      </div>
      <div class="card-body">
        <h4 class="card-title">MOnitoring Mikroba</h4>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i> Tahun @php echo date('Y');@endphp
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer')
<script>
    /* ----------==========     Daily Sales Chart initialization    ==========---------- */

   dataDailySalesChart = {
     labels: [
       @foreach($monitor as $key=>$row)
         {{$row->bulan}},
       @endforeach
     ],
     series: [
       [
         @foreach($monitor as $key=>$row)
           {{$row->total}},
         @endforeach
       ]
     ]
   };

   optionsDailySalesChart = {
     lineSmooth: Chartist.Interpolation.cardinal({
       tension: 0
     }),
     low: 0,
     high: 
     15,
      // creative tim: we recommend you to set the high sa the biggest value + something for a better look
     chartPadding: {
       top: 0,
       right: 0,
       bottom: 0,
       left: 0
     },
   }

   var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

   md.startAnimationForLineChart(dailySalesChart);


</script>
@endsection