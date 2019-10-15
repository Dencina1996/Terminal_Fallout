var tries = 0;
var attempts = 4;
function checkWord(word) {
	word.innerHTML.replace('<br>', '');
	word.onclick = null;	
	if (tries < 4) {
		var PalabrasinBr=word.innerHTML.replace('<br>', '');
		document.getElementById("rightCheckColText").innerHTML+="<br>> "+PalabrasinBr;
		//word.innerHTML="<span class='terminalWords'>*****</span>";
		var pass = document.getElementById("password").innerHTML;
		if (PalabrasinBr === pass) {
						//TODO: Falta añadir código (contraseña correcta)
			//alert("Correcta!")
			document.getElementById("rightCheckColText").innerHTML+="<br> > Congratulations!<br>You won!";
			var spanElements=document.getElementsByTagName('span');
			tries=5;
		} else {
			attemptCount();
			var repeticionesLetras=0;
			word.innerHTML = '*****';
			for (var i = 0 ; i <= pass.length; i++) {
				if (PalabrasinBr[i]==pass[i]) {
					repeticionesLetras++;
				}	
			}
			repeticionesLetras=repeticionesLetras-1;
			//TODO: Falta añadir código (contraseña sea incorrecta)
			//document.getElementById(word).innerHTML="*****";
			document.getElementById("rightCheckColText").innerHTML+="<br>> Entry denied<br>> "+repeticionesLetras+"/"+pass.length+" correct"
		    tries++;
		}
	}
	if(tries==4) {
		document.getElementsByTagName('span').onclick = null;
		document.getElementById("rightCheckColText").innerHTML+="<br>> Terminal blocked";
		tries++;
		//TODO: Añadir código (Fin del juego)
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
}