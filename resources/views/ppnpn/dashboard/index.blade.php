@extends('ppnpn/layouts.app')
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
@if ($poinabsen != null)
<div class="col-sm-4" style="text-align: center">
  <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Poin Si Amat Anda</h4>
      </div>
      <div class="card-body">
        <table class="table table-hover" style="font-size: 12px;">
          <thead>
            <th>No</th>
            <th>Periode</th>
            <th>Poin</th>
          </thead>
          <tbody>
              @php
                  $no = 1;
              @endphp
              @foreach($poinabsen as $row)
              <tr>
                  <td>{{$no}}</td>
                  <td>
                    @if ($row->periode_month == 1)
                       Januari
                    @elseif ($row->periode_month == 2)
                      Februari
                    @elseif ($row->periode_month == 3)
                      Maret
                    @elseif ($row->periode_month == 4)
                      April
                    @elseif ($row->periode_month == 5)
                      Mei
                    @elseif ($row->periode_month == 6)
                      Juni
                    @elseif ($row->periode_month == 7)
                      Juli
                    @elseif ($row->periode_month == 8)
                      Agustus
                    @elseif ($row->periode_month == 9)
                      September
                    @elseif ($row->periode_month == 10)
                      Oktober
                    @elseif ($row->periode_month == 11)
                      November
                    @else
                      Desember
                    @endif
                    &nbsp; {{$row->periode_year}}
                  </td>
                  <td>{{$row->jumpoin}}</td>
              </tr>
              @php
                  $no++;
              @endphp
              @endforeach
          </tbody> 
        </table>
      
      </div>
    </div>
</div>
@endif


@endsection


@section('footer')

<script>
   $().ready( function () {
    } );
 
</script>
@endsection