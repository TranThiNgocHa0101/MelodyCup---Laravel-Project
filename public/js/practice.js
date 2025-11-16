function viewNotes(songId) {
    fetch(`/songs/${songId}/notes`)
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

                setupNoteInputHandler(noteArray); // Assuming this function exists
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
      const expectedNotes = rawNote.replace(/\[|\]/g, ''); // Loại bỏ dấu ngoặc vuông
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
