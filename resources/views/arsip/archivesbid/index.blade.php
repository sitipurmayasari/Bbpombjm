@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Arsiparis</li>
    <li>Arsip {{$div->nama}}</i></li>
@endsection
@section('content')

<div class="clearfix"></div>
 <ul class="nav nav-tabs">
     <li class="active"><a href="#tab-aktif" data-toggle="tab">Aktif</a></li>
     <li><a href="#tab-inaktif" data-toggle="tab">Inaktif</a></li>
     <li><a href="#tab-deleted" data-toggle="tab">Perlu Dimusnahkan</a></li>

 </ul>
 <div class="tab-content">
    @include('arsip.archivesbid.partials.aktif')
    @include('arsip.archivesbid.partials.inaktif')
    @include('arsip.archivesbid.partials.deleted')

 </div>
@endsection

@section('footer')
<script>
    $().ready( function () {
        $(".delete").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = "/arsip/archivesbid/delete/"+id;
                }
            });
        });
    } );
</script>
@endsection
