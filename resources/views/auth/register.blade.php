<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .form-control {
        margin: 4px;
    }
    .control-label:after {
        content:" *";
        color: red;
    }
    .help-block{
        color:red;
    }
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("https://mybuckettiennam12.s3-ap-southeast-1.amazonaws.com/Spinner-1s-200px.gif") center no-repeat;
    }
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
</style>
<div class="container" id="container">
    <div class="overlay"></div>

        @csrf
        <h2>Registration Form</h2>
        <div class="form-group">
            <label for="avatar" class="col-sm-3 control-label">Choose a profile picture:</label>
            <input style="padding-left: 20px" value="https://mybuckettiennam12.s3-ap-southeast-1.amazonaws.com/default.png" type="file" id="avatar" name="avatar" onchange="previewFile(this);" required>
            <div id="preview" style="padding-left: 305px; padding-top: 16px"></div>
            <p id="avatar_error" class="help-block"></p>
        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}" id="divName">
            <label for="fullName" class="col-sm-3 control-label">Full Name</label>
            <div class="col-sm-9">
                <input type="text" id="fullName" name="name" placeholder="Full Name" class="form-control" autofocus required>
                <span style="padding-left: 5px; color: grey;" class="help-block">Last Name, First Name, eg.: Nam,...</span>
                <p id="fullname_error" class="help-block"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('user_name') ? 'has-error' : ''}}">
            <label for="firstName" id="username_label" class="col-sm-3 control-label">User Name</label>
            <div class="col-sm-9">
                <input type="text" id="user_name" name="user_name" placeholder="User Name" class="form-control" autofocus required>
                <p id="username_error" class="help-block"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            <label id="email_label" for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input name="email" type="email" id="email" placeholder="Email" class="form-control" required>
                <p id="email_error" class="help-block"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            <label id="password_label" for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
                <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                <p id="password_error" class="help-block"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
            <label for="password" class="col-sm-3 control-label">Confirm Password</label>
            <div class="col-sm-9">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control" required>
                <p id="password_confirm_error" class="help-block"></p>
            </div>
        </div>

        <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
            <label id="gender_label" class="control-label col-sm-3">Gender</label>
            <div class="col-sm-6">
                <div class="row" id="gender" style="padding-left: 5px">
                    <div class="col-sm-4">
                        <label class="radio-inline" id="femaleRadio_label">
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
                    <p id="gender_error" class="help-block"></p>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button style="margin: 11px" type="submit" id="register" class="btn btn-primary btn-block">Register</button>
            </div>
        </div>

</div>


{{--<script>--}}
{{--    const thisForm = document.getElementById('form');--}}
{{--    thisForm.addEventListener('submit', async function (e) {--}}
{{--        e.preventDefault();--}}
{{--        const formData = new FormData(thisForm).entries()--}}
{{--        const response = await fetch('/api/users', {--}}
{{--            method: 'POST',--}}
{{--            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},--}}
{{--            body: JSON.stringify(Object.fromEntries(formData))--}}
{{--        });--}}

{{--        const result = await response.json();--}}
{{--        console.log(result)--}}
{{--    });--}}
{{--</script>--}}

<script>
    $(document).ready(function () {
        $('#register').click(function (e) {
            // var x = document.getElementById("avatar").required;
            // document.getElementById("avatar_error").innerHTML = x;
            $(document).on({
                ajaxStart: function(){
                    $("body").addClass("loading");
                },
                ajaxStop: function(){
                    $("body").removeClass("loading");
                }
            });
            var person = new FormData();
            var avatar = $('#avatar')[0].files;
            var name = $('#fullName').val();
            var user_name = $('#user_name').val();
            var email = $('#email').val();
            var gender = $('input[name="gender"]:checked').val();
            var password = $('#password').val();
            var password_confirmation = $('#password_confirmation').val();
            person.append('avatar',avatar[0]);
            person.append('user_name',user_name);
            person.append('email',email);
            person.append('name',name);
            person.append('gender',gender);
            person.append('user_name',user_name);
            person.append('password', password),
            person.append('password_confirmation', password_confirmation),
            $.ajax({
                type: 'POST',
                url: '/api/users',
                data: person,
                contentType: false,
                dataType: false,
                processData: false,
                success: function (data) {
                    // if(!data.success) {
                    // $('#fullname_error').html(JSON.parse(data).name);
                    // $('#username_error').html(JSON.parse(data).user_name);
                    // $('#email_error').html(JSON.parse(data).email);
                    // $('#password_error').html(JSON.parse(data).password);
                    // $('#password_confirm_error').html(JSON.parse(data).password);
                    // $('#gender_error').html(JSON.parse(data).gender);
                    // }
                    // else {
                        alert('Verify your email');
                        window.location = '/verify';
                    },
                    error: function (error) {
                        $('#avatar_error').html(JSON.parse(error.responseJSON).avatar);
                        $('#fullname_error').html(JSON.parse(error.responseJSON).name);
                        $('#username_error').html(JSON.parse(error.responseJSON).user_name);
                        $('#email_error').html(JSON.parse(error.responseJSON).email);
                        $('#password_error').html(JSON.parse(error.responseJSON).password);
                        $('#password_confirm_error').html(JSON.parse(error.responseJSON).password);
                        $('#gender_error').html(JSON.parse(error.responseJSON).gender);
                    }


            });
        });
    })

    $( "#fullName" ).keyup(function() {
        $("#fullname_error").empty();
        $("#fullName").css("border-color", "black");
        $("label").css("color", "black");
    });
    $( "#user_name" ).keyup(function() {
        $("#username_error").empty();
        $("#user_name").css("border-color", "black");
        $("#username_label").css("color", "black");
    });
    $( "#email" ).keyup(function() {
        $("#email_error").empty();
        $("#email").css("border-color", "black");
        $("#email_label").css("color", "black");
    });
    $( "#password" ).keyup(function() {
        $("#password_error").empty();
        $("#password").css("border-color", "black");
        $("#password_label").css("color", "black");
    });
    $( "#password_confirmation" ).keyup(function() {
        $("#password_confirm_error").empty();
        $("#password").css("border-color", "black");
        $("#password_label").css("color", "black");
    });
    $( "#femaleRadio" ).click(function() {
        $("#gender_error").empty();
        $(".radio-inline").css("color", "black")
        $("#gender_label").css("color", "black");
    });
    $( "#maleRadio" ).click(function() {
        $("#gender_error").empty();
        $(".radio-inline").css("color", "black")
        $("#gender_label").css("color", "black");
    });
    $( "#unknownRadio" ).click(function() {
        $("#gender_error").empty();
        $(".radio-inline").css("color", "black")
        $("#gender_label").css("color", "black");
    });
    function previewFile(input) {
        const [file] = input.files
        const preview = document.getElementById('preview')
        const reader = new FileReader()

        reader.onload = e => {
            const img = document.createElement('img')
            img.src = e.target.result
            img.width = 200
            img.height = 200
            img.alt = 'file'
            preview.innerHTML =''
            preview.appendChild(img)
        }

        reader.readAsDataURL(file)
    }
</script>
