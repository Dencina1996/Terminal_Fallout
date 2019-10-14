var tries = 0;
function checkWord(word) {
	word.onclick = null;	
	if (tries < 4) {
		var PalabrasinBr=word.innerHTML.replace('<br>', '');
		document.getElementById("rightCheckCol").innerHTML+="<br>>"+PalabrasinBr;
		//word.innerHTML="<span class='terminalWords'>*****</span>";
		var pass = document.getElementById("password").innerHTML;
		if (PalabrasinBr === pass) {
						//TODO: Falta añadir código (contraseña correcta)
			//alert("Correcta!")
			document.getElementById("rightCheckCol").innerHTML+="<br>>Congratualtions!";
			var spanElements=document.getElementsByTagName('span');
			tries=5;
		} else {
			var repeticionesLetras=0;
			for (var i = 0 ; i <= pass.length; i++) {
				if (PalabrasinBr[i]==pass[i]) {
					repeticionesLetras++;
				}	
			}
			repeticionesLetras=repeticionesLetras-1;
			//TODO: Falta añadir código (contraseña sea incorrecta)
			//document.getElementById(word).innerHTML="*****";
			document.getElementById("rightCheckCol").innerHTML+="<br>>Entry denied<br>>"+repeticionesLetras+"/"+pass.length+" correct"
		    tries++;
		}
	}
	if(tries==4) {
		document.getElementsByTagName('span').onclick = null;
		document.getElementById("rightCheckCol").innerHTML+="<br>>Terminal blocked";
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