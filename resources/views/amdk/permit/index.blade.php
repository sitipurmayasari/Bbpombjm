@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Absensi Pramubakti</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="clearfix"></div>
 <ul class="nav nav-tabs">
     <li class="active"><a href="#tab-blnlalu" data-toggle="tab">Bulan Lalu</a></li>
     <li><a href="#tab-blnini" data-toggle="tab">Bulan Ini</a></li>

 </ul>
 <div class="tab-content">
    @include('amdk.permit.partials.blnlalu')
    @include('amdk.permit.partials.blnini')

 </div>
@endsection