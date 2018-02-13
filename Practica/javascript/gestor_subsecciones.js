// Script para mostrar/cerrar el div de nuevo seccion del gestor de seccions.
function mostrarNuevaSubseccion(){
	// Obtener la caja de los seccions
	var caja = document.getElementsByClassName("nueva_subseccion")[0];

	// Obtener el boton que abre los seccions
	var boton = document.getElementById("boton_nueva_subseccion");

	// Obtener el elemento que cierra la caja
	var ocultar = document.getElementsByClassName("ocultar")[0];

	// Cuando el usuario pulsa en el enlace, mostrar la caja
	boton.onclick = function() {
	    caja.style.display = "block";
	}

	// Cuando el usuario hace click en el elemento ocultar, se cierra la caja
	ocultar.onclick = function() {
	    caja.style.display = "none";
	}
}

function mostrarEdicionSubseccion(id_li, id_subseccion){
	
	var li_seleccionado = $('#' + id_li)
	console.log(id_li + " " + id_subseccion);
	var nombre = li_seleccionado.find($('h1')).text();
	li_seleccionado.find($('h1')).replaceWith('<input name="nombreModificar" type="text" value="'+nombre+'">');


	li_seleccionado.append('<button type="submit" id="enviarSubseccionMod" name="accion" value="modificar" form="formGestionSubsecciones">Confirmar</button>');
	li_seleccionado.append('<a class="cancelar" href="gestor_publicidad.php"><button>Cancelar</button></a>');
	li_seleccionado.append('<input type="hidden" name="id_subseccion" value="'+id_subseccion+'">');
	
	$('a.enlace_editar').remove();
}