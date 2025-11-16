@extends('layouts.app') <!-- Hoặc layout mà bạn đang sử dụng -->

@section('content')
    <div class="container mt-3">
        <h1>Search results for: "{{ request('q') }}"</h1>

        <div id="searchResults">
            @if($results->isNotEmpty())
                <ul class="list-group">
                    @foreach($results as $song)
                        <li class="list-group-item">{{ $song->title }}</li>
                    @endforeach
                </ul>
            @else
                <p class="mt-2">No results found.</p>
            @endif
        </div>
    </div>
@endsection