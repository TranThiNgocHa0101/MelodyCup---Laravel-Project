@extends('layouts.app')

@section('content')
    <section class="wrapper">
        <div class="panel panel-default">
        <p style="text-align:center; color: red;"><strong>Username:</strong> {{ $username }}</p>
        <p style="text-align:center; color:red;"><strong>Email:</strong> {{ $email }}</p>
            <div class="panel-heading">Your Score</div>
            <div>
               
                <table class="table" ui-jq="footable" ui-options='{
                    "paging": {
                        "enabled": true
                    },
                    "filtering": {
                        "enabled": true
                    },
                    "sorting": {
                        "enabled": true
                    }}'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Create Day</th>
                            <th>Update Day</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userScores as $index => $score)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $score->user->name }}</td>
                                <td>{{ $score->score }}</td>
                                <td>{{ $score->created_at }}</td>
                                <td>{{ $score->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
