<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .form-control {
        margin: 8px;
    }
</style>
<div class="container">
    <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
        @csrf
        <h2>Registration Form</h2>
        <div class="form-group">
            <label for="avatar" class="col-sm-3 control-label">Choose a profile picture:</label>
                <input type="file" id="avatar" name="avatar">
        </div>
        <div class="form-group">
            <label for="fullName" class="col-sm-3 control-label">Full Name</label>
            <div class="col-sm-9">
                <input type="text" id="fullName" name="name" placeholder="Full Name" class="form-control" autofocus>
                <span class="help-block">Last Name, First Name, eg.: Nam,...</span>
            </div>
        </div>
        <div class="form-group">
            <label for="firstName" class="col-sm-3 control-label">Full Name</label>
            <div class="col-sm-9">
                <input type="text" id="user_name" name="user_name" placeholder="Full Name" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input name="email" type="email" id="email" placeholder="Email" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
                <input type="password" name="password" id="password" placeholder="Password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Confirm Password</label>
            <div class="col-sm-9">
                <input type="password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                <span id='message'></span>
            </div>
        </div>
        {{--        <div class="form-group">--}}
        {{--            <label for="birthDate" class="col-sm-3 control-label">Date of Birth</label>--}}
        {{--            <div class="col-sm-9">--}}
        {{--                <input type="date" id="birthDate" class="form-control">--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="form-group">--}}
        {{--            <label for="country" class="col-sm-3 control-label">Country</label>--}}
        {{--            <div class="col-sm-9">--}}
        {{--                <select id="country" class="form-control">--}}
        {{--                    <option>Afghanistan</option>--}}
        {{--                    <option>Bahamas</option>--}}
        {{--                    <option>Cambodia</option>--}}
        {{--                    <option>Denmark</option>--}}
        {{--                    <option>Ecuador</option>--}}
        {{--                    <option>Fiji</option>--}}
        {{--                    <option>Gabon</option>--}}
        {{--                    <option>Haiti</option>--}}
        {{--                </select>--}}
        {{--            </div>--}}
        {{--        </div> <!-- /.form-group -->--}}
        <div class="form-group">
            <label class="control-label col-sm-3">Gender</label>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="femaleRadio" value="Female">Female
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="maleRadio" value="Male">Male
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="unknownRadio" value="Unknown">Unknown
                        </label>
                    </div>
                </div>
            </div>
        </div> <!-- /.form-group -->
        {{--        <div class="form-group">--}}
        {{--            <label class="control-label col-sm-3">Meal Preference</label>--}}
        {{--            <div class="col-sm-9">--}}
        {{--                <div class="checkbox">--}}
        {{--                    <label>--}}
        {{--                        <input type="checkbox" id="calorieCheckbox" value="Low calorie">Low calorie--}}
        {{--                    </label>--}}
        {{--                </div>--}}
        {{--                <div class="checkbox">--}}
        {{--                    <label>--}}
        {{--                        <input type="checkbox" id="saltCheckbox" value="Low salt">Low salt--}}
        {{--                    </label>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div> <!-- /.form-group -->--}}
        {{--        <div class="form-group">--}}
        {{--            <div class="col-sm-9 col-sm-offset-3">--}}
        {{--                <div class="checkbox">--}}
        {{--                    <label>--}}
        {{--                        <input type="checkbox">I accept <a href="#">terms</a>--}}
        {{--                    </label>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div> <!-- /.form-group -->--}}
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </div>
    </form>
{{--    <form method="POST" action="{{ url('/register') }} class="form-horizontal" role="form">--}}

{{--    </form> <!-- /form -->--}}
</div> <!-- ./container -->
<script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    if (document.getElementById('femaleRadio').checked) {
        rate_value = document.getElementById('femaleRadio').value;
    } else if (document.getElementById('maleRadio').checked) {

    } else {
        document.getElementById('unknownRadio').value;
    }
</script>
