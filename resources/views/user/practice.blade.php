<!-- user/practice.blade.php -->
@extends('layouts.app')

@section('content')
<div class="content">
    <button type="button" class="btn btn-create" data-bs-toggle="modal" data-bs-target="#songModal">
        Chọn bài hát
    </button>
    <div class="piano-container-wrapper">
        <div class="piano-lable">
            <button class="button-lable" id="note">
              <img src="image/not.jpg" width="30 px" height="30px"> Note
            </button>
            <button class="button-lable" id="zoomButton"> 
              <img src="image/thu.jpg" width="30 px" height="30px"> Zoom out
            </button>
            <button class="button-lable"> <a href="{{ route('ranktable') }}" > Ranking
              <img src="image/learn.jpg" width="30 px" height="30px"></a>
            </button>
            <button class="button-lable" id="btn">
              <img src="image/fullscreen.webp" width="30 px" height="30px" id="fullscreenIcon">
              <span>Fullscreen</span>
            </button>
        </div>
        <!-- Khu vực hiển thị nốt nhạc -->
        <div id="song-notes-container" style="display:none; margin-top: 20px;">
            <div id="song-notes" class="notes-container"></div>
        </div>
    </div>

    <!-- Modal chứa danh sách bài hát -->
    <div class="modal fade" id="songModal" tabindex="-1" aria-labelledby="songModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="songModalLabel">Danh sách bài hát</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="song-list-wrapper">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên bài hát</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($songs as $song)
                                    <tr>
                                        <td>{{ $song->title }}</td>
                                        <td>
                                            <!-- Khi người dùng bấm, nốt nhạc sẽ hiển thị -->
                                            <button class="btn btn-primary btn-sm" style="  background-color: #babdc4; " onclick="viewNotes('{{ $song->id }}')">
                                                <i class="fa-solid fa-play"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Chưa có bài hát nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Khu vực Piano -->
        <div class="piano-container"></div>
</div>
<script src="{{ asset('js/practice.js') }}"></script>
@endsection
