@extends('arsip/layouts_arsip.app')
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


@endsection


@section('footer')

<script>
   $().ready( function () {
    } );
 
</script>
@endsection