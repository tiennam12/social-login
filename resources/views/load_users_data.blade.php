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
                        <img src="{{ $user->avatar }}" onerror="this.onerror=null; this.src='images/default.jpg'" alt="ava" width="50" height="50">
                    @else
                        <img src="{{ URL::asset('images/default.jpg') }}" width="50px" height="50px">
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
                    <button style="border: none; background-color: white" id="edit" class="edit" type="button" value="{{ $user->id }}">
                        <i class="far fa-edit" style="pointer-events:none; color: #80bfff"></i>
                    </button>
                    <button style="border: none; background-color: white" id="delete" class="delete" type="button" value="{{ $user->id }}">
                        <i class="fas fa-trash-alt" style="pointer-events:none; color: #80bfff"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! $users->links('pagination::bootstrap-4') !!}

<script type="text/javascript">
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
                        location.reload();
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
                        var dataString = 'id=' + id + '&name=' + name + '&email=' + email + '&provider=' + provider + '&provider_id=' + provider_id + '&avatar=' + avatar+ '&created_at=' + created_at+ '&updated_at=' + updated_at;
                        $.ajax({
                            type: 'PUT',
                            data: dataString,
                            url: 'api/users/'+ i + '?' + dataString,
                            success: function () {
                                alert("success");
                                location.reload();
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
            alert("Delete");
            $.ajax({
                type: "DELETE",
                url: 'api/users/'+i,
                dataType: "json",
                success: function () {
                    $('.row_' + i).remove();
                }
            })
        })
    });

</script>

