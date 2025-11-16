@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 style="text-align: center; color: #343a40; font-weight: bold;">Rank Table</h1>

    <!-- Bảng hiển thị bảng xếp hạng -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered" style="color: #343a40; background-color: #f8f9fa; border: 1px solid #dee2e6;">
            <thead class="thead-dark" style="background-color: #343a40; color: white;">
                <tr>
                    <th style="text-align: center; width: 5%;">#</th>
                    <th style="text-align: center; width: 30%;">Name</th>
                    <th style="text-align: center; width: 20%;">Score</th>
                    <th style="text-align: center; width: 20%;">Create Date</th>
                    <th style="text-align: center; width: 20%;">Update Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topScores as $index => $score)
                    <tr>
                        <td style="text-align: center; font-weight: bold;">{{ $index + 1 }}</td>
                        <td style="text-align: center;">{{ $score->user->name }}</td>
                        <td style="text-align: center; color: #28a745; font-weight: bold;">{{ number_format($score->total_score, 2) }}</td>
                        <td style="text-align: center;">{{ \Carbon\Carbon::parse($score->first_play)->format('d/m/Y H:i') }}</td>
                        <td style="text-align: center;">{{ \Carbon\Carbon::parse($score->last_play)->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
