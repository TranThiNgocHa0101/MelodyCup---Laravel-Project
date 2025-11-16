<!-- user/practice.blade.php -->
@extends('layouts.app')

@section('content')
<div class="content">
<div class="container">
    <div class="row align-items-center">
        <!-- Progress Bar (Col-6 cho thanh tiến trình chiếm 50% chiều rộng) -->
        <div class="col-12 col-md-6 bg-white mb-3">
            <div id="progressBar" class="progress-bar p-3 border border-secondary rounded-4 w-100"
                 style="position: relative; border-radius: 15px;">
                <div id="progressBarInner"
                     style="position: absolute; top: 0; left: 0; height: 100%; width: 0%; background-color:#2887e3; transition: width 1s;">
                    <span id="timeLeftLabel"
                          style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold;">
                        300
                    </span>
                </div>
            </div>
        </div>

        <!-- Nút và Score (Căn giữa 4 nút trong cùng một hàng) -->
        <div class="col-12 col-md-6">
            <div class="row justify-content-between align-items-center">
                <!-- Level Button -->
                <div class="col-auto">
                    <button class="btn btn-primary level" id="levelButton" data-bs-toggle="modal" data-bs-target="#songModal">Level</button>
                </div>

                <!-- Stop Button -->
                <div class="col-auto">
                    <button id="toggleButton" class="btn">
                        <img src="image/Stop.png" width="40px" height="40px" alt="Stop">
                    </button>
                </div>

                <!-- Score Display -->
                <div class="col-auto">
                    <span class="DiemSo" style=" font-weight: bold;">Score: 0</span>
                </div>

                <!-- End Button -->
                <div class="col-auto">
                    <button id="endButton" class="btn">
                        <img src="image/end.jpg" height="70px" width="70px" alt="End">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


 <!-- Form gửi điểm -->
 <form action="{{ route('saveScore') }}" method="POST">
    @csrf
    <input type="hidden" id="hiddenScore" name="score" >
    <button type="submit" class="btn btn-success">Lưu điểm</button>
</form>

<!-- Modal hiển thị kết quả -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultModalLabel"></h5>
                <img src="image/win.gif" width="80px" height="80px">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p id="resultMessage" style="font-size: 1.2em; font-weight: bold;">Điểm của bạn: 0</p>
                <div id="resultStars" style="font-size: 2em; color: gold;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
 
    <div class="piano-container-wrapper">
    <div class="piano-lable">
            <button class="button-lable" id="note">
              <img src="image/not.jpg" width="30 px" height="30px"> Note
            </button>
            <button class="button-lable" id="zoomButton"> 
              <img src="image/thu.jpg" width="30 px" height="30px"> Zoom out
            </button>
            <button class="button-lable">   <a href="{{ route('ranktable') }}" >Ranking
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
                                    <th>Level</th>
                                    <th>Name Song</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($songs as $song)
                                    <tr>
                                        <td>{{ $song->level }}</td>
                                        <td>{{ $song->name }}</td>
                                        <td>
                                            <!-- Khi người dùng bấm, nốt nhạc sẽ hiển thị -->
                                            <button class="btn btn-primary btn-sm" style="  background-color: #babdc4; " onclick="viewNotes1('{{ $song->id }}');  stopProgressBar();     startProgressBar();  " data-bs-dismiss="modal">
                                                <i class="fa-solid fa-play"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No songs yet.</td>
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
<script>
   
const scoreDisplay = document.getElementById('scoreValue');
let score = 0;




document.getElementById('endButton').addEventListener('click', function() {
   
    score = parseInt(scoreDisplay.innerText); 

   
    document.getElementById('hiddenScore').value = score;

    document.getElementById('resultMessage').innerText = `Điểm của bạn: ${score}`;

 
    $('#resultModal').modal('show');
});

document.getElementById('endButton').addEventListener('click', function() {

    let scoreText = document.querySelector('.DiemSo').textContent; 
    let score = parseFloat(scoreText.split(": ")[1].trim()); 
    console.log('Điểm hiện tại:', score);

    document.getElementById('hiddenScore').value = score;
});


</script>
<script src="{{ asset('js/app1.js') }}"></script>
@endsection
