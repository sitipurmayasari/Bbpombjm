@extends('layouts.lab')
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

<div class="col-sm-4">
    <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">science</i>
          </div>
          <p class="card-category">Jumlah Alat Gelas</p>
        </div>
        <div class="card-footer">
          <div class="stats">
            <table>
                @foreach($dataglass as $key=>$row)
                <tr>
                    <td>{{$row->jenis->nama}} &nbsp; </td>
                    <td>: {{$row->jumlah}} buah</td>
                </tr>
                @endforeach
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
@section('footer')
@endsection