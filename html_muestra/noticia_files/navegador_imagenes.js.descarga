var indiceDiapositiva = 1;
mostrarDiapositiva(indiceDiapositiva);

function siguienteDiapositiva(n) {
  mostrarDiapositiva(indiceDiapositiva += n);
}

function diapositivaActual(n) {
  mostrarDiapositiva(indiceDiapositiva = n);
}

function mostrarDiapositiva(n) {
	var i;
	var diapositivas = document.getElementsByClassName("diapositiva");
	var puntos = document.getElementsByClassName("punto");
	
	if (n > diapositivas.length) {indiceDiapositiva = 1} 
	
	if (n < 1) {indiceDiapositiva = diapositivas.length}
	
	for (i = 0; i < diapositivas.length; i++) {
		diapositivas[i].style.display = "none";  
	}
	
	for (i = 0; i < puntos.length; i++) {
		puntos[i].className = puntos[i].className.replace(" activo", "");
	}
	
	diapositivas[indiceDiapositiva-1].style.display = "block";  
	puntos[indiceDiapositiva-1].className += " activo";
}
