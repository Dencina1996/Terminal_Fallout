var tries = 0;
function checkWord(word) {
	if (tries < 4) {
		var pass = document.getElementById("password").innerHTML;
		if (word === pass) {
			//TODO: Falta añadir código (contraseña correcta)
			//alert("Correcta!")
		} else {
			//TODO: Falta añadir código (contraseña sea incorrecta)
		    tries++;
		}
	} else {
		//TODO: Añadir código (Fin del juego)
	}
}