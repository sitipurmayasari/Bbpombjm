@extends('layouts.app')
@section('breadcrumb')
    <li>Inventaris</li>
@endsection
@section('content')
	<div class="col-xs-12 col-sm-6" style="text-align: center;">
		<table style="width: 100%">
			<tr>
				<td style="text-align: center;"><h1>BBPOM BANJARMASIN</h1></td>
			</tr>
			<tr>
				<td style="text-align: center;">{!! QrCode::size(300)->generate(request()->getHttpHost().'/qR/'.$data.'/inventaris'); !!}</td>
			</tr>
			<tr>
				<td style="text-align: center;"><h3>{{$invent->nama_barang}}</h3></td>
			</tr>
		</table>
	</div>
@endsection

