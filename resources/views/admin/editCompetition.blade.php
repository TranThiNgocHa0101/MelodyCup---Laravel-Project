@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Customer
                    <a href="{{ route('admin.songCompetition') }}" class="btn btn-danger float-end"> Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updateCompetition', $song->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <input type="text" class="form-control" id="level" name="level" value="{{ $song->level}}">
                            @error('level') <span class="text-danger"> {{ $message}} </span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name Song</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $song->name}}">
                            @error('name') <span class="text-danger"> {{ $message}} </span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Composer</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ $song->author}}">
                            @error('author') <span class="text-danger"> {{ $message}} </span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="song" class="form-label">Notes</label>
                            <textarea class="form-control" id="song" name="song" rows="10"> {{ old('song', $song->song) }}</textarea>
                            @error('notes') <span class="text-danger"> {{ $message}} </span>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection