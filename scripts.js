var tries = 0;
var attempts = 4;
// El tamaño de la palabra (aprovechamos y utilizamos la contraseña)
const word_length = document.getElementById("password").innerHTML.length;

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
		var PalabrasinBr=word.innerHTML.replace('<br>', '');
		document.getElementById("rightCheckCol").innerHTML+="<br>> "+PalabrasinBr;
		var pass = document.getElementById("password").innerHTML;
		if (PalabrasinBr === pass) {
			document.getElementById("rightCheckCol").innerHTML+="> Congratulations!<br>You won!";
			var spanElements=document.getElementsByTagName('span');
			tries=5;
		} else {
			attemptCount();
      changeClass(text);
			var repeticionesLetras=0;
      if (hasBR) {
        var replacement = "";
        for (var i = 0; i < word_length; i++) {
          if (i == indexOfBr) {
            replacement += "<br>*";
          } else {
            replacement += "*";
          }
        }
        word.innerHTML = replacement;
      } else {
        word.innerHTML = "*****";
      }
			for (var i = 0 ; i <= pass.length; i++) {
				if (PalabrasinBr[i]==pass[i]) {
					repeticionesLetras++;
				}
			}
			repeticionesLetras=repeticionesLetras-1;
			document.getElementById("rightCheckCol").innerHTML+="<br>> Entry denied<br>> "+repeticionesLetras+"/"+pass.length+" correct"
		  tries++;
		}
	}
	if(tries==4) {
		document.getElementsByTagName('span').onclick = null;
		document.getElementById("rightCheckCol").innerHTML+="<br>> Terminal blocked";
		tries++;
	}
}

function attemptCount() {
	document.getElementsByClassName('attemptDiv')[attempts-1].style.visibility = 'hidden';
	attempts--;
	if (attempts < 1) {
		alert('Has perdido!');
		window.location.replace('');
	}
}

function sendCheck(word) {
	var checkWord = word.innerHTML.replace('<br>','');
	document.getElementById('check').innerHTML = checkWord;
}

function cleanCheck() {
	document.getElementById('check').innerHTML = '';
}

function attemptCount() {
	document.getElementsByClassName('attemptDiv')[attempts-1].style.visibility = 'hidden';
  attempts--;
  document.getElementById('attempts').innerHTML = attempts;
}

function nofunction() {
  console.log("void");
}

function changeClass(text) {
  var elements = document.getElementsByClassName('terminalWords');
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].innerHTML == text) {
      elements[i].onmouseover = function() {};
      elements[i].onmouseout = function() {};
      elements[i].className = "fail";
    }
  }
  console.log(elements);
}
