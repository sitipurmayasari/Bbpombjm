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
</style>    
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
 
</script>
@endsection