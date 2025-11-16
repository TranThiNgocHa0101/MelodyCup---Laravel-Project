@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Manage practice songs</h1>

    <!-- Nút kích hoạt Modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSongModal">
    Add song
    </button>

    <!-- Bảng hiển thị danh sách bài hát -->
    <table class="table table-striped">
        <thead>
            <tr>
            <th>No.</th>
            <th>Song Name</th>
            <th>Composer</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($songs as $song)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $song->title }}</td>
                    <td>{{ $song->composer }}</td>
                    <td>
                    <!-- Nút mở Modal -->
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewNotesModal-{{ $song->id }}">
                        Show
                    </button>
                    <a href="{{ route('admin.editSong', $song->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('admin.destroySong', $song->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Del</button>
                    </form>
                </td>
                </tr>
                <div class="modal fade" id="viewNotesModal-{{ $song->id }}" tabindex="-1" aria-labelledby="viewNotesModalLabel-{{ $song->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewNotesModalLabel-{{ $song->id }}">Notes - {{ $song->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Hiển thị nốt nhạc dưới dạng JSON -->
                            <pre>{{ $song->notes }}</pre>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No songs yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addSongModal" tabindex="-1" aria-labelledby="addSongModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSongModalLabel">Add Song</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('songs.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Name Song</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                @error('title') <span class="text-danger"> {{ $message}} </span>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="composer" class="form-label">Composer</label>
                                <input type="text" class="form-control" id="composer" name="composer" required>
                                @error('composer') <span class="text-danger"> {{ $message}} </span>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="10" placeholder="Nhập nốt nhạc dạng ký tự" required></textarea>
                                @error('notes') <span class="text-danger"> {{ $message}} </span>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  


<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Popper.js (được yêu cầu cho các tính năng như modal) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle JS (bao gồm Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


@endsection
