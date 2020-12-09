<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Pagination with jQuery Ajax Request</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
<div class="container" style="max-width: 1400px;">
    <div class="text-center" style="margin: 20px 0px 20px 0px;">
        <h1 class="text-secondary">Users List</h1>
    </div>
    <div id="table">
        @if (count($users) > 0)
            <section class="users">
                @include('load_users_data')
            </section>
        @else
            No data found
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
</body>
</html>
