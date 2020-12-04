<div id="load" style="position: relative;">
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Avatar</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Provider</th>
            <th scope="col">Provider id</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="Girl in a jacket" width="50" height="50">
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->provider }}</td>
                <td>{{ $user->provider_id }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! $users->links('pagination::bootstrap-4') !!}

