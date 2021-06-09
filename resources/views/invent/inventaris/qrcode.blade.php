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
		<h3>Inventaris QR Code</h3>
	
		{!! QrCode::size(300)->generate('http://bbpombjm.online/invent/inventaris/detail/'.$data->id); !!}
		{{-- {!! QrCode::size(300)->generate('http://bbpom.test/invent/inventaris/edit/'.$data->id); !!} --}}
	</div>
</body>
</html>

