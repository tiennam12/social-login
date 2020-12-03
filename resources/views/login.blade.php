<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">

<div class="container">
    <div class="kpx_login">
        <h3 class="kpx_authTitle">Login or <a href="#">Sign up</a></h3>
        <div class="row kpx_row-sm-offset-3 kpx_socialButtons">
            <div class="col-xs-3 col-sm-3">
                <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-lg btn-block kpx_btn-facebook" data-toggle="tooltip" data-placement="top" title="Facebook">
                    <i class="fa fa-facebook fa-2x"></i>
                    <span class="hidden-xs"></span>
                </a>
            </div>
            <div class="col-xs-3 col-sm-3">
                <a href="{{ route('login.provider', 'google') }}"  class="btn btn-lg btn-block kpx_btn-google-plus" data-toggle="tooltip" data-placement="top" title="Google Plus">
                    <i class="fa fa-google-plus fa-2x"></i>
                    <span class="hidden-xs"></span>
                </a>
            </div>
        </div><br>

        <div class="row kpx_row-sm-offset-3 kpx_loginOr">
            <div class="col-xs-12 col-sm-6">
                <hr class="kpx_hrOr">
                <span class="kpx_spanOr">or</span>
            </div>
        </div>

        <div class="row kpx_row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">
                <form class="kpx_loginForm" action="" autocomplete="off" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                        <input style=" margin-left: 10px" type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <hr />

                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-key"></span></span>
                        <input style=" margin-left: 5px" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <hr>
                    <button class="btn btn-lg btn-outline-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
