@extends('layouts.aluh')
@inject('injectQuery', 'App\InjectQuery')
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

    table , tr, td{
      width: 100%;
    }
  </style>   
  
  <div class="col-sm-12" style="text-align: center">
    <div class="col-sm-12" style="text-align: center">
      <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">ALUH (KENDALA, REKOMENDASI, RENCANA TINDAK LANJUT & ARAHAN PIMPINAN)</h4>
          </div>
          <div class="card-body">
            <div>
              @if ($data != null)
              @foreach ($data as $item)
              <div class="widget-box">
                  <div class="widget-header">
                      <h4 class="widget-title"> <b>IKU {{$item->year}}</b></h4>
                      <div class="widget-toolbar">
                          <a href="#" data-action="collapse">
                              <i class="ace-icon fa fa-chevron-down"></i>
                          </a>
                      </div>
                  </div>
                  <div class="widget-body" style="display: none;">
                      <div class="widget-main no-padding">  
                        @php
                          $isi = $injectQuery->getIkuAluh($item->year);
                        @endphp
                        <table>
                          @foreach ($isi as $detail)
                          <tr>
                            <td>
                                <a href="{{$detail->link}}" class="btn btn-primary btn-lg btn-block">
                                  {{$detail->name}}
                                  <i class="fa fa-external-link" aria-hidden="true"></i>
                                </a>
                              {{-- <br> &nbsp; --}}
                            <td>
                          </tr>
                          @endforeach
                        </table>
                      </div>  
                  </div>
              </div>
              @endforeach
              @endif
            </div>
        </div>
    </div>

@endsection

@section('footer')

@endsection