<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th width="5%">ID</th>
            <th width="38%">Title</th>
            <th width="57%">Description</th>
        </tr>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->post_title }}</td>
                <td>{{ $row->post_description }}</td>
            </tr>
        @endforeach
    </table>

    {!! $data->links() !!}

</div>
