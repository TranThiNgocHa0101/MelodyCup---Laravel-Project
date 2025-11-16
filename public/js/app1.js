function viewNotes1(songId) {
    fetch(`/pianovitual/${songId}/notes1`)
        .then(response => response.json())
        .then(notes => {
            if (typeof notes === 'string') {
                const noteArray = notes.split(/\s+/).filter(Boolean); // Tách theo khoảng trắng và lọc các phần tử rỗng

                const songNotesContainer = document.getElementById('song-notes');
                const songNotesContainerWrapper = document.getElementById('song-notes-container');

                songNotesContainerWrapper.style.display = 'block'; // Hiển thị container
                songNotesContainer.innerHTML = ''; // Xóa nội dung cũ nếu có

                noteArray.forEach((note, index) => {
                    const noteElement = document.createElement('span');
                    noteElement.textContent = note;
                    noteElement.classList.add('note');
                    noteElement.dataset.index = index; // Lưu chỉ số nốt nhạc

                    if (note === '|') {
                        const dividerElement = document.createElement('span');
                        dividerElement.classList.add('divider');
                        dividerElement.textContent = '|';
                        songNotesContainer.appendChild(dividerElement);
                    } else {
                        if (index === 0) {
                            noteElement.classList.add('current');
                        }
                        songNotesContainer.appendChild(noteElement);
                    }
                });

                setupNoteInputHandler(noteArray); 
            } else {
                console.error('Dữ liệu trả về không phải là chuỗi:', notes);
            }
        })
        .catch(error => {
            console.error('Error loading notes:', error);
        });
}

function playNote(audioFile, keyIndex) {
  const audio = new Audio(audioFile);
  audio.play();


  if (songNotesContainerWrapper.style.display === 'block') {
      const noteElement = document.querySelector(`.note[data-index="${keyIndex}"]`);
      if (noteElement) {
          const offsetLeft = noteElement.offsetLeft; 
          const noteWidth = noteElement.offsetWidth; 

          
          const scrollAmount = offsetLeft - songNotesContainerWrapper.offsetLeft - (songNotesContainerWrapper.clientWidth / 2) + (noteWidth / 2);
          songNotesContainerWrapper.scrollLeft = scrollAmount; 
      }
  }
}

function setupNoteInputHandler(noteArray) {
  const notesContainer = document.getElementById('song-notes');
  const noteElements = notesContainer.getElementsByClassName('note');
  let currentNoteIndex = 0;


  const keyMap = {
    '1': 0, '!': 1, '2': 2, '@': 3, '3': 4, '4': 5, '@': 6, '5': 7,
    '%': 8, '6': 9, '^': 10, '7': 11, '8': 12, '*': 13, '9': 14,
    '(': 15, '0': 16, "q": 17, 'Q': 18, 'w': 19, 'W': 20, 'e': 21,
    'E': 22, 'r': 23, 't': 24, 'T': 25, 'y': 26, 'Y': 27,
    'u': 28, 'i': 29, 'I': 30, 'o': 31, 'O': 32, 'p': 33, 'P': 34,
    'a': 35, 's': 36, 'S': 37, 'd': 38, 'D': 39, 'f': 40, 'g': 41,
    'G': 42, 'h': 43, 'H': 44, 'j': 45, 'J': 46, 'k': 47, 'l': 48,
    'L': 49, 'z': 50, 'Z': 51, 'x': 52, 'c': 53, 'C': 54, 'v': 55,
    'V': 56, 'b': 57, 'B': 58, 'n': 59, 'm': 60, '<': 61, '{': 62,
    '>': 63, '}': 64, '\\': 65
  };

  document.addEventListener('keydown', (event) => {
    if (currentNoteIndex < noteArray.length) {
      const currentNoteElement = noteElements[currentNoteIndex];
      const rawNote = noteArray[currentNoteIndex];
      const expectedNotes = rawNote.replace(/\[|\]/g, ''); 
      const userInput = event.key;
      if (!(userInput in keyMap)) return;

      
      if (expectedNotes.length > 1) {
        const currentInput = currentNoteElement.dataset.input || ""; 
        const newInput = currentInput + userInput;
  
        currentNoteElement.dataset.input = newInput;
  
        if (expectedNotes.startsWith(newInput)) {
       
          currentNoteElement.classList.remove('wrong');
          currentNoteElement.classList.add('current'); 
        } else {
      
          currentNoteElement.classList.add('current');
          currentNoteElement.classList.remove('wrong', 'correct');
        }
  
        if (newInput === expectedNotes) {
        
          currentNoteElement.classList.add('correct');
          currentNoteElement.classList.remove('wrong', 'current');
          delete currentNoteElement.dataset.input; 
          currentNoteIndex++; 
        } else if (newInput.length >= expectedNotes.length) {
          
          currentNoteElement.classList.add('wrong');
          currentNoteElement.classList.remove('correct', 'current');
          delete currentNoteElement.dataset.input; 
          currentNoteIndex++; 
        }
      } else {
    
        if (expectedNotes.includes(userInput)) {
       
          currentNoteElement.classList.add('correct');
          currentNoteElement.classList.remove('wrong', 'current');
        } else {
          // Sai
          currentNoteElement.classList.add('wrong');
          currentNoteElement.classList.remove('correct', 'current');
        }
        currentNoteIndex++; 
      }
  
     
      if (currentNoteIndex < noteElements.length) {
        noteElements[currentNoteIndex].classList.add('current');
      }
    }
  });
  
  
}
const endButton = document.getElementById('endButton');
endButton.addEventListener('click', function () {
    if (isGameRunning) {
        stopProgressBar(); 
        const notesContainer = document.getElementById('song-notes');
        const noteElements = notesContainer.getElementsByClassName('note');

        let correctCount = 0;
        Array.from(noteElements).forEach(noteElement => {
            if (noteElement.classList.contains('correct')) {
                correctCount++;
            }
        });

        const totalNotes = noteElements.length;
        let score = 0;
        if (totalNotes > 0) {
            score = (correctCount / totalNotes) * 100;
        }

        
        let stars = '';
        if (score >= 80) {
            stars = '★★★★★'; // 5 sao
        } else if (score >= 50) {
            stars = '★★★★'; // 4 sao
        } else if (score >= 31) {
            stars = '★★★'; // 3 sao
        } else if (score >= 21) {
            stars = '★★'; // 2 sao
        } else if (score >= 10) {
            stars = '★'; // 1 sao
        } else {
            stars = 'Không có sao';
        }

     
        const resultMessage = document.getElementById('resultMessage');
        const resultStars = document.getElementById('resultStars');
        resultMessage.textContent = `Điểm của bạn: ${score.toFixed(2)}`;
        resultStars.textContent = stars;

        const resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
        resultModal.show();

      
        toggleButton.innerHTML = '<img src="image/pause.jpg" alt="Play" width="30px" height="30px">';
    } else {
        const resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
        const resultMessage = document.getElementById('resultMessage');
        const resultStars = document.getElementById('resultStars');
        resultMessage.textContent = 'Trò chơi đã dừng!';
        resultStars.textContent = '';
        resultModal.show();
    }
});











  






