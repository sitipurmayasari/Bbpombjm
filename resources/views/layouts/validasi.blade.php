<div class="clearfix"></div>
@if($errors->any())
<div class="col-xs-12">
        <div class="alert alert-warning alert-dismissible" role="alert">
                <strong>Perhatian !</strong> Cek Beberapa Field Berikut.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </div>
            </div>
</div>
@endif