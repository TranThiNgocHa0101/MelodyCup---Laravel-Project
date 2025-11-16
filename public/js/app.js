let pianoContainer = document.getElementsByClassName("piano-container")[0];
const base = "./audio/";

window.onload = () => {
  const keys = [
    "C1", "C1#", "D1", "D1#", "E1", "F1", "F1#", "G1", "G1#", "A1", "A1#", "B1", 
    "C2", "C2#", "D2", "D2#", "E2", "F2", "F2#", "G2", "G2#", "A2", "A2#", "B2", 
    "C3", "C3#", "D3", "D3#", "E3", "F3", "F3#", "G3", "G3#", "A3", "A3#", "B3",  
    "C4", "C4#", "D4", "D4#", "E4", "F4", "F4#", "G4", "G4#", "A4", "A4#", "B4",  
    "C5", "C5#", "D5", "D5#", "E5", "F5", "F5#", "G5", "G5#", "A5", "A5#", "B5",  
    "C6", "C6#", "D6", "D6#", "E6", "D6"
  ];

  const keyMap = {
    '1': 0, 'w': 1, 's': 2, 'e': 3, 'd': 4, 'f': 5, 't': 6, 'g': 7, 
    'y': 8, 'h': 9, 'u': 10, 'j': 11, 'k': 12, 'o': 13, 'l': 14, 
    'p': 15, ';': 16, "'": 17, 'z': 18, 'x': 19, 'c': 20, 'v': 21, 
    'b': 22, 'n': 23, 'm': 24, ',': 25, '.': 26, '/': 27,
    'q': 28, 'r': 29, 't': 30, 'y': 31, 'u': 32, 'i': 33, 'o': 34, 
    'p': 35, '[': 36, ']': 37, '\\': 38, 'a': 39, 's': 40, 'd': 41, 
    'f': 42, 'g': 43, 'h': 44, 'j': 45, 'k': 46, 'l': 47, ';': 48,
    'z': 49, 'x': 50, 'c': 51, 'v': 52, 'b': 53, 'n': 54, 'm': 55,
    ',': 56, '.': 57, '/': 58, 'a': 59, '2': 60, '3': 61, '4': 62,
    '5': 63, '6': 64, '7': 65
};

  

  
  for (let i = 0; i < keys.length; i++) {
    let div = document.createElement("div");
    const key = keys[i];
    const keyLabel = document.createElement("span");
    keyLabel.textContent = key;

    if (key.includes("#")) {
      div.classList.add("key", "black-key");
    } else {
      div.classList.add("key", "white-key");
    }

    div.appendChild(keyLabel);

    const audioFile = base + "Every Note _ Piano (" + (i + 1) + ").mp4"; 
    div.onclick = () => {
      const audio = new Audio(audioFile);
      audio.play();
    };

   
    div.classList.add("key-label"); 

    pianoContainer.appendChild(div);
  }

 
  window.addEventListener('keydown', (event) => {
    const keyIndex = keyMap[event.key.toLowerCase()]; 
    if (keyIndex !== undefined) { 
      const audioFile = base + "Every Note _ Piano (" + (keyIndex + 1) + ").mp4"; 
      const audio = new Audio(audioFile); 
      audio.play(); 

      
      const keysDivs = document.querySelectorAll(".key");
      const keyDiv = keysDivs[keyIndex];
      keyDiv.classList.add("show-label"); 
    }
  });
  
  function updateBlackKeysPosition() {
    let whiteKeys = document.querySelectorAll('.white-key');
    let blackKeys = document.querySelectorAll('.black-key');
    let pattern = [0, 1, 3, 4, 5]; 

    blackKeys.forEach((blackKey, index) => {
        let whiteKeyGroup = Math.floor(index / pattern.length) * 7; 
        let relativePosition = pattern[index % pattern.length]; 
        let whiteKeyIndex = whiteKeyGroup + relativePosition;

        let currentWhiteKey = whiteKeys[whiteKeyIndex];

        if (currentWhiteKey) {
            
            let offsetLeft = currentWhiteKey.offsetLeft + currentWhiteKey.offsetWidth - blackKey.offsetWidth * 0.5;

           
            blackKey.style.left = `${offsetLeft}px`;
        }
    });
}




updateBlackKeysPosition();


  window.addEventListener('resize', updateBlackKeysPosition);
};



let btn = document.getElementById("btn");
let fullscreenIcon = document.getElementById("fullscreenIcon");
let btnText = btn.querySelector("span");

btn.addEventListener("click", () => {
  if (btnText.textContent === "Fullscreen") {
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.msRequestFullscreen) {
      document.documentElement.msRequestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen();
    }
    btnText.textContent = "Exit Fullscreen"; 
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
    btnText.textContent = "Fullscreen"; 
    fullscreenIcon.src = "img/fullscreen.webp";  
  }
});


document.addEventListener('DOMContentLoaded', function() {
  const baseUrl = window.location.origin;

 
  document.getElementById('downloadButton').addEventListener('click', function() {
    showLink(); 
    const myModal = new bootstrap.Modal(document.getElementById('myModal'));
    myModal.show(); 
  });


  function showLink() {
    const linkInput = document.getElementById("linkInput");
    const specialUrl = `${baseUrl}?sessionId=${generateRandomString()}`;
    linkInput.value = specialUrl;
  }


  function generateRandomString() {
    return Math.random().toString(36).substring(2, 15);
  }

 
  document.getElementById('copyButton').addEventListener('click', function() {
    const linkInput = document.getElementById("linkInput");
    linkInput.select();
    linkInput.setSelectionRange(0, 99999);

    try {
      const successful = document.execCommand('copy');
      if (successful) {
        alert("Link đã được sao chép!");
      } else {
        alert("Không thể sao chép!");
      }
    } catch (err) {
      console.error("Không thể sao chép: ", err);
      alert("Có lỗi xảy ra khi sao chép.");
    }
  });
});


document.getElementById("note").addEventListener("click", () => {
  const keysDivs = document.querySelectorAll(".key");
  keysDivs.forEach(div => {
    div.classList.toggle("show-label");
  });
});


let zoomButton = document.getElementById('zoomButton');
zoomButton.addEventListener("click", function() {
  pianoContainer.classList.toggle("zoomed"); 
  updateBlackKeysPosition();
});

document.getElementById("facebookShareButton").addEventListener("click", function() {
  const currentUrl = window.location.href;  // 
  const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;

  
  window.open(shareUrl, "_blank", "width=600,height=400");
});





(function ($) {
  "use strict";


  var name = $('.validate-input input[name="name"]');
  var email = $('.validate-input input[name="email"]');
  var subject = $('.validate-input input[name="subject"]');
  var message = $('.validate-input textarea[name="message"]');


  $('.validate-form').on('submit',function(){
      var check = true;

      if($(name).val().trim() == ''){
          showValidate(name);
          check=false;
      }

      if($(subject).val().trim() == ''){
          showValidate(subject);
          check=false;
      }


      if($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
          showValidate(email);
          check=false;
      }

      if($(message).val().trim() == ''){
          showValidate(message);
          check=false;
      }

      return check;
  });


  $('.validate-form .input1').each(function(){
      $(this).focus(function(){
         hideValidate(this);
     });
  });

  function showValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).addClass('alert-validate');
  }

  function hideValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).removeClass('alert-validate');
  }
  
  
})(jQuery);