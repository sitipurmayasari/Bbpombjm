<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<div class="text-center" style="margin-top: 50px;">
		<h3>{{$data->nama_barang}}</h3>
        {{-- {{$data}} --}}
		{!! QrCode::size(300)->generate(request()->getHttpHost().'/qR/'.$data.'/inventaris'); !!}

		{{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate(request()->getHttpHost().'/qR/'.$data.'/inventaris')) !!} "> --}}
	</div>
</body>
</html>

