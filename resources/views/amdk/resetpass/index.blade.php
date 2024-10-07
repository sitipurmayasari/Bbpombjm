@extends('amdk/layouts_amdk.app')
@section('breadcrumb')
    <li>Setup</li>
    <li> Reset Password </li>
@endsection
@section('content')

<style>
    #eye{
        z-index: 1; /* set higher z-index value */
        position: relative; /* position must be set for z-index to work */
        cursor: pointer; 
        margin-left:-30px;
    }
</style>

<div class="row">
    <form class="form-horizontal validate-form" role="form" 
         method="post" action="{{route('resetpass.store')}}">
         {{ csrf_field() }}
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Reset Password Berkala</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding" col-sm-8>
                    <fieldset>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Password Default
                        </label>
                        <div class="col-sm-8">
                            <input type="password" id="password" value="{{$data->newpass}}" 
                            name="defaultpass" required /> 
                            <i class="fa fa-eye" onclick="eye()" id="eye"></i>
                                    <br>
                            <label class="col-xs-12 col-sm-12" for="">Terakhir Update : {{$data->created_at}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Password Baru
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  placeholder=" Password Baru" 
                                    class="col-xs-10 col-sm-3 required " 
                                    name="newpass" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" 
                        for="form-field-1"> Update Pass Terakhir
                        </label>
                        <div class="col-sm-8">
                            <input type="date" 
                                    class="col-xs-6 col-sm-3 required " 
                                    name="resetbefore" required />
                        </div>
                    </div>
                    
                    </fieldset>        
                </div>
            </div>
        </div>
    </div><!-- /.col -->
    
    <div class="col-sm-12">
        <div class="form-actions right">
            <button class="btn btn-success btn-sm " type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Simpan
            </button>
        </div>
    </div>
    </form>
</div>
@endsection

@section('footer')
    <script>
        function eye() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eye");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";   

                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");   

            }
        }
    </script>
@endsection