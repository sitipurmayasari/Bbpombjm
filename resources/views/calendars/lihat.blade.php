@extends('layouts.pr')
@section('breadcrumb')
<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Kalender Agenda</li>
    </ol>
  </nav>

@endsection
@section('content')
    <div style="text-align:center";>
            <h1>Detail Agenda</h1>
    </div>
    <table style="width: 100%; font-size:14px">
        <tr>
            <td>Judul</td>
            <td>Kegiatan</td>
            <td>Dari</td>
            <td>Sampai</td>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{$item->titles}}</td>
                <td>{{$item->detail}}</td>
                <td>{{$item->date_from}}</td>
                <td>{{$item->date_to}}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')

<script>

</script>
@endsection
