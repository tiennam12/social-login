<div id="load" style="position: relative;">
    <table style="border: none" class="table">
        <thead class="thead-light">
        <tr  class="text-center" style="vertical-align: middle">
            <th scope="col">ID</th>
            <th scope="col">Avatar</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Provider</th>
            <th scope="col">Provider id</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="text-center row_{{ $user->id }}" style="vertical-align: middle">
                <td>{{ $user->id }}</td>
                <td width="70px">
                    @if($user->avatar)
                        <img src="{{ config('user.urlAva'). $user->avatar }}" onerror="this.onerror=null; this.src='{{ config('user.defaultAva') }}'" alt="ava" width="50" height="50">
                    @else
                        <img src="{{ config('user.defaultAva') }}" width="50px" height="50px">
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if( $user->provider == 'facebook')
                    <td><i class="fab fa-facebook-square fa-3x"></i></td>
                @elseif( $user->provider == 'google')
                    <td><i class="fab fa-google fa-3x"></i></td>
                @else
                    <td><i class="fas fa-globe fa-3x"></i></td>
                @endif
                    <td>{{ $user->provider_id }}</td>
                <td>
                    @if($user->status==0)
                        <button style="border: none; background-color: white; outline: none; cursor:pointer;" id="lock" class="lock_{{ $user->id }} lock" type="button" value="{{ $user->id }}" title="lock" data-toggle="lock">
                            <i class="fas fa-lock-open" style="pointer-events:none; color: #80bfff"></i>
                        </button>
                     @else
                        <button style="border: none; outline: none; background-color: white; cursor:pointer;" id="lock" class="lock_{{ $user->id }} lock" type="button" value="{{ $user->id }}" title="unlock" data-toggle="unlock">
                            <i class="fas fa-lock" style="pointer-events:none; color: #80bfff"></i>
                        </button>
                    @endif
                    <button style="border: none; outline: none; background-color: white; cursor:pointer;" id="delete" class="delete" type="button" value="{{ $user->id }}" title="delete" data-toggle="delete">
                        <i class="fas fa-trash-alt" style="pointer-events:none; color: #80bfff"></i>
                    </button>
                    <button style="border: none; background-color: white; outline: none; cursor:pointer;" id="edit" class="edit" type="button" value="{{ $user->id }}" title="edit" data-toggle="edit">
                        <i class="far fa-edit" style="pointer-events:none; color: #80bfff"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! $users->links('pagination::bootstrap-4') !!}

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="delete"]').tooltip();
    });
    $(document).ready(function(){
        $('[data-toggle="edit"]').tooltip();
    });
    $(document).ready(function(){
        $('[data-toggle="lock"]').tooltip();
    });
    $(document).ready(function(){
        $('[data-toggle="unlock"]').tooltip();
    });
    $(document).ready(function () {
        $('.edit').click(function (e) {
            var i = e.target.value;
            $.ajax({
                type: "GET",
                url: 'api/users/'+i,
                dataType: "json",
                success: function (result) {
                    $("h1").empty();
                    var table = $("<table>");
                    table.append("<h1>Edit User</h1>");
                    table.append("<tr><td>Id:</td><td>"+ result["data"]["id"] +"</td></tr>");
                    table.append("<tr><td>Name:</td><td><input id='name' value=" + result["data"]["name"] + "></td></tr>");
                    table.append("<tr><td>Email:</td><td><input id='email' value=" + result["data"]["email"] + "></td></tr>");
                    table.append("<tr><td>Provider id:</td><td>"+ result["data"]["provider_id"] +"</td></tr>");
                    if (result["data"]["provider"]=='facebook') {
                        table.append("<tr><td>Provider:</td><td><i class='fab fa-facebook-square fa-3x'></i></td></tr>");
                    } else if(result["data"]["provider"]=='google') {
                        table.append("<tr><td>Provider:</td><td><i class=\"fab fa-google fa-3x\"></i></td></tr>");
                    } else {
                        table.append("<tr><td>Provider:</td><td><i class=\"fas fa-globe fa-3x\"></i></td></tr>")
                    }
                    table.append("<tr><td><button class='save' id='save'>Save</button></td><td><button class='cancel' id='cancel'>Cancel</button></td></tr>");
                    $('#table').html(table);
                    $(".cancel").click(function (e) {
                        swal({
                            title: "",
                            text: "Cancel",
                            icon: "warning",
                        })
                            .then((willSave) => {
                                if (willSave) {
                                    location.reload();
                                }
                            });
                    });
                    $(".save").click(function (e) {
                        e.preventDefault();
                        var id = result["data"]["id"];
                        var name = $("#name").val();
                        var email = $("#email").val();
                        var provider = result["data"]["provider"];
                        var provider_id = result["data"]["provider_id"];
                        var avatar = result["data"]["avatar"];
                        var created_at = result["data"]["created_at"];
                        var updated_at = result["data"]["updated_at"];
                        var status = result["data"]["status"];
                        var dataString = 'id=' + id + '&name=' + name + '&email=' + email + '&provider=' + provider + '&provider_id=' + provider_id + '&avatar=' + avatar+ '&created_at=' + created_at+ '&updated_at=' + updated_at + '&status=' + status;
                        $.ajax({
                            type: 'PUT',
                            data: dataString,
                            url: 'api/users/'+ i + '?' + dataString,
                            success: function () {
                                swal({
                                    title: "Saved",
                                    text: "Success",
                                    icon: "success",
                                })
                                    .then((willSave) => {
                                        if (willSave) {
                                            location.reload();
                                        }
                                    });
                            }
                        });
                    })
                },
            });
        });
    })

    $(document).ready(function () {
        $('.delete').click(function (e) {
            var i = e.target.value;
            swal({
                title: "Are you sure?",
                text: "Delete this user?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "DELETE",
                            url: 'api/users/'+i,
                            dataType: "json",
                            success: function () {
                                $('.row_' + i).remove();
                            }
                        })
                        swal("User has been deleted!", {
                            icon: "success",
                        });
                    }
                });
        })
    });

    $(document).ready(function () {
        $('.lock').click(function (e) {
            var i = e.target.value;
            $.ajax({
                type: "GET",
                url: 'api/users/'+i,
                dataType: "json",
                success: function (result) {
                    if(result["data"]["status"] == 0) {
                        swal({
                            title: "Are you sure?",
                            text: "Do you want to lock this user?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                            .then((willLock) => {
                                if (willLock) {
                                    $.ajax({
                                        type: "GET",
                                        url: 'api/users/'+i,
                                        dataType: "json",
                                        success: function (result) {
                                            if(result["data"]["status"] == 0) {
                                                var st = '<i class="fas fa-lock" style="pointer-events:none; color: #80bfff"></i>';
                                            } else {
                                                var st = '<i class="fas fa-lock-open" style="pointer-events:none; color: #80bfff"></i>';
                                            }
                                            $('.lock_' + i).html(st);
                                            var id = result["data"]["id"];
                                            var avatar = result["data"]["avatar"];
                                            var name = result["data"]["name"];
                                            var provider = result["data"]["provider"];
                                            var email = result["data"]["email"];
                                            var provider_id = result["data"]["provider_id"];
                                            var created_at = result["data"]["created_at"];
                                            var updated_at = result["data"]["updated_at"];
                                            var status = result["data"]["status"];

                                            if(status==0){
                                                status = 1;
                                            } else {
                                                status = 0;
                                            }
                                            var dataString = 'id=' + id + '&name=' + name + '&email=' + email + '&provider=' + provider + '&provider_id=' + provider_id + '&avatar=' + avatar+ '&created_at=' + created_at + '&updated_at=' + updated_at + '&status=' + status;
                                            $.ajax({
                                                type: 'GET',
                                                data: dataString,
                                                url: 'send-email/'+ i + '?',
                                            });
                                            $.ajax({
                                                type: 'PUT',
                                                data: dataString,
                                                url: 'api/users/'+ i + '?' + dataString,
                                                success: function () {
                                                    console.log('api/users/'+ i + '?' + dataString);
                                                }
                                            });
                                        },})
                                    swal("User has been locked!", {
                                        icon: "success",
                                    });
                                }
                            })

                    } else {
                        swal({
                            title: "Are you sure?",
                            text: "Do you want to unlock this user?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                            .then((willLock) => {
                                if (willLock) {
                                    $.ajax({
                                        type: "GET",
                                        url: 'api/users/'+i,
                                        dataType: "json",
                                        success: function (result) {
                                            if(result["data"]["status"] == 0) {
                                                var st = '<i class="fas fa-lock" style="pointer-events:none; color: #80bfff"></i>';
                                            } else {
                                                var st = '<i class="fas fa-lock-open" style="pointer-events:none; color: #80bfff"></i>';
                                            }
                                            $('.lock_' + i).html(st);
                                            var id = result["data"]["id"];
                                            var avatar = result["data"]["avatar"];
                                            var name = result["data"]["name"];
                                            var provider = result["data"]["provider"];
                                            var email = result["data"]["email"];
                                            var provider_id = result["data"]["provider_id"];
                                            var created_at = result["data"]["created_at"];
                                            var updated_at = result["data"]["updated_at"];
                                            var status = result["data"]["status"];

                                            if(status==0){
                                                status = 1;
                                            } else {
                                                status = 0;
                                            }
                                            var dataString = 'id=' + id + '&name=' + name + '&email=' + email + '&provider=' + provider + '&provider_id=' + provider_id + '&avatar=' + avatar+ '&created_at=' + created_at + '&updated_at=' + updated_at + '&status=' + status;
                                            $.ajax({
                                                type: 'GET',
                                                data: dataString,
                                                url: 'send-email/'+ i + '?',
                                            });
                                            $.ajax({
                                                type: 'PUT',
                                                data: dataString,
                                                url: 'api/users/'+ i + '?' + dataString,
                                                success: function () {
                                                    console.log('api/users/'+ i + '?' + dataString);
                                                }
                                            });

                                            console.log(status);
                                        },})
                                    swal("User has been unlocked!", {
                                        icon: "success",
                                    });
                                }
                            })

                    }
                }
            })




    });})

</script>

