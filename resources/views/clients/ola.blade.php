<table class="table table-responsive" id="clients-table">
        <thead>
            <tr>
                <th>Bio</th>
            </tr>
        </thead>
        <tbody>

        @foreach($user->job as $job)
            <tr>
                <td>{!!  $job->pivot->name; !!}</td>
 

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>