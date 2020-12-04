<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content_box">
    <div class="right_bar ">
        <div class="tab-content ">
            <div class="tab-pane fade show active" id="lorem" role="tabpanel">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Avatar</th>
                        <th>Provider ID</th>
                        <th>Provider</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img src="{{ $user->avatar }}" alt="avatar" width="50" height="50"></td>
                            <td>{{ $user->provider_id }}</td>
                            <td>{{ $user->provider }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $users->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).on('hashchange',function() {
        page = window.location.hash.replace('#','');
        getUsers(page);
    });

    $(document).on('click','.pagination a', function(e){
        e.preventDefault();
        page = $(this).attr('href').split('page=')[1];
        location.hash = page;
    });

    function getUsers(page) {
        $.ajax({
            url: '/home?page='+page
        }).done(function(data){
            $('#lorem').html(data);
        });
    }
</script>
