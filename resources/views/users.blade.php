<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Pagination with jQuery Ajax Request</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
<div class="container" style="max-width: 700px;">
    <div class="text-center" style="margin: 20px 0px 20px 0px;">
        <span class="text-secondary">Users List</span>
    </div>
    <div id="table">
        @if (count($users) > 0)
            <section class="users">
                @include('load_users_data')
            </section>
        @else
            No data found :(
        @endif
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href')+'&perPage='+{!! json_encode($perPage) !!};
            console.log(url);
            window.history.pushState("", "", url);
            loadUsers(url);
        });

        function loadUsers(url) {
            $.ajax({
                url: url
            }).done(function (data) {
                $('.users').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('.edit').click(function () {
            var i = $('.edit').attr('value');
            $.ajax({
                type: "GET",
                url: 'api/users/'+i,
                dataType: "json",
                success: function (result) {
                    var table = $("<table><tr><th>Edit user</th></tr>");
                    table.append("<tr><td>Id:</td><td>"+ result["data"]["id"] +"</td></tr>");
                    table.append("<tr><td>Name:</td><td><input id='name' value=" + result["data"]["name"] + "></td></tr>");
                    table.append("<tr><td>Email:</td><td><input id='email' value=" + result["data"]["email"] + "></td></tr>");
                    table.append("<tr><td>Provider:</td><td><input id='provider' value=" + result["data"]["provider"] + "></td></tr>");
                    table.append("<tr><td>Provider id:</td><td><input id='provider_id' value=" + result["data"]["provider_id"] + "></td></tr>");
                    table.append("<tr><td><button class='save' id='save'>Save</button></td></tr>");

                    $("#table").html(table);
                    $(".save").click(function (e) {
                        e.preventDefault();
                        var id = $("#id").val();
                        var name = $("#name").val();
                        var email = $("#email").val();
                        var provider = $("#provider").val();
                        var provider_id = $("#provider_id").val();
                        var avatar = result["data"]["avatar"];
                        var created_at = result["data"]["created_at"];
                        var updated_at = result["data"]["updated_at"];
                        var dataString = 'id=' + id + '&name=' + name + '&email=' + email + '&provider=' + provider + '&provider_id=' + provider_id + '&avatar=' + avatar+ '&created_at=' + created_at+ '&updated_at=' + updated_at;
                        $.ajax({
                            type: 'PUT',
                            data: dataString,
                            url: "http://127.0.0.1:8000/api/users/" + i + '?' + dataString,
                            success: function () {
                                alert("success");
                            }
                        });
                    })

                },
            });
        });
    })
</script>

<script>
    $(document).ready(function () {
        $('.delete').click(function (e) {
            var i = $('.delete').attr('value');
            alert("Delete");
            $.ajax({
                type: "DELETE",
                url: 'api/users/'+i,
                dataType: "json",
                success: function () {
                    $('.row_' + $('.delete').attr('value')).remove();
                }
            })
        })
    });
</script>
</body>
</html>
