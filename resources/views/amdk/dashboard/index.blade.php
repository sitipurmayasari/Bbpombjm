@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li><i class="fa fa-tachometer"> Dashboard</i></li>
@endsection
@section('content')
<link href="{{asset('assets/css/material.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />


<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<style>
    .box{
        width:45%;
        background:green;
        display: inline-block;
        margin-left: 10;
    }

    th{
      font-weight: bold;
      font-size: 14px;
      text-align: center;
    }
    
</style>    
<div class="col-sm-3">
    <div class="card card-stats">
        @if ($latih->waktu <= 10 )
          <div class="card-header card-header-danger card-header-icon">
        @elseif($latih->waktu >= 10 && $latih->waktu <= 20)
          <div class="card-header card-header-warning card-header-icon">
        @else
          <div class="card-header card-header-success card-header-icon">
        @endif
          <div class="card-icon">
            <i class="material-icons">schedule
            </i>
          </div>
          <p class="card-category">Total Jam Pelajaran anda</p>
          <h1 class="card-title">
            {{$latih->waktu}}
          
          </h1>
        </div>
        <div class="card-footer">
         <label for="">Tahun @php echo date('Y');@endphp</label>
        </div>
      </div>
</div>
<div class="col-sm-3">
  <div class="card card-stats">
      <div class="card-header card-header-warning card-header-icon">
        <div class="card-icon">
          <i class="material-icons">badge</i>
        </div>
        <p class="card-category">Jumlah Pegawai</p>
        <h3 class="card-title">
          {{$jumpeg->total}}
          <small>Orang</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <table>
              @foreach($datapeg as $key=>$row)
              <tr>
                  <td>{{$row->status}} &nbsp; </td>
                  <td>: {{$row->jumlah}}</td>
              </tr>
              @endforeach
          </table>
        </div>
      </div>
    </div>
</div>
@endsection


@section('footer')

<script>
   $().ready( function () {
    } );
 
</script>
@endsection