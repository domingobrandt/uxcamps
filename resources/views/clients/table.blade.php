<table class="table table-responsive" id="clients-table">
    <thead class="thead-dark">
        <tr>
        <th>Bio</th>
        <th>Education</th>
        <th>Avatar</th>
        <th>User Id</th>
        <th>Relationship</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>

    @foreach($clients as $client)
        <tr>
            <td>{!! $client->bio !!}</td>
            <td>{!! $client->education !!}</td>
            <td>{!! $client->avatar !!}</td>
            <td>{!! $client->users->name !!}</td>
            <td>{!! $jobsi !!}</td>

                <td>
                {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('clients.show', [$client->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('clients.edit', [$client->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>