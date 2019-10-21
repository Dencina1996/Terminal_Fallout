// GLOBAL VARIABLES //

var tries = 0;
var attempts = 4;
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
    			document.getElementById("rightCheckColText").innerHTML += "<br> > Congratulations<br>You won!";
    			var spanElements = document.getElementsByTagName('span');
          let att = tries;
          console.log("ATT:"+att);
    			tries = 5;
          disableSpans();
          var username = prompt("You won! Enter your name:");
          // Pruebas
          performClick(username, att.toString(), "1:25", document.getElementById("save"), "click");
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
  	document.getElementById('check').innerHTML = '> '+checkWord;
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

  function performClick(username, attempts, time, elem, event) {
    document.getElementById("username").value = username;
    document.getElementById("attemptsUsr").value = attempts;
    document.getElementById("time").value = time;
    document.getElementById("form").submit();
  }
