// Script para mostrar/cerrar el div de nuevo seccion del gestor de seccions.
function mostrarNuevaSeccion(){
	// Obtener la caja de los seccions
	var caja = document.getElementsByClassName("nueva_seccion")[0];

	// Obtener el boton que abre los seccions
	var boton = document.getElementById("boton_nueva_seccion");

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

function mostrarEdicionSeccion(id_li, id_seccion){
	
	var li_seleccionado = $('#' + id_li)
	
	var nombre = li_seleccionado.find($('a.seccion')).text();
	li_seleccionado.find($('a.seccion')).replaceWith('<input name="nombreModificar" type="text" value="'+nombre+'">');

	li_seleccionado.append('<button type="submit" id="enviarSeccionMod" name="accion" value="modificar" form="formGestionSecciones">Confirmar</button>');
	li_seleccionado.append('<a class="cancelar" href="gestor_publicidad.php"><button>Cancelar</button></a>');
	li_seleccionado.append('<input type="hidden" name="id_seccion" value="'+id_seccion+'">');
		
	$('a.enlace_editar').remove();
}