let timeLeft = 300; // Tổng thời gian chơi (giây)
let interval = null; // Bộ đếm thời gian
let isGameRunning = false; // Trạng thái game (đang chạy hay không)

function startProgressBar() {
    const progressBarInner = document.getElementById('progressBarInner');
    const timeLeftLabel = document.getElementById('timeLeftLabel'); // Lấy phần tử hiển thị thời gian còn lại

    progressBarInner.style.width = '0%'; // Reset width trước khi bắt đầu lại
    timeLeftLabel.textContent = timeLeft; // Hiển thị thời gian ban đầu

    if (interval !== null) {
        clearInterval(interval); // Xóa interval cũ nếu có
    }

    interval = setInterval(() => {
        if (timeLeft > 0) {
            timeLeft--;
            const progress = (timeLeft / 300) * 100; // Tính tỷ lệ phần trăm
            progressBarInner.style.width = `${progress}%`; // Cập nhật chiều rộng của thanh màu xanh
            timeLeftLabel.textContent = `${timeLeft}s`; // Cập nhật số giây còn lại trên thanh

            // Cập nhật dữ liệu thời gian cho thanh tiến trình
            progressBarInner.setAttribute('data-label', `${timeLeft}s`);

            // Cập nhật điểm số mỗi giây
            updateScore();
        } else {
            clearInterval(interval); // Hết thời gian thì dừng
            interval = null;
            alert('Hết thời gian!');
            isGameRunning = false; // Dừng trạng thái game
        }
    }, 1000);

    isGameRunning = true; // Đánh dấu tiến trình đang chạy
}

function stopProgressBar() {
    if (interval !== null) {
        clearInterval(interval); // Dừng interval
        interval = null;
    }
    isGameRunning = false; // Đánh dấu game không chạy
}

// Hàm cập nhật điểm số (nếu có)
function updateScore() {
    const notesContainer = document.getElementById('song-notes');
    const noteElements = notesContainer.getElementsByClassName('note');

    let correctCount = 0;
    Array.from(noteElements).forEach(noteElement => {
        if (noteElement.classList.contains('correct')) {
            correctCount++;
        }
    });

    const totalNotes = noteElements.length;
    let score = 0;
    if (totalNotes > 0) {
        score = (correctCount / totalNotes) * 100;
    }

    const scoreElement = document.querySelector('.DiemSo');
    if (scoreElement) {
        scoreElement.textContent = `Score: ${score.toFixed(2)}`;
    }
}




// Lắng nghe sự kiện nút bắt đầu/tạm dừng
const toggleButton = document.getElementById('toggleButton');
toggleButton.addEventListener('click', function () {
    if (!isGameRunning) {
        
        startProgressBar();
        toggleButton.innerHTML = '<img src="image/stop.jpg" alt="Pause" width="30px" height="30px">';
    } else {
      
        stopProgressBar();
        toggleButton.innerHTML = '<img src="image/pause.jpg" alt="Play" width="30px" height="30px">';
    }
});

