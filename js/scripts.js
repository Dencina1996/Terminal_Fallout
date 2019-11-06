// GLOBAL VARIABLES //

var tries = 0;
var attempts = 4;
var timer_is_on;
var minutes = 0;
var seconds = 0;
var egg=0;
var win = new Audio('../sound/win.mp3');
var lose = new Audio('../sound/lose.wav');
var easteregg = new Audio('../sound/easteregg.mp3');
var word_length = -1;

// FUNCTIONS //

  // WORD CHECKING AND REPLACING //

    function checkWord(word) {
      if (word_length === -1) {
        word_length = document.getElementById("password").innerHTML.length;
      }
      var hasBR = false;
    	word.onclick = null;
    	if (tries < 4) {
        var indexOfBr = -1;
        var text = word.innerHTML;
        if (word.innerHTML.includes("<br>")) {
          hasBR = true;
          indexOfBr = word.innerHTML.indexOf("<br>");
        }
    		var wordWithoutBr = word.innerHTML.replace('<br>', '');
    		document.getElementById("rightCheckColText").innerHTML += "<br>> "+wordWithoutBr;
    		var pass = document.getElementById("password").innerHTML;
    		if (wordWithoutBr === pass) {
          win.play();
          document.getElementById('endImg').src = '../img/Win.png';
          document.getElementById('endImg').style.visibility = 'visible';
          stopTimer();
    			document.getElementById("rightCheckColText").innerHTML += "<br> > Congratulations<br>You won!";
    			var spanElements = document.getElementsByTagName('span');
          let att = tries;
    			tries = 5;
          disableSpans();
          disableHelps();
          setTimeout(function() {
            var username = prompt("You won! Enter your name:");
            performClick(username, att.toString(), document.getElementById("save"), "click");
          },3000);
    		} else {
    			attemptCount();
          changeClass(text);
    			var repeatedLetters=0;
          if (hasBR) {
            var replacement = "";
            for (var i = 0; i < word_length; i++) {
              if (i == indexOfBr) {
                replacement += "<br>.";
              } else {
                replacement += ".";
              }
            }
            word.innerHTML = replacement;
          } else {
            word.innerHTML = ".".repeat(word_length);
          }
    			for (var i = 0 ; i <= pass.length; i++) {
    				if (wordWithoutBr[i] == pass[i]) {
    					repeatedLetters++;
    				}
    			}
    			repeatedLetters=repeatedLetters-1;
          tries++;
          if (document.getElementById("extremeMode").innerHTML == "true") {
            extremeMode(repeatedLetters, pass);
          } else {
            document.getElementById("rightCheckColText").innerHTML += "<br>> Entry denied<br>> "+repeatedLetters+"/"+pass.length+" correct";
          }
    		}
    	}
    	if(tries==4) {
    		//document.getElementsByTagName('span').onclick = null;
        lose.play();
    		document.getElementById("rightCheckColText").innerHTML+="<br>> Terminal blocked";
    		tries++;
        disableSpans();
        disableHelps();
        document.getElementById('endImg').src = '../img/Lose.png';
        document.getElementById('endImg').style.visibility = 'visible';
        stopTimer();
        setTimeout(function() {
           alert('Goodbye!');
           window.location.href = '../index.php';
          }, 3000);
    	}
    }

// INSERT WORD INTO COLUMN WHEN HOVERS //

  function sendCheck(word) {
  	var checkWord = word.innerHTML.replace('<br>','');
  	document.getElementById('check').innerHTML = ' '+checkWord;
  }

// CLEAN WORD ON MOUSE LEAVE //

  function cleanCheck() {
  	document.getElementById('check').innerHTML = '';
  }

// HIDES THE ATTEMPT SQUARE //

  function attemptCount() {
  	document.getElementsByClassName('attemptDiv')[attempts-1].style.visibility = 'hidden';
    attempts--;
    document.getElementById('attempts').innerHTML = attempts;
  }

// CHANGES THE CLASS OF AN ELEMENT //

  function changeClass(text) {
    var elements = document.getElementsByClassName('terminalWords');
    for (var i = 0; i < elements.length; i++) {
      if (elements[i].innerHTML == text) {
        elements[i].onmouseover = function() {};
        elements[i].onmouseout = function() {};
        elements[i].className = "fail";
      }
    }
  }

// DISABLES THE WORD IF ATTEMPT IS FAILED //

  function disableSpans(){
    var elements = document.getElementsByClassName('terminalWords');
    let elem_length = elements.length;
    for (var i = 0; i < elem_length; i++) {
      elements[0].onmouseover = function() {};
      elements[0].onmouseout = function() {};
      elements[0].onclick = null;
      elements[0].className = "fail";
    }
  }

// DISABLES ALL HELPS (WHEN THE GAME ENDS)
  function disableHelps() {
    var helps = document.getElementsByClassName('helps');
    var elem_length = helps.length;
    for (var i = 0; i < elem_length; i++) {
      helps[0].onmouseover = function() {};
      helps[0].onmouseout = function() {};
      helps[0].onclick = null;
      helps[0].className = "fail";
    }
  }


  var lastRepeatedLetters = 0;
// RULES OF EXTREME MODE (ONLY WHEN EXTREME MODE IS ON)
  function extremeMode(repeatedLetters, pass) {
    if (lastRepeatedLetters > repeatedLetters) {
      document.getElementById("rightCheckColText").innerHTML += "<br>> Entry denied<br>> Last: "+lastRepeatedLetters+"/"+pass.length+" correct <br>> Now: "+repeatedLetters+"/"+pass.length+" correct";
      tries = 4;
    } else {
      lastRepeatedLetters = repeatedLetters;
      document.getElementById("rightCheckColText").innerHTML += "<br>> Entry denied<br>> "+repeatedLetters+"/"+pass.length+" correct";
    }
  }

  function performClick(username, attempts, elem, event) {
    document.getElementById("username").value = username;
    document.getElementById("attemptsUsr").value = attempts;
    document.getElementById("time").value = (minutes*60)+seconds; // TOTAL IN SECONDS
    document.getElementById("form").submit();
  }

