@extends('layouts.pr')
@section('breadcrumb')
<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Detail Agenda</li>
    </ol>
  </nav>
<style>
    .kartu{
        padding-top: 2%;
        padding-right: 10%;
        padding-left: 10%;
        background: #60edc3;
        margin-left: 20%;
        margin-right: 20%;
        border-radius: 25px;
        height: 400px;
    }
</style>
@endsection
@section('content')
    <div class='kartu'>
        <div style="text-align:center;  line-height: 1px;">
            <h1>{{$data->titles}}</h1>
            <hr style="border: 2px solid green;">
        </div>
        <div style="text-align: justify;">
            Tanggal : 
            @if ($data->date_from == $data->date_to)
            {{tgl_indo($data->date_from)}}
            @else
            {{tgl_indo($data->date_from)}} s/d {{tgl_indo($data->date_to)}} 
            @endif
            <br>
            <br>
            <p style="text-align: justify; font-size=14px">
                <b>{{$data->detail}}</b>
            </p>
        </div>
    </div>
@endsection

@section('footer')

<script>

</script>
@endsection
