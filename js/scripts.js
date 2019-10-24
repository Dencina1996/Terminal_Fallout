// GLOBAL VARIABLES //

var tries = 0;
var attempts = 4;
var timer_is_on;
var minutes = 0;
var seconds = 0;
const word_length = document.getElementById("password").innerHTML.length;

// FUNCTIONS //

  // WORD CHECKING AND REPLACING //

    function checkWord(word) {
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
          document.getElementById('endImg').src = '../img/Win.png';
          document.getElementById('endImg').style.visibility = 'visible';
          stopTimer();
    			document.getElementById("rightCheckColText").innerHTML += "<br> > Congratulations<br>You won!";
    			var spanElements = document.getElementsByTagName('span');
          let att = tries;
    			tries = 5;
          disableSpans();
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
    			document.getElementById("rightCheckColText").innerHTML+="<br>> Entry denied<br>> "+repeatedLetters+"/"+pass.length+" correct"
    		  tries++;
    		}
    	}
    	if(tries==4) {
    		document.getElementsByTagName('span').onclick = null;
    		document.getElementById("rightCheckColText").innerHTML+="<br>> Terminal blocked";
    		tries++;
        disableSpans();
        document.getElementById('endImg').src = '../img/Lose.png';
        document.getElementById('endImg').style.visibility = 'visible';
        stopTimer();
        setTimeout(function() {
           alert('Goodbye!');
           window.location.href = '../index.html';

          },3000);
    	}
    }

// SCORE ATTEMPTS //

  function attemptCount() {
  	document.getElementsByClassName('attemptDiv')[attempts-1].style.visibility = 'hidden';
  	attempts--;
  	if (attempts < 1) {
  		alert('Has perdido!');
  		window.location.replace('');
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
      elements[0].className = "fail";
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