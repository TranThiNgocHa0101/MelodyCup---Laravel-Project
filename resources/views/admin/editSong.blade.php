@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Customer
                    <a href="{{ route('admin.listSong') }}" class="btn btn-danger float-end"> Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updateSong', $song->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Tên bài hát</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $song->title}}">
                            @error('title') <span class="text-danger"> {{ $message}} </span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="composer" class="form-label">Người sáng tác</label>
                            <input type="text" class="form-control" id="composer" name="composer" value="{{ $song->composer}}">
                            @error('composer') <span class="text-danger"> {{ $message}} </span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Nốt nhạc</label>
                            <textarea class="form-control" id="notes" name="notes" rows="10"> {{ old('notes', $song->notes) }}</textarea>
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