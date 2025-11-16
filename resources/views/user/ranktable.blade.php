<!-- user/practice.blade.php -->
@extends('layouts.app')

@section('content')
        <section class="wrapper">
           
                <div class="panel panel-default">
                    <div class="panel-heading"> RANK TABLE</div>
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
                                    <th>Create-day</th>
                                    <th>Update-day</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topScores as $index => $score)
                                    <tr>
                                    <td>{{ $index + 1 }}</td>
            <td>{{ $score->user->name }}</td> 
            <td>{{ number_format($score->total_score, 2) }}</td> 
            <td>{{ \Carbon\Carbon::parse($score->first_play)->format('d/m/Y H:i') }}</td>
            <td>{{ \Carbon\Carbon::parse($score->last_play)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                
            </div>
        </section>

    @endsection