// TIMER //

  // TIMER FUNCTION //

    function timedCount() {
      if (seconds >= 59) {
        document.getElementById('minLabel').innerHTML = minutes;
        document.getElementById('secLabel').innerHTML = seconds;
        seconds = 0;
        minutes++;
        timer = setTimeout(timedCount, 1000);
      } else {
        document.getElementById('minLabel').innerHTML = minutes;
        document.getElementById('secLabel').innerHTML = seconds;
        seconds++;
        timer = setTimeout(timedCount, 1000);
      }
      if (seconds < 10) {
        document.getElementById('secLabel').innerHTML = '0'+seconds;
      } else {
        document.getElementById('secLabel').innerHTML = seconds;
      }
      if (minutes < 10) {
        document.getElementById('minLabel').innerHTML = '0'+minutes;
      } else {
        document.getElementById('minLabel').innerHTML = minutes;
      }
    }

  // START TIMER //

    function startTimer() {
      if (!timer_is_on) {
        timer_is_on = true;
        timedCount();
      }
    }

  // STOP TIMER //

    function stopTimer() {
      clearTimeout(timer);
      timer_is_on = 0;
    }

// HELP: DELETE MISTAKEN WORD //

  function deleteTrash(help) {
    if (word_length === -1) {
      word_length = document.getElementById("password").innerHTML.length;
    }
    var words = document.getElementsByClassName("terminalWords");
    var positions = [];
    for (var i = 0; i < words.length; i++) {
      var text = words[i].innerHTML;
      text = text.replace("<br>", "");
      if (text != document.getElementById("password").innerHTML) {
        positions.push(i);
      }
    }
    var wordsLength = positions.length;
    var index = positions[Math.floor(Math.random() * (wordsLength - 1))];
    var word = words[index].innerHTML;
    if (word.includes("<br>")) {
      var replacement = "";
      var indexOfBr = word.indexOf("<br>");
      for (var i = 0; i < word_length; i++) {
        if (i == indexOfBr) {
          replacement += "<br>.";
        } else {
          replacement += ".";
        }
      }
      words[index].innerHTML = replacement;
    } else {
      words[index].innerHTML = ".".repeat(word_length);
    }
    words[index].onmouseover = function() {};
    words[index].onmouseout = function() {};
    words[index].onclick = null;
    words[index].className = "fail";
    help.innerHTML = ".".repeat(help.innerText.length);
    help.onclick = null;
    help.className = "fail";
    document.getElementById("rightCheckColText").innerHTML+="<br>> Trash removed";
  }

// HELP: RESET ATTEMPTS //

  function resetAttempts(help) {
    if (word_length === -1) {
      word_length = document.getElementById("password").innerHTML.length;
    } 
    tries = 0;
    attempts = 4;
    var attempts_squares = document.getElementsByClassName("attemptDiv");
    for (var i = 0; i < attempts_squares.length; i++) {
      attempts_squares[i].style.visibility = "visible";
    }
    document.getElementById("attempts").innerHTML = "4";
    help.innerHTML = ".".repeat(help.innerText.length);
    help.onclick = null;
    help.className = "fail";
    document.getElementById("rightCheckColText").innerHTML+="<br>> Attempts restored";
  }

  function showHideSomething(id) {
      document.getElementById("GameMode").style.display = 'none';
      document.getElementById("Ranking").style.display = 'none';
      document.getElementById(id).style.display = 'block';
  }

// AUDIO //

  function playAudio() {
    var audio = document.getElementsByTagName("audio")[1];
    audio.play();
  }

  function audioControl(type) {
    var soundImg = document.getElementById('audioImg');
    var bgAudio = document.getElementsByTagName("audio")[0];
    var buttonAudio = document.getElementsByTagName("audio")[1];
    var ruta='';
    if(type=='terminal'){
      ruta='../';
    }else if(type=='menu'){
      ruta='';
    }
    if (soundImg.className == 'enabled') {
      soundImg.src = ruta+'img/mute.png';
      soundImg.className = 'disabled';
      bgAudio.volume = 0.0;
      buttonAudio.volume = 0.0;
    }
    else if (soundImg.className == 'disabled') {
      soundImg.src = ruta+'img/speaker.png';
      soundImg.className = 'enabled';
      bgAudio.volume = 1.0;
      buttonAudio.volume = 1.0;
    }
  }

function checkExtreme(mode){
  if (document.getElementById("extreme").checked === true) {
    mode.href+="&extreme=true";
  }else if(document.getElementById("extreme").checked === false) {
    mode.href+="&extreme=false";
  }
}

function revealRanks(id) {
  document.getElementById(id).style.visibility = 'visible';
  document.getElementById("menu").style.visibility = 'hidden';
}

function hideRanks(id) {
  document.getElementById(id).style.visibility = 'hidden';
  document.getElementById("menu").style.visibility = 'visible';
}

function activateEgg(){
  egg++;
  if (egg==3){
  document.getElementById('screen').style.visibility = 'hidden';
  document.getElementById('epi').style.visibility = 'visible';
  easteregg.play();
  easteregg.loop = true;
 }else if(egg>3){
  egg=0;
  easteregg.pause();
  document.getElementById('screen').style.visibility = 'visible';
  document.getElementById('epi').style.visibility = 'hidden';
 }
}


