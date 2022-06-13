@extends('arsip/layouts_arsip.app')
@section('breadcrumb')
    <li>Arsiparis</li>
    <li>Rekapitulasi Arsip</li>
@endsection
@section('content')
<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                           <a href="{{Route('archivesrek.create')}}"  class="btn btn-primary">Tambah Data</a>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="clearfix"></div>
 <ul class="nav nav-tabs">
     <li class="active"><a href="#tab-aktif" data-toggle="tab">Aktif</a></li>
     <li><a href="#tab-inaktif" data-toggle="tab">Inaktif</a></li>
     <li><a href="#tab-deleted" data-toggle="tab">Perlu Dimusnahkan</a></li>

 </ul>
 <div class="tab-content">
    @include('arsip.archivesrek.partials.aktif')
    @include('arsip.archivesrek.partials.inaktif')
    @include('arsip.archivesrek.partials.deleted')

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
                    window.location = "/arsip/archives/deleteper/"+id;
                }
            });
        });
    } );
</script>
@endsection
