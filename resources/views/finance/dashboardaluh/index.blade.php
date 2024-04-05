@extends('layouts.aluh')
@section('breadcrumb')
    <li><i class="fa fa-tachometer"> Dashboard</i></li>
@endsection
@section('content')
<link href="{{asset('assets/css/material.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" /> 
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">


<style>
    td{
        font-size: 14;
        font-weight: bold;
    }
  </style>   
  
  <div class="col-sm-12" style="text-align: center">
    <div class="col-sm-12" style="text-align: center">
      <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">DAFTAR LINK ALUH (Analisa Laporan akUntabilitas Hasil kinerja)</h4>
          </div>
          <div class="card-body">
            <table class="table table-hover" style="font-size: 12px;">
                <tbody>   
                    @foreach($data as $key=>$row)
                    <tr>
                        <td>{{$row->name}}</td>
                        <td style="text-align: right;">
                            <a class="btn btn-primary" role="button" href="{{$row->link}}" target="_blank">Klik Disini</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
    </div>

@endsection

@section('footer')

@endsection