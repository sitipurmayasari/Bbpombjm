<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import</title>
</head>
<body>
    <form action="{{Route('import.jabasn')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        Excel jabasn : <input type="file" name="jabsn">
        <input type="submit" value="UPLOAD EXCEL JABASN">
    </form><br><br>
    <form action="{{Route('import.users')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        Excel pegawai : <input type="file" name="users">
        <input type="submit" value="UPLOAD EXCEL USER">
    </form><br><br>
    <form action="{{Route('import.inventaris')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        Excel inventaris : <input type="file" name="inventaris">
        <input type="submit" value="UPLOAD EXCEL USER">
    </form>
</body>
</html>