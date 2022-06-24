@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Arsiparis</li>
    <li>Input Data Arsip</i></li>
@endsection
@section('content')
<style>
    .kotak{
        padding: 10px;
        text-align: center;
        vertical-align: middle;
    }
</style>

    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <h1 style="text-align: center">Pilih Bidang Arsip</h1>
                <div class="form-group col-sm-12">
                    <div class=" col-sm-1" >
                    </div>
                    <form action="/arsip/bidang" method="get">
                        <div class="kotak col-sm-2" >
                            <a class="social-icon" href="/arsip/archives/bidang/{{2}}" >
                                <img src="{{asset('images/tatausaha.png')}}" style="height:100%; width:100%">
                              </a>   
                        </div>
                        <div class="kotak col-sm-2" >
                            <a class="social-icon" href="/arsip/archives/bidang/{{5}}">
                                <img src="{{asset('images/infokom.png')}}" style="height:100%; width:100%">
                              </a>   
                        </div>
                        <div class="kotak col-sm-2" >
                            <a class="social-icon" href="/arsip/archives/bidang/{{4}}" >
                                <img src="{{asset('images/pengujian.png')}}" style="height:100%; width:100%">
                              </a>   
                        </div>
                        <div class="kotak col-sm-2" >
                            <a class="social-icon" href="/arsip/archives/bidang/{{6}}" >
                                <img src="{{asset('images/pemeriksaan.png')}}" style="height:100%; width:100%">
                              </a>   
                        </div>
                        <div class="kotak col-sm-2" >
                            <a class="social-icon" href="/arsip/archives/bidang/{{3}}" >
                                <img src="{{asset('images/penindakan.png')}}" style="height:100%; width:100%">
                              </a>   
                        </div>
                    </form>
                    <div class=" col-sm-1" >
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
@endsection
