@extends('qms/layouts_qms.app')
@section('breadcrumb')
    <li>Makro</li>
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
                <h1 style="text-align: center">Pilih Folder SOP Makro</h1>
                <div class="form-group col-sm-12">
                    <form action="/qms/mikro" method="get">
                        @foreach ($data as $item)
                            <div class="kotak col-sm-1" >
                                <a class="social-icon" href="/qms/mikro/folder/{{$item->id}}" >
                                    <img src="{{asset('images/3d-folder.png')}}" style="height:100%; width:100%">
                                    {{$item->name}}
                                </a>   
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
