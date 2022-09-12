@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Arsiparis</li>
    <li>Daftar Arsip</li>
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
     <li class="active"><a href="#tab-aktif" data-toggle="tab">Aktif</a></li>
     <li><a href="#tab-inaktif" data-toggle="tab">Inaktif</a></li>
     <li><a href="#tab-deleted" data-toggle="tab">Musnah</a></li>

 </ul>
 <div class="tab-content">
    @include('arsip.archiveslist.partials.aktif')
    @include('arsip.archiveslist.partials.inaktif')
    @include('arsip.archiveslist.partials.deleted')

 </div>
@endsection